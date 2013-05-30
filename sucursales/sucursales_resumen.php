<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resumen Sucursales</title>
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
	width: 150px;
	text-align: center;
}

.tdRes3 {
	width: 150px;
	text-align: center;
}

.tdRes4 {
	width: 200px;
	text-align: center;
}

.tdRes5 {
	width: 167px;
	text-align: center;
}

-->
</style>

<?php

		session_start();
		
    	include $_SESSION['rutafunciones'].'consultas.php';
		date_default_timezone_set('America/Mexico_City');

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
<br />

<h2> <?php echo "$loggeduser"; ?>,  bienvenido al sistema, este es el resumen de tus Traslados y Pedidos:<br />
</h2>

<p class="parrafo-2" ><strong>Ultimos Pedidos Enviados (Ultimos 5)</strong></p>


<table class="resumenHeader" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td class="tdRes1">No.</td>
    <td class="tdRes2">Archivo</td>
    <td class="tdRes3">Enviado En</td>
    <td class="tdRes4">Almacen Destino</td>
    <td class="tdRes5">M&aacute;s Pedidos</td>
  </tr>  
</table>



<div id="right_bg">
<table class="tablaResultados" border="0" cellpadding="0" cellspacing="0">
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
    <td class="tdRes1"><?php echo $row[0]; ?></td>
    <td class="tdRes2"><?php echo $row[1]; ?></td>
    <td class="tdRes3"><?php echo $row[2]; ?></td>
    <td class="tdRes4"><?php
                                                                                                switch ($row[3]) {
                                                                                                                case "0":
                                                                                                                        $dest_parse = "CEDIS";
                                                                                                                        break;
                                                                                                                case "20":
                                                                                                                        $dest_parse = "Muebles";
                                                                                                                        break;
                                                                                                        }                       
                                                                                                        echo "$dest_parse"; // Destino ?></td>
    <td class="tdRes5" align="center"><a href="<?php echo $target_link; ?>?linkid=PED_1" target="_top" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Lista</a></td>
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
      <td scope="col"><span class="letratabla">Por el momento no has enviado pedidos</span></td>
    </tr>
  </table>

<?php

        } // Cierre de if norows

?>
</div>

<br />
<p class="parrafo-2"><strong>Ultimos Traslados Recibidos de CEDIS sin descargar (Ultimos 5):</strong></p>

<table class="resumenHeader" border="0" cellpadding="0" cellspacing="0">
 <tr>
    <td class="tdRes1">No.</td>
    <td class="tdRes2">Traslado</td>
    <td class="tdRes3">Tama&ntilde;o</td>
    <td class="tdRes4">Fecha de Envio</td>
    <td class="tdRes5">Descargar</td>
  </tr>
</table>


<div id="right_bg">
<table class="tablaResultados" border="0" cellpadding="0" cellspacing="0">
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
    <td class="tdRes1"><?php echo $row[0]; // No. ?></td>
    <td class="tdRes2"><?php echo $row[1]; // Traslado ?></td>
    <td class="tdRes3"><?php echo $row[2]; // Tamano ?></td>
    <td class="tdRes4"><?php echo $row[3]; // Fecha de envio ?></td>
    <td class="tdRes5"><a href="<?php echo $target_link; ?>?linkid=TRAS_2" target="_top" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Lista</a></td>
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
      <td scope="col"><span class="letratabla">Por el momento no tienes Traslados de CEDIS sin Descargar</span></td>
    </tr>
  </table>

<?php

        } // Cierre de if norows

?>
</div>
<br />
<p class="parrafo-2"><strong>Ultimos Traslados Recibidos de Muebles sin descargar (Ultimos 5):</strong></p>

  <!-- TABLA DE ULTIMOS PENDIENTES -->


<table class="resumenHeader" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="tdRes1">No.</td>
    <td class="tdRes2">Traslado</td>
    <td class="tdRes3">Tama&ntilde;o</td>
    <td class="tdRes4">Fecha de Envio</td>
    <td class="tdRes5">Descargar</td>
  </tr>
</table>


<div id="right_bg">
<table class="tablaResultados" border="0" cellpadding="0" cellspacing="0">

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
    <td class="tdRes1"><?php echo $row[0]; // No. ?></td>
    <td class="tdRes2"><?php echo $row[1]; // Traslado ?></td>
    <td class="tdRes3"><?php echo $row[2]; // Tamano ?></td>
    <td class="tdRes4"><?php echo $row[3]; // Fecha de envio ?></td>
    <td class="tdRes5"><a href="<?php echo $target_link; ?>?linkid=TRAS_2" target="_top" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Lista</a></td>
  </tr>

<?php

                $i++; 
        } // Cierre de while

?>

</table>

<?php 

        if (mysql_num_rows($result) < 1) {

?>
  <table class="tablaResultados" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td scope="col"><span class="letratabla">Por el momento no tienes Traslados de Muebles sin Descargar</span></td>
    </tr>
  </table>


  <?php

        } // Cierre de if norows

?>
</div>    

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


</body>
</html>