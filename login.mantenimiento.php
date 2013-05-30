<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<title>SISTEMA EN LINEA DE TRABAJO EN GRUPO PROBELL</title>
	<link rel="stylesheet" type="text/css" href="css/sistemaprobell.css" />
</head>
<body>

<?php
// form not submitted
	session_start();
	include "funciones/consultas.php";
//	include "funciones/conectarainventario.php";

	// Mostrar los valores de _POST
/*	echo "Valores de _POST <br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />"; 
		}
	} */

	if (isset($_POST['entrada'])) {
		$entrada = $_POST['entrada'];

		include "funciones/conectarainventario.php";

		$inputUser = mysql_real_escape_string($_POST['username']);
		$inputPass = mysql_real_escape_string($_POST['password']);

		include "funciones/cerrar_conexion.php";

	}	
	
	// Si no sea enviado informacion se muestran las entradas	
	if (!$_POST['submit']) {
?>


<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center"><img src="images/probell logo-final.jpg" width="224" height="117" /></p>
<p class="loginhead" align="center">Sistema En L&iacute;nea de Trabajo En Grupo Probell</p>
<p class="logintext" align="center">Ingreso a Usuarios<br>
  Ingresa Tu Usuario y Contrase&ntilde;a</p>
<p class="logintext" align="center">Temporalmente fuera de servicio intenta mas tarde</p>
<table border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="#CADAEC">
<form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<tr>
<td class="logintext">Usuario</td>
<td><input type="text" size="10" name="username"></td>
</tr>
<tr>
<td class="logintext">Contrase&ntilde;a</td>
<td><input type="password" size="10" name="password"></td>
</tr>
<tr>
<td colspan="2" align="center"><input name="entrada" type="hidden" id="entrada" value="admin" />
  <input name="submit" type="submit" class="logintext" value="Entrar" disabled="disabled"></td>
</tr>
</form>
</table>



</body>


<?php
	}

$err_mess = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<link rel=\"stylesheet\" type=\"text/css\" href=\"table.css\" />
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>ERROR En Los Datos</title>

<body>
<div align=\"center\">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p class=\"logintext\">";

$cierre_err_mess = "<a href=\"login.php\" title=\"intenta de nuevo\" target=\"_self\">intenta ingresar de nuevo</a></p>
</div>
</body>
</html>";

	if ($entrada == "admin") {
		// form submitted
		// check for username
		if (!isset($_POST['username']) || trim($_POST['username']) == "") {
			die ("$err_mess Debes teclar un nombre de usuario<br /> $cierre_err_mess");

		} 
		// check for password
		if (!isset($_POST['password']) || trim($_POST['password']) == "") {
			die ("$err_mess Debes teclar tu contraseña<br />Si la olvidaste contacta a el Area de sistemas<br /> $cierre_err_mess");
		}

		// connect and execute SQL query
//		$connection = mysql_connect("localhost", "root", "probell") or die ("No se puede conectar!");
//		mysql_select_db("egprobell");
		// assign to variables and escape

		
		// Consulta Nombre e ID de Tiendas
		//                   0          1        2         3          4         5           6            7    	      8            9             10		      11              12
		$cols_arr = array("iduser", "nombre", "idtusr", "idarea", "idinmu", "usa_sprv", "usa_admon", "usa_man", "usa_tiendas", "usa_soporte", "usa_sol", "usa_usuarios", "usa_conf", "usa_cursos", "usa_pedidos", "usa_traslados", "usa_asistencia");
		$num_cols = count($cols_arr);
		$join_tables = '0';
		$tables_arr = array("gnrl_usrs");
		$num_tables = count($tables_arr);
		$where_clause = "username = '$inputUser' AND pswd = MD5('$inputPass')";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit); 

//		$query = "SELECT iduser, nombre, idtusr, idarea, usa_sprv, usa_man, usa_sol, usa_conf FROM gnrl_usrs WHERE username = '$inputUser' AND pswd = MD5('$inputPass')";
//		$result = mysql_query($query, $connection) or die ("Error in query: $query. " . mysql_error());
	
	
		if (mysql_num_rows($result) == 1) {
			$row=mysql_fetch_row($result);
	
			// if row exists
			// user/pass combination is correct
			// start a session
			session_start();
			
			
			
			$_SESSION['authorizedUser'] = 1;
		    $_SESSION['iduser']         = $row[0];
	    	$_SESSION['username']       = $inputUser;
			$_SESSION['compltusrname']  = $row[1];
			$_SESSION['idtipousr']      = $row[2];
			$_SESSION['idusrarea']      = $row[3];
			$_SESSION['userinmuid']     = $row[4];
            $_SESSION['hostname']       = "http://".$_SERVER['HTTP_HOST']."/sistemaprobell/";
			$_SESSION['abshostname'] 	= "http://".$_SERVER['HTTP_HOST']."/";
			switch ($row[3]) {
				case "1":
					$_SESSION['init'] = "sistemas_resumen";
					$_SESSION['file_path'] = "sistemas";
					$_SESSION['in_frame'] = '0';
	    			$_SESSION['itnum'] = "active_SIS_1";
					$_SESSION['subitnum'] = "active_SIS_1";
					break;
				case "2":
					$_SESSION['init'] = "supervision_resumen";
					$_SESSION['file_path'] = "supervision";
					$_SESSION['in_frame'] = '0';
	    			$_SESSION['itnum'] = "active_SUP_1";
					$_SESSION['subitnum'] = "active_SUP_1";
					break;
				case "4":
					$_SESSION['init'] = "almacen_resumen";
					$_SESSION['file_path'] = "almacen";
					$_SESSION['in_frame'] = '0';
	    			$_SESSION['itnum'] = "active_ALM_1";
					$_SESSION['subitnum'] = "active_ALM_1";
					break;
				case "5":
				    $_SESSION['init'] = "sucursales_resumen";
					$_SESSION['file_path'] = "sucursales";
					$_SESSION['in_frame'] = '0';
		    		$_SESSION['itnum'] = "active_TIE_1";
				    $_SESSION['subitnum'] = "active_TIE_1";
					break;
				case "6":
				    $_SESSION['init'] = "administracion_resumen";
					$_SESSION['file_path'] = "administracion";
					$_SESSION['in_frame'] = '0';
		    		$_SESSION['itnum'] = "active_ADM_1";
				    $_SESSION['subitnum'] = "active_ADM_1";
					break;
			} // Cierrde switch		

			// Permisos del usuario
			$_SESSION['permisos'] = array("usa_sprv" => "$row[5]", "usa_admon" => "row[6]", "usa_man" => "$row[7]", "usa_tiendas" => "$row[8]", "usa_soporte" => "$row[9]", "usa_sol" => "$row[10]", "usa_usuarios" => "$row[11]", "usa_conf" => "$row[12]", "usa_cursos" => "$row[13]", "usa_pedidos" => "$row[14]", "usa_traslados" => "$row[15]", "usa_asistencia" => "$row[16]");
			// redirect browser to protected resource
			header('Location: inicio.php');
			exit;
		} else {
			// if row does not exist	
			// user/pass combination is wrong
			// redirect browser to error page
			die("$err_mess Tu contraseña o nombre de usuario<br />es incorrecto<br /> $cierre_err_mess");

		} // Cierre de Else
	} // Cierre de if admin 

?>

</body>
</html>
