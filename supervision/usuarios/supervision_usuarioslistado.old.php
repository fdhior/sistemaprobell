<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--

.tipoletra {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 9px;
        font-style: normal;
        font-weight: normal;
        font-variant: small-caps;
}


/* No. */
.pedrcb_td1 { 
    width: 31px;
	border: 1px solid #CCC;
    text-align: center;
}

/* Archivo */
.pedrcb_td2 {
    width: 110px;
    border: 1px solid #CCC; 
    text-align: center;
}

/* Tamaño */
.pedrcb_td3 {
    width: 150px;
    border: 1px solid #CCC;  
    text-align: center;
}

/* Almacen Origen */
.pedrcb_td4 {
    width: 120px;
    border: 1px solid #CCC; 
    text-align: center;
}

/* Enviado en */
.pedrcb_td5 {
    width: 100px;
    border: 1px solid #CCC; 
    text-align: center;
}

/* Descargar */
.pedrcb_td6 {
    width: 150px;
    border: 1px solid #CCC; 
    text-align: center;
}

.pedrcb_td7 {
    width: 279px;
    border: 1px solid #CCC; 
    text-align: center;
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
}


-->
</style>
    <?php 
        session_start(); 

		$rutafunciones = $_SESSION['rutafunciones'];
		       
        include $rutafunciones.'consultas.php';
        include $rutafunciones.'valida_fechas.php';
        date_default_timezone_set('America/Mexico_City');

        $hostname      = $_SESSION['hostname'];
        $idusrarea     = $_SESSION['idusrarea'];
        $userinmuid    = $_SESSION['userinmuid'];

		$rel_path      = 'supervision/usuarios/supervision_';
		
		$target_link   = $hostname.$rel_path.'modificausuario.php';
		$target_link2  = $hostname.$rel_path.'actualizausuario.php';
		$target_link3  = $hostname.$rel_path.'usuarioslistado.php';
		$target_frame  = "modify_frame";

		// Mostrar los valores de _POST
       /* echo '<p class="tipoletra">'; 
        echo "Valores de _POST <br />";
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
                }
        } 
		echo '</p>';*/

        
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
                $cols_arr      = array("iduser", 
				                       "username", 
									   "nombre", 
									   "correoe", 
									   "usrs_stat.status");
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

        // Patr&oacute;n reutilizable de busqueda
				
	if (!isset($busca)) {	
		switch ($sel_user) {
			case "activos":
				$where_clause  = "gnrl_usrs.idarea = 5 AND gnrl_usrs.idusrstatus = 1";
				break;				
			case "deshabilitados":	
				$where_clause  = "gnrl_usrs.idarea = 5 AND gnrl_usrs.idusrstatus = 2";
				break;
			case "eliminados":
				$where_clause  = "gnrl_usrs.idarea = 5 AND gnrl_usrs.idusrstatus = 3";
				break;
			default:	
				$where_clause  = "gnrl_usrs.idarea = 5 AND gnrl_usrs.idusrstatus = 1";
				break;
		}
	} else {
		switch ($busca) {
			case "pornombre":
				$where_clause  = "gnrl_usrs.username LIKE '%$nombreusuario%'";
				break;
		}		
	}	
				

// ---------------------------- FIN DE EVALUACIONES DE BUSQUEDA ------------------------------------------------

?>


<!--<p class="tipoletra">-->
<?php
		
        // Llama a la funci&oacute;n de las consultas
                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

				$mquery_nrows=mysql_num_rows($result);                


?>
<!--</p>-->

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
    
        <td class="pedrcb_td1"><?php echo $row[0]; // No. ?></td>
        <td class="pedrcb_td2"><?php echo $row[1]; // Nombreusuario ?></td>
        <td class="pedrcb_td3"><?php echo $row[2]; // Tienda ?></td>
        <td class="pedrcb_td4"><?php
															if ($row[3] == "") {
																echo "No Registrado";
															} else {
																echo $row[3];
															}	 // Correoe ?></th>
        <td class="pedrcb_td5"><?php echo $row[4]; // Status ?></td>
	<form name="form<?php echo $i; ?>" id="form<?php echo $i; ?>" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
        <td class="pedrcb_td6" align="center"><?php if ($sel_user == "eliminados" or $sel_user == "deshabilitados" or $update == "show") { 
																			echo "N/A";
																			} else {
		                                                              ?>
        	<input class="letra_boton11" name="button" type="submit" value="Modificar Usuario" />
        	<input name="iduser" type="hidden" value="<?php echo $row[0]; ?>" /><?php }  ?></td> 
    </form> 
        <td class="pedrcb_td7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>

<?php

	if ($sel_user == "activos" or !$_POST) {

?>

          <form id="form10<?php echo $i; ?>" name="form10<?php echo $i; ?>" method="post" action="<?php echo $target_link2; ?>" target="<?php echo $target_frame; ?>">
            <td align="center"><input class="letra_boton11" type="submit" name="button" id="button" value="Deshabilitar Usuario" />
              <input name="iduser" type="hidden" value="<?php echo $row[0]; ?>" />
              <input name="actualiza" type="hidden" value="moddesactivar" /></td>
          </form>

<?php

	}


	if ($sel_user == "deshabilitados" or $sel_user == "eliminados") {

?>

          <form id="form20<?php echo $i; ?>" name="form20<?php echo $i; ?>" method="post" action="<?php echo $target_link2; ?>" target="<?php echo $target_frame; ?>">
            <td align="center"><input class="letra_boton11" type="submit" name="button" id="button" value="Reactivar Usuario" />
              <input name="iduser" type="hidden" value="<?php echo "$row[0]"; ?>" />
              <input name="actualiza" type="hidden" value="modreactivar" /></td>
          </form>

<?php

	}
	
	if ($sel_user == "eliminados") {

?>

          <form id="form30<?php echo $i; ?>" name="form30<?php echo $i; ?>" method="post" action="<?php echo $target_link2; ?>" target="<?php echo $target_frame; ?>">
            <td align="center"><input class="letra_boton11" type="submit" name="button" id="button" value="Eliminar Contenido" /></td>
          </form>
<?php

	}

	if ($update == "show") {

?>

		  <form id="form40<?php echo $i; ?>" name="form40<?php echo $i; ?>" method="post" action="<?php echo $target_link3; ?>" target="_self" />
            <td align="center"><input class="letra_boton11" type="submit" name="button" id="button" value="Continuar" />
                               <input name="sel_user" type="hidden" value="activos" /></td>
          </form>
<?php

	}


?>
            </tr>
          </table>
</span></td> 
</tr>
<?php
                $i++;
        } // Cierre de While
?>
 
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
		echo '<span class="letra_alertaestado_nopadd">'.$error.'</span>';
		echo '</div>';
	} 


?>


</body>
</html>
