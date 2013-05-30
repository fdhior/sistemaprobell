<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
</head>

<?php 

	session_start();
	include $_SESSION['rutafunciones'].'consultas.php';

	$userinmuid = $_SESSION['userinmuid'];
	$idempleado = $_GET['idempleado'];
//	$nempleado  = $_SESSION['nempleado'];

	// unset($_SESSION['idempleado']);
	// unset($_SESSION['nempleado']); 

?>

<body>
<?php

	if ($_POST['cambiaUsuario'] == 1) {
	
		// include $_SESSION['rutafunciones'].'consultas.php';
		
		// Recupera el id de la tienda original
		$cols_arr     = array("idinmu");
		$num_cols     = count($cols_arr);
		$tables_arr   = array("gnrl_empl");
		$where_clause = "idempleado = '$idempleado'";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
		$idinmuAnterior=mysql_fetch_row($result);
		
		
		// Archiva las checadas anteriores del usuario
		$colsvalarr   = array ("archivada = '1'");
		$numcols      = count($colsvalarr);
		$aff_table    = "gnrl_echk";
		$where_clause = "idempleado = '$idempleado'";

		$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 
		
		
		// Cambia el idinmu del empleado a la nueva tienda
		$colsvalarr   = array ("idinmu = '$userinmuid'");
		$numcols      = count($colsvalarr);
		$aff_table    = "gnrl_empl";
		$where_clause = "idempleado = '$idempleado'";

		$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 
	
		// Recupera el pediodo de checadas 	
		$cols_arr     = array("MAX(periodoChecada)");
		$num_cols     = count($cols_arr);
		$tables_arr   = array("empl_chst");
		$where_clause = "idempleado = '$idempleado'";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	    $maxPeriodo=mysql_fetch_row($result);
	
		$maxPeriodoInsert = $maxPeriodo[0] + 1;
		
		// Inserta checada en la base de datos
		$colsarr = array("idEntHist", 
						 "idempleado", 
						 "idInmuOrigen", 
						 "idInmuDestino", 
						 "periodoChecada", 
						 "fechaCambio");
		$numcols = count($colsarr);
		$valarr = array("NULL", 
		                "'$idempleado'", 
						"'$idinmuAnterior[0]'",
						"'$userinmuid'",  
						"$maxPeriodoInsert",
						"CURRENT_TIMESTAMP");
		$aff_table = "empl_chst";

		$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

	} // Cierre de If Cambia Usuario

	$slength = strlen($idempleado);

	switch($slength) {
		case "1":
			$nousuario = '000'.$idempleado;
			break;
		case "2":
			$nousuario = '00'.$idempleado;
			break;		
		case "3":
			$nousuario = '0'.$idempleado;
			break;
		case "4":
			$nousuario = $idempleado;		
			break;
	}

		$cols_arr = array("nombres",      // 0 
						  "apaterno",     // 1
						  "amaterno");    // 2
//						  "idinmu",       // 3
//						  "idtempleado"); // 4
		$num_cols = count($cols_arr);
		$join_tables = '0';
		$tables_arr = array("gnrl_empl");
		$num_tables = count($tables_arr);
		$where_clause = "idempleado = '$idempleado'";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit); 

		// if (mysql_num_rows($result) == 1) {
		$row=mysql_fetch_row($result);

		$nempleado = $row[0].' '.$row[1].' '.$row[2];

?>
<br />

<APPLET CODE="InJava3.class"  
        NAME="myApplet" 
        HEIGHT=0 WIDTH=0>
</APPLET>

<h2><?php echo "$nempleado"; ?>, Validando tu asistencia mantente un momento quieto(a) por favor.<br />No. de usuario: <?php echo $nousuario; ?></h2>
<table align="center">
  <tr>
    <td valign="top" align="center">
      <!--<h3>Presiona Validar Asistencia cuando estes listo(a)</h3>-->
      <div id=muestra_camara>
      <!-- First, include the JPEGCam JavaScript Library -->
      <script type="text/javascript" src="webcam.js"></script>

      <!-- Configure a few settings -->
      <script language="JavaScript" type="text/javascript">
		var hosts = document.myApplet.getStringJava();
		// var hostme = 'probell';
		// alert('asistencia_capturachecadas.php?captura=checada&nombreHosts='+hostme+'&idempleado=<?php echo "$idempleado"; ?>');
		webcam.set_api_url( 'asistencia_capturachecadas.php?captura=checada&idempleado=<?php echo "$idempleado"; ?>&nombreHosts='+hosts );
		webcam.set_quality( 90 ); // JPEG quality (1 - 100)
		webcam.set_shutter_sound( true ); // play shutter click sound
	</script>

      <!-- Next, write the movie to the page at 320x240 -->
      <script language="JavaScript" type="text/javascript">
		document.write( webcam.get_html(320, 240) );
	</script>
    </div>
      <!-- Some buttons for controlling things -->
      <br/>
      <script language="JavaScript" type="text/javascript">
		  setTimeout ("take_snapshot()", 4000)
      </script>
      <form>
        <!--<input type="button" value="Configure..." onclick="webcam.configure()" /-->
        &nbsp;&nbsp;
        <!--<input type="button" value="Validar Asistencia" onclick="take_snapshot()" />-->
      </form>
      <!-- Code to handle the server response (see test.php) -->
      <script language="JavaScript" type="text/javascript">

		var target_link="asistencia_control.php";
		
		webcam.set_hook( 'onLoad', 'timed_snapshot' );
		webcam.set_hook( 'onComplete', 'my_completion_handler' );
		
		function timed_snapshot () {
			setTimeout ("take_snapshot()", 10000);
			// take_snapshot();
		}
				
		function take_snapshot() {

			// take snapshot and upload to server
			document.getElementById('upload_results').innerHTML = '<h1>Enviando Asistencia espera...</h1>';
			webcam.snap();
		}
		
		function my_completion_handler(msg) {
			// extract URL out of PHP output
			if (msg.match(/(http\:\/\/\S+)/)) {
				var image_url = RegExp.$1;
				// show JPEG image in page
				document.getElementById('upload_results').innerHTML = 
					'<h1>Asistencia Enviada</h1>';
			
				// reset camera for another shot
				webcam.reset();
				
				document.getElementById('muestra_camara').innerHTML = 
					// '<h3>Foto enviada:</h3>' +
					'<img src="' + image_url + '">';
					setTimeout ("redireccionar()", 800);
			}
			else alert("PHP Error: " + msg);
		}
		

		function redireccionar() 
		{
			alert("Tu asistencia ha sido enviada");
			location.href=target_link;
		} 

		function redirecError() 
		{
			alert("Tu asistencia no ha podido ser Validada");
			location.href=target_link;
		} 


</script>

		
		
	</script></td>
    <td valign="top"><div id="showpicture" style="background-color:#eee;"></div></td>
  </tr>
  <tr>
    <td valign="top" align="center"><div id="upload_results" style="background-color:#eee;"></div></td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>