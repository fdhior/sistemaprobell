<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--

.letra_alertaestado {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 9px;
        font-style: normal;
        font-weight: bold;
        font-variant: normal;
        color: #CC0000;
}
/* No. */
.pedrcb_td1 { 
        width: 31px;
        position: relative;
        border: 1px solid #CCC;
        left: 0px;
        text-align: center;
}

/* Archivo */
.pedrcb_td2 {
        width: 110px;
        border: 1px solid #CCC;
        position: relative;
        left: 0px;
        text-align: center;
}

/* Tamaño */
.pedrcb_td3 {
        width: 150px;
        border: 1px solid #CCC;
        position: relative;
        left: 0px;
        text-align: center;
}

/* Almacen Origen */
.pedrcb_td4 {
        width: 474px;
        border: 1px solid #CCC;
        position: relative;
        left: 0px;
        text-align: center;
}

/* Enviado en */
.pedrcb_td5 {
        width: 140px;
        border: 1px solid #CCC;
        position: relative;
        left: 0px;
        text-align: center;
}

/* Descargar */
.pedrcb_td6 {
        width: 130px;
        border: 1px solid #CCC;
        position: relative;
        left: 0px;
        text-align: center;
}

.pedrcb_td7 {
        width: 179px;
        border: 1px solid #CCC;
        position: relative;
        left: 0px;
        text-align: center;
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
}

-->
</style>

    <?php 
        session_start();        

		$rutafunciones = $_SESSION['rutafunciones'];
		include $rutafunciones.'consultas.php';
		include $rutafunciones.'valida_fechas.php';

        date_default_timezone_set('America/Mexico_City');

        $hostname     = $_SESSION['hostname'];
        $idusrarea    = $_SESSION['idusrarea'];
        $userinmuid   = $_SESSION['userinmuid'];

		$target_link   = "administracion/cursos/cursos_modificacurso.php";
		$target_frame  = "modify_frame";

        // Mostrar los valores de _POST
/*        echo "Valores de _POST <br />";
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
                }
        } 
		
		echo $_SESSION['modobusqueda'];
*/
        
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

                //                         0        1           2   
				$cols_arr      = array("idlinea", "nlinea", "fechaalta");
				$num_cols      = count($cols_arr);
//				$join_tables   = '1';
				$tables_arr    = array("curs_line");
//				$num_tables    = count($tables_arr);
//				$on_fields_arr = array("idinmu", "idlinea", "idcursostat");
//				$connect       = '2';
//				$where_clause  = "idcursostat <> '3'";
				$order         = "idlinea";
				$dir           = "ASC";


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

/*	$fecha_actual = date('Y-m-d');
				
	$pattern1 = "curs_cdet.idcursostat <> 3 AND fecha > '$fecha_actual'";
	$pattern2 = "curs_cdet.idcursostat = 3 AND fecha > '$fecha_actual'";
	$pattern3 = "curs_cdet.idcursostat <> 3 AND fecha < '$fecha_actual'"; */
	$pattern1 = "curs_line.nlinea like '%$nombretec%'";
//	$pattern5 = " AND curs_cdet.idcurso = '$folio'";

/*	if (!isset($busca)) {	
		switch ($sel_tcurso) {
			case "activos":
				$_SESSION['modobusqueda'] = $pattern1;
				$_SESSION['busc_flag']    = '1';
				break;				
/*			case "cancelados":	
				$_SESSION['modobusqueda'] = $pattern2;
				$_SESSION['busc_flag']    = '2';
				break;
			case "realizados":
				$_SESSION['modobusqueda'] = $pattern3;
				break;
			default:	
				$_SESSION['modobusqueda'] = $pattern1;
				break; */
//		}

/*	} else {

		switch($_SESSION['modobusqueda']) {
			case $pattern1:
				$sel_ttecnico = "activos";
				break;
/*			case $pattern2:
				$sel_tcurso = "cancelados";	
				break;
			case $pattern3:
				$sel_tcurso = "realizados";	
				break; */
//		}		

		switch ($busca) {
			case "pornombre":
//				$sel_pattern  = $_SESSION['modobusqueda'];
				$where_clause = $pattern1;
				break;
/*			case "porfolio":
//				$sel_pattern  = $_SESSION['modobusqueda'];
				$busc_pattern = $pattern5;
				break;*/
		}		
//	}	

//				$sel_pattern = $_SESSION['modobusqueda'];	
								
//				$where_clause = $sel_pattern.$busc_pattern;


// ---------------------------- FIN DE EVALUACIONES DE BUSQUEDA ------------------------------------------------


        // Llama a la funci&oacute;n de las consultas
                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                /*if ($ajusta_busqueda == "activos") {
					$_SESSION['modobusqueda'] = $pattern1;
				}*/

				$mquery_nrows=mysql_num_rows($result);                
				
?>


<div id="apDiv1"> 
<table border="0" cellpadding="0" cellspacing="0">

<?php 

                $i = 0;
                while($row=mysql_fetch_row($result)) {

?>

        <tr class="<?php 
  				      $oddevencheck = $i % 2;  
					  if ($oddevencheck == 0) {
						echo "row-even";
					  } else {
			    		echo "row-odd";
					  }
		           ?>">
    
        <td class="pedrcb_td1" valign="top"><a name="<?php echo 'fila'.$row[0]; ?>" id="aqui"></a><?php echo $row[0]; // No.            ?></td>
        <td class="pedrcb_td2"><?php echo $row[1]; // Nombreusuario  ?></td>
        <td class="pedrcb_td3"><?php echo $row[2]; // Tienda         ?></td>
        <td class="pedrcb_td7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>

<?php

	if ($sel_tlinea == "activos") {

?>

          <!--<form id="form10<?php // echo "$i"; ?>" name="form10<?php // echo "$i"; ?>" method="post" action="<?php // echo "$hostname$target_link"; ?>" target="<?php // echo "$target_frame"; ?>">
            <td align="center"><input name="button" type="submit" class="letra_boton" id="button" value="Editar Tecnico" />
              <input name="idtecpass" type="hidden" value="<?php // echo "$row[0]"; ?>" />
              <input name="modificar" type="hidden" value="editatecnico" />
              <input name="ntecpass" type="hidden" value="<?php // echo "$row[1]"; ?>" /></td>
          </form>-->

          <!--<form id="form10<?php // echo "$i"; ?>" name="form10<?php // echo "$i"; ?>" method="post" action="<?php // echo "$hostname$target_link"; ?>" target="<?php // echo "$target_frame"; ?>"> -->
            <td align="center">
              <input class="letra_boton11" type="submit" name="button" id="button" value="Ninguna" disabled="disabled" /> 
              <!--<input name="idlinpass" type="hidden" value="<?php // echo "$row[0]"; ?>" />
              <input name="modificar" type="hidden" value="confelmlin" />
              <input name="nlinpass" type="hidden" value="<?php // echo "$row[1]"; ?>" />--></td>
          <!--</form>-->

<?php

	}

?>
            </tr>
          </table>
	</td>         
        <td class="pedrcb_td4">&nbsp;</td>
<!--    <td class="pedrcb_td5"><span class="tipoletra"><?php // echo $row[4]; // Status      ?></span></td>
        <td class="pedrcb_td6"><span class="tipoletra"><?php // echo $row[5];                ?></span></td> --> 

</tr>
<?php
                $i++;
        } // Cierre de While

	for ($i=0; $i < 15; $i++) {                

?>              

    <tr>
	<td class="celda_vacia">&nbsp;</td>
	</tr>

<?php } // Cierre de for ?> 		

	</table>
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


