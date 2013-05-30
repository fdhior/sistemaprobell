<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href="../../css/sistemaprobell.css" />

<style type="text/css">
<!--

.tablaagrtienda {
	padding-left: 26px;
	width: 800px;
}


.letraadtienda {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: normal;
        color: #000000;
        padding-left: 26px;
}

.letraadtienda_nopadd {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	color: #000000;
}


.letra_alertaestado_nopadd {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #CC0000;
        font-weight: bold;
}
.letra_alertaestado {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 11px;
        color: #CC0000;
        font-weight: bold;
		padding-left: 26px;
}

-->
</style>
<script language="JavaScript" src="calendario/javascripts.js"></script>
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

	session_start();
	
	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';
	$loggeduser = $_SESSION['compltusrname'];
	$hostname   = $_SESSION['hostname'];
//	$idusrarea 	= $_SESSION['idusrarea'];
//	$tipousr    = $_SESSION['tipousr'];
//	$iduser     = $_SESSION['iduser'];

	$rel_path    = 'supervision/asistencia/';
	$target_link = $hostname.$rel_path.'asistencia_registraempleado.php';






/*	echo "<span class=\"tipoletra\">Valores de _GET</span><br />";
	foreach ($_GET as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
		}
	}   

 	echo "<span class=\"tipoletra\">Valores de _POST</span><br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
		}
	}   */

 	/*echo "<span class=\"tipoletra\">Valores de _SESSION</span><br />";
	foreach ($_SESSION as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
		}
	}*/    

//	print_r($_SESSION['err_return']);

    if (isset($_SESSION['err_return'])) {
// 		$invalid_check = $_SESSION['err_return']['invalid_check'];
		$err_return = $_SESSION['err_return'];
		foreach ($err_return as $nombre => $valor) {
		   	${$nombre} = $valor;
		} // Cierre foreach     
	} 
	unset($_SESSION['err_return']);

    if (isset($_SESSION['var_return'])) {
// 		$agr_empleado = $_SESSION['var_return']['agr_empleado'];
		$var_return = $_SESSION['var_return'];
		foreach ($var_return as $nombre => $valor) {
		   	${$nombre} = $valor;
		} // Cierre foreach     
	} 
//	unset($_SESSION['var_return']);

//echo 'valor de sel_inmu '.$sel_inmu;

//	echo "<br />valor de agr_empleado: $agr_empleado";	

?>
<br />
<h2><?php echo "Usuario: ".$loggeduser; ?>, Agregar empleado al Sistema de Control de Asistencia: </h2>


<?php
    /*if (isset($_SESSION['invalid_check'])) {
	    $invalid_check = $_SESSION['invalid_check'];
    }
    unset($_SESSION['invalid_check']);
	
    if (isset($_SESSION['invalid_check2'])) {
	    $invalid_check2 = $_SESSION['invalid_check2'];
    }
    unset($_SESSION['invalid_check2']);
	
	
    if (isset($_POST['agr_tienda'])) {
	    $agr_tienda = $_SESSION['agr_tienda'];
    }
//  unset($_SESSION['invalid_check']); */

    if (isset($_GET['agr_empleado'])) {
	    $agr_empleado = $_GET['agr_empleado'];
    }


//      echo "invalid check = $invalid_check<br />";

  /*echo "<span class=\"tipoletra\">Valores de _POST</span><br />";
    foreach ($_POST as $nombre => $valor) {
 	   if(stristr($nombre, 'button') === FALSE) {
    	   print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />";
       }
   }  */
	
	// print_r($_SESSION['permisos']);	

    if (!isset($_POST['empleado_check']) && !isset($invalid_check) && !isset($agr_empleado)) {

?>
<table class="tablaagrtienda" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
      <td><p><span class="letraadtienda_nopadd">Datos  del Empleado<br />
      </span>
          <label class="letraadtienda_nopadd">Nombre(s):
        <input name="nombres" type="text" id="textfield" size="30" maxlength="40" />
        </label>
        <label class="letraadtienda_nopadd"> <br />
          Apellido Paterno</label>
        <label for="amaterno"></label>
        <input type="text" name="apaterno" id="apaterno" />
          
          <br />
          <label class="letraadtienda_nopadd">Apellido Materno
            <input type="text" name="amaterno" id="amaterno" />
          </label>
          <br />
          <label class="letraadtienda_nopadd">Apellido
            <span class="letraadtienda_nopadd">Tipo de Empleado:</span>
            <select name="sel_templeado" id="sel_templeado">
              <?php

		/*if ($invalid_check == '1') {
			echo "<option selected>$sel_rsc</option>";		
		} else { */
			echo "<option selected>Elige un tipo de Empleado</option>";		
//		}

//		$sel_rsc = $row0[2];
        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr = array("idtempleado", "tipoempleado");
        $num_cols = count($cols_arr);
//      $join_tables = '0';
        $tables_arr = array("gnrl_temp");
        $num_tables = count($tables_arr);
//      $where_clause = "idarea = 5";
//      $order = "gnrl_usrs.nombre";

  		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

         while($row=mysql_fetch_row($result)) {
//	       	if ($row1[0] <> $row0[2]) {	
				echo "<option value=\"$row[0]\">$row[1]</option>";
//			}	
        }   // cierre de While
		

?>
            </select>
            <span class="letraadtienda"><br />
          </span></label>
          <label><br />
            <input type="submit" name="button2" id="button2" value="Agregar" />
            <input name="empleado_check" type="hidden" id="empleado_check" value="1" />
          </label>
      </p></td>
    </form>
  </tr>
</table>

<?php
	} // Cierre de if Inicial

        if ($_POST['empleado_check'] == "1") {
			
//			echo "entro a tienda check";	
			if ($_POST) {
				foreach ($_POST as $nombre => $valor) {
				   	${$nombre} = $valor;
				} // Cierre foreach     
			}	

            // Comprobar nombre de usuario contra la base de usuarios
            $cols_arr = array("nombres", "apaterno", "amaterno");
            $num_cols = count($cols_arr);
//          $join_tables = '0';
            $tables_arr = array("gnrl_empl");
            $num_tables = count($tables_arr);
//          $where_clause = "idarea = 5";
//          $order = "gnrl_usrs.nombre";

       		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

          	if (trim($nombres) == "") {
               	echo "<span class=\"letra_alertaestado\"><strong>Teclea un nombre para el empleado</strong></span><br />";
                $error_id = 0;
			} else {
	          	if (trim($apaterno) == "") {
    	           	echo "<span class=\"letra_alertaestado\"><strong>Teclea un apellido Paterno para el empleado</strong></span><br />";
        	        $error_id = 0;
	            } else {
		          	if (trim($amaterno) == "") {
    		           	echo "<span class=\"letra_alertaestado\"><strong>Teclea un apellido Materno para el empleado</strong></span><br />";
        		        $error_id = 0;
	        	    } else {
						if ($sel_templeado == "Elige un tipo de Empleado") {
				        	echo "<span class=\"letra_alertaestado\"><strong>Elige que tipo de empleado(a) es</strong></span>";
    	    	  			$error_id = 0;
						} else {	
						    while($row=mysql_fetch_row($result)) {

								$nombres2low = strtolower($row[0]);
								$apaterno2low = strtolower($row[1]);
								$amaterno2low = strtolower($row[2]);
								
								// Concatena el nombre en turno en la base
								$concat_nenbase = $nombres2low.' '.$apaterno2low.' '.$amaterno2low; 

								$nombres2lowentra = strtolower($nombres);
								$apaterno2lowentra = strtolower($apaterno);
								$amaterno2lowentra = strtolower($amaterno);
			
								// Concatena el nombre entrante
								$concat_nentra = $nombres2lowentra.' '.$apaterno2lowentra.' '.$amaterno2lowentra; 


								// Compara los nombres "armados"
   		    		    		if (ereg($concat_nentra, $concat_nenbase)) {
       		    		    		echo "<span class=\"letra_alertaestado\">El empleado <strong>$row[0]</strong> ya existe en la base de datos</span><br />";
       			    		    	$error_id = 0;
               					}
	   	    				}    // cierre de While
						}
					}
				}
			}
			if (!isset($error_id)) {
				$agr_empleado = "1";			
			} 

        }

        if ($error_id == "0") {

?>
<br /> <br />
<table class="tablaagrtienda" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form2" target="_self" id="form2">
      <td></label>
          <label>
          <input type="submit" name="button" id="button" value="Reintentar" />
          </label></td>
    </form>
  </tr>
</table>

<?php

        } else {
			if ($agr_empleado == "1" or isset($invalid_check)) {

				include "calendario/calendario.php";
				
				foreach ($_POST as $nombre => $valor) {
	     			if(stristr($nombre, 'button') === FALSE) {
    	    			${$nombre} = $valor;
			         }
				 }// Cierre foreach     


?>
<span class="letraadtienda">Agregar <?php $ncompleto = ucwords($nombres).' '.ucwords($apaterno).' '.ucwords($amaterno);
/*if ($_SESSION['modo'] == "inmueble") {*/ echo 'al empleado: <strong>'.$ncompleto.'</strong>'; // } else { echo "la tienda <strong>$sel_ttienda $muestrat</strong>"; } ?> al sistema</span><br />
<table class="tablaagrtienda" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $target_link; ?>" method="post" name="altaform" target="_self" id="altaform">
      <td width="433"><label><span class="letraadtienda"><br />
        Fecha de Nacimiento:</span></label>

        <!--<input name="fechanac" type="text" id="textfield8" size="10" maxlength="10" value="<?php if ($invalid_check == '1') { echo "$edad"; } ?>" />-->
        
        <label><?php if ($invalid_check == "1") { $errorparam = $fechanac; } 
		escribe_formulario_fecha_vacio("fechanac","altaform",$fechanac, $clase, $estado); ?>


          <span class="letraadtienda_nopadd"> Formato AAAA-MM-DD</span><?php

        if ($error_id == "1") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";

        }
?>

         <!--<br />--> 
         <!--<span class="letraadtienda_nopadd">Número de Empleado Probell: </span>--></label>
        
        <!--<input name="pbnoempleado" type="text" id="pbnoempleado" size="20" maxlength="20" value="<?php // if ($invalid_check == '1') { echo "$pbnomepleado"; } ?>" />-->
        <br />
<label>N.S.S:</span></label>
        <input type="text" name="nss" id="textfield9" value="<?php if ($invalid_check == '1') { echo "$nss"; } ?>" />
        <label><span class="letraadtienda"><span class="letraadtienda_nopadd">
          <?php

        if ($error_id == "2") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";

        }
?>
        </span><br />
        </span></label>
        <label><span class="letraadtienda"> <br />
          Direccion:</span></label>
        <br />
        <label for="direccion"></label>
        <textarea name="direccion" id="direccion" cols="45" rows="5"><?php if ($invalid_check == '1') { echo "$direccion"; } ?></textarea>
        <label><span class="letraadtienda"><br />
          No. Telefónico:</span></label>
        <input type="text" name="notelefonico" id="textfield11" value="<?php if ($invalid_check == '1') { echo "$notelefonico"; } ?>" />
        <label> <!-- <span class="letraadtienda_nopadd">-->
          <?php

        if ($error_id == "3") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";

        }
?>
        <br />
          Correo-e:</span></label>
        <input type="text" name="correoe" id="textfield12" value="<?php // if ($invalid_check == '1') { echo "$correoe"; } ?>" />
        
        <?php

        // if ($error_id == "4") {
        //        echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";

        //}
?>
        <label><span class="letraadtienda"><br />
          Tienda/Oficina Donde Labora:</span></label>
        <label for="select"></label>
        <select name="sel_inmu" id="sel_inmu">
          <?php

		if ($invalid_check == '1') {
			echo "<option selected>$sel_inmu</option>";		
		} else {
			echo "<option selected>Elige un Lugar de Trabajo</option>";		
		}

        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr = array("nombreinmu");
        $num_cols = count($cols_arr);
//      $join_tables = '0';
        $tables_arr = array("inmu_gdat");
        $num_tables = count($tables_arr);
//      $where_clause = "idarea = 5";
//      $order = "gnrl_usrs.nombre";

  		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

         while($row=mysql_fetch_row($result)) {
//	       	if ($row1[0] <> $row0[2]) {	
				echo "<option>$row[0]</option>";
//			}	
        }   // cierre de While
		

?>
        </select>
        <label class="letraadtienda_nopadd">
        </label>
        <label class="letraadtienda_nopadd">
  <?php

        if ($error_id == "5") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";

        }
?>
  <br />	
  <br />
         <input type="submit" name="button" id="button" value="Enviar Datos" />
         <input type="hidden" name="nempleado" id="nempleado" value="<?php echo $ncompleto; ?>" />
         <input name="ejecuta" type="hidden" id="ejecuta" value="1" />
         <input name="sel_templeado" type="hidden" id="sel_templeado" value="<?php echo $sel_templeado; ?>" />

         <input type="hidden" name="nombres" id="nombres" value="<?php echo $nombres; ?>" />
      </label>
        <span class="letraadtienda_nopadd">
        <input type="hidden" name="apaterno" id="apaterno" value="<?php echo $apaterno; ?>" />
      </span><span class="letraadtienda_nopadd">
      <input type="hidden" name="amaterno" id="apaterno2" value="<?php echo $amaterno; ?>" />
      </span></td>
      <td width="267" valign="top"><br /><span class="letraadtienda_nopadd">Horario:</span><br />
        <label class="letraadtienda_nopadd" for="horaentrada">Hora de Entrada</label>
        <select name="horaentrada">
          <?php

		if ($invalid_check == '1') {
			echo '<option selected="selected">'.$horaentrada.'</option>';		
		} 


        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr     = array("hora");
        $num_cols     = count($cols_arr);
        $tables_arr   = array("gnrl_hora");
        $num_tables   = count($tables_arr);
		$where_clause = "idhora < '11'";

  		$estado_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        while($row1=mysql_fetch_row($estado_rset)) {
				echo '<option>'.$row1[0].'</option>';
        }   // cierre de While
		?>
        </select>
        <br />
        <label class="letraadtienda_nopadd" for="horasalida"></label>
        <label class="letraadtienda_nopadd" for="horasalida">Hora de Salida</label>
        <select name="horasalida">
          <?php

		if ($invalid_check == '1') {
			echo '<option selected="selected">'.$horasalida.'</option>';		
		} 

        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr     = array("hora");
        $num_cols     = count($cols_arr);
        $tables_arr   = array("gnrl_hora");
        $num_tables   = count($tables_arr);
		$where_clause = "idhora > '11'";

  		$estado_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

		unset($where_clause);
		
        while($row2=mysql_fetch_row($estado_rset)) {
//	       	if ($row2[1] <> $row[13]) {	
				echo '<option>'.$row2[0].'</option>';
//			}	
        }   // cierre de While
		?>
        </select>
        <br />
        <label class="letraadtienda_nopadd" for="tolerancia">Tolerancia:</label>
        <select name="tolerancia" id="tolerancia">
          <?php
		  
  		if ($invalid_check == '1') {
			echo '<option selected="selected">'.$tolerancia.'</option>';		
		} 


        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr     = array("valortolerancia");
        $num_cols     = count($cols_arr);
        $tables_arr   = array("empl_tole");
        $num_tables   = count($tables_arr);
//		$where_clause = "idhora > '11'";

  		$estado_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        while($row3=mysql_fetch_row($estado_rset)) {
				echo '<option>'.$row3[0].'</option>';
        }   // cierre de While
		?>
      </select>
       <span class="letraadtienda_nopadd">Minutos</span><br /></td>
    </form>
  </tr>
</table>

<?php
		}
	} // Cierre de else
	
	if ($agr_empleado == "2") {

	/* foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
    		${$nombre} = $valor;
		}
	}// Cierre foreach     */
	
?>
<p class="letraadtienda">Captura de Huella Dactilar Empleado(a): <strong><?php echo "$nempleado."; ?></strong><br /></p>

<h3 align="center">Hola <?php echo "$nempleado"; ?>, por favor coloca ualquiera de tus dedos<br />sobre el lector y mantenlo ahi un momento <?php echo $idempleado; ?></h3>

<table align="center">
  <tr>
    <td><applet code="com.griaule.fingerprintsdk.appletsample.FormMain"
		   		archive="SignedFingerprintSDKJavaAppletSample.jar,SignedFingerprintSDKJava.jar"
		   		width="280" height="220" alt="Huellas">
    </applet></td>
  </tr>
</table>

<?php

	}
	
	if ($agr_empleado == "3") {

	/*foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
    		${$nombre} = $valor;
		}
	}// Cierre foreach */    
	
?>
<p class="letraadtienda">Captura de Imagen Iniclal Empleado(a): <strong><?php echo "$nempleado."; ?></strong><br /></p>

<h3 align="center">Hola <?php echo "$nempleado"; ?>, por favor Colocate frente a la camara y permanece quieto(a) <?php echo $idempleado; ?></h3>

<table align="center">
  <tr>
    <td valign="top" align="center">
      <h3>Presiona Capturar cuando estes listo(a)</h3>
      <div id=muestra_camara>
      <!-- First, include the JPEGCam JavaScript Library -->
      <script type="text/javascript" src="webcam.js"></script>

      <!-- Configure a few settings -->
      <script language="JavaScript" type="text/javascript">
		webcam.set_api_url( 'asistencia_capturachecadas.php?captura=inicial' );
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
      </form>
      <!-- Code to handle the server response (see test.php) -->
      <script language="JavaScript" type="text/javascript">

		var target_link="asistencia_registraempleado.php?ejecuta=2";
		
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
					setTimeout ("redireccionar()", 800);
			}
			else alert("PHP Error: " + msg);
		}
		

		function redireccionar() 
		{
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

<?php

	}

?>

</body>
</html>
