<?php
session_start();

mb_http_input("utf-8");
mb_http_output("utf-8");
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style3 
{
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 10px;
color: #FFFFFF
}

.style5 {color: #000000}

.tipoletra {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;		
}

.tipoletra2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;
}

.visitastabla {
	height: 180px;
	width: 950px;
}

.visitasdettabla {
	height: 180px;
	width: 950px;
}
.visitmarco {
	position: static;
	height: 180px;
	width: 100%;
	float: left;
}

.visitdetmarco {
	position: static;
	height: 180px;
	width: 100%;
	float: left;
}

.titulotabla {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #FFFFFF;
	left: 10px;
	position: static;
	padding: 0 0 0px 10px;
	
}
-->
</style>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css">
</head>

<body>
<br>
<br>
<h2>Ticket De Ayuda Soporte Técnico<br>
</h2>

<table class="visitastabla" align="center" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><table width="100%" border="1" cellpadding="0" cellspacing="0">
      <tr bgcolor="#CCCCCC">
        <th width="26" bgcolor="#0099CC" scope="col"><span class="style3">No. </span></th>
        <th width="166" bgcolor="#0099CC" scope="col"><span class="style3">Supervisor</span></th>
        <th width="166" bgcolor="#0099CC" scope="col"><span class="style3">Tienda</span></th>
        <th width="82" bgcolor="#0099CC" scope="col"><span class="style3">Tipo de Visita</span></th>
        <th width="249" bgcolor="#0099CC" scope="col"><span class="style3">Descripci&oacute;n</span></th>
        <th width="138" bgcolor="#0099CC" scope="col"><span class="style3">Fecha y Hora</span></th>
        <th bgcolor="#0099CC" scope="col"><span class="style3">Detalles</span></th>
        <!--    <th width="13%" scope="col"><span class="style5">Prioridad</span></th>
        <th width="14%" scope="col"><span class="style5">Leido</span></th> -->
      </tr>
      <!--      <tr bgcolor="#CCCCCC">
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
      </tr>
      <tr bgcolor="#CCCCCC">
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
      </tr> -->
    </table></th>
  </tr>
  <tr align="left" valign="top">
    <td><iframe class="visitmarco" name="ticketlist" title="ticketlist" marginheight="0" marginwidth="0" id="ticketlist" src="soporte_listatickets.php" hspace="0" frameborder="0" align="top" scrolling="yes"></iframe></td>
  </tr>
  <tr>
    <td><div align="left" class="style5">
      <table width="100%" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <th bgcolor="#0099CC" scope="col"><div align="left" class="titulotabla">Detalle de Visitas</div></th>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td><table class="visitasdettabla" width="100%" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <th width="80%" scope="col"><iframe name="ticketdet" title="ticketdet" class="visitdetmarco"  marginheight="0" marginwidth="0" id="ticketdet" <?php
					if (isset($_SESSION['idvisit'])) {
						$idvisit = $_SESSION['idvisit'];
						echo "src=\"inicio_visitdet.php?idv=$idvisit\"";
						unset($_SESSION['idvisit']);
					} else if (isset($_SESSION['muestradet'])) {
						switch ($_SESSION['muestradet']) {
							case "repvisit":
								echo "src=\"inicio_reportevisita.php\"";
								break;
						}
						unset($_SESSION['muestradet']);
					} else {	
						echo "src=\"soporte_ticketdet_ult3.php\"";
					}	
			   ?> hspace="0" frameborder="0" align="top" scrolling="no"></iframe></th>
        <th width="20%" scope="col"><div id="Accordion1" class="Accordion" tabindex="0">
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Ver Visitas</div>
            <div class="AccordionPanelContent">
            <br />
			<br />
            <br />
            <a href="inicio_listavisitas.php" target="visitlist">Ver todas las Visitas</a>
            <br />
			<a href="inicio_visitdet_ult3.php" target="visitdet">Ver las Ultimas 3 Visitas</a>
            <br />
            </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Buscar/Reporta Visita</div>
            <div class="AccordionPanelContent">
            <br />
            <br />
            <br />
	        <a href="inicio_buscvisit.php" target="visitdet">Opciones de Búsqueda</a>
			<br />
            <a href="inicio_reportevisita.php" target="visitdet">Reportar Visita</a>
            <br />
            </div>
          </div>
        </div>
        </th>
      </tr>
    </table></td>
  </tr>
</table>
<script type="text/javascript">
<!--
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
//-->
</script>
</body>
</html>
