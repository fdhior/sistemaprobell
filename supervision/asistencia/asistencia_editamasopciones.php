<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Datos Generales de un Empleado</title>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
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
	left: 25px;
	top: 68px;
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
	
	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';

	$hostname     = $_SESSION['hostname'];
	$relpath      = 'supervision/asistencia/';
	
	$target_link  = $hostname.$relpath.'asistencia_empleadoslistado.php';
//	$target_link2 = $hostname.$relpath.'asistencia_ejecutamodificar.php';
	 	
	foreach ($_GET as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
    		${$nombre} = $valor;
		}
	}// Cierre foreach     

?>

<script type="text/javascript" src="asistencia_empleadoslistadogen.js"></script>

<script language="javascript">

	function actualizaregistro()
	{
		updateRow(document.forms.form_grid, <?php echo $idempleado; ?>);
//		document.forms[0].submit(); 
//		document.forms[0].submit();
     	setTimeout ("", 1200);
		alert("Los Datos fueron Actualizados");
		window.close();

	}

	function cierraventana()
	{
		window.close();		
	}

</script>

<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php

		$cols_arr      = array("pbnoempleado",               // 0
							   "capturainicial",             // 1
							   "nombres",                    // 2   
							   "apaterno",                   // 3 
							   "amaterno",                   // 4
							   "inmu_gdat.nombreinmu",       // 5  
							   "gnrl_temp.tipoempleado",     // 6  
							   "fechanac",                   // 7
							   "nss",                        // 8
							   "gnrl_empl.direccion",        // 9    
							   "notelefonico",               // 10
							   "gnrl_empl.correoe",          // 11	
							   "horaentrada",                // 12
							   "horasalida",                 // 13  	
							   "tolerancia",                 // 14 
							   "fecha_ci");                  // 15    
		$num_cols      = count($cols_arr);
	   	$join_tables   = '1';
	    $tables_arr    = array("inmu_gdat",
							   "gnrl_empl",
							   "gnrl_temp");
	    $num_tables    = count($tables_arr);
		$on_fields_arr = array("idinmu", "idtempleado");
		$connect       = '1';
//		$order         = "idempleado, nombreinmu";

		$where_clause = "idempleado = '$idempleado'";

  		$nempleado_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
		unset($join_tables);
		unset($on_fields_arr);
		unset($connect);
		unset($where_clause);

		$row=mysql_fetch_row($nempleado_rset);
	
		$nempleado = $row[2].' '.$row[3].' '.$row[4];
	
		$slength = strlen($idempleado);

		switch($slength) {
			case "1":
				$noempleado = '000'.$idempleado;
				break;
			case "2":
				$noempleado = '00'.$idempleado;
				break;		
			case "3":
				$noempleado = '0'.$idempleado;
				break;
			case "4":
				$noempleado = $idempleado;		
				break;
		}

?>
<div id="Div_Botones"> <button onclick="javascript: actualizaregistro()">Actualizar Datos</button>
    <button onclick="javascript: cierraventana()">Cancelar</button></div>
<br />
<h2>Editar Datos Generales del Empleado(a): <strong><?php echo "$nempleado"; ?></strong> <br />
No. Empleado Probell: <?php echo "$noempleado."; ?></h2>

<!--<form name="form0" id="form0" action="<?php // $_SERVER['PHP_SELF']; ?>" method="get" target="_self">
  <input type="hidden" name="idempleado" id="idempleado" value="<?php // echo $idempleado; ?>" />
</form>-->

<form id="form0" name="form0" method="post" action="<?php echo $target_link; ?>" target="moduser_frame">
  <input type="hidden" name="busca" id="busca" value="pornousuario" />
  <input type="hidden" name="nousuario" id="nousuario" value="<?php echo $idempleado; ?>" />
</form>

<form name="form_grid">
<div id="leftform-div">
  
  <img src="<?php echo $hostname.$relpath.$row[1];// Foto ?>" width="100" height="60" align="left" />

        <label for="nombres">&nbsp;&nbsp;Nombre(s)</label>
        <input name="nombres" type="text" class="input1" id="textfield" value="<?php echo $row[2];  // Nombre(s)        ?>" />
        <br />
        <label for="apaterno">&nbsp;&nbsp;A. Paterno</label>
        <input name="apaterno" type="text" class="input1" id="textfield2" value="<?php echo $row[3];  // Nombre(s)        ?>" />
        <br />
        <label for="amaterno">&nbsp;&nbsp;A. Materno</label>
        <input name="amaterno" type="text" class="input1" id="textfield3" value="<?php echo $row[4];  // Nombre(s)        ?>" />
        <br />
        <br />
    <label for="fechanac">Fecha de Nacimiento</label>

        <input class="input2" type="text" name="fechanac" id="textfield4" value="<?php echo $row[7]; // Fecha de Nacimiento ?>" />
        <br />
    <label for="nss">N.S.S.</label>

        <input class="input3" type="text" name="nss" id="nss" value="<?php echo $row[8]; // N.S.S.    ?>" />
        <br />
    <label for="notelefonico">No. Telefónico</label>
        
        <input class="input2" type="text" name="notelefonico" id="notelefonico" value="<?php echo $row[10]; // Fecha Alta ?>" />
        <br />
        <br />
        Horario<br />
        <br />
        <label for="horaentrada">Hora de Entrada</label>
        
        <select class="select3" name="horaentrada">
          <?php

//		if ($invalid_check == '1') {
//			echo "<option selected>$sel_rsc</option>";		
//		} else {
			echo '<option value="0" selected>'.$row[12].'</option>';		
//		}

        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr     = array("idhora", "hora");
        $num_cols     = count($cols_arr);
        $tables_arr   = array("gnrl_hora");
        $num_tables   = count($tables_arr);
//		$where_clause = "idhora < '11'";

  		$estado_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        while($row1=mysql_fetch_row($estado_rset)) {
//	       	if ($row1[1] <> $row[12]) {	
				echo '<option value="'.$row1[0].'">'.$row1[1].'</option>';
//			}	
        }   // cierre de While
		?>
        </select>
        <br />
        <label for="horasalida"></label>
        <label for="horasalida">Hora de Salida</label>
        
        <select class="select3" name="horasalida">
          <?php

//		if ($invalid_check == '1') {
//			echo "<option selected>$sel_rsc</option>";		
//		} else {
			echo '<option value="0" selected>'.$row[13].'</option>';		
//		}

        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr     = array("idhora", "hora");
        $num_cols     = count($cols_arr);
        $tables_arr   = array("gnrl_hora");
        $num_tables   = count($tables_arr);
//		$where_clause = "idhora > '11'";

  		$estado_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
//		unset($where_clause);
		
        while($row2=mysql_fetch_row($estado_rset)) {
//	       	if ($row2[1] <> $row[13]) {	
				echo '<option value="'.$row2[0].'">'.$row2[1].'</option>';
//			}	
        }   // cierre de While
		?>
        </select>
        <br />
        <label for="tolerancia">Tolerancia:</label>
		<select name="tolerancia" class="select3" id="tolerancia">
         <?php

		echo '<option selected="selected">'.$row[14].'</option>';		

        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr     = array("idtolerancia", "valortolerancia");
        $num_cols     = count($cols_arr);
        $tables_arr   = array("empl_tole");
        $num_tables   = count($tables_arr);
//		$where_clause = "idhora > '11'";

  		$estado_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        while($row3=mysql_fetch_row($estado_rset)) {
//	       	if ($row3[1] <> $row[14]) {	
				echo '<option value="'.$row3[0].'">'.$row3[1].'</option>';
//			}	
        }   // cierre de While
		?>
    </select>

</div>

<div id="rightform-div">
    <label>Dirección</label>
    <br />
    <textarea name="direccion" id="direccion" cols="30" rows="5"><?php echo $row[9];  // Nombre(s)        ?></textarea>
    <br />
    <label for="correoe">Correo-e</label>
    
    <input class="input2" type="text" name="correoe" id="correoe" value="<?php echo $row[11]; // Correo Electronico ?>" />
    <br />
    Lugar de Trabajo:<strong><?php echo $row[5]; ?></strong><br />
  Puesto:<strong><?php echo $row[6]; ?></strong><br>
  <br />
    Fecha de Alta en Sistema: <strong><?php echo $row[15]; ?></strong>
    <br />
    <!-- <input type="submit" name="Actualizar" id="Actualizar" value="Actualizar Datos" onclick="javascript: actualizaregistro()" /> -->
   
    <input type="hidden" name="action" id="action" value="UPDATE_ROW" />
    <input type="hidden" name="list" id="list" value="empGen" />
    <input type="hidden" name="id" id="hiddenField3" value="<?php echo $idempleado; ?>" />
</div>

</form>


<form id="form1" name="form1" method="post" action="<?php echo $hostname.$relpath.$target_link; ?>" target="moduser_frame">
  <input type="hidden" name="busca" id="busca" value="pornoempleado" />
  <input type="hidden" name="idempleado" id="idempleado" value="<?php echo $idempleado; ?>" />
</form>


<p>&nbsp;</p>



</body>
</html>