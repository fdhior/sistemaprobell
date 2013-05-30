<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<link href="../Stickman.MultiUpload.css" rel="stylesheet" type="text/css" />

<style type="text/css">

.pedlayout_panel1 {
        position: absolute;
        width: 1024px;
}

#apDiv1 {
        position:absolute;
        left:27px;
        top:30px;
        width:442px;
        height:19px;
        z-index:1;
}
#apDiv2 {
        position:absolute;
        left:493px;
        top:30px;
        width:442px;
        height:196px;
        z-index:2;
}
#apDiv3 {
        position:absolute;
        left:304px;
        top:78px;
        width:165px;
        height:45px;
        z-index:3;
}

.letra_alertaestado {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #CC0000;

}


</style>
<?php
        session_start();
		
        $hostname    = $_SESSION['hostname'];
        $userinmuid  = $_SESSION['userinmuid'];
        $userespname = $_SESSION['userespname'];
        $loggeduser  = $_SESSION['compltusrname'];
        $idusrarea   = $_SESSION['idusrarea'];
        $tipousr     = $_SESSION['tipousr'];
        $iduser      = $_SESSION['iduser'];

        // Mostrar los valores de _POST
/*      echo "Valores de _SERVER <br />";
        foreach ($_SERVER as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
                }
        } */

/*      echo "<span class=\"tipoletra\">Valores de _SESSION</span><br />";
        foreach ($_SESSION as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />";
                }
        } */


        if (isset($_SESSION['error_id'])) {
                $errorpass = $_SESSION['errorpass'];
                $error_id = $_SESSION['error_id'];
                $destino = $_SESSION['destino'];
                $mensaje = $_SESSION['mensaje'];
    }
        unset($_SESSION['errorpass']);
        unset($_SESSION['error_id']);
        unset($_SESSION['destino']);

        unset($_SESSION['mensaje']);
?>
<script type="text/javascript" src="../mootools-1.2.4-core-nc.js"></script>
<script type="text/javascript" src="../Stickman.MultiUpload.js"></script>
<script type="text/javascript">
                window.addEvent('domready', function(){
                        // Use defaults: no limit, use default element name suffix, don't remove path from file name
//                      new MultiUpload( $( 'main_form' ).defaults );
                        // Max 3 files, use '[{id}]' as element name suffix, remove path from file name, remove extra elemen
                        new MultiUpload( $( 'multiped_form' ).use_settings, 18, '[{id}]', true, true );
                });
</script>
</head>

<body>
<p>
<h2><?php echo "$loggeduser $userespname"; ?>,  Envia tu pedido a CEDIS o Muebles: </h2>
</p>


<div id="apDiv3"><span class="parrafo-4">Puedes Eliminar un archivo dando clic en la <img src="../../images/cross_small.gif" width="12" height="10" /></span></div>
<form action="sucursales_pedidoenviar.php" method="post" enctype="multipart/form-data" id="multiped_form" target="ped_frame">
<div id="apDiv1">
  <p class="parrafo-4">Selecciona el pedidos o los pedidos que quieras enviar de tu carpeta PEDIDOS (Se puede elegir m&aacute;s de 1): <?php
                if ($error_id == "0") {
                        echo '<span class="letra_alertaestado">Error: $errorpass</span>';
                }
                ?>
  <br />        
  <input type="file" name="use_settings" /></p>
  <br />
</div>

<div id="apDiv2">
  <p class="parrafo-4">Elige Un Almacen Destino:</p>
  <p>
    <label>
    <select name="destino" id="destino">
    <option>Elige un Almacen</option>

<?php
        if (isset($destino) and $destino <> "Elige un Almacen") {
                echo '<option selected=\"selected\">$destino</option>';
                switch ($destino) {
                        case "CEDIS":
                                $opt2 = "Muebles";
                                break;
                        case "Muebles":
                                $opt2 = "CEDIS";
                                break;
                }                       
                echo "<option>$opt2</option>";
        } else {
?>      
      <option>Muebles</option>
      <option>CEDIS</option>
<?php
        } // Cierre de else
?>

    </select>
    </label>
    <label class="letra_alertaestado"><?php
                                if ($error_id == "1") {
                                        echo "<strong>Error: $errorpass</strong>";
                                }
                                ?></label>
  </p>
  <p><span class="parrafo-4">Agrega un mensaje a tu pedido (observaciones, comentarios adicionales etc): <br />
          <?php         
                if ($error_id == "2") {
                        echo "<span class=\"letra_alertaestado\">Error: $errorpass</span>";
                }
                ?>
      <textarea name="mensaje" id="mensaje" cols="45" rows="5"><?php echo "$mensaje"; ?></textarea>
        </span><br />
      <span class="parrafo-4">Nota: Agregar El mensaje es opcional
      <br />
      <input type="submit" name="button" id="button" value="Enviar Pedido" />
      </span></p>
</div>
</form>

</body>
</html>

