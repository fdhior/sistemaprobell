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
</head>

<body>

<?php
        session_start();

		include $_SESSION['rutafunciones'].'consultas.php';
        date_default_timezone_set('America/Mexico_City');

        $hostname    = $_SESSION['hostname'];
        $userespname = $_SESSION['userespname'];
        $loggeduser  = $_SESSION['compltusrname'];
        $userinmuid  = $_SESSION['userinmuid'];

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
        if (!isset($_FILES['use_settings'])) {
                $error = "Debes agregar al menos un pedido a la lista";
                $error_id = "0";
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
<h2>Usuario: <?php echo $loggeduser; ?>. Enviando <?php echo $num_arch; ?> Traslado(s) de

<?php
        switch ($origen) {
                        case "0":
                                echo "CEDIS";
                                break;
                        case "20":      
                                echo "Muebles";
                                break;
                }               
?>:</h2>


<?php

        switch ($origen) {
                        case "0":
                                $carpeta_destino = "tras_almacen";
                                break;
                        case "20":      
                                $carpeta_destino = "tras_muebles";
                                break;
                }               

        $fileurl = $_SERVER['DOCUMENT_ROOT'].'/sistemaprobell/'.$carpeta_destino.'/';

//      $carpeta_destino = strtolower($destino);
//      $fileurl = '/xampplite/htdocs/entradapedidos/'.$carpeta_destino.'/';
//      echo "<p class=\"parrafo-5\">";
?>
        
<table class="resumenHeader" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="tdRes1"><strong>Traslado</strong></td>
    <td class="tdRes2"><strong>Tamaño</strong></td>
    <td class="tdRes3"><strong>Estado</strong></td>
  </tr>

</table>  

<div id="divContent0" style="position: relative; left: 26px; top: 0px; width:600px;">
<table border="1" cellpadding="0" cellspacing="0">

<?php           
        for ($i = 0; $i < $num_arch; $i++) {
                $file_check = $fileurl.$lista_archivos[name][$i];
                $nombre_archivo = $lista_archivos[name][$i];
//              echo "$nombre_archivo <br />";
                $idt=substr($nombre_archivo,1,strpos($nombre_archivo,"_")-1);
                $letra_inicio = substr($nombre_archivo, 0, 1);
                $dosletras_inicio = substr($nombre_archivo, 0, 2);
                $extension = substr(strrchr($nombre_archivo, "."),1);
                $extension = strtolower($extension);
                $file_size = $lista_archivos[size][$i];

?>
  <tr>
    <td class="tdRes2-1"><strong><?php echo "".$lista_archivos[name][$i].""; ?></strong></td>
    <td class="tdRes2-2"><?php echo "".$lista_archivos[size][$i]." Bytes"; ?></td>
    <td class="tdRes2-3">
<?php
                if ($lista_archivos[error][$i] <> '0') {
                        echo 'El archivo <span class="letra_alertaestado_nopadd"><strong>'.$lista_archivos[name][$i].'</strong></span> no se puede enviar debido a un error';
                } else {

                        if ($extension <> "zip") {
                                echo 'El archivo <span class="letra_alertaestado_nopadd"><strong>'.$lista_archivos[name][$i].'</strong></span> no es un archivo comprimido zip y no se enviar&aacute;';
                        } else {                                

                                if (file_exists($file_check)) {
                                        echo '<span class="letra_alertaestado_nopadd"><strong>Error:</strong></span> El Archivo <span class="letra_alertaestado_nopadd"><strong>'.$lista_archivos[name][$i].'</strong></span> ya fu&eacute; enviado anteriormente';
                                } else {

                                        if ($letra_inicio == "P" and $extension == "zip") {
                                                echo '<span class="letra_alertaestado_nopadd"><strong>Error:</strong></span> El Archivo <span class="letra_alertaestado_nopadd"><strong>'.$lista_archivos[name][$i].'</strong></span> es probablemente un archivo de pedido y no ser&aacute; enviado';
                                        } else {

                                        if ($letra_inicio <> "T" and $dosletras_inicio <> "AD" and $extension == "zip") {
                                                        echo '<span class="letra_alertaestado_nopadd"><strong>Error:</strong></span> El Archivo <span class=\"letra_alertaestado_nopadd\"><strong>'.$lista_archivos[name][$i].'</strong></span> es un archivo zip, pero no es un archivo de Traslado v&aacute;lido y no ser&aacute; enviado';
                                                } else {

//                                                      echo "$fileurl";
                                                        if (copy($lista_archivos[tmp_name][$i], $fileurl.$lista_archivos[name][$i])) {
                                                                echo 'El Traslado <strong>'.$lista_archivos[name][$i].'</strong> fu&eacute; enviado';

                                                                if ($dosletras_inicio == "AD") {
                                                                        $idt = "5000";
                                                                }

                                                                // Insertar los datos en el log de la base de datos
                                                                $colsarr = array("idtras", 
																                 "archivo", 
																				 "tamano", 
																				 "origen", 
																				 "idinmu", 
																				 "fechaenvio", 
																				 "fechadescarga", 
																				 "descargado", 
																				 "num_descargas");
                                                                $numcols = count($colsarr);
                                                                $valarr = array("NULL", 
																                "'$nombre_archivo'", 
																				"'$file_size'", 
																				"'$origen'", 
																				"'$idt'", 
																				"CURRENT_TIMESTAMP", 
																				"'0000-00-00 00:00:00'", 
																				"'0'", 
																				"'0'");
                                                                $aff_table = "sucr_tlog";

                                                                $result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table);

                                                        } // Cierre de if trasferencia correcta y registro en log
                                                } // Cierre de if pedido invalido si no inica con P aunque sea zip
                                        } // Cierre de if no es pedido, probable archivo de traslado (inicia con T y es ZIP     
                                } // Cierre de if el pedido ya fué enviado anteriormente
                        } // Cierre if el archivo es un archivo de tipo diferente (otra extesión, tipo)
                } // Cierre Cierre if hubo un error con el archivo y no se pudo copiar a la carpeta temporal (if inicial)

?></td>
  </tr>

<?php
        } // Cierre de for
?>
</table>
</div>

<form id="form0" name="form0" action="<?php echo $hostname; ?>supervision/traslados/supervision_administrartraslados.php" method="post" target="ped_frame">
  <input type="hidden" name="dest_act" id="hiddenField" value="<?php echo $origen; ?>" />
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->


        <script language="javascript">
                window.alert("Revisa el resultado de la transferencia.");
                                document.forms[0].submit();
        </script>


</body>
</html>
