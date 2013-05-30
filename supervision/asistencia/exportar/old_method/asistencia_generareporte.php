<?php

	session_start();
	// include "excelwriter.inc.php";
//	require_once 'Spreadsheet/Excel/Writer.php';
	include 'consultas.php';
//	include "asistencia_descargareporte.php";
		
	$hostname    = $_SESSION['hostname'];

	$relpath     = "supervision/asistencia/exportar/"; 


	foreach ($_POST as $nombre => $valor) {
		${$nombre} = $valor;
	} // Cierre foreach     

   /* echo "Valores de _POST <br />";
    foreach ($_POST as $nombre => $valor) {
    	if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
		}
	}*/
	
	// Consulta Para Obtener Reporte
	$cols_arr      = array("gnrl_echk.idempleado",        //  0
	                       "gnrl_echk.ruta_imagen",       //  1
						   "gnrl_empl.nombres",           //  2
						   "gnrl_empl.apaterno",          //  3 
						   "gnrl_empl.amaterno",          //  4
						   "gnrl_empl.idtempleado",       //  5
						   "inmu_gdat.nombreinmu",        //  6
	                       "inmu_gdat.idfis",             //  7  
						   "gnrl_echk.checada_fecha",     //  8
						   "gnrl_echk.checada_hora");     //  9
	$num_cols      = count($cols_arr);
   	$join_tables   = '1';
    $tables_arr    = array("gnrl_empl",
						   "gnrl_echk",
						   "inmu_gdat");
    $num_tables    = count($tables_arr);
	$on_fields_arr = array("idempleado", "idinmu");
	$connect       = '1';
	$order         = "gnrl_echk.checada_fecha, nombreinmu, idfis, gnrl_echk.checada_hora";
	$dir	       = "ASC";
        

// ---------------------------- INICIO EVALUACIONES DE BUSQUEDA ------------------------------------------------
// Se determina que buscar modificando la variable where_clausa

    // Patron reutilizable de busqueda
		
	$tpattern1 = "gnrl_empl.idempstat = 1";	
	$tpattern2 = "gnrl_empl.idempstat = 2";	
	
	switch ($quien_busc) {
		case "pornoempleado":
			$where_clause  = '(gnrl_empl.idempleado = \''.$noempleado.'\')';
			break;
		case "pornombreempleado":
			$where_clause  = '(gnrl_empl.nombreempleado like \'%'.$nempleado.'%\')';
			break;
	}		

	if (isset($de_busc)) {
		switch ($de_busc) {
			case "tienda":		
				$where_clause = '(gnrl_echk.idinmu = \''.$sel_tienda.'\')';  
				break;
			case "razonsc":		
				$where_clause = '(inmu_gdat.idfis = \''.$sel_razonsc.'\')';  
				break;
			case "todos":
				break;
		}
	}	


	if ($activa_tiempo == "on") {
		switch($cuando_busc) {
			case "hoy":
				$fecha_hoy = date('Y-m-d');
				$where_clause = $where_clause.' AND (gnrl_echk.checada_fecha = \''.$fecha_hoy.'\')';
				break;
			case "eldia":
				$where_clause = $where_clause.' AND (gnrl_echk.checada_fecha = \''.$taldia.'\')';
				break;
		   case "rango_fechas":
				$where_clause = $where_clause.' AND (gnrl_echk.checada_fecha BETWEEN \''.$fechainicio.'\' AND \''.$fechafin.'\')';
				break;
			case "mes_anio":
				$where_clause = $where_clause.' AND (gnrl_echk.checada_fecha like \'%'.$sel_anio.'-'.$sel_mes.'%\')';
				break;
		}
	}
	
	switch($tipo_busc) {
		case "1":	
			$where_clause = $where_clause.' AND (gnrl_echk.checada_hora BETWEEN \'08:45:00\' AND \'09:10:59\')';
			break;
		case "2":	
			$where_clause = $where_clause.' AND (gnrl_echk.checada_hora BETWEEN \'18:50:00\' AND \'21:00:59\')';
			break;
		case "3":	
			$where_clause = $where_clause.' AND ((gnrl_echk.checada_hora BETWEEN \'8:45:00\' AND \'09:10:59\') AND (gnrl_echk.checada_hora BETWEEN \'18:50:00\' AND \'21:00:59\'))';
			break;
		case "4":	
			$where_clause = $where_clause.' AND (gnrl_echk.checada_hora BETWEEN \'09:11:00\' AND \'10:00:59\')';
			break;
	}
					

// ---------------------------- FIN DE EVALUACIONES DE BUSQUEDA ------------------------------------------------


        // Llama a la funci&oacute;n de las consultas
	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
                
	unset($join_tables);
	unset($on_fields_arr);
	unset($connect);
	unset($order);
	unset($where_clause);
	unset($dir);

	// Creating a workbook
	$workbook = new Spreadsheet_Excel_Writer();

	// sending HTTP headers
	$workbook->send('reporte.xls');

	// Creating a worksheet
	$worksheet =& $workbook->addWorksheet('Reporte de Asistencia');

	
	$worksheet->write(0, 0, '');
	$worksheet->write(1, 0, '');
	$worksheet->write(2, 0, 'Sistema de Control de  Asistencia Probell');
	$worksheet->write(1, 0, '');

	// Let's send the file
	$workbook->close();
	
	/*$myArr=array("No","Nombre", "Tipo de Empleado", "Lugar de Trabajo", "Razon Social de Oficina/Tienda", "Fecha Checada", "Hora Checada");
	$excel->writeLine($myArr);

	while($row=mysql_fetch_row($result)) {

		$excel->writeRow();
		$excel->writeCol("$row[0]");
		$excel->writeCol("$row[1]");

		// Recupera el tipo de empleado
		$cols_arr     = array("tipoempleado");
		$num_cols     = count($cols_arr);
		$tables_arr   = array("gnrl_temp");
		$where_clause = "idtempleado = '$row[2]'";
	
		$temp_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
		$templeado = mysql_fetch_row($temp_rset);

		$excel->writeCol("$templeado[0]");
		$excel->writeCol("$row[3]");

		// Recupera el tipo de empleado
		$cols_arr     = array("razonsc");
		$num_cols     = count($cols_arr);
		$tables_arr   = array("inmu_dfis");
		$where_clause = "idfis = '$row[4]'";
	
		$dfis_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
		$rfc = mysql_fetch_row($dfis_rset);
	 
		$excel->writeCol("$rfc[0]");
		$excel->writeCol("$row[5]");
		$excel->writeCol("$row[6]");

	} // Cierre de While
	
	$excel->close();*/

?>


