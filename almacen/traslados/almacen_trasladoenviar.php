<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.letra_envped {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        left: 25px;
        position: relative;
}

.letra_tablaenvped {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
}

.letra_alertaestado {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #CC0000;
        font-weight: bold;
}
-->



</style>
<?php

        /**************************************************************************************/
        /* Muestra un informe con los resultados de procesamiento de los archivos de la lista */
        /**************************************************************************************/

        session_start();
        
		$userespname = $_SESSION['userespname'];
        $loggeduser = $_SESSION['compltusrname'];
        $userinmuid = $_SESSION['userinmuid'];
        
//      print_r ($_SESSION['upload_log']);
        
/*      echo "<span class=\"tipoletra\">Valores de _POST</span><br />";
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
                }
        } */

        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        ${$nombre} =  $valor;
                }
        } // Cierre foreach     


        // Verificar la informacion enviada
/*      if (!isset($_FILES['use_settings'])) {
                $error = "Debes agregar al menos un Traslado";
                $error_id = "0";
        } // else {      */     
        
/*              if ($destino == 'Elige un Almacen') {
                        $error = "Elije el almac&eacute;n al que enviar&aacute;s el pedido";
                        $error_id = "1";
                } else {        

                        if ($mensaje == '') {
                                $error = "Teclea un mensaje adicional al pedido (teclea: Ninguno al menos)";
                                $error_id = "2";
                        }
                }       
        }       */
        

/*      if (isset($error)) {
                $_SESSION['errorpass'] = $error;
                $_SESSION['error_id'] = $error_id;
//              $_SESSION['destino'] = $destino;
//              $_SESSION['mensaje'] = $mensaje;

                header("Location: ".$form_origen."");
                exit();
        } */
        

//      if (isset($_POST['enviarsesion'])) {



?>

</head>

<body>


<br />
<p>
<h2><?php echo $loggeduser; ?>. Subiendo tus Traslados a la carpeta del servidor:</h2>
</p>



<?php

    // Mostrar los valores de $_POST
        
//      echo "<strong> array defaults_0 </strong>";
//      print_r($_FILES['defaults_0']);
//      echo "<br /> <strong> array use_settings </strong>";
//      print_r($_FILES['use_settings']); 
//      echo "<br /> <strong> array standard </strong>";
//      print_r($_FILES['standard']);

// Array ( [name] => Array ( [0] => P2_1460.zip [1] => P2_1484.zip )
//         [type] => Array ( [0] => application/x-zip-compressed [1] => application/x-zip-compressed )
//         [tmp_name] => Array ( [0] => I:\xampplite\tmp\php746.tmp [1] => I:\xampplite\tmp\php7E3.tmp )
//         [error] => Array ( [0] => 0 [1] => 0 )
//         [size] => Array ( [0] => 407 [1] => 227 ) ) 


        $upload_log = $_SESSION['upload_log'];
        $num_arch = count($upload_log[archivo]);
//      echo "<br />Nombre del primer archivo: ".$lista_archivos[name][0]."";
//      echo "<br />Nombre temporal del primer archivo: ".$lista_archivos[tmp_name][0]."";
        
?>      
<p class="letra_envped">Archivos Enviados: <strong><?php echo $num_arch; ?></strong></p>
<!--    Almacen Destino del Archivo o los Archivos: <strong><?php // echo "$destino"; ?></strong></p> -->

<?php
//      $carpeta_destino = strtolower($destino);
//      $fileurl = 'I://xampplite/htdocs/'.$upload_dir.'';
//      echo "<p class=\"parrafo-5\">";
?>
        
<table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div class="letra_tablaenvped" align="center"><strong>Traslado</strong></div></td>
    <td><div class="letra_tablaenvped" align="center"><strong>Estado</strong></div></td>
  </tr>


<?php           
        for ($i = 0; $i < $num_arch; $i++) {
                $archivo = $upload_log[archivo][$i];
                $status  = $upload_log[status][$i];
?>
  <tr>
    <td><div class="letra_tablaenvped" align="center"><strong><?php echo $archivo; ?></strong></div></td>
    <td><div class="letra_envped" align="left"><?php echo $status; ?></div></td>
  </tr>
<?php

        }// Cierre de for
  
?>
</table> 

<br /> 

<!--
  <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="18%"><span class="letra_tablaenvped"><strong>¿Deseas Subir  más Traslados?</strong></td>
      <td width="3%"><label>
<form name="si" action="../../iniciolinker.php?linkid=TRAS_2" method="post" target="_top">
              <input type="submit" name="si" id="si" value="Si" />
      </form>
      </label></td>
      <td width="3%"><label>
<form    name="no" action="../../iniciolinker.php?linkid=TRAS_1" method="post" target="_top">
              <input type="submit" name="no" id="no" value="NO" />
      </form>   
      </label></td>
      <td width="76%">&nbsp;</td>
    </tr>
  </table> -->
<p>&nbsp;</p>
</body>
</html>
