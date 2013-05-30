<?php 
	// Iniciar sesión
	session_start();

	// Si la variable de sesion 'errorpass' existe darle un valor nulo
	if (isset ($_SESSION['errorpass'])) {
		$_SESSION['errorpass'] = '';
    }

	// Convertir las variables $_POST en locales
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			${$nombre} = $valor;
		}
	} // Cierre foreach	
	
	// Mostrar los valores de $_POST
	echo "Valores de _POST <br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "nombre variable: <b>$nombre</b> valor: $valor<br />"; 
		}
	}

	// Estructuras if de validación de valores
	if ($prioripass == 'Elige prioridad') {
		$error = "Debes elegir un tipo de prioridad";
		echo "error elegido 1<br />";
	} elseif ($ninmpass == 'Elige una tienda-inmueble') {
		$error = "Debes elegir una tienda";
		echo "error elegido 2<br />";
	} elseif ($desc == '') {
		$error = "Debes teclear una descripción";
		echo "error elegido 3<br />";
	} elseif ($detalle == '') {	
		$error = "Debes teclear el detalle del pendiente";
		echo "error elegido 3<br />";
	} // fin de estructuras if para validación de valores	


	// Si se ha presentado un error la variable $error estará definida
	// de lo contrario se le asignará el valor 1 a la variable $noerror 
	if (!isset($error)) {
		$noerror = '1';
	}

//	echo "valor de $noerror <br /> <br />"; 

	// Si no hay errores entonces 
	if ($noerror == '1') {
		$_SESSION['validated'] = '1';
//		header("Location: inicio_reportevisita.php");
	} else {
//	    echo "El error es: $error";
		$_SESSION['errorpass'] = $error;
	}	

	// Variables de sesion y envio de encabezado
	$_SESSION['prioripass'] = $prioripass;
	$_SESSION['ninmpass'] = $ninmpass;
	$_SESSION['desc'] = $desc;
	$_SESSION['detalle'] = $detalle;
	header("Location: inicio_agrpend.php");


?>