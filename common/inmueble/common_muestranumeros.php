<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Numeros Telefonicos de Esta Tienda</title>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />

<style type="text/css">

.select3 {	width: 75px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: small-caps;
}

.input1 {	width: 90px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: normal;
}

#leftform-div {
	position: absolute;
	left: 27px;
	top: 57px;
}

#rightform-div {
	position: absolute;
	left: 350px;
	top: 68px;
	width: 263px;
	height: 153px;
}

.input2 {	width: 70px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: normal;
}

.input3 {	width: 80px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-variant: normal;
}

.table_td8 {	width: 90px;
	position: relative;
	left: 0px;
	text-align: center;
	padding: 0px;
}

#Div_Botones {
	position:absolute;
	left:350px;
	top:250px;
	width:209px;
	height:67px;
	z-index:1;
}
</style>

<?php

	session_start();
	include $_SESSION['rutafunciones']."consultas.php";

	$hostname     = $_SESSION['hostname'];
	$relpath      = 'common/inmueble/';
	
	$target_link  = $hostname.$relpath.'asistencia_empleadoslistado.php';
//	$target_link2 = $hostname.$relpath.'asistencia_ejecutamodificar.php';
	 	
	foreach ($_GET as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
    		${$nombre} = $valor;
		}
	}// Cierre foreach     

?>

<!--<script type="text/javascript" src="asistencia_empleadoslistadogen.js"></script>-->

<script language="javascript">

	/*function actualizaregistro()
	{
		updateRow(document.forms.form_grid, <?php echo $idempleado; ?>);
//		document.forms[0].submit(); 
		document.forms[0].submit();
     	setTimeout ("", 1200);
		alert("Los Datos fueron Actualizados");
		window.close();

	}*/

	function cmdCierraVentana()
	{
		window.close();		
	}

</script>

</head>

<body>

<?php

		$cols_arr      = array("nombreinmu",     // 0
							   "notel1",         // 1
							   "notel2",         // 2
							   "nocel",          // 3   
							   "nofax",          // 4 
							   "correoe");       // 5    
		$num_cols      = count($cols_arr);
	    $tables_arr    = array("inmu_gdat");

		$where_clause = "idinmu = '$idtienda'";

  		$infContactoRset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
		unset($join_tables);
		unset($on_fields_arr);
		unset($connect);
		unset($where_clause);

		$row=mysql_fetch_row($infContactoRset);
	

?>
<br />
<h2>Números Telefónicos e Información de Contacto<br />
para la Tienda: <strong><?php echo $row[0]; ?></strong> <br />
</h2>



<div id="leftform-div">
  <p  class="asistencia_tipoletra">No. Telef&oacute;nico 1: <strong><?php echo $row[1]; ?> </strong> <br />
	 No. Telef&oacute;nico 2: <strong><?php echo $row[2]; ?> </strong> <br />
	 No. Celular: <strong><?php echo $row[3]; ?> </strong> <br />
     No. Fax: <strong><?php echo $row[4]; ?> </strong> <br />  
     Correo Electrónico: <strong><?php echo $row[5]; ?> </strong> <br />        
     	
  </p>
<button name="Cierra" onclick="javascript: cmdCierraVentana()" >Cerrar</button>
</div>


<form id="form0" name="form0" method="post" action="<?php echo $target_link; ?>" target="moduser_frame">
  <input type="hidden" name="busca" id="busca" value="pornousuario" />
  <input type="hidden" name="nousuario" id="nousuario" value="<?php echo $idempleado; ?>" />
</form>


<form id="form1" name="form1" method="post" action="<?php echo $hostname.$relpath.$target_link; ?>" target="moduser_frame">
  <input type="hidden" name="busca" id="busca" value="pornoempleado" />
  <input type="hidden" name="idempleado" id="idempleado" value="<?php echo $idempleado; ?>" />
</form>




</body>
</html>