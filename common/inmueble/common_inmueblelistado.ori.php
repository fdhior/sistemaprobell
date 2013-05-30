<style type="text/css">
<!--

.row-odd {
	BACKGROUND-COLOR: #D8ECF5
}

.row-even {
	BACKGROUND-COLOR: #FFFFFF
}

.tipoletra {
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
.pedrcb_td1 { 
        width: 31px;
        position: relative;
/*      border: 1px solid #000000; */
        left: 0px;
        text-align: center;
}

/* Archivo */
.pedrcb_td2 {
        width: 110px;
/*      border: 1px solid #000000; */
        position: relative;
        left: 0px;
        text-align: center;
}

/* Tamaño */
.pedrcb_td3 {
        width: 150px;
/*      border: 1px solid #000000; */
        position: relative;
        left: 0px;
        text-align: center;
}

/* Almacen Origen */
.pedrcb_td4 {
        width: 120px;
/*      border: 1px solid #000000; */
        position: relative;
        left: 0px;
        text-align: center;
}

/* Enviado en */
.pedrcb_td5 {
        width: 100px;
/*      border: 1px solid #000000; */
        position: relative;
        left: 0px;
        text-align: center;
}

/* Descargar */
.pedrcb_td6 {
        width: 150px;
/*      border: 1px solid #000000; */
        position: relative;
        left: 0px;
        text-align: center;
}

.pedrcb_td7 {
        width: 274px;
/*      border: 1px solid #000000; */
        position: relative;
        left: 0px;
        text-align: center;
}

.letra_boton {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 9px;
        font-weight: normal;
        font-variant: small-caps;
}

-->
</style>

<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
#apDiv1 {
        position:absolute;
        left:0px;
        top:0px;
        width:968px;
        height:14px;
        z-index:1;
}
#apDiv2 {
        position:absolute;
        left:0px;
        top:0px;
        width:968px;
        height:16px;
        z-index:2;
}

#apDiv3 {
        position:absolute;
        left:0px;
        top:0px;
        width:968px;
        height:16px;
        z-index:2;
}
-->
</style>
<div id="apDiv1"> 
<table border="1" cellpadding="0" cellspacing="0">
    <?php 
        session_start();        
        include "consultas.php";
        include "valida_fechas.php";
        date_default_timezone_set('America/Mexico_City');

        $hostname     = $_SESSION['hostname'];
        $idusrarea    = $_SESSION['idusrarea'];
        $userinmuid   = $_SESSION['userinmuid'];

		$target_link   = "common/inmueble/common_modificainmueble.php";
//		$target_link2  = "supervision/usuarios/supervision_actualizausuario.php";
		$target_link3  = "common/inmueble/common_inmueblelistado.php";
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
                //                        0          1           2              3                    4                    5
                $cols_arr      = array("inmu_gdat.idinmu", "nombreinmu", "inmu_tipo.tipo", "gnrl_enca.nombre", "inmu_stat.estado");
                $num_cols      = count($cols_arr);
                $join_tables   = '1';
                $tables_arr    = array( "inmu_tipo", "inmu_gdat", "gnrl_enca", "inmu_stat");
                $num_tables    = count($tables_arr);
				$connect 	   = '1';
	            $on_fields_arr = array("idinmutipo", "idenc", "idinmustat");
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
    
        <td class="pedrcb_td1"><span class="tipoletra"><?php echo "$row[0]"; // No. ?></span></td>
        <td class="pedrcb_td2"><span class="tipoletra"><?php echo "$row[1]"; // Nombreusuario ?></span></td>
        <td class="pedrcb_td3"><span class="tipoletra"><?php echo "$row[2]"; // Tienda ?></span></td>
        <td class="pedrcb_td4"><span class="tipoletra"><?php
															if ($row[3] == "") {
																echo "No Registrado";
															} else {
																echo "$row[3]";
															}	 // Correoe ?></span></th>
        <td class="pedrcb_td5"><span class="tipoletra"><?php echo "$row[4]"; // Status ?></span></td>
	<form name="form<?php echo "$i"; ?>" id="form<?php echo "$i"; ?>" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
        <td class="pedrcb_td6" align="center"><span class="tipoletra"><?php if ($sel_sttienda == "elimn" or $sel_sttienda == "deshab" or $update == "show") { 
																			echo "N/A";
																			} else {
		                                                              ?>
        	<input class="letra_boton" name="button" type="submit" value="Modificar Tienda"  />
        	<input name="idinmu" type="hidden" value="<?php echo "$row[0]"; ?>" />
            <input name="modoed" type="hidden" value="editatienda" /></span><?php }  ?></td> 
    </form> 
        <td class="pedrcb_td7"><span class="tipoletra"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>

<?php

	if ($sel_sttienda == "activas" or !$_POST) {

?>

          <form id="form10<?php echo "$i"; ?>" name="form10<?php echo "$i"; ?>" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
            <td align="center"><input name="button" type="submit" class="letra_boton" id="button" value="Editar Encargado" />
              <input name="idinmu" type="hidden" value="<?php echo "$row[0]"; ?>" />
              <input name="modoed" type="hidden" value="editaencargado" /></td>
          </form>

          <form id="form10<?php echo "$i"; ?>" name="form10<?php echo "$i"; ?>" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
            <td align="center"><input class="letra_boton" type="submit" name="button" id="button" value="Desactivar Tienda" />
              <input name="iduser" type="hidden" value="<?php echo "$row[0]"; ?>" />
              <input name="modoed" type="hidden" value="desactivartienda" /></td>
          </form>

<?php

	}


	if ($sel_sttienda == "deshab" or $sel_sttienda == "elimn") {

?>

          <form id="form20<?php echo "$i"; ?>" name="form20<?php echo "$i"; ?>" method="post" action="<?php echo "$hostname$target_link2"; ?>" target="<?php echo "$target_frame"; ?>">
            <td align="center"><input class="letra_boton" type="submit" name="button" id="button" value="Reactivar Tienda" />
              <input name="iduser" type="hidden" value="<?php echo "$row[0]"; ?>" />
              <input name="actualiza" type="hidden" value="modreactivar" /></td>
          </form>

<?php

	}
	
	if ($sel_sttienda == "elimn") {

?>

          <form id="form30<?php echo "$i"; ?>" name="form30<?php echo "$i"; ?>" method="post" action="<?php echo "$hostname$target_link2"; ?>" target="<?php echo "$target_frame"; ?>">
            <td align="center"><input class="letra_boton" type="submit" name="button" id="button" value="Eliminar Contenido" /></td>
          </form>
<?php

	}

	if ($update == "show") {

?>

		  <form id="form40<?php echo "$i"; ?>" name="form40<?php echo "$i"; ?>" method="post" action="<?php echo "$hostname$target_link3"; ?>" target="_self" />
            <td align="center"><input class="letra_boton" type="submit" name="button" id="button" value="Continuar" />
                               <input name="sel_sttienda" type="hidden" value="activas" /></td>
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
                echo "</table>";
                echo "</div>";

                if (isset($_POST['busca']) and mysql_num_rows($result) < 1) {
?>
<div id="apDiv2">
  <table align="center" width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td scope="col"><span class="tipoletra">No se encontraron resultados para esta busqueda</span></td>
    </tr>
  </table>
</div> 
<?php
                } else {

                        if (!isset ($_POST['busca']) and mysql_num_rows($result) < 1) {// Cierre de if busqueda
?>
<div id="apDiv3">
  <table align="center" width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td scope="col"><span class="tipoletra">Por el momento no hay informacion que mostrar</span></td>
    </tr>
  </table>
</div> 
<?php

                        }
                } // Cierre de else
        } // Cierre de if si no hay error
// unset($_POST['ntpass']);

        if (isset($error)) {
?>
  <table align="center" width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td scope="col"><span class="letra_alertaestado"><?php echo "$error"; ?></span></td>
    </tr>
  </table>
  
<?php
        } // Cierre de if error
?>  

