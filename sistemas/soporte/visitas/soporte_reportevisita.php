<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script type="text/javascript"></script>
</head>

<?php
	// Iniciar Sesión 
	session_start();
	
	// Mostrar los valores de $_POST
/*	echo "Valores de _POST <br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />"; 
		}
	}
	
	echo "Valores de _GET <br />";
	foreach ($_GET as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />"; 
		}
	}
	
		echo "Valores de _SESSION <br />";
	foreach ($_SESSION as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor, "; 
		}
	}*/

	


	$ntpass = $_SESSION['ntpass'];
	$desc = $_SESSION['desc'];
	$detalle = $_SESSION['detalle'];
	$echo1 = $ntpass;
	$echo4 = "ntpass";
	$echo2 = $desc;
	$echo5 = "desc"; 
	$echo3 = $detalle;
	$echo6 = "detalle";


	// Si los datos han sido validados, se envian los datos a la 
	if ($_SESSION['validated'] == '1') { 
		echo "<body onload=\"javascript:document.forms[0].submit();\">"; 
		$_SESSION['errorpass'] = '';
		$_SESSION['validated'] = '';
	} else {
		echo "<body>";
	} // fin de else

	if ($_SESSION['errorpass'] <> '') {
		$errorpass = $_SESSION['errorpass'];
    }

	// "Borra las variables de sesión
	$_SESSION['errorpass'] = '';
	$_SESSION['ntpass'] = '';
	$_SESSION['desc'] = '';
	$_SESSION['detalle'] = '';

	include "consultas.php";
?>


<!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT --><form id="form0" name="form0" method="post" action="inicio_enviareportevisita.php">
<input type="hidden" name="<?php echo "$echo4"; ?>" id="hiddenField" value="<?php echo "$echo1"; ?>" />
<input type="hidden" name="<?php echo "$echo5"; ?>" id="hiddenField2" value="<?php echo "$echo2"; ?>" />
<input type="hidden" name="<?php echo "$echo6"; ?>" id="hiddenField3" value="<?php echo "$echo3"; ?>" />
</form>

<!-- FORMA DE ENTRADA DE DATOS DEL REPORTE --><form id="form1" name="form1" method="post" action="inicio_validareportevisita.php">
  <table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td class="tittextvisitadet" width="54%" align="left" valign="top" scope="col"><p class="tittextvisitadet">Agregar 
          Reporte de Visitas:<br />
          <br />
          <label class="tittextvisitadet">En: </label>
<?php
//		include "consultas.php";
		
		// Consulta Nombre de los inmuebles
		$cols_arr = array("inmu_gdat.nombreinmu");
		$num_cols = count($cols_arr);
		$join_tables = '0';
		$tables_arr = array("inmu_gdat");
		$num_tables = count($tables_arr);

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
    ?>
    <select name="ntpass" class="tittextvisitadet" id="select">
      <?php
		echo "<option";
        if (!isset($echo1)) {
			echo " selected=\"selected\""; 
		}
		echo ">Elige una tienda-inmueble</option>";

        while($row=mysql_fetch_row($result)) {
		echo "<option";
			if ($echo1 == $row[0]) {
				echo " selected=\"selected\"";
			} 
			echo ">$row[0]</option>";
		}   // cierre de While    	
	?>
        </select>
    <br />
          <label class="tittextvisitadet">DESCRIPCION BREVE (50 CARACTERES MAXIMO):</label>
          <input name="desc" class="tittextvisitadet" type="text" id="textfield" size="50" maxlength="50" value="<?php echo "$echo2"; ?>" />
         <br /> 
          <input type="submit" class="tittextvisitadet" name="button" id="button" value="Enviar Datos" />
      <?php 
			if ($errorpass <> '') {
				echo "<span class=\"validateerror\">$errorpass</span>";
			}	 
		?></p></td>
      <td class="tittextvisitadet" width="46%" align="left" valign="top" scope="col"><br />
        DETALLES:<br /> <textarea name="detalle" id="textarea" cols="40" rows="8"><?php echo "$echo3"; ?></textarea></td>
    </tr>
  </table>
</form>
