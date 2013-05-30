<?php session_start(); ?>
<script language="javascript" type="text/javascript" src="jquery-1.7.1.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/sistemaprobell.css" />
<link rel="stylesheet" type="text/css" href="../../css/modulo.css" />

<?php
	

	include $_SESSION['rutafunciones'].'consultas.php';
	date_default_timezone_set('America/Mexico_City');

?>

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
-->
</style>

<?php 
	
	$userinmuid = $_SESSION['userinmuid'];

	$hostname      = $_SESSION['hostname'];
	$basepath_link = 'supervision/asistencia/asistencia_';
	$target_link   = $hostname.$basepath_link.'checaasistencia.php';
	
	$dbhost = 'jdbc:mysql://localhost/egprobell';
	$dbuser = 'probelleg';
	$dbpass = 'probelang96';
	
	// $dbhost = 'jdbc:mysql://sql312.zobyhost.com/zoby_7243254_egprobell';
	// $dbuser = 'zoby_7243254';
	// $dbpass = 'pro2008bel12';
	
	if (isset($_POST['entrada'])) {
		$entrada = $_POST['entrada'];
		
		include $_SESSION['rutafunciones'].'conectarainventario.php';

		$inputUser = mysql_real_escape_string($_POST['username']);
		$inputPass = mysql_real_escape_string($_POST['password']);

		include $_SESSION['rutafunciones'].'cerrar_conexion.php';

	}	


	// Obtener huellas de la base de datos
	/* $cols_arr = array("contra");   // 0
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("gnrl_empl");
	$num_tables = count($tables_arr);
	$where_clause = "idempleado = '$userinmuid'";

	$rsHuellas = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);  

	$rowHuellas=mysql_fetch_row($rsHuellas); */
	
	/* while($rowHuellas=mysql_fetch_row($rsHuellas)) {
		
		echo $rowHuellas[0];
	} */

/*--------------------------- PRUEBA DE VARIABLES ------------------------*/

    // Mostrar los valores de _POST
    /*echo '<p class="letra_boton">';
	echo "Valores de _SESSION <br />";
    foreach ($_SESSION as $nombre => $valor) {
    	if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
		}
	}
	print_r($_SESSION['permisos']);
	echo '</p>';*/
/*---------------------- CIERRE DE PRUEBA DE VARIABLES ---------------------*/
?>	

<script id="source" language="javascript" type="text/javascript">

  var rsArrayEmployeeIds  = new Array();
  var rsSimpleType        = new Array(); 
  // var rsArrayHuellas      = new Array();
  var rsStringFingerprint;

  
  function obtenDatosDB(tipoConsulta) 
  {
    // var data;
     
    var idinmu = <?php echo $userinmuid ?>;

   
    $(function () 
    {
      //-----------------------------------------------------------------------
      // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
      //-----------------------------------------------------------------------
      $.ajax({                                      
      url: 'asistencia_obtenhuella.php', 					//the script to call to get data          
      data: "consulta="+tipoConsulta+"&idinmu="+idinmu,     //you can insert url argumnets here to pass to api.php
                                                            //for example "id=5&parent=6"
      dataType: 'json',                   					//data format      
      success: function(data)             					//on recieve of reply
      {
  
 		 switch (tipoConsulta) {
 		 	case 1:
 		 			rsSimpleType = data;						
 		 		break;
 		 	case 2:
 		 			rsArrayEmployeeIds = data;	
 		 		break;
 		 } 
 		 
      } 
  
      });
    }); 

    // alert("JavaScript Was Executed from Java huella empleado 1:"+rs[0]);
    switch (tipoConsulta) {
 	 		case 1:
 					return rsSimpleType;						
 	 			break;
 			case 2:
 					return rsArrayEmployeeIds;
 				break;
	 	} 

  };


  function obtenEmpleadoHuella(index) 
  {
    // var data;
     
    // var idinmu = <?php echo $userinmuid ?>;
 	
   
    $(function () 
    {
      //-----------------------------------------------------------------------
      // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
      //-----------------------------------------------------------------------
      $.ajax({                                      
      url: 'asistencia_obtenhuella.php', 					//the script to call to get data          
      data: "idempleado="+index,     						//you can insert url argumnets here to pass to api.php
                                                            //for example "id=5&parent=6"
      dataType: 'json',                   					//data format      
      success: function(data)             					//on recieve of reply
      {
  
		rsStringFingerprint = data[0];	
 		 
      } 
  
      });
    }); 

    // alert("JavaScript Was Executed from Java huella empleado 1:"+rs[0]);
 	// alert(rsStringFingerprint);
 
 	return [""+rsStringFingerprint+""];			
	
  };



  function getTemplateFromJava() {
  	
  	alert("Delivering the Template: "+document.FingerCheck.getJavaTemplate());
  	// document.myApplet.getJavaTemplate()

  }


</script>


  




<?php
	
	if (!$_POST['submit']) {

		// Obtener huella
	/*  $cols_arr = array("idempleado",   // 0
		                  "contra");      // 1 
		$num_cols = count($cols_arr);
		$join_tables = '0';
		$tables_arr = array("gnrl_empl");
		$num_tables = count($tables_arr);
		$where_clause = "idempleado = 1";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit); 

		$row=mysql_fetch_row($result);

		echo 'No. Usuario: '.$row[0].' huella: '.$row[1];*/
		
?>

<br />
<h2> Control de Asistencia, Coloca la huella del dedo que hayas registrado para Checar tu Asistencia:</h2>
<table width="280" align="center">
  <tr>
    <td><br /><br /><applet code="com.griaule.fingerprintsdk.appletsample.FormMain"
		   		archive="FingerprintCheck.jar,FingerprintCheckJava.jar"
		   		name="FingerCheck" width="280" height="220" MAYSCRIPT>
		   		<param name="idinmu" value="<?php // echo $userinmuid; ?>" />
                <param name="target_link" value="<?php // echo $target_link; ?>" />
                <param name="dbhost" value="<?php echo $dbhost; ?>" />	
                <param name="dbuser" value="<?php echo $dbuser; ?>" />
                <param name="dbpass" value="<?php echo $dbpass; ?>" />
                <param name="mayscript" value="yes"                 /> 
	</applet></td>
  </tr>
</table>
<p>&nbsp;</p>
<input name="button" type="submit" id="button" value="Obten Huella" onclick="obtenEmpleadoHuella(3)" />

<!--<table border="1" align="center" cellpadding="5" cellspacing="5" bgcolor="#CADAEC">
  <form id="form1" action="<?php // echo $_SERVER['PHP_SELF']; ?>" method="post">
    <tr>
      <td class="logintext">No. Empleado</td>
      <td><input type="text" size="10" name="username" /></td>
    </tr>
    <tr>
      <td class="logintext">Contrase&ntilde;a</td>
      <td><input type="password" size="10" name="password" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="entrada" type="hidden" id="entrada" value="admin" />
        <input name="submit" type="submit" class="logintext" value="Entrar" /></td>
    </tr>
  </form>
</table>-->

<?php

	}
	
$err_mess = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<link rel=\"stylesheet\" type=\"text/css\" href=\"table.css\" />
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>ERROR En Los Datos</title>

<body>
<div align=\"center\">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p class=\"logintext\">";

$cierre_err_mess = "<a href=\"asistencia_control.php\" title=\"intenta de nuevo\" target=\"_self\">intenta ingresar de nuevo</a></p>
</div>
</body>
</html>";

$cierre_err_mess2 = "</p>
</div>
</body>
</html>";


	if ($entrada == "admin") {

		// form submitted
		// check for username
		if (!isset($_POST['username']) || trim($_POST['username']) == "") {
			die ("$err_mess Debes teclar un nombre de usuario<br /> $cierre_err_mess");
		} 

		// check for password
		if (!isset($_POST['password']) || trim($_POST['password']) == "") {
			die ("$err_mess Debes teclar tu contrase&ntilde;a<br />Si la olvidaste contacta a el Area de sistemas<br /> $cierre_err_mess");
		}

		
		// Obtener datos de usuario de la base de datos
		$cols_arr = array("idempleado",   // 0
		                  "nombres",      // 1 
						  "apaterno",     // 2
						  "amaterno",     // 3
						  "idinmu",       // 4
						  "idtempleado"); // 5
		$num_cols = count($cols_arr);
		$join_tables = '0';
		$tables_arr = array("gnrl_empl");
		$num_tables = count($tables_arr);
		$where_clause = "idempleado = '$inputUser' AND contra = MD5('$inputPass')";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit); 


		if (mysql_num_rows($result) == 1) {
			$row=mysql_fetch_row($result);
	
			// if row exists
			// user/pass combination is correct
			// start a session
			
			// session_start();
			
				$userinmuid   = $_SESSION['userinmuid'];

			/*  $_SESSION['idempleado'] = $row[0];
				$_SESSION['nempleado']  = $row[1].' '.$row[2].' '.$row[3];  */

			if ($userinmuid <> $row[4] && $row[5] < '3') { 

?>

<script language="javascript">

	function enviaACaptura()
	{
		document.forms[0].submit(); // Listado Inicial/Usuarios Activos
//		document.forms[8].submit(); // Listado Inicial/Usuarios Activos
	}
	
	function enviaCambioCaptura()
	{
		document.forms[1].submit(); // Usuarios Inactivos
	}

</script>


<?php

				echo $err_mess;
				echo 'ATENCION!!!: Actualmente Estas registrado en Otro Lugar de Trabajo<br />';
				echo '(Tienda/Oficina). Para continuar Presiona [SI] si has sido transferido<br />'; 
				echo 'a esta Tienda/Oficina, de lo contrario Presiona [NO]<br />';
				echo 'Tu Asistencia se tomará por una vez en este Lugar de Trabajo<br />';

?>

<input name="SI" value="SI" type="button" onclick="enviaCambioCaptura()" /> <input name="NO" value="NO" type="button" onclick="enviaACaptura()" />

<form action="asistencia_checaasistencia.php" method="post" name="formasel">
</form>

<form action="asistencia_checaasistencia.php" method="post" name="formasel2">
	<input name="cambiaUsuario" type="hidden" value="1" />
</form>

<?php

				echo $cierre_err_mess2;
			} else {

				header('Location: asistencia_checaasistencia.php');
			}

			exit;
		} else {
			// if row does not exist	
			// user/pass combination is wrong
			// redirect browser to error page
			die("$err_mess Tu contrase&ntilde;a o nombre de usuario<br />es incorrecto<br /> $cierre_err_mess");

		} // Cierre de Else
	} // Cierre de if admin 
?> 