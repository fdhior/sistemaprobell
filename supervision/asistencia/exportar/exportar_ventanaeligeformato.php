<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exportar Reporte de Asistencia</title>
<link href="../../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../../css/modulo.css" rel="stylesheet" type="text/css" />
<?php 

	session_start();

	$hostname    = $_SESSION['hostname'];

	$rel_path    = 'supervision/asistencia/exportar/'; 
	$target_link = $hostname.$rel_path.'asistencia_enviarreporte.php';


	foreach ($_GET as $nombre => $valor) {
		${$nombre} = $valor;
	} // Cierre foreach     
	


?>
<script language="javascript">

//	document.forms[0].submit();
function enviaDatosReporte()
{
//	window.open("",
//			    "descargareporte", "");
				// "width=250,height=190,top=400,left=600,scrollbars=NO,resizable=NO,directories=NO,location=NO,menubar=NO,status=NO,titlebar=NO,toolbar=NO");
	document.forms[0].submit();
//	window.close();
	setTimeout ("window.close()", 10000);

}
	
</script>

</head>

<body onload="enviaDatosReporte()">
<?php


	/* ----- DEPURA VARIABLES ----- */ 

   /* echo "Valores de _GET <br />";
    foreach ($_GET as $nombre => $valor) {
    	if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
		}
	}*/

//    echo $hostname.$relpath.$target_link2;

?>
<br />
<h2><br />
Elige el Formato del Reporte</h2>
<div id="div_forma">
<form action="<?php echo $target_link; ?>" method="post" name="form1" class="asistencia_tipoletra" id="form1" target="_self">
  <label>
    <input type="radio" name="formato" id="sel_formato" value="excel" checked="checked" />
    Excel</label>
  <br />
  <label>
    <input type="radio" name="formato" id="radio" value="word" disabled="disabled" />
  Word</label>
  <br />
  <label>
    <input type="radio" name="formato" id="radio2" value="pdf" disabled="disabled" />
    PDF</label>
  <br />
  <span class="asistencia_tipoletra">
  <br />
  <input type="submit" name="btEnviaR" id="btEnviaR" value="Enviar Reporte" accesskey="v" tabindex="0" onclick="javascript: enviaDatosReporte()" />
  </span>
 
  <input type="hidden" name="tipo_busc" id="hiddenField" value="<?php echo $tipo_busc; ?>" />
  <input type="hidden" name="quien_busc" id="hiddenField2" value="<?php echo $quien_busc; ?>" />


<?php

	if ($noempleado <> '')  {

?>

  <input type="hidden" name="noempleado" id="hiddenField" value="<?php echo $noempleado; ?>" />


<?php

	}

	if ($nempleado <> '')  {

?>
		
  <input type="hidden" name="nempleado" id="hiddenField" value="<?php echo $nempleado; ?>" />

<?php

	}

	if (isset($de_busc))  {

?>
		
  <input type="hidden" name="de_busc" id="hiddenField" value="<?php echo $de_busc; ?>" />

<?php

		if ($sel_tienda <> 'Elige una Oficina/Tienda') {

?>			

  <input type="hidden" name="sel_tienda" id="hiddenField" value="<?php echo $sel_tienda; ?>" />

<?php

		}

		if ($sel_tienda <> 'Elige una Razon Social') {

?>

  <input type="hidden" name="sel_razonsc" id="hiddenField" value="<?php echo $sel_razonsc; ?>" />
			
<?php

		}
	}

	if (isset($activa_tiempo))  {

?>

  <input type="hidden" name="activa_tiempo" id="hiddenField" value="<?php echo $activa_tiempo; ?>" />
  <input type="hidden" name="cuando_busc" id="hiddenField" value="<?php echo $cuando_busc; ?>" />

<?php

		if ($taldia <> '') {
			
?>

  <input type="hidden" name="taldia" id="hiddenField" value="<?php echo $taldia; ?>" />
	
<?php

		}
		if ($fechainicio <> '' and $fechafin <> '') {

?>

  <input type="hidden" name="fechainicio" id="hiddenField" value="<?php echo $fechainicio; ?>" />
  <input type="hidden" name="fechafin" id="hiddenField" value="<?php echo $fechafin; ?>" />

<?php

		}
		if ($sel_mes <> 'Selecciona un mes' and $sel_anio <> 'Selecciona un año') {

?>

  <input type="hidden" name="sel_mes" id="hiddenField" value="<?php echo $sel_mes; ?>" />
  <input type="hidden" name="sel_anio" id="hiddenField" value="<?php echo $sel_anio; ?>" />

<?php

		}
	}

?>


</form>

</div>
</body>
</html>