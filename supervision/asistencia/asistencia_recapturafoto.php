<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Volver A Capturar Fotografia Inicial</title>
<?php

	session_start();
	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';

	// Variables Globales a Locales
	$hostname    = $_SESSION['hostname'];
	$relpath     = 'supervision/asistencia/';
	$target_link = $hostname.$relpath.'asistencia_empleadoslistado.php';
	
	foreach ($_GET as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
    		${$nombre} = $valor;
		}
	}// Cierre foreach     

?>

<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php

        $cols_arr     = array("nombres", "apaterno", "amaterno");
        $num_cols     = count($cols_arr);
        $tables_arr   = array("gnrl_empl");
//      $num_tables = count($tables_arr);
		$where_clause = "idempleado = '$idempleado'";

  		$nempleado_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

		$row=mysql_fetch_row($nempleado_rset);
	
		$nempleado = $row[0].' '.$row[1].' '.$row[2];
	
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
<p class="letramoduser">Volver A Capturar Imagen Inicial del Empleado(a): <br /><strong><?php echo "$nempleado."; ?></strong><br /></p>

<h3 align="center">Hola <?php echo "$nempleado"; ?>, por favor Colocate frente a la camara y permanece quieto(a)</h3>

<table align="center">
  <tr>
    <td valign="top" align="center">
      <h3>Presiona Capturar cuando estes listo(a)</h3>
      <div id=muestra_camara>
      <!-- First, include the JPEGCam JavaScript Library -->
      <script type="text/javascript" src="webcam.js"></script>

      <!-- Configure a few settings -->
      <script language="JavaScript" type="text/javascript">
		webcam.set_api_url( 'asistencia_capturachecadas.php?captura=recaptura&idempleado=<?php echo $idempleado; ?>' );
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
      <form>
        <!--<input type="button" value="Configure..." onclick="webcam.configure()" /-->
        &nbsp;&nbsp;
        <input type="button" value="Capturar" onclick="take_snapshot()" />
        <input type="button" value="Cancelar" onclick="close_window()"  />
      </form>
      <!-- Code to handle the server response (see test.php) -->
      <script language="JavaScript" type="text/javascript">

		webcam.set_hook( 'onComplete', 'my_completion_handler' );
		
		function take_snapshot() {
			// take snapshot and upload to server
			document.getElementById('upload_results').innerHTML = '<h1>Enviando Captura espera...</h1>';
			webcam.snap();
		}
		
		function my_completion_handler(msg) {
			// extract URL out of PHP output
			if (msg.match(/(http\:\/\/\S+)/)) {
				var image_url = RegExp.$1;
				// show JPEG image in page
				document.getElementById('upload_results').innerHTML = 
					'<h1>Captrura Enviada</h1>';
			
				// reset camera for another shot
				webcam.reset();
				
				document.getElementById('muestra_camara').innerHTML = 
					// '<h3>Foto enviada:</h3>' +
					'<img src="' + image_url + '">';
					document.forms[1].submit();
//					setTimeout ("", 1200);
					window.close();
			}
			else alert("PHP Error: " + msg);
		}
		
		function close_window()
		{
			window.close();
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
<form id="form1" name="form1" method="post" action="<?php echo $target_link; ?>" target="moduser_frame">
  <input type="hidden" name="busca" id="busca" value="pornousuario" />
  <input type="hidden" name="nousuario" id="nousuario" value="<?php echo $idempleado; ?>" />
</form>
</body>
</html>