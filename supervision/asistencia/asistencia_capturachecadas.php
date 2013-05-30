<?php

/* JPEGCam Test Script */
/* Receives JPEG webcam submission and saves to local file. */
/* Make sure your directory has permission to write files as your web server user! */
session_start();

date_default_timezone_set('America/Mexico_City');

$rutafunciones = $_SESSION['rutafunciones'];
include $rutafunciones.'consultas.php';

$userinmuid = $_SESSION['userinmuid'];
// $hostname = $_SESSION['hostname']

foreach ($_GET as $nombre => $valor) {
	if(stristr($nombre, 'button') === FALSE) {
		${$nombre} = $valor;
	}
}// Cierre foreach     


if ($captura == "inicial") {
	
	// Obtener el id del ultimo registro en la tabla gnrl_empl
	$cols_arr      = array("MAX(idempleado)");
	$num_cols      = count($cols_arr);
	$tables_arr    = array("gnrl_empl");

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

    $ultimo_emp=mysql_fetch_row($result);
	
	$ult_emp = $ultimo_emp[0] + 1;
	
	$slength = strlen($ult_emp);

	switch($slength) {
		case "1":
			$idempleado = '000'.$ult_emp;
			break;
		case "2":
			$idempleado = '00'.$ult_emp;
			break;		
		case "3":
			$idempleado = '0'.$ult_emp;
			break;
		case "4":
			$idempleado = $ult_emp;		
			break;
	}


	$contain_folder = 'iniciales/';
	$filename = $idempleado.'_'.date('Y-m-d-His') . '.jpg';
	
	$_SESSION['check_timestamp'] = date('Y-m-d H:i:s');
	$_SESSION['file_name']       = $contain_folder.$filename;
	$_SESSION['idemp_pass']      = $idempleado;

}

if ($captura == "checada") {
	$contain_folder = 'capturas/';

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
	
	
	// Obtener datos del horario del empleado
	$cols_arr     = array("horaentrada", // 0
						  "horasalida",  // 1
						  "tolerancia"); // 2
	$num_cols     = count($cols_arr);
	$tables_arr   = array("gnrl_empl");
	$where_clause = "idempleado = '$idempleado'";

	$horasRSet = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	$horasEmpleado=mysql_fetch_row($horasRSet);	

	$anioMesDiaActual = date('Y-m-d');
//	$horaPresente     = date('His');
	
	$diaHoraPresente = date('Y-m-d H:i:s');

	// Si la hora es en la mañana
	$horaDeEntrada  = $anioMesDiaActual.' '.$horasEmpleado[0];
	$horaDeSalida   = $anioMesDiaActual.' '.$horasEmpleado[1];
	$horaTolerancia = $anioMesDiaActual.' 00:'.$horasEmpleado[2].':59'; 
	
	$tmkDiaHoraPresente  = strtotime($diaHoraPresente);
	$tmkHoraDeEntrada    = strtotime($horaDeEntrada);
	$tmkHoraDeSalida     = strtotime($horaDeSalida); 
	$tmkHoraTolerancia   = strtotime($horaTolerancia);
 	$tmkMargenRetardo    = $tmkHoraDeEntrada + 3600;
	
		// Hora de Entrada	
	if ($tmkDiaHoraPresente <= $tmkHoraDeEntrada or ($tmkDiaHoraPresente > $tmkHoraDeEntrada and $tmkDiaHoraPresente <= $tmkHoraTolerancia)) {
		$tipoChecada = '1';				   
	} else {
		// Si la hora actual esta dentro del horario de trabajo
		if ($tmkDiaHoraPresente > $tmkMargenRetardo and $tmkDiaHoraPresente < $tmkHoraDeSalida) {
			$tipoChecada = '3';			
		} else {
			// Retarado
			if ($tmkDiaHoraPresente > $tmkHoraTolerancia and $tmkDiaHoraPresente < $tmkMargenRetardo) {	
				$tipoChecada = '4';
			} else {
				// Hora de Salida
				if ($tmkDiaHoraPresente > $tmkHoraDeSalida) {
					$tipoChecada = '2';
				}
			}
		}
	}


	$filename = $nousuario.'_'.date('Y-m-d-His') . '.jpg';

	// Determinar el host e ip del cliente desde el que se envia la checada
	if($_SERVER["HTTP_X_FORWARDED_FOR"])
	{	
		if($pos=strpos($_SERVER["HTTP_X_FORWARDED_FOR"]," "))
		{
			// echo "IP local: ".substr($_SERVER["HTTP_X_FORWARDED_FOR"],0,$pos)." - IP Pública: ".substr($_SERVER["HTTP_X_FORWARDED_FOR"],$pos+1);
			$ipRemota=substr($_SERVER["HTTP_X_FORWARDED_FOR"],$pos+1);
		} else {
			// echo "IP Pública: ".$_SERVER["HTTP_X_FORWARDED_FOR"];
			$ipRemota=$_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		// if($_SERVER["REMOTE_ADDR"])
			// echo " - Proxy: ".$_SERVER["REMOTE_ADDR"];
	} else {
		// echo "IP Pública: ".$_SERVER["REMOTE_ADDR"];
		$ipRemota=$_SERVER["REMOTE_ADDR"];
		// if($ipRemota!=$_SERVER["REMOTE_ADDR"])
			// echo " - hostnameRemoto: ".$ipRemota;
	}
	$hostnameRemoto=gethostbyaddr($ipRemota);
//	if($ipRemota!=$hostnameRemoto)
	//	echo "<br>hostnameRemoto: ".$hostnameRemoto;


	// Recuperar el periodo de checadas del historial
	$cols_arr     = array("MAX(periodoChecada)");
	$num_cols     = count($cols_arr);
	$tables_arr   = array("empl_chst");
	$where_clause = "idempleado = '$idempleado'";
	
	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

    $maxPeriodo=mysql_fetch_row($result);

	unset($where_clause);
	
	// Inserta checada en la base de datos
	$colsarr = array("idchecada", 
	                 "idempleado", 
					 "idInmuChecada", 
					 "idTipoChecada", 
					 "periodoChecada",
					 "checada_fecha", 
					 "checada_hora", 
					 "ruta_imagen",
					 "ipRemota",
					 "hostnameRemoto",
					 "nombreHosts");
	$numcols = count($colsarr);
	$valarr = array("NULL", 
					"'$idempleado'",
					"'$userinmuid'", 
					"'$tipoChecada'",
					"'$maxPeriodo[0]'", 
					"CURRENT_TIMESTAMP", 
					"CURRENT_TIMESTAMP", 
					"'$contain_folder$filename'",
					"'$ipRemota'",
					"'$hostnameRemoto'",
					"'$nombreHosts'");
	$aff_table = "gnrl_echk";

	$result = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

} // Cierre if checada 


if ($captura == "recaptura") {

	$contain_folder = 'iniciales/';
	
	$cols_arr      = array("capturainicial");
	$num_cols      = count($cols_arr);
	$tables_arr    = array("gnrl_empl");
	$where_clause  = "idempleado = '$idempleado'";

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

	$captura_ant=mysql_fetch_row($result);

	// Ya hay un archivo imagen para el usuario y debe ser borrado del servidor
	$cap_ant_archiv = $captura_ant[0];
	$fh = fopen($cap_ant_archiv, 'w') or die("can't open file");
	fclose($fh);

	// Esta instruccion borra el archivo 
	unlink($cap_ant_archiv);

	$slength = strlen($idempleado);

	switch($slength) {
		case "1":
			$idempleado = '000'.$idempleado;
			break;
		case "2":
			$idempleado = '00'.$idempleado;
			break;		
		case "3":
			$idempleado = '0'.$idempleado;
			break;
		case "4":
			$idempleado = $idempleado;		
			break;
	}

	$filename = $idempleado.'_'.date('Y-m-d-His') . '.jpg';

	$aff_table = "gnrl_empl";
	$colsvalarr = array("capturainicial = '$contain_folder$filename'");
	$numcols = count($colsvalarr);
	$where_clause = "idempleado = '$idempleado'";

	$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 


}

// Escritura de el archivo

$result = file_put_contents($contain_folder.$filename, file_get_contents('php://input'));

if (!$result) {
	print "ERROR: Failed to write data to $filename, check permissions\n";
	exit();
} 

$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/'.$contain_folder.$filename;

print "$url\n";


?>
