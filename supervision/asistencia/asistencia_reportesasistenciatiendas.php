<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.moduser_frame {
	position: relative;
    width: 971px;
    height: 280px;
}

.tablamoduser {
	position: relative;
	left: 26px;
	width: 968px;
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

.razonSelect {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	width: 300px;
}

.tblborder {
	border: 1px solid #CCC;
}

-->
</style>

<script type="text/javascript" src="asistencia_reportesasistencia.js"></script>

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
		document.forms[5].submit();
	}


	function buscaportienda()
	{
		document.forms[6].submit();
	}
	

</script>


<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php

	session_start();

	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';
	include "calendario/calendario.php";

	$userinmuid    = $_SESSION['userinmuid'];
	$hostname      = $_SESSION['hostname'];
	$basepath_link = 'supervision/asistencia/asistencia_';
	$target_link   = $basepath_link.'empleadoschecadaslistadotiendas.php';
//  $target_link2  = $basepath_link.'ejecutamodificar.php';
	$target_frame  = "moduser_frame"; 
	$target_frame2 = "modify_frame";

	unset($_SESSION['modobusqueda']);

?>

<body onload="javascript: empleadosactivos()">

<!-- FORMULARIO NO. 0 -->
<form id="form0" name="form0" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->

 <!--onload="javascript: empleadosactivos()"-->

<!-- iframe de lista usuarios -->
<br />
<h2>Reportes del Sistema de Asistencia</h2>

<!-- FORMULARIO NO. 1 -->
<form id="form1" name="opciones_busqueda" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
<table class="tablamoduser" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="letra_predeterminada"><table class="tblHeaderStdLeft" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>&nbsp;&nbsp;&nbsp;Opciones de busqueda - Elige un tipo de checada a buscar:
                <label>
                  <select class="input_predeterminada" name="tipo_busc" id="select">
                    <option value="0" selected="selected">Todas las Checadas</option>
                    <?php
	
		$cols_arr     = array("idTipoChecada", "tipoChecada");
    	$num_cols     = count($cols_arr);
		$tables_arr   = array("empl_tche");
//		$order        = "nombreinmu";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
		while($row=mysql_fetch_row($result)) {
			echo '<option value="'.$row[0].'">'.$row[1].'</option>';
		}   // cierre de While

?>
                  </select>
              </label></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="tblborder" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <td class="letra_predeterminada"><label> Eliege la fecha del reporte que buscas:<br />
                      <input name="cuando_busc" type="radio" id="check_filt6" value="hoy" checked="checked" />
hoy<br />
<input name="cuando_busc" type="radio" id="check_filt9" value="eldia" />
el dia: <span class="letra_busqueda">
<?php $clase = "boton_predeterminado"; $estado = ""; escribe_formulario_fecha_vacio("taldia","opciones_busqueda",$dfechar1, $clase, $estado); ?>
</span> aaaa-mm-dd</label>
                    <label>  <br />
                    </label>
                    <label class="tipoletra">
                      <input name="btBuscar" type="submit" class="boton_predeterminado" id="button2"  accesskey="u" tabindex="0" value="Buscar" />
                    </label>
                    <label>
                      <input type="hidden" name="quien_busc" value="portodoslosemp" id="hiddenField" />
                      <input type="hidden" name="activa_tiempo" value="on" id="hiddenField2" />
                      <input type="hidden" name="de_busc" value="tienda" id="hiddenField3" />
                      <input type="hidden"name="sel_tienda" value="<?php echo $userinmuid; ?>" id="hiddenField4" />
                      <br />
                    </label></td>
                </tr>
              </table></td>
              
            </tr>
          </table>
        </td>
  </tr>
</table>
</form>
<div style="position:relative; left: 26px; border: 1px solid #000; width: 971px;">
<table class="tblHeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33" align="center">No.</td>
    <td width="100" align="center">Foto</td>
    <td width="150" align="center">Nombre </td>
    <td width="100" align="center">Tipo Empleado</td>
    <td width="100" align="center">Tipo De Checada</td>
    <td width="164" align="center">Lugar De Checada</td>
    <td width="150" align="center">Fecha</td>
    <td width="150" align="center" >Hora</td>
    <td align="center"></td>

  </tr>
</table>
</div>

<table class="tablamoduser" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <iframe class="moduser_frame" name="moduser_frame" id="moduser_frame" src="" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0"></iframe>
	</td>
  </tr>
</table>









</body>

</html>
