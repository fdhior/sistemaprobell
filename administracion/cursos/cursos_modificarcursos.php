<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.frmModCursos {
	position: relative;
    width: 970px;
    height: 150px;
	left: 26px;
	border: 1px solid #000;
}


.frmModOpciones {
	position: relative;
    width: 968px;
    height: 200px;
	left: 26px;
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
-->
</style>
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php

	session_start();
	
	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';

	$hostname      = $_SESSION['hostname'];
	$target_link   = "administracion/cursos/cursos_cursoslistado.php";
    $target_link2  = "administracion/cursos/cursos_modificacurso.php";
	$target_frame  = "moduser_frame"; 
	$target_frame2 = "modify_frame";

	unset($_SESSION['modobusqueda']);

?>

<body onload="javascript: cursosactivos()">

<!-- iframe de lista usuarios -->
<br />
<h2>Modificar Propiedades de Cursos Dados de Alta</h2>
<div style="position:relative; left: 26px;">
<table class="tblHeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33" align="center">No.</td>
    <td width="110" align="center"> Tienda</td>
    <td width="150" align="center">Curso</td>
    <td width="100" align="center">Línea</td>
    <td width="140" align="center">Fecha/Hora </td>
    <td width="130" align="center">Estado</td>
    <td align="center">Opciones</td>
  </tr>
</table>
</div>

<iframe class="frmModCursos" name="moduser_frame" id="moduser_frame" src="" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0"></iframe>
	
<table class="tablamoduser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="113" class="letramoduser_no_padd"><label>
      <input name="sel_tcurso" type="radio" id="radio" value="activos" checked="checked" onclick="javascript: cursosactivos()" />
    </label>
    Cursos Activos</td>
    <td width="168" class="letramoduser_no_padd"><label>
      <input  name="sel_tcurso" type="radio" id="radio2" value="realizados" onclick="javascript: cursoscancelados()" />
    </label>
    Cursos Cancelados</td>
    <!-- FORMULARIO NO. 0 -->
    <form id="form0" name="form0" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
    <td width="315" class="letramoduser_no_padd">Busqueda por Tienda:
<label>
          <select name="sel_tienda" id="sel_tienda" onchange="javascript: buscaportienda()">
         
<?php

		$cols_arr     = array("idinmu", "nombreinmu");
    	$num_cols     = count($cols_arr);
		$tables_arr   = array("inmu_gdat");
	  	$where_clause = "idinmutipo <> 5 AND idinmutipo <> 6 AND idinmustat = 1";
		$order 		  = "nombreinmu";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
//    $row=mysql_fetch_row($result);
	
		while($row=mysql_fetch_row($result)) {
			echo "<option value=\"$row[0]\">$row[1]</option>";
		}   // cierre de While

?>
        </select>
        </label>
    <input type="hidden" name="busca" id="busca" value="portienda" /></td>
    </form>
		<!-- FORMULARIO NO. 1 -->
      <form id="form1" name="form1" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
    <td width="220" class="letramoduser_no_padd">Busqueda por folio:
<label>
          <input name="folio" type="text" id="folio" size="3" maxlength="3" onchange="javascript: buscaporfolio()"/>
          <input name="busca" type="hidden" id="busca" value="porfolio" />
        </label>    </td>
    </form>

  <!--    <td width="662" class="letramoduser_no_padd"><label>
      <input type="radio" name="sel_tcurso" id="radio3" value="elimn" onclick="javascript: usuarioseliminados()" />
    </label>
    Tiendas Eliminadas</td>
-->  </tr>
</table>
<!-- FORMULARIO NO. 2 -->
<form id="form2" name="form2" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
  <input name="sel_tcurso" type="hidden" id="sel_tcurso" value="activos" />
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->

<!-- FORMULARIO NO. 3 -->
<form id="form3" name="form3" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
  <input name="sel_tcurso" type="hidden" id="sel_tcurso" value="cancelados" />
</form>

<!-- FORMULARIO NO. 4 -->
<form id="form4" name="form4" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
  <input name="sel_tcurso" type="hidden" id="sel_tcurso" value="realizados" />
</form>

<script language="javascript">
//                window.alert("Revisa el resultado de la transferencia.");
	function cursosactivos()
	{
		document.forms[2].submit();
	}
	
	function cursoscancelados()
	{
		document.forms[3].submit();
	}

	function cursosyarealizados()
	{
		document.forms[4].submit();
	}
	
	function buscaportienda()
	{
		document.forms[0].submit();
	}
	
	function buscaporfolio()
	{
		document.forms[1].submit();
	}


/*	function usuarioseliminados()
	{
		document.forms[2].submit();
	}*/
	
</script>

<br />

<iframe class="frmModOpciones" name="modify_frame" id="modify_frame" src="<?php echo "$hostname$target_link2"; ?>" align="left" hspace="0" vspace="0" frameborder="0" scrolling="No" marginheight="0" marginwidth="0"></iframe>

<p>&nbsp;</p>

</body>

</html>
