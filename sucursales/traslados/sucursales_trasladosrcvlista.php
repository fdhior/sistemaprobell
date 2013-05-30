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
.traslst_td1 { 
    width: 25px;
    border: 1px solid #CCC; 
	text-align: center;
}

/* Archivo */
.traslst_td2 {
    width: 83px;
    border: 1px solid #CCC; 
	text-align: center;
}

/* Tamaño */
.traslst_td3 {
    width: 68px;
    border: 1px solid #CCC; 
	text-align: center;
}

/* Almacen Origen */
.traslst_td4 {
    width: 107px;
    border: 1px solid #CCC; 
	text-align: center;
}

/* Enviado en */
.traslst_td5 {
    width: 171px;
    border: 1px solid #CCC; 
	text-align: center;
}

/* Descargar */
.traslst_td6 {
    width: 171px;
    border: 1px solid #CCC; 
	text-align: center;
}

/* Descargar */
.traslst_td7 {
    width: 104px;
    border: 1px solid #CCC; 
	text-align: center;
}

/* Descargar */
.traslst_td8 {
    width: 209px;
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


//        echo $_SERVER['DOCUMENT_ROOT']."sistemaprobell/consultas.php";
		$hostname    = $_SESSION['hostname'];
        $idusrarea   = $_SESSION['idusrarea'];
        $userinmuid  = $_SESSION['userinmuid'];
		
		$rel_path    = 'sucursales/traslados/sucursales_';
		$target_link = $hostname.$rel_path.'trasladosdescarga.php';

/*      echo "<span class=\"tipoletra\">Valores de _POST</span><br />";
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />";
                }
        } */

?>
</head>

<body>


<?php

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

        // Verificación de Datos
        if (isset($busca)) {
                switch ($busca) {
                        case "pororigen":
                                if ($sel_origen == 'Elige un Origen') {
                                        $error = "Error: Elige un Origen V&aacute;lido de la lista";
                                }
                                break;
                        case "pornombre":
                                if ($nombre_archivo == '') {
                                        $error = "Error: Debes teclear un nombre de archivo en el recuadro de b&uacute;squeda";
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
                              if ($compareres > 0) {
                                      $error  = "Error la fecha inicial es mayor que fecha final";
                              }

                        }
                }
        }


        if (!isset($error)) {

                // Definicion de los parametros de la consulta
                $cols_arr = array("idtras", 
								  "archivo", 
								  "tamano", 
								  "origen", 
								  "fechaenvio", 
								  "fechadescarga", 
								  "num_descargas");
                $num_cols = count($cols_arr);
                $join_tables = '0';
                $tables_arr = array("sucr_tlog");
                $num_tables = count($tables_arr);

                switch ($orden) {
                        case "pororigen":
                                $order = "sucr_tlog.origen";
                                break;
                        case "porfecha":
                                $order = "sucr_tlog.fechaenvio";
                                break;
                        default:
                                $order = "sucr_tlog.fechaenvio";
                }
                if ($orden == "pororigen") {
                        $dir = "ASC";
                } else {
                        $dir = "DESC";
                }

// ---------------------------- INICIO EVALUACIONES DE BUSQUEDA ------------------------------------------------
// Se determina que buscar modificando la variable where_clausa

        // Patr&oacute;n reutilizable de busqueda
                $buscpattern1 = "(sucr_tlog.idinmu = '$userinmuid' AND sucr_tlog.descargado = 1) OR (sucr_tlog.archivo LIKE '%AD0%' AND sucr_tlog.descargado = 1)";

        // Si no se define una busqueda
                if (!isset($busca)) {
                        $where_clause = $buscpattern1;
                } else { // cierrre if nobusqueda inicio else
                        switch ($busca) { // Inicio switch ($busqueda)
                                case "pororigen":
                                        switch($sel_origen) {
                                                case "Todos":
                                                        $where_clause = $buscpattern1;
                                                        break;
                                                case "CEDIS":
                                                        $where_clause = $buscpattern1." AND origen = '0'";
                                                        break;
                                                case "Muebles":
                                                        $where_clause = $buscpattern1." AND origen =  '20'";
                                                        break;
                                        }
                                        break;
                                case "pornombre":
                                        $where_clause = "sucr_tlog.archivo LIKE '%$nombre_archivo%'";
                                        break;
                        } // Cierre de switch

                } // cierre else

                if ($filtfecha == "on") {
                        $where_clause = $where_clause." AND sucr_tlog.fechaenvio BETWEEN '$fechainicio 00:00:00' AND '$fechafin 23:59:59'";
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

                $i = 0;
				$j = 1;
                while($row=mysql_fetch_row($result)){

                        switch ($row[3]) {
                                case "0":
                                        $path_todown = $hostname.'tras_almacen';
                                        break;
                                case "20":
                                        $path_todown = $hostname.'tras_muebles';
                                        break;
                        }
?>

<script>
    function abreventana<?php  echo "$i"; ?>(){
                window.open("<?php echo $path_todown; ?>/<?php echo $row[1]; ?>","Descargatraslado","width=32,height=32,top=0,left=0,scrollbars=NO,resizable=NO,directories=NO,location=NO,menubar=NO,status=NO,titlebar=NO,toolbar=NO");
    }
</script>

        <tr class="<?php

                                      $oddevencheck = $j % 2;
                                          if ($oddevencheck == 0) {
                                                echo "row-even";
                                          } else {
                                                echo "row-odd";
                                          }
                           ?>">
     <form id="form<?php echo $i; ?>" name="form<?php echo $i; ?>" method="post" action="<?php echo $target_link; ?>">
        <td class="traslst_td1"><?php echo $row[0];         // Nombre del Archivo ?></td>
        <td class="traslst_td2"><?php echo $row[1];         // Fecha y Hora de Envio ?></td>
        <td class="traslst_td3"><?php echo $row[2].'Bytes'; // Observaciones ?></td>
        <td class="traslst_td4"><?php
						 		       switch ($row[3]) {
							               case "0":
						                        $dest_parse = "CEDIS";
												break;
							               case "20":
						                        $dest_parse = "Muebles";
                        						break;
								       }                       
								       echo $dest_parse; // Destino ?></span></th>

      <td class="traslst_td5"><?php echo $row[4]; // Fecha y Hora de Envio ?></td>
      <td class="traslst_td6"><?php echo $row[5]; // Fecha y Hora de Descarga (1ra Vez) ?></td>
      <td class="traslst_td7"><?php
                              		if ($row[6] == 1) {
                                    	echo $row[6].' vez';
                                    } else {
                                        echo $row[6].' veces';
                                    } // Veces Descargado ?></td>
      <td class="traslst_td8"><input type="hidden" name="idtras" id="idtras" value="<?php echo $row[0]; ?>" />
<!-- <input type="hidden" name="file" id="file" value="<?php // echo "$row[1]"; ?>" /> -->
        <input type="hidden" name="origen" id="origen" value="<?php echo $row[3]; ?>" />
        <input type="hidden" name="deformulario" id="deformulario" value="<?php echo $_SERVER['PHP_SELF']; ?>" />
            <input class="letra_boton11" type="submit" name="button" id="button" value="Volver a Descargar" onclick="javascript: abreventana<?php echo $i; ?>()" /></td>
     </form>
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
				echo '<span class="letra_predeterminada">Por el momento no tienes traslados descargados</span>';
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