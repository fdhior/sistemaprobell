<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--

.frmModInm {
	position: relative;
    width: 970px;
    height: 150px;
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
.letra_busqueda {	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-variant: small-caps;
}
.tablamoduser1 {
	position: absolute;
	left: 32px;
	width: 970px;
	height: 180px;
	border: 1px solid #000;
	top: 276px;
}



-->
</style>
<?php
	session_start();

	$hostname    = $_SESSION['hostname'];

	$rel_path      = 'common/inmueble/common_';
	$target_link   = $hostname.$rel_path.'inmueblelistado.php';
    $target_link2  = $hostname.$rel_path.'encargadoslistado.php';
	$target_frame  = "moduser_frame"; 

?>
<script type="text/javascript">

	function toggle_Content0() {
		var oDiv = document.getElementById("divContent0");
		oDiv.style.visibility = "visible";
		var oDiv = document.getElementById("divContent1");
		oDiv.style.visibility = "hidden";
		var oDiv = document.getElementById("divContent2");
		oDiv.style.visibility = "hidden";
		var oDiv = document.getElementById("divContent3");
		oDiv.style.visibility = "hidden";
		var oDiv = document.getElementById("divContent4");
		oDiv.style.visibility = "hidden";
	}

	function toggle_Content1() {
		var oDiv = document.getElementById("divContent0");
		oDiv.style.visibility = "hidden";
		var oDiv = document.getElementById("divContent1");
		oDiv.style.visibility = "visible";
		var oDiv = document.getElementById("divContent2");
		oDiv.style.visibility = "hidden";
		var oDiv = document.getElementById("divContent3");
		oDiv.style.visibility = "hidden";
		var oDiv = document.getElementById("divContent4");
		oDiv.style.visibility = "hidden";
	}

	function usuariosactivos()
	{
		document.forms[0].submit();
	}
	
	function usuariosinactivos()
	{
		document.forms[1].submit();
	}

	function usuarioseliminados()
	{
		document.forms[2].submit();
	}

	
</script>

</head>


<body onload="toggle_Content0">

<br />
<h2>Modificar Propiedades de Inmuebles  Registrados</h2>
<div id="divUl">
	<ul class="nav">
	<li><a href="#" onclick="javascript: toggle_Content0()">Datos Generales</a></li>
	<li><a href="#" onclick="javascript: toggle_Content1()">Administrar Encargados</a></li>
	<li><a href="#" onclick="javascript: toggle_Content2()">Administrar Razones Sociales</a></li>
	</ul>
</div>
<p>&nbsp;</p>

<div id="divContent0" style="position: absolute; left: 30px; top: 80px">
<table class="tblHeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <!-- 1 -->
    <td width="33">No.</td>
    <!-- 2 -->
    <td width="110">Tienda</td>
    <!-- 3 -->
    <td width="110">Tipo Tienda</td>
    <!-- 4 -->
    <td width="180">R.F.C.</td>
    <!-- 5 -->
    <td width="180">Dirección</td>
    <!-- 6 -->
    <td width="100">Zona</td>
    <!-- 7 -->
    <td width="90">Link Ubicacion</td>
    <!-- 8 -->
    <td class="tdModInm8">Estado</td>
    <!-- 9 -->  
    <td>Modificar</td>
    </tr>
</table>

<iframe class="frmModInm" name="moduser_frame" id="moduser_frame2" src="<?php echo $target_link; ?>" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0"></iframe>

<table class="tablamoduser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="138" class="letramoduser_no_padd"><label>
      <input name="sel_sttienda" type="radio" id="radio" value="activas" checked="checked" onclick="javascript: usuariosactivos()" />
    </label>
      Tiendas Activas</td>
    <td width="173" class="letramoduser_no_padd"><label>
      <input type="radio" name="sel_sttienda" id="radio2" value="deshab" onclick="javascript: usuariosinactivos()" />
    </label>
      Tiendas Inactivas</td>
    <td width="662" class="letramoduser_no_padd"><label>
      <input type="radio" name="sel_sttienda" id="radio3" value="elimn" onclick="javascript: usuarioseliminados()" />
    </label>
      Tiendas Eliminadas</td>
  </tr>
</table>
</div>

<p><br />
  <!-- iframe de lista usuarios -->
</p>
<div id="divContent1" style="visibility: hidden; position: absolute; left: 26px; top: 100px;">
<table class="tblHeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
<!-- 1 -->    <td width="33">No.</td>
<!-- 2 -->    <td width="200">Nombre Gerente</td>
<!-- 3 -->    <td width="300">Asignado a la Tienda</td>
<!-- 4 -->    <td width="100">Estado</td>
<!-- 5 -->    <td width="100">Editar</td>
<!-- 6 -->    <td></td>
  </tr>
</table>


<iframe class="frmModInm" name="moduser_frame" id="moduser_frame" src="<?php echo $target_link2; ?>" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0"></iframe>


<form id="form0" name="form0" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
  <input name="sel_sttienda" type="hidden" id="sel_sttienda" value="activas" />
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->
<form id="form1" name="form1" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
  <input name="sel_sttienda" type="hidden" id="sel_sttienda" value="deshab" />
</form>
<form id="form2" name="form2" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
  <input name="sel_sttienda" type="hidden" id="sel_sttienda" value="elimn" />
</form>
<br />

</div>

<table border="0" cellpadding="0" cellspacing="0" class="tablamoduser1">
  <tr>
    <td>
      <h2>Opciones de B&uacute;squeda</h2>
      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="446" class="letra_busqueda"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <!-- FORMULARIO NO. 2 -->
              <form id="form7" name="form1" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
                <td>No. de Tienda:
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
            <td width="446" class="letra_busqueda">&nbsp;</td>
          </form>
        </tr>
        <tr>
          <!-- FORMULARIO NO. 4 -->
          <form id="form7" name="form1" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
            <td class="letra_busqueda">Nombre de Tienda:
              <label>
                <input name="pbnoempleado" type="text" class="letra_busqueda" id="pbnoempleado" onchange="javascript: buscapornopbempleado()" size="10" maxlength="10"/>
                <input name="busca" type="hidden" id="busca" value="porpbnoempleado" />
              </label></td>
          </form>
          <td width="475" valign="middle" class="letra_busqueda">&nbsp;</td>
        </tr>
        <tr>
          <!-- FORMULARIO NO. 5 -->
          <form id="form8" name="form2" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
            
          </form>
          <!-- FORMULARIO NO. 6 -->
          <form id="rfecha1" name="rfecha1" method="post" action="<?php echo $target_link; ?>" target="<?php echo "$target_frame"; ?>">
            
          </form>
        </tr>
        <tr>
          <!-- FORMULARIO NO. 7 -->
          <form id="form6" name="form0" method="post" action="<?php echo $target_link; ?>" target="<?php echo "$target_frame"; ?>">
            <td width="446" class="letra_busqueda">Razon Social:
              <label>
                <select name="sel_idfis" class="letra_busqueda" id="sel_templeado" onchange="javascript: buscaportempleado()">
                  <?php

		$cols_arr     = array("idfis", "razonsc");
    	$num_cols     = count($cols_arr);
		$tables_arr   = array("inmu_dfis");
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
      </table>
      <br />
      <br /></td>
  </tr>
</table>
<p>&nbsp;</p>

</body>

</html>
