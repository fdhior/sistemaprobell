<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.moduser_frame {
	position: relative;
	width: 970px;
	height: 200px;
	border: 1px solid #000;
	left: 26px;
}

.modify_frame {
	position: relative;
    width: 968px;
    height: 200px;
}

.tablamoduser {
	position: relative;
 	left: 26px;
	width: 970px;
	border: 1px solid #000;
	
}

.letramoduser {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    font-weight: normal;
    color: #000000;
    padding-left: 26px;
}

.letramoduser_no_padd {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    font-weight: normal;
    color: #000000;
}

.letra_busqueda {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-variant: small-caps;
}
#apDiv1 {
	position:absolute;
	left:400px;
	top:5px;
	width:598px;
	height:32px;
	z-index:1;
}

-->
</style>

<?php

	session_start();

	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';
	include "calendario/calendario.php";

	$hostname      = $_SESSION['hostname'];
	$basepath_link = 'supervision/asistencia/asistencia_';
	$target_link   = $hostname.$basepath_link.'empleadoslistado.php';
    $target_link2  = $hostname.$basepath_link.'empleadoslistadogen.php';

	$target_frame  = "moduser_frame"; 
	$target_frame2 = "moduser_frame2";

	unset($_SESSION['modobusqueda']);

?>
<script type="text/javaScript" src="calendario/javascripts.js"></script>

<script language="javascript">

	function empleadosactivos()
	{
		document.forms[0].submit(); // Listado Inicial/Usuarios Activos
//		document.forms[8].submit(); // Listado Inicial/Usuarios Activos
	}
	
	function empleadosinactivos()
	{
		document.forms[1].submit(); // Usuarios Inactivos
	}
	
	function buscapornousuario()
	{
		document.forms[2].submit(); // No. de Usuario
	}

	function buscaportienda()
	{
		document.forms[3].submit();
	}

	function buscapornopbempleado()
	{
		document.forms[4].submit(); // No. de Empleado Probell
	}

	function buscapornombreempleado()
	{
		document.forms[5].submit(); // Por Nombre de Empleado
	}
	
	function buscaportempleado()
	{
		document.forms[7].submit();
	}

</script>
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
</head>


<body onload="javascript: empleadosactivos()">

<!-- iframe de lista usuarios --><br />
<h2>Administrar Empleados en el  Sistema  de Asistencia</h2>
<div id="divContent0" style="position: relative; left: 26px; top: 0px;">
<table class="tblHeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33" align="center">No.</td>
    <td width="100" align="center">Foto</td>
    <td width="130" align="center">Nombre </td>
    <td width="115" align="center">No. Emp. Probell</td>
    <td width="100" align="center">Tipo Empleado</td>
    <td width="160" align="center">Lugar de Trabajo</td>
    <td width="100" align="center">Contraseña</td>
    <td width="115" align="center">Fecha de Alta</td>
    <td align="center">Editar</td>
  </tr>
</table>
</div>

    <iframe class="moduser_frame" name="moduser_frame" id="moduser_frame" src="" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0"></iframe>
    
<table class="tablamoduser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="148" class="letramoduser_no_padd"><label>
      <input name="sel_radbutt" type="radio" id="radio" value="activos" checked="checked" onclick="javascript: empleadosactivos()" />
    </label>
    Empleados Activos</td>
    <td width="825" class="letramoduser_no_padd"><label>
    <input  name="sel_radbutt" type="radio" id="radio" value="inactivos" onclick="javascript: empleadosinactivos()" /></label>
    Empleados Inactivos</td>
  </tr>
</table>

<!-- FORMULARIO NO. 0 -->
<form id="form0" name="form0" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
  <input name="sel_templeado" type="hidden" id="sel_templeado" value="activos" />
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->

<!-- FORMULARIO NO. 1 -->
<form id="form1" name="form1" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
  <input name="sel_templeado" type="hidden" id="sel_templeado" value="inactivos" />
</form>



<br />

<table class="tablamoduser" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><br /><h2>Opciones de B&uacute;squeda</h2>
      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="446" class="letra_busqueda"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <!-- FORMULARIO NO. 2 -->
              <form id="form7" name="form1" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
                <td>No. de Usuario:
                  <label>
                    <input name="nousuario" type="text" class="letra_busqueda" id="nousuario" onchange="javascript: buscapornousuario()" size="4" maxlength="4"/>
                    <input name="busca" type="hidden" id="busca2" value="pornousuario" />
                  </label></td>
              </form>
              <td><button class="letra_busqueda" onclick="javascript: empleadosactivos()">Mostar Todos Los Empleados</button></td>
            </tr>
          </table></td>
          <!-- FORMULARIO NO. 3 -->
          <form id="form6" name="form0" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
            <td width="446" class="letra_busqueda">Lugar de Trabajo:
              <label>
                <select name="sel_inmu" class="letra_busqueda" id="sel_inmu" onchange="javascript: buscaportienda()">
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
          <!-- FORMULARIO NO. 4 -->
          <form id="form7" name="form1" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
            <td class="letra_busqueda">No. de Empleado Probell:
              <label>
                <input name="pbnoempleado" type="text" class="letra_busqueda" id="pbnoempleado" onchange="javascript: buscapornopbempleado()" size="10" maxlength="10"/>
                <input name="busca" type="hidden" id="busca" value="porpbnoempleado" />
              </label></td>
          </form>
          <td width="475" valign="middle" class="letra_busqueda"><label>Fecha de alta (Rango):</label></td>
        </tr>
        <tr>
          <!-- FORMULARIO NO. 5 -->
          <form id="form8" name="form2" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
            <td width="446" class="letra_busqueda">En Nombre de Empleado:
              <label>
                <input name="nempleado" type="text" class="letra_busqueda" id="nempleado" onchange="javascript: buscapornombreempleado()" size="10" maxlength="10"/>
              </label>
              <input type="hidden" name="busca" id="busca" value="pornombreempleado" />
              <br />
              <label>
                <input name="sel_nempleado" type="radio" id="sel_nempleado_0" value="nombres" checked="checked" />
                Nombre(s)</label>
              <label>
                <input type="radio" name="sel_nempleado" value="apaterno" id="sel_nempleado_1" />
                A. Paterno</label>
              <label>
                <input type="radio" name="sel_nempleado" value="amaterno" id="sel_nempleado_2" />
                A. Materno</label></td>
          </form>
          <!-- FORMULARIO NO. 6 -->
          <form id="rfecha1" name="rfecha1" method="post" action="<?php echo $target_link; ?>" target="<?php echo "$target_frame"; ?>">
            <td><span class="letra_busqueda"> De:
              <label>
                <?php $clase = "letra_busqueda"; escribe_formulario_fecha_vacio("dfechar1","rfecha1",$dfechar1, $clase, $estado); ?>
              </label>
              a
              <label>
                <?php $clase = "letra_busqueda"; escribe_formulario_fecha_vacio("dfechar2","rfecha1",$dfechar2, $clase, $estado); ?>
              </label>
              <input type="hidden" name="busca" id="busca" value="porrangofechas" />
              <input name="button" type="submit" class="letra_busqueda" id="button" value="Buscar" />
            </span></td>
          </form>
        </tr>
        <tr>
          <!-- FORMULARIO NO. 7 -->
          <form id="form6" name="form0" method="post" action="<?php echo $target_link; ?>" target="<?php echo "$target_frame"; ?>">
            <td width="446" class="letra_busqueda">Tipo de empleado:
              <label>
                <select name="sel_templeado" class="letra_busqueda" id="sel_templeado" onchange="javascript: buscaportempleado()">
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
          <td>&nbsp;</td>
        </tr>
    </table> <br />
<br />
</td>
  </tr>
</table>

<br />


</body>

</html>
