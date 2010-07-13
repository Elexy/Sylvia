<?php
    # This line will stream the file to the user rather than spray it across the screen
    header("Content-type: application/vnd.ms-excel");

    # replace excelfile.xls with whatever you want the filename to default to
    header("Content-Disposition: attachment; filename=excelfile.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

	//include PEAR stuff this is what needs to be installed on the server:
	// pear install OLE
	// pear install Spreadsheet_Excel_Writer
	require_once 'Spreadsheet/Excel/Writer.php';

	// Creating a workbook
	$workbook = new Spreadsheet_Excel_Writer();

	// sending HTTP headers
	$workbook->send(COMPANYNAME . '.xls');

	// Creating a worksheet
	
	// from: php/Spreadsheet/Excel/Writer/Workbook.php:
	// Check that sheetname is <= 31 chars (Excel limit before BIFF8).
	$worksheetname = COMPANYNAME;
	if (isset($str_worksheet)) {
		$worksheetname = substr($str_worksheet,0,31);
	} else {
		$worksheetname = "sheet 1";
	}
	
	$worksheet =& $workbook->addWorksheet($worksheetname);
	
	// First the headers
	foreach ($arr_header as $col_header => $header_value) {
		$worksheet->write(0, $col_header, $header_value);
 	}
	
	//The actual data
	foreach ($arr_data as $row => $value) {
		foreach ($value as $col => $cell_value) {
			$worksheet->write($row, $col, $cell_value);
	   }
	}
	
	//if there is a query, print it in the next sheet
	// Creating a worksheet
	if (isset($str_query)) {
		$worksheet =& $workbook->addWorksheet('Query');
		$worksheet->write(0, 0, $str_query);
	}
	 
	
	// Let's send the file
	$workbook->close();
	
?>
