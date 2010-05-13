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

class pdf_context {

	var $file;
	var $buffer;
	var $offset;
	var $length;

	var $stack;

	// Constructor

	function pdf_context($f) {
		$this->file = $f;
		$this->reset();
	}

	// Optionally move the file
	// pointer to a new location
	// and reset the buffered data

	function reset($pos = null) {
		if (!is_null ($pos)) {
			fseek ($this->file, $pos);
		}

		$this->buffer = fread($this->file, 100);
		$this->offset = 0;
		$this->length = strlen($this->buffer);
		$this->stack = array();
	}

	// Make sure that there is at least one
	// character beyond the current offset in
	// the buffer to prevent the tokenizer
	// from attempting to access data that does
	// not exist

	function ensure_content() {
		if ($this->offset >= $this->length - 1) {
			return $this->increase_length();
		} else {
			return true;
		}
	}

	// Forcefully read more data into the buffer

	function increase_length() {
		if (feof($this->file)) {
			return false;
		} else {
			$this->buffer .= fread($this->file, 100);
			$this->length = strlen($this->buffer);
			return true;
		}
	}

	/**
     * Read a stream
     */
    function read_stream() {
        static $a;

        $o_pos = ftell($this->file)-strlen($this->buffer);
        $o_offset = $this->offset;
        
        $this->reset($startpos = $o_pos + $o_offset);
        $v = "";
        $prev_buffer = "";
        $tmp_start = 0;
        
        while (($endpos = strpos($prev_buffer.$this->buffer,"endstream")) === false) {
            $prev_buffer = $this->buffer;
            $v .= $this->buffer;
            $tmp_start+=100;
            $this->reset($startpos + $tmp_start);
        }
        $v .= $this->buffer;
        
        $v = substr($v,0,$tmp_start+$endpos-(strlen($prev_buffer)));

        $e = strspn($v,"\r\n"); // ensure line breaks in front of the stream
        $v = substr($v,$e,strlen($v));

        $this->reset($p = $startpos+$tmp_start+$endpos-strlen($prev_buffer)+strlen("endstream")); // reset File after endstream-token

        return $v;
    }
    
    /**
     * old... very slow!
     *
    function read_stream() {
        $o_pos = ftell($this->file)-strlen($this->buffer);
        $o_offset = $this->offset;

        $tmp_offset = 0;

        while(($endpos = strpos(substr($this->buffer,$this->offset,$this->length),"endstream")) == false) {
            $this->increase_length();
        }

        $v = substr($this->buffer,$this->offset, $endpos);
        $e = strspn($v,"\r\n"); // ensure line breaks in front of the stream
        $v = substr($v,$e,strlen($v));

        $this->reset($p = $o_pos+$o_offset+strlen($v)+$e+strlen("endstream")); // reset File after endstream-token

        echo $p."<br>";
        flush();

        return $v;
    }  */
}
?>