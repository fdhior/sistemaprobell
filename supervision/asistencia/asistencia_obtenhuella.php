<?php

	session_start();
	include $_SESSION['rutafunciones'].'consultas.php';

	// parametros GET 
	if (isset($_GET['idempleado'])) {
		
		$idempleado = $_GET['idempleado'];
		// Obten las huellas de los empleados
		$cols_arr = array("contra");


	} else {

		$consulta = $_GET['consulta'];
		$idinmu   = $_GET['idinmu'];

		// Columnas de cada tipo de consulta
		switch ($consulta) {
			// Obten el numero de empleados
			case '1':
					$cols_arr = array("COUNT(idempleado)");
				break;
			// Obten los indices de los empleados
			case '2':
					$cols_arr =	array("idempleado");	
				break;	

		}

	}	

	// Variables comunas a todas las consultas
	$num_cols = count($cols_arr);
	$join_tables = '0';
	$tables_arr = array("gnrl_empl");
	$num_tables = count($tables_arr);
	
	if (isset($_GET['idempleado'])) {
		$where_clause = "idempleado = '$idempleado'";
	} else {
	
	// $where_clause = "idinmu = '$idinmu'";
	
	}

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit); 

	$data = array();

	while ($row = mysql_fetch_row($result))
	{
		if (isset($_GET['idempleado'])) {
			$huella_utf8  = utf8_encode($row[0]);	 
			$data[] = array($huella_utf8);	
		} else { 
			$data[] = $row[0];
		}	
	}	
	
	// $data = mysql_fetch_row($result);

	echo json_encode($data);
	// echo json_encode($data);


?>