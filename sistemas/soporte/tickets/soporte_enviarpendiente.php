<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>
<?php
	session_start();
	include "consultas.php";

	// Variables $_SESSION a locales
	$iduser     = $_SESSION['iduser'];    // ID del usuario de la sesión
	$iduserarea = $_SESSION['idusrarea']; // Area del ususario de la sesión

//	$modo = $_POST['modo'];

	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			${$nombre} = $valor;
		}
	} // Cierre foreach	


	// Muestra los valores $_POST
/*	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre Variable: <b>$nombre</b> Valor: <b>$valor</b><br />"; 
		}	
	} */

// if ($modo == "insertapend") {
	
//	$tipousr = $_SESSION['tipousr'];
//	$prioripass = $_POST['prioripass'];
	switch ($prioripass) {
		case "Urgente":
			$prioripass = "1";
			break;
		case "Normal":
			$prioripass = "2";
			break;
		case "Baja":
			$prioripass = "3";
			break;
	}	

/* 	$penpass = $_POST['penpass'];
	switch ($penpass) {
		case "Tienda":
			$penpass = "0";
			break;
		case "Ofcina":
			$penpass = "1";
			break;
		case "Otro":
			$penpass = "2";
			break;
	}	*/

//	$tipopend = $_POST['tipopend'];
/*	switch ($tipopend) {
		case "General":
			$tipopend = "G";
			break;
		case "Personal":
			$tipopend = "P";
			break;
	}	*/

//	$desc = $_POST['desc'];
//	$detalle = $_POST['detalle'];

/*	if ($tipousr == 'M') {	
		$parea = "0";
	} else {	
		$parea = "1";
	} */
		

	// Consulta ID de los inmuebles
	$cols_arr = array("inmu_gdat.idinmu");
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("inmu_gdat");
	$num_tables = count($tables_arr);
	$where_clause = "inmu_gdat.nombreinmu = '$ninmpass'";

	// Funcion general de consulta SELECT
	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
	$row=mysql_fetch_row($result);		
		
		
	// Insertar los datos en la base de datos
	$colsarr = array("sprv_pend.idpend", "sprv_pend.iduser", "sprv_pend.idarea", "sprv_pend.idinmu", "sprv_pend.`desc`", "sprv_pend.detalle", "sprv_pend.fechaalta", "sprv_pend.fechafin", "sprv_pend.idseg", "sprv_pend.idprioridad");
	$numcols = count($colsarr);
	$valarr = array("NULL", "'$iduser'", "'$iduserarea'", "'$row[0]'", "'$desc'", "'$detalle'", "CURRENT_TIMESTAMP", "'0000-00-00 00:00:00'", "'1'", "'$prioripass'");
	$aff_table = "sprv_pend";

	// Llama a la función que "arma" las consultas
	$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table);
		
		

?>
<br />
<p class="tittextvisitadet"><?php echo "$compltusrname"; ?> El pendiente ha sido agregado a la base de datos.
<br />¿Deseas agregar otro pendiente?</p>
<table width="100" border="0">
  <tr>
    <th><form id="form1" name="form1" method="post" action="iniciolinker.php?linkid=S_3&agrpend=1" target="_top">
      <label>
      &nbsp;&nbsp;<input type="submit" name="button" id="button" value="SI" accesskey="s" />
      </label>
            </form>    </th>
    <th><form id="form2" name="form2" method="post" action="iniciolinker.php?linkid=S_3" target="_top">
    <input type="submit" name="button2" id="button2" value="NO" />
    </form></th>
  </tr>
</table>
<p class="tittextvisitadet"><br />
</p>
<?php
//} // Cierre de if agregar pendiente
?>
</body>
</html>
