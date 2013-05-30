<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.moduser_frame {
 	position: relative;
    width: 968px;
    height: 150px;
	left: 26px;
	border: 1px solid #000;
}

.modify_frame {
    position: relative;
    width: 968px;
    height: 220px;
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
		
        include $_SESSION['rutafunciones'].'consultas.php';

        $hostname      = $_SESSION['hostname'];
        $target_link   = "administracion/cursos/cursos_cursoslistadoconsulta.php";
    $target_link2  = "administracion/cursos/cursos_modificacurso.php";
        $target_frame  = "moduser_frame"; 
        $target_frame2 = "modify_frame";

        unset($_SESSION['modobusqueda']);

?>

<body onload="javascript: cursosactivos()">

<!-- iframe de lista usuarios -->
<br />
<h2>Consultar Información de  Cursos Dados de Alta</h2>
<div style="position:relative; left: 26px;">
<table class="tblHeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33" align="center">No.</td>
    <td width="110" align="center"> Tienda</td>
    <td width="150" align="center">Curso</td>
    <td width="100" align="center">Línea</td>
    <td width="100" align="center">T&eacute;cnico(a)</td>
    <td width="110" align="center">A Realizarse</td>
    <td width="110" align="center">Fecha Alta</td>
    <td width="110" align="center">Cancelado en</td>
    <td align="center">Ultima Moficaci&oacute;n</td>
  </tr>
</table>
</div>


<iframe class="moduser_frame" name="moduser_frame" id="moduser_frame" src="" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0"></iframe>

<table class="tablamoduser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="120" class="letra_predeterminada"><label>
      <input name="sel_tcurso" type="radio" id="radio" value="activos" checked="checked" onclick="javascript: cursosactivos()" />
    </label>
    Cursos Activos</td>
    <td width="152" class="letra_predeterminada"><label>
    <input  name="sel_tcurso" type="radio" id="radio3" value="cancelados" onclick="javascript: cursosyarealizados()" /></label>
    Cursos ya realizados</td>
    <td width="701" class="letra_predeterminada"><label>
      <input  name="sel_tcurso" type="radio" id="radio2" value="realizados" onclick="javascript: cursoscancelados()" />
    </label>
    Cursos Cancelados</td>

    <!-- FORMULARIO NO. 0 -->
    <form id="form0" name="form0" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
    </form>
                <!-- FORMULARIO NO. 1 -->
      <form id="form1" name="form1" method="post" action="<?php echo "$hostname$target_link"; ?>" target="<?php echo "$target_frame"; ?>">
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

<!-- FORMULARIO NO. 5 -->
<form id="form5" name="form5" method="post" action="<?php echo "$hostname$target_link2"; ?>" target="<?php echo "$target_frame2"; ?>">
  <input name="modificar" type="hidden" id="sel_tcurso" value="opbusqueda" />
</form>

<script language="javascript">
//                window.alert("Revisa el resultado de la transferencia.");
        function cursosactivos()
        {
                document.forms[2].submit();
                document.forms[5].submit();
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

</script>

<br />
<iframe class="modify_frame" name="modify_frame" id="modify_frame" src="" align="left" hspace="0" vspace="0" frameborder="0" scrolling="No" marginheight="0" marginwidth="0"></iframe>
<p>&nbsp;</p>

</body>

</html>
