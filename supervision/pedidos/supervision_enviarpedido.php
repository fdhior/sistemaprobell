<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<link href="../../sucursales/Stickman.MultiUpload.css" rel="stylesheet" type="text/css" />
<?php

        session_start();

		$rutafunciones = $_SESSION['rutafunciones'];
        include $rutafunciones.'consultas.php';
		
        $hostname     = $_SESSION['hostname'];
        $dest_almacen = $_GET['dest_almacen'];

        $rel_path     = 'supervision/pedidos/supervision_';
		$target_link  = $hostname.$rel_path.'pedidoenviar.php';


//  Mostrar los valores de _SESSION
/*      echo "Valores de _SESSION <br />";
        foreach ($_REQUEST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
                }
        } */


        if (isset($_SESSION['error_id'])) {
                $errorpass = $_SESSION['errorpass'];
                $error_id  = $_SESSION['error_id'];
                $destino   = $_SESSION['destino'];
                $mensaje   = $_SESSION['mensaje'];
    }
        unset($_SESSION['errorpass']);
        unset($_SESSION['error_id']);
        unset($_SESSION['destino']);
        unset($_SESSION['mensaje']);

?>

<script src="<?php echo $hostname; ?>sucursales/mootools-1.2.4-core-nc.js"></script>
<script src="<?php echo $hostname; ?>sucursales/Stickman.MultiUpload.js"></script>

<script type="text/javascript">
                window.addEvent('domready', function(){
                        new MultiUpload( $( 'multiped_form' ).use_settings, 4, '[{id}]', true, true );
                });
</script>
</head>

<body>
<form action="<?php echo $target_link; ?>" method="post" enctype="multipart/form-data" id="multiped_form" target="_self">
  <table width="100%" border="0" cellspacing="5" cellpadding="0">
    <tr>
      <td width="14%" valign="top"><p>Enviar Pedido(s) (Maximo 4)<br />
          <input class="letra_boton11" type="file" name="use_settings" />
          <br />
          <br />
      </p>
        </td>
      <td width="86%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
            <tr>
              <td><label>Almacen Destino: 
                                <?php
                                        if (!isset($dest_almacen)) {
                                                echo "CEDIS";
                                                $destino = "CEDIS";
                                        } else {
                                                switch ($dest_almacen) {
                                                        case "CEDIS":
                                                                echo "$dest_almacen";
                                                                break;
                                                        case "Muebles":
                                                                echo "$dest_almacen";
                                                                break;
                                                }
                                                $destino = $dest_almacen;
                                        }
                                ?>
                  <input type="hidden" name="destino" id="destino" value="<?php echo $destino; ?>" />                                
                </label></td>
              <td align="center"><span class="parrafo-4">
                <input class="letra_boton11" type="submit" name="button3" id="button3" value="Enviar Pedido" />
              </span></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><p>Agrega un Mensaje<span class="parrafo-4">
             </span><span class="letra_alertaestado">
             <?php
                                if ($error_id == "0" or $error_id == "1") {
                                        echo "<span class=\"letra_alertaestado\"><strong>Error: $errorpass</strong></span>";
                                }
                                ?>
             </span><br />
            <span class="parrafo-4">
              <textarea name="mensaje" id="mensaje" cols="45" rows="3"><?php
                                                                                                                                                        if (isset($error_id)) {
                                                                                                                                                                echo "$mensaje";
                                                                                                                                                        } else {
                                                                                                                                                                echo "Predeterminado";
                                                                                                                                                        }
                                                                                                                                        ?></textarea>
            </span></p></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>

</body>
</html>
