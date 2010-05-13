<?php
//
//  FPDI - Version 1.01
//
//    Copyright 2004 Setasign - Jan Slabon
//
//  Licensed under the Apache License, Version 2.0 (the "License");
//  you may not use this file except in compliance with the License.
//  You may obtain a copy of the License at
//
//      http://www.apache.org/licenses/LICENSE-2.0
//
//  Unless required by applicable law or agreed to in writing, software
//  distributed under the License is distributed on an "AS IS" BASIS,
//  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
//  See the License for the specific language governing permissions and
//  limitations under the License.
//

require_once("pdf_context.php");

class pdf_parser {

    /**
     * Filename
     * @var string
     */
    var $filename;
    
    /**
     * File resource
     * @var resource
     */
    var $f;
    
    /**
     * PDF Context
     * @var object pdf_context-Instance
     */
    var $c;
    
    /**
     * xref-Data
     * @var array
     */
    var $xref;

    /**
     * root-Object
     * @var array
     */
    var $root;
    
    /**
     * Pages
     * Index beginns at 0
     *
     * @var array
     */
    var $pages;
    
    /**
     * Page count
     * @var integer
     */
    var $page_count;
    
    /**
     * actual page number
     * @var integer
     */
    var $pageno;
    
    /**
     * PDF Version of imported Document
     * @var string
     */
    var $pdfVersion;
    
    /**
     * FPDI Reference
     * @var object
     */
    var $fpdi;
    
    /**
     * Constructor
     *
     * @param string $filename  Source-Filename
     * @param object $fpdi      Object of type fpdi
     */
    function pdf_parser($filename,&$fpdi) {
        $this->filename = $filename;
        $this->fpdi =& $fpdi;

        $this->f = @fopen($this->filename,"rb");

        if (!$this->f)
            $this->fpdi->error(sprintf("Cannot open %s !",$filename));

        $this->getPDFVersion();

        $this->c = new pdf_context($this->f);
        // Read xref-Data
        $this->pdf_read_xref($this->xref, $this->pdf_find_xref());

        // Check for Encryption
        $this->getEncryption();

        // Get Info
        $this->getInfo();

        // Read root
        $this->pdf_read_root();

        // resolve Pages-Dictonary
        $pages = $this->pdf_resolve_object($this->c, $this->root[1][1]['/Pages']);

        // Read pages
        $this->read_pages($this->c, $pages, $this->pages);
        
        // count pages;
        $this->page_count = count($this->pages);
    }
    
    /**
     * Get pagecount from sourcefile
     *
     * @return int
     */
    function getPageCount() {
        return $this->page_count;
    }


    /**
     * Set pageno
     *
     * @param int $pageno Pagenumber to use
     */
    function setPageno($pageno) {
        $pageno-=1;

        if ($pageno < 0 || $pageno >= $this->getPageCount()) {
            $this->fpdi->error("Pagenumber is wrong!");
        }

        $this->pageno = $pageno;
    }
    
    /**
     * Get page-resources from current page
     *
     * @return array
     */
    function getPageResources() {
        return $this->_getPageResources($this->pages[$this->pageno]);
    }
    
    /**
     * Get page-resources from /Page
     *
     * @param array $obj Array of pdf-data
     */
    function _getPageResources ($obj) { // $obj = /Page
    	$obj = $this->pdf_resolve_object($this->c, $obj);

        // If the current object has a resources
    	// dictionary associated with it, we use
    	// it. Otherwise, we move back to its
    	// parent object.
        if (isset ($obj[1][1]['/Resources'])) {
    		$res = $this->pdf_resolve_object($this->c, $obj[1][1]['/Resources']);
    		if ($res[0] == PDF_TYPE_OBJECT)
                return $res[1];
            return $res;
    	} else {
    		if (!isset ($obj[1][1]['/Parent'])) {
    			return false;
    		} else {
                $res = $this->_getPageResources($obj[1][1]['/Parent']);
                if ($res[0] == PDF_TYPE_OBJECT)
                    return $res[1];
                return $res;
    		}
    	}
    }


    function getInfo() {
        $avail_infos = array("Title", "Author", "Subject", "Keywords", "Creator", "Producer", "CreationDate", "ModDate", "Trapped");

        $_infos = $this->pdf_resolve_object($this->c,$this->xref['trailer'][1]['/Info']);
        $infos = array();

        foreach ($avail_infos AS $info) {
            if (isset($_infos[1][1]["/".$info])) {
                if ($_infos[1][1]["/".$info][0] == PDF_TYPE_STRING) {
                    $infos[$info] = $this->deescapeString($_infos[1][1]["/".$info][1]);
                } else if ($_infos[1][1]["/".$info][0] == PDF_TYPE_HEX) {
                    $infos[$info] = $this->hex2String($_infos[1][1]["/".$info][1]);
                }
            }
        }
        $this->infos = $infos;
    }
    
    /**
     * Make Problems with the leading chars... maybe a tokenizer problem
     */
    function hex2String($hex) {
        $s = "";
        for ($i = 0; $i < strlen($hex); $i+=2)
            $s .= chr(hexdec($hex{$i}.($hex{$i+1} ? $hex{$i+1} : 0)));

        return $s;
    }
    
    function deescapeString($s) {
        $torepl = array("/\\\(\d{1,3})/e" => "chr(octdec(\\1))",
                        "/\\\\\(/" => "(",
                        "/\\\\\)/" => ")");
        return preg_replace(array_keys($torepl),$torepl,$s);
    }

    /* Wrong name...
    function getPageInfo() {
        return $this->_getPageInfo($this->pages[$this->pageno][1][1]);
    }

    function _getPageInfo($page) {
        $info = array();

        if ($page['/Rotate'])
            $info['is_rotated'] = $page['/Rotate'][1];

        return $info;
    } */


    /**
     * Get content of current page
     *
     * If more /Contents is an array, the streams are concated
     *
     * @return string
     */
    function getContent() {
        $buffer = "";
        
        $contents = $this->getPageContent($this->pages[$this->pageno][1][1]['/Contents']);
        foreach($contents AS $tmp_content) {
            $buffer .= $this->rebuildContentStream($tmp_content);
        }
        
        return $buffer;
    }
    
    
    /**
     * Resolve all content-objects
     *
     * @param array $content_ref
     * @return array
     */
    function getPageContent($content_ref) {
        $contents = array();

        if ($content_ref[0] == PDF_TYPE_OBJREF)
            $contents[] = $this->pdf_resolve_object($this->c, $content_ref);
        else if ($content_ref[0] == PDF_TYPE_ARRAY) {
            foreach ($content_ref[1] AS $tmp_content_ref) {
                $contents = array_merge($contents,$this->getPageContent($tmp_content_ref));
            }
        }

        return $contents;
    }


    /**
     * Rebuild content-streams
     * only non-compressed streams and /FlateDecode are ready!
     *
     * @param array $obj
     * @return string
     */
    function rebuildContentStream($obj) {
        $filters = array();

        if (isset($obj[1][1]['/Filter'])) {
            $_filter = $obj[1][1]['/Filter'];

            if ($_filter[0] == PDF_TYPE_TOKEN) {
                $filters[] = $_filter;
            } else if ($_filter[0] == PDF_TYPE_ARRAY) {
                $filters = $_filter[1];
            }
        }

        $stream = $obj[2][1];

        foreach ($filters AS $_filter) {
            switch ($_filter[1]) {
                case "/FlateDecode":
                   $stream = @gzuncompress($stream);
                   if ($stream === false) {
                       $this->fpdi->error("Error while decompressing string.");
                   }
                break;
                case null:
                   $stream = $stream;
                break;
                default:
                   $this->fpdi->error(sprintf("Unsupported Filter: %s",$_filter[1]));
            }
        }

        return $stream;
    }
    
    /**
     * Get MediaBox
     *
     * gets an array that describes the size of a page.
     *
     * @param integer $pageno
     * @return array @see getPageBox()
     */
    function getPageMediaBox($pageno) {
        return $this->getPageBox($this->pages[$pageno-1],"/MediaBox");
    }


    /**
     * Get a Box from a page
     * Arrayformat is same as used by fpdf_tpl
     *
     * @param array $page a /Page
     * @param string $box_index Type of Box @see getPageBoxes()
     * @return array
     */
    function getPageBox($page, $box_index) {
        $page = $this->pdf_resolve_object($this->c,$page);
        if (isset($page[1][1][$box_index]) && $page[1][1][$box_index][0] == PDF_TYPE_ARRAY) {
            $b =& $page[1][1][$box_index][1];
            return array("x" => $b[0][1]/$this->fpdi->k,
                         "y" => $b[1][1]/$this->fpdi->k,
                         "w" => $b[2][1]/$this->fpdi->k,
                         "h" => $b[3][1]/$this->fpdi->k);
        } else if (!isset ($page[1][1]['/Parent'])) {
            return false;
        } else {
            return $this->getPageBox($this->pdf_resolve_object($this->c, $page[1][1]['/Parent']), $box_index);
        }
    }

    /**
     * Get all Boxes from /Page
     *
     * @param array a /Page
     * @return array
     */
    function getPageBoxes($page) {
        $_boxes = array("/MediaBox","/CropBox","/BleedBox","/TrimBox","/ArtBox");
        $boxes = array();

        foreach($_boxes AS $box) {
            if ($_box = $this->getPageBox($page,$box)) {
                $boxes[$box] = $_box;
            }
        }

        return $boxes;
    }


    /* Out of date but maybe useful in the future ;-)
    function findFonts($font) {
        if ($font[0] == PDF_TYPE_OBJREF) {
            return $this->getFonts($this->pdf_resolve_object($this->c, $font));
        } else if ($font[0] == PDF_TYPE_DICTIONARY) {
            return $this->findFonts($font[1]);
        } else if ($font['/Font']) {
            if ($font['/Font'][0] == PDF_TYPE_OBJREF) {
                return $this->pdf_resolve_object($this->c, $font['/Font']);
            } else {
                return $font['/Font'];
            }
        }
    }

    function getFonts($font) {
        $fonts = $this->findFonts($font);
        if ($fonts[0] == PDF_TYPE_OBJECT) {
            $fonts = $fonts[1][1];
        } else {
            $fonts = $fonts[1];
        }

        foreach($fonts AS $fontname => $objref) {
            $tmpfont = $this->pdf_resolve_object($this->c, $objref);
            $final_font[$fontname] = $tmpfont[1];
        }
        // Zu parsende Einträge sind: (bzw. flexibel... automatisches rebuilden)
        // /FontDescriptor -> FontFileX, /Encoding, /ToUnicode
        return $final_font;
    }*/


    /**
     * Check Trailer for Encryption
     */
    function getEncryption() {
        if (isset($this->xref['trailer'][1]['/Encrypt'])) {
            $this->fpdi->error("File is encrypted!");
        }
    }


    /**
     * Read all /Page(es)
     *
     * @param object pdf_context
     * @param array /Pages
     * @param array the result-array
     */
    function read_pages (&$c, &$pages, &$result) {

        // Get the kids dictionary
    	$kids = $this->pdf_resolve_object ($c, $pages[1][1]['/Kids']);

        if (!is_array($kids))
            $this->Error("Cannot find /Kids in current /Page-Dictionary");
        foreach ($kids[1] as $v) {
    		$pg = $this->pdf_resolve_object ($c, $v);
            #print_r($pg);

    		if ($pg[1][1]['/Type'][1] === '/Pages') {
                // If one of the kids is an embedded
    			// /Pages array, resolve it as well.
                $this->read_pages ($c, $pg, $result);
    		} else {
    			$result[] = $pg;
    		}
    	}
    }

    
    /**
     * Find/Return /Root
     *
     * @return array
     */
    function pdf_find_root() {
        if ($this->xref['trailer'][1]['/Root'][0] != PDF_TYPE_OBJREF) {
            $this->fpdi->Error("Wrong Type of Root-Element! Must be an indirect reference");
        }
        return $this->xref['trailer'][1]['/Root'];
    }

    /**
     * Read the /Root
     */
    function pdf_read_root() {
        // read root
        $this->root = $this->pdf_resolve_object($this->c, $this->pdf_find_root());
    }
    
    /**
     * Get PDF-Version
     *
     * And reset the PDF Version used in FPDI if needed
     */
    function getPDFVersion() {
        fseek($this->f, 0);
        preg_match("/\d\.\d/",fread($this->f,10),$m);
        $this->pdfVersion = $m[0];
        
        if ($this->pdfVersion > $this->fpdi->importVersion) {
            $this->fpdi->importVersion = $this->pdfVersion;
        }
    }
    
    /**
     * Find the xref-Table
     */
    function pdf_find_xref() {
       	fseek ($this->f, -50, SEEK_END);
        $data = fread($this->f, 50);

        if (!preg_match('/startxref\s*(\d+)\s*%%EOF\s*$/', $data, $matches)) {
    		$this->fpdi->error("Unable to find pointer to xref table");
    	}

    	return (int) $matches[1];
    }

    /**
     * Read xref-table
     *
     * @param array $result Array of xref-table
     * @param integer $offset of xref-table
     * @param integer $start start-position in xref-table
     * @param integer $end end-position in xref-table
     */
    function pdf_read_xref(&$result, $offset, $start = null, $end = null) {

        if (is_null ($start) || is_null ($end)) {
            fseek($this->f, $offset);
            $data = trim(fgets($this->f));
            if ($data !== 'xref') {
    		    $this->fpdi->error("Unable to find xref table - Maybe a Problem with 'auto_detect_line_endings'");
    	    }

            $data = explode(' ', trim(fgets($this->f)));
            if (count($data) != 2) {
    	        $this->fpdi->error("Unexpected header in xref table");
            }
            $start = $data[0];
    	    $end = $start + $data[1];
    	}

    	if (!isset($result['xref_location'])) {
            $result['xref_location'] = $offset;
    	}

    	if (!isset($result['max_object']) || $end > $result['max_object']) {
    	    $result['max_object'] = $end;
    	}

    	for (; $start < $end; $start++) {
    	    $data = trim(fgets($this->f));

    	    $offset = substr($data, 0, 10);
    	    $generation = substr($data, 11, 5);

    	    if (!isset ($result['xref'][$start][(int) $generation])) {
    	    	$result['xref'][$start][(int) $generation] = (int) $offset;
    	    }
    	}

        $data = trim (fgets ($this->f));
        if ($data === 'trailer') {
            $c =  new pdf_context($this->f);
    	    $trailer = $this->pdf_read_value($c);
            if (isset($trailer[1]['/Prev'])) {
                $this->pdf_read_xref($result, $trailer[1]['/Prev'][1]);
    		    $result['trailer'][1] = array_merge($result['trailer'][1], $trailer[1]);
    	    } else {
    	        $result['trailer'] = $trailer;
            }
    	} else {
            $data = explode(' ', $data);
            $this->pdf_read_xref($result, null, $data[0], $data[0] + $data[1]);
    	}
    	
    }


    /**
     * Reads an Value
     *
     * @param object $c pdf_context
     * @param string $token a Token
     * @return mixed
     */
    function pdf_read_value(&$c, $token = null) {
    	if (is_null($token)) {
    	    $token = $this->pdf_read_token($c);
    	}
    	

    	if ($token === false) {
    	    return false;
    	}

    	switch ($token) {
            case	'<':
    			// This is a hex string.
    			// Read the value, then the terminator

    			$s = $this->pdf_read_token($c);

    			if ($s === false) {
    				return false;
    			}

                while($t = $this->pdf_read_token($c)) {
                    if ($t == '>')
                        break;
                    $s .= $t;
                }

                return array (PDF_TYPE_HEX, $s);

    			break;
    		case	'<<':
    			// This is a dictionary.

    			$result = array();

    			// Recurse into this function until we reach
    			// the end of the dictionary.
    			while (($key = $this->pdf_read_token($c)) !== '>>') {
    				if ($key === false) {
    					return false;
    				}

    				if (($value =   $this->pdf_read_value($c)) === false) {
    					return false;
    				}
                    $result[$key] = $value;
    			}

    			return array (PDF_TYPE_DICTIONARY, $result);

    		case	'[':
    			// This is an array.

    			$result = array();

    			// Recurse into this function until we reach
    			// the end of the array.
    			while (($token = $this->pdf_read_token($c)) !== ']') {
                    if ($token === false) {
    					return false;
    				}

    				if (($value = $this->pdf_read_value($c, $token)) === false) {
                        return false;
    				}

    				$result[] = $value;
    			}
    			
                return array (PDF_TYPE_ARRAY, $result);

    		case	'('		:
                // This is a string

    			$pos = $c->offset;

    			while(1) {

                    // Start by finding the next closed
    				// parenthesis

    				$match = strpos ($c->buffer, ')', $pos);

    				// If you can't find it, try
    				// reading more data from the stream

    				if ($match === false) {
    					if (!$c->increase_length()) {
                            return false;
    					} else {
                            continue;
                        }
    				}

    				// Make sure that there is no backslash
    				// before the parenthesis. If there is,
    				// move on. Otherwise, return the string.

    				if (isset($c->buffer[$match - 1]) && $c->buffer[$match - 1] !== '\\') {
    					$result = substr ($c->buffer, $c->offset, $match - $c->offset);
                        $c->offset = $match + 1;
    					return array (PDF_TYPE_STRING, $result);
    				} else {
    					$pos = $match + 1;

    					if ($pos > $c->offset + $c->length) {
    						$c->increase_length();
    					}
    				}
                }

            case "stream":
                $stream = $c->read_stream();

                $this->parentStream[] = array(PDF_TYPE_STREAM, $stream);
                return array(PDF_TYPE_STREAM, $stream);
    		default	:
            	if (is_numeric ($token)) {
                    // A numeric token. Make sure that
    				// it is not part of something else.
    				if (($tok2 = $this->pdf_read_token ($c)) !== false) {
                        if (is_numeric ($tok2)) {

    						// Two numeric tokens in a row.
    						// In this case, we're probably in
    						// front of either an object reference
    						// or an object specification.
    						// Determine the case and return the data
    						if (($tok3 = $this->pdf_read_token ($c)) !== false) {
                                switch ($tok3) {
    								case	'obj'	:
                                        return array (PDF_TYPE_OBJDEC, (int) $token, (int) $tok2);
    								case	'R'		:
    									return array (PDF_TYPE_OBJREF, (int) $token, (int) $tok2);
    							}
    							// If we get to this point, that numeric value up
    							// there was just a numeric value. Push the extra
    							// tokens back into the stack and return the value.
    							array_push ($c->stack, $tok3);
    						}
    					}

    					array_push ($c->stack, $tok2);
    				}

    				return array (PDF_TYPE_NUMERIC, $token);
    			} else {

                    // Just a token. Return it.
    				return array (PDF_TYPE_TOKEN, $token);
    			}

         }
    }
    
    /**
     * Resolve an object
     *
     * @param object $c pdf_context
     * @param array $obj_spec The object-data
     * @param boolean $encapsulate Must set to true, cause the parsing and fpdi use this method only without this para
     */
    function pdf_resolve_object(&$c, $obj_spec, $encapsulate = true) {
        // Exit if we get invalid data
    	if (!is_array($obj_spec)) {
            return false;
    	}

    	if ($obj_spec[0] == PDF_TYPE_OBJREF) {

    		// This is a reference, resolve it
    		if (isset($this->xref['xref'][$obj_spec[1]][$obj_spec[2]])) {

    			// Save current file position
    			// This is needed if you want to resolve
    			// references while you're reading another object
    			// (e.g.: if you need to determine the length
    			// of a stream)

    			$old_pos = ftell($c->file);

    			// Reposition the file pointer and
    			// load the object header.

    			$c->reset($this->xref['xref'][$obj_spec[1]][$obj_spec[2]]);

    			$header = $this->pdf_read_value($c,null,true);

    			if ($header[0] != PDF_TYPE_OBJDEC || $header[1] != $obj_spec[1] || $header[2] != $obj_spec[2]) {
    				$this->fpdi->error("Unable to find object ({$obj_spec[1]}, {$obj_spec[2]}) at expected location");
    			}

    			// If we're being asked to store all the information
    			// about the object, we add the object ID and generation
    			// number for later use

    			if ($encapsulate) {
    				$result = array (
    					PDF_TYPE_OBJECT,
    					'obj' => $obj_spec[1],
    					'gen' => $obj_spec[2]
    				);
    			} else {
    				$result = array();
    			}

    			// Now simply read the object data until
    			// we encounter an end-of-object marker
    			while(1) {
                    $value = $this->pdf_read_value($c);

    				if ($value === false) {
    					return false;
    				}

    				if ($value[0] == PDF_TYPE_TOKEN && $value[1] === 'endobj') {
    					break;
    				}

                    $result[] = $value;
    			}

    			$c->reset($old_pos);

                if (isset($result[2][0]) && $result[2][0] == PDF_TYPE_STREAM) {
                    $result[0] = PDF_TYPE_STREAM;
                }

    			return $result;
    		}
    	} else {
    		return $obj_spec;
    	}
    }

    
    
    /**
     * Reads a token from the file
     *
     * @param object $c pdf_context
     * @return mixed
     */
    function pdf_read_token(&$c)
    {
    	// If there is a token available
    	// on the stack, pop it out and
    	// return it.

    	if (count($c->stack)) {
    		return array_pop($c->stack);
    	}

    	// Strip away any whitespace

    	do {
    		if (!$c->ensure_content()) {
    			return false;
    		}
    		$c->offset += strspn($c->buffer, " \n\r", $c->offset);
    	} while ($c->offset >= $c->length - 1);

    	// Get the first character in the stream

    	$char = $c->buffer[$c->offset++];

    	switch ($char) {

    		case '['	:
    		case ']'	:
    		case '('	:
    		case ')'	:

    			// This is either an array or literal string
    			// delimiter, Return it

    			return $char;

    		case '<'	:
    		case '>'	:

    			// This could either be a hex string or
    			// dictionary delimiter. Determine the
    			// appropriate case and return the token

    			if ($c->buffer[$c->offset] == $char) {
    				if (!$c->ensure_content()) {
    					return false;
    				}
    				$c->offset++;
    				return $char . $char;
    			} else {
    				return $char;
    			}

    		default		:

    			// This is "another" type of token (probably
    			// a dictionary entry or a numeric value)
    			// Find the end and return it.

    			if (!$c->ensure_content()) {
    				return false;
    			}

    			while(1) {

    				// Determine the length of the token

    				$pos = strcspn($c->buffer, " []<>()\r\n/", $c->offset);

    				if ($c->offset + $pos < $c->length - 1) {
    					break;
    				} else {
    					// If the script reaches this point,
    					// the token may span beyond the end
    					// of the current buffer. Therefore,
    					// we increase the size of the buffer
    					// and try again--just to be safe.

    					$c->increase_length();
    				}
    			}

    			$result = substr($c->buffer, $c->offset - 1, $pos + 1);

    			$c->offset += $pos;
    			return $result;
    	}
    }

}

?>