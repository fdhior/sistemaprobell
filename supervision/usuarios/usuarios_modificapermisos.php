<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Datos Generales de un Empleado</title>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.select3 {	width: 75px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: small-caps;
}

.input1 {	width: 90px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: normal;
}

#divMensaje {
	position: absolute;
	left: 35px;
	top: 27px;
	width: 308px;
	height: 69px;
}

#divBotones {
	position:absolute;
	left:34px;
	top:109px;
	width:314px;
	height:67px;
	z-index:1;
}
</style>

<?php

	session_start();
	
	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';

	$hostname     = $_SESSION['hostname'];
	$relpath      = 'supervision/usuarios/';
	
	$target_link  = $hostname.$relpath.'usuarios_editapermisos.php';
	 	
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
    		${$nombre} = $valor;
		}
	}// Cierre foreach     

?>

<script language="javascript">

	function editaPermisos()
	{
		document.forms[0].submit(); 
//		document.forms[0].submit();
	}

	function cierraVentana()
	{
		window.close();		
	}

</script>

<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
</head>

<body>

<form id="formaEnvio" name="formaEnvio" method="get" action="<?php echo $target_link; ?>" target="_self">
    <input name="iduser" type="hidden" id="iduser" value="<?php echo $iduser; ?>" />
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->

<?php

    // Mostrar los valores de _POST
	/*echo "Valores de _POST <br />";
    foreach ($_POST as $nombre => $valor) {
    	if(stristr($nombre, 'button') === FALSE) {
        	print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />"; 
    	}
	}*/

?>


<?php

		$cols_arr      = array("gnrl_usrs.username",                  // 1
							   "inmu_gdat.nombreinmu");                 // 2    
		$num_cols      = count($cols_arr);
	   	$join_tables   = '1';
	    $tables_arr    = array("gnrl_usrs",
							   "inmu_gdat");
	    $num_tables    = count($tables_arr);
		$on_fields_arr = array("idinmu");
		$connect       = '1';
//		$order         = "idempleado, nombreinmu";

		$where_clause = "gnrl_usrs.iduser = '$iduser'";

  		$userInfo_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
		unset($join_tables);
		unset($on_fields_arr);
		unset($connect);
		unset($where_clause);

		$col=mysql_fetch_row($userInfo_rset);
	
		// Actualizar Permisos
		$aff_table = "gnrl_usrs";

		// Modulo TIENDAS	
		if (isset($usa_tiendas)) { 
			$colsvalarr[] = "usa_tiendas = '$usa_tiendas'";
	
			if (isset($usa_tie_1)) {
				$colsvalarr[] = "usa_tie_1 = '$usa_tie_1'";
			} else {
				$colsvalarr[] = "usa_tie_1 = '0'";
			}

			/*if (isset($usa_tie_2)) {
				$colsvalarr[] = "usa_tie_2 = '$usa_tie_2'";
			} else {
				$colsvalarr[] = "usa_tie_2 = '0'";
			}*/
		} else {
			$colsvalarr[] = "usa_tiendas = '0'";
		}
		
		// MODULO ASISTENCIA
		if (isset($usa_asistencia)) { 
			$colsvalarr[] = "usa_asistencia = '$usa_asistencia'";
	
			if (isset($usa_asis_1)) {
				$colsvalarr[] = "usa_asis_1 = '$usa_asis_1'";
			} else {
				$colsvalarr[] = "usa_asis_1 = '0'";
			}

			if (isset($usa_asis_4)) {
				$colsvalarr[] = "usa_asis_4 = '$usa_asis_4'";
			} else {
				$colsvalarr[] = "usa_asis_4 = '0'";
			}
		} else {
			$colsvalarr[] = "usa_asistencia = '0'";
		}

		// MODULO PEDIDOS
		if (isset($usa_pedidos)) { 
			$colsvalarr[] = "usa_pedidos = '$usa_pedidos'";
	
			if (isset($usa_ped_1)) {
				$colsvalarr[] = "usa_ped_1 = '$usa_ped_1'";
			} else {
				$colsvalarr[] = "usa_ped_1 = '0'";
			}

			if (isset($usa_ped_2)) {
				$colsvalarr[] = "usa_ped_2 = '$usa_ped_2'";
			} else {
				$colsvalarr[] = "usa_ped_2 = '0'";
			}
		} else {
			$colsvalarr[] = "usa_pedidos = '0'";
		}

		// MODULO TRASLADOS
		if (isset($usa_traslados)) { 
			$colsvalarr[] = "usa_traslados = '$usa_traslados'";
	
			if (isset($usa_tras_1)) {
				$colsvalarr[] = "usa_tras_1 = '$usa_tras_1'";
			} else {
				$colsvalarr[] = "usa_tras_1 = '0'";
			}

			if (isset($usa_tras_2)) {
				$colsvalarr[] = "usa_tras_2 = '$usa_tras_2'";
			} else {
				$colsvalarr[] = "usa_tras_2 = '0'";
			}
		} else {
			$colsvalarr[] = "usa_traslados = '0'";
		}


		$numcols = count($colsvalarr);
		$where_clause = "iduser = '$iduser'";

		// print_r($colsvalarr);
		
		
		$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause);



?>
<br />
<h2>Permisos Modificados de usuario: <strong><?php echo $col[0]; ?></strong> de la tienda <strong><?php echo $col[1]; ?></strong> <br />
</h2>

<div id="divMensaje">
<p class="letra_predeterminada12">Los permisos para este usuario fueron modificados, <br />
                                es necesario reiniciar la sesión de para que el acceso <br />
								a los modulos se actualizado</p>

</div>

<div id="divBotones">
	<!--<input name="enviaDatos" type="submit" value="Actualiza Permisos"  />-->
    <button onclick="javascript: editaPermisos()">Volver a Editar Permisos</button>
    <button onclick="javascript: cierraVentana()">Cerrar</button>
</div>

</body>
</html>