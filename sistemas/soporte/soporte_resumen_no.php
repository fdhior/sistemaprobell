<link rel="stylesheet" type="text/css" href="styles.css" />

<?php
include "consultas.php";
$loggeduser = $_SESSION['compltusrname'];
$idusrarea = $_SESSION['idusrarea'];
$tipousr = $_SESSION['tipousr'];
$iduser = $_SESSION['iduser'];


?>

<br />

<p>
<h2> <?php echo $loggeduser; ?>, RESUMEN Soporte T&eacute;cnico:<br />
</h2>
</p>
<p class="parrafo-2">Han habido las siguientes visitas a las tiendas (ultimas 3)</p>
<p class="parrafo-2">&nbsp;</p>

<!-- TABLA DE ULTIMAS VISITAS -->
<table class="posiciontablaresumen" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td class="letratablaresumen" align="left">Supervisor</td>
    <td class="letratablaresumen" align="left">Tienda</td>
    <td class="letratablaresumen" align="left">Descripci&oacute;n</td>
    <td class="letratablaresumen" align="center">Fecha/Hora</td>
    <td class="letratablaresumen" align="center">Detalle</td>
  </tr>  


<?php
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

// $result = innerj3_query($numcols, $colsarr, $aff_table1, $aff_table2, $aff_table3, $on_field1, $on_field2, $on_field3, $on_field4, $where_clause, $order, $dir, $limit);


$fontsize='1';

while($row=mysql_fetch_row($result)){
  $upname = strtoupper($row[2]);
?>
  <tr>
    <td class="letratablaresumen" align="left"><?php echo "$row[1]"; ?></td>
    <td class="letratablaresumen" align="left"><?php echo "$upname"; ?></td>
    <td class="letratablaresumen" align="left"><?php echo "$row[3]"; ?></td>
    <td class="letratablaresumen" align="center"><?php echo "$row[4]"; ?></td>
    <td class="letratablaresumen" align="center"><a href="iniciolinker.php?linkid=S_1&idvisit=<?php echo "$row[0]"; ?>" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Detalles</a></td>
  </tr>
  <?php
} // cierre de While
?>
</table>

<!-- TERMINA TABLA DE ULTIMAS VISITAS -->
<p class="parrafo-2">&nbsp;</p>
<p class="parrafo-2">Tienes los siguientes pendientes</p>
<p class="parrafo-2">&nbsp;</p>


<!-- TABLA DE ULTIMOS PENDIENTES -->
<table class="posiciontablaresumen" border="0" cellpadding="0" cellspacing="0">
 <tr>
	<td class="letratablaresumen" align="center">Prioridad</td>
    <td class="letratablaresumen" align="center">Pendiente En</td>
    <td class="letratablaresumen" align="left">Descripci&oacute;n</td>
    <td class="letratablaresumen" align="center">Fecha de Alta</td>
    <td class="letratablaresumen" align="center">Seguimiento</td>
    <td class="letratablaresumen" align="center">Detalle</td>
  </tr>
<?php
	// Consulta ultimos pendientes
	$cols_arr = array("sprv_pend.idpend", "sprv_prio.prioridad", "inmu_gdat.nombreinmu", "sprv_pend.`desc`", "sprv_pend.fechaalta",  "sprv_vseg.seguimiento");
	$num_cols = count($cols_arr);
	$join_tables = '1';
	$tables_arr = array("sprv_pend", "inmu_gdat", "sprv_vseg", "sprv_prio");
	$num_tables = count($tables_arr);
	$connect = '0';
	$on_fields_arr = array("idinmu", "idseg", "idprioridad");	
	$where_clause = "sprv_pend.idarea = '$idusrarea'";
	$order = "sprv_pend.fechaalta";
	$dir = "DESC";
	$limit = "3";

	// Consulta Ultimos Pendientes
	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	while($row=mysql_fetch_row($result)){
//	$upname = strtoupper($row[2]);
?>
  <tr>
	<td class="letratablaresumen" align="center"><?php echo "$row[1]" ?>
		<?php
/*		switch ($row[1]) {
			case "0":
				echo "URGENTE";
				break;
			case "1":
				echo "NORMAL";
				break;
			case "2":
				echo "BAJA";
				break;
			}		
			
*/		?></td>
    <td class="letratablaresumen" align="center"><?php echo "$row[2]" ?>
	<?php
/*	switch ($upname) {
		case "0":
			echo "Tienda";
			break;
		case "1":
			echo "Oficina";
			break;
		case "2":
			echo "Otro";
			break;
	} */
	?></td>
    <td class="letratablaresumen" align="left"><?php echo "$row[3]"; ?></td>
    <td class="letratablaresumen" align="center"><?php echo "$row[4]"; ?></td>
    <td class="letratablaresumen" align="center"><?php echo "$row[5]"; ?>
	<?php
/*		switch ($row[6]) {
			case "PA":
				echo "Por Atender";
				break;
			case "EP":
				echo "En Proceso";
				break;
			case "C":
				echo "Concluido";
				break;
		}*/
	?></td>
    <td class="letratablaresumen" align="center"><a href="iniciolinker.php?linkid=S_2&idpend=<?php echo "$row[0]"; ?>" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Detalles</a></td>
  </tr>
<?php
}// Cierre de while 

?>
</table>
<p class="parrafo-2">&nbsp;</p>
<p class="parrafo-2">Se han recibido las siguientes solicitudes de ayuda:</p>
<p class="parrafo-2">&nbsp;</p>

<!-- TABLA DE ULTIMOS MENSAJES -->
<table class="posiciontablaresumen" align="left" cellpadding="0" cellspacing="0">
 <tr>
	<td class="letratablaresumen" align="center">Prioridad</td>
    <td class="letratablaresumen" align="center">Remitente</td>
    <td class="letratablaresumen" align="center">Asunto</td>
    <td class="letratablaresumen" align="center">Recibido</td>
    <td class="letratablaresumen" align="center">Ver Detalle</td>
  </tr>





<?php


	// Recupera los ultimos mensajes recibidos 
	$cols_arr = array("msjs_msgs.idmensaje", "sprv_prio.prioridad", "inmu_gdat.nombreinmu", "msjs_msgs.asunto", "msjs_msgs.fechahora");
	$num_cols = count($cols_arr);
	$join_tables = '1';
	$tables_arr = array("msjs_msgs", "inmu_gdat", "sprv_prio");
	$num_tables = count($tables_arr);
	$connect = '0';
	$on_fields_arr = array("idinmu", "idprioridad");	
	$where_clause = "msjs_msgs.leido = '0' and msjs_msgs.iduser = '$iduser'";
	$order = "msjs_msgs.fechahora";
	$dir = "DESC";
	$limit = "3";

	// Consulte Ultimos Mensajes
	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);


$fontsize='1';

while($row=mysql_fetch_row($result)){
//  $upname = strtoupper($row[0]);
?>  
	<tr>
   	<td class="letratablaresumen" align="center"><?php /* prioridad */ echo "$row[1]"; ?></td>
	<td class="letratablaresumen" align="center"><?php /* Remitente */ echo "$row[2]"; ?></td>
	<td class="letratablaresumen" align="center"><?php /* Asunto    */ echo "$row[3]"; ?></td>
	<td class="letratablaresumen" align="center"><?php /* Recibido  */ echo "$row[4]"; ?></td>
    <td class="letratablaresumen" align="center"><a href="iniciolinker.php?linkid=6&idt=$row[1]&muestra=equiposdetalle" onMouseover="return hidestatus()" onClick="return hidestatus()">Ver Ticket</a></td>
    </tr>
<?php
} // Cierre de While
?>
</table>    
