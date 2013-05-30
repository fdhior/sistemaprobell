
<style type="text/css">
<!--
.tipoletra {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;		
}

-->
</style>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
    
<?php 
include "consultas.php";
// session_start();
// $tipousr = $_SESSION['tipousr'];

//echo "$tipouser";


// Convertir $_POST['busqueda'] en local
if (isset ($_POST['busqueda'])) {
	$busqueda =  $_POST['busqueda'];
} // cierre if isset busqueda	

if ($busqueda == "portienda") {
	$ntpass = $_POST['ntpass'];
}	

if ($busqueda == "porsuperv") {
	$nspass = $_POST['nspass'];
}	

if ($busqueda == "portipov") {
	$tipovisit = $_POST['tipovisit'];
	switch ($tipovisit) {
		case "Supervision":
			$tipovisit = "S";
			break;
		case "Sistemas":
			$tipovisit = "M";
			break;
	}	 
}	

if ($busqueda == "pordesc") {
	$descbusc = $_POST['descbusc'];
}	

if ($busqueda == "porfecha") {
	$fechabusc = $_POST['fechabusc'];
}	

if ($busqueda == "porrangofech") {
	$fechaini = $_POST['fechaini'];
	$fechafin = $_POST['fechafin'];
}	


	// Definicion de los parametros de la consulta
	// Definicion de los parametros de la consulta
	$cols_arr = array("sprv_vist.idvisita", "gnrl_usrs.nombre", "inmu_gdat.nombreinmu", "gnrl_area.area", "sprv_vist.`desc`", "sprv_vist.fechahora", "remotehostname");
	$num_cols = count($cols_arr);
	$join_tables = '1';
	$tables_arr = array("sprv_vist", "inmu_gdat", "gnrl_usrs", "gnrl_area");
	$num_tables = count($tables_arr);
	$connect = '0';
	$on_fields_arr = array("idinmu", "iduser", "idarea");	
	$order = "sprv_vist.fechahora";
	$dir = "DESC";


if (!isset ($_POST['busqueda'])) { 

/*	if ($tipousr == "M") {
		$where_clause = "tipousr = 'M'";
	} else {
		$where_clause = "tipousr = 'S'";
	}*/

	$where_clause = "idvisita > 0";
	$order = "fechahora";
	$dir = "DESC";
} // cierrre if nobusqueda	

// echo "$busqueda";

if ($busqueda == "portienda") { 
	$where_clause = "nombret = '$ntpass'";
	$order = "fechahora";
	$dir = "DESC";
} // cierre if portienda

if ($busqueda == "porsuperv") { 
	$where_clause = "gnrl_usrs.nombre = '$nspass'";
	$order = "fechahora";
	$dir = "ASC";
} // cierre if portienda

if ($busqueda == "portipov") { 
	$where_clause = "tipovisita = '$tipovisit'";
	$order = "fechahora";
	$dir = "ASC";
} // cierre if portienda

if ($busqueda == "pordesc") { 
	$where_clause = "`desc` like '%$descbusc%' or `detalle` like '%$descbusc%'";
	$order = "fechahora";
	$dir = "ASC";
} // cierre if pordesc

if ($busqueda == "porfecha") { 
	$where_clause = "fechahora = '$fechabusc'";
	$order = "fechahora";
	$dir = "ASC";
} // cierre if porfecha

if ($busqueda == "porrangofech") { 
	$where_clause = "fechahora between '$fechaini' and '$fechafin'";
	$order = "fechahora";
	$dir = "ASC";
} // cierre if porfecha


	// Llama a la función de las consultas
	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);


	while($row=mysql_fetch_row($result)){
  	$upname = strtoupper($row[2]);
?>  
	<tr bgcolor="#FFFFFF">
        <th width="3%" scope="col"><span class="tipoletra"><?php echo "$row[0]"; ?></span></th>
        <th width="18%" scope="col"><span class="tipoletra"><?php echo "$row[1]"; ?></span></th>
        <th width="18%" scope="col"><span class="tipoletra"><?php echo "$upname"; ?></span></th>
    <th width="9%" scope="col"><span class="tipoletra"><?php echo "$row[3]"; ?></span></th>
        <th width="15%" scope="col"><span class="tipoletra"><?php echo "$row[4]"; ?></span></th>
        <th width="15%" scope="col"><span class="tipoletra"><?php echo "$row[5]"; ?></span></th>
        <th width="15%" scope="col"><span class="tipoletra"><?php echo "$row[6]"; ?></span></th>
      <th width="10%" scope="col"><span class="tipoletra"><a href="inicio_visitdetext.php?idv=<?php echo "$row[0]"; ?>" target="muestra_acciones">Ver Detalles</a></span></th>
  </tr>
<?php
} // Cierre de While
?>
</table> 

<?php
if (isset ($_POST['busqueda'])) {
	if (mysql_num_rows($result) < 1) {
?>

 	<table align="center" width="100%" border="1" cellpadding="0" cellspacing="0">	
	<tr>
		<td scope="col"><span class="tipoletra">No se encontraron resultados para esta busqueda</span></td>
	</tr>
</table>
<?php
	} // Cierre de if norows
} // Cierre de if busqueda	

?>
    

