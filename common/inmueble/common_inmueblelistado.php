<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.list_table.td.a:active {
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
	border: 1px solid #CCC;
	padding: 0px;
}

/* Archivo */
.table_td2 {
	width: 110px;
    position: relative;
    left: 0px;
    text-align: center;
    border: 1px solid #CCC;
	padding: 0px;
}

/* Tamaño */
.table_td3 {
	width: 110px;
    position: relative;
    left: 0px;
    text-align: center;
    border: 1px solid #CCC; 
 	padding: 0px;
}

/* Almacen Origen */
.table_td4 {
    width: 180px;
    position: relative;
    left: 0px;
    text-align: center;
 	border: 1px solid #CCC;
	padding: 0px;
}

/* Enviado en */
.table_td5 {
	width: 180px;
	position: relative;
	left: 0px;
	text-align: center;
	border: 1px solid #CCC;
	padding: 0px;
}

/* Descargar */
.table_td6 {
	width: 100px;
    position: relative;
    left: 0px;
    text-align: center;
	border: 1px solid #CCC;
	padding: 0px;
}

.table_td7 {
	width: 90px;
	position: relative;
	left: 0px;
	text-align: center;
	border: 1px solid #CCC;
	padding: 0px;
}

.table_td8 {
	width: 75px;
	position: relative;
	left: 0px;
	text-align: center;
	border: 1px solid #CCC;
	padding: 0px;
}

.table_td9 {
	width: 61px;
	position: relative;
	left: 0px;
	text-align: center;
	border: 1px solid #CCC;
	padding: 0px;
}

.letra_boton {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-weight: normal;
	font-variant: small-caps;
}

.select1 {
	width: 170px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: small-caps;
}

.select2 {
	width: 80px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: small-caps;
}

.select3 {
	width: 60px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: small-caps;
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
        position:absolute;
        left:0px;
        top:0px;
        width:954px;
        height:14px;
        z-index:1;
}
#apDiv2 {
	position:absolute;
	left:0px;
	top:0px;
	width:952px;
	height:16px;
	z-index:2;
	border: 1px solid #000;
}

-->
</style>

<script src="common_inmueblelistado.js" type="text/javascript"></script>
<?php 

        include $_SESSION['rutafunciones'].'consultas.php';
        include $_SESSION['rutafunciones'].'valida_fechas.php';
        date_default_timezone_set('America/Mexico_City');

        $hostname     = $_SESSION['hostname'];
        $idusrarea    = $_SESSION['idusrarea'];
        $userinmuid   = $_SESSION['userinmuid'];

		$rel_path      = 'common/inmueble/common_';
		$target_link   = $hostname.$rel_path.'modificainmueble.php';
//		$target_link2  = "supervision/usuarios/supervision_actualizausuario.php";
		$target_link3  = $hostname.$rel_path.'inmueblelistado.php';
		$target_frame  = "modify_frame";

        // Mostrar los valores de _POST
/*      echo "Valores de _POST <br />";
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
                }
        } */

        
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
</head>

<body>


<?php        

/* ---------------------------------------- INICIA VALIDACION DE DATOS ---------------------------- */

	if ($usarfiltros == "on") {
        if (isset($busca)) {
                switch ($busca) {
                        case "pororigen":
                                if ($sel_origen == 'Elige un Origen') {
                                        $error = "Error: Elige un Origen V&aacute;lido de la lista";
                                }
                                break;
                        case "pornombre":
                                if ($nombre_archivo == '') {
                                        $error = "Error: Debes teclear el texto que deseas buscar en el nombre de archivo";
                                }
                                break;
                }
        }

        if (!isset($error)) {
                if ($filtfecha == "on") {
                        // Si alguno de los campos del rango esta vacio
                        if ($fechainicio == '' or $fechafin == '') {
                                $error  = "Debes teclear una fecha de inicio y una final en el rango";
                        }

                        $checha_fechaini = checkDateFormat($fechainicio);
                        $checha_fechafin = checkDateFormat($fechafin);

                        if ($fechainicio <> '' and $fechafin <> '') { // Si algunos de los campos del rango es invalido
                                if (($checha_fechaini == false and $checha_fechafin == false) or ($checha_fechaini == true and $checha_fechafin == false) or ($checha_fechaini == false and $checha_fechafin == true)) {
                                        $error  = "Error en alguna fecha introducida en el rango, el formato es AAAA-MM-DD (año, mes, dia) ambas deben ser válidas";
                                }
                        }

                        if ($checha_fechaini == true and $checha_fechafin == true) {
                               $compareres = compare_dates($fechainicio, $fechafin);

                        // Si la fecha inicial es mayor a la final
        //              echo "valor de compareres: $compareres";
                                if ($compareres > 0) {
                                        $error  = "Error la fecha inicial es mayor que fecha final";
                                }
                        }
                }
        } // Cierre de if
	}		

/* ---------------------------------------- TERMINAVALIDACION DE DATOS ---------------------------- */



        if (!isset($error)) {

			// Definicion de los parametros de la consulta
			$cols_arr      = array("inmu_gdat.idinmu",
			                       "nombreinmu", 
								   "inmu_tipo.tipo", 
								   "inmu_dfis.razonsc", 
								   "direccion", 
								   "inmu_zona.zona", 
								   "inmu_gubc.googlelink", 
								   "inmu_stat.estado");
			$num_cols      = count($cols_arr);
		   	$join_tables   = '1';
		    $tables_arr    = array("inmu_tipo", "inmu_gdat", "inmu_dfis", "inmu_zona", "inmu_gubc", "inmu_stat");
		    $num_tables    = count($tables_arr);
			$on_fields_arr = array("idinmutipo", "idfis", "idzona", "idubica", "idinmustat");
			$connect       = '1';
			$order         = "inmu_tipo.tipo, nombreinmu";
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

        // Patr&oacute;n reutilizable de busqueda
				
	if (!isset($busca)) {	
		switch ($sel_sttienda) {
			case "activas":
				$where_clause  = "inmu_gdat.idinmutipo <> 5 AND inmu_gdat.idinmutipo <> 6 AND inmu_gdat.idinmustat = 1";
				break;				
			case "deshab":	
				$where_clause  = "inmu_gdat.idinmutipo <> 5 AND inmu_gdat.idinmutipo <> 6 AND inmu_gdat.idinmustat = 2";
				break;
			case "elimn":
				$where_clause  = "inmu_gdat.idinmutipo <> 5 AND inmu_gdat.idinmutipo <> 6 AND inmu_gdat.idinmustat = 3";
				break;
			default:	
				$where_clause  = "inmu_gdat.idinmutipo <> 5 AND inmu_gdat.idinmutipo <> 6 AND inmu_gdat.idinmustat = 1";
				break;
		}
	} else {
		switch ($busca) {
			case "poridusuario":
				$where_clause  = "gnrl_usrs.iduser = '$iduser'";
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
<table border="0" cellpadding="0" cellspacing="0">

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
    
        <td class="table_td1" valign="top"><a name="<?php echo 'fila'.$row[0]; ?>" id="aqui"></a><?php echo $row[0]; // No.            ?></td>
        <td class="table_td2"><?php echo $row[1]; // Tienda         ?></td>
        <td class="table_td3"><?php echo $row[2]; // Tipo Tienda    ?></td>
        <td class="table_td4">
        
        <select class="select1" name="razonsc" disabled="disabled">
        <?php

//		if ($invalid_check == '1') {
//			echo "<option selected>$sel_rsc</option>";		
//		} else {
			echo "<option selected>$row[3]</option>";		
//		}

        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr = array("razonsc");
        $num_cols = count($cols_arr);
        $tables_arr = array("inmu_dfis");
        $num_tables = count($tables_arr);

  		$razonsc_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        while($row1=mysql_fetch_row($razonsc_rset)) {
//	       	if ($row1[1] <> $row[3]) {	
				echo "<option>$row1[0]</option>";
//			}	
        }   // cierre de While
		?>
        
        </select>
        </span></td>
        <td class="table_td5"><?php echo $row[4]; // Direccion      ?></td>
        <td class="table_td6">
        <select class="select2" name="zona" disabled="disabled">
        <?php

//		if ($invalid_check == '1') {
//			echo "<option selected>$sel_rsc</option>";		
//		} else {
			echo "<option selected>$row[5]</option>";		
//		}

        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr = array("zona");
        $num_cols = count($cols_arr);
        $tables_arr = array("inmu_zona");
        $num_tables = count($tables_arr);

  		$zona_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        while($row1=mysql_fetch_row($zona_rset)) {
//	       	if ($row1[1] <> $row[3]) {	
				echo "<option>$row1[0]</option>";
//			}	
        }   // cierre de While
		?>
        
        </select></td> 
        <td class="table_td7"><textarea class="editLink" name="linkubica" cols="8" rows="1" disabled="disabled"><?php echo "$row[6]"; ?></textarea></td>
		<td class="table_td8">
        <select class="select3" name="estado" disabled="disabled">
        <?php

//		if ($invalid_check == '1') {
//			echo "<option selected>$sel_rsc</option>";		
//		} else {
			echo "<option selected>$row[7]</option>";		
//		}

        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr = array("estado");
        $num_cols = count($cols_arr);
        $tables_arr = array("inmu_stat");
        $num_tables = count($tables_arr);

  		$estado_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        while($row1=mysql_fetch_row($estado_rset)) {
//	       	if ($row1[1] <> $row[3]) {	
				echo "<option>$row1[0]</option>";
//			}	
        }   // cierre de While
		?>
        
        </select></td>
        <td class="table_td9" align="center"><a href="#<?php echo 'fila'.$row[0]; ?>" onclick="javascript: editId(<?php echo $row[0]; ?>,true)"><span class="letraListado">Editar</span></a></td>

	</tr>
<?php
                $i++;
        } // Cierre de While


	for ($i=0; $i < 25; $i++) {
		
?>
 
    <tr>
	<td class="celda_vacia">&nbsp;</td>
	</tr>

<?php } // Cierre de for ?>    

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
		echo '<span class="letra_alertaestado">'.$error.'</span>';
		echo '</div>';
	} 

?>



</body>
</html>
