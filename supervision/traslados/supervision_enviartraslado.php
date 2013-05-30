<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<link href="../../sucursales/Stickman.MultiUpload.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.letra_boton {        font-family: Arial, Helvetica, sans-serif;
        font-size: 9px;
        font-weight: normal;
        font-variant: small-caps;
}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css">
<!--
.letra_alertaestado {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #CC0000;

}
-->
</style>

<?php

	session_start();

	include $_SESSION['rutafunciones'].'consultas.php';

	$hostname     = $_SESSION['hostname'];
	$dest_almacen = $_GET['dest_almacen'];

	$target_link  = "supervision/traslados/supervision_trasladoenviar.php";


//  Mostrar los valores de _SESSION
/*	echo "Valores de _SESSION <br />";
	foreach ($_REQUEST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />"; 
		}
	} */
	
	
	if (isset($_SESSION['error_id'])) {
		$errorpass = $_SESSION['errorpass'];
		$error_id  = $_SESSION['error_id'];
		$destino   = $_SESSION['destino'];
		$mensaje   = $_SESSION['mensaje'];
    }
	unset($_SESSION['errorpass']);
	unset($_SESSION['error_id']);
	unset($_SESSION['destino']);
	unset($_SESSION['mensaje']);	

?>

<script src="<?php echo $hostname; ?>sucursales/mootools-1.2.4-core-nc.js"></script>
<script src="<?php echo $hostname; ?>sucursales/Stickman.MultiUpload.js"></script>

<script type="text/javascript">
		window.addEvent('domready', function(){
			// Use defaults: no limit, use default element name suffix, don't remove path from file name
//			new MultiUpload( $( 'main_form' ).defaults );
			// Max 3 files, use '[{id}]' as element name suffix, remove path from file name, remove extra elemen
			new MultiUpload( $( 'multiped_form' ).use_settings, 4, '[{id}]', true, true );
		});
</script>

</head>

<body>
<form action="<?php echo $hostname.$target_link; ?>" method="post" enctype="multipart/form-data" id="multiped_form" target="_self">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top"><p>Enviar Traslados de <strong><?php 
												if (!isset($dest_almacen)) {
													$dest_almacen = "0";
												}	
	  											switch ($dest_almacen) { 
													case "0":
														echo "CEDIS";
														break;
													case "20":
														echo "Muebles";
														break;
												}				
													
	  									      ?></strong> (Maximo 4)<br />
          <input class="letra_boton11" type="file" name="use_settings" />
          <input type="hidden" name="origen" id="hiddenField" value="<?php echo "$dest_almacen"; ?>" />
          <span class="parrafo-4">
          <input class="letra_boton11" type="submit" name="button3" id="button3" value="Enviar Traslado(s)" />
          </span><br />
          <br />
      </p>      </td>
    </tr>
  </table>
</form>

</body>
</html>
