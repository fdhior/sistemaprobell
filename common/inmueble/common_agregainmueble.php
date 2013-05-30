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
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php
    session_start();

	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';
//	include "valida_correo.php";

    $hostname   = $_SESSION['hostname'];
		
	/*echo "<span class=\"tipoletra\">Valores de _GET</span><br />";
	foreach ($_GET as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
		}
	}   

 	echo "<span class=\"tipoletra\">Valores de _POST</span><br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
		}
	}   

 	echo "<span class=\"tipoletra\">Valores de _SESSION</span><br />";
	foreach ($_SESSION as $nombre => $valor) {
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
	
	/* --------------------------------------- INICIA VALIDACION DE DATOS ---------------------------- */
	switch($verifica) {
		case "1":
			if (!isset($_POST['idt']) || trim($_POST['idt']) == "") {
				$error = "Ingresa un ID para el usuario";
				$error_id = 1;
			} else {
				if (!is_numeric($idt)) {
					$error = "El dato necesita ser un n&uacute;mero";
					$error_id = "2"; 
				} else {	
					// Comprobar nombre de usuario contra la base de usuarios
//					echo "entro aqui: nombre error_id";
					$cols_arr = array("idinmu");
					$num_cols = count($cols_arr);
					$tables_arr = array("inmu_gdat");
		       	 	$num_tables = count($tables_arr);
	
				   	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	   	    		while($row=mysql_fetch_row($result)) {
 						if ($row[0] == $idt) {
							$evenid = "1";
						} // Cierre de if
					}   // cierre de While
		    
					if ($evenid == "1") {
    					$error = "El ID ya esta asignado a otra tienda";
	       	    		$error_id = 3;
					} else {

						if (!isset($check_no_enc)) {
							if (!isset($_POST['encargado']) || trim($_POST['encargado']) == "") {
								$error = "Ingresa un nombre para el encargado";
								$error_id = 4;
//								echo "entro aqui: nombre invalido";
							} else {
						
								// Comprobar nombre de usuario contra la base de usuarios
								$cols_arr      = array("inmu_gdat.idenc", "gnrl_enca.nombre");
								$num_cols      = count($cols_arr);
								$join_tables   = 1;
								$tables_arr    = array("inmu_gdat", "gnrl_enca");
								$on_fields_arr = array("idenc");
    		    				$num_tables    = count($tables_arr);
								$where_clause  = "gnrl_enca.nombre = '$encargado'";

					   			$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

								$encargado = strtolower($encargado);
								$encargado = ucwords($encargado);
								$tempstr_b = $encargado;
								$tempstr_b = strtolower($tempstr_b);
				   	
								$row=mysql_fetch_row($result);
								$tempstr_a = $row[1];	
								$tempstr_a = strtolower($tempstr_a);
								if ($tempstr_a == $tempstr_b) {
									$evennm = "1";
	   	   						} // Cierre de if
		
				  				if ($evennm == "1") {
   			 			   			$error = "Este encargado ya esta asignado a otro inmueble/tienda";
	   			 			    	$error_id = 5;
									$encargado = strtolower($encargado);
									$encargado = ucwords($encargado);
								} // Cierre de if
							} // Cierre de else	
						} // Cierre de if	
						if ($sel_rsc == "Selecciona una Razon Social") { 
		   					$error = "Selecciona una Razón Social para el inmueble/tienda";
				   		 	$error_id = 6;
						}	
					}	
				} // Cierre de else
			} // Cierre de else	

			if (isset($error)) {
		
				$_SESSION['errorpass']    = $error;
				$_SESSION['error_id']     = $error_id;
				$_SESSION['idt']          = $idt;
				$_SESSION['sel_inmu']     = $sel_inmu;
				$_SESSION['encargado']    = $encargado;
    	   	 	$_SESSION['sel_rsc']      = $sel_rsc;
    			$_SESSION['nueva_tienda'] = $nueva_tienda;
				$_SESSION['check_no_enc'] = $check_no_enc;
				if (isset($sel_ttienda)) {
    				$_SESSION['sel_ttienda'] = $sel_ttienda;
				}
				$_SESSION['invalid_check']	= "1";

				header("Location: ".$_SERVER['HTTP_REFERER']."");
				exit();
			} else {	
	
		 		header("Location: ".$_SERVER['HTTP_REFERER']."?agr_tienda=2&idt=$idt&sel_inmu=$sel_inmu&encargado=$encargado&sel_rsc=$sel_rsc&nueva_tienda=$nueva_tienda&sel_ttienda=$sel_ttienda&check_no_enc=$check_no_enc");
				exit();
			}
			break;
		case "2":
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
/*							if (trim($_POST['nofax']) <> "" and !is_numeric($nofax)) {	
								$error = "El dato necesita ser un n&uacute;mero";
								$error_id = "4";
							} else {*/
							if ($_POST['sel_zona'] == "Selecciona una zona") {
								$error = "Debes selccionar una zona para el Inmueble o Tienda";
								$error_id = 4;
//								}
							}	 
						}	
					}
				}		
			} 	
			if (isset($error)) {
		
				$_SESSION['errorpass']      = $error;
				$_SESSION['error_id']       = $error_id;
    			$_SESSION['direccion']      = $direccion;
    			$_SESSION['notel1']         = $notel1;
    			$_SESSION['notel2']         = $notel2;
    			$_SESSION['nocel']          = $nocel;
				$_SESSION['nofax']          = $nofax;
    			$_SESSION['sel_zona']       = $sel_zona;				
				$_SESSION['invalid_check2'] = "2";

				header("Location: ".$_SERVER['HTTP_REFERER']."");
				exit();
			} 	

			break;
	}		

	
		
/* ---------------------------------------- TERMINA VALIDACION DE DATOS ---------------------------- */




/* ---------------------------------------- INSERTAR DATOS EN LA BASE ---------------------------- */

	// Convertir tipos
	switch ($sel_ttienda) {
		case "Probell":
			if ($sel_zona == "FORANEA") {
				$sel_ttinsert = "3";
			} else {
				$sel_ttinsert = "1";
			}
			break;	
		case "Nail Mart";
			if ($sel_zona == "FORANEA") {
				$sel_ttinsert = "4";
			} else {
				$sel_ttinsert = "2";
			}
			break;	
		case "Pronail":
			if ($sel_zona == "FORANEA") {
				$sel_ttinsert = "8";
			} else {
				$sel_ttinsert = "7";
			}
			break;	
	}	

	if ($check_no_enc <> "1") {
	
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
		
	}
	
	// Normalizar Datos
	$nueva_tienda = ucwords($nueva_tienda);
	$nombret_insert = $sel_ttienda." ".$nueva_tienda;
	if ($check_no_enc == "1") {
		$idenc_insert = 0;
	} else {
		$idenc_insert = $row0[0];
	}

	$cols_arr   = array("idfis");
	$num_cols   = count($cols_arr);
	$tables_arr = array("inmu_dfis");
	$where_clause  = "inmu_dfis.razonsc = '$sel_rsc'";

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	$row1=mysql_fetch_row($result);
	
	$rsc_insert = $row1[0];		
	

	$cols_arr   = array("idzona");
	$num_cols   = count($cols_arr);
	$tables_arr = array("inmu_zona");
	$where_clause  = "inmu_zona.zona = '$sel_zona'";

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	unset($where_clause); 

	$row2=mysql_fetch_row($result);
	
	$zona_insert = $row2[0];		
	
//	$nombre_usuario = strtolower($nombre_usuario);
//	$nombre_usuario = ucwords($nombre_usuario);
//	$pass1 = MD5($pass1);
	

	$colsarr = array("inmucount", "idinmu", "idinmutipo", "nombreinmu", "idenc", "idfis", "direccion");
	if ($notel1 <> "") {
		$colsarr[] = "notel1";
	}
	if ($notel2 <> "") {
		$colsarr[] = "notel2";
	}
	if ($nocel <> "") {
		$colsarr[] = "nocel";
	}
	if ($nofax <> "") {
		$colsarr[] = "nofax";
	}
	array_push($colsarr, "idzona", "numequipos", "inv_supervisado", "iduser", "idinmustat");
	$numcols = count($colsarr);
	
	$valarr = array("NULL", "'$idt'", "'$sel_ttinsert'", "'$nombret_insert'", "'$idenc_insert'", "'$rsc_insert'", "'$direccion'");
	if(in_array("notel1", $colsarr)) {
		$valarr[] = "'$notel1'";
	}
	if(in_array("notel2", $colsarr)) {
		$valarr[] = "'$notel2'";
	}
	if(in_array("nocel", $colsarr)) {
		$valarr[] = "'$nocel'";
	}
	if(in_array("nofax", $colsarr)) {
		$valarr[] = "'$nofax'";
	}
	array_push($valarr, "'$zona_insert'", "'0'", "'0'", "'76'", "1");
	$aff_table = "inmu_gdat";

	$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 
	
	unset($colsarr);
	unset($valarr);
	
	$colsarr = array("idubica",
	                 "idinmu", 
					 "googlelink");
	$valarr  = array("NULL",
	                 "'$idt'",
					 "'Por Registrar'");
	$numcols = count($colsarr);					 
	$aff_table = "inmu_gubc";

	$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 
	
	// Recuperar id de ubicacion
   	$cols_arr      = array("MAX(idubica)");
    $num_cols      = count($cols_arr);
    $tables_arr    = array("inmu_gubc");

    $qryIdUbica = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

    $rowIdUbica=mysql_fetch_row($qryIdUbica);
	
	$aff_table = "inmu_gdat";
    $colsvalarr = array("idubica = '$rowIdUbica[0]'");
    $numcols = count($colsvalarr);
    $where_clause = "idinmu = '$idt'";

    $result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 
	
?>

<body>
<br />
<h2>Agregar Tiendas al sistema de Administracion de Tiendas</h2>
<span class="letraaduser">La tienda <strong><?php echo "$sel_ttienda $nueva_tienda"; ?></strong>, fu&eacute; agregada a la lista de tiendas </span><br />
<br />
<span class="letraaduser">A partir de este momento la  se le puede asociar un usuario</span><br />
<span class="letraaduser">para enviar  Pedidos y recibir Traslados y ser supervisada</span><br />
<br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="common_inmueble.php" method="post" name="form1" target="_self" id="form1">
      <td></label>
        <label>
          <input type="submit" name="button" id="button" value="Continuar" />
          </label></td></form>
  </tr>
</table>
</body>
</html>
