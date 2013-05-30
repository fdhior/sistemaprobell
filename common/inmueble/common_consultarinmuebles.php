<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--


.frmConsultaInm {
	height: 387px;
	width: 788px;
	position: relative;
	border: 1px solid #000;
}


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

<?php
	session_start();
	$hostname    = $_SESSION['hostname'];
	
	$relpath = 'common/inmueble/';
	$target_link  = $hostname.$relpath.'common_consultainmueblelistado.php';
	$target_link2 = $hostname.$relpath.'common_consultainmuebledirectorio.php';

	$target_frame  = 'frmConsultaInm'; 
	$target_frame2 = "frmConsultaInmDirec";

?>

<script type="text/javascript">

            function toggle(sDivId) {
                var oDiv = document.getElementById(sDivId);
                oDiv.style.display = (oDiv.style.display == "none") ? "block" : "none";
            }
			
			function toggle_all() {
				toggle('divContent1');
				toggle('divContent2');
                var oDiv = document.getElementById("divContent3");
                oDiv.style.visibility = "visible";
			}
			
			function toggle_Content3() {
                var oDiv = document.getElementById("divContent2");
                oDiv.style.visibility = "visible";
                var oDiv = document.getElementById("divContent3");
                oDiv.style.visibility = "visible";
                var oDiv = document.getElementById("divContent4");
                oDiv.style.visibility = "hidden";
                var oDiv = document.getElementById("divContent5");
                oDiv.style.visibility = "hidden";

            }

			function toggle_Content4() {
                var oDiv = document.getElementById("divContent4");
                oDiv.style.visibility = "visible";
                var oDiv = document.getElementById("divContent3");
                oDiv.style.visibility = "hidden";
                var oDiv = document.getElementById("divContent2");
                oDiv.style.visibility = "hidden";
                var oDiv = document.getElementById("divContent5");
                oDiv.style.visibility = "visible";
            }

			
			function bscEnviaForma(idforma)
			{
				document.forms[idforma].submit();	
			}

        </script>

</head>


<body> <!--onload="toggle_all()"-->

<!-- iframe de lista usuarios -->
<br />
<h2>Consultar Información acerca de Inmuebles  Registrados</h2>



<div style="background-color: #00356A; color: white; font-weight: bold; padding: 5px; cursor: pointer; width: 164px; top: 10px; left: 25px; position: relative;"
            align="center">Modulos de Consulta</div>

<div style="border: 2px solid #00356A; height: 100px; padding: 10px; width: 150px; top: 9px; left: 25px; position: relative;"
             id="divContent1" align="center"><a href="#" onclick="toggle_Content3()"><span class="letramoduser_no_padd">Detalles de Tiendas</span></a><br />
          <a href="#" onclick="toggle_Content4()"><span class="letramoduser_no_padd">Directorio de Tiendas</span></a></div><br />

<div style="background-color: #00356A; color: white; font-weight: bold; padding: 5px; cursor: pointer; width: 164px; top: 10px; left: 26px; position: relative;"
             align="center">Opciones de busqueda</div>
<div style="border: 2px solid #00356A; height: 100px; padding: 10px; width: 150px; top: 228px; left: 36px; position: absolute;"
             id="divContent2" align="center">  Por No, de Tienda<br />
<!-- FORM 0 -->
<form action="<?php echo $target_link; ?>" method="post" name="form0" target="<?php echo $target_frame; ?>">
    <input name="idtienda" type="text" id="idtienda" size="5" maxlength="5" onchange="javascript:  bscEnviaForma(0)" />
	<input name="busca" type="hidden" value="poridtienda" />
</form>
  Por Nombre de Tienda<br />

<!-- FORM 1 -->
<form action="<?php echo $target_link; ?>" method="post" name="form1" target="<?php echo $target_frame; ?>">
	<input type="text" name="ntienda" id="ntienda" onchange="javascript:  bscEnviaForma(0)" />
	<input name="busca" type="hidden" value="pornombre" />
</form>
<br />
<button onclick="javascript: bscEnviaForma(4)">Mostrar Todas</button>
</div>


<div style="visibility: hidden; border: 2px solid #00356A; height: 100px; padding: 10px; width: 
150px; top: 228px; left: 36px; position: absolute;"
             id="divContent5" align="center">  Por No, de Tienda<br />

<!-- FORM 2 -->
<form action="<?php echo $target_link2; ?>" method="post" name="form0" target="<?php echo $target_frame2; ?>">
    <input name="idtienda" type="text" id="idtienda" size="5" maxlength="5" onchange="javascript:  bscEnviaForma(0)" />
	<input name="busca" type="hidden" value="poridtienda" />
</form>
  Por Nombre de Tienda<br />

<!-- FORM 3 -->
<form action="<?php echo $target_link2; ?>" method="post" name="form1" target="<?php echo $target_frame2; ?>">
	<input type="text" name="ntienda" id="ntienda" onchange="javascript:  bscEnviaForma(0)" />
	<input name="busca" type="hidden" value="pornombre" />
</form>
<br />
<button onclick="javascript:  bscEnviaForma(5)">Mostrar Todas</button>
</div>

<!-- FORM 4 -->
<form action="<?php echo $target_link; ?>" method="post" name="form2" target="<?php echo $target_frame; ?>">
</form>

<!-- FORM 5 -->
<form action="<?php echo $target_link2; ?>" method="post" name="form2" target="<?php echo $target_frame2; ?>">
</form>

<div id="divContent3" style="position: absolute; left: 219px; top: 48px;">
<table class="tblConsultaHeader" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33">No.</td>
    <td width="110">Nombre</td>
    <td width="150">Tipo Tienda</td>
    <td width="120">Encargado(a) </td>
    <td width="100">Status</td>
    <td width="150">Mapa Ubicación</td>
    <td>Inventario</td>
  </tr>
</table>

<iframe class="frmConsultaInm" name="frmConsultaInm" id="frmConsultaInm" src="<?php echo $target_link; ?>" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0"></iframe>
    
</div>  

<div id="divContent4" style="visibility: hidden; position: absolute; left: 219px; top: 48px;">
<table class="tblConsultaHeader" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33">No.</td>
    <td width="110">Tienda</td>
    <td width="120">RFC</td>
    <td with="353">Direccion</td>
    <td width="80">Zona</td>
    <td width="80">N&uacute;meros</td>
  </tr>
</table>

<iframe class="frmConsultaInm" name="frmConsultaInmDirec" id="frmConsultaInmDirec" src="<?php echo $target_link2; ?>" align="top" height="350" width="100%" frameborder="0" vspace="0" hspace="0" marginheight="0" marginwidth="0" scrolling="auto"></iframe>
</div>

</body>
</html>
