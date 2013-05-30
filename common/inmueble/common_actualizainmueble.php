<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.letraaduser {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: normal;
        color: #000000;
        padding-left: 26px;
		left: 26px;
		margin-left: 26;
}

.tablaagruser {
        padding-left: 26px;
        width: 300px;
}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>


<?php

    session_start();
	
	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';
	
	$hostname 	 = $_SESSION['hostname'];
	$abshostname = $_SESSION['abshostname']; 

	$target_link   = "common/inmueble/common_inmueblelistado.php";
	$target_link2  = "cursos/ubicacion.php";
	$target_frame  = "moduser_frame";
	
//	include "valida_correo.php";

//  $hostname   = $_SESSION['hostname'];
		
 	/*echo "<span class=\"tipoletra\">Valores de _POST</span><br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
		}
	}*/  

     // Convertir vaariables POST en locales
     foreach ($_POST as $nombre => $valor) {
	     if(stristr($nombre, 'button') === FALSE) {
    	     ${$nombre} = $valor;
         }
	 }// Cierre foreach     

//	echo "$encargado";
?>	
</head>

<body>
<br />

<form id="form0" name="form0" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
	<input name="sel_sttienda" type="hidden" id="sel_sttienda" value="activas" /> 
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->

<?php
	
	switch ($modoedpass) {
		case "editatienda":	
			/* --------------------------------------- INICIA VALIDACION DE DATOS ---------------------------- */
			if (trim($_POST['direccion']) == "") {
				$error = "Debes ingresar la dirección de este Inmueble/Tienda";
				$error_id = 0;
			} else {
				if (trim($_POST['notel1']) <> "" and !is_numeric($notel1)) {	
					$error = "El dato necesita ser un n&uacute;mero";
					$error_id = "1"; 
				} else {	
					if (trim($_POST['notel2']) <> "" and !is_numeric($notel2)) {	
						$error = "El dato necesita ser un n&uacute;mero";
						$error_id = "2";
					} else {
						if (trim($_POST['nocel']) <> "" and !is_numeric($nocel)) {	
							$error = "El dato necesita ser un n&uacute;mero";
							$error_id = "3";
					 	} else {	 
							if (trim($_POST['nofax']) <> "" and !is_numeric($nofax)) {	
								$error = "El dato necesita ser un n&uacute;mero";
								$error_id = "4";
							}	 
						}	
					}
				}		
			}
			/* ---------------------------------------- TERMINA VALIDACION DE DATOS ---------------------------- */

			if (isset($error)) {
		
				$_SESSION['err_return'] = array("errorpass" => "$error", "error_id" => "$error_id", "sel_rsc" => "$sel_rsc", "direccion" => "$direccion", "notel1" => "$notel1", "notel2" => "$notel2", "nocel" => "$nocel", "nofax" => "$nofax", "idinmu" => "$idinmupass", "modoed" => "$modoedpass", "invalid_check"=> "1");

				header("Location: ".$_SERVER['HTTP_REFERER']."");
				exit();
			} 
			
			/* ---------------------------------------- INSERTAR DATOS EN LA BASE ---------------------------- */


			// Obtener id de razaon social
			$cols_arr   = array("idfis");
			$num_cols   = count($cols_arr);
			$tables_arr = array("inmu_dfis");
			$where_clause  = "inmu_dfis.razonsc = '$sel_rsc'";

			$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

			$row1=mysql_fetch_row($result);
	
			$rsc_insert = $row1[0];		
	
			$aff_table = "inmu_gdat";
			$colsvalarr = array("idfis = '$rsc_insert'", "direccion = '$direccion'");
			if ($notel1 <> "") {
				$colsvalarr[] = "notel1 = '$notel1'";
			}
			if ($notel2 <> "") {
				$colsvalarr[] = "notel2 = '$notel2'";
			}
			if ($nocel <> "") {
				$colsvalarr[] = "nocel = '$nocel'";
			}
			if ($nofax <> "") {
				$colsvalarr[] = "nofax = '$nofax'";
			}
			$numcols = count($colsvalarr);
			$where_clause = "idinmu = '$idinmupass'";

			$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 


?>



<h2>Datos de Tienda Modificados</h2>
<span class="letraaduser">Los datos de la tienda <strong><?php echo "$nombretpass"; ?></strong>, fueron modificados, para revisar los cambios da click en continuar</span><br />
<br />
<br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post" name="form1" target="_self" id="form1">
      <td></label>
        <label>
          <input type="submit" name="button" id="button" value="Continuar" onclick="javascript: actualizalista()" />
          <input name="idinmu" type="hidden" id="idinmu" value="<?php echo "$idinmupass"; ?>" />
    </label></td></form>
  </tr>
</table>

<?php			
			break;
		case "editaencargado":			
			/* --------------------------------------- INICIA VALIDACION DE DATOS ---------------------------- */
			if (!isset($_POST['encargado']) || trim($_POST['encargado']) == "") {
				$error = "Ingresa un nombre para el encargado";
				$error_id = 0;
			} else {
		
				// Comprobar nombre de usuario contra la base de usuarios
				$cols_arr      = array("gnrl_enca.nombre");
				$num_cols      = count($cols_arr);
//				$join_tables   = 1;
				$tables_arr    = array("gnrl_enca");
//				$on_fields_arr = array("idenc");
//    			$num_tables    = count($tables_arr);
				$where_clause  = "gnrl_enca.nombre = '$encargado'";

	   			$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
			
				$encargado = strtolower($encargado);
				$encargado = ucwords($encargado);
				$tempstr_b = $encargado;
				$tempstr_b = strtolower($tempstr_b);
				   	
				$row=mysql_fetch_row($result);
				$tempstr_a = $row[0];	
				$tempstr_a = strtolower($tempstr_a);
				if ($tempstr_a == $tempstr_b) {
					$evennm = "1";
	   	   		} // Cierre de if
		
				if ($evennm == "1") {
   			 		$error = "Este encargado ya esta asignado a otro inmueble/tienda, o ya existe en la base de datos";
	   			 	$error_id = 1;
					$encargado = strtolower($encargado);
					$encargado = ucwords($encargado);
				} // Cierre de if
			} // Cierre de else	
			/* ---------------------------------------- TERMINA VALIDACION DE DATOS ---------------------------- */


			if (isset($error)) {
		
				$_SESSION['err_return'] = array("errorpass" => "$error", "error_id" => "$error_id", "idinmu" => "$idinmupass", "modoed" => "$modoedpass", "invalid_check"=> "2");

				header("Location: ".$_SERVER['HTTP_REFERER']."");
				exit();
			}
			
			if (isset($encargadopass)) { 
				$aff_table = "gnrl_enca";
				$colsvalarr = array("asig = '0'");
				$numcols = count($colsvalarr);
				$where_clause = "nombre = '$encargadopass'";

				$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 
			}			
		
			$inserta_encargado = ucwords($encargado);
	
			// Inserta el nombre del encargado en la base de datos
			$colsarr = array("idenc", "nombre");
			$numcols = count($colsarr);
			$valarr  = array("NULL", "'$inserta_encargado'");
			$aff_table = "gnrl_enca";

			$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

			// Recupera el id de el encargado 
			$cols_arr   = array("idenc");
			$num_cols   = count($cols_arr);
			$tables_arr = array("gnrl_enca");
			$where_clause  = "gnrl_enca.nombre = '$encargado'";
	
			$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
			$row0=mysql_fetch_row($result);
			
			
			$aff_table = "inmu_gdat";
			$colsvalarr = array("idenc = '$row0[0]'");
			$numcols = count($colsvalarr);
			$where_clause = "idinmu = '$idinmupass'";

			$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 

?>

<h2>Encargado(a) de Tienda Modificado</h2>
<span class="letraaduser">El nuevo encargado(a) <strong><?php echo "$encargado"; ?></strong> fué asignado a la  tienda <strong><?php echo "$nombretpass"; ?></strong>.</span><br />
<br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post" name="form1" target="_self" id="form1">
      <td></label>
        <label>
        <input type="submit" name="button" id="button" value="Continuar" onclick="javascript: actualizalista()" />
          <input name="idinmu" type="hidden" id="idinmu" value="<?php echo "$idinmupass"; ?>" />
          <input name="modoed" type="hidden" id="idinmu" value="<?php echo "$modoedpass"; ?>" />
    </label></td></form>
  </tr>
</table>

<?php

			break;
		case "intercambiaenc":

				// recuperar idenc de la tienda origen (la que entré a editar)
				$cols_arr      = array("idenc");
				$num_cols      = count($cols_arr);
//				$join_tables   = 1;
				$tables_arr    = array("inmu_gdat");
//				$on_fields_arr = array("idenc");
//    			$num_tables    = count($tables_arr);
				$where_clause  = "inmu_gdat.idinmu = '$idinmupass'";

	   			$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
				
				$row0=mysql_fetch_row($result);
				
//				echo "id de encargado tienda origen: $row0[0] <br />";			
	
				$extrae_idinmu = substr($inter_enc,0,strpos($inter_enc," - ")-0);
//				echo "idinmu de tienda destino: $extrae_idinmu <br />"; 

				// recuperar idenc de la tienda destino (por la que la estoy cambiando)
				$cols_arr      = array("idenc");
				$num_cols      = count($cols_arr);
//				$join_tables   = 1;
				$tables_arr    = array("inmu_gdat");
//				$on_fields_arr = array("idenc");
//    			$num_tables    = count($tables_arr);
				$where_clause  = "inmu_gdat.idinmu = '$extrae_idinmu'";

	   			$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

				$row1=mysql_fetch_row($result);

//				echo "id de encargado tienda destino: $row1[0] <br />";			


				// Actualizar Tienda Origen
				$aff_table = "inmu_gdat";
				$colsvalarr = array("idenc = '$row1[0]'");
				$numcols = count($colsvalarr);
				$where_clause = "idinmu = '$idinmupass'";

				$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 

				// Actualizar Tienda Destino
				$aff_table = "inmu_gdat";
				$colsvalarr = array("idenc = '$row0[0]'");
				$numcols = count($colsvalarr);
				$where_clause = "idinmu = '$extrae_idinmu'";

				$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 
				
//				echo "Cambio Listo!!!! <br />";			
?>

<h2>Encargados de Tienda Intercambiados</h2>
<?php

		$cols_arr      = array("gnrl_enca.nombre", "inmu_gdat.nombreinmu");
    	$num_cols      = count($cols_arr);
	    $join_tables   = '1';
		$tables_arr    = array("gnrl_enca", "inmu_gdat");
	    $num_tables    = count($tables_arr);
		$on_fields_arr = array("idenc");
//			$connect      = '1';
	  	$where_clause = "inmu_gdat.idinmu = '$idinmupass'";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row0=mysql_fetch_row($result);

?>

<span class="letraaduser">Los Encargados han sido intercambiados:</span><br />
<br />
<span class="letraaduser"><strong><?php echo "$row0[0]"; ?></strong> ahora es encargado(a) de la tienda <strong><?php echo "$row0[1]"; ?></strong>.</span><br />
<?php 

		$cols_arr      = array("gnrl_enca.nombre", "inmu_gdat.nombreinmu");
    	$num_cols      = count($cols_arr);
	    $join_tables   = '1';
		$tables_arr    = array("gnrl_enca", "inmu_gdat");
	    $num_tables    = count($tables_arr);
		$on_fields_arr = array("idenc");
//			$connect      = '1';
	  	$where_clause = "inmu_gdat.idinmu = '$extrae_idinmu'";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row1=mysql_fetch_row($result);
 ?>
<span class="letraaduser">y <strong><?php echo "$row1[0]"; ?></strong> ahora es encargado(a) de la tienda <strong><?php echo "$row1[1]"; ?></strong>.</span><br />
<br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post" name="form1" target="_self" id="form1">
      <td></label>
        <label>
        <input type="submit" name="button" id="button" value="Continuar" onclick="javascript: actualizalista()" />
        </label></td></form>
  </tr>
</table>

<?php		

			break;
		case "editanombreencargado":
		
			// Actualizar Tienda Origen
			$aff_table = "gnrl_enca";
			$colsvalarr = array("nombre = '$encargado'");
			$numcols = count($colsvalarr);
			$where_clause = "idenc = '$idencpass'";

			$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 

?>

<h2>Nombre de Encargado(a) Actualizado</h2>
<span class="letraaduser">Nombre de el Encargado(a) de la tienda <strong><?php echo "$nombretpass"; ?></strong> fu&eacute; actualizado.</span><br />
<span class="letraaduser">su nombre editado es el siguiente: <strong><?php echo "$encargado"; ?></strong>.</span><br />
<br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post" name="form1" target="_self" id="form1">
      <td></label>
        <label>
        <input type="submit" name="button" id="button" value="Continuar" onclick="javascript: actualizalista()" />
        </label></td></form>
  </tr>
</table>

<?php

			break;
		case "agregaencargado";	
		
		
			if (!isset($_POST['encargado']) || trim($_POST['encargado']) == "") {
				$error = "Ingresa un nombre para el encargado";
				$error_id = 0;
			} else {
			
				if (is_numeric($encargado)) {	
						$error = "El dato necesita ser un nombre no un n&uacute;mero";
						$error_id = "1";
				} else {
				
					// Comprobar nombre de usuario contra la base de usuarios
					$cols_arr      = array("gnrl_enca.nombre");
					$num_cols      = count($cols_arr);
//					$join_tables   = 1;
					$tables_arr    = array("gnrl_enca");
//					$on_fields_arr = array("idenc");
//    				$num_tables    = count($tables_arr);
					$where_clause  = "gnrl_enca.nombre = '$encargado'";

		   			$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
				
//					unset($join_tables);
//					unset($on_fields_arr);
//					unset($num_tables);
				
					$encargado = strtolower($encargado);
					$encargado = ucwords($encargado);
					$tempstr_b = $encargado;
					$tempstr_b = strtolower($tempstr_b);
				   	
					$row=mysql_fetch_row($result);
					$tempstr_a = $row[0];	
					$tempstr_a = strtolower($tempstr_a);
					if ($tempstr_a == $tempstr_b) {
						$evennm = "1";
		   	   		} // Cierre de if
		
					if ($evennm == "1") {
   			 			$error = "Este(a) encargado(a) ya existe en la base de datos";
	   				 	$error_id = 2;
						$encargado = strtolower($encargado);
						$encargado = ucwords($encargado);
					} // Cierre de if
				} // Cierre de else	
			}	
			/* ---------------------------------------- TERMINA VALIDACION DE DATOS ---------------------------- */


			if (isset($error)) {
		
				$_SESSION['err_return'] = array("errorpass" => "$error", "error_id" => "$error_id", "encargado" => "$encargado", "modoed" => "editaencargado", "add_opt" => "$add_optpass", "invalid_check" => "3");

				header("Location: ".$_SERVER['HTTP_REFERER']."");
				exit();
			}
		

			$encargado = ucwords($encargado);

			// Inserta el nombre del encargado en la base de datos
			$colsarr = array("idenc", "nombre", "asig");
			$numcols = count($colsarr);
			$valarr  = array("NULL", "'$encargado'", "'0'");
			$aff_table = "gnrl_enca";

			$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

?>

<h2>Encargado(a) Agregado a la Base de Datos</h2>
<span class="letraaduser">Se agreg&oacute; un Encargado(a) de nombre <strong><?php echo "$encargado"; ?></strong> a la base de datos </span><br />
<span class="letraaduser">sin asignarlo a una tienda. Posteriormente es posible asignarlo a una tienda mediante</span><br />
<span class="letraaduser">la opci&oacute;n adecuada.</span>   
<br /><br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post" name="form1" target="_self" id="form1">
      <td></label>
        <label>
        <input type="submit" name="button2" id="button2" value="Continuar" onclick="javascript: actualizalista()" />
        </label></td></form>
  </tr>
</table>

<?php
			break;
		case "asignanoasigencargado":

			// Recupera el id de el encargado que reemplazara al actual
			$cols_arr      = array("gnrl_enca.idenc");
			$num_cols      = count($cols_arr);
//			$join_tables   = '1';
			$tables_arr    = array("gnrl_enca");
//			$num_tables    = count($tables_arr);
//			$on_fields_arr = array("idenc");
			$where_clause  = "gnrl_enca.nombre = '$encargado'";
	
			$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
			$row0=mysql_fetch_row($result);

			$inserta_enc = $row0[0];
			
			// Actualizar el numero de encargado para tienda en donde se realiza el reeemplazo
			$aff_table = "inmu_gdat";
			$colsvalarr = array("idenc = '$inserta_enc'");
			$numcols = count($colsvalarr);
			$where_clause = "inmu_gdat.idinmu = '$idinmupass'";

			$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 
			

			if ($submodoedpass <> "encsinasignar") {  // En caso de que la tienda no haya tenido un encargado asignado esta condicional se salta el paso de ponerlo en cero
				// Desasigno al encargado anterior
				$aff_table = "gnrl_enca";
				$colsvalarr = array("asig = '0'");
				$numcols = count($colsvalarr);
				$where_clause = "gnrl_enca.nombre = '$encargado_ant'";
				
				$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 
			}
					
			// Marco como asigando al encargado nuevo
			$aff_table = "gnrl_enca";
			$colsvalarr = array("asig = '1'");
			$numcols = count($colsvalarr);
			$where_clause = "gnrl_enca.nombre = '$encargado'";

			$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 

?>

<h2>Encargado(a) Asignado a Tienda</h2>
<span class="letraaduser">El encargado(a) <strong><?php echo "$encargado"; ?></strong> fu&eacute; asignado a la </span><br />
<span class="letraaduser">tienda  <strong><?php echo "$nombretpass"; ?></strong>.
<?php if ($submodoedpass == "encsinasignar") { echo "</span>"; } else { ?> 
El/la encargado(a) anterior se coloc&oacute;</span><br />
<span class="letraaduser">en la lista de encargados sin asignar.</span>   
<?php } ?>
<br /><br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post" name="form1" target="_self" id="form1">
      <td></label>
        <label>
        <input type="submit" name="button" id="button" value="Continuar" onclick="javascript: actualizalista()" />
        <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
        <input name="add_opt" type="hidden" id="add_opt" value="3" />
    </label></td></form>
  </tr>
</table>

<?php
			
			break;	
		case "eliminaencargado":
			
			$extrae_idenc = substr($sel_encpass,0,strpos($sel_encpass," - ")-0);

			if ($submodoedpass <> "encsinasignar") {	
				// Desasociamos el encargado de la tienda
				$aff_table = "inmu_gdat";
				$colsvalarr = array("idenc = '0'");
				$numcols = count($colsvalarr);
				$where_clause = "idenc = '$extrae_idenc'";

				$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 

			} // Cierre de if

			// Borramos el encargado de la base de encargados
			$aff_table =  "gnrl_enca";
			$where_clause = "idenc = '$extrae_idenc'";
			
			$result = gnrl_delete_query($aff_table, $where_clause);

			$action = "AUTO_INCREMENT = 0";
			$modifiers = "";

			$result = gnrl_altertable_query($aff_table, $action, $modifiers);	

?>

<h2>Encargado(a) Eliminado</h2>
<span class="letraaduser">El encargado(a) No. <?php echo "$sel_encpass"; ?></span><br />
<span class="letraaduser">fu&eacute; eliminado.
<?php if ($submodoedpass == "encsinasignar") { echo "</span>"; } else { ?> 
La tienda ahora no tiene encargado asignado alguno.<span><br />
<span class="letraaduser">Se le puede asociar alguno con la opci&oacute;n adecuada.</span>   
<?php } ?>
<br /><br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post" name="form1" target="_self" id="form1">
      <td></label>
        <label>
        <input type="submit" name="button" id="button" value="Continuar" onclick="javascript: actualizalista()" />
        <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
<?php

		if ($submodoedpass == "encsinasignar") {

?>

        <input name="add_opt" type="hidden" id="add_opt" value="5" />

<?php

		} else {

?>
        <input name="add_opt" type="hidden" id="add_opt" value="4" />
        
<?php        

		}

?>
        
    </label></td></form>
  </tr>
</table>

<?php
			break;
		case "agregalinktienda":

		if (!isset($_POST['linkpass']) || trim($_POST['linkpass']) == "") {
			$error = "Ingresa el link";
			$error_id = 5;
		}

		if (isset($error)) {
		
			$_SESSION['err_return'] = array("errorpass" => "$error", "error_id" => "$error_id", "idinmu" => "$idinmupass", "modoed" => "editatienda", "invalid_check" => "4");

			header("Location: ".$_SERVER['HTTP_REFERER']."");
			exit();
		}
		
        // inserta el link en la base 
		// Inserta el nombre del encargado en la base de datos
		$colsarr = array("idubica", "idinmu", "googlelink");
		$numcols = count($colsarr);
		$valarr  = array("NULL", "'$idinmupass'", "'$linkpass'");
		$aff_table = "inmu_gubc";

		$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

 
		// Recuperar idcurso
		$cols_arr      = array("MAX(idubica)");
		$num_cols      = count($cols_arr);
		$tables_arr    = array("inmu_gubc");

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

    	$ubica_id=mysql_fetch_row($result);
		
		
		$aff_table = "inmu_gdat";
		$colsvalarr = array("idubica = '$ubica_id[0]'");
		$numcols = count($colsvalarr);
		$where_clause = "idinmu = '$idinmupass'";

		$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 
  
?>
<br />
<h2>Enlace Almacenado</h2>
<span class="letraaduser">Vista Previa Ubicación de la Tienda: <?php echo "$ntpass"; ?></span><br />
   <a class="letramoduser" href="<?php echo "$abshostname$target_link2"; ?>?ntpass=<?php echo "$ntpass"; ?>&idinmupass=<?php echo "$idinmupass"; ?>" target="_blank">Ver ubicacion</a>


<label><?php

			break;
	} // Cierre de switch		

?></label>


<script language="javascript"> 
	
	function actualizalista() 
	{
		document.forms[0].submit();
	}
	
</script>


</body>
</html>
