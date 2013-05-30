<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script type="text/javascript"></script>
</head>

<?php 
	session_start();
	include "consultas.php";
	$modo = $_GET['modo']; 
	
	// Convertir las variables POST en locales
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			${$nombre} = $valor;
		}
	} // Cierre foreach	

/*	// Muestra los valores _SESSION
	foreach ($_SESSION as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre Variable: <b>$nombre</b> Valor: <b>$valor</b><br />"; 
		}	
	} */


	if ($_SESSION['samepriovalerr'] == '1' or $_SESSION['samesegvalerr'] == '1') {
		echo "<body onload=\"javascript:document.forms[0].submit();\">"; 
		$buscpend = $_SESSION['buscpend'];
		unset($_SESSION['buscpend']);
	} else {
		echo "<body>";
//		unset($_SESSION['samepriovalerr']);
//		unset($_SESSION['buscpend']);
	} // fin de else
// echo "Valor de samepriovalerr: $samepriovalerr";
// echo "Valor de samesegvalerr: $samesegvalerr";

?>




<br />
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="tittextvisitadet">
      <?php
	
	// Mostrar los valores de $_POST
/*	echo "Valores de _POST <br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "nombre variable: <b>$nombre</b> valor: $valor<br />"; 
		}
	} */

	switch($modo) {
		case "modseg":
			echo "Modificar Seguimiento";
			break;
		case "modprio":
			echo "Modificar Prioridad";
			break;	
		case "modconcl":
			echo "Concluir Pendiente";
			break;
	}			

	if (isset($_POST['resbusc'])) {
		$resbusc = $_POST['resbusc'];		

		// Error si no se teclea un número
		if ($buscpend == '') {
			$error = "Debes Teclear un numero de pendiente"; 
		}	

		if (!isset($error)) {
			// Error si no es un número
			if (!is_numeric($buscpend)) {	
				$error = "No has ingresado un número";
			}
		}
		
		if (!isset($error)) {
			// Error si el número es negativo
			if (is_numeric($buscpend) and $buscpend < 0) {
				$error = "El numero ingresado no puede ser negativo";
			}
		}	
		
		if (!isset($error)) { 
			// Error si el numero ingresado excede el numero de pendientes en la base de datos
			$cols_arr = array("count(sprv_pend.idpend)");
			$num_cols = count($cols_arr);
			$join_tables = '0';
			$tables_arr = array("sprv_pend");
			$num_tables = count($tables_arr);

			$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
			$row=mysql_fetch_row($result);
		
			if ($buscpend > $row[0]) {
				$error = "El numero ingresado excede el número de pendientes registrados";
			} 
		} // Cierre de if si no se ha generado error
	
		// Si no hay errores validar los datos
		if (!isset($error)) {
			$validated = '1';
		}		
	}  
	
?>
    </span></td>
  </tr>
  <tr>
    <td><form id="form0" name="form0" method="post" action="inicio_modpend.php?modo=<?php echo "$modo"; ?>">
       <label class="tittextvisitadet">Ingresa el no. del pendiente a modificar:          
            <input type="text" name="buscpend" id="textfield" size="5" maxlength="5" value="<?php echo "$buscpend"; ?>" />
            <input type="submit" name="button" id="button" value="Buscar" />
            <input type="hidden" name="resbusc" id="resbusc" value="1" />
<?php
			if ($_SESSION['samepriovalerr'] == '1') {
				echo "<input type=\"hidden\" name=\"samepriovalerr\" id=\"samepriovalerr\" value=\"1\" />";
				unset($_SESSION['samepriovalerr']);
			} // cierre de if 		

			if ($_SESSION['samesegvalerr'] == '1') {
				echo "<input type=\"hidden\" name=\"samesegvalerr\" id=\"samesegvalerr\" value=\"1\" />";
				unset($_SESSION['samesegvalerr']);
			} // cierre de if 		

?>
        </label>
	<?php
		if (isset($error)) {
			echo "<label class=\"validateerror\">$error</label>";
		}	
	?>
    </form></td>
  </tr>
</table>



  <br />
  <?php 
	if ($validated == '1') {
		// Consulta de busqueda
		$cols_arr = array("sprv_pend.idpend", "sprv_prio.prioridad", "inmu_gdat.nombreinmu", "sprv_pend.`desc`", "sprv_pend.fechaalta", "sprv_pend.fechafin", "sprv_vseg.seguimiento");
		$num_cols = count($cols_arr);
		$join_tables = '1';
		$tables_arr = array("sprv_pend", "inmu_gdat", "sprv_vseg", "sprv_prio");
		$num_tables = count($tables_arr);
		$connect = '0';
		$on_fields_arr = array("idinmu", "idseg", "idprioridad");	
		$where_clause = "sprv_pend.idpend = $buscpend";
//		$order = "sprv_pend.fechaalta";
//		$dir = "DESC";
		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

		if ($modo == "modseg" or $modo == "modprio") {					
?>
<form id="form2" name="form2" method="post" action="
<?php 
	switch ($modo) {
		case "modprio":
			echo "inicio_enviamodpen.php?modenv=actprio";
			break;
		case "modseg":
			echo "inicio_enviamodpen.php?modenv=actseg";	
			break;
	}
?>
">
<?php
		}
?>

<!-- TABLA GENERADA CON LOS DATOS DEL PENDIENTE -->
<table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th width="3%" align="center" class="tittextvisitadet">No.</th>
    <th width="8%" align="center" class="tittextvisitadet">Prioridad</th>
    <th width="16%" align="center" class="tittextvisitadet">Pendiente En</th>
    <th width="22%" align="center" class="tittextvisitadet">Descripción</th>
    <th width="18%" align="center" class="tittextvisitadet">Fecha Alta</th>
    <th width="18%" align="center" class="tittextvisitadet">Fecha Baja</th>
    <th width="15%" align="center" class="tittextvisitadet">Seguimiento</th>
  </tr>

  
  <?php
		while($row=mysql_fetch_row($result)){
		?>
  <tr>
    <td align="center"><?php echo "$row[0]"; ?></td>
    <td align="center">
	<?php
	if ($modo == "modconcl") {
		$segkeep = $row[6];
	}	
	if (($modo == "modseg" and $row[6] =="Concluido") or ($modo == "modconcl" and $row[6] == "Concluido")) {
		echo "N/A";
	} else {
		
	if ($modo == "modprio") {
		if ($row[6] == "Concluido") {
			echo "N/A";
			$segkeep = $row[6];
			$errmod = "la prioridad";
		} else {	

			// Consulta de los valores de prioridad
			$cols_arr = array("sprv_prio.prioridad");
			$num_cols = count($cols_arr);
			$join_tables = '0';
			$tables_arr = array("sprv_prio");
			$num_tables = count($tables_arr);
			unset($where_clause);

			$result2 = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
    ?>
    <!-- INICIO DE LA ESTRUCTURA FORM SELECT -->        
	<label>
	<select name="selprio" id="selprio">
    <?php
		// While de el select PRIORIDAD			
       	while($row2=mysql_fetch_row($result2)) {
		echo "<option";
			if ($row[1] == $row2[0]) {
				echo " selected=\"selected\"";
			} // Cierre de if row6 == row1
		echo ">$row2[0]</option>";
		} // cierre de While fetching rows   	
	?>
	  </select>
	</label>
	<input type="hidden" name="actualvalue" id="actualvalue" value="<?php echo "$row[1]"; ?>" />
    <input type="hidden" name="buscpendpass" id="buscpendpass" value="<?php echo "$row[0]"; ?>" />
    <!-- FIN DE LA ESTRUCTURA FORM SELECT -->
    <?php
		} // Cierre de else que muestra el menú de opciones de seguimiento (Dentro del while que muestra 
		  // la tabla con los datos del pendiente)			
		
	} else { // Cierre de if "modprio"	
		echo "$row[1]";
	} // Cierre de else "modprio"
	
	} // Cierre de else
	?>
    </td>
    <td align="center"><?php echo "$row[2]"; ?></td>
    <td align="center"><?php echo "$row[3]"; ?></td>
    <td align="center"><?php echo "$row[4]"; ?></td>
    <td align="center">
	<?php
		if ($row[5] == "0000-00-00 00:00:00") {
			echo "<span class=\"naletra\">N/A</span>";
		} else {
			echo "$row[5]";
		}		
	?>
    </td>
    <td align="center">
	<?php
	if ($modo == "modseg") {
		if ($row[6] == "Concluido") {
			echo "$row[6]";
			$errmod = "el seguimiento";
		} else {	

			// Consulta de los valores de seguimiento
			$cols_arr = array("sprv_vseg.seguimiento");
			$num_cols = count($cols_arr);
			$join_tables = '0';
			$tables_arr = array("sprv_vseg");
			$num_tables = count($tables_arr);
			unset($where_clause);

			$result1 = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
    ?>
    <!-- INICIO DE LA ESTRUCTURA FORM SELECT -->        
	<label>
	<select name="selseg" id="selseg">
    <?php
		// While de el select SEGUIMIENTO			
       	while($row1=mysql_fetch_row($result1)) {
		echo "<option";
			if ($row[6] == $row1[0]) {
				echo " selected=\"selected\"";
			} // Cierre de if row6 == row1
			if ($row1[0] <> "Concluido") {
				echo ">$row1[0]</option>";
			} // Cierre if row1 <> concluido
		} // cierre de While fetching rows   	
	?>
	  </select>
	</label>
    <input type="hidden" name="actualvalue" id="actualvalue" value="<?php echo "$row[6]"; ?>" />
	<input type="hidden" name="buscpendpass" id="buscpendpass" value="<?php echo "$row[0]"; ?>" />
    <!-- FIN DE LA ESTRUCTURA FORM SELECT -->
    <?php
		} // Cierre de else que muestra el menú de opciones de seguimiento (Dentro del while que muestra 
		  // la tabla con los datos del pendiente)			

		// Estructura Switch que recupera el valor de la variable 
		// row6 y la asigna a una variable que será usada fuera del ciclo while
		switch($modo) {
			case "modseg":
				$segkeep = $row[6];
				break;
		} // Cierre de Switch modo			
		
	} else { // Cierre de if "modseg"	
		echo "$row[6]";
	} // Cierre de else "modseg"
	?>		
   	  </td>
    </tr>          

	<?php
	} // Cierre del While original
   ?>
</table>

<!-- TABLA DE ERRORES Y BOTON DE ACCION CUANDO SE MODIFICA EL SEGUIMIENTO Y LA PRIORIDAD-->
<table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>

<?php	
	if ($modo == "modconcl" and $segkeep <> "Concluido") {
?>

    <td width="90%" align="right" class="tittextvisitadet">¿Deseas concluir este pendiente?: </td>
	<td width="5%"><!-- FORMA PARA CONCLUIR PENDIENTES --><form id="form3" name="form3" method="post" action="inicio_enviamodpen.php?modenv=conclpend">
      <label>
      <input type="submit" name="button3" id="button3" value="Si" />
      </label>
	  <input type="hidden" name="buscpendpass" id="buscpendpass" value="<?php echo "$buscpend"; ?>" />
     </form></td>
	<td width="5%"><form id="form4" name="form4" method="post" action="inicio_modpend.php?modo=<?php echo "$modo"; ?>">
      <label>
      <input type="submit" name="button4" id="button4" value="No" />
      </label>
      </form></td>

<?php 
	} else {
?>
    <td valign="middle"  
	<?php 
		if ($segkeep == "Concluido") {  
			echo "width=\"100%\">";
 			echo "<span class=\"validateerror\">Este pendiente ya ha sido concluido, $errmod no puede actualizarse</span>";
		} else {
	?>
			width="93%">;
	<?php
    	} // Cierre de if == Concluido	

		if ($samepriovalerr == '1') {
			echo "<span class=\"validateerror\">El pendiente ya tiene esta prioridad, elige una diferente</span>";
			unset($samepriovalerr);
		}
		
		if ($samesegvalerr == '1') {
			echo "<span class=\"validateerror\">El seguimiento del pendiente ya es $segkeep, elige uno diferente</span>";
			unset($samepriovalerr);
		}
    ?>
	
      </td>

	<?php
		if ($segkeep <> "Concluido") {
	?>
    <td width=" valign="middle"7%"><div align="right">
      <label>
      <input type="submit" name="button2" id="button2" value="Actualizar" />
      </label>
    </div></td>

	<?php	
		} // Cierre de if <> Concluido
	} // Cierre Else de columna
?>

  </tr>
</table>
<!-- FINALIZA LA TABLA DE ERRORES Y BOTON DE ACCION CUANDO SE MODIFICA EL SEGUIMIENTO Y LA PRIORIDAD -->
<?php
		if ($modo == "modseg" or $modo == "modprio") {					
?>
    </form>
<?php
		}
?>

<?php
	} // Cierre else tabla errores y boton de acción
?>
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php 
			if ($resbusc == '1' and $modo == "modconcl" and $segkeep <> "Concluido") {
 			echo "<span class=\"validateerror\">Nota: </span><span class=\"tittextvisitadet\">Una vez concluido, el seguimiento del pendiente, no podrá actualizarse</span>";
		}

		?>
		</td>
  </tr>
</table>
<p>&nbsp; </p>

 
