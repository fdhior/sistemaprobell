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
	
	
	// Armado de la consulta 
	$cols_arr = array("gnrl_usrs.nombre", "inmu_gdat.nombreinmu", "gnrl_area.area", "sprv_vist.`desc`", "sprv_vist.detalle", "sprv_vist.fechahora", "sprv_vist.remoteip", "sprv_vist.remoteport", "sprv_vist.remotehostname", "sprv_vist.clientagent");
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
	
	
//                           0               1            2          3          4          5              6            7  
/*	$colsarr = array("gnrl_usrs.nombre", "nombret", "tipovisita", "`desc`", "detalle", "fechahora",  "remoteip", "remoteport", "remotehostname", "clientagent");
	$numcols = count($colsarr);
	$aff_table1 = "mant_equipos";
	$aff_table2 = "sprv_visitas";
	$aff_table3 = "gnrl_usrs";
	$on_field1 = "mant_equipos.idtienda";
	$on_field2 = "sprv_visitas.idtienda";
	$on_field3 = "gnrl_usrs.iduser";
	$on_field4 = "sprv_visitas.iduser";
	$where_clause = "idvisita = '$idv'";
	$order = "fechahora";
	$dir = "DESC";

	// Llama a la función de las consultas
	$result = innerj3_query($numcols, $colsarr, $aff_table1, $aff_table2, $aff_table3, $on_field1, $on_field2, $on_field3, $on_field4, $where_clause, $order, $dir, $limit); */

	$row=mysql_fetch_row($result)

?>
<br />
<table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr align="left">
    <td width="400" scope="col"><span class="tittextvisitadet">Detalle de Visita No <?php echo "$idv"; ?></span></td>
    <td width="400" scope="col"><span class="tittextvisitadet">Fecha/Hora: </span><span class="parftextvisitadet"><?php echo "$row[5]"; ?></span></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Supervisor: </span><span class="parftextvisitadet"><?php echo "$row[0]"; ?></span></td>
    <td><span class="tittextvisitadet">Tipo de Visita: </span><span class="parftextvisitadet"><?php echo "$row[2]";	?></span></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Tienda: </span><span class="parftextvisitadet"><?php echo "$row[1]"; ?></span></td>
    <td><span class="tittextvisitadet">Enviado desde la IP Publica: </span><span class="parftextvisitadet"><?php echo "$row[6]"; ?></span></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet">Descripci&oacute;n: </span><span class="parftextvisitadet"><?php echo "$row[3]"; ?></span></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="46%"><span class="tittextvisitadet">Puerto Remoto: </span><span class="parftextvisitadet"><?php echo "$row[7]"; ?></span></td>
          <td width="54%"><span class="tittextvisitadet">Host Remoto: </span><span class="parftextvisitadet"><?php echo "$row[8]"; ?></span></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="tittextvisitadet"><strong><span class="parftextvisitadet"><b>Cadena de verificación: </b><?php echo "$row[9]"; ?></span></strong></span></td>
  </tr>
  <tr>
    <td><span class="tittextvisitadet"><strong>Detalle de la visita: </strong></span><span class="parftextvisitadet"><?php echo "$row[4]"; ?></span></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
