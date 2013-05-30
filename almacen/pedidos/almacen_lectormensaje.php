<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.tipoletra {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 9px;
        font-style: normal;
        font-weight: normal;
        font-variant: small-caps;
}
-->
</style>
</head>

<body>
<?php 
        include "".$_SERVER['DOCUMENT_ROOT']."/sistemaprobell/consultas.php";
        if (isset($_POST['id_ped'])) {

                foreach ($_POST as $nombre => $valor) {
                        if(stristr($nombre, 'button') === FALSE) {
                                ${$nombre} = $valor;
                        }
                } // Cierre foreach     
                
                $cols_arr     = array("observaciones");
                $num_cols     = count($cols_arr);
                $join_tables  = '0';
                $tables_arr   = array("sucr_plog");
                $num_tables   = count($tables_arr);
                $where_clause = "idped = '$id_ped'";
                                                 
                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
                $row = mysql_fetch_row($result);
?>
<span class="tipoletra">Pedido: <?php echo "$ped_nombre" ?> <br />
Origen: <?php echo "$ped_origen" ?> <br />
Mensaje: <?php echo "$row[0]"; ?></span>


<?php
        } else {
?>
<span class="tipoletra">
Da Click en el botón 
<label>
<input class="tipoletra" type="submit" name="button" id="button" value="Ver Mensaje" />
</label>
del pedido del cual quieras ver su mensaje.</span>

<?php 
        } // Cierre de if
?>
</body>
</html>
