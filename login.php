<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<title>SISTEMA EN LINEA DE TRABAJO EN GRUPO PROBELL</title>
        <link rel="stylesheet" type="text/css" href="css/sistemaprobell.css" />
<?php
	session_start();

	$rutafunciones = $_SERVER['DOCUMENT_ROOT'].'/sistemaprobell/funciones/';
	include $rutafunciones.'consultas.php';

        // Mostrar los valores de _POST
/*      echo "Valores de _POST <br />";
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />"; 
                }
        } */

	if (isset($_POST['entrada'])) {

		$entrada = $_POST['entrada'];

		include $rutafunciones.'conectarainventario.php';

		$inputUser = mysql_real_escape_string($_POST['username']);
		$inputPass = mysql_real_escape_string($_POST['password']);

		include $rutafunciones.'cerrar_conexion.php';

	}       
        

?>
</head>

<body>

<?php 

	// Si no sea enviado informacion se muestran las entradas       
	if (!$_POST['submit']) {

?>



<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center"><img src="images/probell logo-final.jpg" width="224" height="117" /></p>
<p class="loginhead" align="center">Sistema En L&iacute;nea de Trabajo En Grupo Probell</p>
<p class="logintext" align="center">Ingreso a Usuarios<br>
  Ingresa Tu Usuario y Contrase&ntilde;a</p>
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
  <input name="submit" type="submit" class="logintext" value="Entrar"></td>
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
//              $connection = mysql_connect("localhost", "root", "probell") or die ("No se puede conectar!");
//              mysql_select_db("egprobell");
                // assign to variables and escape

                
                // Consulta Nombre e ID de Tiendas
                $cols_arr = array("iduser",                		// 0
				                  "nombre",               		// 1 
								  "idtusr",            		    // 2 
								  "idarea",             	    // 3
								  "idinmu",                		// 4 
								  "usa_almacen", 				// 5
								  "usa_alm_1", 					// 6
 								  "usa_sprv",              	    // 7
								  "usa_sprv_1",					// 8
						          "usa_admon",					// 9
								  "usa_adm_1",					// 10
								  "usa_sistemas",				// 11
								  "usa_sis_1",					// 12
								  "usa_tiendas",				// 13
								  "usa_tie_1",					// 14
								  "usa_tie_2",					// 15
								  "usa_tie_3",					// 16
								  "usa_tie_4",					// 17
								  "usa_tie_5",					// 18
								  "usa_conta",					// 19
								  "usa_conta_1",				// 20
								  "usa_usuarios",				// 21
								  "usa_usu_1",					// 22
								  "usa_usu_2",					// 23
								  "usa_cursos",					// 24
								  "usa_cur_1",					// 25
								  "usa_cur_2",					// 26
								  "usa_cur_3",					// 27
								  "usa_cur_4",					// 28
								  "usa_cur_5",					// 29
								  "usa_pedidos",				// 30
								  "usa_ped_1",					// 31	
								  "usa_ped_2",					// 32
								  "usa_ped_3",					// 33
								  "usa_ped_4",					// 34
								  "usa_ped_5", 					// 35
								  "usa_ped_6",					// 36
								  "usa_traslados",				// 37
								  "usa_tras_1",					// 38
								  "usa_tras_2",					// 39
								  "usa_tras_3",					// 40
								  "usa_tras_4",					// 41
								  "usa_tras_5",					// 42
								  "usa_tras_6",					// 43
								  "usa_asistencia", 			// 44
								  "usa_asis_1",					// 45
								  "usa_asis_2",					// 46
								  "usa_asis_3",					// 47
								  "usa_asis_4",					// 48
								  "usa_asis_5",					// 49
								  "usa_mantenimiento",			// 50
								  "usa_soporte",				// 51
								  "usa_configuracion");      	// 52
                $num_cols = count($cols_arr);
                $join_tables = '0';
                $tables_arr = array("gnrl_usrs");
                $num_tables = count($tables_arr);
                $where_clause = "username = '$inputUser' AND pswd = MD5('$inputPass')";

                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit); 

//              $query = "SELECT iduser, nombre, idtusr, idarea, usa_sprv, usa_man, usa_sol, usa_conf FROM gnrl_usrs WHERE username = '$inputUser' AND pswd = MD5('$inputPass')";
//              $result = mysql_query($query, $connection) or die ("Error in query: $query. " . mysql_error());
        
        
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
                        $_SESSION['abshostname']        = "http://".$_SERVER['HTTP_HOST']."/";
                        $_SESSION['rutafunciones']  = $_SERVER['DOCUMENT_ROOT'].'/sistemaprobell/funciones/';

                        switch ($row[3]) {
                                case "1":
                                        $_SESSION['init'] = "sistemas_resumen";
                                        $_SESSION['file_path'] = "sistemas";
                                        $_SESSION['in_frame'] = '0';
                                		$_SESSION['itnum'] = "active_SIS";
                                        $_SESSION['subitnum'] = "active_SIS_1";
                                        break;
                                case "2":
                                        $_SESSION['init'] = "supervision_resumen";
                                        $_SESSION['file_path'] = "supervision";
                                        $_SESSION['in_frame'] = '1';
                                		$_SESSION['itnum'] = "active_SUP";
                                        $_SESSION['subitnum'] = "active_SUP_1";
                                        break;
                                case "4":
                                        $_SESSION['init'] = "almacen_resumen";
                                        $_SESSION['file_path'] = "almacen";
                                        $_SESSION['in_frame'] = '1';
                                		$_SESSION['itnum'] = "active_ALM";
                                        $_SESSION['subitnum'] = "active_ALM_1";
                                        break;
                                case "5":
                                    	$_SESSION['init'] = "sucursales_resumen";
	                                    $_SESSION['file_path'] = "sucursales";
    	                                $_SESSION['in_frame'] = '1';
        	                        	$_SESSION['itnum'] = "active_TIE";
            	                        $_SESSION['subitnum'] = "active_TIE_1";
                                        break;
                                case "6":
                                    	$_SESSION['init'] = "administracion_resumen";
                                        $_SESSION['file_path'] = "administracion";
                                        $_SESSION['in_frame'] = '1';
                                		$_SESSION['itnum'] = "active_ADM";
                                    	$_SESSION['subitnum'] = "active_ADM_1";
                                        break;
                        } // Cierrde switch             

                        // Permisos del usuario
                        $_SESSION['permisos'] = array("usa_almacen" 		=> "$row[5]", 
													  "usa_alm_1" 			=> "$row[6]",
													  "usa_sprv" 			=> "$row[7]", 
													  "usa_sprv_1" 			=> "$row[8]", 	
						                              "usa_admon" 			=> "$row[9]", 
													  "usa_adm_1" 			=> "$row[10]",
													  "usa_sistemas" 		=> "$row[11]",
													  "usa_sis_1" 			=> "$row[12]", 
													  "usa_tiendas" 		=> "$row[13]", 
													  "usa_tie_1" 			=> "$row[14]",
													  "usa_tie_2" 			=> "$row[15]",
													  "usa_tie_3" 			=> "$row[16]",
													  "usa_tie_4" 			=> "$row[17]",
													  "usa_tie_5" 			=> "$row[18]",
													  "usa_conta" 			=> "$row[19]", 
													  "usa_conta_1" 		=> "$row[20]", 
													  "usa_usuarios" 		=> "$row[21]", 
													  "usa_usu_1" 			=> "$row[22]",
													  "usa_usu_2"		 	=> "$row[23]",
													  "usa_cursos" 			=> "$row[24]", 
													  "usa_cur_1" 			=> "$row[25]",
													  "usa_cur_2" 			=> "$row[26]",
													  "usa_cur_3" 			=> "$row[27]",
													  "usa_cur_4" 			=> "$row[28]",
													  "usa_cur_5" 			=> "$row[29]",
													  "usa_pedidos" 		=> "$row[30]",
													  "usa_ped_1" 			=> "$row[31]",
													  "usa_ped_2" 			=> "$row[32]",
													  "usa_ped_3" 			=> "$row[33]",
													  "usa_ped_4" 			=> "$row[34]",
													  "usa_ped_5" 			=> "$row[35]",
													  "usa_ped_6" 			=> "$row[36]",
													  "usa_traslados" 		=> "$row[37]", 
													  "usa_tras_1" 			=> "$row[38]",
													  "usa_tras_2" 			=> "$row[39]",
													  "usa_tras_3" 			=> "$row[40]",
													  "usa_tras_4" 			=> "$row[41]",
													  "usa_tras_5" 			=> "$row[42]",
													  "usa_tras_6" 			=> "$row[43]",
													  "usa_asistencia" 		=> "$row[44]", 
													  "usa_asis_1" 			=> "$row[45]",
													  "usa_asis_2" 			=> "$row[46]",					
													  "usa_asis_3" 			=> "$row[47]",
													  "usa_asis_4" 			=> "$row[48]",					
													  "usa_asis_5" 			=> "$row[49]",
													  "usa_mantenimiento" 	=> "$row[50]",
													  "usa_soporte" 		=> "$row[51]",
													  "usa_configuracion"	=> "$row[52]");
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
