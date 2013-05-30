<?php 
	// Iniciar sesión
	session_start();
	include "valida_fechas.php";

	if (isset ($_SESSION['errorpass'])) {
		$_SESSION['errorpass'] = '';
    }

	$host_name = $_SERVER['HTTP_HOST'];
	$basedir = "e-groupprobell";
	$form_path = "http://".$host_name."/".$basedir."/sistemas/soporte/tickets/";


	// Convertir las variables $_POST en locales
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			${$nombre} = $valor;
		}
	} // Cierre foreach	
	
	// Mostrar los valores de $_POST
	echo "Valores de POST <br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor: <b>$valor</b><br />"; 
		}
	}

	// Estructura Switch de validación de valores
	switch ($busqueda) {
		case "porpen":
			if ($ninmpass == "Elige una tienda") {
				$error = "Debes elegir una tienda";
			}	
			break;
		case "pordesc":
			if ($descbusc == '') {
				$error	= "Debes teclear un texto a buscar en la descripción";
			}
			break;
		case "porfecha":
			if ($fechabusc == '') {
				$error = "Debes especificar una fecha de alta";
			}
			
			if ($fechabusc <> '') {
				$checa_fecha = checkDateFormat($fechabusc);
				if ($checa_fecha == false) {
					$error = "Error en fecha introducida, debe escibirse en el formato AAAA-MM-DD (año, mes, dia) y ser válida";
					$errorid = 0;
		        }				
			}	  	
			break;			
		case "porrangofech":

			// Si alguno de los campos del rango esta vacio
			if ($fechaini == '' or $fechafin == '') {
				$error	= "Debes teclear una fecha de inicio y una final en el rango";
				$errorid = 1;
			}

			// Si algunos de los campos del rango es invalido			
			if ($fechaini <> '' and $fechafin <> '') {
				$checha_fechaini = checkDateFormat($fechaini);
				$checha_fechafin = checkDateFormat($fechafin); 
				if (($checha_fechaini == false and $checha_fechafin == false) or ($checha_fechaini == true and $checha_fechafin == false) or ($checha_fechaini == false and $checha_fechafin == true)) {
					$error	= "Error en alguna fecha introducida en el rango, el formato es AAAA-MM-DD (año, mes, dia) ambas deben ser válidas";
					$errorid = 2;
				}
				if ($checha_fechaini == true and $checha_fechafin == true) {
					$compareres = compare_dates($fechaini,$fechafin);

					// Si la fecha inicial es mayor a la final
					if ($compareres > 0) {
						$error	= "Error la fecha inicial es mayor que fecha final";
						$errorid = 3;
					}	
				
					// Si la fecha inicial y final son iguales
					if ($compareres == '0') {
						$error	= "Error la fecha inicial y final son iguales";
						$errorid = 4;
					}	
				}
			}	
			break;			
		case "porseg":
			if ($segpass == "Elige seguimiento") {
				$error	= "Debes elegir un tipo de seguimiento";
			}
			break;	
		case "porprioridad":
			if ($prioripass == "Elige prioridad") {
				$error	= "Debes elegir un tipo de prioridad";
			}
			break;
	}			  

	if (!isset($error)) {
		$noerror = '1';
	}

//	echo "valor de $noerror <br /> <br />"; 

	// Si no hay errores entonces 
	if ($noerror == '1') {
		$_SESSION['validated'] = '1';
		$_SESSION['busqueda'] = $busqueda;
		switch ($busqueda) {
			case "porpen":
				$_SESSION['destform'] = '0';
				$_SESSION['ninmpass'] = $ninmpass;
				break;
			case "pordesc":
				$_SESSION['destform'] = '1';
				$_SESSION['descbusc'] = $descbusc;
				break;
			case "porfecha":
				$_SESSION['destform'] = '2';
				$_SESSION['fechabusc'] = $fechabusc;
				break;
			case "porrangofech":
				$_SESSION['destform'] = '3';
				$_SESSION['fechaini'] = $fechaini;
				$_SESSION['fechafin'] = $fechafin;
				break;
			case "porseg":
				$_SESSION['destform'] = '4';
				$_SESSION['segpass'] = $segpass;
				break;
			case "porprioridad":
				$_SESSION['destform'] = '5';
				$_SESSION['prioripass'] = $prioripass;
				break;
		}		
		echo "Location: ".$form_path."tickets_busqueda.php?modo=$modo";

		header("Location: ".$form_path."tickets_busqueda.php?modo=$modo");
	} else {
	    echo "El error es: $error";
		$_SESSION['errorpass'] = $error;
		if (isset($errorid)) {
			$_SESSION['errorid'] = $errorid;
			switch ($errorid) {
				case "0":
					$_SESSION['fechabusc'] = $fechabusc;
					break;
				case "1" or "2" or "3" or "4":	
					$_SESSION['fechaini'] = $fechaini;
					$_SESSION['fechafin'] = $fechafin;
					break;
			}		
		}			
		echo "Location: ".$form_path."tickets_busqueda.php?modo=$modo";

		header("Location: ".$form_path."tickets_busqueda.php?modo=$modo");
	}	


?>