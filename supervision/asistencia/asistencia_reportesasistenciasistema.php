<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.moduser_frame {
	position: relative;
    width: 971px;
    height: 220px;
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

	$hostname      = $_SESSION['hostname'];
	$basepath_link = 'supervision/asistencia/asistencia_';
	$target_link   = $hostname.$basepath_link.'empleadoschecadaslistadosistema.php';
//  $target_link2  = $basepath_link.'ejecutamodificar.php';
	$target_frame  = "moduser_frame"; 
	$target_frame2 = "modify_frame";

	unset($_SESSION['modobusqueda']);

?>

<body onload="javascript: empleadosactivos()">

<!-- FORMULARIO NO. 0 -->
<form id="form0" name="form0" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->

 <!--onload="javascript: empleadosactivos()"-->

<!-- iframe de lista usuarios -->
<br />
<h2>Reportes Internos del Sistema de Asistencia</h2>
<div id="divUl_adminasistencia">
	<ul class="nav">
	<li><a href="<?php echo $hostname; ?>iniciolinker.php?linkid=ASIS_4" target="_top">Reportes Generales</a></li>
	<li><a href="<?php echo $hostname; ?>iniciolinker.php?linkid=ASIS_6" target="_top">Reportes de Sistema</a></li>
	</ul>
</div>
<!-- FORMULARIO NO. 1 -->
<form id="form1" name="opciones_busqueda" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
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
                  <td class="letra_predeterminada"><label> Busqueda por:<br />
                    <input name="quien_busc" type="radio" id="check_filt1" value="pornoempleado" checked="checked" onclick="javascript: enableSelectSearch(2, false)" />
                    No De Usuario
                    <input name="noempleado" type="text" class="input_predeterminada" id="no_tarjeta" size="4" maxlength="4" />
                    <br />
                    <input type="radio" name="quien_busc" id="check_filt2" value="pornombreempleado" onclick="javascript: enableSelectSearch(2, false)" />
                  </label>
                    <label class="tipoletra"> Nombre
                      <input name="nempleado" type="text" class="input_predeterminada" id="nempleado" value="" />
                      <br />
                    </label>
                    <label>
                      <input type="radio" name="quien_busc" id="check_filt3" value="portodoslosemp" onclick="javascript: enableSelectSearch(2, true)" />
                      Todos los empleados <br />
                    </label></td>
                </tr>
                <tr id="2">
                  <td align="left" class="letra_predeterminada">De:<br />
                    <label>
                      <input type="radio" name="de_busc" id="check_filt7" checked="checked" value="todos" disabled="disabled" />
Todos
<input name="de_busc" type="radio" id="check_filt4" value="tienda" disabled="disabled" />
                    </label>
                    Tienda
                    <label>
                      <select name="sel_tienda" class="input_predeterminada" id="sel_tienda" disabled="disabled">
			
                  <?php

		echo '<option selected="selected">Elige una Oficina/Tienda</option>';

		$cols_arr     = array("idinmu", "nombreinmu");
    	$num_cols     = count($cols_arr);
		$tables_arr   = array("inmu_gdat");
		$order        = "nombreinmu";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
		while($row=mysql_fetch_row($result)) {
			echo '<option value="'.$row[0].'">'.$row[1].'</option>';
		}   // cierre de While

?>
                      </select>
                    </label>
                    <br />
                    <label>
                      <input type="radio" name="de_busc" id="check_filt5" value="razonsc" disabled="disabled" />
                    </label>
                    Razon Social
                    <label>
                      <select name="sel_razonsc" class="razonSelect" id="sel_razonsc" disabled="disabled" >
                        <?php


		echo '<option selected="selected">Elige una Razon Social</option>';

		// Definicion de los parametros de la consulta
		$cols_arr     = array("idfis", "razonsc");
    	$num_cols     = count($cols_arr);
		$tables_arr   = array("inmu_dfis");
		$order        = "razonsc";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

		while($row=mysql_fetch_row($result)) {
			echo '<option value="'.$row[0].'">'.$row[1].'</option>';
		}   // cierre de While

?>
                      </select>
                    </label>
                  <br /></td>
                </tr>
              </table></td>
              <td class="tblborder" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr id="3">
                        <td width="4%" valign="top"><input name="activa_tiempo" type="checkbox" id="activa_tiempo" value="on" onclick="javascript: enableTimeSearch(3, true)" /></td>
                        <td width="96%"><label>Cuando:<br />
                          <input name="cuando_busc" type="radio" id="check_filt6" value="hoy" checked="checked" disabled="disabled" />
                          hoy<br />
  <input name="cuando_busc" type="radio" id="check_filt9" value="eldia" disabled="disabled" />
                          el dia:
                          <span class="letra_busqueda">
                          <?php $clase = "boton_predeterminado"; $estado = "disabled"; escribe_formulario_fecha_vacio("taldia","opciones_busqueda",$dfechar1, $clase, $estado); ?></span> aaaa-mm-dd</label>
                          <br />
                          <label>
                            <input type="radio" name="cuando_busc" id="check_filt4" value="rango_fechas" disabled="disabled" />
                          </label>
entre el
                    
<span class="letra_busqueda">
<?php $clase = "boton_predeterminado"; $estado = "disabled"; escribe_formulario_fecha_vacio("fechainicio","opciones_busqueda",$dfechar1, $clase, $estado); ?>
</span>y <span class="letra_busqueda">
<?php $clase = "boton_predeterminado"; $estado = "disabled"; escribe_formulario_fecha_vacio("fechafin","opciones_busqueda",$dfechar1, $clase, $estado); ?>
</span>aaaa-mm-dd <br />
<label>
  <input type="radio" name="cuando_busc" id="check_filt5" value="mes_anio" disabled="disabled" />
  El mes
  <select name="sel_mes" class="input_predeterminada" id="sel_mes" disabled="disabled">
   
    <?php 
		
		$mesActual = date('m');

		$mesDelAnio = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		
		for ($i=0; $i <= 11; $i++) {
			
			if (strlen($i) == 1) {
				$impValor = '0'.($i+1);
			} else {
				$impValor = $i+1;
			}
			
			echo '<option value="'.$impValor.'"';
						
			if ($mesActual == ($i + 1)) {
				echo 'selected="selected" ';	
			}
			
			echo '>'.$mesDelAnio[$i].'</option>';
		}
	?>

  </select>
  
  Año
  <select name="sel_anio" class="input_predeterminada"id="sel_anio" disabled="disabled">
<?php 

//	echo "<option selected=\"selected\">Selecciona un año</option>";

	$anio_actual = date('Y'); 
	for ($anio = 3000; $anio >= 1900; $anio--) {
	   	if ($anio == $anio_actual) {
			echo '<option selected="selected" value="'.$anio.'"> '.$anio.'</option>';	
		} else {
			echo '<option value="'.$anio.'"> '.$anio.'</option>';
		}
	}

?>

  </select>
</label>
<input name="btBuscar" type="submit" class="boton_predeterminado" id="button2"  accesskey="u" tabindex="0" value="Buscar" />
<input name="btExportar" type="submit" class="boton_predeterminado" id="button" accesskey="E" tabindex="1" value="Exportar Reporte" /></td>
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
    <td width="130" align="center">Nombre </td>
    <td width="100" align="center">Tipo Empleado</td>
    <td width="180" align="center">Lugar Trabajo/Lugar Checada</td>
    <td width="120" align="center">Fecha/Hora</td>
    <td align="center">IP Remota/Hostname/Hosts</td>
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
