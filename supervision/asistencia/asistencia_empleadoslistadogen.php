<?php session_start(); ?>

<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
-->
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

.row-odd {
	BACKGROUND-COLOR: #D8ECF5;
	border: 1px solid #000;
}

.row-even {
	BACKGROUND-COLOR: #FFFFFF;
	border: 1px solid #000;
}

.list_table_td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;
}

.letra_alertaestado {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: bold;
	font-variant: normal;
	color: #CC0000;
}

/* No. */
.table_td1 {
	width: 31px;
	position: relative;
    left: 0px;
	text-align: center;
	padding: 0px;
}

/* Foto */
.table_td2 {
	width: 100px;
    position: relative;
    left: 0px;
    text-align: center;
	padding: 0px;
}

/* Nombre/Lugar de Trabajo/Puesto */
.table_td3 {
	width: 180px;
    position: relative;
    left: 0px;
    text-align: center;
	padding: 0px;
}

/* Fecha de Nacimiento */
.table_td4 {
    width: 80px;
    position: relative;
    left: 0px;
    text-align: center;
	padding: 0px;
}

/* N.S.S. */
.table_td5 {
	width: 90px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
}

/* Dirección */
.table_td6 {
	width: 120px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
}

/* No. Telefónico */
.table_td7 {
	width: 80px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
}

/* Correo-e */
.table_td8 {
	width: 90px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
}

/* Estado */
.table_td9 {
	width: 80px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
}

/* Editar */
.table_td10 {
	width: 78px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
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

.input2 {
	width: 70px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: normal;
}

.input3 {
	width: 80px;
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
/*	border: black 1px solid; */
	width: 110px;
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
	width:951px;
	height:14px;
	z-index:1;
}

#apDiv2 {
	position: absolute;
	width:956px;
	height:16px;
	z-index:2;
	border: 1px solid #999;
	padding-left: 10px;
}
.select31 {	width: 75px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: small-caps;
}
.table_td81 {	width: 115px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
}

-->
</style>
<script type="text/javascript" src="asistencia_empleadoslistadogen.js"></script>

<!--</head>-->

<body>

<?php
 // session_start();

	include "consultas.php";
	include "valida_fechas.php";
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
			$cols_arr      = array("idempleado",                 // 0
								   "capturainicial",             // 1
								   "nombres",                    // 2   
								   "apaterno",                   // 3 
								   "amaterno",                   // 4
								   "inmu_gdat.nombreinmu",       // 5  
								   "gnrl_temp.tipoempleado",     // 6  
								   "fechanac",                   // 7
								   "nss",                        // 8
								   "gnrl_empl.direccion",        // 9    
								   "notelefonico",               // 10
								   "correoe",                    // 11	
								   "gnrl_esta.empleadoestado");  // 12 
			$num_cols      = count($cols_arr);
		   	$join_tables   = '1';
		    $tables_arr    = array("inmu_gdat", "gnrl_empl", "gnrl_temp", "gnrl_esta");
		    $num_tables    = count($tables_arr);
			$on_fields_arr = array("idinmu", "idtempleado", "idempstat");
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
			case "porrangofechas":
				$where_clause =  'gnrl_empl.fecha_ci BETWEEN \''.$dfechar1.' 00:00:00\' AND \''.$dfechar2.' 23:59:59\' AND '.$_SESSION['sel_pattern'];
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
<table class="list_table" border="1" cellpadding="0" cellspacing="0">


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
    
        <td class="table_td1"><?php	$idlength = strlen($row[0]);
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
        <td class="table_td2" id="capturainicial"><img src="<?php echo $hostname.$relpath.$row[1];    // Foto             ?>" width="100" height="60" /></td>
        <td class="table_td3" align="center"><label>
          <input name="nombres" type="text" class="input1" id="textfield" value="<?php echo $row[2];  // Nombre(s)        ?>" disabled="disabled" />
		  <input name="apaterno" type="text" class="input1" id="textfield" value="<?php echo $row[3]; // Apellido Paterno ?>" disabled="disabled" />	
          <input name="amaterno" type="text" class="input1" id="textfield" value="<?php echo $row[4]; // Apellido Materno ?>" disabled="disabled" />
        </label><br />
        <?php echo $row[5]; // Lugar de Trabajo ?> - <?php echo $row[6]; // Tipo Empleado ?></td>
        <td class="table_td4"><input class="input2" type="text" name="fechanac" id="textfield2" value="<?php echo $row[7]; // Fecha de Nacimiento ?>" disabled></td>
        <td class="table_td5"><input class="input3" type="text" name="nss" id="nss" value="<?php echo $row[8]; // N.S.S.    ?>" disabled></td>
        <td class="table_td6"><textarea class="editDirec" name="direccion" id="direccion" cols="45" rows="5" disabled><?php echo $row[9]; // Direccion ?></textarea></td> 
	    <td class="table_td7"><input class="input2" type="text" name="notelefonico" id="notelefonico" value="<?php echo $row[10]; // Fecha Alta ?>" disabled></td>
		<td class="table_td8"><input class="input2" type="text" name="correoe" id="correoe" value="<?php echo $row[11]; // Correo Electronico ?>" disabled></td>
		<td class="table_td9">
		  <select class="select3" name="sel_estado" disabled="disabled">
		    <?php

//		if ($invalid_check == '1') {
//			echo "<option selected>$sel_rsc</option>";		
//		} else {
			echo '<option selected>'.$row[12].'</option>';		
//		}

        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr     = array("idempstat", "empleadoestado");
        $num_cols     = count($cols_arr);
        $tables_arr   = array("gnrl_esta");
        $num_tables   = count($tables_arr);
//		$where_clause = "idhora > '10'";

  		$estado_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

//		unset($where_clause);

        while($row1=mysql_fetch_row($estado_rset)) {
	       	if ($row1[1] <> $row[12]) {	
				echo '<option value="'.$row[0].'">'.$row1[1].'</option>';
			}	
        }   // cierre de While
		// estado ?>
		    </select>
		</td>
        <td class="table_td10" align="center"><a href="#" onClick="javascript: editId(<?php echo $row[0]; ?>,true,'<?php echo $hostname.$relpath.$row[2]; ?>')">Editar</a></td>

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
			echo '<span class="letra_boton">No se encontraron resultados para esta busqueda</span>';
			echo '</div>';

		} else {
			if (!isset($error) and !isset ($_POST['busca']) and $mquery_nrows < 1) {
				echo '<div id="apDiv2"';
				echo '<span class="letra_boton">Por el momento no hay informacion que mostrar</span>';
				echo '</div>';
			}
		}
	} // Cierre de if si no hay error


	if (isset($error)) {
		echo '<div id="apDiv2"';
		echo '<span class="letra_alertaestado">'.$error.'</span>';
		echo '</div>';
	} 


?> 

</body>
<!--</html>
-->