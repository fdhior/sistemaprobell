<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script type="text/javascript"></script>
</head>

<body onload="javascript:document.forms[0].submit();">
<?php

// Checamos primero si los archivos de configuración existen en la maquina cliente
// $arch_conf = "c:\\windows\idt.conf";
// $sisgv_ini = "c:\\sisgv\\sgvconfig.ini";
// $exec_file = "c:\\hostname.exe";

// if (file_exists($arch_conf) and file_exists($sisgv_ini) and file_exists($exec_file) {

	session_start();
	include "consultas.php";

	// Variables Session a locales
	$iduser        = $_SESSION['iduser'];
	$iduserarea    = $_SESSION['idusrarea'];
	$compltusrname = $_SESSION['compltusrname'];
// $ntpass = $_POST['ntpass'];
// $tipov = $_POST['tipov'];
// $desc = $_POST['desc'];
// $detalle = $_POST['detalle'];


// Convertir las variables POST en locales
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			${$nombre} = $valor;
		}
	} // Cierre foreach	



// $arch_conf_arr = file($archi_conf);
// $arch_sisgv = file($sisgv_ini);
// $remotehost = exec($exec_file);
// print_r($arch_conf_arr);
// print_r($arch_sisgv);
// echo "Los archivos de seguridad existen<br />";

/*	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "nombre variable: <b>$nombre</b> valor: $valor<br />"; 
		}	
	} */


/*
switch ($tipov) {
	case "Supervision":
		$tipov = "S";
		break;
	case "Sistemas":
		$tipov = "M";
		break;
} // Cierre de Switch		 */

?>
<!-- FORMA DE ENVIO AUTOMATICO JAVASCRIPT PARA ACTUALIZAR LA LISTA DE VISITAS -->
<form id="form0" name="form0" method="post" action="inicio_listavisitas.php" target="visitlist">
</form>

<?php


	// Client Agent 		
	$client_a = $_SERVER['HTTP_USER_AGENT'];
	$remoteport = $_SERVER['REMOTE_PORT'];
// $client_a = 'Mozilla';
// echo "$client_a<br />";


// Remote IP y HOSTNAME
	$remoteip = $_SERVER['REMOTE_ADDR'];
	$hostname=gethostbyaddr($remoteip);
	if($remoteip!=$hostname)
		$remotehostname = $hostname;





/*
// Recupera los nombres de las tiendas
$colsarr = array("inmu_gdat.nombreinmu"); 
$numcols = count($colsarr);
$aff_table = "inmu_gdat";



$result_1 = simp_query($numcols, $colsarr, $aff_table, $where_clause, $order, $dir, $limit); */

// $cadena = "Windows";

// $i = "1";
// while ($row_1=mysql_fetch_row($result_1)) {
	if(stristr($client_a, $ntpass) == TRUE) {
//		echo "$i $row_1[0] Aparece una vez en la cadena<br />";
		$clientagent = $row_1[0];
	} // else {
//		echo "$i $row_1[0] No aparece en la cadena<br />";
//	}
// echo "Se repite<br />";

// $i++;
// } // Cierre de While

	if ($clientagent == "") {
		$clientagent = $client_a;
	}


	// Consulta ID de los inmuebles
	$cols_arr = array("inmu_gdat.idinmu");
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("inmu_gdat");
	$num_tables = count($tables_arr);
	$where_clause = "inmu_gdat.nombreinmu = '$ntpass'";

	// Funcion general de consulta SELECT
	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	$row=mysql_fetch_row($result);

	// Insertar los datos en la base de datos
	$colsarr = array("sprv_vist.idvisita", "sprv_vist.iduser", "sprv_vist.idarea", "sprv_vist.idinmu", "sprv_vist.`desc`", "sprv_vist.detalle", "sprv_vist.fechahora", "sprv_vist.remoteip", "sprv_vist.remoteport", "sprv_vist.remotehostname", "sprv_vist.clientagent");
	$numcols = count($colsarr);
	$valarr = array("NULL", "'$iduser'", "'$iduserarea'", "'$row[0]'", "'$desc'", "'$detalle'", "CURRENT_TIMESTAMP", "'$remoteip'", "'$remoteport'", "'$remotehostname'", "'$clientagent'");
	$aff_table = "sprv_vist";

	$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table);

?>
<br />
<p class="tittextvisitadet"><?php echo "$compltusrname"; ?> Tu Reporte de Visita ha sido enviado a la base de datos.
<br />La visita que diste de alta se agregó a la lista de visitas.
<br />
Da clic en el bot&oacute;n para continuar</p>
<form id="form1" name="form1" method="post" action="inicio_reportevisita.php" target="_self">
  &nbsp;&nbsp;&nbsp;<input type="submit" name="button1" id="button1" value="Continuar" />
</form>
<p class="tittextvisitadet">&nbsp;</p>
</body>
</html>
