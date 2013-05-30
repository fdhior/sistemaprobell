<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SISTEMA EN LINEA DE TRABAJO EN GRUPO - PROBELL</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

        // Se inicia la sesion
        session_start();

        // Checa que la sesión sea valida si no te regresa al inicio
        if (!isset($_SESSION['authorizedUser'])) {
                header('Location: login.php');
                exit;
        }

        $hostname    = $_SESSION['hostname'];
		$target_link = $hostname.''; 

?>

<style type="text/css">
<!--
.style3 {font-size: 10px; font-weight: bold; }
-->
</style>

<!-- USAR JAVASCRIPT PARA ESCONDER LAS DIRECCIONES AL PASAR EL MOUSE SOBRE LOS ENLACES --> 
<script>

//Hide status bar msg script- by javascriptkit.com
//Visit JavaScript Kit (http://javascriptkit.com) for script
//Credit must stay intact for use

//configure status message to show
var statusmsg="(C) PROBELL SISTEMAS 2010 Ver. 1.0"

function hidestatus(){
window.status=statusmsg
return true
}
</script>
  
<!-- STYLE SHEET -->
        
        <link rel="stylesheet" type="text/css" href="css/sistemaprobell.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $hostname; ?>sucursales/Stickman.MultiUpload.css" />
</head>
<body>

<!-- <div style="Z-INDEX: 100; POSITION: absolute; DISPLAY: none" id=loading> -->
<div>
<div id=pagewrapid class=pagewrap>
<div class="topline">
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td class="topline-left-td"><!--LOGO PROBELL -->
          <div class="logo_pos" align="center"></div>
        <img src="images/probell logo final.gif" width="428" height="110" /></td>
      <td class="topline-right-td"><div class="language3">
          <div class="titulotexto" align="center">Sistema En L&iacute;nea de Trabajo En Grupo Probell - <a href="logout.php">Cerrar Sesi&oacute;n</a></div>
      </div>
          <!-- AQUI SE INSERTA EL CODIGO PHP -->

<?php


include 'sidemenu.php';
selectmenu($_SESSION['itnum'], $_SESSION['subitnum']);

?>

      </td>
    </tr>
  </table>
</div>
				       
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td bgcolor="#FFFFFF"><?php

        // Constructor de página unico
//      if ($_SESSION['init'] == "sucursales_resumen") {
	
	
		// Mostrar los valores de _POST
	    /*echo "Valores de _SESSION <br />";
		foreach ($_SESSION as $nombre => $valor) {
    		if(stristr($nombre, 'button') === FALSE) {
				print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
        	}
		} 
    
	    print_r($_SESSION['permisos']);*/
		switch ($_SESSION['in_frame']) {
                case "0":
                        include ($_SESSION['file_path']."/".$_SESSION['init'].".php"); 
                        break;
                case "1":
?>

                <iframe class="ped_iframe" name="ped_frame" id="ped_frame" title="ped_frame" align="top" frameborder="0" hspace="0" vspace="0" height="100%" width="100%"
                src="<?php echo $_SESSION['file_path'].'/'.$_SESSION['init'].'.php'; ?>" scrolling="no"></iframe>
                
<?php                

                        break;
        } 

?>

                    
                    
                    
                    </td>
                  </tr>
                </table>
</div>
<!-- Se Cierra la "caja" que contiene a la página -->

</div>

</body>
</html>
