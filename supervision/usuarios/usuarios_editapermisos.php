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

#divModTiendas {
	position: absolute;
	left: 35px;
	top: 39px;
	width: 261px;
	height: 115px;
}

#divModCursos {
	position: absolute;
	left: 35px;
	top: 113px;
	width: 261px;
	height: 115px;
}

#divModAsistencia {
	position: absolute;
	left: 35px;
	top: 167px;
	width: 262px;
	height: 153px;
}

#divModPedidos {
	position: absolute;
	left: 305px;
	top: 39px;
	width: 263px;
	height: 153px;
}

#divModTraslados {
	position: absolute;
	left: 306px;
	top: 113px;
	width: 245px;
	height: 153px;
}

#divModSoporte {
	position: absolute;
	left: 324px;
	top: 115px;
	width: 245px;
	height: 153px;
}


#divBotones {
	position:absolute;
	left:306px;
	top:193px;
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
	
	$target_link  = $hostname.$relpath.'usuarios_modificapermisos.php';
//	$target_link2 = $hostname.$relpath.'asistencia_ejecutamodificar.php';
	 	
	foreach ($_GET as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
    		${$nombre} = $valor;
		}
	}// Cierre foreach     

?>

<script type="text/javascript" src="usuarios_editapermisos.js"></script>

<script language="javascript">

	function modificaPermisos()
	{
//		updateRow(document.forms.form_grid, <?php // echo $idempleado; ?>);
//		document.forms[0].submit(); 
		document.forms.form0.submit();
     	// setTimeout ("", 1200);
		// alert("Los Datos fueron Actualizados");
		// window.close();

	}

	function cierraventana()
	{
		window.close();		
	}

</script>

<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php

		$cols_arr      = array("username",                   // 0
							   "usa_tiendas",                // 1
							   "usa_tie_1",                  // 2   
							   "usa_asistencia",             // 3 
							   "usa_asis_1",                 // 4
							   "usa_asis_4",  			     // 5  
							   "usa_pedidos",                // 6  
							   "usa_ped_1",                  // 7
							   "usa_ped_2",                  // 8
							   "usa_traslados",              // 9    
							   "usa_tras_1",                 // 10
							   "usa_tras_2",                 // 11    
							   "inmu_gdat.nombreinmu");		 // 12
		$num_cols      = count($cols_arr);
	   	$join_tables   = '1';
	    $tables_arr    = array("gnrl_usrs", "inmu_gdat");
	    $num_tables    = count($tables_arr);
		$on_fields_arr = array("idinmu");
//		$connect       = '1';
//		$order         = "idempleado, nombreinmu";

		$where_clause = "gnrl_usrs.iduser = '$iduser'";

  		$permisos_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
		unset($join_tables);
		unset($on_fields_arr);
		unset($connect);
		unset($where_clause);

		$col=mysql_fetch_row($permisos_rset);
	
?>
<br />
<h2>Editar permisos para el usuario:  <strong><?php echo $col[0]; ?></strong> de la tienda <strong><?php echo $col[12]; ?></strong><br />
</h2>
<form id="form0" name="form0" method="post" action="<?php echo $target_link; ?>">

<div id="divModTiendas">
<table id="1" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input name="usa_tiendas" type="checkbox" id="usa_tiendas" value="1" 
	    <?php if ($col[1] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(1, false, \'usa_tiendas\', \'MODULO TIENDAS\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(1, true, \'usa_tiendas\', \'MODULO TIENDAS\')"'; } ?> />
    	<label for="usa_tiendas">MODULO TIENDAS</label></td>
  </tr>
  <tr>
    <td><input name="usa_tie_1" type="checkbox" id="usa_tie_1" value="1" 
		<?php if ($col[2] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[9] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_tie_1" class="letra_predeterminada12">Resumen</label><br /></td>	
  </tr>
  <tr>
  	<td><input name="usa_tie_2" type="checkbox" id="usa_tie_2" value="1" disabled="disabled" />
		<label for="usa_tie_2" class="letra_predeterminada12">Avisos</label></td>
  </tr>
</table>
</div>

<div id="divModCursos">
<table id="2" width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
   	 <td><input name="usa_cursos" type="checkbox" id="usa_cursos" value="1" disabled="disabled" />
		 <label for="usa_cursos">MODULO CURSOS</label></td>
   </tr>
   <tr>   
     <td><input name="usa_cur_6" type="checkbox" id="usa_cur_6" value="1" disabled="disabled" />
		 <label for="usa_cur_6" span class="letra_predeterminada12">Consultar Cursos</label>
</td>
	</tr>
</table>
</div>


<div id="divModAsistencia">
<table id="3" width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td><input name="usa_asistencia" type="checkbox" id="usa_asistencia" value="1"  
	  	 <?php if ($col[3] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(3, false, \'usa_asistencia\', \'MODULO ASISTENCIA\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(3, true, \'usa_asistencia\', \'MODULO ASISTENCIA\')"'; } ?> />
         <label for="usa_asistencia">MODULO ASISTENCIA</label></td>
   </tr>
   <tr>
	 <td><input name="usa_asis_1" type="checkbox" id="usa_asis_1" value="1" 
	 	 <?php if ($col[4] == 1) { echo 'checked="checked"'; } 
		 	   if ($col[3] == 0) { echo 'disabled="disabled"'; } ?> />
         <label for="usa_asis_1" class="letra_predeterminada12">Checar Asistencia</label><br />
         <input name="usa_asis_4" type="checkbox" id="usa_asis_4" value="1" 
		 <?php if ($col[5] == 1) { echo 'checked="checked"'; } 
 		 	   if ($col[3] == 0) { echo 'disabled="disabled"'; } ?> />
		 <label for="usa_asis_4" class="letra_predeterminada12">Reportes Asistencia</label></td>
   </tr>
</table>   
</div>

<div id="divModPedidos">
<table id="4" width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
	 <td><input name="usa_pedidos" type="checkbox" id="usa_pedidos" value="1" 
	     <?php if ($col[6] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(4, false, \'usa_pedidos\', \'MODULO PEDIDOS\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(4, true, \'usa_pedidos\', \'MODULO PEDIDOS\')"'; } ?> />
         <label for="usa_pedidos">MODULO PEDIDOS</label></td>
   </tr>
   <tr>
     <td><input name="usa_ped_1" type="checkbox" id="usa_ped_1" value="1" 
	 	 <?php if($col[7] == 1) { echo 'checked="checked"'; } 
		 	   if ($col[6] == 0) { echo 'disabled="disabled"'; } ?> />
         <label for="usa_ped_1" class="letra_predeterminada12">Pedidos Enviados</label><br />
		 <input name="usa_ped_2" type="checkbox" id="usa_ped_2" value="1" 
		 <?php if($col[8] == 1) { echo 'checked="checked"'; } 
		 	   if ($col[6] == 0) { echo 'disabled="disabled"'; } ?> />
	    <label for="usa_ped_2" class="letra_predeterminada12">Enviar Pedido</label></td>
   </tr>
</table>         
</div>

<div id="divModTraslados">
<table id="5" width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td><input name="usa_traslados" type="checkbox" id="usa_traslados" value="1" 
	     <?php if ($col[9] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(5, false, \'usa_traslados\', \'MODULO TRASLADOS\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(5, true, \'usa_traslados\', \'MODULO TRASLADOS\')"'; } ?> />
         <label for="usa_traslados">MODULO TRASLADOS</label></td>
   </tr>
   <tr>
     <td><input name="usa_tras_1" type="checkbox" id="usa_tras_1" value="1" 
	 	 <?php if ($col[10] == 1) { echo 'checked="checked"'; }
		 	   if ($col[9] == 0) { echo 'disabled="disabled"'; } ?> />
		 <label for="usa_tras_1" class="letra_predeterminada12">Traslados Descargados</label><br />
	  	 <input name="usa_tras_2" type="checkbox" id="usa_tras_2" value="1" 
		 <?php if($col[11] == 1) { echo 'checked="checked"'; }
		 	   if ($col[9] == 0) { echo 'disabled="disabled"'; } ?> />
	 	 <label for="usa_tras_2" class="letra_predeterminada12">Descargar Traslados</label></td>
   </tr>
</table>   
</div>

<div id="divBotones">
	<!--<input name="enviaDatos" type="submit" value="Actualiza Permisos"  />-->
    <button onclick="javascript: modificaPermisos()">Actualizar Datos</button>
    <button onclick="javascript: cierraventana()">Cancelar</button>
    <input name="iduser" type="hidden" id="iduser" value="<?php echo $iduser; ?>" />
</div>

</form>





</body>
</html>