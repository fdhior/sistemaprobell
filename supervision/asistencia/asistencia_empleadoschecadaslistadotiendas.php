<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

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

/* No. Usuario */

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

/* Nombres */
.table_td3 {
	width: 150px;
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
	width: 100px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
	border: 1px solid #CCC;
}

/* Estado */
.table_td6 {
	width: 181px;
	text-align: center;
	border: 1px solid #CCC;
}


/* Fecha */
.table_td7 {
	width: 150px;
    position: relative;
    left: 0px;
    text-align: center;
	padding: 0px;
	border: 1px solid #CCC;
}

/* Hora */
.table_td8 {
	width: 127px;
	text-align: center;
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

#apDiv2 {
	left: 0px;
	top: 0px;
	position: absolute;
	width:969px;
	height:16px;
	z-index:2;
	border: 1px solid #999;
}

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

	$target_link  = $hostname.$relpath2.'ventanaeligeformato.php';

       
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
                foreach ($_POST as $nombre => $valor) {
                        if(stristr($nombre, 'button') === FALSE) {
                                ${$nombre} = $valor;
                        }
                } // Cierre foreach     
        }
        


?>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
</head>

<body>


<?php 

/*--------------------------- PRUEBA DE VARIABLES ------------------------*/

    // Mostrar los valores de _POST
    /*echo '<p class="letra_boton">';
	echo "Valores de _POST <br />";
    foreach ($_POST as $nombre => $valor) {
    	if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
		}
	}
	echo '</p>';*/
/*---------------------- CIERRE DE PRUEBA DE VARIABLES ---------------------*/
?>	


<?php

/* ------------------------- INICIA VALIDACION DE DATOS ------------------ */

//	if ($usarfiltros == "on") {
        if (isset($quien_busc)) {
			switch ($quien_busc) {
				case "pornoempleado":
					if ($noempleado == '') {
						$error = "Error: Teclea un n&uacute;mero de empleado";
//						echo '<strong>'.$error.'</strong>';
					}
					break;
				case "pornombreempleado":
					if ($nempleado == '') {
						$error = "Error: Debes teclear parte o el nombre completo del empleado que buscas";
					}
					break;
				case "portodoslosemp":
					switch($de_busc) {
						case "tienda":	
							if ($sel_tienda == "Elige una Oficina/Tienda") {
								$error = "Error: Debes elegir una Tienda";
							}
							break;
						case "razonsc":
							if ($sel_razonsc == "Elige una Razon Social") {
								$error = "Error: Debes elegir una Raz&oacute;n Social";
							}
							break;
					}
					break;
			}
		}

        if (!isset($error) and isset($cuando_busc)) {
			switch ($cuando_busc) {
				case "eldia":
					if ($taldia == '') {
						$error = "Error: Debes teclear una fecha en el formato indicado, o presiona el boton [Elige Fecha] para ingresarla";
					} else {
						
						$checa_fecha = checkDateFormat($taldia);
						if ($checa_fecha == false) {
							$error  = "Error: Existe un error en la fecha introducida, el formato es AAAA-MM-DD (año, mes, dia) y debe ser v&aacute;lida";
						}
					}
					break;
				case "rango_fechas":
					$checa_fechaini = checkDateFormat($fechainicio);
					$checa_fechafin = checkDateFormat($fechafin);

					// Si alguno de los campos del rango esta vacio
					if ($fechainicio == '' or $fechafin == '') {
		            	$error  = "Debes teclear una fecha de inicio y una final en el rango";
					} else {
						// Checar si las fechas introducidas tienen algún error
						if (($checa_fechaini == false and $checa_fechafin == false) or 
						    ($checa_fechaini == true and $checa_fechafin == false) or 
							($checa_fechaini == false and $checa_fechafin == true)) {
							$error  = "Error: Existe un error en alguna fecha introducida en el rango, el formato es AAAA-MM-DD (año, mes, dia) ambas deben ser válidas";
						} else {
				
							// Comparar las fechas
							$compareres = compare_dates($fechainicio, $fechafin);

							// Si la fecha inicial es mayor a la final
							// echo "valor de compareres: $compareres";
							if ($compareres > 0) {
								$error  = "Error: La fecha inicial es mayor que la fecha final";
							}
						}
					}
					break;
			} // Cierre de Switch
		} // Cierre de If inicial
		


/* ---------------------------------------- TERMINAVALIDACION DE DATOS ---------------------------- */

     if (!isset($error) and isset($quien_busc)) {

		// Definicion de los parametros de la consulta
		$cols_arr      = array("COUNT(idempleado)");        //  0
		$num_cols      = count($cols_arr);
		$tables_arr    = array("gnrl_echk");

        $maxTablaRset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
			
		$maxRow=mysql_fetch_row($maxTablaRset);		
		
		// Definicion de los parametros de la consulta
		$cols_arr      = array("gnrl_echk.idempleado",        // 0
		                       "gnrl_echk.ruta_imagen",       // 1
							   "gnrl_empl.nombres",           // 2
							   "gnrl_empl.apaterno",          // 3 
							   "gnrl_empl.amaterno",          // 4
 							   "gnrl_empl.idtempleado",       // 5
  							   "gnrl_echk.idTipoChecada",     // 6 
							   "gnrl_echk.checada_fecha",     // 7
							   "gnrl_echk.checada_hora",      // 8
							   "gnrl_echk.idInmuChecada");    // 9
//							   "inmu_gdat.nombreinmu",        // 6
//		                       "inmu_gdat.idfis",             // 7  

			$num_cols      = count($cols_arr);
		   	$join_tables   = '1';
		    $tables_arr    = array("gnrl_empl",
								   "gnrl_echk");
		    $num_tables    = count($tables_arr);
			$on_fields_arr = array("idempleado");
			$connect       = '1';
			$order         = "gnrl_echk.checada_fecha, gnrl_echk.checada_hora";
			$dir	       = "ASC";
//      $connect = '0';
//      $on_fields_arr = array("idinmu", "iduser", "idarea");
/*               switch ($orden) {
                        case "pororigen":
                                $order = "gnrl_usrs.nombre";
                                break;
                        case "pordestino":
                                $order = "sucr_plog.destino";
                                break;
                        case "porfechaenv":
                                $order = "sucr_plog.fechahoraenvio";
                                break;
                        case "porfechadesc":
                                $order = "sucr_plog.fechadescarga";
                                break;
                        default:
                                $order = "sucr_plog.fechahoraenvio";
                }
                if ($orden == "pororigen" or $orden == "pordestino") {
                        $dir = "ASC";   
                } else {
                        $dir = "DESC";
                }   */    
        

// ---------------------------- INICIO EVALUACIONES DE BUSQUEDA ------------------------------------------------
// Se determina que buscar modificando la variable where_clausa

    // Patron reutilizable de busqueda
		
	$tpattern1 = "gnrl_empl.idempstat = 1";	
	$tpattern2 = "gnrl_empl.idempstat = 2";	
	
	switch ($quien_busc) {
		case "pornoempleado":
			$where_clause  = '(gnrl_empl.idempleado = \''.$noempleado.'\')';
			break;
		case "pornombreempleado":
			$where_clause  = '(gnrl_empl.nombres LIKE \'%'.$nempleado.'%\')';
			break;
		case "portodoslosemp":
			$where_clause = '(gnrl_empl.idempleado <= \''.$maxRow[0].'\')';
			break;
	}		

	if (isset($de_busc)) {
		switch ($de_busc) {
			case "tienda":		
				$where_clause = '(gnrl_empl.idinmu = \''.$sel_tienda.'\')'; // AND (gnrl_echk.idInmuChecada = \''.$sel_tienda.'\')';  
				break;
			case "razonsc":		
				$where_clause = '(inmu_gdat.idfis = \''.$sel_razonsc.'\')';  
				break;
			case "todos":
				$where_clause = $where_clause;  
				break;
		}
	}	


	if ($activa_tiempo == "on") {
		switch($cuando_busc) {
			case "hoy":
				$fecha_hoy = date('Y-m-d');
				$where_clause = $where_clause.' AND (gnrl_echk.checada_fecha = \''.$fecha_hoy.'\')';
				break;
			case "eldia":
				$where_clause = $where_clause.' AND (gnrl_echk.checada_fecha = \''.$taldia.'\')';
				break;
		   case "rango_fechas":
				$where_clause = $where_clause.' AND (gnrl_echk.checada_fecha BETWEEN \''.$fechainicio.'\' AND \''.$fechafin.'\')';
				break;
			case "mes_anio":
				$where_clause = $where_clause.' AND (gnrl_echk.checada_fecha like \'%'.$sel_anio.'-'.$sel_mes.'%\')';
				break;
		}
	}
	
	if ($tipo_busc == 0) { 
		$where_clause = $where_clause;
	} else {	
		$where_clause = $where_clause.' AND (gnrl_echk.idTipoChecada = \''.$tipo_busc.'\')';
	}
		
	$where_clause = $where_clause." AND (gnrl_echk.archivada = '0')";	
					

// ---------------------------- FIN DE EVALUACIONES DE BUSQUEDA ------------------------------------------------


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
        <td class="table_td5"><?php 
			// Recupera el tipo de empleado
			$cols_arr     = array("tipoChecada");
			$num_cols     = count($cols_arr);
			$tables_arr   = array("empl_tche");
			$where_clause = "idTipoChecada = '$row[6]'";
		
			$tcheck_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
			$tchecada = mysql_fetch_row($tcheck_rset);
			 
			echo $tchecada[0];												   // Tipo de Checada  ?></td>
      
      <td class="table_td6"><?php 
			// Recupera el nombre de una tienda
			$cols_arr     = array("nombreinmu");
			$num_cols     = count($cols_arr);
			$tables_arr   = array("inmu_gdat");
			$where_clause = "idinmu = '$row[9]'";
		
			$idinmu_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
			$idinmu_chk = mysql_fetch_row($idinmu_rset);
			 
			echo $idinmu_chk[0];									 	     // Lugar Checada      ?></td>   
      <td class="table_td7"><?php echo $row[7];                              // Fecha              ?></td>
      <td class="table_td8"><?php echo $row[8];                              // Hora               ?></td>
        <!--<td class="table_td9" align="center"><?php // echo $hostname.$relpath2.$target_link;   ?></td>-->

	</tr>
<?php
                $i++;
        } // Cierre de While

	if ($_POST['btExportar']) {


	$getString = 'tipo_busc='.$tipo_busc.'&quien_busc='.$quien_busc;	

	if ($noempleado <> '')  {
		$getString = $getString.'&noempleado='.$noempleado;	
	}

	if ($nempleado <> '')  {
		$getString = $getString.'&nempleado='.$nempleado;	
	}

	if (isset($de_busc))  {
		$getString = $getString.'&de_busc='.$de_busc;	

		if ($sel_tienda <> 'Elige una Oficina/Tienda') {
			$getString = $getString.'&sel_tienda='.$sel_tienda;	
		}

		if ($sel_tienda <> 'Elige una Razon Social') {
			$getString = $getString.'&sel_razonsc='.$sel_razonsc;	
		}
	}

	if (isset($activa_tiempo))  {
		$getString = $getString.'&activa_tiempo='.$activa_tiempo;	
	    $getString = $getString.'&cuando_busc='.$cuando_busc;	

		if ($taldia <> '') {
			$getString = $getString.'&taldia='.$taldia;	
		}
		if ($fechainicio <> '' and $fechafin <> '') {
			$getString = $getString.'&fechainicio='.$fechainicio.'&fechafin='.$fechafin;	
		}
		if ($sel_mes <> 'Selecciona un mes' and $sel_anio <> 'Selecciona un año') {
			$getString = $getString.'&sel_mes='.$sel_mes.'&sel_anio='.$sel_anio;	
		}
	}

?>		

<script language="javascript"> 

	// Centrar la ventana en la pantalla
	var anchoVent=250, altoVent=190; // Se determina el ancho y el alto iniciales de la ventana
	var maxAnchoDisp=screen.availWidth, maxAltoDisp=screen.availHeight; // Se determina el espacio disponible en la pantalla
	
    /* En las líneas siguientes se calcula la posición inicial de la ventana. Para ello, se resta el tamaño inicial del tamaño disponible y se divide por dos */
	var esqIzq=(maxAnchoDisp-anchoVent)/2;
	var esqSup=(maxAltoDisp-altoVent)/2;

	var nomArchivo = '<?php echo $target_link; ?>';
	var nomVent = 'pupEligeFormato';
	var getString = '<?php echo $getString ?>';
		
	var ventParaAbrir = window.open(nomArchivo+'?'+ getString, nomVent,'width='+ anchoVent +', height='+ altoVent +',top='+ esqSup +',left='+ esqIzq +',scrollbars=NO,resizable=NO,directories=NO,location=NO,menubar=NO,status=NO,titlebar=NO,toolbar=NO');
	
	ventParaAbrir.focus();	
	
</script>

<?php 

	}
?>
 
 	</table>
</div>

<?php

		if (!isset($error) and isset($_POST['quien_busc']) and $mquery_nrows < 1) {
			//echo '<div id="apDiv2"';
			echo '<span class="letra_predeterminada">No se encontraron resultados para esta busqueda</span>';
			// echo '</div>';

		} 
	} else {// Cierre de if si no hay error


		if (isset($error)) {
			echo '<div id="apDiv2">';
			echo '<span class="letra_alertaestado">'.$error.'</span>';
			echo '</div>';
		} else {		
			echo '<div id="apDiv2">';
			echo '<span class="letra_predeterminada">Realiza una busqueda para obtener resultados</span>';
			echo '</div>';
		}
	}

?> 

</body>
</html>
