<?php

$dbhost="localhost:3306";  // host del MySQL (generalmente localhost)
$dbusuario="probelleg"; // aqui debes ingresar el nombre de usuario
                      // para acceder a la base
$dbpassword="probelang96"; // password de acceso para el usuario de la
                      // linea anterior
$db="egprobell";        // Seleccionamos la base con la cual trabajar
$conexion = mysql_connect($dbhost, $dbusuario, $dbpassword);
@mysql_select_db($db, $conexion) or die(mysql_error()."No se puede conectar a la base de datos");

?>
