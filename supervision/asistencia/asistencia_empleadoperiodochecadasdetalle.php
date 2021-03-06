<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detalle de Periodo de Checadas</title>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.frmPeriodoChecadas {
	position: relative;
	
    width: 971px;
    height: 220px;
}

.btnCancelar {
	position: absolute;
	top: 296px;
	left: 913px;
}
-->
</style>

<script language="javascript">

	function cierraventana()
	{
		window.close();		
	}

</script>
<?php

	session_start();
	
	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';

	$hostname     = $_SESSION['hostname'];
	$relpath      = 'supervision/asistencia/asistencia_';
	
	$targetLink  = $hostname.$relpath.'empleadoperiodochecadaslistado.php';
	$targetFrame = 'frmPeriodoChecadas';
//	$target_link2 = $hostname.$relpath.'asistencia_ejecutamodificar.php';
	 	
	foreach ($_GET as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
    		${$nombre} = $valor;
		}
	}// Cierre foreach     

?>
</head>

<body>
<?php

	// Definicion de los parametros de la consulta
	$cols_arr      = array("periodoChecada", // 0
						   "nombres",        // 1   
						   "apaterno",       // 2 
						   "amaterno",       // 3
						   "fechaCambio");   // 4 
	$num_cols      = count($cols_arr);
   	$join_tables   = '1';
    $tables_arr    = array("gnrl_empl", 
						   "empl_chst");
    $num_tables    = count($tables_arr);
	$on_fields_arr = array("idempleado");
	$connect       = '1';
	$where_clause  = "gnrl_empl.idempleado = '$idempleado' AND empl_chst.periodoChecada = '$periodoChecada'";         

    // Llama a la función de las consultas
    $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
                
	unset($join_tables);
	unset($on_fields_arr);
	unset($connect);

	$col=mysql_fetch_row($result);
	
	$periodoSiguiente = $col[0] + 1;
	
	// Definicion de los parametros de la consulta
	$cols_arr      = array("fechaCambio"); // 0
	$num_cols      = count($cols_arr);
    $tables_arr    = array("empl_chst");
    $num_tables    = count($tables_arr);

	$where_clause  = "idempleado = '$idempleado' AND periodoChecada = '$periodoSiguiente'";         

    // Llama a la función de las consultas
    $finalPeriodo_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	$mquery_nrows=mysql_num_rows($finalPeriodo_rset);
                
	if ($mquery_nrows < 1) {
		$finalPeriodo = 'el D&iacute;a de Hoy';
	} else {  
		$arrFinalPeriodo=mysql_fetch_row($finalPeriodo_rset);
		$finalPeriodo = $arrFinalPeriodo[0];
	}

?>		


<br />
<h2>Detalle del periodo <?php echo $col[0]; ?> para el empleado <?php echo $col[1].' '.$col[2].' '.$col[3]; ?> de  <?php echo $col[4]; ?> a <?php echo $finalPeriodo; ?> </h2> 

<div style="position:absolute; left: 0px; top: 50px; border: 1px solid #000; width: 971px;">
<table class="tblHeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33" align="center">No.</td>
    <td width="100" align="center">Foto</td>
    <td width="130" align="center">Nombre </td>
    <td width="100" align="center">Tipo Empleado</td>
    <td width="120" align="center">Lugar de Trabajo</td>
    <td width="176" align="center">RFC Lugar de Trabajo</td>
    <td width="120" align="center">Lugar Checada</td>
    <td width="80" align="center">Fecha</td>
    <td align="center">Hora</td>
  </tr>
</table>

<iframe class="frmPeriodoChecadas" name="frmPeriodoChecadas" src="<?php echo $targetLink ?>?idempleado=<?php echo $idempleado; ?>&periodoChecada=<?php echo $periodoChecada; ?>" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0"></iframe>

</div>

<button class="btnCancelar" onclick="javascript: cierraventana()">Cerrar</button>

</body>
</html>