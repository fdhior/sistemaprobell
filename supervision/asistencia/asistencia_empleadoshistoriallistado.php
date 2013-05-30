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

#list_table a
{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #0080C0;
	font-variant: small-caps;
}

#list_table a:hover {
	color:#004080;
	text-decoration: underline;
	font-weight: normal;
	background-color: inherit;
}

#list_table a:visited {
	color: #0080C0;
	font-weight: bold;
	text-decoration: underline;
	background-color: inherit;
}

#list_table a:active {
	font-weight: bold;
	color: #0080C0;
	text-decoration: underline;
	background-color: inherit;
}

#list_table a:link {
	font-weight: bold;
	color: #0080C0;
	text-decoration: underline;
	background-color: inherit;
}

#list_table a:hover {
	color:#004080;
	font-weight: bold;
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
	text-align: center;
	border: 1px solid #CCC;
}

/* Foto */
.table_td2 {
	width: 100px;
    text-align: center;
	border: 1px solid #CCC;
}

/* Nombre */
.table_td3 {
	width: 130px;
    text-align: center;
	border: 1px solid #CCC;	
}

/* No. de empleado Probell */
.table_td4 {
	width: 115px;
	text-align: center;
	border: 1px solid #CCC;	
}


/* Tipo Empleado */
.table_td5 {
    width: 100px;
    text-align: center;
	border: 1px solid #CCC;	
}

/* Oficina/Tienda */
.table_td6 {
	width: 160px;
	text-align: center;
	border: 1px solid #CCC;	
}

/* Contraseña */
.table_td7 {
	width: 100px;
    text-align: center;
	border: 1px solid #CCC;	
}

/* Detalle */
.table_td8 {
	width: 79px;
	text-align: center;
	border: 1px solid #CCC;	
}

.hid_td	{
	position: absolute;
	visibility: hidden;
	width: 5px;
	height: 5px;
}

#apDiv1 {
	position: absolute;
	left:0px;
	top:0px;
	width:612px;
	height:14px;
	z-index:1;
}


#apDiv2 {
	position: absolute;
	left:0px;
	top:0px;
	width:626px;
	height:16px;
	z-index:2;
	border: 1px solid #999;
}

.table_td51 {	
	width: 90px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
}


-->
</style>
<script type="text/javascript" src="asistencia_empleadoshistoriallistado.js"></script>
</head>

<body>

<?php

	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';
	include $rutafunciones.'valida_fechas.php';
	date_default_timezone_set('America/Mexico_City');

	$hostname     = $_SESSION['hostname'];
	$idusrarea    = $_SESSION['idusrarea'];
	$userinmuid   = $_SESSION['userinmuid'];

	$relpath  = "supervision/asistencia/"; 
	
	/*$target_link   = "common/inmueble/common_modificainmueble.php";
	$target_link3  = "common/inmueble/common_inmueblelistado.php";
	$target_frame  = "modify_frame";*/

    // Mostrar los valores de _POST
    /*echo "Valores de _POST <br />";
    foreach ($_POST as $nombre => $valor) {
    	if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
		}
	}*/
        
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
        

/* ---------------------------------------- INICIA VALIDACION DE DATOS ---------------------------- */

//	if ($usarfiltros == "on") {
        if (isset($busca)) {
			switch ($busca) {
				case "pornousuario":
					if ($nousuario == '') {
						$error = "Error: Teclea un n&uacute;mero de usuario (diferente del no. de empleado)";
//						echo '<strong>'.$error.'</strong>';
					}
					break;
				case "porpbnoempleado":
					if ($pbnoempleado == '') {
						$error = "Error: Teclea un n&uacute;mero de empleado";
//						echo '<strong>'.$error.'</strong>';
					}
					break;
				case "pornombreempleado":
					if ($nempleado == '') {
						$error = "Error: Debes teclear ya sea el nombre o alguno de los apellidos del empleado que buscas";
					}
					break;
			}
		}

        if (!isset($error) and isset($dfechar1)) {

			$checha_fechaini = checkDateFormat($dfechar1);
			// $checha_fechafin = checkDateFormat($dfechar2);

			// Si alguno de los campos del rango esta vacio
			if ($dfechar1 == '') {
            	$error  = "Debes teclear una fecha para realizar la b&uacute;squeda";
			} else {
				// Checar si las fechas introducidas tienen algún error
				if ($checha_fechaini == false) {
					$error  = "Error en la fecha introducida, el formato es AAAA-MM-DD (año, mes, dia) y esta debe ser válida";
				} 
			}
        } // Cierre de if

/* ---------------------------------------- TERMINAVALIDACION DE DATOS ---------------------------- */

     if (!isset($error)) {

?>



<?php


			// Definicion de los parametros de la consulta
			$cols_arr      = array("idempleado",                // 0
								   "capturainicial",            // 1
								   "nombres",                   // 2   
								   "apaterno",                  // 3 
								   "amaterno",                  // 4
								   "gnrl_temp.tipoempleado",    // 5  
								   "inmu_gdat.nombreinmu",      // 6 
								   "fecha_ci");                  // 7

			$num_cols      = count($cols_arr);
		   	$join_tables   = '1';
		    $tables_arr    = array("inmu_gdat", "gnrl_empl", "gnrl_temp");
		    $num_tables    = count($tables_arr);
			$on_fields_arr = array("idinmu", "idtempleado");
			$connect       = '1';
			$order         = "idempleado, nombreinmu";
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
	
	if (!isset($busca)) {	
		switch ($sel_templeado) {
			case "activos":
				$where_clause  = $tpattern1;
				$_SESSION['sel_pattern'] = $tpattern1;
				break;				
			case "inactivos":	
				$where_clause  = $tpattern2;
				$_SESSION['sel_pattern'] = $tpattern2;
				break;
			default:	
				$where_clause  = $tpattern1;
				$_SESSION['sel_pattern'] = $tpattern1;
				break;
		}
	} else {
		switch ($busca) {
			case "pornousuario":
				$where_clause  = 'idempleado = '.$nousuario.' AND '.$_SESSION['sel_pattern'];
				break;
			case "porpbnoempleado":
				$where_clause  = 'pbnoempleado = '.$pbnoempleado.' AND '.$_SESSION['sel_pattern'];
				break;
			case "pornombreempleado":
				switch($sel_nempleado) {
					case 'nombres':
						$campodondebuscar = 'nombres';						
						break;
					case 'apaterno':	
						$campodondebuscar = 'apaterno';						
						break;
					case 'amaterno':
						$campodondebuscar = 'amaterno';
						break;
				}
				$where_clause  = 'gnrl_empl.'.$campodondebuscar.' like \'%'.$nempleado.'%\' AND '.$_SESSION['sel_pattern'];
				break;
			case "portipoempleado":
				$where_clause  = 'gnrl_empl.idtempleado = '.$sel_templeado.' AND '.$_SESSION['sel_pattern'];
				break;
			case "portienda":
				$where_clause  = 'gnrl_empl.idinmu = '.$sel_inmu.' AND '.$_SESSION['sel_pattern'];
				break;
			case "porfecha":
				$where_clause =  "gnrl_empl.fecha_ci like '%$dfechar1%'";
				break;
		}		
	}	
				

// ---------------------------- FIN DE EVALUACIONES DE BUSQUEDA ------------------------------------------------


        // Llama a la funci&oacute;n de las consultas
                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
                
				unset($join_tables);
				unset($on_fields_arr);
				unset($connect);
				unset($order);
				unset($where_clause);

				$mquery_nrows=mysql_num_rows($result);

?>

<div id="apDiv1">
<form id="grid_form_id">
<table id="list_table" border="0" bordercolor="#CCCCCC"  cellpadding="0" cellspacing="0">


<?php
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
    
        <td class="table_td1"><!--<a name="<?php // echo 'fila'.$row[0]; ?>" id="aqui"></a>-->
                             <?php	$idlength = strlen($row[0]);
									switch($idlength) {
										case "1":
											$nousuario = '000'.$row[0];
											break;
										case "2":
											$nousuario = '00'.$row[0];
											break;		
										case "3":
											$nousuario = '0'.$row[0];
											break;
										case "4":
											$nousuario = $row[0];		
											break;
										}

									echo $nousuario;                              // No. Empleado    ?></td>
        <td class="table_td3" align="center">          
        <?php echo $row[2].' '.$row[3].' '.$row[4];                              // Nombre Empleado ?></td>
        <td class="table_td5"><?php echo $row[5]; ?></td>
        <td class="table_td6"><?php echo $row[6]; ?></td>
		<td class="table_td7"><?php echo $row[7];  // Fecha de Alta ?></td>
        <td class="table_td8" align="center"><a href="#" onclick="javascript: muestraMasOp(<?php echo $row[0]; ?>)">[Ver Historial]</a></td>

	</tr>
<?php
                $i++;
        } // Cierre de While

	if ($mquery_nrows > 2) {
		for ($i=0; $i < 25; $i++) {                

?>              

    <tr>
	<td class="celda_vacia">&nbsp;</td>
	</tr>

<?php  } // Cierre de for 
	
	} // Cierre de if ?>    

 	</table>
  </form>
</div>

<?php

		if (!isset($error) and isset($_POST['busca']) and $mquery_nrows < 1) {
			echo '<div id="apDiv2"';
			echo '<span class="letra_predeterminada">No se encontraron resultados para esta busqueda</span>';
			echo '</div>';

		} else {
			if (!isset($error) and !isset ($_POST['busca']) and $mquery_nrows < 1) {
				echo '<div id="apDiv2"';
				echo '<span class="letra_predeterminada">Por el momento no hay informacion que mostrar</span>';
				echo '</div>';
			}
		}
	} // Cierre de if si no hay error


	if (isset($error)) {
		echo '<div id="apDiv2"';
		echo '<span class="letra_alertaestado_nopadd">'.$error.'</span>';
		echo '</div>';
	} 


?> 

</body>
</html>
