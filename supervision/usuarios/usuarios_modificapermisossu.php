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
	
	$target_link  = $hostname.$relpath.'usuarios_editapermisossu.php';
	 	
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

<?php 

    /* echo '<span class="tipoletra">Valores de $_POST</span><br />';
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print '<span class=="tipoletra">Nombre de la Variable: <strong>'.$nombre.'</strong> Valor: <strong>'.$valor.'</strong></span><br />';
                }
    } */

?>

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

		$cols_arr      = array("gnrl_usrs.username");                 // 2    
		$num_cols      = count($cols_arr);
//	   	$join_tables   = '1';
	    $tables_arr    = array("gnrl_usrs");
//							   "inmu_gdat");
	    $num_tables    = count($tables_arr);
//		$on_fields_arr = array("idinmu");
//		$connect       = '1';
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

		// Modulo ADMINISTRACION	
		if ($usa_admon == 1) { 
			$colsvalarr[] = "usa_admon = '$usa_admon'";
	
			if ($usa_adm_1 == 1) {
				$colsvalarr[] = "usa_adm_1 = '$usa_adm_1'";
			} else {
				$colsvalarr[] = "usa_adm_1 = 0";
			} 

		} else {
			$colsvalarr[] = "usa_admon = 0";
		} 

		// Modulo ALMACEN	
		if ($usa_almacen == 1) { 
			$colsvalarr[] = "usa_almacen = '$usa_almacen'";
	
			if ($usa_alm_1 == 1) {
				$colsvalarr[] = "usa_alm_1 = '$usa_alm_1'";
			}  else {
				$colsvalarr[] = "usa_alm_1 = 0";
			} 

		} else {
			$colsvalarr[] = "usa_almacen = '0'";
		} 

		// Modulo CONTABILIDAD	
		if ($usa_conta == 1) { 
			$colsvalarr[] = "usa_conta = '$usa_conta'";
	
			if ($usa_conta_1 == 1) {
				$colsvalarr[] = "usa_conta_1 = '$usa_conta_1'";
			} else {
				$colsvalarr[] = "usa_conta_1 = 0";
			} 

		} else {
			$colsvalarr[] = "usa_conta = 0";
		} 

		// Modulo SISTEMAS	
		if ($usa_sistemas == 1) { 
			$colsvalarr[] = "usa_sistemas = '$usa_sistemas'";
	
			if ($usa_sis_1 == 1) {
				$colsvalarr[] = "usa_sis_1 = '$usa_sis_1'";
			} else {
				$colsvalarr[] = "usa_sis_1 = 0";
			} 

		} else {
			$colsvalarr[] = "usa_sistemas = 0";
		} 

		// Modulo SUPERVISION
		if ($usa_sprv == 1) { 
			$colsvalarr[] = "usa_sprv = '$usa_sprv'";
	
			if ($usa_sprv_1 == 1) {
				$colsvalarr[] = "usa_sprv_1 = '$usa_sprv_1'";
			} else {
				$colsvalarr[] = "usa_sprv_1 = 0";
			} 

		} else {
			$colsvalarr[] = "usa_sprv = 0";
		}

		// MODULO ASISTENCIA
		if ($usa_asistencia == 1) { 
			$colsvalarr[] = "usa_asistencia = '$usa_asistencia'";
	
			if ($usa_asis_1 == 1) {
				$colsvalarr[] = "usa_asis_1 = '$usa_asis_1'";
			} else {
				$colsvalarr[] = "usa_asis_1 = 0";
			} 

			if ($usa_asis_2 == 1) {
				$colsvalarr[] = "usa_asis_2 = '$usa_asis_2'";
			} else {
				$colsvalarr[] = "usa_asis_2 = 0";
			} 

			if ($usa_asis_3 == 1) {
				$colsvalarr[] = "usa_asis_3 = '$usa_asis_3'";
			} else {
				$colsvalarr[] = "usa_asis_3 = 0";
			} 

			if ($usa_asis_4 == 1) {
				$colsvalarr[] = "usa_asis_4 = '$usa_asis_4'";
			} else {
				$colsvalarr[] = "usa_asis_4 = 0";
			} 

			if ($usa_asis_5 == 1) {
				$colsvalarr[] = "usa_asis_5 = '$usa_asis_5'";
			} else {
				$colsvalarr[] = "usa_asis_5 = 0";
			} 

		} else {
			$colsvalarr[] = "usa_asistencia = 0";
		} 

		// Modulo TIENDAS	
		if ($usa_tiendas == 1) { 
			$colsvalarr[] = "usa_tiendas = '$usa_tiendas'";
	
			if ($usa_tie_1 == 1) {
				$colsvalarr[] = "usa_tie_1 = '$usa_tie_1'";
			} else {
				$colsvalarr[] = "usa_tie_1 = 0";
			} 

			if ($usa_tie_2 == 1) {
				$colsvalarr[] = "usa_tie_2 = '$usa_tie_2'";
			} else {
				$colsvalarr[] = "usa_tie_2 = 0";
			} 

			if ($usa_tie_3 == 1) {
				$colsvalarr[] = "usa_tie_3 = '$usa_tie_3'";
			} else {
				$colsvalarr[] = "usa_tie_3 = 0";
			} 

			if ($usa_tie_4 == 1) {
				$colsvalarr[] = "usa_tie_4 = '$usa_tie_4'";
			} else {
				$colsvalarr[] = "usa_tie_4 = 0";
			} 

			if ($usa_tie_5 == 1) {
				$colsvalarr[] = "usa_tie_5 = '$usa_tie_5'";
			} else {
				$colsvalarr[] = "usa_tie_5 = 0";
			} 

		} else {
			$colsvalarr[] = "usa_tiendas = 0";
		} 
		
		// Modulo CURSOS
		if ($usa_cursos == 1) { 
			$colsvalarr[] = "usa_cursos = '$usa_cursos'";
	
			if ($usa_cur_1 == 1) {
				$colsvalarr[] = "usa_cur_1 = '$usa_cur_1'";
			} else {
				$colsvalarr[] = "usa_cur_1 = 0";
			} 

			if ($usa_cur_2 == 1) {
				$colsvalarr[] = "usa_cur_2 = '$usa_cur_2'";
			} else {
				$colsvalarr[] = "usa_cur_2 = 0";
			} 

			if ($usa_cur_3 == 1) {
				$colsvalarr[] = "usa_cur_3 = '$usa_cur_3'";
			} else {
				$colsvalarr[] = "usa_cur_3 = 0";
			} 

			if ($usa_cur_4 == 1) {
				$colsvalarr[] = "usa_cur_4 = '$usa_cur_4'";
			} else {
				$colsvalarr[] = "usa_cur_4 = 0";
			} 

			if ($usa_cur_5 == 1) {
				$colsvalarr[] = "usa_cur_5 = '$usa_cur_5'";
			} else {
				$colsvalarr[] = "usa_cur_5 = 0";
			} 

		} else {
			$colsvalarr[] = "usa_cursos = '0'";
		} 
		
		// MODULO PEDIDOS
		if ($usa_pedidos == 1) { 
			$colsvalarr[] = "usa_pedidos = '$usa_pedidos'";
	
			if ($usa_ped_1 == 1) {
				$colsvalarr[] = "usa_ped_1 = '$usa_ped_1'";
			} else {
				$colsvalarr[] = "usa_ped_1 = 0";
			} 

			if ($usa_ped_2 == 1) {
				$colsvalarr[] = "usa_ped_2 = '$usa_ped_2'";
			} else {
				$colsvalarr[] = "usa_ped_2 = 0";
			} 

			if ($usa_ped_3 == 1) {
				$colsvalarr[] = "usa_ped_3 = '$usa_ped_3'";
			} else {
				$colsvalarr[] = "usa_ped_3 = 0";
			} 

			if ($usa_ped_4 == 1) {
				$colsvalarr[] = "usa_ped_4 = '$usa_ped_4'";
			} else {
				$colsvalarr[] = "usa_ped_4 = 0";
			} 

			if ($usa_ped_5 == 1) {
				$colsvalarr[] = "usa_ped_5 = '$usa_ped_5'";
			} else {
				$colsvalarr[] = "usa_ped_5 = 0";
			} 

			if ($usa_ped_6 == 1) {
				$colsvalarr[] = "usa_ped_6 = '$usa_ped_6'";
			} else {
				$colsvalarr[] = "usa_ped_6 = 0";
			} 

		} else {
			$colsvalarr[] = "usa_pedidos = 0";
		} 

		// MODULO TRASLADOS
		if ($usa_traslados == 1) { 
			$colsvalarr[] = "usa_traslados = '$usa_traslados'";
	
			if ($usa_tras_1 == 1) {
				$colsvalarr[] = "usa_tras_1 = '$usa_tras_1'";
			} else {
				$colsvalarr[] = "usa_tras_1 = 0";
			} 

			if ($usa_tras_2 == 1) {
				$colsvalarr[] = "usa_tras_2 = '$usa_tras_2'";
			} else {
				$colsvalarr[] = "usa_tras_2 = 0";
			} 

			if ($usa_tras_3 == 1) {
				$colsvalarr[] = "usa_tras_3 = '$usa_tras_3'";
			} else {
				$colsvalarr[] = "usa_tras_3 = 0";
			} 

			if ($usa_tras_4 == 1) {
				$colsvalarr[] = "usa_tras_4 = '$usa_tras_4'";
			} else {
				$colsvalarr[] = "usa_tras_4 = 0";
			} 

			if ($usa_tras_5 == 1) {
				$colsvalarr[] = "usa_tras_5 = '$usa_tras_5'";
			} else {
				$colsvalarr[] = "usa_tras_5 = 0";
			} 

			if ($usa_tras_6 == 1) {
				$colsvalarr[] = "usa_tras_6 = '$usa_tras_6'";
			} else {
				$colsvalarr[] = "usa_tras_6 = 0";
			} 

		} else {
			$colsvalarr[] = "usa_traslados = 0";
		} 

		// MODULO USUARIOS
		if ($usa_usuarios == 1) { 
			$colsvalarr[] = "usa_usuarios = '$usa_usuarios'";
	
			if ($usa_usu_1 == 1) {
				$colsvalarr[] = "usa_usu_1 = '$usa_usu_1'";
			} else {
				$colsvalarr[] = "usa_usu_1 = 0";
			} 

			if ($usa_usu_2 == 1) {
				$colsvalarr[] = "usa_usu_2 = '$usa_usu_2'";
			} else {
				$colsvalarr[] = "usa_usu_2 = 0";
			} 
		} else {
			$colsvalarr[] = "usa_usuarios = 0";
		} 


		$numcols = count($colsvalarr);
		$where_clause = "iduser = '$iduser'";

		// print_r($colsvalarr);
		
		
		$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause);



?>
<br />
<h2>Permisos Modificados de usuario: <strong><?php echo $col[0]; ?></strong><br />
</h2>

<div id="divMensaje">
<p class="letra_predeterminada12">Los permisos para este usuario fueron modificados, <br />
                                es necesario reiniciar la sesión para que el acceso <br />
								a los modulos sea actualizado</p>

</div>

<div id="divBotones">
	<!--<input name="enviaDatos" type="submit" value="Actualiza Permisos"  />-->
    <button onclick="javascript: editaPermisos()">Volver a Editar Permisos</button>
    <button onclick="javascript: cierraVentana()">Cerrar</button>
</div>

</body>
</html>