<?php
session_start(); // inicia/continua session
session_unset(); // "limpia" session reestrablece las variables de la session
session_destroy(); // destruye la session 

Header('Location: login.php');
exit;
?>