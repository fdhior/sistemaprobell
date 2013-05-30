<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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

/* No */
.tdRes1 {
	width: 33px;
	text-align: center;
	/*height: 20px;*/
}

/* Tienda */
.tdRes2 {
	width: 102px;
	text-align: center;
}

/* Curso */
.tdRes3 {
	width: 152px;
	text-align: center;
}

/* Linea */
.tdRes4 {
	width: 102px;
	text-align: center;
}

/* Fecha/Hora */
.tdRes5 {
	width: 122px;
	text-align: center;
}

/* Estado */
.tdRes6 {
	width: 102px;
	text-align: center;
}

/* Opciones */
.tdRes7 {
	width: 82px;
	text-align: center;
}
-->
</style>
<?php
		session_start();
        $rutafunciones = $_SESSION['rutafunciones'];
        include $rutafunciones.'consultas.php';
        date_default_timezone_set('America/Mexico_City');
        // setlocale(LC_ALL, 'es_mx');

        $userinmuid = $_SESSION['userinmuid'];
        $loggeduser = $_SESSION['compltusrname'];
        $idusrarea  = $_SESSION['idusrarea'];
        $tipousr    = $_SESSION['tipousr'];
        $iduser     = $_SESSION['iduser'];
?>
</head>

<body>

<br />
<h2> <?php echo "$loggeduser"; ?>,  bienvenido(a) al sistema, este es el resumen actividad del Area de Administraci&oacute;n :</h2>

<p class="parrafo-2">Ultimos Cursos Dados de Alta y Confirmados (Ultimos 5)</p>
<table class="resumenHeader" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td class="tdRes1">No.</td>
    <td class="tdRes2">Tienda</td>
    <td class="tdRes3">Curso</td>
    <td class="tdRes4">L&iacute;nea</td>
    <td class="tdRes5">Fecha/Hora Alta</td>
    <td class="tdRes6">Estado</td>
    <td class="tdRes7">Opciones</td>
  </tr>  
</table>

<div id="right_bg">
<table class="tablaResultados" border="0" cellpadding="0" cellspacing="0">
<?php

       $cols_arr      = array("idcurso", 
							   "nombreinmu", 
							   "curso", 
							   "nlinea", 
							   "fechahoraalta", 
							   "curs_csta.estado");
        $num_cols      = count($cols_arr);
        $join_tables   = '1';
        $tables_arr    = array("inmu_gdat", 
		                       "curs_cdet", 
							   "curs_line", 
							   "curs_csta");
        $num_tables    = count($tables_arr);
        $on_fields_arr = array("idinmu", "idlinea", "idcursostat");
        $connect       = '1';

        $where_clause  = "curs_csta.estado = 'Confirmado'";

        $order         = "idcurso";
        $dir           = "DESC";
        $limit         = "5";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        while($row=mysql_fetch_row($result)){

?>

  <tr class="<?php	$oddevencheck = $i % 2;
                 	if ($oddevencheck == 0) {
    	           		echo "row-even";
                 	} else {
                    	echo "row-odd";
         		 	} ?>">
    <td class="tdRes1"><?php echo $row[0]; // No. ?></td>  
    <td class="tdRes2"><?php echo $row[1]; // Pedido ?></td>
    <td class="tdRes3"><?php echo $row[2]; // Enviado en ?></td>
    <td class="tdRes4"><?php echo $row[3]; // Origen ?></td>
    <td class="tdRes5"><?php echo $row[4]; // Origen ?></td>
    <td class="tdRes6"><?php echo $row[5]; // Origen ?></td>
    <td class="tdRes7"><a href="iniciolinker.php?linkid=PED_2" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Lista</a></td>
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
      <td scope="col"><span class="letratabla">Por el momento no hay informaci&oacute;n que mostrar</span></td>
    </tr>
  </table>

<?php

        } // Cierre de if norows

?>
</div>

<br />
<p class="parrafo-2">Ultimos Cursos dados de Alta y pendientes Por Confirmar (Ultimos 5):</p>

<table class="resumenHeader" border="0" cellpadding="0" cellspacing="0">
 <tr>
    <td class="tdRes1">No.</td>
    <td class="tdRes2" align="center">Tienda</td>
    <td class="tdRes3" align="center">Curso</td>
    <td class="tdRes4" align="center">L&iacute;nea</td>
    <td class="tdRes5" align="center">Fecha/Hora Alta</td>
    <td class="tdRes6" align="center">Estado</td>
    <td class="tdRes7" align="center">Opciones</td>
  </tr>
</table> 

<div id="right_bg">
<table class="tablaResultados" border="0" cellpadding="0" cellspacing="0">
<?php

        // Consulta Ultimas Visitas

        $cols_arr      = array("idcurso", "nombreinmu", "curso", "nlinea", "fechahoraalta", "curs_csta.estado");
        $num_cols      = count($cols_arr);
        $join_tables   = '1';
        $tables_arr    = array("inmu_gdat", "curs_cdet", "curs_line", "curs_csta");
        $num_tables    = count($tables_arr);
        $on_fields_arr = array("idinmu", "idlinea", "idcursostat");
        $connect       = '1';

        $where_clause  = "curs_csta.estado = 'Por confirmar'";

        $order         = "idcurso";
        $dir               = "DESC";
        $limit         = "5";


        /*$cols_arr = array("idtras", "archivo", "tamano", "origen", "gnrl_usrs.nombre", "fechaenvio");
        $num_cols = count($cols_arr);
        $join_tables = '1';
        $tables_arr = array("gnrl_usrs", "sucr_tlog");
        $num_tables = count($tables_arr);
        $on_fields_arr = array("idinmu");       

//      $where_clause = "origen = '$userinmuid'";

        $order = "sucr_tlog.fechaenvio";
        $dir = "DESC";
        $limit = "5";*/

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        while($row=mysql_fetch_row($result)){

?>

  <tr class="<?php	$oddevencheck = $i % 2;
                 	if ($oddevencheck == 0) {
    	           		echo "row-even";
                 	} else {
                    	echo "row-odd";
         		 	} ?>">
    <td class="tdRes1"><?php echo $row[0]; // No.        ?></td>  
    <td class="tdRes2"><?php echo $row[1]; // Traslado   ?></td>
    <td class="tdRes3"><?php echo $row[2]; // Tamaño     ?></td>
    <td class="tdRes4"><?php echo $row[3]; // Destino    ?></td>
    <td class="tdRes5"><?php echo $row[4]; // Enviado en ?></td>
    <td class="tdRes6"><?php echo $row[5]; // Enviado en ?></td>
    <td class="tdRes7"><a href="iniciolinker.php?linkid=TRAS_2" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Lista</a></td>
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
      <td scope="col"><span class="letratabla">Por el momento no hay informaci&oacute;n que mostrar</span></td>
    </tr>
  </table>

<?php

        } // Cierre de if norows

?>
</div>

<br />
<p class="parrafo-2">Ultimos Cursos Cancelados (Ultimos 5):</p>

<table class="resumenHeader" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="tdRes1">No.</td>
    <td class="tdRes2" align="center">Tienda</td>
    <td class="tdRes3" align="center">Curso</td>
    <td class="tdRes4" align="center">L&iacute;nea</td>
    <td class="tdRes5" align="center">Fecha/Hora Cancelado</td>
    <td class="tdRes6" align="center">Estado</td>
    <td class="tdRes7" align="center">Opciones</td>
  </tr>
</table>

<div id="right_bg">
<table class="tablaResultados" border="0" cellpadding="0" cellspacing="0">
<?php

        // Consulta Ultimas Visitas

        $cols_arr      = array("idcurso", 
		                       "nombreinmu", 
							   "curso", 
							   "nlinea", 
							   "fechahoracancelado", 
							   "curs_csta.estado");
        $num_cols      = count($cols_arr);
        $join_tables   = '1';
        $tables_arr    = array("inmu_gdat", 
		                       "curs_cdet", 
							   "curs_line", 
							   "curs_csta");
        $num_tables    = count($tables_arr);
        $on_fields_arr = array("idinmu", 
		                       "idlinea", 
							   "idcursostat");
        $connect       = '1';

        $where_clause  = "curs_cdet.idcursostat = '3'";

        $order         = "idcurso";
        $dir               = "DESC";
        $limit         = "5";


        /*$cols_arr = array("idtras", "archivo", "tamano", "origen", "gnrl_usrs.nombre", "fechaenvio");
        $num_cols = count($cols_arr);
        $join_tables = '1';
        $tables_arr = array("gnrl_usrs", "sucr_tlog");
        $num_tables = count($tables_arr);
        $on_fields_arr = array("idinmu");       

//      $where_clause = "origen = '$userinmuid'";

        $order = "sucr_tlog.fechaenvio";
        $dir = "DESC";
        $limit = "5";*/

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        while($row=mysql_fetch_row($result)){

?>

  <tr class="<?php	$oddevencheck = $i % 2;
                 	if ($oddevencheck == 0) {
    	           		echo "row-even";
                 	} else {
                    	echo "row-odd";
         		 	} ?>">    
    <td class="tdRes1"><?php echo $row[0]; // No. ?></td>
    <td class="tdRes2"><?php echo $row[1]; // Traslado ?></td>
    <td class="tdRes3"><?php echo $row[2]; // Tama&ntilde;o ?></td>
    <td class="tdRes4"><?php echo $row[3]; // Destino ?></td>
    <td class="tdRes5"><?php echo $row[4]; // Enviado en ?></td>
    <td class="tdRes6"><?php echo $row[5]; // Enviado en ?></td>
    <td class="tdRes7"><a href="iniciolinker.php?linkid=TRAS_2" onmouseover="return hidestatus()" onclick="return hidestatus()">Ver Lista</a></td>
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
    <td scope="col"><span class="letratabla">Por el momento no hay informaci&oacute;n que mostrar</span></td>
  </tr>
</table>

<?php

        } // Cierre de if norows

?>
</div>

</body>
</html>