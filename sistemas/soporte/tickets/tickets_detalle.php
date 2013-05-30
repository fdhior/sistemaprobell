<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../../../css/sistemaprobell.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 " />
<title>Untitled Document</title>
</head>

<body>
<?php

	$idp = $_GET['idp'];

	include "consultas.php";

	// Armado de la consulta 
	$cols_arr = array("gnrl_usrs.nombre", "inmu_gdat.nombreinmu", "gnrl_area.area", "sprt_aysl.`desc`", "sprt_aysl.detalle", "sprt_aysl.fechaalta", "sprt_aysl.fechafin", "sprt_aysl.atendido");
	$num_cols = count($cols_arr);
	$join_tables = '1';
	$tables_arr = array("sprt_aysl", "inmu_gdat", "gnrl_usrs", "gnrl_area");
	$num_tables = count($tables_arr);
	$connect = '0';
	$on_fields_arr = array("idinmu", "iduser", "idarea");	
	$where_clause = "sprt_aysl.idpend = '$idp'";
	$order = "sprt_aysl.fechaalta";
	$dir = "DESC";


	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	$row=mysql_fetch_row($result);

	// Armado de la consulta 
	$cols_arr = array("gnrl_usrs.nombre");
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("gnrl_usrs");
	$num_tables = count($tables_arr);
//	$connect = '0';
//	$on_fields_arr = array("idinmu", "iduser", "idarea");	
	$where_clause = "gnrl_usrs.iduser = '$row[7]'";
	$order = "gnrl_usrs.iduser";
	$dir = "ASC";

	$result_1 = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	$row_1 = mysql_fetch_row($result_1);

/*
	//	 					row0	         row1        row2       row3       row4        row5        row6     
	$colsarr = array("gnrl_usrs.nombre", "concierne", "tipopend", "`desc`", "detalle", "fechaalta", "fechafin");
	$numcols = count($colsarr);
	$aff_table1 = "sprv_pend";
	$afftable2 = "gnrl_usrs";
	$on_field1 = "gnrl_usrs.iduser";
	$onfield2 = "sprv_pend.iduser";
	$where_clause = "idpend = '$idp'";
	$order = "fechaalta";
	$dir = "DESC";

	// Llama a la función de las consultas
	$result = innerj_query($numcols, $colsarr, $aff_table1, $afftable2, $on_field1, $onfield2, $where_clause, $order, $dir, $limit); */



?>
<br />
<table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr align="left">
    <td width="500" scope="col"><span class="tittextvisitadet">Pendiente No: <?php echo "$idp"; ?></span></td>
    <td width="300" scope="col"><span class="tittextvisitadet">Fecha De Alta: </span><span class="parftextvisitadet"><?php echo "$row[5]"; ?></span></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Supervisor que dio de alta: </span><span class="parftextvisitadet"><?php echo "$row[0]"; ?></span></td>
    <td><span class="tittextvisitadet">Fecha Concluido: </span><span class="parftextvisitadet">
	<?php
		if ($row[6] == "0000-00-00 00:00:00") {
			echo "N/A";
		} else {
			echo "$row[6]";
		}		
	?></span></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Pendiente En: </span><span class="parftextvisitadet"><?php echo "$row[1]"; ?></span></td>
    <td><span class="tittextvisitadet">Tipo de Pendiente: </span><span class="parftextvisitadet"><?php echo "$row[2]"; ?></span></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Descripci&oacute;n breve: </span><span class="parftextvisitadet"><?php echo "$row[3]"; ?></span></td>
    <td><span class="tittextvisitadet">Atendido por: </span><span class="parftextvisitadet">
	<?php
		if ($row_1[0] == "") {
			echo "Sin Atender";
		} else { // cierre de if
			echo "$row_1[0]";
		} // cierre de else	 
 	?></span></td>
  </tr>
</table>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr align="left" valign="top">
    <td scope="col"><span class="tittextvisitadet">DETALLES:</span><br /></td>
  </tr>
  <tr align="left" valign="top">
    <td scope="col"><span class="tittextvisitadet"><?php echo "<b>$row[4]</b>"; ?></span></td>
  </tr>
</table>
</td>
</tr>
</table>
</body>
</html>
