<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.letraaduser {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    font-weight: normal;
    color: #000000;
    padding-left: 26px;
	left: 26px;
	margin-left: 26;
}

.letraaduser_nopadd {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    font-weight: normal;
    color: #000000;
	left: 26px;
}

.tablacontagremp {
	border: 1px solid #000;
}

.tablaagremp {
	width: 800px;
}

.tablaagremp_td1 {
	width: 200px;
	border: 1px solid #000;
	padding-top: 18px;
	padding-right: 5px;
	padding-bottom: 5px;
	padding-left: 5px;
}

.tablaagremp_td2 {
	/*	width: 200px;*/
	margin: 10px;
	padding: 5px;
	border: 1px solid #000;
	vertical-align: top;
}

.texto_tarjeta {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	font-variant: small-caps;
	vertical-align: top;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	padding: 10px;
}

.texto_contra {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	vertical-align: top;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	padding: 2px;
	color: #C00;
	font-variant: normal;
}

#div1 {
	position: relative;
	left: 26px;
}
-->
</style>
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php
    session_start();

	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';
	include $rutafunciones.'valida_fechas.php';
	include $rutafunciones.'valida_correo.php';

    $hostname = $_SESSION['hostname'];
	$relpath  = "supervision/asistencia/"; 
		
 	/*echo "<span class=\"tipoletra\">Valores de _GET</span><br />";
	foreach ($_GET as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
		}
	}*/  

//	print_r($_SESSION['var_return']);

     // Convertir vaariables POST en locales
	if ($_GET) {	
		$ejecuta = $_GET['ejecuta']; 
	} else {		
		foreach ($_POST as $nombre => $valor) {
	    	if(stristr($nombre, 'button') === FALSE) {
	   	    	 ${$nombre} = $valor;
			}
		}
	 }     

//	echo "$encargado";
	
	/* --------------------------------------- INICIA VALIDACION DE DATOS ---------------------------- */
	switch($ejecuta) {
		case "1":
			if (trim($_POST['fechanac']) == "") {	
				$error = "Ingresa una fecha en el formato indicado o dando clic en el boton seleccionar fecha";
				$error_id = "1";
			} else {	 
	            $checa_fecha = checkDateFormat($fechanac);
				if (($checa_fecha == false)) {
					$error    = "Error en la fecha fecha introducida, el formato es AAAA-MM-DD (año, mes, dia) y debe ser v&aacute;lida";
					$error_id = "1";
				} else {
					if (!is_numeric($nss) and $nss <> "") {
						$error = "El dato necesita ser un n&uacute;mero";
						$error_id = "2"; 
					} else {
						if (!is_numeric($notelefonico) and $notelefonico <> "") {
							$error = "El dato necesita ser un n&uacute;mero";
							$error_id = "3"; 
						} else {			
							if (trim($correoe) <> "" and comprobar_email($correoe) == "0") {
								$error = "Hay un error en la escritura de esta direcci&oacute;n de correo";
								$error_id = 4;
							} else {
								if ($sel_inmu == "Elige un Lugar de Trabajo") {
									$error = "Elige el lugar de trabajo del empleado";	
									$error_id = 5;
								}				
							}
						}
					}
				}
			}
			
			if (isset($error)) {
		
				$_SESSION['err_return'] = array("errorpass" => "$error", "error_id" => "$error_id", "invalid_check" => "1");
				foreach ($_POST as $nombre => $valor) {
	    			if(stristr($nombre, 'button') === FALSE and stristr($nombre, 'ejecuta') === FALSE) {
						$_SESSION['err_return'][$nombre] = $valor;
					}
				}

			} else {	
			
				$_SESSION['var_return'] = array("agr_empleado" => "2");
				foreach ($_POST as $nombre => $valor) {
	    			if(stristr($nombre, 'button') === FALSE and stristr($nombre, 'ejecuta') === FALSE) {
						$_SESSION['var_return'][$nombre] = $valor;
					}
				}
			}

			header("Location: ".$_SERVER['HTTP_REFERER']."");
			exit();

			break;
		
		case "2":

			$var_return = $_SESSION['var_return'];
			foreach ($var_return as $nombre => $valor) {
			   	${$nombre} = $valor;
			} // Cierre foreach     
			
			

			$check_timestamp = $_SESSION['check_timestamp'];
			$file_name       = $_SESSION['file_name'];
			$idempleado      = $_SESSION['idemp_pass'];

			unset($_SESSION['var_return']);
			unset($_SESSION['check_timestamp']);
			unset($_SESSION['file_name']);
			unset($_SESSION['idemp_pass']);		

	        
			$cols_arr = array("tipoempleado");
			$num_cols = count($cols_arr);
			$tables_arr = array("gnrl_temp");
			$where_clause = "idtempleado = '$sel_templeado'";

			$temp_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

			$templeado=mysql_fetch_row($temp_rset);

			
			$cols_arr     = array("idinmu");
	        $num_cols     = count($cols_arr);
	        $tables_arr   = array("inmu_gdat");
    	    $num_tables   = count($tables_arr);
			$where_clause = "nombreinmu = '$sel_inmu'";

	  		$inmu_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
			
			unset($where_clause);

		    $idinmu=mysql_fetch_row($inmu_rset);

			// Generar contraseña
			$text_contra = 'pbemp'.$idempleado;
			
			$contra = MD5($text_contra);
			
			$exploded_fecha = explode("-", $fechanac);
			$anio_actual = date('Y');
			$edad = $anio_actual - $exploded_fecha[0]; 
			
			$noempleado = $idempleado;
			
    		// Recuperar el numero de usuario que se asigno al registrar la huella del usuario
	 		$cols_arr      = array("MAX(idempleado)");
			$num_cols      = count($cols_arr);
			$tables_arr    = array("gnrl_empl");

			$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

		    $noUsusario=mysql_fetch_row($result);
			
			// Inserta registro de el resto de los datos del nuevo empleado en la base de datos
			$colsvalarr = array("nombres        = '$nombres'", 
							    "apaterno       = '$apaterno'", 
							    "amaterno       = '$amaterno'", 
							    "idtempleado    = '$sel_templeado'", 
							    "fechanac       = '$fechanac'", 
							    "nss            = '$nss'", 
							    "direccion      = '$direccion'", 
							    "notelefonico   = '$notelefonico'", 
							    "correoe        = '$correoe'", 
							    "idinmu         = '$idinmu[0]'", 
                                "capturainicial = '$file_name'", 
							    "fecha_ci       = '$check_timestamp'", 
							    "horaentrada    = '$horaentrada'", 
							 	"horasalida     = '$horasalida'", 
							 	"tolerancia     = '$tolerancia'", 
							 	"idempstat      = '1'");
			$numcols = count($colsvalarr);
			$where_clause = "idempleado = '$noUsusario[0]'";
			$aff_table = "gnrl_empl";

			$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 



			// Inserta Primera entrada al historial del cambios
			$colsarr = array("idEntHist", 
			                 "idempleado", 
							 "idInmuOrigen", 
							 "idInmuDestino", 
							 "periodoChecada", 	
							 "fechaCambio");
			$numcols = count($colsarr);
			$valarr = array("NULL", 
			                "'$noUsusario[0]'", 
							"'0'",
							"'$idinmu[0]'", 
							"'1'", 
							"'$check_timestamp'");
			$aff_table = "empl_chst";

			$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

			break;
	}		


?>

<body>
<br />
<h2>Empleado Agregado al Sistema de Asistencia</h2>
<span class="letraaduser">El empleado <strong><?php echo "$nempleado"; ?></strong>, fu&eacute; agregado a la base de datos</span><br />
<br />
<div id="div1">
<table class="tablacontagremp" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post" name="form1" target="_self" id="form1">
      <td><table class="tablaagremp" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>

<!--INSERT INTO gnrl_empl (idempleado, nombreempleado, idtempleado, edad, nss, direccion, notelefonico, correoe, idinmu, contra, capturainicial, fecha_ci, estado) VALUES (NULL, 'Enrico Moriliani', '1', '44', '115487556', 'La Plazana No. 36 Col. Tlapalil Tlalnepantla Edo. de Mexico', '264122699', 'morilianien@live.com.mx', '30', 'edcdaf5408766bb5d1b15e0ba0a47524', 'iniciales/0007_2010-11-19-093126.jpg', '2010-11-19 09:31:26', '1')--> 

          <td class="tablaagremp_td1" align="left" valign="top"><img src="<?php echo $hostname.$relpath.$file_name; ?>" width="200" height="140" /><br />
<br />
</td>
          <td class="tablaagremp_td2"><p class="texto_tarjeta">
          Nombre: <strong><?php echo $nempleado; ?></strong><br />
          <!--No. Empleado Probell: <strong><?php // echo $pbnoempleado; ?></strong><br />-->
		  Tipo de empleado: <strong><?php echo $templeado[0]; ?></strong><br />
          Edad: <strong><?php echo $edad; ?></strong><br />
		  N.S.S: <strong><?php echo $nss; ?></strong><br />          
          Dirección: <strong><?php echo $direccion; ?></strong><br />
          No. Telefónico: <strong><?php echo $notelefonico; ?></strong><br />
          Correo-e: <strong><?php echo $correoe; ?></strong><br />
          Oficina/Tienda donde Labora: <strong><?php echo $sel_inmu; ?></strong><br />
          <!--Image Path: <strong><?php echo $hostname.$file_name; ?></strong>-->
          </p>
          <p class="texto_tarjeta">Datos de Ingreso al Sistema:<br />
          No. De USUARIO: <strong><?php echo $idempleado; ?></strong><br />
          Elementos de Seguridad: <strong>Huella Dactilar y Fotografia Capturadas</strong></p></td>
        </tr>
      </table>
        <!--<span class="letraaduser_nopadd">Anota tu No. de empleado y contraseña <strong>es importante que no los olvides<br />
        </strong></span>-->
        <br />
        <input type="submit" name="button" id="button" value="Continuar" />
     </td></form>
  </tr>
</table>
</div>
</body>
</html>
