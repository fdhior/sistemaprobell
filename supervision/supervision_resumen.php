<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!--<link href="../css/sistemaprobell.css" rel="stylesheet" type="text/css" />-->
<link href="../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../css/modulo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.trhdfontbgcolor {
	background-image: url(../images/bg-submenu-td2.png);
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

#divSupervision {
	background-color: #FFF;
}

.tdRes1 {
	width: 33px;
	text-align: center;
}


.tdRes2 {
	width: 100px;
	text-align: center;
}

.tdRes3 {
	width: 150px;
	text-align: center;
}

.tdRes4 {
	width: 100px;
	text-align: center;
}

.tdRes5 {
	width: 100px;
	text-align: center;
}

.tdRes6 {
	width: 150px;
	text-align: center;
}

.tdRes7 {
	width: 67px;
	text-align: center;
}

.tdRes8 {
	width: 217px;
	text-align: center;
}

-->
</style>
<?php
		
		session_start();

        include $_SESSION['rutafunciones'].'consultas.php';
        date_default_timezone_set('America/Mexico_City');
        // setlocale(LC_ALL, 'es_mx');

        $hostname   = $_SESSION['hostname'];
		$userinmuid = $_SESSION['userinmuid'];
        $loggeduser = $_SESSION['compltusrname'];
        $idusrarea  = $_SESSION['idusrarea'];
        $tipousr    = $_SESSION['tipousr'];
        $iduser     = $_SESSION['iduser'];
	
		$target_link = $hostname.'iniciolinker.php';
		
?>
</head>

<body>


<br />
<br />
<h2> <?php echo "$loggeduser"; ?>,  bienvenido(a) al sistema, este es el resumen actividad de Pedidos y Traslados las Tiendas :</h2>

<p class="parrafo-2">Ultimos Pedidos enviados <strong>SIN DESCARGAR</strong> de Tienda (Ultimos 5)</p>
<br />
<table class="resumenHeader" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="tdRes1">No.</td>
    <td class="tdRes2">Pedido</td>
    <td class="tdRes3">Enviado en</td>
    <td class="tdRes4">Origen</td>
    <td class="tdRes5">Destino</td>
    <td class="tdRes6">Observaciones</td>
    <td class="tdRes7">M&aacute;s Pedidos</td>
  </tr>
</table>
<div id="right_bg">
<table class="tablaResultados" border="0" cellpadding="0" cellspacing="0">

<?php

        // Consulta Ultimos pedidos
        $cols_arr = array("idped",
	                      "archivo", 
		                  "fechahoraenvio", 
						  "inmu_gdat.nombreinmu", 
						  "destino", 
						  "observaciones");
        $num_cols = count($cols_arr);
        $join_tables = '1';
        $tables_arr = array("inmu_gdat", 
		                    "sucr_plog");
        $num_tables = count($tables_arr);
        $on_fields_arr = array("idinmu"); 

        $where_clause = "descargado = '0'";
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
    <td class="tdRes1"><?php echo $row[0]; // No. ?></td>
    <td class="tdRes2"><?php echo $row[1]; // Pedido ?></td>
    <td class="tdRes3"><?php echo $row[2]; // Enviado en ?></td>
    <td class="tdRes4"><?php echo $row[3]; // Origen ?></td>
    <td class="tdRes5"><?php
                                                  switch($row[4]) {
                                                          case "0":
                                                                  echo "CEDIS";
                                                                  break;
                                                          case "20":
                                                                  echo "Muebles";
                                                                  break;
                                                   } // Destino?></td>

    <td class="tdRes6"><?php
                                                   $mensaje_en_corto = substr($row[5], 0, 17);
                                                   if ($mensaje_en_corto == "Ninguno") {
                                                          echo "$mensaje_en_corto";
                                                   } else {
                                                          if (strlen($mensaje_en_corto) >= 17) {
                                                                echo "$mensaje_en_corto...";
                                                          } else {
                                                                echo "$mensaje_en_corto";
                                                   }
                                             }// Observaciones ?></td>
    <td class="letratabla" align="center"><a href="<?php echo $target_link; ?>?linkid=PED_1" target="_top" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Lista</a></td>
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
      <td scope="col"><span class="letratabla">Por el momento no hay pedidos que las tiendas hayan enviado</span></td>
    </tr>
  </table>

<?php

        } // Cierre de if norows

?>
</div>
<p class="parrafo-2">&nbsp;</p>

<p class="parrafo-2">Ultimos Traslados SIN DESCARGAR enviados a Tienda (Ultimos 5):
  <!-- TABLA DE ULTIMOS PENDIENTES -->
</p>
<table class="resumenHeader" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="tdRes1">No.</td>
    <td class="tdRes2">Traslado</td>
    <td class="tdRes4">Origen</td>
    <td class="tdRes5">Destino</td>
    <td class="tdRes3">Enviado En</td>
    <td class="tdRes8">M&aacute;s Traslados</td>
  </tr>
</table>
<div id="right_bg">
  <table class="tablaResultados" border="0" cellpadding="0" cellspacing="0">

  
<?php

        // Consulta Ultimas Visitas
        $cols_arr = array("idtras",
		                  "archivo", 						   
						  "origen", 
						  "inmu_gdat.nombreinmu", 
						  "fechaenvio");
        $num_cols = count($cols_arr);
        $join_tables = '1';
        $tables_arr = array("inmu_gdat", 
		                    "sucr_tlog");
        $num_tables = count($tables_arr);
        $on_fields_arr = array("idinmu");       

//      $where_clause = "origen = '$userinmuid'";

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
    <td class="tdRes4"><?php
                                                  switch($row[2]) {
                                                          case "0":
                                                                  echo "CEDIS";
                                                                  break;
                                                          case "20":
                                                                  echo "Muebles";
                                                                  break;
                                                   } // Destino?></td>
    <td class="tdRes5"><?php echo $row[3]; // Destino ?></td>
    <td class="tdRes3"><?php echo $row[4]; // Enviado en ?></td>
    <td class="tdRes8"><a href="<?php echo $target_link; ?>?linkid=TRAS_1" target="_top" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Lista</a></td>
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
      <td scope="col"><span class="letratabla">Por el momento no se han enviado traslados a ninguna Tienda</span></td>
    </tr>
  </table>

<?php

        } // Cierre de if norows

?>
</div>
<p class="parrafo-2">&nbsp;</p>


</body>
</html>
