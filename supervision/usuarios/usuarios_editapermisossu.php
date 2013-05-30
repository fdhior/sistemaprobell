<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Datos Generales de un Usuario</title>
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

#divModAlmacen {
	position: absolute;
	left: 36px;
	top: 101px;
	width: 261px;
	height: 115px;
}

#divModSupervision {
	position: absolute;
	left: 36px;
	top: 254px;
	width: 261px;
	height: 76px;
}

#divModAdministracion {
	position: absolute;
	left: 36px;
	top: 50px;
	width: 261px;
	height: 115px;
}

#divModSistemas {
	position: absolute;
	left: 36px;
	top: 203px;
	width: 261px;
	height: 115px;
}

#divModTiendas {
	position: absolute;
	left: 215px;
	top: 185px;
	width: 261px;
	height: 115px;
}

#divModContabilidad {
	position: absolute;
	left: 36px;
	top: 152px;
	width: 261px;
	height: 115px;
}

#divModUsuarios {
	position: absolute;
	left: 562px;
	top: 185px;
	width: 167px;
	height: 88px;
}

#divModCursos {
	position: absolute;
	left: 392px;
	top: 50px;
	width: 261px;
	height: 115px;
}

#divModAsistencia {
	position: absolute;
	left: 214px;
	top: 50px;
	width: 262px;
	height: 153px;
}

#divModPedidos {
	position: absolute;
	left: 392px;
	top: 185px;
	width: 263px;
	height: 153px;
}

#divModTraslados {
	position: absolute;
	left: 562px;
	top: 50px;
	width: 167px;
	height: 153px;
}


#divModMantenimiento {
	position: absolute;
	left: 324px;
	top: 115px;
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

#divModConfiguracion {
	position: absolute;
	left: 324px;
	top: 115px;
	width: 245px;
	height: 153px;
}

#divBotones {
	position:absolute;
	left:519px;
	top:339px;
	width:245px;
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
	
	$target_link  = $hostname.$relpath.'usuarios_modificapermisossu.php';
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
    
    /* echo '<span class="tipoletra">Valores de $_GET</span><br />';
        foreach ($_GET as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print '<span class=="tipoletra">Nombre de la Variable: <strong>'.$nombre.'</strong> Valor: <strong>'.$valor.'</strong></span><br />';
                }
    }*/
    
		$cols_arr      = array("username",                   // 0
						   	   "usa_admon",					 //	1
							   "usa_adm_1",                  // 2
							   "usa_almacen",                // 3
							   "usa_alm_1",                  // 4  
							   "usa_conta",					 // 5
							   "usa_conta_1",				 // 6
							   "usa_sistemas",				 // 7
							   "usa_sis_1",					 // 8
							   "usa_sprv",					 // 9
							   "usa_sprv_1",				 // 10
							   "usa_asistencia",             // 11 
							   "usa_asis_1",			  	 // 12 
							   "usa_asis_2",				 // 13
							   "usa_asis_3",                 // 14
							   "usa_asis_4",				 // 15
							   "usa_asis_5", 			     // 16  
							   "usa_tiendas",                // 17
							   "usa_tie_1",                  // 18   
							   "usa_tie_2",                  // 19   
							   "usa_tie_3",                  // 20  
							   "usa_tie_4",                  // 21   
							   "usa_tie_5",                  // 22   
							   "usa_cursos",				 // 23
							   "usa_cur_1",					 // 24 
							   "usa_cur_2",					 // 25
							   "usa_cur_3",					 // 26
							   "usa_cur_4",					 // 27	    
							   "usa_cur_5",					 // 28
							   "usa_pedidos",                // 29  
							   "usa_ped_1",                  // 30
							   "usa_ped_2",                  // 31
							   "usa_ped_3",                  // 32
							   "usa_ped_4",                  // 33
							   "usa_ped_5",                  // 34
							   "usa_ped_6",                  // 35
							   "usa_traslados",              // 36   
							   "usa_tras_1",                 // 37
							   "usa_tras_2",                 // 38    
   							   "usa_tras_3",                 // 39
							   "usa_tras_4",                 // 40
							   "usa_tras_5",                 // 41    
							   "usa_tras_6",                 // 42
							   "usa_usuarios",				 // 43
							   "usa_usu_1",					 // 44
							   "usa_usu_2");   				 // 45
//							   "inmu_gdat.nombreinmu");		 // 46
		$num_cols      = count($cols_arr);
//	   	$join_tables   = '1';
	    $tables_arr    = array("gnrl_usrs");
	    $num_tables    = count($tables_arr);
//		$on_fields_arr = array("idinmu");
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
<h2>Editar permisos para el usuario:  <strong><?php echo $col[0]; ?></strong><br />
</h2>
<form id="form0" name="form0" method="post" action="<?php echo $target_link; ?>">

<div id="divModAdministracion">
<table id="1" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input name="usa_admon" type="checkbox" id="usa_admon" value="1" 
	    <?php if ($col[1] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(1, false, \'usa_admon\', \'MODULO ADMINISTRACION\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(1, true, \'usa_admon\', \'MODULO ADMINISTRACION\')"'; } ?> />
    	<label for="usa_admon">MODULO ADMINISTRACION</label></td>
  </tr>
  <tr>
    <td><input name="usa_adm_1" type="checkbox" id="usa_adm_1" value="1" 
		<?php if ($col[2] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[1] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_adm_1" class="letra_predeterminada12">Resumen</label><br /></td>	
  </tr>
</table>
</div>

<div id="divModAlmacen">
<table id="2" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input name="usa_almacen" type="checkbox" id="usa_almacen" value="1" 
	    <?php if ($col[3] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(2, false, \'usa_almacen\', \'MODULO ALMACEN\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(2, true, \'usa_almacen\', \'MODULO ALMACEN\')"'; } ?> />
    	<label for="usa_almacen">MODULO ALMACEN</label></td>
  </tr>
  <tr>
    <td><input name="usa_alm_1" type="checkbox" id="usa_alm_1" value="1" 
		<?php if ($col[4] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[3] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_alm_1" class="letra_predeterminada12">Resumen</label><br /></td>	
  </tr>
</table>
</div>

<div id="divModContabilidad">
<table id="3" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input name="usa_conta" type="checkbox" id="usa_conta" value="1" 
	    <?php if ($col[5] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(3, false, \'usa_conta\', \'MODULO CONTABILIDAD\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(3, true, \'usa_conta\', \'MODULO CONTABILIDAD\')"'; } ?> />
    	<label for="usa_tiendas">MODULO CONTABILIDAD</label></td>
  </tr>
  <tr>
    <td><input name="usa_conta_1" type="checkbox" id="usa_conta_1" value="1" 
		<?php if ($col[6] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[5] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_conta_1" class="letra_predeterminada12">Resumen</label><br /></td>	
  </tr>
</table>
</div>

<div id="divModSistemas">
<table id="4" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input name="usa_sistemas" type="checkbox" id="usa_sistemas" value="1" 
	    <?php if ($col[7] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(4, false, \'usa_sistemas\', \'MODULO SISTEMAS\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(4, true, \'usa_sistemas\', \'MODULO SISTEMAS\')"'; } ?> />
    	<label for="usa_sistemas">MODULO SISTEMAS</label></td>
  </tr>
  <tr>
    <td><input name="usa_sis_1" type="checkbox" id="usa_sis_1" value="1" 
		<?php if ($col[8] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[7] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_sis_1" class="letra_predeterminada12">Resumen</label><br /></td>	
  </tr>
</table>
</div>

<div id="divModSupervision">
<table id="5" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input name="usa_sprv" type="checkbox" id="usa_sprv" value="1" 
	    <?php if ($col[9] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(5, false, \'usa_sprv\', \'MODULO SUPERVISION\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(5, true, \'usa_sprv\', \'MODULO SUPERVISION\')"'; } ?> />
    	<label for="usa_sprv">MODULO SUPERVISION</label></td>
  </tr>
  <tr>
    <td><input name="usa_sprv_1" type="checkbox" id="usa_sprv_1" value="1" 
		<?php if ($col[10] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[9] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_sprv_1" class="letra_predeterminada12">Resumen</label><br /></td>	
  </tr>
</table>
</div>


<div id="divModAsistencia">
<table id="6" width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td><input name="usa_asistencia" type="checkbox" id="usa_asistencia" value="1"  
	  	 <?php if ($col[11] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(6, false, \'usa_asistencia\', \'MODULO ASISTENCIA\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(6, true, \'usa_asistencia\', \'MODULO ASISTENCIA\')"'; } ?> />
         <label for="usa_asistencia">MODULO ASISTENCIA</label></td>
   </tr>
   <tr>
	 <td><input name="usa_asis_1" type="checkbox" id="usa_asis_1" value="1" 
	 	 <?php if ($col[12] == 1) { echo 'checked="checked"'; } 
		 	   if ($col[11] == 0) { echo 'disabled="disabled"'; } ?> />
         <label for="usa_asis_1" class="letra_predeterminada12">Checar Asistencia</label><br />
         <input name="usa_asis_2" type="checkbox" id="usa_asis_2" value="1" 
		 <?php if ($col[13] == 1) { echo 'checked="checked"'; } 
 		 	   if ($col[11] == 0) { echo 'disabled="disabled"'; } ?> />
		 <label for="usa_asis_2" class="letra_predeterminada12">Registro Empleados</label><br />
         <input name="usa_asis_3" type="checkbox" id="usa_asis_3" value="1" 
		 <?php if ($col[14] == 1) { echo 'checked="checked"'; } 
 		 	   if ($col[11] == 0) { echo 'disabled="disabled"'; } ?> />
		 <label for="usa_asis_3" class="letra_predeterminada12">Administrar Empleados</label><br />
         <input name="usa_asis_4" type="checkbox" id="usa_asis_4" value="1" 
		 <?php if ($col[15] == 1) { echo 'checked="checked"'; } 
 		 	   if ($col[11] == 0) { echo 'disabled="disabled"'; } ?> />
		 <label for="usa_asis_4" class="letra_predeterminada12">Reportes Asistencia</label><br />
         <input name="usa_asis_5" type="checkbox" id="usa_asis_5" value="1" 
		 <?php if ($col[16] == 1) { echo 'checked="checked"'; } 
 		 	   if ($col[11] == 0) { echo 'disabled="disabled"'; } ?> />
		 <label for="usa_asis_5" class="letra_predeterminada12">Historial de Cambios</label></td>
   </tr>
</table>   
</div>


<div id="divModTiendas">
<table id="7" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input name="usa_tiendas" type="checkbox" id="usa_tiendas" value="1" 
	    <?php if ($col[17] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(7, false, \'usa_tiendas\', \'MODULO TIENDAS\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(7, true, \'usa_tiendas\', \'MODULO TIENDAS\')"'; } ?> />
    	<label for="usa_tiendas">MODULO TIENDAS</label></td>
  </tr>
  <tr>
    <td><input name="usa_tie_1" type="checkbox" id="usa_tie_1" value="1" 
		<?php if ($col[18] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[17] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_tie_1" class="letra_predeterminada12">Resumen</label><br />
        <input name="usa_tie_2" type="checkbox" id="usa_tie_2" value="1" 
		<?php if ($col[19] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[17] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_tie_2" class="letra_predeterminada12">Crear Tienda</label><br />
        <input name="usa_tie_3" type="checkbox" id="usa_tie_3" value="1" 
		<?php if ($col[20] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[17] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_tie_3" class="letra_predeterminada12">Eliminar Tienda</label><br />
        <input name="usa_tie_4" type="checkbox" id="usa_tie_4" value="1" 
		<?php if ($col[21] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[17] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_tie_4" class="letra_predeterminada12">Modificar Tienda</label><br />
        <input name="usa_tie_5" type="checkbox" id="usa_tie_5" value="1" 
		<?php if ($col[22] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[17] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_tie_5" class="letra_predeterminada12">Consultar Tiendas</label><br /></td>	
  </tr>
</table>
</div>

<div id="divModCursos">
<table id="8" width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
   	 <td><input name="usa_cursos" type="checkbox" id="usa_cursos" value="1" 
	    <?php if ($col[23] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(8, false, \'usa_cursos\', \'MODULO CURSOS\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(8, true, \'usa_cursos\', \'MODULO CURSOS\')"'; } ?> />
    	<label for="usa_cursos">MODULO CURSOS</label></td>
   </tr>
   <tr>   
     <td>        <input name="usa_cur_1" type="checkbox" id="usa_cur_1" value="1" 
		<?php if ($col[24] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[23] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_cur_1" class="letra_predeterminada12">Alta de Cursos</label><br />
          <input name="usa_cur_2" type="checkbox" id="usa_cur_2" value="1" 
		<?php if ($col[25] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[23] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_cur_2" class="letra_predeterminada12">Modificar Cursos</label><br />
          <input name="usa_cur_3" type="checkbox" id="usa_cur_3" value="1" 
		<?php if ($col[26] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[24] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_cur_3" class="letra_predeterminada12">Editar T&eacute;cnicos</label><br />
          <input name="usa_cur_4" type="checkbox" id="usa_cur_4" value="1" 
		<?php if ($col[27] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[25] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_cur_4" class="letra_predeterminada12">Editar L&iacute;neas</label><br />
          <input name="usa_cur_5" type="checkbox" id="usa_cur_5" value="1" 
		<?php if ($col[28] == 1) { echo 'checked="checked"'; } 
		 	  if ($col[26] == 0) { echo 'disabled="disabled"'; } ?> />
		<label for="usa_cur_5" class="letra_predeterminada12">Consultar Cursos</label><br /></td>
	</tr>
</table>
</div>



<div id="divModPedidos">
<table id="9" width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
	 <td><input name="usa_pedidos" type="checkbox" id="usa_pedidos" value="1" 
	     <?php if ($col[29] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(9, false, \'usa_pedidos\', \'MODULO PEDIDOS\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(9, true, \'usa_pedidos\', \'MODULO PEDIDOS\')"'; } ?> />
         <label for="usa_pedidos">MODULO PEDIDOS</label></td>
   </tr>
   <tr>
     <td><input name="usa_ped_1" type="checkbox" id="usa_ped_1" value="1" 
	 	 <?php if($col[30] == 1) { echo 'checked="checked"'; } 
		 	   if ($col[29] == 0) { echo 'disabled="disabled"'; } ?> />
         <label for="usa_ped_1" class="letra_predeterminada12">Pedidos Enviados</label><br />
		 <input name="usa_ped_2" type="checkbox" id="usa_ped_2" value="1" 
		 <?php if($col[31] == 1) { echo 'checked="checked"'; } 
		 	   if ($col[29] == 0) { echo 'disabled="disabled"'; } ?> />
	    <label for="usa_ped_2" class="letra_predeterminada12">Enviar Pedido</label><br />
        <input name="usa_ped_3" type="checkbox" id="usa_ped_3" value="1" 
		 <?php if($col[32] == 1) { echo 'checked="checked"'; } 
		 	   if ($col[29] == 0) { echo 'disabled="disabled"'; } ?> />
	    <label for="usa_ped_3" class="letra_predeterminada12">Pedidos Descargados</label><br />
        <input name="usa_ped_4" type="checkbox" id="usa_ped_4" value="1" 
		 <?php if($col[33] == 1) { echo 'checked="checked"'; } 
		 	   if ($col[29] == 0) { echo 'disabled="disabled"'; } ?> />
	    <label for="usa_ped_4" class="letra_predeterminada12">Descargar Pedidos</label><br />
        <input name="usa_ped_5" type="checkbox" id="usa_ped_5" value="1" 
		 <?php if($col[34] == 1) { echo 'checked="checked"'; } 
		 	   if ($col[29] == 0) { echo 'disabled="disabled"'; } ?> />
	    <label for="usa_ped_5" class="letra_predeterminada12">Consultar Pedidos</label><br />
        <input name="usa_ped_6" type="checkbox" id="usa_ped_6" value="1" 
		 <?php if($col[35] == 1) { echo 'checked="checked"'; } 
		 	   if ($col[29] == 0) { echo 'disabled="disabled"'; } ?> />
	    <label for="usa_ped_6" class="letra_predeterminada12">Administrar Pedidos</label><br /></td>
   </tr>
</table>         
</div>

<div id="divModTraslados">
<table id="10" width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td><input name="usa_traslados" type="checkbox" id="usa_traslados" value="1" 
	     <?php if ($col[36] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(10, false, \'usa_traslados\', \'MODULO TRASLADOS\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(10, true, \'usa_traslados\', \'MODULO TRASLADOS\')"'; } ?> />
         <label for="usa_traslados">MODULO TRASLADOS</label></td>
   </tr>
   <tr>
     <td><input name="usa_tras_1" type="checkbox" id="usa_tras_1" value="1" 
	 	 <?php if ($col[37] == 1) { echo 'checked="checked"'; }
		 	   if ($col[36] == 0) { echo 'disabled="disabled"'; } ?> />
		 <label for="usa_tras_1" class="letra_predeterminada12">Traslados Descargados</label><br />
	  	 <input name="usa_tras_2" type="checkbox" id="usa_tras_2" value="1" 
		 <?php if($col[38] == 1) { echo 'checked="checked"'; }
		 	   if ($col[36] == 0) { echo 'disabled="disabled"'; } ?> />
	 	 <label for="usa_tras_2" class="letra_predeterminada12">Descargar Traslados</label><br />
         <input name="usa_tras_3" type="checkbox" id="usa_tras_3" value="1" 
		 <?php if($col[39] == 1) { echo 'checked="checked"'; }
		 	   if ($col[36] == 0) { echo 'disabled="disabled"'; } ?> />
	 	 <label for="usa_tras_3" class="letra_predeterminada12">Traslados Enviados</label><br /> 
         <input name="usa_tras_4" type="checkbox" id="usa_tras_4" value="1" 
		 <?php if($col[40] == 1) { echo 'checked="checked"'; }
		 	   if ($col[36] == 0) { echo 'disabled="disabled"'; } ?> />
	 	 <label for="usa_tras_4" class="letra_predeterminada12">Enviar Traslados</label><br />
         <input name="usa_tras_5" type="checkbox" id="usa_tras_5" value="1" 
		 <?php if($col[41] == 1) { echo 'checked="checked"'; }
		 	   if ($col[36] == 0) { echo 'disabled="disabled"'; } ?> />
	 	 <label for="usa_tras_5" class="letra_predeterminada12">Consultar Traslados</label><br />
         <input name="usa_tras_6" type="checkbox" id="usa_tras_6" value="1" 
		 <?php if($col[42] == 1) { echo 'checked="checked"'; }
		 	   if ($col[36] == 0) { echo 'disabled="disabled"'; } ?> />
	 	 <label for="usa_tras_6" class="letra_predeterminada12">Administrar Traslados</label><br /></td>
   </tr>
</table>   
</div>

<div id="divModUsuarios">
<table id="11" width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td><input name="usa_usuarios" type="checkbox" id="usa_usuarios" value="1" 
	     <?php if ($col[43] == 1) { echo 'checked="checked"'; 
                 echo ' onclick="javascript: enableMods(11, false, \'usa_usuarios\', \'MODULO USUARIOS\')"'; 
			  } else {
				 echo ' onclick="javascript: enableMods(11, true, \'usa_usuarios\', \'MODULO USUARIOS\')"'; } ?> />
         <label for="usa_usuarios">MODULO USUARIOS</label></td>
   </tr>
   <tr>
     <td><input name="usa_usu_1" type="checkbox" id="usa_usu_1" value="1" 
	 	 <?php if ($col[44] == 1) { echo 'checked="checked"'; }
		 	   if ($col[43] == 0) { echo 'disabled="disabled"'; } ?> />
		 <label for="usa_usu_1" class="letra_predeterminada12">Agregar Usuarios</label><br />
	  	 <input name="usa_usu_2" type="checkbox" id="usa_usu_2" value="1" 
		 <?php if($col[45] == 1) { echo 'checked="checked"'; }
		 	   if ($col[43] == 0) { echo 'disabled="disabled"'; } ?> />
	 	 <label for="usa_usu_2" class="letra_predeterminada12">Modificar Usuarios</label></td>
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