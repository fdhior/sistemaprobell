<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script type="text/javascript"></script>
</head>

<body onload="javascript:document.forms[0].submit();">
<?php
	session_start();
	include "consultas.php";
	
	// Variables $_SESSION a locales
	$iduser     = $_SESSION['iduser'];    // ID del usuario de la sesión
	$iduserarea = $_SESSION['idusrarea']; // Area del ususario de la sesión

	$modenv = $_GET['modenv'];
	
//	$modo = $_POST['modo'];

	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			${$nombre} = $valor;
		}
	} // Cierre foreach	


	// Muestra los valores $_POST
/*	foreach ($_SESSION as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre Variable: <b>$nombre</b> Valor: <b>$valor</b><br />"; 
		}	
	} */

	// Comprobar si el valor que se quiere acualizar ya es el valor actual
	if ($modenv == "actprio") {
		if ($selprio == $actualvalue) {
			$_SESSION['samepriovalerr'] = '1';
			$_SESSION['buscpend'] = $buscpendpass;
			header("Location: inicio_modpend.php?modo=modprio"); 
		}
	}

	if ($modenv == "actseg") {
		if ($selseg == $actualvalue) {
			$_SESSION['samesegvalerr'] = '1';
			$_SESSION['buscpend'] = $buscpendpass;
			header("Location: inicio_modpend.php?modo=modseg"); 
		}
	}
?>

<form id="form0" name="form0" method="post" action="inicio_listapendientes.php" target="pendlist">
  &nbsp;&nbsp;&nbsp;
<input type="hidden" name="idtv" id="hiddenField" value="<?php echo "$buscpendpass"; ?>" />
<input type="hidden" name="busqueda" id="hiddenField2" value="poridt" />
<input type="hidden" name="modo" id="modo" value="activos" />
</form>
	
<?php
	if ($modenv == "conclpend") {
?>

<p class="tittextvisitadet">El pendiente No. <?php echo "$buscpendpass"; ?> ha sido concluido.
<br />El resultado se muestra en la lista de pendientes 
<br />¿Deseas concluir otro pendiente?<br />
</p>
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="2%"><form action="inicio_modpend.php?modo=modconcl" method="post" name="form1" target="_self" id="form1">
      <label>
        <input type="submit" name="button2" id="button2" value="SI" />
        </label>
    </form></td>
    <td width="98%"><form action="inicio_penddet_ult3.php" method="post" name="form2" target="_self" id="form2">
      <label>
        <input type="submit" name="button2" id="button4" value="NO" />
        </label>
    </form></td>
  </tr>
</table>
<!-- <p class="tittextvisitadet">&nbsp;</p> -->
<?php
	}
	
	switch ($modenv) {
		case "actprio":
			switch ($selprio) {
				case "Urgente":
					$prio_up = '1';
					break;
				case "Normal":	
					$prio_up = '2';
					break;
				case "Baja":
					$prio_up = '3';
					break;						
			}
			$up_string = "sprv_pend.idprioridad = $prio_up"; // array con las columnas a actualizar y el valor del campo
			break;
		case "actseg":
			switch ($selseg) {
				case "Por Atender":
					$seg_up = '1';
					break;
				case "En Proceso":	
					$seg_up = '2';
					break;
			}
			$up_string = "sprv_pend.idseg = $seg_up"; // array con las columnas a actualizar y el valor del campo
	
			break;
		case "conclpend":
			$up_string = "sprv_pend.idseg = 3, sprv_pend.fechafin = CURRENT_TIMESTAMP"; // array con las columnas a actualizar y el valor del campo
//			echo "Valor de up_string: $up_string<br />";
			break;
	}				
	 
		
	// Actualizar Los Datos en la base de datos (Variables comunes)
	$aff_table = "sprv_pend"; // La tabla que se afectará en la actualización
	$colsvalarr = array("$up_string", "sprv_pend.atendido = $iduser");
	$numcols = count($colsvalarr); // El número de columnas (con valor) que se actualizarán
	$where_clause = "sprv_pend.idpend = '$buscpendpass'";

	// Llama a la función que "arma" las consultas
	$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause);		
		
	if ($modenv == "actprio" or $modenv == "actseg") {
?>
<p class="tittextvisitadet"><?php 
								 if ($modenv == "actprio") {
								 	$modocamb = "La Prioridad";
									echo "$modocamb";
								 } else {
								 	$modocamb = "El Seguimiento";
									echo "$modocamb";
								 }	
							?> del pendiente No. <?php echo "$buscpendpass "; ?>
se ha actualizado a <?php
							 if ($modenv == "actprio") {
							 	echo "$selprio";
							 } else {
							 	echo "$selseg";
							 }	
						  ?>.<br /> Los Resultados se muestran el la lista de pendientes<br />¿Deseas cambiar <?php
						  				 $modcamb = strtolower($smodcamb);
										 echo "$modocamb "; ?> de otro pendiente?</p>
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="2%"><form action="inicio_modpend.php?modo=<?php 
									if  ($modenv == "actprio") {
										echo "modprio";
									} else {
										echo "modseg";
									}										
								?>" method="post" name="form1" target="_self" id="form1">
      <label>
        <input type="submit" name="button" id="button" value="SI" />
        </label>
    </form></td>
    <td width="98%"><form action="inicio_penddet_ult3.php" method="post" name="form2" target="_self" id="form2">
      <label>
        <input type="submit" name="button3" id="button3" value="NO" />
        </label>
    </form></td>
  </tr>
</table>
<p class="tittextvisitadet">
  <?php
	} // Cierre de mensaje
?>
</p>
</body>
</html>
