<?php 

function convierte_criterio($filtorden) // convierte el criterio en texto a la forma interna de la consulta
 {
 	if ($filtorden == "Tienda") {
		$filtpassorden = "equipos.nombret";
	}	      

	if ($filtorden == "Zona") {
    	$filtpassorden = "equipos.zona";
	}	      

	if ($filtorden == "No. de Equipo") {
    	$filtpassorden = "equiposdetalle.numequipo";
	}	      

	if ($filtorden == "Tipo") {
    	$filtpassorden = "equiposdetalle.tipo";
	}	      

	if ($filtorden == "Descripcion") {
    	$filtpassorden = "equiposdetalle.dispdesc";
	}	      

	if ($filtorden == "Estado") {
    	$filtpassorden = "equiposdetalle.estado";
	}	      

	if ($filtorden == "Propiedades") {
		$filtpassorden = "equiposdetalle.propiedades";
	}

	if ($filtorden == "Ultima Actualizacion") {
    	$filtpassorden = "equiposdetalle.fechaultact";
	}

	return ($filtpassorden);

 } // Cierre de Funcion


function cambia_espacios($text)
 {
$cambia = str_ireplace(" ", "%20", $text);
return ($cambia);
 } //  Cierre de Funcion
 
// echo "<h3>$filtintorden</h3>"; 

/* 
if ($filtestado == "RF") {
      $filtextestado = "Reemplazo Fisico";
}

if ($filtestado == "PF") {
      $filtextestado = "Posible Falla";
}

if ($filtestado == "SA") {
      $filtextestado = "Se Sugiere Actualizacion";
}

if ($filtestado == "LI") {
      $filtextestado = "Limpieza Interna";
}

if ($filtestado == "LE") {
      $filtextestado = "Limpieza Externa";
}

if ($filtestado == "SC") {
      $filtextestado = "Servicio Completo Limpieza Externa e Interna";
}

if ($filtestado == "RE") {
      $filtextestado = "Revision Exahustiva";
}

if ($filtestado == "RU") {
      $filtextestado = "Revision Urgente";
}

if ($filtestado == "TV") {
      $filtextestado = "Tiene Virus";
}

if ($filtestado == "NF") {
      $filtextestado = "No Funciona";
}

if ($filtestado == "NA") {
      $filtextestado = "No Aplica No hay Dispositivo";
}

if ($filtestado == "DD") {
      $filtextestado = "Dispositivo Dañado";
}  */

?>
