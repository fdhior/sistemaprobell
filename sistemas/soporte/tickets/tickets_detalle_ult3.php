<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../../../css/sistemaprobell.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p class="tittextvisitadet">Ultimos 3 Pendientes aun sin atender.</p>
<table class="posiciontablaresbox" border="2" cellpadding="2" cellspacing="0">
 <tr>
	<td class="letratablaresumen" align="center">Prioridad</td>
    <td class="letratablaresumen" align="center">Pendiente En</td>
    <td class="letratablaresumen" align="center">Descripci&oacute;n</td>
    <td class="letratablaresumen" align="center">Fecha de Alta</td>
    <td class="letratablaresumen" align="center">Seguimiento</td>
    <td class="letratablaresumen" align="center">Detalle</td>
  </tr>
<?php
session_start();
$iduser = $_SESSION['iduser'];
$tipousr = $_SESSION['tipousr'];
$iduser = $_SESSION['iduser'];
$idusrarea = $_SESSION['idusrarea'];


include "consultas.php";


	// Consulta ultimos pendientes
	$cols_arr = array("sprt_aysl.idpend", "sprv_prio.prioridad", "inmu_gdat.nombreinmu", "sprt_aysl.`desc`", "sprt_aysl.fechaalta",  "sprv_vseg.seguimiento");
	$num_cols = count($cols_arr);
	$join_tables = '1';
	$tables_arr = array("sprt_aysl", "inmu_gdat", "sprv_vseg", "sprv_prio");
	$num_tables = count($tables_arr);
	$connect = '0';
	$on_fields_arr = array("idinmu", "idseg", "idprioridad");	
	$where_clause = "sprt_aysl.idarea = '$idusrarea'";
	$order = "sprt_aysl.idprioridad, sprt_aysl.idalta, sprt_aysl.fechaalta";
	$dir = "DESC";
	$limit = "3";

	// Consulta Ultimos Pendientes
	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

$fontsize='1';

while($row=mysql_fetch_row($result)){
  $upname = strtoupper($row[2]);
?>
  <tr>
	<td class="letratablaresumen" align="center"><?php echo "$row[1]"; // Prioridad    ?></td> 
    <td class="letratablaresumen" align="center"><?php echo	"$upname"; // Pendiente en ?></td>
    <td class="letratablaresumen" align="center"><?php echo "$row[3]"; // Descripcion  ?></td>
    <td class="letratablaresumen" align="center"><?php echo "$row[4]"; // Fecha Alta   ?></td>
    <td class="letratablaresumen" align="center"><?php echo "$row[5]"; // Seguimiento  ?></td>
    <td class="letratablaresumen" align="center"><a href="inicio_penddet.php?idp=<?php echo "$row[0]"; ?>" target="penddet">Ver Detalle</a></td>
  </tr>
  <?php
} // cierre de While
?>
</table>
<p><span class="tittextvisitadet"> Tambien puedes ver detalles de Pendientes De otras fechas en la lista completa</span><br />
<span class="tittextvisitadet">O se puede realizar una busqueda dando click en: BUSCAR PENDIENTES</span></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>

</html>
