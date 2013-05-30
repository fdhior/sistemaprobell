<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<!-- <link href="http://probell.com.mx/sistemaprobell/sucursales/Stickman.MultiUpload.css" rel="stylesheet" type="text/css" /> -->
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css">
<!--
#apDiv1 {
        position:absolute;
        left:27px;
        top:30px;
        width:972px;
        height:290px;
        z-index:1;
        border: 1px solid #000000;
}

#apDiv2 {
        position:absolute;
        left:27px;
        top:330px;
        width:291px;
        height:131px;
        z-index:2;
        border: 1px solid #000000;
}

#apDiv3 {
        position:absolute;
        left:325px;
        top:330px;
        width:674px;
        height:131px;
        z-index:3;
        border: 1px solid #000000;
}

.letra_alertaestado {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #CC0000;

}
-->
</style>

<?php

        session_start();
        $hostname      = $_SESSION['hostname'];
        $loggeduser    = $_SESSION['compltusrname'];

//      $dest_almacen  = $_POST['dest_almacen'];

        if (isset($_POST['dest_act'])) {
                $dest_act = $_POST['dest_act'];
        }

        if ($dest_act == "20") {
               $inittras_dir  = $hostname.'tras_muebles/';
        } else {
               $inittras_dir  = $hostname.'tras_almacen/';
        }

        $seltras_dir   = $hostname.'tras_muebles/';
		
		$rel_path      = 'supervision/traslados/supervision_';

		$target_link   = $hostname.$rel_path.'enviartraslado.php';
        $target_frame  = "browser_frame";
        $target_frame2 = "trasenv_frame";


//      Mostrar los valores de _SESSION
/*      echo "Valores de _POST <br />";
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
                }
        } */

// echo "$dest_act";

?>

</head>

<body>
<div id="apDiv2">
  <table width="100%" border="0" cellspacing="5" cellpadding="0">
    <tr>
      <form id="form1" name="form1" method="post" action="<?php echo $inittras_dir; ?>adbrowser.php" target="<?php echo $target_frame; ?>">
      <td>
        <label>
          <div align="center">
            <input type="submit" name="button" id="button" value="Administra Traslados de CEDIS" onclick="javascript:envcedis()" />
            <input name="dest_almacen" type="hidden" id="dest_almacen" value="0" />
          </div>
        </label>      </td>
      </form>
    </tr>
    <tr>
          <form id="form2" name="form2" method="post" action="<?php echo $seltras_dir; ?>adbrowser.php" target="<?php echo $target_frame; ?>">
      <td>
        <label>
        <div align="center">
          <input type="submit" name="button2" id="button2" value="Administra Traslados de Muebles" onclick="javascript:envmuebles()" />
          <input name="dest_almacen" type="hidden" id="dest_almacen" value="20" />
        </div>
        </label>      </td>
      </form>
    </tr>
  </table>
</div>

<script> 

    function envcedis()
        {
                var newWindow;
                newWindow = window.open("<?php echo $target_link.'?dest_almacen=0'; ?>", "trasenv_frame", "width=250, height=250");
        }

    function envmuebles()

        {
                var newWindow;
                newWindow = window.open("<?php echo $target_link.'?dest_almacen=20'; ?>", "trasenv_frame", "width=250, height=250");
        }


</script>


<div id="apDiv3">
  <iframe width="100%" height="100%" name="trasenv_frame" id="trasenv_frame" src="<?php echo $target_link; ?>" vspace="0" hspace="0" marginheight="0" marginwidth="0" frameborder="0" align="top" scrolling="no"></iframe>
</div>


<p>
<h2><?php echo $loggeduser; ?>, Administra los Traslados enviados a Tienda de CEDIS o Muebles: </h2>
</p>
<div id="apDiv1">
  <iframe width="100%" height="100%" name="browser_frame" id="browser_frame" src="<?php echo $inittras_dir; ?>adbrowser.php" vspace="0" hspace="0" marginheight="0" marginwidth="0" frameborder="0" align="top" scrolling="yes"></iframe>
</div>

</body>
</html>

