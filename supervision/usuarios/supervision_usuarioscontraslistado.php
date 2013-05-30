<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

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
	height: 35px;
	text-align: center;
	border: 1px solid #CCC;
}

/* NombreUsuario */
.table_td2 {
	width: 130px;
    text-align: center;
	border: 1px solid #CCC;
}

/* Tienda */
.table_td3 {
	width: 100px;
    text-align: center;
	border: 1px solid #CCC;	
}

/* Contraseña */
.table_td4 {
	width: 115px;
	text-align: center;
	border: 1px solid #CCC;	
}


/* Hidden Cell */
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
	width:384px;
	height:14px;
	z-index:1;
}


#apDiv2 {
	position: absolute;
	left:0px;
	top:0px;
	width:398px;
	height:16px;
	z-index:2;
	border: 1px solid #999;
}


-->
</style>
<script type="text/javascript" src="supervision_usuarioslistado.js"></script>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
	

	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';
	include $rutafunciones.'valida_fechas.php';
	date_default_timezone_set('America/Mexico_City');

	$hostname     = $_SESSION['hostname'];
	$idusrarea    = $_SESSION['idusrarea'];
	$idtipousr    = $_SESSION['idtipousr'];
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
				case "pornombre":
					if ($nombreusuario == '') {
						$error = "Error: Debes teclear un nombre usuario o parte de &eacute;l";
					}
					break;
			}
		}

        if (!isset($error) and isset($dfechar1) and isset($dfechar2)) {

			$checha_fechaini = checkDateFormat($dfechar1);
			$checha_fechafin = checkDateFormat($dfechar2);

			// Si alguno de los campos del rango esta vacio
			if ($dfechar1 == '' or $dfechar2 == '') {
            	$error  = "Debes teclear una fecha de inicio y una final en el rango";
			} else {
				// Checar si las fechas introducidas tienen algún error
				if (($checha_fechaini == false and $checha_fechafin == false) or 
				    ($checha_fechaini == true and $checha_fechafin == false) or 
					($checha_fechaini == false and $checha_fechafin == true)) {
					$error  = "Error en alguna fecha introducida en el rango, el formato es AAAA-MM-DD (año, mes, dia) ambas deben ser válidas";
				} else {
					// Comparar las fechas
					$compareres = compare_dates($dfechar1, $dfechar2);

					// Si la fecha inicial es mayor a la final
//					echo "valor de compareres: $compareres";
					if ($compareres > 0) {
						$error  = "Error la fecha inicial es mayor que la fecha final";
					}
				}
			}
        } // Cierre de if

/* ---------------------------------------- TERMINAVALIDACION DE DATOS ---------------------------- */

     if (!isset($error)) {

?>



<?php


			// Definicion de los parametros de la consulta
			$cols_arr      = array("iduser",            // 0
				                   "username",          // 1
								   "textpass",          // 4
								   "usrs_stat.status"); // 5
                $num_cols      = count($cols_arr);
                $join_tables   = '1';
                $tables_arr    = array("gnrl_usrs", 
				                       "usrs_stat");
                $num_tables    = count($tables_arr);
                $on_fields_arr = array("idusrstatus");
				$order         = "gnrl_usrs.nombre";
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
		
	$buscPattern1 = "gnrl_usrs.idarea = 5";	
	
	if (!isset($busca)) {	
		if ($idtipousr == '2' or $idtipousr == '3') {
			$where_clause  = $buscPattern1;
		}
	} else {
		switch ($busca) {
			case "pornombre":
		   		switch ($idtipousr) {
					case "1":			
						$where_clause  = 'gnrl_usrs.username LIKE \'%'.$nombreusuario.'%\'';
						break;
					case "2":
					case "3":
						$where_clause  = $buscPattern1.' AND gnrl_usrs.username LIKE \'%'.$nombreusuario.'%\'';
						break;
				}
				break;
			case "portienda":
		   		switch ($idtipousr) {
					case "1":			
						$where_clause  = 'gnrl_usrs.idinmu = \''.$sel_inmu.'\'';
						break;
					case "2":
					case "3":
						$where_clause  = $buscPattern1.' AND gnrl_usrs.idinmu = \''.$sel_inmu.'\'';
						break;
				}
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


	<tr id="<?php echo $row[0]; ?>" class="<?php $oddevencheck = $i % 2;  
					  if ($oddevencheck == 0) {
						echo "row-even";
					  } else {
			    		echo "row-odd";
					  }
		           ?>">
    
        <td class="table_td1"><a name="<?php echo 'fila'.$row[0]; ?>" id="aqui"></a>
        					  <?php echo $row[0]; // No. Usuario     ?></td>
        <td class="table_td2"><?php echo $row[1]; // Nombre Usuario  ?></td>
		<td class="table_td3"><?php echo $row[2]; // Nombre Usuario  ?></td>   
        <td class="table_td4"><?php echo $row[3]; // Tienda          ?></td>
        
	</tr>
<?php
                $i++;
        } // Cierre de While

?>    

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
