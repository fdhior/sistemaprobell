<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.frmListaUsuarios {
	position: relative;
	width: 628px;
	height: 190px;
	border: 1px solid #000;
}

.frmHistorialDetalle {
	position: relative;
	width: 962px;
	height: 160px;
	border: 1px solid #000;
}

.tblOpcionesBusqueda {
	position: absolute;
	left: 35px;
	width: 320px;
	border: 1px solid #000;
	top: 45px;
	height: 233px;
}

#apDiv1 {
	position:absolute;
	left:367px;
	top:45px;
	width:93px;
	height:36px;
	z-index:1;
}
#apDiv2 {
	position:absolute;
	left:36px;
	top:291px;
	width:225px;
	height:125px;
	z-index:2;
}

-->
</style>

<script type="text/javaScript" src="calendario/javascripts.js"></script>

<script language="javascript">

	function empleadosactivos()
	{
		document.forms[0].submit();
	}
	
	function empleadosinactivos()
	{
		document.forms[1].submit();
	}
	
	function buscapornoempleado()
	{
		document.forms[2].submit();
	}
	
	function buscapornombreempleado()
	{
		document.forms[3].submit();
	}

	function buscaportempleado()
	{
		document.forms[4].submit();
	}

	function buscaportienda()
	{
		document.forms[5].submit();
	}
	
	function buscaporfecha()
	{
		document.forms[6].submit();
	}

</script>

<?php

	session_start();

	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';
	include "calendario/calendario.php";

	$userinmuid   = $_SESSION['userinmuid'];
	$hostname     = $_SESSION['hostname'];

	$relPath      = 'supervision/asistencia/asistencia_';
	$targetLink   = $hostname.$relPath.'empleadoshistoriallistado.php';
	$targetLink2   = $hostname.$relPath.'empleadohistorialdetalle.php';

	$targetFrame  = "frmListaUsuarios"; 
	$targetFrame2 = "frmHistorialDetalle";

	unset($_SESSION['modobusqueda']);

?>
</head>


<body onload="empleadosactivos()">

<div id="apDiv2">
<table class="tbl964HeaderStd"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="70" align="center">Periodo</td>
    <td width="180" align="center">Empleado(a)</td>
    <td width="160" align="center">Tienda Origen</td>
    <td width="160" align="center">Transferido A</td>
    <td width="150">Fecha del Cambio</td>
    <td align="center">Checadas del Periodo</td>
  </tr>
</table>
<iframe class="frmHistorialDetalle" name="frmHistorialDetalle" id="modify_frame" src="<?php echo $targetLink2; ?>" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Auto" marginheight="0" marginwidth="0"></iframe>
</div>
<br />
<h2>Historial de cambios de empleados entre tiendas</h2>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<!-- FORMULARIO NO. 0 -->
<form id="form0" name="form0" method="post" action="<?php echo $targetLink; ?>" target="<?php echo $targetFrame; ?>">
  <input name="sel_templeado" type="hidden" id="sel_templeado" value="activos" />
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->

<!-- FORMULARIO NO. 1 -->
<form id="form1" name="form1" method="post" action="<?php echo $targetLink; ?>" target="<?php echo $targetFrame; ?>">
  <input name="sel_templeado" type="hidden" id="sel_templeado" value="inactivos" />
</form>

<div id="apDiv1">
<table class="tblShortHeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33" align="center">No.</td>
    <td width="130" align="center">Nombre </td>
    <td width="100" align="center">Tipo Empleado</td>
    <td width="160" align="center">Lugar de Trabajo</td>
    <td width="100">Fecha de Alta</td>
    <td align="center">Detallle</td>
  </tr>
</table>

<iframe class="frmListaUsuarios" name="frmListaUsuarios" id="moduser_frame" src="" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0"></iframe>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="132"><label class="letra_predeterminada12">
    	<input name="sel_radbutt" type="radio" id="radio" value="activos" checked="checked" onclick="javascript: empleadosactivos()" />
        Empleados Activos</label></td>
    <td width="368"><label class="letra_predeterminada12">
    	<input  name="sel_radbutt" type="radio" id="radio" value="inactivos" onclick="javascript: empleadosinactivos()" />
        Empleados Inactivos</label></td>
  </tr>
</table>
</div>




<table class="tblOpcionesBusqueda" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top"><br />
        <h2>Opciones de B&uacute;squeda</h2>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="475"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <!-- FORMULARIO NO. 2 -->
                <form id="form7" name="form1" method="post" action="<?php echo $targetLink; ?>" target="<?php echo $targetFrame; ?>">
                 <td width="58%"><label class="letra_predeterminadamargen">No. de Usuario:</label>
                    <label>
                      <input name="nousuario" type="text" class="letra_predeterminada12"  id="nousuario" onchange="javascript: buscapornousuario()" size="4" maxlength="4"/>
                      <input name="busca" type="hidden" id="busca2" value="pornousuario" />
                    </label></td>
                </form>
                <td width="42%"><button class="letra_predeterminada12" onclick="javascript: empleadosactivos()">Todos</button></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <!-- FORMULARIO NO. 3 -->
            <form id="form8" name="form2" method="post" action="<?php echo $targetLink; ?>" target="<?php echo $targetFrame; ?>">
              <td width="475"><label class="letra_predeterminadamargen">En Nombre de Empleado:</label>
                <label>
                  <input name="nempleado" type="text" class="letra_predeterminada12" id="nempleado" onchange="javascript: buscapornombreempleado()" size="10" maxlength="10"/>
                </label>
                <input type="hidden" name="busca" id="busca" value="pornombreempleado" />
                <br />
                <label class="letra_predeterminadamargen">
                  <input name="sel_nempleado" type="radio" id="sel_nempleado_0" value="nombres" checked="checked" />
                  Nombre(s)</label>
                <label class="letra_predeterminada12">
                  <input type="radio" name="sel_nempleado" value="apaterno" id="sel_nempleado_1" />
                  A. Paterno</label>
                <label class="letra_predeterminada12">
                  <input type="radio" name="sel_nempleado" value="amaterno" id="sel_nempleado_2" />
                  A. Materno</label></td>
            </form>
          </tr>
          <tr>
            <!-- FORMULARIO NO. 4 -->
            <form id="form6" name="form0" method="post" action="<?php echo $targetLink; ?>" target="<?php echo $targetFrame; ?>">
              <td width="475"><label class="letra_predeterminadamargen">Tipo de empleado:</label>
                <label>
                  <select name="sel_templeado" class="letra_predeterminada12" id="sel_templeado" onchange="javascript: buscaportempleado()">
                    <?php

		$cols_arr     = array("idtempleado", "tipoempleado");
    	$num_cols     = count($cols_arr);
		$tables_arr   = array("gnrl_temp");
//	  	$where_clause = "idinmutipo <> 5 AND idinmutipo <> 6 AND idinmustat = 1";
//		$order 		  = "nombreinmu";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
//    $row=mysql_fetch_row($result);
	
		while($row=mysql_fetch_row($result)) {
			echo "<option value=\"$row[0]\">$row[1]</option>";
		}   // cierre de While

?>
                  </select>
                </label>
                <input type="hidden" name="busca" id="busca" value="portipoempleado" /></td>
            </form>
            
          </tr>
          
         <tr>
         
         <!-- FORMULARIO NO. 5 -->
       	<form id="form6" name="form0" method="post" action="<?php echo $targetLink; ?>" target="<?php echo $targetFrame; ?>">
         <td width="475"><label class="letra_predeterminadamargen">Lugar de Trabajo:</label>
           <br />
                <label class="letra_predeterminadamargen">
                  <select name="sel_inmu" class="letra_predeterminada12" id="sel_inmu" onchange="javascript: buscaportienda()">
                    <?php

		$cols_arr     = array("idinmu", "nombreinmu");
    	$num_cols     = count($cols_arr);
		$tables_arr   = array("inmu_gdat");
	  	$where_clause = "idinmutipo <> 5 AND idinmutipo <> 6 AND idinmustat = 1";
		$order 		  = "nombreinmu";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
		unset($where_clause);
		unset($order);
//    $row=mysql_fetch_row($result);
	
		while($row=mysql_fetch_row($result)) {
			echo "<option value=\"$row[0]\">$row[1]</option>";
		}   // cierre de While

?>
                  </select>
                </label>
                <input type="hidden" name="busca" id="busca" value="portienda" /></td>
           </form>
         </tr> 
         <tr>
         <td width="475" valign="middle"><label class="letra_predeterminadamargen">Fecha de alta:</label></td>
         </tr>
         <tr>

         <!-- FORMULARIO NO. 6 -->
         <form id="rfecha1" name="rfecha1" method="post" action="<?php echo $targetLink; ?>" target="<?php echo $targetFrame; ?>">
         <td>
           <label class="letra_predeterminadamargen">
              <?php $clase = "letra_predeterminada12"; escribe_formulario_fecha_vacio("dfechar1","rfecha1",$dfechar1, $clase, $estado); ?>
              </label>
                <input type="hidden" name="busca" id="busca" value="porfecha" />
                <input name="button" type="submit" class="letra_boton12"  id="button" value="Buscar" ondblclick="buscaporfecha()" />
          </td>
          </form>

  
         </tr>
         
        </table>
        <br />
        <br /></td>
    </tr>
</table>    
</body>

</html>
