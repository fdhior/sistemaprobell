<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../css/modulo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.letratabla {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        font-style: normal;
        font-variant: small-caps;
        margin-left: 10px;
        margin-right: 10px;
        color: #000000;
}

.tdRes1 {
	width: 33px;
	text-align: center;
}

.tdRes2 {
	width: 90px;
	text-align: center;
}

.tdRes3 {
	width: 150px;
	text-align: center;
}

.tdRes4 {
	width: 120px;
	text-align: center;
}

.tdRes5 {
	width: 200px;
	text-align: center;
}

.tdRes6 {
	width: 107px;
	text-align: center;
}

.tdRes7 {
	width: 100px;
	text-align: center;
}

.tdRes8 {
	width: 207px;
	text-align: center;
}

-->
</style>
<?php
        /*****************************************************************************/
        /* Muestra un resumen con los ultimos pedidos recibidos y traslados enviados */
        /*****************************************************************************/
		session_start();
		
        include $_SESSION['rutafunciones'].'consultas.php';

		$hostname    = $_SESSION['hostname'];
        $userinmuid  = $_SESSION['userinmuid'];
        $loggeduser  = $_SESSION['compltusrname'];
        $idusrarea   = $_SESSION['idusrarea'];
        $tipousr     = $_SESSION['tipousr'];
        $iduser      = $_SESSION['iduser'];

		$target_link = $hostname.'iniciolinker.php';
?>
</head>

<body>

<br />

<h2> <?php echo "$loggeduser"; ?>,  bienvenido al sistema, este es el resumen de tus Pedidos y Traslados:</h2>
<br />

<p class="parrafo-2">Ultimos Pedidos Recibidos Sin Descargar (Ultimos 5)
  <!-- TABLA DE ULTIMAS VISITAS -->
  </p>
<table class="resumenHeader" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="tdRes1">No.</td>
    <td class="tdRes2">Pedido</td>
    <td class="tdRes3">Enviado en</td>
    <td class="tdRes4">Origen</td>
    <td class="tdRes5">Observaciones</td>
    <td class="tdRes6">M&aacute;s Pedidos</td>
  </tr>  
</table>

<div id="right_bg">
  <table class="tablaResultados" border="0" cellpadding="0" cellspacing="0">

<?php

        // Consulta Ultimos pedidos
        $cols_arr = array("idped", "archivo", "fechahoraenvio", "gnrl_usrs.nombre", "observaciones");
        $num_cols = count($cols_arr);
        $join_tables = '1';
        $tables_arr = array("gnrl_usrs", "sucr_plog");
        $num_tables = count($tables_arr);
        $on_fields_arr = array("idinmu"); 

        $where_clause = "destino = '$userinmuid' AND descargado = '0'";
        $order = "sucr_plog.fechahoraenvio";
        $dir = "DESC";
        $limit = "5";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        $i = "1";
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
    <td class="tdRes1" align="center"><?php echo $row[0]; // No. ?></td>
    <td class="tdRes2" align="center"><?php echo $row[1]; // Archivo ?></td>
    <td class="tdRes3" align="center"><?php echo $row[2]; // Fecha de envio ?></td>
    <td class="tdRes4" align="center"><?php echo $row[3]; // Origen ?></td>
    <td class="tdRes5" align="center"><?php
                                                   $mensaje_en_corto = substr($row[4], 0, 30);
                                                   if ($mensaje_en_corto == "Ninguno") {
                                                          echo "$mensaje_en_corto";
                                                   } else {
                                                          if (strlen($mensaje_en_corto) >= 27) {
                                                                echo "$mensaje_en_corto...";
                                                          } else {
                                                                echo "$mensaje_en_corto";
                                                   }
                                             }// Observaciones ?></td>
    <td class="letratabla" align="center"><a href="<?php echo $target_link; ?>?linkid=PED_2" target="_top" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Lista</a></td>
  </tr>

<?php
                $i++;
        } // cierre de While
?>

</table>

<?php

        if (mysql_num_rows($result) < 1) {

?>
  <table class="tablaResultados" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td scope="col"><span class="letratabla">Por el momento no has recibido ning&uacute;n pedido</span></td>
    </tr>
  </table>

<?php

        } // Cierre de if norows

?>
</div>

<br />

<p class="parrafo-2">Ultimos Traslados Enviados a Tiendas (Ultimos 5):</p>

<table class="resumenHeader" border="0" cellpadding="0" cellspacing="0">
 <tr>
    <td class="tdRes1">No.</td>
    <td class="tdRes2">Traslado</td>
    <td class="tdRes7" align="center">Tama&ntilde;o</td>
    <td class="tdRes4" align="center">Destino</td>
    <td class="tdRes3" align="center">Enviado En</td>
    <td class="tdRes8" align="center">M&aacute;s Traslados</td>
  </tr>
</table>  
  
<div id="right_bg">
  <table class="tablaResultados" border="0" cellpadding="0" cellspacing="0">

<?php

        // Consulta Ultimas Visitas
        $cols_arr = array("idtras", "archivo", "tamano", "gnrl_usrs.nombre", "fechaenvio");
        $num_cols = count($cols_arr);
        $join_tables = '1';
        $tables_arr = array("gnrl_usrs", "sucr_tlog");
        $num_tables = count($tables_arr);
        $on_fields_arr = array("idinmu");

        $where_clause = "origen = '$userinmuid'";

        $order = "sucr_tlog.fechaenvio";
        $dir = "DESC";
        $limit = "5";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        $i = "1";
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
    <td class="tdRes1"><?php echo $row[0]; // No. ?></td>
    <td class="tdRes2"><?php echo $row[1]; // Traslado ?></td>
    <td class="tdRes7"><?php echo $row[2]; // Tamaño ?> Bytes</td>
    <td class="tdRes4"><?php echo $row[3]; // Destino ?></td>
    <td class="tdRes3"><?php echo $row[4]; // Enviado en ?></td>
    <td class="tdRes8"><a href="<?php echo $target_link; ?>?linkid=TRAS_2" target="_top" onmouseover="return hidestatus()" onclick="return hidestatus()">Enviar Traslados</a></td>
  </tr>

<?php
                $i++;
        } // cierre de While
?>

</table>

<?php

        if (mysql_num_rows($result) < 1) {

?>
  <table class="tablaResultados" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td scope="col"><span class="letratabla">Por el momento no has enviado traslados a ninguna Tienda</span></td>
    </tr>
  </table>

<?php

        } // Cierre de if norows

?>
</div>

</body>
</html>
