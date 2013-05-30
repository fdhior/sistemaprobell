<?php
	
	session_start();

	$hostname    = $_SESSION['hostname'];
	$relpath     = "supervision/asistencia/exportar/"; 

	
	$formato = $_POST['formato'];

	
	$file = $hostname.$relpath;
	
	switch ($formato) {
		case "excel":
			$file = $file.'reporte.xls';
			break;
		case "word":
			$file = $file.'reporte.doc';
			break;
		case "pdf":
			$file = $file.'reporte.pdf';
			break;		
	}
		

	echo $file;
	
		//   function downloadFile($file){
		header ("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header('Content-Description: File Transfer');
		header('Content-Length: ' . filesize($file));
		header('Content-Disposition: attachment; filename=' . basename($file));
		header("Content-Type: application/vnd.ms-excel");
		readfile($file);
		exit;
//	}
?>