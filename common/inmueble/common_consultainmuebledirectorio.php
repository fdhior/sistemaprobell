<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 4.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

#divVacia {
	background-color: #FFF;
	border: thin solid #FFF;
	width: 100px;
	height: 15px;	
}

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
}

/* Tienda */
.pedrcb_td2 {
    width: 110px;
}

/* RFC */
.pedrcb_td3 {
    width: 120px;
}

/* Direccion */
.pedrcb_td4 {
    width: 353px;
}

/* Zona */
.pedrcb_td5 {
    width: 80px;
}

/* Números */
.pedrcb_td6 {
    width: 66px;
}

/*#apDiv1 {
	position:absolute;
	left:0px;
	top:0px;
	width:772px;
	height:14px;
	z-index:1;
}

#apDiv2 {
    position:absolute;
    left:0px;
    top:0px;
    width:786px;
    height:16px;
    z-index:2;
	border: 1px solid #000;
}*/

-->
</style>
<?php 
        session_start();        

        include $_SESSION['rutafunciones'].'consultas.php';
        include $_SESSION['rutafunciones'].'valida_fechas.php';
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
?>	

<script language="javascript">

	var target_link = 'common_muestranumeros.php';

	function muestraNumeros(idtienda)
	{

		// Centrar la ventana en la pantalla
		var anchoVent=380, altoVent=230; // Se determina el ancho y el alto iniciales de la ventana
		var maxAnchoDisp=screen.availWidth, maxAltoDisp=screen.availHeight; // Se determina el espacio disponible en la pantalla
	
    	/* En las líneas siguientes se calcula la posición inicial de la ventana. Para ello, se resta el tamaño inicial del tamaño disponible y se divide por dos */
		var esqIzq=(maxAnchoDisp-anchoVent)/2;
		var esqSup=(maxAltoDisp-altoVent)/2;

		var nombrevent = "pupMuestraNumeros";
		
		var ventana_a_abrir = window.open(target_link+'?idtienda='+idtienda, nombrevent,'width='+ anchoVent +', height='+ altoVent +',top='+ esqSup +',left='+ esqIzq +',scrollbars=NO,resizable=NO,directories=NO,location=NO,menubar=NO,status=NO,titlebar=NO,toolbar=NO');

		ventana_a_abrir.focus();

	}

	
</script>
	
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
                $cols_arr      = array("idinmu",    // 0
				                       "nombreinmu",          // 1
									   "inmu_dfis.rfc",      // 2
									   "direccion",           // 3
									   "inmu_zona.zona");     // 8
                $num_cols      = count($cols_arr);
                $join_tables   = '1';
                $tables_arr    = array("inmu_dfis", 
				                       "inmu_gdat", 
									   "inmu_zona");
                $num_tables    = count($tables_arr);
				$connect 	   = '1';
	            $on_fields_arr = array("idfis", "idzona");
				$order         = "inmu_dfis.rfc, nombreinmu";
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

	$busc_pattern = 'inmu_gdat.idinmutipo <> 5 AND inmu_gdat.idinmutipo <> 6'; 
				
	if (!isset($busca)) {	
		switch ($sel_sttienda) {
			case "activas":
				$where_clause  = $busc_pattern.' AND inmu_gdat.idinmustat = 1';
				break;				
			case "deshab":	
				$where_clause  = $busc_pattern.' AND inmu_gdat.idinmustat = 2';
				break;
			case "elimn":
				$where_clause  = $busc_pattern.' AND inmu_gdat.idinmustat = 3';
				break;
			default:	
				$where_clause  = $busc_pattern.' AND inmu_gdat.idinmustat = 1';
				break;
		}
	} else {
		switch ($busca) {
			case "poridtienda":
				$where_clause  = "idinmu = '$idtienda'";
				break;
			case "pornombre":
				$where_clause  = "nombreinmu LIKE '%$ntienda%'";
				break;

		}		
	}	
				

// ---------------------------- FIN DE EVALUACIONES DE BUSQUEDA ------------------------------------------------


        // Llama a la funci&oacute;n de las consultas
                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

				$mquery_nrows=mysql_num_rows($result);                


?>                
<!--</p>-->

<div id="apDiv1"> 
<table id="tablaLista" border="0" cellpadding="0" cellspacing="0">
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
    
        <td class="pedrcb_td1" valign="top"><a name="<?php echo 'fila'.$row[0]; ?>"></a><?php echo $row[0];       // No.           ?></td>
        <td class="pedrcb_td2"><?php echo $row[1];       // Nombreusuario ?></td>
        <td class="pedrcb_td3"><?php echo $row[2];       // Tienda        ?></td>
        <td class="pedrcb_td4"><?php echo $row[3];       // Correoe       ?></th>
        <td class="pedrcb_td5"><?php echo $row[4];       // Status        ?></td>
        <td class="pedrcb_td6"><a href="#<?php echo 'fila'.$row[0]; ?>" onclick="javascript: muestraNumeros(<?php echo $row[0]; ?>)">[Detalle]</a></td> 
        
</tr>
<?php
                $i++;
        } // Cierre de While
		
?>		
	</table>	

<?php		

	if ($mquery_nrows > 2) {
		for ($i=0; $i < 25; $i++) {                

	 		echo '<div id="divVacia"></div>';
		} // Cierre de for 
	
	} // Cierre de if ?>    

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

