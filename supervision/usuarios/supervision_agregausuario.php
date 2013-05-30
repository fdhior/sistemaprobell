<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />

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
</head>

<?php

    session_start();

	$rutafunciones = $_SESSION['rutafunciones'];

	include $rutafunciones.'consultas.php';
	include $rutafunciones.'valida_correo.php';

    $hostname   = $_SESSION['hostname'];
		
    /*echo '<span class="tipoletra">Valores de $_POST</span><br />';
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print '<span class=="tipoletra">Nombre de la Variable: <strong>'.$nombre.'</strong> Valor: <strong>'.$valor.'</strong></span><br />';
                }
    }*/ 

     // Convertir vaariables POST en locales
     foreach ($_POST as $nombre => $valor) {
	     if(stristr($nombre, 'button') === FALSE) {
    	     ${$nombre} = $valor;
         }
	 }// Cierre foreach     


/* ---------------------------------------- INICIA VALIDACION DE DATOS ---------------------------- */

		// checa si se ingreso una contraseña 
	if (!isset($_POST['pass1']) || trim($_POST['pass1']) == "") {
		$error    = "Teclea una contreña para el usuario";
		$error_id = 1;
	} else {
		if (!isset($_POST['pass2']) || trim($_POST['pass2']) == "") {
			$error = "Debes confirmar la contraseña";
			$error_id = 2;
		} else {
			if ($pass1 <> $pass2) {
				$error = "La contraseña y su confirmaci&oacute;n no coinciden";
				$error_id = 3;
			} else {
				/*if (!isset($_POST['idt']) || trim($_POST['idt']) == "") {
					$error = "Ingresa un ID para el usuario";
					$error_id = 4;
				} else {*/
					/*if (!is_numeric($idt)) {
						$error = "El dato necesita ser un n&uacute;mero";
						$error_id = "5"; 
					} else {*/	
						// Comprobar nombre de usuario contra la base de usuarios
//						echo "entro aqui: nombre error_id";
						/*$cols_arr = array("idinmu");
			       		$num_cols = count($cols_arr);
				        $tables_arr = array("gnrl_usrs");
        				$num_tables = count($tables_arr);

		   				$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	       				while($row=mysql_fetch_row($result)) {
 							if ($row[0] == $idt) {
								$evenid = "1";
			    	   		} // Cierre de if
						}   // cierre de While
		       			if ($evenid == "1") {
    		   		   		$error = "El ID ya esta asignado a otro Usuario";
	       				    $error_id = 6;
						} else {*/
							/*if (!isset($_POST['nombre_usuario']) || trim($_POST['nombre_usuario']) == "") {
								$error = "Ingresa un nombre para este usuario";
								$error_id = 7;
//								echo "entro aqui: nombre invalido";
							} else {*/
								// Comprobar nombre de usuario contra la base de usuarios
								/*$cols_arr     = array("nombre");
					       		$num_cols     = count($cols_arr);
						        $tables_arr   = array("gnrl_usrs");
    		    				$num_tables   = count($tables_arr);
								$where_clause = "gnrl_usrs.idtusr = 3 AND gnrl_usrs.idarea = 5";

				   				$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	    						
								$tempstr_b = $nombre_usuario;
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
	       						    $error_id = 7;
									$nombre_usuario = strtolower($nombre_usuario);
									$nombre_usuario = ucwords($nombre_usuario);
								} else {*/
									
									if ($correoe || trim($correoe) <> "") {
 										if (comprobar_email($correoe) == "0") { 
	    		   				   			$error = "Hay un error en la escritura de esta direcci&oacute;n de correo";
		       						    	$error_id = 8;
										}
									}	
//								}	
//							}	
//						}	
					} // Cierre de else
				} // Cierre de else	
			}
//		}			
//	}				



	$cols_arr = array("idinmu");
	$num_cols = count($cols_arr);
	$tables_arr = array("inmu_gdat");
    $num_tables = count($tables_arr);
	$where_clause = "nombreinmu = '$sel_tienda'";
	
	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	unset($where_clause);

	$idt=mysql_fetch_row($result);

	
	if (isset($error)) {
		$_SESSION['errorpass']      = $error;
		$_SESSION['error_id']       = $error_id;
//		$_SESSION['idt']            = $idt;
//		$_SESSION['nombre_usuario'] = $nombre_usuario;
		$_SESSION['correoe']        = $correoe;
		$_SESSION['nuevo_nombre']	= $nuevo_nombre;     
		$_SESSION['invalid_check']	= "1";
		if ($error_id > 3) {
			$_SESSION['pass1'] = $pass1;
			$_SESSION['pass2'] = $pass2;
		}	

		header("Location: supervision_agregarusuarios.php");
		exit();
	}	

/* ---------------------------------------- TERMINA VALIDACION DE DATOS ---------------------------- */


/* ---------------------------------------- INSERTAR DATOS EN LA BASE ---------------------------- */





	$nombre_usuario = strtolower($nombre_usuario);
	$nombre_usuario = ucwords($nombre_usuario);
	$pass1 = MD5($pass1);

	$colsarr = array("iduser",             // 0
				     "username",           // 1 
					 "pswd",               // 2
					 "idtusr",             // 3 
					 "idarea",             // 4
					 "idinmu",             // 5
					 "nombre",             // 6 
					 "correoe",            // 7
					 "usa_tiendas",        // 8
					 "usa_tie_1",           // 9
					 "usa_pedidos",        // 10
					 "usa_ped_1",          // 11      
					 "usa_ped_2",          // 12
					 "usa_traslados",      // 13
					 "usa_tras_1", 	       // 14
					 "usa_tras_2",         // 15  
					 "idusrstatus",        // 16 
					 "textpass");          // 17
	$numcols = count($colsarr);
	$valarr = array("NULL",                    // 0
	                "'$nuevo_nombre'",         // 1
					"'$pass1'",                // 2
					"3",                       // 3
					"5",                       // 4
					"'$idt[0]'",               // 5   
					"'Gerente $sel_tienda'",   // 6
					"'$coreoe'",               // 7    
					"1",                       // 8
					"1",                       // 9 
					"1",                       // 10
					"1",                       // 11
					"1",                       // 12
					"1",                       // 13
					"1",                       // 14
					"1",                       // 15
					"1",                       // 16 
					"'$pass2'");               // 17   
	$aff_table = "gnrl_usrs";

	$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

	
	
	// Recuperar id de ubicacion
   	$cols_arr      = array("MAX(iduser)");
    $num_cols      = count($cols_arr);
    $tables_arr    = array("gnrl_usrs");

    $qryIdUser = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

    $rowIdUser=mysql_fetch_row($qryIdUser);

	$aff_table = "inmu_gdat";
    $colsvalarr = array("iduser = '$rowIdUser[0]'");
    $numcols = count($colsvalarr);
    $where_clause = "idinmu = '$idt[0]'";

    $result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 


?>

<body>
<br />
<h2>Agregar Usuarios al sistema de Traslados y Pedidos</h2>
<p class="letra_predeterminadamargen">El usuario <strong><?php echo $nuevo_nombre; ?></strong>, fu&eacute; agregado a la lista de usuarios <br />
Su contraseña es: <strong><?php echo "$pass2";  ?></strong><br />
La Tienda a la que ha sido asignado es: <strong><?php echo $sel_tienda  ?></strong><br /><br />
A partir de este momento la cuenta de este usuario<br />
est&aacute; habilitada para enviar Pedidos y recibir Traslados<br /><br /></p>
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post" name="form1" target="_self" id="form1">
      <td></label>
        <label>
          <input type="submit" name="button" id="button" value="Continuar" />
          </label></td></form>
  </tr>
</table>
</body>
</html>
