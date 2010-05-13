<?PHP


include ("include.php");

$str_filetouse = isset($_GET['file']) ? $_GET['file'] : FALSE;

$pdf = new FPDF_Protection('P','mm','A4');
$pdf->Open();

$int_pagecount = $pdf->setSourceFile($GLOBALS['ary_config']['temp_dir']."/$str_filetouse.pdf");
for ($i = 1; $i <= $int_pagecount; $i++) {		
	$pdf->AddPage();
	$ary_gls_pages[$i] = $pdf->ImportPage($i);
	$pdf->useTemplate($ary_gls_pages[$i],0,0);	
}

$pdf->Output();

//sleep(2);
//unlink($GLOBALS['ary_config']['temp_dir']."/$str_file.pdf");

?>