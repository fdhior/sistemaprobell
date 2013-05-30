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
}

/* Archivo */
.pedrcb_td2 {
	width: 106px;
}

/* Tamaño */
.pedrcb_td3 {
    width: 110px;
}

/* Almacen Origen */
.pedrcb_td4 {
    width: 110px;
}

/* Enviado en */
.pedrcb_td5 {
    width: 170px;
}

/* Descargar */
.pedrcb_td6 {
    width: 170px;
}

.pedrcb_td7 {
	width: 72px;
}

.pedrcb_td8 {
	width: 169px;
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

</head>

<body>

    <?php 
        session_start();        

		$rutafunciones = $_SESSION['rutafunciones'];
		include $rutafunciones.'consultas.php';
        include $rutafunciones.'valida_fechas.php';
        date_default_timezone_set('America/Mexico_City');

        $hostname   = $_SESSION['hostname'];
        $idusrarea  = $_SESSION['idusrarea'];
        $userinmuid = $_SESSION['userinmuid'];

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

        if (isset($busca)) {
                switch ($busca) {
                        case "pordestino":
                                if ($sel_destino == 'Elige un Destino') {
                                        $error = "Error: Elige un Destino V&aacute;lido de la lista";
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

/* ---------------------------------------- TERMINAVALIDACION DE DATOS ---------------------------- */



        if (!isset($error)) {

                $cols_arr = array("idtras",                // 1
				                  "archivo",               // 2
								  "origen",                // 3 
								  "inmu_gdat.nombreinmu",  // 4
								  "fechaenvio",            // 5  
								  "fechadescarga",         // 6
								  "descargado");           // 7  
                $num_cols = count($cols_arr);
                $join_tables = '1';
                $tables_arr = array("inmu_gdat", "sucr_tlog");
                $num_tables = count($tables_arr);
                $on_fields_arr = array("idinmu");

                switch ($orden) {
                         case "pororigen":
                                $order = "sucr_tlog.origen";
                                break;
                        case "pordestino":
                                $order = "gnrl_usrs.nombre";
                                break;
                        case "porfechaenv":
                                $order = "sucr_tlog.fechaenvio";
                                break;
                        case "porfechadesc":
                                $order = "sucr_tlog.fechadescarga";
                                break;
                        default:
                                $order = "sucr_tlog.fechaenvio";
                }

                if ($orden == "pororigen" or $orden == "pordestino") {
                        $dir = "ASC";
                } else {
                        $dir = "DESC";
                }        

// ---------------------------- INICIO EVALUACIONES DE BUSQUEDA ------------------------------------------------
// Se determina que buscar modificando la variable where_clausa

        // Patr&oacute;n reutilizable de busqueda
                switch ($sel_origen) {
                        case "Todos":
                                $buscpattern1 = "(origen = 0 OR origen = 20)";
                                break;
                        case "CEDIS":
                                $buscpattern1 = "origen = 0";
                                break;
                        case "Muebles":
                                $buscpattern1 = "origen = 20";
                                break;
                        default:
                                $buscpattern1 = "(origen = 0 OR origen = 20)";
                                break;
                }

        // Si no se define una busqueda
        
                if (!isset($busca)) {
                        $where_clause = $buscpattern1;
                } else { // cierrre if nobusqueda inicio else
                        switch ($busca) { // Inicio switch ($busqueda)
                                case "pordestino";
                                        if ($sel_destino == "Todos") {
                                                $where_clause = $buscpattern1;
                                        } else {
                                                $where_clause = $buscpattern1." AND gnrl_usrs.nombre = '$sel_destino'";
                                        }
                                        break;
                                case "pornombre":
                                        $where_clause = $buscpattern1." AND sucr_tlog.archivo LIKE '%$nombre_archivo%'";
                                        break;
                        } // Cierre de switch
                } // cierre else */

                if ($filtfecha == "on") {
                        $where_clause = $where_clause." AND (sucr_tlog.fechaenvio BETWEEN '$fechainicio 00:00:00' AND '$fechafin 23:59:59')";
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
        <td class="pedrcb_td3"><?php
                                                                                               switch ($row[2]) {
                                                                                               case "0":
                                                                                                echo "CEDIS";
                                                                                                break;
                                                                                               case "20":
                                                                                                echo "Muebles";
                                                                                                break;
                                                                                                   } // Almacen Origen ?></td>
        <td class="pedrcb_td4"><?php echo $row[3]; // Tienda Destino ?></th>
        <td class="pedrcb_td5"><?php echo $row[4]  // Enviado el Día ?></td>
        <td class="pedrcb_td6"><?php
                                                                                                                        if ($row[5] == "0000-00-00 00:00:00") {
                                                                                                                                echo "No ha sido descargado";
                                                                                                                        } else {
                                                                                                                                echo $row[5];
                                                                                                                        } // Descargado el Día ?></td>
         <td class="pedrcb_td7"><?php
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
         <td class="pedrcb_td8">&nbsp;</td>
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
		echo '<span class="letra_alertaestado_nopadd">'.$error.'</span>';
		echo '</div>';
	} 


?>


</body>
</html>
