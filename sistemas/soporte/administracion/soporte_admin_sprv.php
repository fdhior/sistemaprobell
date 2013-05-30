<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.letraencabezado {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;		
}
-->
</style>
</head>
<?php 

/*	// Mostrar los valores de $_POST
	echo "Valores de _POST <br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "nombre: <b>$nombre</b> valor: $valor<br />"; 
		}
	}*/
	
	// Convertir las variables $_POST en locales
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			${$nombre} = $valor;
		}
	} // Cierre foreach	
	

	switch ($busqueda) {
		case "portienda":
			$getstring = "?busqueda=$busqueda&ntpass=$ntpass";
			break;
		case "porsuperv":
			$getstring = "?busqueda=$busqueda&nspass=$nspass";
			break; 		
		case "portipov";
			$getstring = "?busqueda=$busqueda&tipovisit=$tipovisit";
			break;
		case "pordesc";
			$getstring = "?busqueda=$busqueda&descbusc=$descbusc";
			break;
		case "porfecha":
			$getstring = "?busqueda=$busqueda&fechabusc=$fechabusc";
			break;
		case "porrangofech";	
			$getstring = "?busqueda=$busqueda&fechaini=$fechaini&fechafin=$fechafin";
			break;
	}					
?>

<body>
<table  align="center" width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th width="26" align="center"><span class="letraencabezado">id</span></th>
    <th width="186" align="center"><span class="letraencabezado">Nombre Usuario</span></th>
    <th width="176" align="center"><span class="letraencabezado">Nombre</span></th>
    <th width="89" align="center"><span class="letraencabezado">Tipo de Usuario</span></th>
    <th width="89" align="center"><span class="letraencabezado">Area</span></th>
    <th width="86" align="center"><span class="letraencabezado">Detalle</span></th>
  </tr>
</table>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
   <tr>
     <td><iframe src="inicio_adminlistasuperv.php<?php echo "$getstring"; ?>" name="muestra_lista" width="100%" marginwidth="0" height="180" marginheight="0" align="middle" scrolling="Auto" frameborder="1" hspace="0" vspace="0" id="muestra_cambios" title="muestra_lista" ></iframe></td>
   </tr>
</table>
</body>
</html>
