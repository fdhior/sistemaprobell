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
	width: 110px;
    text-align: center;
	border: 1px solid #CCC;
}

/* Tienda */
.table_td3 {
	width: 200px;
    text-align: center;
	border: 1px solid #CCC;	
}

/* Contraseña */
.table_td4 {
	width: 100px;
	text-align: center;
	border: 1px solid #CCC;	
}

/* Correo-e */
.table_td5 {
    width: 150px;
    text-align: center;
	border: 1px solid #CCC;	
}

/* Fecha de Alta */
.table_td6 {
	width: 150px;
	text-align: center;
	border: 1px solid #CCC;	
}

/* Estado */
.table_td7 {
	width: 100px;
    text-align: center;
	border: 1px solid #CCC;	
}

/* Opciones */
.table_td8 {
	width: 97px;
	text-align: center;
	border: 1px solid #CCC;	
}

/* Input Contraseña */
.input1 {
	width: 90px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	font-variant: normal;
}

/* Input Correo */
.input2 {	width: 130px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	font-variant: normal;
}

/* Hidden Cell */
.hid_td	{
	position: absolute;
	visibility: hidden;
	width: 5px;
	height: 5px;
}

/* Tipo Empleado */
.select1 {
	width: 90px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	font-variant: small-caps;
}


#apDiv1 {
	position: absolute;
	left:0px;
	top:0px;
	width:954px;
	height:14px;
	z-index:1;
}


#apDiv2 {
	position: absolute;
	left:0px;
	top:0px;
	width:952px;
	height:16px;
	z-index:2;
	border: 1px solid #999;
}

.table_td51 {	width: 90px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
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
						$error = "Error: Debes teclear un nombre usuario o parte de el para realizar la b&uacute;squeda";
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
				$cols_arr      = array("iduser",            	 // 0
				                   "username",          	 // 1
								   "idinmu",            	 // 2
								   "correoe",           	 // 3 
								   "fechaalta",         	 // 4
								   "usrs_stat.status");  	 // 5   
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
	$buscPattern2 = "gnrl_usrs.idusrstatus = 2";	
	
	if (!isset($busca)) {	
		switch ($sel_user) {
			case "activos":
		   		switch ($idtipousr) {
					case "1":			
						$where_clause  = 'gnrl_usrs.idusrstatus = 1';
						break;
					case "2":
						$where_clause  = $buscPattern1.' AND gnrl_usrs.idusrstatus = 1';
						break;
				}
				break;				
			case "deshabilitados":	
		   		switch ($idtipousr) {
					case "1":			
						$where_clause  = 'gnrl_usrs.idusrstatus = 2';
						break;
					case "2":
						$where_clause  = $buscPattern1.' AND gnrl_usrs.idusrstatus = 2';
						break;
				}
				break;
			case "eliminados":
		   		switch ($idtipousr) {
					case "1":			
						$where_clause  = 'gnrl_usrs.idusrstatus = 3';
						break;
					case "2":
						$where_clause  = $buscPattern1.' AND gnrl_usrs.idusrstatus = 3';
						break;
				}
				break;
			default:	
		   		switch ($idtipousr) {
					case "1":			
						$where_clause  = 'gnrl_usrs.idusrstatus = 1';
						break;
					case "2":
						$where_clause  = $buscPattern1.' AND gnrl_usrs.idusrstatus = 1';
						break;
				}
				break;
		}
		$_SESSION['sel_pattern'] = $where_clause;
	} else {
		switch ($busca) {
			case "pornombre":
				$where_clause  = $_SESSION['sel_pattern'].' AND gnrl_usrs.username LIKE \'%'.$nombreusuario.'%\'';
				break;
			case "portienda":
				$where_clause  = $_SESSION['sel_pattern'].' AND gnrl_usrs.idinmu = \''.$sel_inmu.'\'';
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
    
        <td class="table_td1" valign="top"><a name="<?php echo 'fila'.$row[0]; ?>" id="aqui"></a>
        					  <?php echo $row[0];           // No. Usuario     ?></td>
        <td class="table_td2"><?php echo $row[1];           // Nombre Usuario  ?></td>
        <td class="table_td3"><?php 
									// Recupera el nombre de una tienda
									$cols_arr     = array("nombreinmu");
									$num_cols     = count($cols_arr);
									$tables_arr   = array("inmu_gdat");
									$where_clause = "idinmu = '$row[2]'";
		
									$nombreInmu_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
									$nombreInmu = mysql_fetch_row($nombreInmu_rset);
			 						
									unset($where_clause); 
									
									echo $nombreInmu[0]   // Lugar Checada      ?></td>
		<td class="table_td4"><input class="input1" name="contra" type="password" value="1546476731231545646" disabled="disabled" />
                                                         <!--  Contraseña     --></td>   
        <td class="table_td5"><!--<input class="input2" type="text" name="correoe" id="correoe" value="<?php echo $row[3]; // No. Empleado Probell    ?>" disabled="disabled" />--><?php echo $row[2]; // No. Tienda    ?>
												          <!--  Correo-e       --></td>
        <td class="table_td6"><?php echo $row[4];           // Tienda          ?></td>
        
        <td class="table_td7">
        <!--<a href="#" onclick="javascript: cambiaEstado(<?php // echo $row[0]; ?>)">E</a>-->
        <select class="select1" name="sel_usrstatus" disabled="disabled">
        <?php

//		if ($invalid_check == '1') {
//			echo "<option selected>$sel_rsc</option>";		
//		} else {
			echo '<option selected>'.$row[5].'</option>';		
//		}

        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr = array("status");
        $num_cols = count($cols_arr);
        $tables_arr = array("usrs_stat");
        $num_tables = count($tables_arr);

  		$sel_templeado_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        while($row1=mysql_fetch_row($sel_templeado_rset)) {
	       	// if ($row1[0] <> $row[5]) {	
				echo '<option>'.$row1[0].'</option>';
			// }	
        }   // cierre de While
		?>
        
        </select>
												          <!--  Estado       --></td>
        <td class="table_td8" align="center">
        <a href="#<?php echo 'fila'.$row[0]; ?>" onclick="javascript: 
        editId(<?php echo $row[0]; ?>,true, <?php if ($sel_user == "deshabilitados" or $sel_user == "eliminados") { echo "false"; } else { echo "true"; } ?>)">[Editar]</a><br />
        <a href="#<?php echo 'fila'.$row[0]; ?>" onclick="javascript: muestraPermisos(<?php echo $row[0]; ?>, <?php if ($idtipousr == '2' or $idtipousr == '3') {	echo '2'; } else { echo '1'; } ?>)">[Permisos]</a></td>
												          <!--  opciones       --></td>
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
