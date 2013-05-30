<?php
        //----------------------------------------------
        //      upload file handler script
        //----------------------------------------------

        /*************************************************************************/
        /* Este script es el que en realidad copia los archivos en el servidor   */
        /* el applet lo llama reiteradamente hasta que termina de enviar los     */
        /* archivos, uno por uno, tambien filtra los archivos repetidos,         */
        /* los que no son traslados, o no tienen el formato apropiado            */
        /* (si es archivo zip o si lo es pero no tiene un nombre acorde a como   */
        /* manejamos los traslados                                               */
        /*************************************************************************/


        session_start();

        include $_SESSION['rutafunciones'].'consultas.php';
        date_default_timezone_set('America/Mexico_City');

        $docsroot    = $_SERVER['DOCUMENT_ROOT'].'/sistemaprobell/';
        $userespname = $_SESSION['userespname'];
        $loggeduser  = $_SESSION['compltusrname'];
        $userinmuid  = $_SESSION['userinmuid'];

        // Contador de Sesion
        $i = $_SESSION['i'];

        // Definir el directorio donde se almacenarán los archivos
        switch ($userinmuid) {
                case "0":
                        $upload_dir = $docsroot.'tras_almacen';
                        break;
                case "20":
                        $upload_dir = $docsroot.'tras_muebles';
                        break;
        }

        //      specify file parameter name
        $file_param_name = 'file';

        //      retrieve uploaded file name
        $file_name  = $_FILES[ $file_param_name ]['name'];
        $file_error = $_FILES[ $file_param_name ]['error'];
        $file_size  = $_FILES[ $file_param_name ]['size'];
        $file_type  = $_FILES[ $file_param_name ]['type'];

        //      retrieve uploaded file path (temporary stored by php engine)
        $source_file_path = $_FILES[ $file_param_name ][ 'tmp_name' ];

        $target_file_path = $upload_dir.'/'.$file_name;


        $file_check = $target_file_path;
        $idt=substr($file_name,1,strpos($file_name,"_")-1);
        $letra_inicio = substr($file_name, 0, 1);
        $dosletras_inicio = substr($file_name, 0, 2);
//      $separador = substr($file_name, 0, 3);
        $extension = substr(strrchr($file_name, "."),1);

        // Añadir el log a un array session
        $_SESSION['upload_log']['archivo'][$i] = $file_name;

        if ($file_error <> '0') {
                $_SESSION['upload_log']['status'][$i] = "El archivo <span class=\"letra_alertaestado\"><strong>".$file_name."</strong></span> no se puede enviar debido a un error";
        } else {

                if ($file_type <> "application/zip") {
                        $_SESSION['upload_log']['status'][$i] = "El archivo <span class=\"letra_alertaestado\"><strong>".$file_name."</strong></span> no es un archivo de Traslado y no se enviara&aacute;";
                } else {

                        if (file_exists($file_check)) {
                                $_SESSION['upload_log']['status'][$i] = "<span class=\"letra_alertaestado\"><strong>Error:</strong></span> El Archivo <span class=\"letra_alertaestado\"><strong>".$file_name."</strong></span> ya fu&eacute; enviado anteriormente";
                        } else {

                                if ($letra_inicio == "P" and $extension == "zip") {
                                        $_SESSION['upload_log']['status'][$i] = "<span class=\"letra_alertaestado\"><strong>Error:</strong></span> El Archivo <span class=\"letra_alertaestado\"><strong>".$file_name."</strong></span> es probablemente un archivo de Pedido y no ser&aacute; enviado";
                                } else {

/*                                        if ($letra_inicio <> "A" and $extension == "zip") {
                                                $_SESSION['upload_log']['status'][$i] = "<span class=\"letra_alertaestado\"><strong>Error:</strong></span> El Archivo <span class=\"letra_alertaestado\"><strong>".$file_name."</strong></span> es un archivo zip, pero no es un archivo de pedido v&aacute;lido y no se cargar&aacute;";
                                        } else { */

                                        if ($letra_inicio <> "T" and $dosletras_inicio <> "AD" and $extension == "zip") {
                                                $_SESSION['upload_log']['status'][$i] = "<span class=\"letra_alertaestado\"><strong>Error:</strong></span> El Archivo <span class=\"letra_alertaestado\"><strong>".$file_name."</strong></span> es un archivo zip, pero no es un archivo de Traslado v&aacute;lido y no se cargar&aacute;";
                                        } else {

                                                if (move_uploaded_file( $source_file_path, $target_file_path )) {
                                                        $_SESSION['upload_log']['status'][$i] = "El Traslado <strong>".$file_name."</strong> fu&eacute; enviado";

                                                        if ($dosletras_inicio == "AD") {
                                                                $idt = "5000";
                                                        }

                                                        $colsarr   = array("idtras", "archivo", "tamano", "origen", "idinmu", "fechaenvio", "fechadescarga", "descargado", "num_descargas");
                                                        $numcols   = count($colsarr);
                                                        $valarr    = array("NULL", "'$file_name'", "'$file_size'", "'$userinmuid'", "'$idt'", "CURRENT_TIMESTAMP", "'0000-00-00 00:00:00'", "'0'", "'0'");
                                                        $aff_table = "sucr_tlog";

                                                        $result    = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table);
                                                 }
                                        } // Cierre de if pedido invalido si no inica con P aunque sea zip
                                } // Cierre de if no es pedido, probable archivo de traslado (inicia con T y es ZIP
                        } // Cierre de if no es un pedido de la tienda (inicia con P pero no tiene el numero de la tienda)
                } // Cierre de if el pedido ya fué enviado anteriormente
        } // Cierre if el archivo es un archivo de tipo diferente (otra extesión, tipo)
    $_SESSION['i']++;

?>    


