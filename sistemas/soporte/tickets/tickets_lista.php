<style type="text/css">
<!--
.tipoletra {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;		
}
.urgenteletra {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;
	color: #FFFFFF;
	background-color: #FF0000;
}
.normaletra {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;
	color: #FFFFFF;
	background-color: #00CC00;
}
.bajaletra {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;
	color: #FFFFFF;
	background-color: #00CCFF;
}
.naletra {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;
	color: #FFFFFF;
	background-color: #000000;
}

-->
</style>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
    
<?php 
session_start();
// $iduser = $_SESSION['iduser']; // el ID del ususario que inició sesión
$idtipousr = $_SESSION['idtipousr']; // El tipo de usuario que inició sesión
$idusrarea = $_SESSION['idusrarea']; // El Area al que pertenece el usuario que inicio sesión
if (isset($_SESSION['muestra'])) {
	$muestra = $_SESSION['muestra'];
	unset($_SESSION['muestra']);
}	 

// Convertir las variables POST en locales
foreach ($_POST as $nombre => $valor) {
	if(stristr($nombre, 'button') === FALSE) {
		${$nombre} = $valor;
	}
} // Cierre foreach	


// Convertir las variables GET en locales
foreach ($_GET as $nombre => $valor) {
	if(stristr($nombre, 'button') === FALSE) {
		${$nombre} = $valor;
	}
} // Cierre foreach	

// $muestra = $_GET['muestra'];

// Incluye la funcion consultas
include "consultas.php";


	// Mostrar los valores de _POST
	echo "Valores de _POST <br />";
	foreach ($_SERVER as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />"; 
		}
	}

/*	// Mostrar los valores de _GET
	echo "Valores de _GET <br />";
	foreach ($_GET as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />"; 
		}
	}
	
	// Mostrar los valores de _SESSION
/*	echo "Valores de _SESSION <br />";
	foreach ($_SESSION as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor, "; 
		}
	} */


// --------------------------------- INICIO BUSQUEDA --------------------------------  

	// Definición de los parametros de la consulta
	$cols_arr = array("sprt_aysl.idpend", "sprv_prio.prioridad", "sprt_alta.alta", "inmu_gdat.nombreinmu", "sprt_aysl.`desc`", "sprt_aysl.fechaalta", "sprt_aysl.fechafin", "sprv_vseg.seguimiento", "sprt_aysl.abierto");
	$num_cols = count($cols_arr);
	$join_tables = '1';
	$tables_arr = array("sprt_aysl", "inmu_gdat", "sprv_vseg", "sprv_prio", "sprt_alta");
	$num_tables = count($tables_arr);
	$connect = '0';
	$on_fields_arr = array("idinmu", "idseg", "idprioridad", "idalta");	
	$order = "sprt_aysl.idprioridad, sprt_aysl.idalta, sprt_aysl.fechaalta";
	$dir = "DESC";
	


// --------------------------------- INICIO BUSQUEDA -------------------------------- 
// Determinado la varieble $where_clause (patrón de busqueda)
//
// Patrones REUSABLES de busqueda	
$buscpattern1 = "sprt_aysl.idarea = '$idusrarea' AND sprt_aysl.idprioridad = '1' AND sprt_aysl.idseg <> 3"; // Todos los pendientes urgentes del area
$buscpattern2 =	"sprt_aysl.idarea = '$idusrarea' AND sprt_aysl.idseg <> 3"; // Pendientes Activos
$buscpattern3 = "sprt_aysl.idarea = '$idusrarea' AND sprt_aysl.idseg = 3"; // Pendientes Conlcuidos

// Mostrar Pendientes cuando no se define una busqueda y se da click en el menú pendientes
if (!isset ($_POST['busqueda'])) { // $_POST['busqueda'] no esta definida
//	if ($idtipousr == "1" or $idtipousr == "2") {
		switch ($muestra) {
			case "urgentes": // Cuando se pide mostrar todos los pendientes (del Area) 
				$where_clause = $buscpattern1;
				break;
			case "activos": // Cuando se pide mostrar los pendientes Activos
				$where_clause = $buscpattern2;
				break;
			case "concluidos": // Cuando se pide mostrar los pendientes Concluidos
				$where_clause = $buscpattern3;
     			$order = "sprt_aysl.fechafin";	
				break;
			default: // Cuando no se especifica que pendientes (sin parametros)
				$where_clause = $buscpattern2;
		} // Cierre de switch		
} // cierrre if nobusqueda	


	// Elegir el patrón de busqueda
	switch ($busqueda) {
		case "porpen":
			$add_patt = " AND inmu_gdat.nombreinmu = '$ninmpass'";
			break;
		case "pordesc":
			$add_patt = " AND sprt_aysl.`desc` like '%$descbusc%' OR sprt_aysl.detalle like '%$descbusc%'";
			break;
		case "porfecha":
			if ($modo == "concluidos") {
				$add_patt = " AND sprt_aysl.fechafin like '%$fechabusc%'";
			} else {	
	 			$add_patt = " AND sprt_aysl.fechaalta like '%$fechabusc%'";
			}
			break;
		case "porrangofech":
			if ($modo == "concluidos") {
				$add_patt = " AND sprt_aysl.fechafin between '$fechaini' and '$fechafin'";
			} else {
				$add_patt = " AND sprt_aysl.fechaalta between '$fechaini' and '$fechafin'";
			}	
			break;
		case "porseg":
			$add_patt = " AND sprv_vseg.seguimiento = '$segpass'";
			break;
		case "porprioridad":
			$add_patt = " AND sprv_prio.prioridad = '$prioripass' ";
			break;
		case "poridt":
			$add_patt = "sprt_aysl.idpend = '$idtv'";
			break;			
	}
	
	// Completa el patrón de búsqueda
	switch ($modo) {
		case "activos":
			if ($busqueda == "porseg") {	
				$where_clause = $buscpattern1.$add_patt;
			} else if ($busqueda == "poridt") {
				$where_clause = $add_patt;
			} else {
				$where_clause = $buscpattern2.$add_patt;
			}	
			break;
		case "concluidos":
			$where_clause = $buscpattern3.$add_patt;
			break;
	} // Cierre de switch		

// --------------------------- FIN BUSQUEDA ------------------------------

	// Llama a la función de las consultas
	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	while($row=mysql_fetch_row($result)){
//  	$upname = strtoupper($row[2]);
?>  
  <tr bgcolor="#FFFFFF">
  <th width="3%" scope="col"><span class="tipoletra"><?php echo "$row[0]"; ?></span></th> 
<th width="8%" scope="col">
		<?php
		if ($row[7] == "Concluido") {
			echo "<span class=\"naletra\">N/A</span>";
		} else {
			switch ($row[1]) {
				case "Urgente":
					echo "<span class=\"urgenteletra\">";
					break;
				case "Normal":
					echo "<span class=\"normaletra\">";
					break;
				case "Baja":
					echo "<span class=\"bajaletra\">";
					break;
			}		
			echo "$row[1]";
		}	
		?></span>		</th>
      <th width="8%" scope="col"><span class="tipoletra"><?php echo "$row[2]"; ?></span></th>
      <th width="16%" scope="col"><span class="tipoletra"><?php echo "$row[3]"; ?></span></th>
    <th width="30%" scope="col"><span class="tipoletra"><?php echo "$row[4]"; ?></span></th>
    <th width="14%" scope="col"><span class="tipoletra"><?php echo "$row[5]"; ?></span></th>
        <th width="14%" scope="col"><span class="tipoletra">
		<?php
		if ($row[6] == "0000-00-00 00:00:00") {
			echo "<span class=\"naletra\">N/A</span>";
		} else {
			echo "$row[6]";
		}		
		?>
		</span></th>
        <th width="10%" scope="col"><span class="tipoletra"><?php echo "$row[7]"; ?></span></th>
      <th width="5%" scope="col"><span class="tipoletra"><a href="tickets_detalle.php?idp=<?php echo "$row[0]"; ?>" target="penddet">Detalle</a></span></th>
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
    

