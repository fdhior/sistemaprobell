<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../../../css/sistemaprobell.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
  <?php

$idv = $_GET['idv'];

	include "consultas.php";
	
	// Armado de la consulta 
	$cols_arr = array("gnrl_usrs.nombre", "inmu_gdat.nombreinmu", "gnrl_area.area", "sprv_vist.`desc`", "sprv_vist.detalle", "sprv_vist.fechahora");
	$num_cols = count($cols_arr);
	$join_tables = '1';
	$tables_arr = array("sprv_vist", "inmu_gdat", "gnrl_usrs", "gnrl_area");
	$num_tables = count($tables_arr);
	$connect = '0';
	$on_fields_arr = array("idinmu", "iduser", "idarea");	
	$where_clause = "idvisita = '$idv'";
	$order = "sprv_vist.fechahora";
	$dir = "DESC";

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
$row=mysql_fetch_row($result)

?>
<br />
<table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr align="left">
    <td width="500" scope="col"><span class="tittextvisitadet">Detalle de Visita No <?php echo "$idv"; ?></span></td>
    <td width="300" scope="col"><span class="tittextvisitadet">Fecha/Hora: </span><span class="parftextvisitadet"><?php echo "$row[5]"; ?></span></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Supervisor: </span><span class="parftextvisitadet"><?php echo "$row[0]"; ?></span></td>
    <td><span class="tittextvisitadet">Tipo de Visita: </span><span class="parftextvisitadet"><?php echo "$row[2]";	?></span></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Tienda: </span><span class="parftextvisitadet"><?php echo "$row[1]"; ?></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Descripci&oacute;n: </span><span class="parftextvisitadet"><?php echo "$row[3]"; ?></span></td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr align="left" valign="top">
    <td scope="col"><span class="tittextvisitadet">DETALLES: </span></td>
  </tr>
  <tr align="left" valign="top">
    <td scope="col"><span class="parftextvisitadet"><?php echo "<b>$row[4]</b>"; ?></span></td>
  </tr>
</table>
</td>
</tr>
</table>
</body>
</html>
