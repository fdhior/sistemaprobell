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


.traslst_td1 {
	width: 40px;
	border: 1px solid #CCC;
	text-align: center;
}

.traslst_td2 {
    width: 106px;
	border: 1px solid #CCC;
	text-align: center;
	height: 25px;
}

.traslst_td3 {
    width: 83px;
	border: 1px solid #CCC;
	text-align: center;
}

.traslst_td4 {
    width: 203px;
	border: 1px solid #CCC;
	text-align: center;
}

.traslst_td5 {
    width: 181px;
	border: 1px solid #CCC;
	text-align: center;
}

.traslst_td6 {
    width: 152px;
	border: 1px solid #CCC;
	text-align: center;
}

.traslst_td7 {
    width: 175px;
	border: 1px solid #CCC;
	text-align: center;
}

#apDiv1 {
	position:absolute;
	left:0px;
	top:0px;
	width:954px;
	height:14px;
	z-index:1;
	/*border: 1px solid #000;*/
}

#apDiv2 {
	position:absolute;
	left:0px;
	top:0px;
	width:968px;
	height:16px;
	z-index:2;
	border: 1px solid #000;
}
-->
</style>
<?php 

        session_start();
        include $_SESSION['rutafunciones'].'consultas.php';
        include $_SESSION['rutafunciones'].'valida_fechas.php';
        date_default_timezone_set('America/Mexico_City');

        $idusrarea = $_SESSION['idusrarea'];
        $userinmuid = $_SESSION['userinmuid'];
        
/*      echo "<span class=\"tipoletra\">Valores de _POST</span><br />";
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />";
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
        
        // Verificación de Datos
        if (isset($busca)) {
                switch ($busca) {
                        case "pordestino":
                                if ($sel_destino == 'Elige un Destino') {
                                        $error = "Error: Elige un Destino V&aacute;lido de la lista";
                                }
                                break;
                        case "pornombre":
                                if ($nombre_archivo == '') {
                                        $error = "Error: Debes teclear el texto a buscar en el nombre de archivo";
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
//                             echo "valor de compareres: $compareres";
                               if ($compareres > 0) {
                                       $error  = "Error la fecha inicial es mayor que fecha final";
                               }

                               // Si la fecha inicial y final son iguales
                              if ($compareres == "0") {
                                      $error  = "Error la fecha inicial y final son iguales";
                              }
                        }
                }
        }



        if (!isset($error)) {
                // Definicion de los parametros de la consulta

                $cols_arr = array("idtras",
				                  "archivo", 
								  "tamano", 
								  "inmu_gdat.nombreinmu", 
								  "fechaenvio", 
								  "descargado");
                $num_cols = count($cols_arr);
                $join_tables = '1';
                $tables_arr = array("inmu_gdat", "sucr_tlog");
                $num_tables = count($tables_arr);
                $on_fields_arr = array("idinmu");

                switch ($orden) {
                        case "pordestino":
                                $order = "gnrl_usrs.nombre";
                                break;
                        case "porfecha":
                                $order = "sucr_tlog.fechaenvio";
                                break;
                        default:
                                $order = "sucr_tlog.fechaenvio";
                }
                if ($orden == "pordestino") {
                        $dir = "ASC";
                } else {
                        $dir = "DESC";
                }


// ---------------------------- INICIO EVALUACIONES DE BUSQUEDA ------------------------------------------------
// Se determina que buscar modificando la variable where_clausa

        // Patr&oacute;n reutilizable de busqueda
                $buscpattern1 = "sucr_tlog.origen = '$userinmuid'";

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
/*                              case "porrangofechas":
                                        $where_clause = $buscpattern1." AND sucr_tlog.fechaenvio BETWEEN '$fechainicio 00:00:00' AND '$fechafin 23:59:59'";
                                        break; */
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
  <table border="0" cellpadding="0" cellspacing="0">

<?php
				$i = 1;
                while($row=mysql_fetch_row($result)){

?>

    <tr class="<?php

                                      $oddevencheck = $j % 2;
                                          if ($oddevencheck == 0) {
                                                echo "row-even";
                                          } else {
                                                echo "row-odd";
                                          }
                           ?>">
      <td class="traslst_td1"><?php echo $row[0]; // No. ?></td>
      <td class="traslst_td2"><?php echo $row[1]; // Traslado ?></td>
      <td class="traslst_td3"><?php echo $row[2]; // Tamaño ?></td>
      <td class="traslst_td4"><?php echo $row[3]; // Destino ?></td>
      <td class="traslst_td5"><?php echo $row[4]; // Fecha de Envio ?></td>
      <td class="traslst_td6">
          <?php
          switch ($row[5]) {
                        case "0":
                                echo "No";
                                break;
                        case "1":
                                echo "Si";
                                break;
                  }     
                                
          // Descargado en destino ?></span></th>
       <th class="traslst_td7">&nbsp;</th>
   </tr>
<?php
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
				echo '<span class="letra_predeterminada">Por el momento no has enviado ningun Traslado</span>';
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