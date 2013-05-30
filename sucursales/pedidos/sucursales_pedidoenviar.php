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



.tdRes1 {
	width: 120px;
}

.tdRes2-1 {
	width: 120px;
	border: 1px solid #000;
	text-align: center;	
}

.tdRes2 {
	width: 200px;
}

.tdRes2-2 {
	width: 200px;
	border: 1px solid #000;
	text-align: center;	
}

.tdRes3 {
	width: 70px;
}

.tdRes2-3 {
	width: 70px;
	border: 1px solid #000;
	text-align: center;	
}

.tdRes4 {
	width: 410px;
}

.tdRes2-4 {
	width: 410px;
	border: 1px solid #000;
	text-align: center;	
}

-->
</style>
</head>

<body>


<?php
        session_start();
	    include $_SESSION['rutafunciones'].'consultas.php';
        date_default_timezone_set('America/Mexico_City');

        $userespname = $_SESSION['userespname'];
        $loggeduser = $_SESSION['compltusrname'];
        $userinmuid = $_SESSION['userinmuid'];

/*        echo "<span class=\"tipoletra\">Valores de _POST</span><br />";
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
        if (!isset($_FILES['use_settings'])) {
                $error = "Debes agregar al menos un pedido a la lista";
                $error_id = "0";
        } else {

                if ($destino == 'Elige un Almacen') {
                        $error = "Elije el almac&eacute;n al que enviar&aacute;s el pedido";
                        $error_id = "1";
                } // else {

                     /* if ($mensaje == '') {
                                $error = "Teclea un mensaje adicional al pedido (teclea: Ninguno al menos)";
                                $error_id = "2";
                        } */
//              }
        }


        if (isset($error)) {
                $_SESSION['errorpass'] = $error;
                $_SESSION['error_id']  = $error_id;
                $_SESSION['destino']   = $destino;
                $_SESSION['mensaje']   = $mensaje;

                header("Location: sucursales_enviarpedido.php");
                exit();
        }

?>

<br />
<p>
<h2>Usuario: <?php echo $loggeduser.' '.$userespname; ?>. Enviando tu pedido a <?php echo $destino; ?>:</h2>
</p>



<?php

        $lista_archivos = $_FILES['use_settings'];
        $num_arch = count($lista_archivos[name]);

?>

        <p class="letra_predeterminadamargen">Archivos A Enviar: <strong><?php echo $num_arch; ?></strong><br />
        Almacen Destino del Archivo o los Archivos: <strong><?php echo $destino; ?></strong></p>

<?php

        if  ($destino == "CEDIS") {
                $carpeta_destino = "almacen";
        } else {
                $carpeta_destino = strtolower($destino);
        }
        $fileurl = $_SERVER['DOCUMENT_ROOT']."/sistemaprobell/entradapedidos/".$carpeta_destino."/";

?>

<table class="resumenHeader" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="tdRes1">Pedido</td>
    <td class="tdRes2">Tipo de Archivo</td>
    <td class="tdRes3">Tamaño</td>
    <td class="tdRes4">Estado</td>
  </tr>
</table>

<div id="divContent0" style="position: relative; left: 26px; top: 0px; width:800px;">
<table border="0" cellpadding="0" cellspacing="0">
<?php
        for ($i = 0; $i < $num_arch; $i++) {
                $file_check = $fileurl.$lista_archivos[name][$i];
                $nombre_archivo = $lista_archivos[name][$i];
//              echo "$nombre_archivo <br />";
                $idt=substr($nombre_archivo,1,strpos($nombre_archivo,"_")-1);
                $letra_inicio = substr($nombre_archivo, 0, 1);
                $extension = substr(strrchr($nombre_archivo, "."),1);
                $extension = strtolower($extension);        
//                              echo "$letra_inicio <br />";
//                              echo "$extension <br />";

?>
  <tr>
    <td class="tdRes2-1"><strong><?php echo $lista_archivos[name][$i]; ?></strong></td>
    <td class="tdRes2-2"><?php echo $lista_archivos[type][$i]; ?></td>
    <td class="tdRes2-3"><?php echo $lista_archivos[size][$i].' Bytes'; ?></td>
    <td class="tdRes2-4">
<?php
                if ($lista_archivos[error][$i] <> '0') {
                        echo 'El archivo <span class="letra_alertaestado_nopadd"><strong>'.$lista_archivos[name][$i].'</strong></span> no se puede enviar debido a un error';
                } else {

                        if ($extension <> "zip") {
                                echo 'El archivo <span class="letra_alertaestado_nopadd"><strong>'.$lista_archivos[name][$i].'</strong></span> no es un archivo zip y no se enviar&aacute;';
                        } else {

/*                      if ($extension <> "ZIP") {
                                echo "El archivo <span class=\"letra_alertaestado\"><strong>".$lista_archivos[name][$i]."</strong></span> no es un archivo zip y no se enviar&aacute;";
                        } else { */

                                if (file_exists($file_check)) {
                                        echo '<span class="letra_alertaestado_nopadd"><strong>Error:</strong></span> El Archivo <span class="letra_alertaestado_nopadd"><strong>'.$lista_archivos[name][$i].'</strong></span> ya fué enviado anteriormente';
                                } else {

                                        if ($letra_inicio == "P" and $idt <> $userinmuid) {
                                                echo '<span class="letra_alertaestado_nopadd"><strong>Error:</strong></span> El Archivo <span class="letra_alertaestado_nopad"><strong>'.$lista_archivos[name][$i].'</strong></span> no es un pedido que corresponda a tu tienda';
                                        } else {

                                                if ($letra_inicio == "T" and $extension == "zip") {
                                                        echo '<span class="letra_alertaestado_nopadd"><strong>Error:</strong></span> El Archivo <span class="letra_alertaestado_nopadd"><strong>'.$lista_archivos[name][$i].'</strong></span> es probablemente un archivo de traslado y no ser&aacute; enviado';
                                                } else {

                                                        if ($letra_inicio <> "P" and $extension == "zip") {
                                                                echo '<span class=\"letra_alertaestado\"><strong>Error:</strong></span> El Archivo <span class="letra_alertaestado_nopadd"><strong>'.$lista_archivos[name][$i].'</strong></span> es un archivo zip, pero no es un archivo de pedido v&aacute;lido y no ser&aacute; enviado';
                                                        } else {

                                                                if (copy($lista_archivos[tmp_name][$i], $fileurl.$lista_archivos[name][$i])) {
                                                                        echo 'El Pedido <strong>'.$lista_archivos[name][$i].'</strong> fu&eacute; enviado';

                                                                        switch ($destino) {
                                                                                case "Muebles":
                                                                                        $dest_num = "20";
                                                                                        break;
                                                                                case "CEDIS":
                                                                                        $dest_num = "0";
                                                                                        break;
                                                                        }

                                                                        if ($mensaje == "") {
                                                                                $mensaje = "Ninguno";
                                                                        }

                                                                        // Insertar los datos en el log de la base de datos
                                                                        $colsarr = array("idped",
																		                 "archivo", 
																						 "fechahoraenvio", 
																						 "idinmu", 
																						 "destino", 
																						 "observaciones");
                                                                        $numcols = count($colsarr);
                                                                        $valarr = array("NULL", 
																		                "'$nombre_archivo'", 
																						"CURRENT_TIMESTAMP", 
																						"'$userinmuid'", 
																						"'$dest_num'", 
																						"'$mensaje'");
                                                                        $aff_table = "sucr_plog";

                                                                        $result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table);

//                                                                        }
                                                                } // Cierre de if trasferencia correcta y registro en log
                                                        } // Cierre de if pedido invalido si no inica con P aunque sea zip
                                                } // Cierre de if no es pedido, probable archivo de traslado (inicia con T y es ZIP
                                        } // Cierre de if no es un pedido de la tienda (inicia con P pero no tiene el numero de la tienda)
                                } // Cierre de if el pedido ya fué enviado anteriormente
                        } // Cierre if el archivo es un archivo de tipo diferente (otra extesión, tipo)
                } // Cierre Cierre if hubo un error con el archivo y no se pudo copiar a la carpeta temporal (if inicial)

?></td>
  </tr>

<?php
        } // Cierre de for
?>
</table>

<br />

  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td class="letra_predeterminada" width="18%"><strong>¿Deseas Enviar más pedidos?</strong></td>
      <td width="3%"><label>
<form name="si" action="../../iniciolinker.php?linkid=PED_2" method="post" target="_top">
              <input type="submit" name="si" id="si" value="Si" />
      </form>
      </label></td>
      <td width="3%"><label>
<form    name="no" action="../../iniciolinker.php?linkid=PED_1" method="post" target="_top">
              <input type="submit" name="no" id="no" value="NO" />
      </form>
      </label></td>
      <td width="76%">&nbsp;</td>
    </tr>
  </table>
</div>  

</body>
</html>
