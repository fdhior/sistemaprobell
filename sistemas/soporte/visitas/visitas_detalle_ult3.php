<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../../../css/sistemaprobell.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p class="tittextvisitadet">Ultimas 3 Visitas Registradas. Haz click en ver los 
  detalles de las visitas en esta lista</p>
<table class="posiciontablaresbox" border="2" cellpadding="2" cellspacing="0">
  <tr> 
    <td class="letratablaresumen" align="center">Supervisor</td>
    <td class="letratablaresumen" align="left">Tienda</td>
    <td class="letratablaresumen" align="left">Descripci&oacute;n</td>
    <td class="letratablaresumen" align="center">Fecha/Hora</td>
    <td class="letratablaresumen" align="center">Detalle</td>
  </tr>  
 
<?php
	session_start();	
	$idusrarea = $_SESSION['idusrarea'];
	include "consultas.php";

	// Consulta Ultimas Visitas
	$cols_arr = array("sprv_vist.idvisita", "gnrl_usrs.nombre", "inmu_gdat.nombreinmu", "sprv_vist.`desc`", "sprv_vist.fechahora");
	$num_cols = count($cols_arr);
	$join_tables = '1';
	$tables_arr = array("sprv_vist", "inmu_gdat", "gnrl_usrs");
	$num_tables = count($tables_arr);
	$connect = '0';
	$on_fields_arr = array("idinmu", "iduser");	
	$where_clause = "sprv_vist.idvisita > 0 AND sprv_vist.idarea = '$idusrarea'";
	$order = "sprv_vist.fechahora";
	$dir = "DESC";
	$limit = "3";

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

$fontsize='1';

while($row=mysql_fetch_row($result)){
  $upname = strtoupper($row[2]);
?>
  <tr> 
    <td class="letratablaresumen" align="center">
      <?php echo "$row[1]"; ?>
    </td>
    <td class="letratablaresumen" align="left">
      <?php echo "$upname"; ?>
    </td>
    <td class="letratablaresumen" align="left">
      <?php echo "$row[3]"; ?>
    </td>
    <td class="letratablaresumen" align="center">
      <?php echo "$row[4]"; ?>
    </td>
    <td class="letratablaresumen" align="center"><a href="inicio_visitdet.php?idv=<?php echo "$row[0]"; ?>" target="visitdet">Ver 
      Detalle</a></td>
  </tr>
  <?php
} // cierre de While
?>
</table>
<br />
<p><span class="tittextvisitadet"> Tambien puedes ver detalles de visItas de otras 
  fechas en la lista completa</span><br />
  <span class="tittextvisitadet">O Rrealizar una busqueda dando click en: </span><strong>OPCIONES 
  DE BUSQUEDA</strong></p>
</body>

</html>
