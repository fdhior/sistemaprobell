<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="../../../css/sistemaprobell.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!-- <style type="text/css">
<!--
.tipoletra {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;		
}

</style> -->
<script type="text/javascript"></script>
</head>

<body>
<?php
	session_start();
	
	
	if ($_SESSION['validated'] == '1') { 
		echo "<body onload=\"javascript:document.forms[0].submit();\">"; 
		$busqueda = $_SESSION['busqueda'];
		$destform = $_SESSION['destform'];
		switch ($destform) {
			case "0":
				$echo2 = $_SESSION['ninmpass'];
				$echo1 = "ninmpass";
				$echo5 = $echo2;
				break;
			case "1":
				$echo2 = $_SESSION['descbusc'];
				$echo1 = "descbusc";
				$echo3 = $echo2;
				break;
			case "2":
				$echo2 = $_SESSION['fechabusc'];
				$echo1 = "fechabusc";
				$echo4 = $echo2;
				break;
			case "3":
				$echo2 = $_SESSION['fechaini'];
				$echo1 = "fechaini";
				$echo11 = $_SESSION['fechafin'];
				$echo10 = "fechafin";
				$echo8 = $echo2;
				$echo9 = $echo11;
				break;
			case "4":
				$echo2 = $_SESSION['segpass'];
				$echo1 = "segpass";
				$echo6 = $echo2;
				break;
			case "5":
				$echo2 = $_SESSION['prioripass'];
				$echo1 = "prioripass";
				$echo7 = $echo2; 
				break;
		} // cierre de switch													
		
		unset($_SESSION['destform']);
		unset($_SESSION['errorpass']);
		unset($_SESSION['validated']);
		unset($_SESSION['errorid']);
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
	$modo = $_GET['modo']; 
	// $ctrlv = $_GET['ctrlv']; 
	
	switch ($modo) {
		case "concluidos":
			$muestramod = "Concluidos";
			break;
		case "activos":
			$muestramod = "Activos";	
			break;
	} // Cierre de Switch	
	
	$host_name = $_SERVER['HTTP_HOST'];
	$basedir = "e-groupprobell";
	$form_path = "http://".$host_name."/".$basedir."/sistemas/soporte/tickets/";
	
//	echo getcwd() . "\n";
	
?>

<!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT --><form id="form0" name="form0" action="<?php echo "$form_path" ?>tickets_lista.php" method="post" target="pendlist">

<input type="hidden" name="<?php echo "$echo1"; ?>" id="hiddenField" value="<?php echo "$echo2"; ?>" />
<input type="hidden" name="busqueda" id="hiddenField2" value="<?php echo "$busqueda"; ?>" />
<input type="hidden" name="modo" id="modo" value="<?php echo "$modo"; ?>" />
<?php  
	if ($destform == '3') {
?>
<!-- Hidden Input sólo aparece si la forma de destino es 5 -->
<input type="hidden" name="<?php echo "$echo10"; ?>" id="hiddenField" value="<?php echo "$echo11"; ?>" />

<?php
	} // Fin de if
?>	
</form>


<p class="tittextvisitadet">Opciones de Busqueda De Pendientes <?php echo "$muestramod"; ?>  <br />
<table class="posbuscoptable" width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="49%" valign="middle" align="left" scope="col"><!-- FORMA BUSQUEDA POR PENDIENTE EN --><form id="form1" name="form1" method="post" action="<?php echo "$form_path" ?>tickets_valida_busqueda.php">
        <label class="textvisitadetcap"></label>
        <label class="textvisitadetcap"></label></p>
        <label class="textvisitadetcap">por Pendiente En:</label>
<?php
		
		
	// Consulta Nombres de Tiendas
	$cols_arr = array("inmu_gdat.nombreinmu");
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("inmu_gdat");
	$num_tables = count($tables_arr);

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
?>

	<select name="ninmpass" id="select">
      <?php
		echo "<option";
        if (!isset($echo5)) {
			echo " selected=\"selected\""; 
		}
		echo ">Elige una tienda</option>";

        while($row=mysql_fetch_row($result)) {
		echo "<option";
			if ($echo5 == $row[0]) {
				echo " selected=\"selected\"";
			} 
			echo ">$row[0]</option>";
		}   // cierre de While    	
	?>
    </select>



        <label> 
        <input type="submit" name="button" id="button" value="Buscar" />
        </label></p>
        <input name="busqueda" type="hidden" id="busqueda" value="porpen" />
        <input name="modo" type="hidden" id="modo" value="<?php echo "$modo"; ?>" />
    </form></td>
    <td width="51%" align="left" valign="middle" scope="col"><!-- FORMA BUSQUEDA POR RANGO DE FECHAS --><form id="form4" name="form1" method="post" action="<?php echo "$form_path" ?>tickets_valida_busqueda.php">
        <label class="textvisitadetcap"></label>
        <label class="textvisitadetcap"></label>
        <span class="textvisitadetcap"> 
        <?php
		switch ($modo) {
			case "activos":
				echo "Alta";	
				break;		
			case "concluidos":
				echo "Baja";
				break;
		}
		?>
	    &nbsp;Entre 
        <input name="fechaini" type="text" id="fechaini" size="10" value="<?php echo "$echo8"; ?>" />
        y 
        <input name="fechafin" type="text" id="fechafin" size="10" value="<?php echo "$echo9"; ?>" />
        <input name="busqueda" type="hidden" id="busqueda" value="porrangofech" />
        <input name="modo" type="hidden" id="modo" value="<?php echo "$modo"; ?>" />
        </span> <span class="textvisitadetcap"> 
        <input type="submit" name="button6" id="button6" value="Buscar" />
        </span> </form></td>
  </tr>
  <tr> 
    <td><!-- FORMA BUSQUEDA POR DESCRIPCION/DETALLE --><form id="form2" name="form1" method="post" action="<?php echo "$form_path" ?>tickets_valida_busqueda.php">
        <label class="textvisitadetcap"></label>
        <label class="textvisitadetcap">Por Texto en Desc/Detalle:</label>
        <input name="descbusc" type="text" id="descbusc" size="15" value="<?php echo "$echo3"; ?>" />
        <input type="submit" name="button4" id="button4" value="Buscar" /></p> 
        <input name="busqueda" type="hidden" id="busqueda" value="pordesc" />
        <input name="modo" type="hidden" id="modo" value="<?php echo "$modo"; ?>" />
    </form></td>
    <td> 
      <?php
	if ($modo == "activos") {

	// Consulta de Tipos de seguimiento
	$cols_arr = array("sprv_vseg.seguimiento");
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("sprv_vseg");
	$num_tables = count($tables_arr);

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	?>
      <!-- FORMA BUSQUEDA POR SEGUIMIENTO --><form id="form5" name="form1" method="post" action="<?php echo "$form_path" ?>tickets_valida_busqueda.php">
        <span class="textvisitadetcap">Por Seguimiento: 
   
   
        <select name="segpass" id="segpass">
    	  <?php
			echo "<option";
    	    if (!isset($echo6)) {
				echo " selected=\"selected\""; 
			}
			echo ">Elige seguimiento</option>";
			
        	while($row=mysql_fetch_row($result)) {
			echo "<option";
				if ($echo6 == $row[0]) {
					echo " selected=\"selected\"";
				} 
				if ($row[0] <> "Concluido") {
					echo ">$row[0]</option>";
				}	
			}   // cierre de While    	
		?>
	    </select>
        <input name="busqueda" type="hidden" id="busqueda" value="porseg" />
        <input name="modo" type="hidden" id="modo" value="<?php echo "$modo"; ?>" />
        </span> <span class="textvisitadetcap"> 
        <input type="submit" name="button3" id="button3" value="Buscar" />
        </span> 
      </form>
      <?php
	} // Cierre de if
	?>    </td>
  </tr>
  <tr> 
    <td><!-- FORMA BUSQUEDA POR FECHA DE ALTA/BAJA --><form id="form3" name="form1" method="post" action="<?php echo "$form_path" ?>tickets_valida_busqueda.php">
        <label class="textvisitadetcap"></label>
        <span class="textvisitadetcap">por Fecha de 
        <?php
//	echo "$modo";
  		switch ($modo) {
			case "activos":
				echo " Alta: ";	
				break;		
			case "concluidos":
				echo " Baja: ";	
				break;
		}

	?>
        </span> 
        <input name="fechabusc" type="text" id="fechabusc" size="10" value="<?php echo "$echo4"; ?>" />
        <input type="submit" name="button5" id="button5" value="Buscar" />
        <input name="busqueda" type="hidden" id="busqueda" value="porfecha" />
        <span class="textvisitadetcap"> 
        <input name="modo" type="hidden" id="modo" value="<?php echo "$modo"; ?>" />
        (aaaa-mm-dd):</span> </form></td>
    <td> 
      <?php
	if ($modo == "activos") {

	$cols_arr = array("sprv_prio.prioridad");
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("sprv_prio");
	$num_tables = count($tables_arr);

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
	?>
      <!-- FORMA BUSQUEDA POR PRIORIDAD --><form id="form9" name="form9" method="post" action="<?php echo "$form_path" ?>tickets_valida_busqueda.php">
        <label class="textvisitadetcap">Por Prioridad</label>

        <select name="prioripass" id="prioripass">
    	  <?php
			echo "<option";
    	    if (!isset($echo7)) {
				echo " selected=\"selected\""; 
			}
			echo ">Elige prioridad</option>";
			
        	while($row=mysql_fetch_row($result)) {
			echo "<option";
				if ($echo7 == $row[0]) {
					echo " selected=\"selected\"";
				} 
			echo ">$row[0]</option>";
			}   // cierre de While    	
		?>
	    </select>

        <input type="submit" name="button2" id="button2" value="Buscar" />
        <input name="busqueda" type="hidden" id="busqueda" value="porprioridad" />
        <span class="textvisitadetcap">
        <input name="modo" type="hidden" id="modo" value="<?php echo "$modo"; ?>" />
        </span>
      </form>
      <?php
	} // Cierre de if
	?>    </td>
  </tr>
  <tr>
    <td><?php 
			if ($errorpass <> '') {
				echo "<span class=\"validateerror\">$errorpass</span>";
			}	 
		?></td>
    <td>&nbsp;</td>
  </tr>
</table>
<p class="tittextvisitadet"><br />
</p>
</body>
</html>
