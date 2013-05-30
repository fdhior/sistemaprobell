<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
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

.tdRes1 {
	width: 100px;
}

.tdRes2-1 {
	width: 100px;
	border: 1px solid #000;
	text-align: center;	
}

.tdRes2 {
	width: 100px;
}

.tdRes2-2 {
	width: 100px;
	border: 1px solid #000;
	text-align: center;	
}

.tdRes3 {
	width: 400px;
}

.tdRes2-3 {
	width: 400px;
	border: 1px solid #000;
	text-align: left;	
}


-->
</style>
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
        session_start();
		$rutafunciones = $_SESSION['rutafunciones'];
        include $rutafunciones.'consultas.php';

        date_default_timezone_set('America/Mexico_City');
        
		$hostname    = $_SESSION['hostname'];
        $userespname = $_SESSION['userespname'];
        $loggeduser  = $_SESSION['compltusrname'];
        $userinmuid  = $_SESSION['userinmuid'];
		
		$rel_path    = 'supervision/pedidos/supervision_';
		$target_link = $hostname.$rel_path.'administrarpedidos.php'; 

        /*echo "<span class=\"tipoletra\">Valores de _POST</span><br />";
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />";
                }
        }*/

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

/*                      if ($mensaje == '') {
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

                header("Location: supervision_enviarpedido.php");
                exit();
        }       
        
        $lista_archivos = $_FILES['use_settings'];
        $num_arch = count($lista_archivos[name]);

?>
<br />
<h2>Usuario: <?php echo $loggeduser; ?>. Enviando <?php echo $num_arch; ?> pedido(s) a <?php echo $destino; ?>:</h2>

<!-- <p class="letra_envped">Archivos A Enviar: <strong><?php // echo "$num_arch"; ?></strong><br />
         Almacen Destino del Archivo o los Archivos: <strong><?php // echo "$destino"; ?></strong></p> -->

<?php

        if  ($destino == "CEDIS") {
                $carpeta_destino = "almacen";
        } else {
                $carpeta_destino = strtolower($destino);
        }
        $fileurl = $_SERVER['DOCUMENT_ROOT']."/sistemaprobell/entradapedidos/".$carpeta_destino."/";

//      $carpeta_destino = strtolower($destino);
//      $fileurl = '/xampplite/htdocs/entradapedidos/'.$carpeta_destino.'/';
//      echo "<p class=\"parrafo-5\">";
?>
        
<table class="resumenHeader" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="tdRes1">Pedido</td>
    <td class="tdRes2">Tamaño</td>
    <td class="tdRes3">Estado</td>
  </tr>
</table>

<div id="divContent0" style="position: relative; left: 26px; top: 0px; width:600px;">
<table border="0" cellpadding="0" cellspacing="0">
<?php           
        for ($i = 0; $i < $num_arch; $i++) {
                $file_check = $fileurl.$lista_archivos[name][$i];
                $nombre_archivo = $lista_archivos[name][$i];
//              echo "$nombre_archivo <br />";
                $idt=substr($nombre_archivo,1,strpos($nombre_archivo,"_")-1);
                $letra_inicio = substr($nombre_archivo, 0, 1);
                $extension = substr(strrchr($nombre_archivo, "."),1);
//                              echo "$letra_inicio <br />";
//                              echo "$extension <br />";

?>
  <tr>
    <td class="tdRes2-1"><span class="letra_predeterminada10"><strong><?php echo "".$lista_archivos[name][$i].""; ?></strong></span></td>
    <td class="tdRes2-2"><span class="letra_predeterminada10"><?php echo "".$lista_archivos[size][$i]." Bytes"; ?></span></td>
    <td class="tdRes2-3"><span class="letra_predeterminada10"><?php // echo $lista_archivos[type][$i]; ?>
<?php
                if ($lista_archivos[error][$i] <> '0') {
                        echo "El archivo <span class=\"letra_alertaestado_nopadd\"><strong>".$lista_archivos[name][$i]."</strong></span> no se puede enviar debido a un error";
                } else {

                        /*if ($lista_archivos[type][$i] <> "application/x-zip-compressed") {
                                echo "El archivo <span class=\"letra_alertaestado\"><strong>".$lista_archivos[name][$i]."</strong></span> no es un archivo de pedido y no se enviar&aacute;";
                        } else {*/                                

                                if (file_exists($file_check)) {
                                        echo "<span class=\"letra_alertaestado_nopadd\"><strong>Error:</strong></span> El Archivo <span class=\"letra_alertaestado_nopadd\"><strong>".$lista_archivos[name][$i]."</strong></span> ya fué enviado anteriormente";
                                } else {        

                                        if ($letra_inicio == "T" and $extension == "zip") {
                                                echo "<span class=\"letra_alertaestado_nopadd\"><strong>Error:</strong></span> El Archivo <span class=\"letra_alertaestado_nopadd\"><strong>".$lista_archivos[name][$i]."</strong></span> es probablemente un archivo de traslado y no ser&aacute; enviado";
                                        } else {        

                                                if ($letra_inicio <> "P" and $extension == "zip") { 
                                                        echo "<span class=\"letra_alertaestado_nopadd\"><strong>Error:</strong></span> El Archivo <span class=\"letra_alertaestado\"><strong>".$lista_archivos[name][$i]."</strong></span> es un archivo zip, pero no es un archivo de pedido v&aacute;lido y no ser&aacute; enviado";
                                                } else {
                
                                                        if (copy($lista_archivos[tmp_name][$i], $fileurl.$lista_archivos[name][$i])) {
                                                                echo "El Pedido <strong>".$lista_archivos[name][$i]."</strong> fu&eacute; enviado";
                                                                
                                                                switch ($destino) {
                                                                        case "Muebles":
                                                                                $dest_num = "20";
                                                                                break;
                                                                        case "CEDIS":
                                                                                $dest_num =  "0";
                                                                                break;
                                                                }       
                                                                
                                if ($mensaje == "Predeterminado" or  mensaje == "") {
                                        $mensaje = "Pedido Reenviado por el Administrador del Sistema, Favor de Surtir";
                                }

                                                                // Insertar los datos en el log de la base de datos
                                                                $colsarr = array("idped", "archivo", "fechahoraenvio", "idinmu", "destino", "observaciones");
                                                                $numcols = count($colsarr);
                                                                $valarr = array("NULL", "'$nombre_archivo'", "CURRENT_TIMESTAMP", "'$idt'", "'$dest_num'", "'$mensaje'");
                                                                $aff_table = "sucr_plog";

                                                                $result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

                                                        // } // Cierre de if trasferencia correcta y registro en log
                                                } // Cierre de if pedido invalido si no inica con P aunque sea zip
                                        } // Cierre de if no es pedido, probable archivo de traslado (inicia con T y es ZIP     
                                } // Cierre de if el pedido ya fué enviado anteriormente
                        } // Cierre if el archivo es un archivo de tipo diferente (otra extesión, tipo)
                } // Cierre Cierre if hubo un error con el archivo y no se pudo copiar a la carpeta temporal (if inicial)

?></span></td>
  </tr>

<?php
        } // Cierre de for
?>
</table>
</div>

<form id="form0" name="form0" action="<?php echo $target_link; ?>" method="post" target="ped_frame">
  <input type="hidden" name="dest_act" id="hiddenField" value="<?php echo $destino; ?>" />
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->


        <script language="javascript">
                window.alert("Revisa el resultado de la transferencia.");
                                document.forms[0].submit();
        </script>

<!--
<script language="javascript">


                                var result = confirm("Revisa el resultado de la transferencia.\r\nÂ¿Deseas subir mas Pedidos?");
                                if (result == true) {
                                                                        
                                } else {
                                                                        document.forms[0].submit();
                                }

</script> -->


</body>
</html>
