<?php
        session_start();

        include $_SESSION['rutafunciones'].'/consultas.php';
        date_default_timezone_set('America/Mexico_City');

/*      echo "<span class=\"tipoletra\">Valores de _POST</span><br />";
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
                }
        } */


        // Convertir las variables $_POST en locales
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        ${$nombre} = $valor;
                }
        } // Cierre foreach     


/*      if (!isset($_POST['file']) || empty($_POST['file'])) {
            exit();
        }*/
        
/*      switch ($origen) {
                case "0":               
                        $root = "/xampplite/htdocs/tras_almacen/";
                        break;
                case "20":
                        $root = "/xampplite/htdocs/tras_muebles/";
                        break;
        } */
                                
//      $file = basename($_POST['file']);
//      $path = $root.$file;
//      $type = '';
 
//       echo "path del archivo: $path<br />";
//       echo "numero traslado: $idtras<br />";
/*      if (file_exists($path)) {
        $size = filesize($path); 
            if (function_exists('mime_content_type')) {
           $type = mime_content_type($path);
            } elseif (function_exists('finfo_file')) {
            $info = finfo_open(FILEINFO_MIME);
                $type = finfo_file($info, $path);
                finfo_close($info);  
            }

                if ($type == '') {
                $type = "application/force-download";
            } */

        $cols_arr = array("descargado", "num_descargas");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("sucr_plog");
        $num_tables = count($tables_arr);
        $where_clause = "sucr_plog.idped = '$idped'";
        
        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        $row = mysql_fetch_row($result);
   
    $act_num_des = $row[1] + 1; 
        
    // Insertar los datos en el log de la base de datos
        if ($row[0] >= "1") {
                $colsvalarr = array("num_descargas = '$act_num_des'");
        } else {
                $colsvalarr = array("fechadescarga = CURRENT_TIMESTAMP", "descargado = '1'", "num_descargas = '$act_num_des'");
        }       

//      print_r($colsvalarr);
         
        $numcols = count($colsvalarr);
        $aff_table = "sucr_plog";
        $where_clause = "sucr_plog.idped = '$idped'";

        gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause);

/*      echo "<span class=\"tipoletra\">Valores de _SESSION</span><br />";
        foreach ($_SESSION as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
                }
        } */

        header("Location: ".$deformulario."");

/*         // Set Headers
            header("Content-Type: $type");
            header("Content-Disposition: attachment; filename=$file");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . $size);

            // Download File
        readfile($path); */

        exit();

//      } else {
//      die("File not exist !!");
//      } 
?>
