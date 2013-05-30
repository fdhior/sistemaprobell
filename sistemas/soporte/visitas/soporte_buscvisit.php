<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
 <script type="text/javascript"></script>
</head>

<?php
	// Iniciar Sesión 
	session_start();


	if ($_SESSION['validated'] == '1') { 
		echo "<body onload=\"javascript:document.forms[0].submit();\">"; 
		$busqueda = $_SESSION['busqueda'];
		$destform = $_SESSION['destform'];
		switch ($destform) {
			case "0":
				$echo2 = $_SESSION['ntpass'];
				$echo1 = "ntpass";
				$echo5 = $echo2;
				break;
			case "1":
				$echo2 = $_SESSION['nspass'];
				$echo1 = "nspass";
				$echo6 = $echo2;
				break;
			case "2":
				$echo2 = $_SESSION['tipovisit'];
				$echo1 = "tipovisit";
				$echo7 = $echo2; 
				break;
			case "3":
				$echo2 = $_SESSION['descbusc'];
				$echo1 = "descbusc";
				$echo3 = $echo2;
				break;
			case "4":
				$echo2 = $_SESSION['fechabusc'];
				$echo1 = "fechabusc";
				$echo4 = $echo2;
				break;
			case "5":
				$echo2 = $_SESSION['fechaini'];
				$echo1 = "fechaini";
				$echo11 = $_SESSION['fechafin'];
				$echo10 = "fechafin";
				$echo8 = $echo2;
				$echo9 = $echo11;
				break;
		} // cierre de switch													
		
		$_SESSION['destform'] = '';
		$_SESSION['errorpass'] = '';
		$_SESSION['validated'] = '';
		$_SESSION['errorid'] = '';
	} else {
		echo "<body>";
		if (isset ($_SESSION['errorid'])) {
			$errorid = $_SESSION['errorid'];
			switch ($errorid) {
				case "0":
					$echo4 = $_SESSION['fechabusc']; 
					break;
				case "1" or "2" or "3" or "4":
					$echo8 = $_SESSION['fechaini']; 
					$echo9 = $_SESSION['fechafin'];
					break;
			}// fin de switch
		} // fin de if			
	} // fin de else

	if ($_SESSION['errorpass'] <> '') {
		$errorpass = $_SESSION['errorpass'];
    }
	$_SESSION['errorpass'] = '';
	include "consultas.php";
?>

<!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT --><form id="form0" name="form0" action="inicio_listavisitas.php" method="post" target="visitlist">

<input type="hidden" name="<?php echo "$echo1"; ?>" id="hiddenField" value="<?php echo "$echo2"; ?>" />
  <input type="hidden" name="busqueda" id="hiddenField2" value="<?php echo "$busqueda"; ?>" />
<?php  
	if ($destform == '5') {
?>
<!-- Hidden Input sólo aparece si la forma de destino es 5 -->
<input type="hidden" name="<?php echo "$echo10"; ?>" id="hiddenField" value="<?php echo "$echo11"; ?>" />

<?php
	} // Fin de if
?>	
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->

<p class="tittextvisitadet">Opciones de Busqueda de Visitas a Tienda<br />
<table class="posbuscoptable" width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="45%" valign="middle" align="left" scope="col"><form id="form1" name="form1" method="post" action="inicio_validabuscvisit.php">
        <label class="textvisitadetcap">por Tienda:</label>
	<?php
		
		
	// Consulta Nombre e ID de Tiendas
	$cols_arr = array("inmu_gdat.idinmu", "inmu_gdat.nombreinmu");
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("inmu_gdat");
	$num_tables = count($tables_arr);

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
	?>
	<select name="ntpass" id="select">
      <?php
		echo "<option";
//        if (!isset($echo5)) {
//			echo " selected=\"selected\""; 
//		}
		echo ">Elige una tienda</option>";


        while($row=mysql_fetch_row($result)) {
		echo "<option";
			if ($echo5 == $row[1]) {
				echo " selected=\"selected\"";
			} 
			echo ">$row[1]</option>";
		}   // cierre de While    	
	?>
    </select>
	<label>
        <input type="submit" name="button" id="button" value="Buscar" />
        </label></p>
        <input name="busqueda" type="hidden" id="busqueda" value="portienda" />
      </form></td>
    <td width="55%" align="left" valign="middle" scope="col"><!-- FORMA BUSQUEDA POR TEXTO EN DESC/DETALLE --><form id="form4" name="form1" method="post" action="inicio_validabuscvisit.php">
        <label class="textvisitadetcap">por Texto en Desc/Detalle:</label>
        <input name="descbusc" type="text" id="descbusc" size="15" value="<?php echo "$echo3"; ?>" />
        <input type="submit" name="button4" id="button4" value="Buscar" /></p> 
        <input name="busqueda" type="hidden" id="busqueda" value="pordesc" />
      </form></td>
  </tr>
  <tr> 
    <td><!-- FORMA BUSQUEDA POR SUPERVISOR --><form id="form2" name="form1" method="post" action="inicio_validabuscvisit.php">
        <label class="textvisitadetcap">Por Supervisor</label>
        : 
<?php
	// Recupera nombres de los supervisores		
	$cols_arr = array("gnrl_usrs.iduser", "gnrl_usrs.nombre");
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("gnrl_usrs");
	$num_tables = count($tables_arr);

	// Consulta 
	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

		
    ?>
        <select name="nspass" id="select2">
        <?php
		echo "<option";
        if (!isset($echo6)) {
			echo " selected=\"selected\""; 
		}
		echo ">Elige un supervisor</option>";


        while($row=mysql_fetch_row($result)) {
		echo "<option";
			if ($echo6 == $row[1]) {
				echo " selected=\"selected\"";
			} 
			echo ">$row[1]</option>";
		}   // cierre de While    	
	?>
        </select>
        <input type="submit" name="button2" id="button2" value="Buscar" /></p> 
        <input name="busqueda" type="hidden" id="busqueda" value="porsuperv" />
      </form></td>
    <td><!-- FORMA BUSQUEDA POR FECHA --><form id="form5" name="form1" method="post" action="inicio_validabuscvisit.php">
        <span class="textvisitadetcap">por Fecha (aaaa-mm-dd):</span>
        <input name="fechabusc" type="text" id="fechabusc" size="10" maxlength="10" value="<?php echo "$echo4"; ?>" />
        <input type="submit" name="button5" id="button5" value="Buscar" />
        <input name="busqueda" type="hidden" id="busqueda" value="porfecha" />
      </form></td>
  </tr>
  <tr> 
    <td><!-- FORMA BUSQUEDA POR TIPO DE VISITA --><form id="form3" name="form1" method="post" action="inicio_validabuscvisit.php">
        <label class="textvisitadetcap">por Tipo de Visita:</label>

<?php

	// Consulta Nombre e ID de Tiendast
	$cols_arr = array("gnrl_area.area");
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("gnrl_area");
	$num_tables = count($tables_arr);

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
?>
    <select name="tipovisit" id="select3">

<?php
   		echo "<option";
        if (!isset($echo7)) {
			echo " selected=\"selected\""; 
		}
		echo ">Elige un tipo de visita</option>";

        while($row=mysql_fetch_row($result)) {
		echo "<option";
			if ($echo7 == $row[0]) {
				echo " selected=\"selected\"";
			} 
			echo ">$row[0]</option>";
		}   // cierre de While    	
?>          
                                </select>
        <input type="submit" name="button3" id="button3" value="Buscar" /></p> 
        <input name="busqueda" type="hidden" id="busqueda" value="portipov" />
      </form></td>
    <td><!-- FORMA BUSQUEDA POR RANGO DE FECHAS --><form id="form9" name="form9" method="post" action="inicio_validabuscvisit.php">
        <span class="textvisitadetcap">Entre 
        <input name="fechaini" type="text" id="fechaini" size="10" maxlength="10" value="<?php echo "$echo8"; ?>" />
        y 
        <input name="fechafin" type="text" id="fechafin" size="10" maxlength="10" value="<?php echo "$echo9"; ?>" />
        <input type="submit" name="button6" id="button6" value="Buscar" />
        <input name="busqueda" type="hidden" id="busqueda" value="porrangofech" />
        (aaaa-mm-dd):</span> </form></td>
  </tr>
  <tr>
    <td><?php 
			if ($errorpass <> '') {
				echo "<span class=\"validateerror\">$errorpass</span>";
			}
		unset($_SESSION['ntpass']); 		 
		?></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p class="tittextvisitadet"><br />
</p>
</body>
</html>
