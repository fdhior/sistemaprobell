<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.letramoduser {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    font-weight: normal;
    color: #000000;
	padding-left: 26px;
}

-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php

	session_start();
	
	$rutafunciones = $_SERVER['rutafunciones'];
	include $rutafunciones.'consultas.php';
	include $rutafunciones.'"valida_correo.php';
	
	$hostname = $_SESSION['hostname'];	
	
	$target_link   = "supervision/usuarios/supervision_usuarioslistado.php";
	$target_frame  = "moduser_frame"; 

    foreach ($_POST as $nombre => $valor) {
	    if(stristr($nombre, 'button') === FALSE) {
    	    ${$nombre} = $valor;
        }
	}	

	
/*  // Mostrar los valores de _POST
    echo "Valores de _POST <br />";
	foreach ($_POST as $nombre => $valor) {
    	if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
        }
	} */
?>

<body>

<?php

	if ($actualiza == "modusuario") {
/* ---------------------------------------- INICIA VALIDACION DE DATOS ---------------------------- */

		// Valida act_nombreusuario
		if ($act_nombreusuario <> "") {
			$cols_arr = array("username");
        	$num_cols = count($cols_arr);
    	    $tables_arr = array("gnrl_usrs");
        	$num_tables = count($tables_arr);

	       	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

    	    while($row=mysql_fetch_row($result)) {
	    	   	if ($row[0] == $act_nombreusuario) {
    	    	   	$error = "El usuario <strong>$act_nombreusuario</strong> ya existe en la base de datos";
                	$error_id = 0;
		       	}
		    }   // cierre de While
		} 

		// Valida act_idt
		if ($act_idt <> "") {
			if (!is_numeric($act_idt)) {
				$error = "El dato necesita ser un n&uacute;mero";
				$error_id = 1; 
			} else {	

				// Comparar idt contra la base de usuarios
				$cols_arr = array("idinmu");
	   			$num_cols = count($cols_arr);
    	    	$tables_arr = array("gnrl_usrs");
				$num_tables = count($tables_arr);

				$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
				while($row=mysql_fetch_row($result)) {
					if ($row[0] == $act_idt) {
						$evenid = "1";
		   			} // Cierre de if
				}   // cierre de While

				if ($evenid == "1") {
			   		$error = "El ID ya esta asignado a otro Usuario";
				    $error_id = 2;
				}
			}	
		} 

		// Valida act_nomtienda
		if ($act_nomtienda <> "") {
			// Comprobar nombre de usuario contra la base de usuarios
			$cols_arr     = array("nombre");
			$num_cols     = count($cols_arr);
	    	$tables_arr   = array("gnrl_usrs");
   			$num_tables   = count($tables_arr);
			$where_clause = "gnrl_usrs.idtusr = 3 AND gnrl_usrs.idarea = 5";

	   		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	    						
			$tempstr_b = $act_nomtienda;
			$tempstr_b = strtolower($tempstr_b);
	
			while($row=mysql_fetch_row($result)) {
				$tempstr_a = $row[0];	
				$tempstr_a = strtolower($tempstr_a);
				if ($tempstr_a == $tempstr_b) {
					$evennm = "1";
		   	   	} // Cierre de if
			}   // cierre de While
	
			if ($evennm == "1") {
	   			$error = "Este nombre ya est&aacute; asignado a otro Usuario";
			    $error_id = 3;
				$act_nomtienda = strtolower($act_nomtienda);
				$act_nomtienda = ucwords($act_nomtienda);
			} 
		}
		
		// Valida act_correoe
		if ($act_correoe <> "") {
			if (check_email_address($act_correoe) === false) { 
		   		$error = "Hay un error en la escritura de esta direcci&oacute;n de correo";
			    $error_id = 4;
			}	
		}	


		if (isset($error)) {
			$_SESSION['errorpass']         = $error;
			$_SESSION['error_id']          = $error_id;
			$_SESSION['iduser']		       = $iduser;
			$_SESSION['act_nombreusuario'] = $act_nombreusuario;
			$_SESSION['act_password']      = $act_password;
			$_SESSION['act_idt']           = $act_idt;
			$_SESSION['act_nomtienda']     = $act_nomtienda;
			$_SESSION['act_correoe']       = $act_correoe;
			$_SESSION['invalid_check']	   = "1";

			header("Location: supervision_modificausuario.php");
			exit();
		}	

/* ---------------------------------------- TERMINA VALIDACION DE DATOS ---------------------------- */
	
		// Insertar los datos en el log de la base de datos
		if ($act_nombreusuario <> ""){
			$colsvalarr[] = "username = '$act_nombreusuario'"; 
		}	

		if ($act_password <> ""){
			$colsvalarr[] = "pswd = '$act_password'"; 
		}	

		if ($act_idt <> ""){
			$colsvalarr[] = "idinmu = '$act_idt'"; 
		}	
	
		if ($act_nomtienda <> ""){
			$act_nomtienda = strtolower($act_nomtienda);
			$act_nomtienda = ucwords($act_nomtienda);
			$colsvalarr[] = "nombre = '$act_nomtienda'"; 
		}	
		
		if ($act_correoe <> ""){
			$colsvalarr[] = "correoe = '$act_correoe'"; 
		}	

		$numcols      = count($colsvalarr);
		$aff_table    = "gnrl_usrs";
		$where_clause = "iduser = '$iduser'";

		$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 
	

?>

<br />
<br />
<span class="letramoduser">El Usuario No. <strong><?php echo "$iduser"; ?></strong> fu&eacute; actualizado con la siguiente información:</span><br />

<?php

		if ($act_nombreusuario <> "") {
?>
	
<br /><span class="letramoduser">Nombreusuario: <strong><?php echo "$act_nombreusuario"; ?></strong></span>

<?php

		}	

		if ($act_password <> "") {
?>
	
<br /><span class="letramoduser">Contrase&ntilde;a: <strong><?php echo "$act_password"; ?></strong></span>

<?php

		}	

		if ($act_idt <> "") {
?>
	
<br /><span class="letramoduser">ID Tienda: <strong><?php echo "$act_idt"; ?></strong></span>

<?php

		}		

		if ($act_nomtienda <> "") {
?>
	
<br /><span class="letramoduser">Nombre Tienda: <strong><?php echo "$act_nomtienda"; ?></strong></span>

<?php

		}	

		if ($act_correoe <> "") {
?>
	
<br /><span class="letramoduser">Correo Electr&oacute;nico: <strong><?php echo "$act_correoe"; ?></strong></span>

<?php

		}		

?>

<?php

	} // Cierre de if modusuario

	if ($actualiza == "moddesactivar") {

		$colsvalarr[] = "idusrstatus = '2'"; 
		$numcols      = count($colsvalarr);
		$aff_table    = "gnrl_usrs";
		$where_clause = "iduser = '$iduser'";

		$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 

?>

<br />
<span class="letramoduser">El Usuario No. <strong><?php echo "$iduser"; ?></strong> fu&eacute; deshabilitado</span><br />


<?php

 	}

	if ($actualiza == "modreactivar") {

		$colsvalarr[] = "idusrstatus = '1'"; 
		$numcols      = count($colsvalarr);
		$aff_table    = "gnrl_usrs";
		$where_clause = "iduser = '$iduser'";

		$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 

?>

<br />
<span class="letramoduser">El Usuario No. <strong><?php echo "$iduser"; ?></strong> fu&eacute; reactivado</span><br />

<?php

	}

?>

<form id="form0" name="form0" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
  <input name="busca" type="hidden" id="busca" value="poridusuario" />
  <input name="update" type="hidden" id="busca" value="show" />
  <input name="iduser" type="hidden" id="usuarioesp" value="<?php echo "$iduser"; ?>" />
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->


<script language="javascript">
//	window.alert("Revisa el resultado de la transferencia.");
	document.forms[0].submit();
</script>


</body>
</html>
