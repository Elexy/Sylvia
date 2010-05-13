<?
/*
 * xml_fuctions.php
 *
 * @version $Id: xml_fuctions.php,v 1.1 2004-11-08 15:40:56 iwan Exp $
 * @copyright $date:
 **/
define('XML_ARRAY_NAME', 'name');
define('XML_ARRAY_ATTRS', 'attrs');
define('XML_ARRAY_CDATA', 'cdata');
define('XML_ARRAY_CHILDREN', 'children');
define('XML_DEPTH_SPACE', '    ');
 
/**
 * Function     : GetXMLdata
 * Get the data in the a XML file.
 * input        : filename: The name of the xmlfile.
 * Output       : pointer_xml_array: Pointer to the array containing the data. This $pointer_xml_array must be defined as array() before calling this function.
 * Returns      : TREU when array contains falid data. False otherwise. 
 **/
function GetXMLdata($filename) {
	global $pointer_xml_array;
	
	$bl_result = FALSE;
	
	function startTag($parser, $name, $attrs)
	{
	   global $pointer_xml_array;
	   $tag=array(XML_ARRAY_NAME=>$name,XML_ARRAY_ATTRS=>$attrs); 
	   array_push($pointer_xml_array, $tag);
	}
	
	function cdata($parser, $cdata)
	{
	   global $pointer_xml_array;
	  
	   if(trim($cdata))
	   {   
		   $pointer_xml_array[count($pointer_xml_array)-1][XML_ARRAY_CDATA]=$cdata;   
	   }
	}
	
	function endTag($parser, $name)
	{
	   global $pointer_xml_array; 
	   $pointer_xml_array[count($pointer_xml_array)-2][XML_ARRAY_CHILDREN][] = $pointer_xml_array[count($pointer_xml_array)-1];
	   array_pop($pointer_xml_array);
	}
	
	$xml_parser = xml_parser_create();
	xml_set_element_handler($xml_parser, "startTag", "endTag");
	xml_set_character_data_handler($xml_parser, "cdata");
	
	$data = xml_parse($xml_parser, file_get_contents($filename));
	if($data) {
		$bl_result = TRUE;
	} else {
	   die(sprintf("XML error: %s at line %d",
		xml_error_string(xml_get_error_code($xml_parser)),
		xml_get_current_line_number($xml_parser)));
	}
	
	xml_parser_free($xml_parser);
	return $bl_result;
}

 /**
 * Function     : GetCdata
 * Get the Cdata in the current level of XML array.
 * input        : $ary_parsed, The array in this level.
 * 				: $str_name,  The name to get the Cdata from.
 * Returns      : The data, FALSE otherwise.
 **/
function GetCdata($ary_parsed, $str_name) {
	$str_return = FALSE;
	
	foreach ($ary_parsed as $field => $value) {
		if (!strcasecmp($value[XML_ARRAY_NAME], $str_name)) {
			$str_return = $value[XML_ARRAY_CDATA];
			break;
		}
	}
	
	return $str_return;
}

/**
 * Function     : AddCharter
 * Return charachter char, int_x times.
 * input        : $int_x: The amount of time to copy.
 * 				: $chr_char: The charachter to copy. Default a tab is used.
 * Returns      : String with the charachters 
 **/
function AddCharter($int_x, $chr_char = XML_DEPTH_SPACE) {
	$str_return = '';
	
	for ($i = 0; $i<$int_x; $i++) {
		$str_return .= $chr_char;
	}
	
	return $str_return;
}

/**
 * Function     : ReturnXMLobject
 * Return the XML data object in the array as XML string.
 * input        : $ary_xml: The array containing the XML data.
 * 				: $int_depth: The depth of the DOM XML tree.
 * Returns      : String with the XML data. 
 **/
function ReturnXMLobject($ary_xml, $int_depth=0){
	$str_return = '';

	foreach ($ary_xml as $field => $value) {
		//echo AddCharter($int_depth)."$int_depth field = $field, value = $value\n";
		$str_return .= "\n".AddCharter($int_depth)."<".$value[XML_ARRAY_NAME];
		if (count($value[XML_ARRAY_ATTRS])
			) {
			//var_dump ($value);	
			foreach ($value[XML_ARRAY_ATTRS] as $fieldattr => $valueattr) {
				$str_return .= " $fieldattr=\"$valueattr\"";
			}
		}
		$str_return .= ">";
		if (isset($value[XML_ARRAY_CDATA])) {
			$str_return .= $value[XML_ARRAY_CDATA];
		}
		if (isset($value[XML_ARRAY_CHILDREN])) {
			$str_return .= ReturnXMLobject(&$value[XML_ARRAY_CHILDREN],
										   $int_depth+1)
						. "\n".AddCharter($int_depth);
		}
		
		$str_return .= "</".$value[XML_ARRAY_NAME].">";
	}
	
	return $str_return;
}

/**
 * Function     : ReturnXMLdata
 * Return the XML data in the array as XML string.
 * input        : $ary_xml: The array containing the XML data.
 * Returns      : String with the XML data. 
 **/
function ReturnXMLdata($ary_xml) {
	$str_return = "<?xml version=\"1.0\"?>\n<!DOCTYPE orderstatus SYSTEM \"http:// \">";
	$str_return .= ReturnXMLobject($ary_xml);
	
	return $str_return;
}

/**
 * Function     : CreateXMLObject
 * Creates an XML array object.
 * input        : $name, name of the object
 *				: $ary_attr, atributes to add.
 *				: $ary_childeren, the childs to add.
 *				: $str_cdata, the data to add.
 * Returns      : $ary_xml with the object. 
 **/
function CreateXMLObject($name, 
						 $ary_attr, 
						 $ary_childeren = array(), 
						 $str_cdata = FALSE)
{
    $tag = array(XML_ARRAY_NAME=>$name, XML_ARRAY_ATTRS=>$ary_attr); 
	if ($str_cdata) {
		$tag[XML_ARRAY_CDATA] = $str_cdata;
	}
	
	if (count($ary_childeren)) {
		$tag[XML_ARRAY_CHILDREN] = $ary_childeren;
		//$tag[count($tag)-2][XML_ARRAY_CHILDREN][] = $tag[count($tag)-1];
	}
	
    return $tag;
}

?>