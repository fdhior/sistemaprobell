<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
  <?php

$idv = $_GET['idv'];
	include "consultas.php";
	
	$cols_arr = array("gnrl_usrs.iduser", "gnrl_usrs.username", "gnrl_area.area", "gnrl_usrs.nombre", "gnrl_usrs.correoe", "gnrl_usrs.usa_sprv", "gnrl_usrs.usa_man", "gnrl_usrs.usa_sol", "gnrl_usrs.usa_conf");
	$num_cols = count($cols_arr);
	$join_tables = '1';
	$tables_arr = array("gnrl_usrs", "gnrl_tusr", "gnrl_area");
	$num_tables = count($tables_arr);
	$connect = '0';
	$on_fields_arr = array("idtusr", "idarea");
	$where_clause = "gnrl_usrs.iduser = $idv";	
//	$order = "gnrl_usrs.iduser";
//	$dir = "ASC";

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
	$row=mysql_fetch_row($result)

?>
<br />
<table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr align="left">
      <td width="400" scope="col"><span class="tittextvisitadet"><strong>DATOS</strong></span></td>
	  <td width="400" scope="col"><span class="tittextvisitadet"><strong>PERMISOS</strong></span></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Usuario No.: <?php echo "$row[0]"; ?></span></td>
    <td><span class="tittextvisitadet">Usa Modulo Supervisión: <?php echo "$row[5]"; ?></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Nombre Usuario: <?php echo "$row[1]"; ?></span></td>
    <td><span class="tittextvisitadet">Usa Modulo Sistemas: <?php echo "$row[6]"; ?></span></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Area: <?php echo "$row[2]"; ?></span></td>
    <td><span class="tittextvisitadet">Usa Modulo Soluciones: <?php echo "$row[7]"; ?></span></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Nombre Supervisor: <?php echo "$row[3]"; ?></span></td>
    <td><span class="tittextvisitadet">Usa Modulo Configuración: <?php echo "$row[8]"; ?></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Correo-e: <?php echo "$row[4]"; ?></span></td>
    
<?php

	$cols_arr = array("count(idvisita)");
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("sprv_vist");
	$num_tables = count($tables_arr);
//	$connect = '0';
//	$on_fields_arr = array("idtusr", "idarea");
	$where_clause = "sprv_vist.iduser = $idv";	
//	$order = "gnrl_usrs.iduser";
//	$dir = "ASC";

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
	$row=mysql_fetch_row($result)
?>
    
    <td><span class="tittextvisitadet">N&uacute;mero Total de Visitas: <?php echo "$row[0]"; ?></td>
  </tr>

</table>
<p>&nbsp;</p>
</body>
</html>
