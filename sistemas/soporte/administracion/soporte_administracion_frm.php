<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
#apDiv1 {
	position:absolute;
	left:239px;
	top:43px;
	width:94px;
	height:18px;
	z-index:1;
	border-top-style: dotted;
	border-right-style: dotted;
	border-bottom-style: dotted;
	border-left-style: dotted;
}

.letraencabezado {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;		
}
-->
</style>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>

<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
-->
</style>
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style7 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-style: normal;
	font-weight: normal;
}

-->
</style>
</head>

<body>
<br />
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Aministrar Visitas</li>
    <li class="TabbedPanelsTab" tabindex="0">Administrar Pendientes</li>
    <li class="TabbedPanelsTab" tabindex="0">Administrar Rutas</li>
    <li class="TabbedPanelsTab" tabindex="0">Administrar Archivos</li>
    <li class="TabbedPanelsTab" tabindex="0">Administrar Reportes</li>
  </ul>
  <div class="TabbedPanelsContentGroup"> <!-- Inicio DIV --> 
    <div class="TabbedPanelsContent"> <!-- INICIA PRIMER TAB -->
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top" width="76%" scope="col"><!-- IFRAME MUESTRA ACCCIONES (VISITAS) --><iframe align="top" width="100%" height="100%" frameborder="0" vspace="0" hspace="0" marginheight="0" marginwidth="0" src="inicio_adintro.php" name="muestra_acciones" title="muestra_acciones" scrolling="no"></iframe>
          <!-- FIN IFRAME--></td>
          <td width="24%" scope="col"><div id="Accordion1" class="Accordion" tabindex="0">
            <div class="AccordionPanel">
              <div class="AccordionPanelTab">
                <div align="center" class="style1">Listar/Buscar Visitas</div>
              </div>
              <div class="AccordionPanelContent" align="center">
			  <br />
                  <span class="style7"><a href="inicio_adintro.php"	target="muestra_acciones">Guia</a></span><br /> 
                  <span class="style7"><a href="inicio_administracion_frm2.php" target="muestra_cambios">Listar todas las visitas</a></span><br />
                  <span class="style7"><a href="inicio_buscvisitext.php" target="muestra_acciones">Buscar Visitas</a></span><br />
                  <span class="style7"><a href="inicio_admin_sprv.php" target="muestra_cambios">Listar Supervisores</a></span><br />
              <br />
              </div>
            </div>
            <div class="AccordionPanel">
              <div class="AccordionPanelTab">
                <div align="center" class="style1">Editar/Eliminar Visitar</div>
              </div>
              <div align="center" class="style2 AccordionPanelContent">Content 2</div>
            </div>
          </div></td>
        </tr>
      </table>
        <table width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <td><!-- IFRAME MUESTRA CAMBIOS (VISITAS) --><iframe src="inicio_administracion_frm2.php" name="muestra_cambios" width="100%" marginwidth="0" height="200" marginheight="0" align="middle" scrolling="no" frameborder="0" hspace="0" vspace="0" id="muestra_cambios" title="muestra_cambios" ></iframe>
            <!-- FIN IFRAME --></td>
          </tr>
      </table>
    </div>
    <!-- TERMINA PRIMER TAB -->
    <div class="TabbedPanelsContent"><!-- INICIA SEGUNDO TAB -->
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top" width="76%" scope="col"><!-- IFRAME MUESTRA ACC PEND --><iframe align="top" width="100%" height="100%" frameborder="0" vspace="0" hspace="0" marginheight="0" marginwidth="0" src="inicio_adminpendguia.php" name="muestra_acc_pend" title="muestra_acc_pend" scrolling="no"></iframe>
          <!-- FIN IFRAME --></td>
          <td width="24%" scope="col"><div id="Accordion2" class="Accordion" tabindex="0">
            <div class="AccordionPanel">
              <div class="AccordionPanelTab">
              	<div align="center" class="style1">Listar/Buscar Pendientes</div>
              </div>
              <div class="AccordionPanelContent" align="center">
			  <br />
                  <span class="style7"><a href="inicio_adminpendguia.php"	target="muestra_acc_pend">Guia</a></span><br /> 
                  <span class="style7"><a href="inicio_adminpendlista.php" target="muestra_camb_pend">Listar todos los pendientes</a></span><br />
                  <span class="style7"><a href="inicio_adminbuscpend.php" target="muestra_camb_pend">Buscar Pendientes</a></span><br />
                  <span class="style7"><a href="inicio_adminresppend.php" target="muestra_camb_pend">Tiempo de Respuesta</a></span><br />
              <br />
              </div>
            </div>
            <div class="AccordionPanel">
              <div class="AccordionPanelTab">
              	<div align="center" class="style1">Modificar/Eliminar Pendientes</div>
               </div>  
              <div class="AccordionPanelContent">Content 2</div>
            </div>
          </div></td>
        </tr>
      </table>
        <table width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <td><!-- IFRAME MUESTRA CAMB PEND --><iframe src="inicio_adminpendlista.php" name="muestra_camb_pend" width="100%" marginwidth="0" height="200" marginheight="0" align="middle" scrolling="no" frameborder="0" hspace="0" vspace="0" title="muestra_camb_pend" ></iframe>
            <!-- FIN IFRAME --></td>
          </tr>
      </table>
    </div><!-- TERMINA SEGUNDO TAB--> 
    <div class="TabbedPanelsContent"><!-- INICIA EL TERCER TAB -->Content 3</div><!-- TERMINA EL TERCER TAB  -->
    <div class="TabbedPanelsContent"><!-- INICIA EL CUARTO TAB -->Content 4</div><!-- TERMINA EL CUARTO TAB -->
    <div class="TabbedPanelsContent"><!-- INICIA EL QUINTO TAB -->Content 5</div><!-- TERMINA EL QUINTO TAB -->
 </div> 
</div>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
var Accordion2 = new Spry.Widget.Accordion("Accordion2");
//-->
</script>
</body>
</html>
