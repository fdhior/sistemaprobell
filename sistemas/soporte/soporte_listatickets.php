
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
	session_start();
	// $tipousr = $_SESSION['tipousr'];
	$idusrarea = $_SESSION['idusrarea'];
	//echo "$tipouser";

	// Convertir las variables $_POST en locales
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			${$nombre} = $valor;
		}
	} // Cierre foreach	

    // Mostrar los valores de $_POST
/*	echo "Valores de _POST <br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la Variable: <b>$nombre</b> Valor: <b>$valor</b><br />"; 
		}
	}*/

	// Definicion de los parametros de la consulta
	$cols_arr = array("sprv_vist.idvisita", "gnrl_usrs.nombre", "inmu_gdat.nombreinmu", "gnrl_area.area", "sprv_vist.`desc`", "sprv_vist.fechahora");
	$num_cols = count($cols_arr);
	$join_tables = '1';
	$tables_arr = array("sprv_vist", "inmu_gdat", "gnrl_usrs", "gnrl_area");
	$num_tables = count($tables_arr);
	$connect = '0';
	$on_fields_arr = array("idinmu", "iduser", "idarea");	
	$order = "sprv_vist.fechahora";
	$dir = "DESC";

// ---------------------------- INICIO EVALUACIONES DE BUSQUEDA ------------------------------------------------
// Se determina que buscar modificando la variable where_clausa

	// Patrón reutilizable de busqueda
	$buscpattern1 = "sprv_vist.idarea = '$idusrarea'";
	
	// Si no se define una busqueda
	if (!isset ($busqueda)) { 
		$where_clause = $buscpattern1." AND sprv_vist.idvisita > 0";
	} else { // cierrre if nobusqueda inicio else
		switch ($busqueda) { // Inicio switch ($busqueda)
			case "portienda":	
				$where_clause = $buscpattern1." AND inmu_gdat.nombreinmu = '$ntpass'";
				break;	
			case "porsuperv":
				$where_clause = $buscpattern1." AND gnrl_usrs.nombre = '$nspass'";
				break;
			case "portipov":
				$where_clause = $buscpattern1." AND gnrl_area.area = '$tipovisit'";
				break;
			case "pordesc": 
				$where_clause = $buscpattern1." AND sprv_vist.`desc` like '%$descbusc%' or `detalle` like '%$descbusc%'";
				break;
			case "porfecha":
				$where_clause = $buscpattern1." AND sprv_vist.fechahora like '%$fechabusc%'";
				break;
			case "porrangofech":
				$where_clause = $buscpattern1." AND sprv_vist.fechahora between '$fechaini' AND '$fechafin'";
				break;
			case "poridt":
				$where_clause = $buscpattern1." AND sprv_vist.idvisita = $idtv'";
				break;

		} // Cierre de switch		
	} // cierre else

// ---------------------------- FIN DE EVALUACIONES DE BUSQUEDA ------------------------------------------------


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
        <th width="27%" scope="col"><span class="tipoletra"><?php echo "$row[4]"; ?></span></th>
	  <th width="15%" scope="col"><span class="tipoletra"><?php echo "$row[5]"; ?></span></th>
      <th width="10%" scope="col"><span class="tipoletra"><a href="inicio_visitdet.php?idv=<?php echo "$row[0]"; ?>" target="visitdet">Ver Detalle</a></span></th>
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
// unset($ntpass);
// unset($_POST['ntpass']);
?>
    

