<?php

$dbhost="sql312.zobyhost.com";  // host del MySQL (generalmente localhost)
$dbusuario="zoby_7243254"; // aqui debes ingresar el nombre de usuario
                      // para acceder a la base
$dbpassword="pro2008bel12"; // password de acceso para el usuario de la
                      // linea anterior
$db="zoby_7243254_egprobell";        // Seleccionamos la base con la cual trabajar
$conexion = mysql_connect($dbhost, $dbusuario, $dbpassword);
@mysql_select_db($db, $conexion) or die("No se puede conectar a la base de datos");

?>
