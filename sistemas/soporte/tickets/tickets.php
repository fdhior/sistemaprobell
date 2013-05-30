<?php
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
.tipoletrasmbold {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	font-weight: bold;
	font-variant: small-caps;
}

.tipoletrasmnormal {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: bold;
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
<?php
	session_start();
	$idusrarea = $_SESSION['idusrarea'];
?>

<br>
<br>
<h2>Detalle Solicitudes de Soporte para el Area: <?php echo "$idusrarea"; ?><br>
</h2>
<table class="visitastabla" align="center" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><table width="100%" border="1" cellpadding="0" cellspacing="0">
      <tr bgcolor="#CCCCCC">
        <th width="26" bgcolor="#0099CC" scope="col"><span class="style3">No.</span></th>
        <th width="73" bgcolor="#0099CC" scope="col"><span class="style3">Prioridad</span></th>
        <th width="145" bgcolor="#0099CC" scope="col"><span class="style3">Pendiente En</span></th>
<!--	<th width="54" bgcolor="#0099CC" scope="col"><span class="style3">Tipo</span></th> -->
        <th width="278" bgcolor="#0099CC" scope="col"><span class="style3">Descripci&oacute;n</span></th>
        <th width="128" bgcolor="#0099CC" scope="col"><span class="style3">Fecha de Alta</span></th>
        <th width="128" bgcolor="#0099CC" scope="col"><span class="style3">Concluido En</span></th>
        <th width="91" bgcolor="#0099CC" scope="col"><span class="style3">Seguimiento</span></th>
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
    <td><iframe class="visitmarco" name="pendlist" title="pendlist" marginheight="0" marginwidth="0" id="pendlist" src="sistemas/soporte/tickets/tickets_lista.php" hspace="0" frameborder="0" align="top" scrolling="yes"></iframe></td>
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
        <th width="80%" scope="col"><iframe name="penddet" title="penddet" class="visitdetmarco"  marginheight="0" marginwidth="0" id="penddet" <?php
					$relative_path = "sistemas/soporte/tickets";
					if (isset($_SESSION['idpend'])) {
						$idpend = $_SESSION['idpend'];
						echo "src=\"$relative_path/tickets_detalle.php?idp=$idpend\"";
						unset($_SESSION['idpend']);
					} else if (isset($_SESSION['agrpend'])) {
						$agrpend = $_SESSION['agrpend'];
						echo "src=\"$relative_path/tickets_agrega.php\"";
						unset($_SESSION['agrpend']);
					} else if (isset($_SESSION['muestradet'])) {
						switch ($_SESSION['muestradet']) {
							case "modseg":
								echo "src=\"$relative_path/inicio_modpend.php?modo=modseg\"";
								break;
						}
						unset($_SESSION['muestradet']);
					} else {	
						echo "src=\"$relative_path/tickets_detalle_ult3.php\"";
					}	
			   ?> hspace="0" frameborder="0" align="top" scrolling="no"></iframe></th>
        <th width="20%" scope="col"><div id="Accordion1" class="Accordion" tabindex="3">
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Mostrar Tickets</div>
            <div class="AccordionPanelContent">
	            <br /><br /><br />                
				<a href="sistemas/soporte/tickets/tickets_lista.php?muestra=urgentes" target="pendlist">S&oacute;lo Urgentes</a>
                <br />
                <a href="sistemas/soporte/tickets/tickets_lista.php?muestra=activos" target="pendlist">Todos los Activos</a>
                <br />
                <a href="sistemas/soporte/tickets/tickets_lista.php?muestra=concluidos" target="pendlist">Concluidos</a>
                <br />
				<a href="sistemas/soporte/tickets/tickets_detalle_ult3.php" target="penddet">Ver Ultimos 3</a>            </div>
          </div>
          <div class="AccordionPanel">
            <div class="AccordionPanelTab">Buscar Tickets</div>
            <div class="AccordionPanelContent"> <br />
                <br />
              <br />
              <br />
                <a href="sistemas/soporte/tickets/tickets_busqueda.php?modo=activos" target="penddet">En Tickets Activos</a> <br />
                <a href="sistemas/soporte/tickets/tickets_busqueda.php?modo=concluidos" target="penddet">En Tickets Concluidos</a> <br />
                <br />
            </div>
          </div>
                   <div class="AccordionPanel">
                     <div class="AccordionPanelTab">Agregar/Modificar Pendientes</div>
                     <div class="AccordionPanelContent"> <br />
                         <br />
                         <br />
                         <a href="inicio_agrpend.php" target="penddet">Agregar Pendiente</a> <br />
                         <a href="inicio_modpend.php?modo=modseg" target="penddet">Modificar Seguimiento</a> <br />
                         <a href="inicio_modpend.php?modo=modprio" target="penddet">Cambiar Prioridad</a> <br />
                         <a href="inicio_modpend.php?modo=modconcl" target="penddet">Concluir Pendiente</a> </div>
                   </div>
        </div></th>
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
