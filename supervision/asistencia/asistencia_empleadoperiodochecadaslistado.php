<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.list_table {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;
	text-decoration: none;
}

.list_table_td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;
}

/* No. */
.table_td1 {
	width: 31px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
	border: 1px solid #CCC;
}

/* Foto */
.table_td2 {
	width: 100px;
    position: relative;
    left: 0px;
    text-align: center;
	padding: 0px;
	border: 1px solid #CCC;
}

/* Nombre */
.table_td3 {
	width: 130px;
    position: relative;
    left: 0px;
    text-align: center;
	padding: 0px;
	border: 1px solid #CCC;
}

/* Tipo Empleado */
.table_td4 {
    width: 100px;
    position: relative;
    left: 0px;
    text-align: center;
	padding: 0px;
	border: 1px solid #CCC;
}

/* Oficina/Tienda */
.table_td5 {
	width: 120px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
	border: 1px solid #CCC;
}

/* Contraseña */
.table_td6 {
	width: 176px;
    position: relative;
    left: 0px;
    text-align: center;
	padding: 0px;
	border: 1px solid #CCC;
}

/* Fecha Alta */
.table_td7 {
	width: 80px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
	border: 1px solid #CCC;
}

/* Estado */
.table_td8 {
	width: 80px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
	border: 1px solid #CCC;
}


.hid_td	{
	position: absolute;
	visibility: hidden;
	width: 5px;
	height: 5px;
}

.letra_boton {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-weight: normal;
	font-variant: small-caps;
}

/* Tipo Empleado */
.select1 {
	width: 90px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: small-caps;
}

/* Oficina/Tienda */ 
.select2 {
	width: 150px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: small-caps;
}

/* Estado */
.select3 {
	width: 70px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: small-caps;
}

.input1 {
	width: 90px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: normal;
}


textarea.editDirec
{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: small-caps;
	border: black 1px solid;
	width: 150px;
	height: 60px;
}

textarea.editLink
{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: small-caps;
	width: 85px;
	height: 50px;
}

#apDiv1 {
	position: absolute;
	left:0px;
	top:0px; 
	width:955px;
	height:14px;
	z-index:1;
}

/*#apDiv2 {
	position: absolute;
	left:0px;
	top:0px; 
	width:969px;
	height:16px;
	z-index:2;
	border: 1px solid #000;
}*/

-->
</style>


<?php
 // session_start();

	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';
	include $rutafunciones.'valida_fechas.php';
	date_default_timezone_set('America/Mexico_City');

	$hostname     = $_SESSION['hostname'];
	$idusrarea    = $_SESSION['idusrarea'];
	$userinmuid   = $_SESSION['userinmuid'];

	$relpath   = "supervision/asistencia/"; 
	$relpath2  = "supervision/asistencia/exportar/exportar_"; 

//	$target_link  = $hostname.$relpath2.'ventanaeligeformato.php';

	$target_link  = $hostname.$relpath2.'enviarreporte.php';


       
        if (!isset($_POST['orden'])) {
                unset($_SESSION['busq_guardada']);
                foreach ($_POST as $nombre => $valor) {
                        if(stristr($nombre, 'button') === FALSE) {
                                $_SESSION['busq_guardada'][''.$nombre.''] = $valor;
                        }
                } // Cierre foreach     
        } 
        
        if ($_POST['lista'] == "todos") {
                unset($_SESSION['busq_guardada']);
        }        

        if (isset($_SESSION['busq_guardada'])) { 
                if (isset($_POST['orden'])) {  
                        $_SESSION['busq_guardada']['orden'] = $_POST['orden'];
                } else if (!isset($_POST['orden']) && array_key_exists("orden", $_SESSION['busq_guardada'])) {                          
                        array_pop($_SESSION['busq_guardada']);
                }       
                foreach ($_SESSION['busq_guardada'] as $nombre => $valor) {
                        if(stristr($nombre, 'button') === FALSE) {
                                ${$nombre} = $valor;
                        }
                } // Cierre foreach     
        } else {
                foreach ($_GET as $nombre => $valor) {
                        if(stristr($nombre, 'button') === FALSE) {
                                ${$nombre} = $valor;
                        }
                } // Cierre foreach     
        }
?>
</head>

<body>

<?php 

/*--------------------------- PRUEBA DE VARIABLES ------------------------*/

    // Mostrar los valores de _POST
    /*echo '<p class="letra_boton">';
	echo "Valores de _GET <br />";
    foreach ($_GET as $nombre => $valor) {
    	if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
		}
	}
	echo '</p>';*/
/*---------------------- CIERRE DE PRUEBA DE VARIABLES ---------------------*/
?>	


<?php

     /*if (!isset($error) and isset($quien_busc)) {*/

		// Definicion de los parametros de la consulta
		$cols_arr      = array("COUNT(idempleado)");        //  0
		$num_cols      = count($cols_arr);
		$tables_arr    = array("gnrl_echk");

        $maxTablaRset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
			
		$maxRow=mysql_fetch_row($maxTablaRset);			
			
		// Definicion de los parametros de la consulta
		$cols_arr      = array("gnrl_echk.idempleado",        //  0
		                       "gnrl_echk.ruta_imagen",       //  1
							   "gnrl_empl.nombres",           //  2
							   "gnrl_empl.apaterno",          //  3 
							   "gnrl_empl.amaterno",          //  4
 							   "gnrl_empl.idtempleado",       //  5
							   "inmu_gdat.nombreinmu",        //  6
		                       "inmu_gdat.idfis",             //  7  
							   "gnrl_echk.checada_fecha",     //  8
							   "gnrl_echk.checada_hora",      //  9
							   "gnrl_echk.idInmuChecada");    //  10
			$num_cols      = count($cols_arr);
		   	$join_tables   = '1';
		    $tables_arr    = array("gnrl_echk",
								   "gnrl_empl",
								   "inmu_gdat");
		    $num_tables    = count($tables_arr);
			$on_fields_arr = array("idempleado", "idinmu");
			$connect       = '1';
			$order         = "gnrl_echk.checada_fecha, gnrl_echk.checada_hora";


			$where_clause = "gnrl_echk.idempleado = '$idempleado' AND periodoChecada = '$periodoChecada'";
					

    	    // Llama a la funci&oacute;n de las consultas
            $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
                
				unset($join_tables);
				unset($on_fields_arr);
				unset($connect);
				unset($order);
				unset($where_clause);
				unset($dir);



?>
<!-- </p> -->

<!-- TABLA LISTADO -->
<div id="apDiv1">
<table class="list_table" border="0" cellpadding="0" cellspacing="0">

<?php
				
				$mquery_nrows=mysql_num_rows($result);


                $i = 0;
                while($row=mysql_fetch_row($result)) {

?>

	<tr id="<?php echo "$row[0]"; ?>" class="<?php $oddevencheck = $i % 2;  
					  if ($oddevencheck == 0) {
						echo "row-even";
					  } else {
			    		echo "row-odd";
					  }
		           ?>">
    
    
        <td class="table_td1"><?php echo $row[0];                              // No. Empleado       ?></td>
        <td class="table_td2"><img src="<?php echo $hostname.$relpath.$row[1]; // Foto               ?>" width="100" height="60" /></td>
        <td class="table_td3"><?php echo $row[2].' '.$row[3].' '.$row[4];                              // Nombre Empleado    ?></td>
        <td class="table_td4"><?php 
			// Recupera el tipo de empleado
			$cols_arr     = array("tipoempleado");
			$num_cols     = count($cols_arr);
			$tables_arr   = array("gnrl_temp");
			$where_clause = "idtempleado = '$row[5]'";
		
			$temp_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
			$templeado = mysql_fetch_row($temp_rset);
			 
			echo $templeado[0];												   // Tipo de Empleado   ?></td>
        <td class="table_td5"><?php echo $row[6];                              // Tienda/Oficina     ?></td>
        <td class="table_td6"><?php 
			// Recupera el tipo de empleado
			$cols_arr     = array("razonsc");
			$num_cols     = count($cols_arr);
			$tables_arr   = array("inmu_dfis");
			$where_clause = "idfis = '$row[7]'";
		
			$dfis_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
			$rfc = mysql_fetch_row($dfis_rset);
			 
			echo $rfc[0];									 				   // RFC L. de Trabajo  ?></td> 
        <td class="table_td5"><?php 
			// Recupera el tipo de empleado
			$cols_arr     = array("nombreinmu");
			$num_cols     = count($cols_arr);
			$tables_arr   = array("inmu_gdat");
			$where_clause = "idinmu = '$row[10]'";
		
			$idinmu_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
			$idinmu_chk = mysql_fetch_row($idinmu_rset);
			 
			echo $idinmu_chk[0];									 	       // Lugar Checada      ?></td>
        <td class="table_td7"><?php echo $row[8];                              // Fecha              ?></td>
        <td class="table_td8"><?php echo $row[9];                              // Hora               ?></td>
        <!--<td class="table_td9" align="center"><?php // echo $hostname.$relpath2.$target_link; ?></td>-->

	</tr>
    
<?php
                $i++;
        } // Cierre de While

?>

</table>
</div>


<?php

		/*if (!isset($error) and isset($_POST['quien_busc']) and $mquery_nrows < 1) {
			echo '<div id="apDiv2"';
			echo '<span class="letra_predeterminada">No se encontraron resultados para esta busqueda</span>';
			echo '</div>';

		} 
	} else {// Cierre de if si no hay error


		if (isset($error)) {
			echo '<div id="apDiv2"';
			echo '<span class="letra_alertaestado_nopadd">'.$error.'</span>';
			echo '</div>';
		} else {		
			echo '<div id="apDiv2"';
			echo '<span class="letra_predeterminada">Realiza una busqueda para obtener resultados</span>';
			echo '</div>';
		}
	}*/

?> 

</body>
</html>
