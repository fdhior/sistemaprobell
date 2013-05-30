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


-->
</style>

<?php

        session_start();
        $hostname    = $_SESSION['hostname'];
        $loggeduser  = $_SESSION['compltusrname'];

/*      if (isset($_POST['dest_act'])) {
                $dest_act = $_POST['dest_act'];
        }

        if ($dest_act == "Muebles") {
                $initped_dir  = "entradapedidos/muebles/";
        } else {
                $initped_dir  = "entradapedidos/almacen/";
        }

        $selped_dir    = "entradapedidos/muebles/";
        $target_frame  = "browser_frame";
        $target_frame2 = "pedenv_frame";
        $target_link   = "sistemaprobell/supervision/pedidos/supervision_enviarpedido.php"; */



        if (isset($_POST['dest_act'])) {
                $dest_act = $_POST['dest_act'];
        }

        if ($dest_act == "Muebles") {
                $initped_dir = "entradapedidos/muebles/";
        } else {
                $initped_dir = "entradapedidos/almacen/";
        }

        $selped_dir    = "entradapedidos/muebles/";
        $target_frame  = "browser_frame";
        $target_frame2 = "pedenv_frame";
        $target_link   = "supervision/pedidos/supervision_enviarpedido.php";


//  Mostrar los valores de _SESSION
/*      echo "Valores de _SESSION <br />";
        foreach ($_REQUEST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
                }
        } */



?>

</head>

<body>
<div id="apDiv2">
  <table width="100%" border="0" cellspacing="5" cellpadding="0">
    <tr>
      <form id="form1" name="form1" method="post" action="<?php echo $hostname.$initped_dir; ?>adbrowser.php" target="<?php echo $target_frame; ?>">
      <td>
        <label>
          <input class="letra_boton12" type="submit" name="button" id="button" value="Administra Pedidos de CEDIS" onclick="javascript:envcedis()" />
          </label>
      </td>
      </form>
    </tr>
    <tr>
          <form id="form2" name="form2" method="post" action="<?php echo $hostname.$selped_dir; ?>adbrowser.php" target="<?php echo $target_frame; ?>">
      <td>
        <label>
        <input class="letra_boton12" type="submit" name="button2" id="button2" value="Administra Pedidos de Muebles" onclick="javascript:envmuebles()" />
          </label>
      </td>
      </form>
    </tr>
  </table>
</div> <!-- Fin de Div2 -->

<script>

    function envcedis()
        {
                var newWindow;
                newWindow = window.open("<?php echo "$hostname$target_link?dest_almacen=CEDIS"; ?>", "<?php echo $target_frame2; ?>", "width=250, height=250");
        }

    function envmuebles()

        {
                var newWindow;
                newWindow = window.open("<?php echo "$hostname$target_link?dest_almacen=Muebles"; ?>", "<?php echo $target_frame2; ?>", "width=250, height=250");
        }


</script>

<div id="apDiv3">
  <iframe width="100%" height="100%" name="pedenv_frame" id="pedenv_frame" src="<?php echo "$hostname$target_link"; ?>" vspace="0" hspace="0" marginheight="0" marginwidth="0" frameborder="0" align="top" scrolling="no"></iframe>
</div>


<p>
<h2><?php echo "$loggeduser"; ?>, Administra los pedidos enviados a CEDIS o Muebles: </h2>
</p>
<div id="apDiv1">
  <iframe width="100%" height="100%" name="browser_frame" id="browser_frame" src="<?php echo "$hostname$initped_dir"; ?>adbrowser.php" vspace="0" hspace="0" marginheight="0" marginwidth="0" frameborder="0" align="top" scrolling="yes"></iframe>
</div>

</body>
</html>

