<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Variable Debugging</title>
<?php

    // Mostrar los valores de _POST

    echo "Valores de _POST <br />";
    foreach ($_POST as $nombre => $valor) {
    	if(stristr($nombre, 'Actualizar') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor -";
		}
	}

	print_r($_POST);	

?> 
</head>

<body>
</body>
</html>