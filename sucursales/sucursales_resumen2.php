<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resumen Sucursales</title>
<link href="../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../css/modulo.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--


.trhdfontbgcolor {
        background-image: url(bg-submenu-td2.png);
        background-repeat: repeat-x;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        font-style: normal;
        font-variant: small-caps;
        color: #FFFFFF;
}

.letratabla {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        font-style: normal;
        font-variant: small-caps;
        margin-left: 10px;
        margin-right: 10px;
        color: #000000;
}
-->
</style>

<?php

    include $_SESSION['rutafunciones'].'consultas.php';
	date_default_timezone_set('America/Mexico_City');


	$userinmuid = $_SESSION['userinmuid'];
	$loggeduser = $_SESSION['compltusrname'];
	$idusrarea = $_SESSION['idusrarea'];
	$tipousr = $_SESSION['tipousr'];
	$iduser = $_SESSION['iduser'];

?>


</head>

<body>
<br />
<br />

<h2> <?php echo "$loggeduser"; ?>,  bienvenido al sistema, este es el resumen de tus Traslados y Pedidos:<br />
</h2>

<p class="parrafo-2" ><strong>Ultimos Pedidos Enviados (Ultimos 5)</strong></p>


<table class="posiciontablaresumen" border="1" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center">No.</td>
    <td align="center">Archivo</td>
    <td align="center">Enviado En</td>
    <td align="center">Almacen Destino</td>
    <td align="center">M&aacute;s Pedidos</td>
  </tr>  

<?php

        // Consulta Ultimos pedidos
        $cols_arr = array("idped", "archivo", "fechahoraenvio", "destino");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("sucr_plog");
//      $num_tables = count($tables_arr);
//      $on_fields_arr = array("idinmu"); 

        $where_clause = "sucr_plog.idinmu = '$userinmuid'";
        $order = "sucr_plog.fechahoraenvio";
        $dir = "DESC";
        $limit = "5";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        $i = 1;
        while($row=mysql_fetch_row($result)){

?>

        <tr class="<?php

                                      $oddevencheck = $i % 2;
                                          if ($oddevencheck == 0) {
                                                echo "row-even";
                                          } else {
                                        echo "row-odd";
                                          }
                           ?>">
    <td class="letratabla" align="center"><?php echo "$row[0]"; ?></td>
    <td class="letratabla" align="center"><?php echo "$row[1]"; ?></td>
    <td class="letratabla" align="center"><?php echo "$row[2]"; ?></td>
    <td class="letratabla" align="center"><?php
                                                                                                switch ($row[3]) {
                                                                                                                case "0":
                                                                                                                        $dest_parse = "CEDIS";
                                                                                                                        break;
                                                                                                                case "20":
                                                                                                                        $dest_parse = "Muebles";
                                                                                                                        break;
                                                                                                        }                       
                                                                                                        echo "$dest_parse"; // Destino ?></td>
    <td class="letratabla" align="center"><a href="iniciolinker.php?linkid=PED_1" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Lista</a></td>
  </tr>

<?php
                $i++;
        } // cierre de While
?>

</table>

<?php 

        if (mysql_num_rows($result) < 1) {

?>
  <table class="posiciontablaresumen" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td scope="col"><span class="letratabla">Por el momento no has enviado pedidos</span></td>
    </tr>
  </table>

<?php

        } // Cierre de if norows

?>

<p class="letra_predeterminadamargen"><strong>Ultimos Traslados Recibidos de CEDIS sin descargar (Ultimos 5):</strong>
  <!-- TABLA DE ULTIMOS PENDIENTES -->
</p>
<p class="parrafo-2">&nbsp;</p>
<table class="posiciontablaresumen" border="1" cellpadding="0" cellspacing="0">
 <tr>
    <td class="trhdfontbgcolor" align="center">No.</td>
    <td class="trhdfontbgcolor" align="center">Traslado</td>
    <td class="trhdfontbgcolor" align="center">Tama&ntilde;o</td>
    <td class="trhdfontbgcolor" align="center">Fecha de Envio</td>
    <td class="trhdfontbgcolor" align="center">Descargar</td>
  </tr>

<?php

        // Consulta Ultimos Traslados CEDIS
        $cols_arr = array("idtras", "archivo", "tamano", "fechaenvio");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("sucr_tlog");

        $where_clause = "(sucr_tlog.idinmu = '$userinmuid' AND sucr_tlog.origen = '0' AND sucr_tlog.descargado = '0') OR (sucr_tlog.archivo LIKE '%AD0%' AND sucr_tlog.origen = '0' AND sucr_tlog.descargado = '0')";
        $order = "sucr_tlog.fechaenvio";
        $dir = "DESC";
        $limit = "5";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        $i = 1;
        while($row=mysql_fetch_row($result)){

?>

        <tr class="<?php

                                      $oddevencheck = $i % 2;
                                          if ($oddevencheck == 0) {
                                                echo "row-even";
                                          } else {
                                        echo "row-odd";
                                          }
                           ?>">
    <td class="letratabla" align="center"><?php echo "$row[0]"; // No. ?></td>
    <td class="letratabla" align="center"><?php echo "$row[1]"; // Traslado ?></td>
    <td class="letratabla" align="center"><?php echo "$row[2]"; // Tamano ?></td>
    <td class="letratabla" align="center"><?php echo "$row[3]"; // Fecha de envio ?></td>
    <td class="letratabla" align="center"><a href="iniciolinker.php?linkid=TRAS_2" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Lista</a></td>
  </tr>

<?php
                $i++;
        } // cierre de While

?>

</table>

<?php

        if (mysql_num_rows($result) < 1) {

?>
  <table class="posiciontablaresumen" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td scope="col"><span class="letratabla">Por el momento no tienes Traslados de CEDIS sin Descargar</span></td>
    </tr>
  </table>

<?php

        } // Cierre de if norows

?>

<p>
  <!-- TERMINA TABLA DE ULTIMAS VISITAS --></p>
<p class="letra_predeterminadamargen"><strong>Ultimos Traslados Recibidos de Muebles sin descargar (Ultimos 5):</strong>

  <!-- TABLA DE ULTIMOS PENDIENTES -->
</p>
<p class="parrafo-2">&nbsp;</p>
<table class="posiciontablaresumen" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td class="trhdfontbgcolor" align="center">No.</td>
    <td class="trhdfontbgcolor" align="center">Traslado</td>
    <td class="trhdfontbgcolor" align="center">Tama&ntilde;o</td>
    <td class="trhdfontbgcolor" align="center">Fecha de Envio</td>
    <td class="trhdfontbgcolor" align="center">Descargar</td>
  </tr>

<?php

        // Consulta Ultimos Traslados Muebles
        $cols_arr = array("idtras", "archivo", "tamano", "fechaenvio");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("sucr_tlog");

        $where_clause = "(sucr_tlog.idinmu = '$userinmuid' AND sucr_tlog.origen = '20' AND sucr_tlog.descargado = '0') OR (sucr_tlog.archivo LIKE '%AD0%' AND sucr_tlog.origen = '20' AND sucr_tlog.descargado = '0')";
        $order = "sucr_tlog.fechaenvio";
        $dir = "DESC";
        $limit = "5";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        $i = 1;
        while($row=mysql_fetch_row($result)){

?>

        <tr class="<?php

                                      $oddevencheck = $i % 2;
                                          if ($oddevencheck == 0) {
                                                echo "row-even";
                                          } else {
                                        echo "row-odd";
                                          }
                           ?>">
    <td class="letratabla" align="center"><?php echo "$row[0]"; // No. ?></td>
    <td class="letratabla" align="center"><?php echo "$row[1]"; // Traslado ?></td>
    <td class="letratabla" align="center"><?php echo "$row[2]"; // Tamano ?></td>
    <td class="letratabla" align="center"><?php echo "$row[3]"; // Fecha de envio ?></td>
    <td class="letratabla" align="center"><a href="iniciolinker.php?linkid=TRAS_2" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Lista</a></td>
  </tr>

<?php

                $i++; 
        } // Cierre de while

?>

</table>

<?php 

        if (mysql_num_rows($result) < 1) {

?>
  <table class="posiciontablaresumen" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td scope="col"><span class="letratabla">Por el momento no tienes Traslados de Muebles sin Descargar</span></td>
    </tr>
  </table>

<p>
  <?php

        } // Cierre de if norows

?>
    
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
