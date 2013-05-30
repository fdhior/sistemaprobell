<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detalle Contrase&ntilde;as Tiendas</title>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.frmListaContras {
	position: relative;
	
    width: 400px;
    height: 220px;
}

.btnCancelar {
	position: absolute;
	top: 332px;
	left: 310px;
}

#form0 {
	position: absolute;
	left: 10px;
	border: 1px solid #000;
	top: 307px;
	width: 247px;
}

#form1 {
	position: absolute;
	left: 10px;
	border: 1px solid #000;
	top: 349px;
	width: 247px;
}
-->
</style>

<script language="javascript">


	function buscaporbnombre()
	{
		document.forms[0].submit();
	}

	function buscaportienda() 
	{
		document.forms[1].submit();
	}
	
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
	$idtipousr    = $_SESSION['idtipousr'];
	
	$relpath      = 'supervision/usuarios/supervision_';
	
	$targetLink  = $hostname.$relpath.'usuarioscontraslistado.php';
	$targetFrame = 'frmListaContras';
	 	
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
<h2>Listado de Contraseñas Usuarios Tiendas
</h2><div style="position:absolute; left: 0px; top: 50px; border: 1px solid #000; width:400px;">
<table class="tbl400HeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33">No.</td>
    <td width="130">NombreUsuario</td>
    <td width="100">Contrase&ntilde;a</td>
    <td>Estado</td>
  </tr>
</table>

<iframe class="frmListaContras" name="frmListaContras" src="<?php echo $targetLink ?>?idempleado=<?php echo $idempleado; ?>&periodoChecada=<?php echo $periodoChecada; ?>" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0"></iframe>

</div>

<form id="form0" name="form0" method="post" action="<?php echo $targetLink; ?>" target="<?php echo $targetFrame; ?>">
    <label class="letra_predeterminada12">Busqueda por nombre:
          <input name="nombreusuario" type="text" id="nombreusuario" size="15" maxlength="15" onchange="javascript: buscapornombre()"/>
          <input name="busca" type="hidden" id="busca" value="pornombre" />
  </label>
</form>   

<form id="form1" name="form1" method="post" action="<?php echo $targetLink; ?>" target="<?php echo $targetFrame; ?>">
<label class="letra_predeterminada12">Busqueda por Tienda:

        <select name="sel_inmu" class="letra_botton11" id="sel_inmu" onchange="javascript: buscaportienda()">
          <?php

		$cols_arr     = array("idinmu", "nombreinmu");
    	$num_cols     = count($cols_arr);
		$tables_arr   = array("inmu_gdat");

   		switch ($idtipousr) {
			case "1":			
				$where_clause = "idinmustat = 1";
				break;
			case "2":
			case "3":
				$where_clause = "idinmutipo <> 5 AND idinmutipo <> 6 AND idinmustat = 1";
				break;
		}
			 
		$order 		  = "nombreinmu";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
		unset($where_clause);
		unset($order);
//    $row=mysql_fetch_row($result);
	
		while($row=mysql_fetch_row($result)) {
			echo "<option value=\"$row[0]\">$row[1]</option>";
		}   // cierre de While

?>
        </select>
     
        <input name="busca" type="hidden" id="busca" value="portienda" />
  </label>
</form>      


<button class="btnCancelar" onclick="javascript: cierraventana()">Cerrar</button>

</body>
</html>