<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generando Reporte</title>
<link href="../../../styles.css" rel="stylesheet" type="text/css" />
<?php 

	session_start();

	$hostname     = $_SESSION['hostname'];

	$rel_path     = "supervision/asistencia/exportar/"; 
	$target_link  = $hostname.$rel_path.'asistencia_descargareporte.php';


	foreach ($_POST as $nombre => $valor) {
		$post_string = $post_string.${$nombre}.'='.$valor.'&';
	} // Cierre foreach     
	
	$formato = $_POST['formato'];
	
?>




</script>
</head>

<body onload="javascript: generaReporte()">
<br />
<br />
<br />
<br />
<h2>Generando Reporte...</h2>
<div id="div_forma">
<form id="form1" name="form1" method="post" action="<?php echo $target_link;  ?>">
<table>
	<tr id="1">
  <td><input name="button" type="submit" id="botonDescarga" value="El Reporte se esta generando..." disabled="disabled" />
  <input type="hidden" name="formato" id="hiddenField" value="<?php echo $formato; ?>" />
</td>
	</tr>
</table>
</form>
</div>

</body>
</html>