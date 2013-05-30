<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>
<?php
session_start();
$tipousr = $_POST['tipousr'];

	session_start();

	$prioripass = $_SESSION['prioripass'];
	$ninmpass = $_SESSION['ninmpass'];
	$desc = $_SESSION['desc'];
	$detalle = $_SESSION['detalle'];
	$echo1 = $prioripass;
	$echo5 = "prioripass";
	$echo2 = $ninmpass;
	$echo6 = "ninmpass";
	$echo3 = $desc;
	$echo7 = "desc"; 
	$echo4 = $detalle;
	$echo8 = "detalle";


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
	$_SESSION['prioripass'] = '';
	$_SESSION['ninmpass'] = '';
	$_SESSION['desc'] = '';
	$_SESSION['detalle'] = '';



include "consultas.php";


?>

<!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT --><form id="form0" name="form0" method="post" action="inicio_enviarpendiente.php">
<input type="hidden" name="<?php echo "$echo5"; ?>" id="hiddenField" value="<?php echo "$echo1"; ?>" />
<input type="hidden" name="<?php echo "$echo6"; ?>" id="hiddenField2" value="<?php echo "$echo2"; ?>" />
<input type="hidden" name="<?php echo "$echo7"; ?>" id="hiddenField3" value="<?php echo "$echo3"; ?>" />
<input type="hidden" name="<?php echo "$echo8"; ?>" id="hiddenField3" value="<?php echo "$echo4"; ?>" />
</form>


<div align="center">
<!-- FORMA ENVIA DATOS AGREGANDO PENDIENTE --><form id="form1" name="form1" method="post" action="inicio_validaagrpend.php">
  <table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td width="57%" align="left" valign="top" scope="col"><p class="tittextvisitadet">AGREGAR PENDIENTE A LA BASE DE DATOS:<br />
         <label class="tittextvisitadet">Prioridad:</label> 
<?php
	$cols_arr = array("sprv_prio.prioridad");
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("sprv_prio");
	$num_tables = count($tables_arr);

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
?>
        <select name="prioripass" class="tittextvisitadet" id="select2">
    	  <?php
			echo "<option";
    	    if (!isset($echo1)) {
				echo " selected=\"selected\""; 
			}
			echo ">Elige prioridad</option>";
			
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
          <label class="tittextvisitadet">Pendiente en:</label> 
<?php
	// Consulta Nombres de Tiendas
	$cols_arr = array("inmu_gdat.nombreinmu");
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("inmu_gdat");
	$num_tables = count($tables_arr);

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
?>
        <select name="ninmpass" class="tittextvisitadet" id="select3">
        <?php
		echo "<option";
        if (!isset($echo2)) {
			echo " selected=\"selected\""; 
		}
		echo ">Elige una tienda-inmueble</option>";

        while($row=mysql_fetch_row($result)) {
		echo "<option";
			if ($echo2 == $row[0]) {
				echo " selected=\"selected\"";
			} 
			echo ">$row[0]</option>";
		}   // cierre de While    	
		?>
        </select>          
        <label class="tittextvisitadet"></label>
          <br />
          <label class="tittextvisitadet">Teclea una descripci&oacute;n breve (50 Caracteres Maximo):</label><br />
          <input name="desc" type="text" class="tittextinputvisitatext" id="textfield" size="50" maxlength="50" value="<?php echo "$echo3"; ?>" />
          <br />
          <input type="submit" class="tittextvisitadet" name="button" id="button" value="Enviar Datos" />
<!--      <input name="modo" type="hidden" id="modo" value="insertapend" /> -->
      <?php 
			if ($errorpass <> '') {
				echo "<span class=\"validateerror\">$errorpass</span>";
			}	 
		?>
      </p>
        </td>
      <td class="tittextvisitadet" width="43%" align="left" valign="top" scope="col"><br />
        <label class="tittextvisitadet">DETALLES:</label><br /> <textarea class="tittextinputvisitatext" name="detalle" id="textarea" cols="50" rows="8"><?php echo "$echo4"; ?></textarea></td>
    </tr>
  </table>
</form>
</div>