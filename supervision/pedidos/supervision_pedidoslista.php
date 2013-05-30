<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--

#tablaLista td {
	text-align: center;
	height: 40px;
	border: 1px solid #CCC;
}

/* No. */
.pedrcb_td1 { 
        width: 31px;
        text-align: center;
}

/* Archivo */
.pedrcb_td2 {
        width: 84px;
        text-align: center;
}

/* Tamaño */
.pedrcb_td3 {
        width: 110px;
        text-align: center;
}

/* Almacen Origen */
.pedrcb_td4 {
        width: 110px;
        text-align: center;
}

/* Enviado en */
.pedrcb_td5 {
        width: 170px;
        text-align: center;
}

/* Descargar */
.pedrcb_td6 {
        width: 170px;
        text-align: center;
}

.pedrcb_td7 {
        width: 187px;
        text-align: center;
}

.pedrcb_td8 {
        width: 75px;
        text-align: center;
}

#apDiv1 {
        position:absolute;
        left:0px;
        top:0px;
        width:953px;
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
		
        include $_SESSION['rutafunciones'].'consultas.php';
        include $_SESSION['rutafunciones'].'valida_fechas.php';
        date_default_timezone_set('America/Mexico_City');

        $hostname   = $_SESSION['hostname'];
        $idusrarea  = $_SESSION['idusrarea'];
        $userinmuid = $_SESSION['userinmuid'];

        // Mostrar los valores de _POST
 /*     echo "Valores de _SERVER <br />";
        foreach ($_SERVER as $nombre => $valor) {
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
                //                   0         1               2                 3                 4                5               6              7      8
                $cols_arr = array("idped",
				                  "archivo",
								  "inmu_gdat.nombreinmu",
								  "fechahoraenvio", 
								  "fechadescarga", 
								  "observaciones", 
								  "num_descargas", 
								  "destino");
                $num_cols = count($cols_arr);
                $join_tables = '1';
                $tables_arr = array("inmu_gdat", 
				                    "sucr_plog");
                $num_tables = count($tables_arr);
                $on_fields_arr = array("idinmu");

//      $connect = '0';
//      $on_fields_arr = array("idinmu", "iduser", "idarea");
                switch ($orden) {
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
                                $order = "sucr_plog.fechahoraenvio";                }
                if ($orden == "pororigen" or $orden == "pordestino") {
                        $dir = "ASC";   
                } else {
                        $dir = "DESC";
                }       
        

// ---------------------------- INICIO EVALUACIONES DE BUSQUEDA ------------------------------------------------
// Se determina que buscar modificando la variable where_clausa

        // Patr&oacute;n reutilizable de busqueda
                switch ($sel_destino) {
                        case "Todos":
                                $buscpattern1 = "(destino = 0 OR destino = 20)";
                                break;
                        case "CEDIS":
                    $buscpattern1 = "destino = 0";
                                break;
                        case "Muebles":
                    $buscpattern1 = "destino = 20";
                                break;
                        default:
                                $buscpattern1 = "(destino = 0 OR destino = 20)";
                                break;
                }       

        // Si no se define una busqueda
        
                if (!isset($busca)) {
                        $where_clause = $buscpattern1;
                } else { // cierrre if nobusqueda inicio else
                        switch ($busca) { // Inicio switch ($busqueda)
                                case "pororigen";
                                if ($sel_origen == "Todos") {
                            $where_clause = $buscpattern1;
                            } else {
                            $where_clause = $buscpattern1." AND gnrl_usrs.nombre = '$sel_origen'";
                            }
                        break;
                        case "pornombre":
                        $where_clause = $buscpattern1." AND sucr_plog.archivo LIKE '%$nombre_archivo%'";
                            break;
                                        } // Cierre de switch
                                } // cierre else */

                if ($filtfecha == "on") {
                        $where_clause = $where_clause." AND (sucr_plog.fechahoraenvio BETWEEN '$fechainicio 00:00:00' AND '$fechafin 23:59:59')";
                }

                if (!isset($busca)) {
                        $limit = "100";
                }

// ---------------------------- FIN DE EVALUACIONES DE BUSQUEDA ------------------------------------------------


        // Llama a la funci&oacute;n de las consultas
                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

				$mquery_nrows=mysql_num_rows($result);

?>

<div id="apDiv1">
<table id="tablaLista" border="0" cellpadding="0" cellspacing="0">

<?php
    
                $i = 0;
                $j = 1;
                while($row=mysql_fetch_row($result)) {

?>

        <tr class="<?php

                                      $oddevencheck = $j % 2;
                                          if ($oddevencheck == 0) {
                                                echo "row-even";
                                          } else {
                                        echo "row-odd";
                                          }
                           ?>">
        <td class="pedrcb_td1"><?php echo $row[0]; // No. Archivo ?></td>
        <td class="pedrcb_td2"><?php echo $row[1]; // Nombre del Archivo ?></td>
        <td class="pedrcb_td3"><?php echo $row[2]; // Tienda Origen ?></td>
        <td class="pedrcb_td4"><?php
                                                                                               switch ($row[7]) {
                                                                                               case "0":
                                                                                                echo "CEDIS";
                                                                                                break;
                                                                                               case "20":
                                                                                                echo "Muebles";
                                                                                                break;
                                                                                                   } // Almacen Destino ?></span></th>
         <td class="pedrcb_td5"><?php echo $row[3]; // Enviado el Día ?></td>
         <td class="pedrcb_td6"><?php
                                                                                                                        if ($row[4] == "0000-00-00 00:00:00") {
                                                                                                                                echo "No ha sido descargado";
                                                                                                                        } else {
                                                                                                                                echo $row[4];
                                                                                                                        } // Descargado el Día ?></span></td>
         <td class="pedrcb_td7"><?php echo "$row[5]" // Observaciones ?></td>
         <td class="pedrcb_td8"><?php

                                                             switch ($row[6]) {
                                                                case "0":
                                                                                                                                        echo "N/A";
                                                                                                                                        break;
                                                                                                                                case "1":
                                                                                                                                        echo "$row[6] vez";
                                                                                                                                        break;
                                                                     default:
                                                                                                                                    echo "$row[6] veces";
                                                                                                                                        break;
                                                             } // Veces Descargado ?></td>
</tr>
<?php
                $i++;
                $j++;
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
		echo '<span class="letra_alertaestado">'.$error.'</span>';
		echo '</div>';
	} 


?>


</body>
</html>
