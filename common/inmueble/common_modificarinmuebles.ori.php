<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.moduser_frame {
	position: relative;
    width: 968px;
    height: 150px;
}

.modify_frame {
	position: relative;
    width: 968px;
    height: 200px;
}

.tablamoduser {
	position: relative;
 	left: 26px;
	width: 973px;
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
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php
	session_start();

	$hostname    = $_SESSION['hostname'];

	$target_link   = "common/inmueble/common_inmueblelistado.php";
    $target_link2  = "common/inmueble/common_modificainmueble.php";
	$target_frame  = "moduser_frame"; 
	$target_frame2 = "modify_frame";

?>

<body>

<!-- iframe de lista usuarios -->
<br />
<h2>Modificar Propiedades de Inmuebles  Registrados</h2>
<table class="tablamoduser" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th width="33" align="center">No.</th>
    <th width="110" align="center"> Tienda</th>
    <th width="150" align="center">Tipo Tienda</th>
    <th width="120" align="center">Encargado(a)</th>
    <th width="100" align="center">Status</th>
    <th width="150" align="center">Modificar</th>
    <th align="center">Opciones</th>
  </tr>
</table>


<table class="tablamoduser" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <iframe class="moduser_frame" name="moduser_frame" id="moduser_frame" src="<?php echo "$hostname$target_link"; ?>" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0"></iframe>
	</td>
  </tr>
</table>
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
<form id="form0" name="form0" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
  <input name="sel_sttienda" type="hidden" id="sel_sttienda" value="activas" />
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->
<form id="form1" name="form1" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
  <input name="sel_sttienda" type="hidden" id="sel_sttienda" value="deshab" />
</form>
<form id="form2" name="form2" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
  <input name="sel_sttienda" type="hidden" id="sel_sttienda" value="elimn" />
</form>


<script language="javascript">
//                window.alert("Revisa el resultado de la transferencia.");
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

<br />
<table class="tablamoduser" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><iframe class="modify_frame" name="modify_frame" id="modify_frame" src="<?php echo "$hostname$target_link2"; ?>" align="left" hspace="0" vspace="0" frameborder="0" scrolling="No" marginheight="0" marginwidth="0"></iframe>
    </td>
  </tr>
</table>
<p>&nbsp;</p>

</body>

</html>
