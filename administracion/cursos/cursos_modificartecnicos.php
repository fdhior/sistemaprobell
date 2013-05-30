<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.moduser_frame {
	position: relative;
    width: 970px;
    height: 150px;
	left: 26px;
	border: 1px solid #000;
}

.modify_frame {
	position: relative;
    width: 968px;
    height: 200px;
	left: 26px;
	border: 1px solid #000;
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
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php

	session_start();

	include $_SESSION['rutafunciones'].'consultas.php';

	$hostname      = $_SESSION['hostname'];
	
	$rel_path      = 'administracion/cursos/cursos_'; 
	$target_link   = $hostname.$rel_path.'tecnicoslistado.php';
    $target_link2  = $hostname.$rel_path.'modificacurso.php';
	$target_frame  = "moduser_frame"; 
	$target_frame2 = "modify_frame";

	unset($_SESSION['modobusqueda']);

?>

<body onload="javascript: tecnicosactivos()">

<!-- iframe de lista usuarios -->
<br />
<h2>Administrar Tecnico que impartiran los cursos</h2>
<div style="position:relative; left: 26px;">
<table class="tblHeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33" align="center">No.</td>
    <td width="110" align="center"> Nombre</td>
    <td width="150" align="center">Telefono</td>
    <td width="100" align="center">Celular</td>
    <td width="140" align="center">Correo Electronico</td>
    <td width="130" align="center">Fecha de Alta</td>
    <td align="center">Opciones</th>
  </tr>
</table>
</div>

<iframe class="moduser_frame" name="moduser_frame" id="moduser_frame" src="" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0"></iframe>

<table class="tablamoduser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="143" class="letramoduser_no_padd"><label>
      <input name="sel_tcurso" type="radio" id="radio" value="activos" checked="checked" onclick="javascript: tecnicosactivos()" />
    </label>
    Todos Los T&eacute;cnicos</td>
    <!-- FORMULARIO NO. 0 -->
    <form id="form0" name="form0" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
    <td width="275" class="letramoduser_no_padd">Busqueda por Nombre:
    <label>
    <input name="nombretec" type="text" id="nombretec" size="15" maxlength="15" onchange="javascript: buscapornombre()"/>
    </label>
    <input type="hidden" name="busca" id="busca" value="pornombre" />
    <input type="hidden" name="sel_ttecnico" id="sel_ttecnico" value="activos" /></td>
    </form>
		<!-- FORMULARIO NO. 1 -->
      <form id="form1" name="form1" method="post" action="<?php echo $target_link2; ?>" target="<?php echo $target_frame2; ?>">
    <td width="555" class="letramoduser_no_padd"><label>
      <input type="submit" name="button" id="button" value="Agregar Nuevo Técnico" />
      <input name="modificar" type="hidden" id="modificar" value="agrtecnico" />
        </label>    </td>
    </form>

  <!--    <td width="662" class="letramoduser_no_padd"><label>
      <input type="radio" name="sel_tcurso" id="radio3" value="elimn" onclick="javascript: usuarioseliminados()" />
    </label>
    Tiendas Eliminadas</td>
-->  </tr>
</table>
<!-- FORMULARIO NO. 2 -->
<form id="form2" name="form2" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
  <input name="sel_ttecnico" type="hidden" id="sel_ttecnico" value="activos" />
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->


<script language="javascript">
//                window.alert("Revisa el resultado de la transferencia.");
	function tecnicosactivos()
	{
		document.forms[2].submit();
	}
	
	function buscapornombre()
	{
		document.forms[0].submit();
	}
	
	
</script>

<br />
<iframe class="modify_frame" name="modify_frame" id="modify_frame" src="<?php echo $target_link2; ?>" align="left" hspace="0" vspace="0" frameborder="0" scrolling="No" marginheight="0" marginwidth="0"></iframe>

<p>&nbsp;</p>

</body>

</html>
