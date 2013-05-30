<?php

	session_start();
	// include "excelwriter.inc.php";
	require_once 'Spreadsheet/Excel/Writer.php';
	$rutafunciones = $_SESSION['rutafunciones'];
	include $rutafunciones.'consultas.php';
//	include "asistencia_descargareporte.php";
		
	$hostname    = $_SESSION['hostname'];

	$relpath     = "supervision/asistencia/exportar/"; 


	foreach ($_POST as $nombre => $valor) {
		${$nombre} = $valor;
	} // Cierre foreach     

    /*echo "Valores de _POST <br />";
    foreach ($_POST as $nombre => $valor) {
    	if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
		}
	}*/
	
	
	// Definicion de los parametros de la consulta
	$cols_arr      = array("COUNT(idempleado)");        //  0
	$num_cols      = count($cols_arr);
	$tables_arr    = array("gnrl_echk");

    $maxTablaRset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
			
	$maxRow=mysql_fetch_row($maxTablaRset);			

	
	// Consulta Para Obtener Reporte
$cols_arr      = array("gnrl_echk.idempleado",        //  0
							   "gnrl_empl.nombres",           // 1
							   "gnrl_empl.apaterno",          // 2 
							   "gnrl_empl.amaterno",          // 3
 							   "gnrl_empl.pbnoempleado",      // 4
							   "gnrl_empl.idtempleado",       // 5
							   "inmu_gdat.nombreinmu",        // 6
		                       "inmu_gdat.idfis",             // 7  
							   "gnrl_echk.checada_fecha",     // 8
							   "gnrl_echk.checada_hora",      // 9
							   "gnrl_echk.idInmuChecada");    // 10
			$num_cols      = count($cols_arr);
		   	$join_tables   = '1';
		    $tables_arr    = array("gnrl_echk",
								   "gnrl_empl",
								   "inmu_gdat");
		    $num_tables    = count($tables_arr);
			$on_fields_arr = array("idempleado", "idinmu");
			$connect       = '1';
//	$order         = "gnrl_echk.checada_fecha, nombreinmu, idfis, gnrl_echk.checada_hora";
//	$dir	       = "ASC";
        

// ---------------------------- INICIO EVALUACIONES DE BUSQUEDA ------------------------------------------------
// Se determina que buscar modificando la variable where_clausa

    // Patron reutilizable de busqueda
		
	    // Patron reutilizable de busqueda
		
	$tpattern1 = "gnrl_empl.idempstat = 1";	
	$tpattern2 = "gnrl_empl.idempstat = 2";	
	
	switch ($quien_busc) {
		case "pornoempleado":
			$where_clause  = '(gnrl_empl.idempleado = \''.$noempleado.'\')';
			break;
		case "pornombreempleado":
			$where_clause  = '(gnrl_empl.nombres LIKE \'%'.$nempleado.'%\')';
			break;
		case "portodoslosemp":
			$where_clause = '(gnrl_empl.idempleado <= \''.$maxRow[0].'\')';
			break;
	}		

	if (isset($de_busc)) {
		switch ($de_busc) {
			case "tienda":		
				$where_clause = '(gnrl_empl.idinmu = \''.$sel_tienda.'\')';  
				break;
			case "razonsc":		
				$where_clause = '(inmu_gdat.idfis = \''.$sel_razonsc.'\')';  
				break;
			case "todos":
				$where_clause = $where_clause;  
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
	
	if ($tipo_busc == 0) { 
		$where_clause = $where_clause;
	} else {	
		$where_clause = $where_clause.' AND (gnrl_echk.idTipoChecada = \''.$tipo_busc.'\')';
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

//	$row=mysql_fetch_row($result);
	
	// Creating a workbook
	$workbook = new Spreadsheet_Excel_Writer();

	// sending HTTP headers
	$workbook->send('reporte.xls');


	// Creating a worksheet
	$worksheet =& $workbook->addWorksheet('Reporte de Asistencia');
		
	$worksheet->setRow(0,75); 
	$worksheet->setColumn(0,0,10.71);
	$worksheet->setColumn(0,1,20);
	$worksheet->setColumn(0,2,18);
	$worksheet->setColumn(0,3,19);
	$worksheet->setColumn(0,4,22.86);
	$worksheet->setColumn(0,5,26.86);
	$worksheet->setColumn(0,6,22.86);
	$worksheet->setColumn(0,7,14);
	$worksheet->setColumn(0,8,14);

//	$worksheet->insertBitmap(0,0,'d:\\descargas\cache.bmp');
	
	$file = "probell logo-sm2.bmp";
	$worksheet->insertBitmap(0, 0, $file, 0, 0, 0.85, 1);

	$format_title =& $workbook->addFormat();
	$format_title->setAlign('left');
	$format_title->setAlign('vcenter');
	$format_title->setSize(14);

	$workbook->setCustomColor(12, 216, 236, 245);
	$format_wraptext_odd =& $workbook->addFormat();
	$format_wraptext_odd->setTextWrap(1);
	$format_wraptext_odd->setAlign('center');
	$format_wraptext_odd->setAlign('vcenter');
	$format_wraptext_odd->setLeft(1);
	$format_wraptext_odd->setTop(1);
	$format_wraptext_odd->setRight(1);
	$format_wraptext_odd->setBottom(1);
	$format_wraptext_odd->setSize(8);
	$format_wraptext_odd->setFgColor(12);
	
	$format_wraptext_even =& $workbook->addFormat();
	$format_wraptext_even->setTextWrap(1);
	$format_wraptext_even->setAlign('center');
	$format_wraptext_even->setAlign('vcenter');
	$format_wraptext_even->setLeft(1);
	$format_wraptext_even->setTop(1);
	$format_wraptext_even->setRight(1);
	$format_wraptext_even->setBottom(1);
	$format_wraptext_even->setSize(8);
	$format_wraptext_even->setFgColor("white");

	$format_header =& $workbook->addFormat();
	$format_header->setAlign('center');
	$format_header->setLeft(1);
	$format_header->setTop(1);
	$format_header->setRight(1);
	$format_header->setBottom(1);
	$format_header->setSize(8);
	$format_header->setPattern(1);
	$format_header->setBorderColor('black');
	$format_header->setColor('white');
	$format_header->setFgColor('black');
	$format_header->setBold(1);
	
	$worksheet->write(0, 2, 'Sistema de Control de Asistencia Probell', $format_title);

	$creaFecha = date("d/m/Y");
	$worksheet->write(2, 6, 'Reporte Generado: '.$creaFecha);


	switch($quien_busc) {
		case "pornoempleado":
	    	$nuLength = strlen($noempleado);
			switch($nuLength) {
				case "1":
					$noUsuario = '000'.$noempleado;
					break;
				case "2":
					$noUsuario = '00'.$noempleado;
					break;		
				case "3":
					$noUsuario = '0'.$noempleado;
					break;
				case "4":
					$noUsuario = $noempleado;		
				break;
			}
			$deQuien = 'El usuario No. '.$noUsuario;
			break;
		case "pornombreempleado":
			$deQuien = 'El/Los empleado(s) que coinciden con el nombre '.$nempleado;	
			break;	
		case "portodoslosemp":
			$deQuien = 'Todos los Empleados';
			break;	
	}

	switch($de_busc) {
		case "todos":
	    	$deDonde = 'Cualquier Tienda/Oficina';
			break; 
		case "tienda":
			$deDonde = 'La Tienda/Oficina: '.$row[6];	
			break;	
		case "razonsc":

			$cols_arr     = array("razonsc");
			$num_cols     = count($cols_arr);
			$tables_arr   = array("inmu_dfis");
			$where_clause = "idfis = '$sel_razonsc'";
	
			$dfisLocalRset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
			$rfcLocal = mysql_fetch_row($dfisLocalRset);

			$deDonde = 'La Tienda/Oficina de la Razon Social '.$rfcLocal[0];
			break;	
		default:
			$deDonde = 'Segun el reporte';
			break;	
	}
	
	if ($activa_tiempo == 'on') {
		switch($cuando_busc) {
			case "hoy":
	    		$enTiempo = 'El dia de hoy ('.$creaFecha.')';
				break;
			case "eldia":
				$enTiempo = 'El dia '.$taldia;	
				break;	
			case "rango_fechas":
				$enTiempo = 'El Rango de fechas de '.$fechainicio.' y '.$fechafin;
				break;	
			case "mes_anio":

				$mesDelAnio = array("01" => "Enero",
									"02" => "Febrero",
									"03" => "Marzo",
									"04" => "Abril",
									"05" => "Mayo",
									"06" => "Junio",
									"07" => "Julio",
									"08" => "Agosto", 
									"09" => "Septiembre", 
									"10" => "Octubre", 
									"11" => "Noviembre", 
									"12" => "Diciembre");
			
				$enTiempo = 'Mes de '.$mesDelAnio[$sel_mes].' del anio '.$sel_anio;
				break;	
		}
	} else {
		$enTiempo = 'Sin definir';	
	}

	switch($tipo_busc) {
		case "0":
	    	$tipoChecada = 'Todas las checadas';
			break;
		case "1":
		 	$tipoChecada = 'Checada de Entrada';	
			break;	
		case "2":
			$tipoChecada = 'Checada de Salida';
			break;	
		case "3":
			$tipoChecada = 'Checada General';
			break;
		case "4":		
			$tipoChecada = 'Retardos';
			break;
	}		

	$worksheet->write(2, 0, 'Reporte de Asistencia para: '.$deQuien);
	$worksheet->write(3, 0, 'De: '.$deDonde);
	$worksheet->write(4, 0, 'En el Periodo: '.$enTiempo);
	$worksheet->write(5, 0, 'Tipo de Checada: '.$tipoChecada);



	$header_array = array("No. Usuario",
	                      "Nombre", 
						  "No. Empleado Probell", 
						  "Tipo de Empleado",
						  "Lugar de Trabajo", 
						  "Razon Social Lugar de Trabajo",
						  "Lugar Checada",  
						  "Fecha Checada", 
						  "Hora Checada");

	$tam_arr = count($header_array);
	for ($i = 0; $i < $tam_arr; $i++) {  	
	 	$worksheet->write(7, $i, $header_array[$i], $format_header);
	}
	
    $i = 8;
	while($row=mysql_fetch_row($result)) {

		$oddevencheck = $i % 2;  
		
		if ($oddevencheck == 0) {
			$format_wraptext = $format_wraptext_even;
		} else {
			$format_wraptext = $format_wraptext_odd;
		}
			
		
    	$slength = strlen($row[0]);

		switch($slength) {
			case "1":
				$nousuario = '000'.$row[0];
				break;
			case "2":
				$nousuario = '00'.$row[0];
				break;		
			case "3":
				$nousuario = '0'.$row[0];
				break;
			case "4":
				$nousuario = $row[0];		
				break;
		}


		// Recupera el tipo de empleado
		$cols_arr     = array("tipoempleado");
		$num_cols     = count($cols_arr);
		$tables_arr   = array("gnrl_temp");
		$where_clause = "idtempleado = '$row[5]'";
	
		$temp_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
		$templeado = mysql_fetch_row($temp_rset);

		// Recupera el tipo de empleado
		$cols_arr     = array("razonsc");
		$num_cols     = count($cols_arr);
		$tables_arr   = array("inmu_dfis");
		$where_clause = "idfis = '$row[7]'";
	
		$dfis_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
		$rfc = mysql_fetch_row($dfis_rset);
		
		// Recupera el tipo de lugar de checada
		$cols_arr     = array("nombreinmu");
		$num_cols     = count($cols_arr);
		$tables_arr   = array("inmu_gdat");
		$where_clause = "idinmu = '$row[10]'";
	
		$ninmu_rset = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
		$ninmu = mysql_fetch_row($ninmu_rset);

		/*$results_arr = array($nousuario,
							 $row[1].' '.$row[2].' '.$row[3], 
							 $row[4],
							 $templeado[0], 
							 $row[6], 
							 $rfc[0],
							 $row[8],
							 $row[9]);*/
	    $worksheet->setRow($i, 30);


	 	$worksheet->write($i, 0, $row[0], $format_wraptext);                           // No. Usuario
		$worksheet->write($i, 1, $row[1].' '.$row[2].' '.$row[3], $format_wraptext);   // Nombre 
		$worksheet->write($i, 2, $row[4], $format_wraptext);                           // No. Empleado Probell           
 		$worksheet->write($i, 3, $templeado[0], $format_wraptext);
		$worksheet->write($i, 4, $row[6], $format_wraptext);
		$worksheet->write($i, 5, $rfc[0], $format_wraptext);
		$worksheet->write($i, 6, $ninmu[0], $format_wraptext);
		$worksheet->write($i, 7, $row[8], $format_wraptext);
		$worksheet->write($i, 8, $row[9], $format_wraptext);

		

		$i++;

	} // Cierre de While
	
	
	// Let's send the file
	$workbook->close();

?>


