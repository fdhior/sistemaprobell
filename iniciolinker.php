<?php
	session_start();
	$idusrarea = $_SESSION['idusrarea'];
	$idtipousr = $_SESSION['idtipousr'];
	
// echo "<H2> ". $_GET['linkid'] ." </H2>";

$linkid = $_GET['linkid'];

if (isset($_GET['orden'])) {  
   $orden = $_GET['orden'];
} else {
   $orden = $_POST['orden'];
}   
$direcc = $_POST['direcc'];
$idt = $_GET['idt'];
$muestra = $_GET['muestra'];
// $muestradet = $_GET['muestradet'];



/*
	// Mostrar los valores de _POST
	echo "Valores de _POST <br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />"; 
		}
	}

	// Mostrar los valores de _GET
	echo "Valores de _GET <br />";
	foreach ($_GET as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />"; 
		}
	}
	
	// Mostrar los valores de _SESSION
	echo "Valores de _SESSION <br />";
	foreach ($_SESSION as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor, "; 
		}
	} */

	

// echo "$linkid"; 

  // Links Para INICIOS Segun Session Tipo Usuario
  // Enlace al Resumen Area Sistemas)
  if ($linkid == "SIS_1") { 
        $_SESSION['init']      = "sistemas_resumen";
		$_SESSION['file_path'] = "sistemas";
		$_SESSION['in_frame']  = '0';
		$_SESSION['itnum']     = "active_SIS_1";
		$_SESSION['subitnum']  = "active_SIS_1";	
  }   
  
  if ($linkid == "SIS_2") { 
        $_SESSION['init']      = "sistemas_inmueble";
		$_SESSION['file_path'] = "sistemas";
		$_SESSION['in_frame']  = '1';
		$_SESSION['itnum']     = "active_SIS_1";
		$_SESSION['subitnum']  = "active_SIS_2";	
  }   
  

// http://localhost:9010/sistemaprobell//.php
  
  if ($linkid == "MANT_1") { 
        $_SESSION['init']      = "mantenimiento_inventario";
		$_SESSION['file_path'] = "sistemas/mantenimiento";
		$_SESSION['in_frame']  = '1';
		$_SESSION['itnum']     = "active_MANT_1";
		$_SESSION['subitnum']  = "active_MANT_1";	
  }   
  

  if ($linkid == "MANT_2") { 
        $_SESSION['init']      = "mantenimiento_agregarequipos";
		$_SESSION['file_path'] = "sistemas/mantenimiento";
		$_SESSION['in_frame']  = '1';
		$_SESSION['itnum']     = "active_MANT_1";
		$_SESSION['subitnum']  = "active_MANT_2";	
  }   

  
	if ($linkid == "SUP_1") {
		$_SESSION['init']      = "supervision_resumen";
		$_SESSION['file_path'] = "supervision";
		$_SESSION['in_frame']  = '1';

		$_SESSION['itnum']     = "active_SUP";
		$_SESSION['subitnum']  = "active_SUP_1";	
	}	  
  
	if ($linkid == "ADM_1") {
	    $_SESSION['init']      = "administracion_resumen";
		$_SESSION['file_path'] = "administracion";
		$_SESSION['in_frame']  = '1';

  		$_SESSION['itnum']     = "active_ADM";
	    $_SESSION['subitnum']  = "active_ADM_1";
	}	  
  
  // Enlace al Resumen Area Almacen
  if ($linkid == "ALM_1") {
      $_SESSION['init']      = "almacen_resumen";
	  $_SESSION['file_path'] = "almacen";
	  $_SESSION['in_frame']  = '1';	

      $_SESSION['itnum']     = "active_ALM";
      $_SESSION['subitnum']  = "active_ALM_1";
  }	  
  
  	// SUBMODULOS DEL MODULO TIENDAS
	// Resumen Area Sucursales
	if ($linkid == "TIE_1") {
		/*switch ($idusrarea) {
			case "2":
				$_SESSION['init']      = "common_inmueble";
				$_SESSION['file_path'] = "common/inmueble";
				$_SESSION['modo']      = "tienda";
	            $_SESSION['in_frame']  = '1';	
				break;
			case "5": */
	    $_SESSION['init']      = "sucursales_resumen";
		$_SESSION['file_path'] = "sucursales";
 		$_SESSION['in_frame']  = '1';	
				/*break;
		}*/		
		$_SESSION['itnum']     = "active_TIE";
    	$_SESSION['subitnum']  = "active_TIE_1";
	}   

	// Agregar Tienda
	if ($linkid == "TIE_2") {
		$_SESSION['init']      = "common_inmueble";
	    $_SESSION['file_path'] = "common/inmueble";
		$_SESSION['modo']      = "tienda";
	    $_SESSION['in_frame']  = '1';	

	    $_SESSION['itnum']     = "active_TIE";
    	$_SESSION['subitnum']  = "active_TIE_2";
	}	  

	// Eliminar Tienda
	if ($linkid == "TIE_3") {
		$_SESSION['init']      = "common_eliminarinmuebles";
	    $_SESSION['file_path'] = "common/inmueble";
		$_SESSION['modo']      = "tienda";
	    $_SESSION['in_frame']  = '1';	

	    $_SESSION['itnum']     = "active_TIE";
    	$_SESSION['subitnum']  = "active_TIE_3";
	}	  
  
	// Modificar Tienda
	if ($linkid == "TIE_4") {
		$_SESSION['init']      = "common_modificarinmuebles";
	    $_SESSION['file_path'] = "common/inmueble";
		$_SESSION['modo']      = "tienda";
		$_SESSION['in_frame']  = '1';	

	    $_SESSION['itnum']     = "active_TIE";
    	$_SESSION['subitnum']  = "active_TIE_4";
	}	  

	// Consultar Tiendas
  	if ($linkid == "TIE_5") {
		$_SESSION['init']      = "common_consultarinmuebles";
	    $_SESSION['file_path'] = "common/inmueble";
		$_SESSION['modo']      = "tienda";
		$_SESSION['in_frame']  = '1';	

	    $_SESSION['itnum']     = "active_TIE";
    	$_SESSION['subitnum']  = "active_TIE_5";
	}	  
   	// CIERRE ELEMENTOS DEL MODULO TIENDAS

  
   	// ELEMENTOS DEL MODULO PEDIDOS
	// Pedidos Enviados
	if ($linkid == "PED_1") {
		$_SESSION['init']      = "sucursales_pedidosenviados";
	    $_SESSION['file_path'] = "sucursales/pedidos";
		$_SESSION['in_frame']  = '1';

	    $_SESSION['itnum']    = "active_PED";
    	$_SESSION['subitnum'] = "active_PED_1";
	}	  

	// Enviar Pedidos 
	if ($linkid == "PED_2") {
		$_SESSION['init']      = "sucursales_enviarpedido";
	    $_SESSION['file_path'] = "sucursales/pedidos";
		$_SESSION['in_frame']  = '1';

	    $_SESSION['itnum']    = "active_PED";
    	$_SESSION['subitnum'] = "active_PED_2";
	}	  
	
	// Pedidos Descargados
	if ($linkid == "PED_3") {
		$_SESSION['init']      = "almacen_pedidosdescargados";
	    $_SESSION['file_path'] = "almacen/pedidos";
		$_SESSION['in_frame']  = '1';

	    $_SESSION['itnum']    = "active_PED";
    	$_SESSION['subitnum'] = "active_PED_3";
	}	  

	// Descargar Pedidos
	if ($linkid == "PED_4") {
		$_SESSION['init']      = "almacen_descargarpedidos";
	    $_SESSION['file_path'] = "almacen/pedidos";
		$_SESSION['in_frame']  = '1';

	    $_SESSION['itnum']    = "active_PED";
    	$_SESSION['subitnum'] = "active_PED_4";
	}	
	
	// Consultar Pedidos
	if ($linkid == "PED_5") {
		$_SESSION['init']      = "supervision_consultarpedidos";
	    $_SESSION['file_path'] = "supervision/pedidos";
		$_SESSION['in_frame']  = '1';

	    $_SESSION['itnum']    = "active_PED";
    	$_SESSION['subitnum'] = "active_PED_5";
	}	

	// Administrar Pedidos
	if ($linkid == "PED_6") {
		$_SESSION['init']      = "supervision_administrarpedidos";
	    $_SESSION['file_path'] = "supervision/pedidos";
		$_SESSION['in_frame']  = '1';

	    $_SESSION['itnum']    = "active_PED";
    	$_SESSION['subitnum'] = "active_PED_6";
	}	
   	// CIERRE ELEMENTOS DEL MODULO PEDIDOS


	// ELEMENTOS DEL MODULO TRASLADOS
	// Traslados Descargados
	if ($linkid == "TRAS_1") {
	    $_SESSION['init']      = "sucursales_trasladosdescargados";
		$_SESSION['file_path'] = "sucursales/traslados";
  	    $_SESSION['in_frame'] = '1';

        $_SESSION['itnum']    = "active_TRAS";
        $_SESSION['subitnum'] = "active_TRAS_1";
	}	

	// Descargar Traslados
	if ($linkid == "TRAS_2") {
	    $_SESSION['init']      = "sucursales_descargartraslados";
		$_SESSION['file_path'] = "sucursales/traslados";
  	    $_SESSION['in_frame'] = '1';

        $_SESSION['itnum']    = "active_TRAS";
        $_SESSION['subitnum'] = "active_TRAS_2";
	}	
	
	// Traslados Enviados
	if ($linkid == "TRAS_3") {
		$_SESSION['init']      = "almacen_trasladosenviados";
	    $_SESSION['file_path'] = "almacen/traslados";
  	    $_SESSION['in_frame'] = '1';

        $_SESSION['itnum']    = "active_TRAS";
        $_SESSION['subitnum'] = "active_TRAS_3";
	}	
	
	// Descargar Traslados
	if ($linkid == "TRAS_4") {
		$_SESSION['init']      = "almacen_enviartraslados";
	    $_SESSION['file_path'] = "almacen/traslados";
  	    $_SESSION['in_frame'] = '1';

        $_SESSION['itnum']    = "active_TRAS";
        $_SESSION['subitnum'] = "active_TRAS_4";
	}	

	// Consultar Traslados
	if ($linkid == "TRAS_5") {
		$_SESSION['init']      = "supervision_consultartraslados";
	    $_SESSION['file_path'] = "supervision/traslados";
  	    $_SESSION['in_frame'] = '1';

        $_SESSION['itnum']    = "active_TRAS";
        $_SESSION['subitnum'] = "active_TRAS_5";
	}	

	// Administrar Traslados
	if ($linkid == "TRAS_6") {
		$_SESSION['init']      = "supervision_administrartraslados";
		$_SESSION['file_path'] = "supervision/traslados";
  	    $_SESSION['in_frame'] = '1';

        $_SESSION['itnum']    = "active_TRAS";
        $_SESSION['subitnum'] = "active_TRAS_6";
	}	
	// CIERRE ELEMENTOS DEL MODULO TRASLADOS


	// ELEMENTOS DEL MODULO TRASLADOS
	// Checar Asistencia
	if ($linkid == "ASIS_1") {
	    $_SESSION['init']      = "asistencia_control";
		$_SESSION['file_path'] = "supervision/asistencia";
  	    $_SESSION['in_frame'] = '1';

        $_SESSION['itnum']    = "active_ASIS";
        $_SESSION['subitnum'] = "active_ASIS_1";
	}	  

	if ($linkid == "ASIS_2") {
		$_SESSION['init']      = "asistencia_registroempleados";
		$_SESSION['file_path'] = "supervision/asistencia";
		$_SESSION['in_frame'] = '1';

		$_SESSION['itnum']    = "active_ASIS";
		$_SESSION['subitnum'] = "active_ASIS_2";
	}	  

	if ($linkid == "ASIS_3") {
		$_SESSION['init']      = "asistencia_administrarempleados";
		$_SESSION['file_path'] = "supervision/asistencia";
		$_SESSION['in_frame'] = '1';

		$_SESSION['itnum']    = "active_ASIS";
		$_SESSION['subitnum'] = "active_ASIS_3";
	}	  

	if ($linkid == "ASIS_4") {
		switch ($idusrarea) {
			case "2":
				$_SESSION['init']      = "asistencia_reportesasistencia";
				$_SESSION['file_path'] = "supervision/asistencia";
				break;
			case "5":
				$_SESSION['init']      = "asistencia_reportesasistenciatiendas";
				$_SESSION['file_path'] = "supervision/asistencia";
				break;
		}		
		$_SESSION['in_frame'] = '1';

		$_SESSION['itnum']    = "active_ASIS";
		$_SESSION['subitnum'] = "active_ASIS_4";
	}	  

	if ($linkid == "ASIS_5") {
		
		$_SESSION['init']      = "asistencia_historialcambios";
		$_SESSION['file_path'] = "supervision/asistencia";
		$_SESSION['in_frame'] = '1';
		
		$_SESSION['itnum']    = "active_ASIS";
		$_SESSION['subitnum'] = "active_ASIS_5";
	}

	if ($linkid == "ASIS_6") {
		
		$_SESSION['init']      = "asistencia_reportesasistenciasistema";
		$_SESSION['file_path'] = "supervision/asistencia";
		$_SESSION['in_frame'] = '1';
		
		$_SESSION['itnum']    = "active_ASIS";
		$_SESSION['subitnum'] = "active_ASIS_4";
	}
	// CIERRE ELEMENTOS DEL MODULO ASISTENCIA


	if ($linkid == "USU_1") {
  		/*switch ($idusrarea) {
			case "2":*/
		$_SESSION['init'] 	   = "supervision_agregarusuarios";
    	$_SESSION['file_path'] = "supervision/usuarios";
				/*break;
		}*/		
		$_SESSION['in_frame'] = '1';

    	$_SESSION['itnum']    = "active_USU";
      	$_SESSION['subitnum'] = "active_USU_1";
	}	  

  /*if ($linkid == "USU_2") {
  		switch ($idusrarea) {
			case "2":
				$_SESSION['init'] = "supervision_eliminarusuarios";
			    $_SESSION['file_path'] = "supervision/usuarios";
				break;
		}		
	  $_SESSION['in_frame'] = '1';
      $_SESSION['itnum']    = "active_USU_1";
      $_SESSION['subitnum'] = "active_USU_2";
  }*/	  

	if ($linkid == "USU_2") {
		$_SESSION['file_path'] = "supervision/usuarios";
 		/* switch ($idtipousr) {
			case "1":
				$_SESSION['init'] = "supervision_modificarusuariossu";
				break; 			
			case "2": */
				$_SESSION['init'] = "supervision_modificarusuarios";
		/*		break;
		} */
		$_SESSION['in_frame'] = '1';

		$_SESSION['itnum']    = "active_USU";
		$_SESSION['subitnum'] = "active_USU_2";
	}	  

/*
Dar Curso de Alta:  
Modificar datos de curso:  
Cambiar Estado de Curso:  
Administrar Tecnicos:  
Administrar Lineas: */


	// ELEMENTOS MODULO CURSOS
   	// Alta de Cursos
	if ($linkid == "CUR_1") {
		$_SESSION['init'] = "cursos_altadecursos";
		$_SESSION['file_path'] = "administracion/cursos";
		$_SESSION['in_frame'] = '1';

		$_SESSION['itnum']    = "active_CUR";
		$_SESSION['subitnum'] = "active_CUR_1";
	}	  
	
	// Modificar Cursos
	if ($linkid == "CUR_2") {
		$_SESSION['init'] = "cursos_modificarcursos";
		$_SESSION['file_path'] = "administracion/cursos";
		$_SESSION['in_frame'] = '1';

		$_SESSION['itnum']    = "active_CUR";
		$_SESSION['subitnum'] = "active_CUR_2";
	}	  

	// Modificar Cursos 
	if ($linkid == "CUR_3") {
		$_SESSION['init'] = "cursos_modificartecnicos";
		$_SESSION['file_path'] = "administracion/cursos";
		$_SESSION['in_frame'] = '1';

		$_SESSION['itnum']    = "active_CUR";
		$_SESSION['subitnum'] = "active_CUR_3";
	}	  

	// Modificar Lineas
	if ($linkid == "CUR_4") {
		$_SESSION['init'] = "cursos_modificarlineas";
		$_SESSION['file_path'] = "administracion/cursos";
		$_SESSION['in_frame'] = '1';

		$_SESSION['itnum']    = "active_CUR";
		$_SESSION['subitnum'] = "active_CUR_4";
	}	  

	// Consultar Cursos
	if ($linkid == "CUR_5") {
		$_SESSION['init'] = "cursos_consultarcursos";
		$_SESSION['file_path'] = "administracion/cursos";
		$_SESSION['in_frame'] = '1';

		$_SESSION['itnum']    = "active_CUR";
		$_SESSION['subitnum'] = "active_CUR_5";
	}	  
	// CIERRE MODULO CURSOS

  // Enlace VISITAS
  if ($linkid == "S_1") { 
      $_SESSION['init'] = "soporte_visitas";
      $_SESSION['itnum'] = "active1";
      $_SESSION['subitnum'] = "active2";
      $_SESSION['subitnum'] = "active2"; 
      if ($linkid == "S_1" and isset($_GET['idvisit'])) {
	  	$_SESSION['idvisit'] = $_GET['idvisit'];
      }
	  if (isset($_GET['muestradet'])) {
		  $_SESSION['muestradet'] = $_GET['muestradet'];
	  } 
  }   

  // Eenlace PENDIENTES
  if ($linkid == "S_2") { 
      $_SESSION['init'] = "soporte_tickets";
      $_SESSION['itnum'] = "active1";
      $_SESSION['subitnum'] = "active4";
      if ($linkid == "S_2" and isset($_GET['idpend'])) {
	  	$_SESSION['idpend'] = $_GET['idpend'];
	  }	
      if ($linkid == "S_2" and isset($_GET['agrpend'])) {
	  	$_SESSION['agrpend'] = $_GET['agrpend'];
      } 
	  $_SESSION['muestra'] = $muestra;
  	  if (isset($_GET['muestradet'])) {
		  $_SESSION['muestradet'] = $_GET['muestradet'];
	  } 

	  	
/*	  echo "id del link: $linkid <br />";
	
	echo "Valores de _POST <br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "nombre: <b>$nombre</b> valor: $valor<br />"; 
		}
	}

	echo "Valores de _GET <br />";
	foreach ($_GET as $nombre => $valor) {
		print "nombre: <b>$nombre</b> valor: $valor<br />"; 
	}*/

  }   
  // DESCARTABLE
  if ($linkid == "S_4") { 
      $_SESSION['init'] = "altpends";
      $_SESSION['itnum'] = "active1";
      $_SESSION['subitnum'] = "active5";
  }   
  
  // Enlace INICIO - RUTAS
  if ($linkid == "S_5") { 
      $_SESSION['init'] = "rutas";
      $_SESSION['itnum'] = "active1";
      $_SESSION['subitnum'] = "active6";
  }   
  
  // Enlace INICIO - ARCHIVOS
  if ($linkid == "S_6") { 
      $_SESSION['init'] = "archivos";
      $_SESSION['itnum'] = "active1";
      $_SESSION['subitnum'] = "active7";
  }   

  // Enlace INICIO - REPORTES	
  if ($linkid == "S_7") { 
      $_SESSION['init'] = "reportes";
      $_SESSION['itnum'] = "active1";
      $_SESSION['subitnum'] = "active8";
  }   

  if ($linkid == "S_8") { 
      $_SESSION['init'] = "administracion";
      $_SESSION['itnum'] = "active1";
      $_SESSION['subitnum'] = "active8";
  }   


  
// ------------------- FIN DE LINKS SUPERVISION ----------------------


  // Links Menu SISTEMAS
  if ($linkid == "0_1") { 
      $_SESSION['init'] = "initmant";
      $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active1";
  }   

  if ($linkid == "1") {
      $_SESSION['init'] = "vertienda";
      $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active1";
      $_SESSION['orden'] = $orden;
	  $_SESSION['direcc'] = $direcc;
  }   

  if ($linkid == "2") {
      $_SESSION['init'] = "actualiza";
      $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active2";
  }   

  if ($linkid == "2_1") {
	  $_SESSION['init'] = "actopt1";
	  $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active3";
      if (isset($_GET['busca'])) {
	  		$_SESSION['busca'] = $_GET['busca']; 
	  } else if (isset($_POST['busca'])) {
			$_SESSION['busca'] = $_POST['busca'];
	  }
	  $_SESSION['desdefecha'] = "";
      $_SESSION['raninicio'] = "";  
      $_SESSION['ranfin'] = "";	
      if ($_SESSION['busca'] == "definida") { 
		  	$_SESSION['desdefecha'] = $_POST['desdefecha'];
			$_SESSION['raninicio'] = $_POST['raninicio'];  
			$_SESSION['ranfin'] = $_POST['ranfin'];	 	     	 	
	  }	
 }	  

  if ($linkid == "2_2") {
	  $_SESSION['init'] = "actopt2";
	  $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active3";
      if (isset($_GET['listando'])) {
	  		$_SESSION['listando'] = $_GET['listando']; 
	  } else if (isset($_POST['listando'])) {
			$_SESSION['listando'] = $_POST['listando'];
	  }
	  $_SESSION['filtestado'] = "";
      $_SESSION['filtorden'] = "";  
      $_SESSION['filttienda'] = "";	
      if ($_SESSION['listando'] == "filtrados") { 
                        if (isset($_POST['filtestado'])) {  
		  		$_SESSION['filtestado'] = $_POST['filtestado'];
                        } elseif (isset($_GET['filtestado'])) {
                                $_SESSION['filtestado'] = $_GET[filtestado];  
                        }

			if (isset($_POST['filtorden'])) {  
		  		$_SESSION['filtorden'] = $_POST['filtorden'];
                        } elseif (isset($_GET['filtorden'])) {
                                $_SESSION['filtorden'] = $_GET['filtorden'];  
                        }                               
			  	     	 	
	  }	
	  if ($_SESSION['listando'] == "portienda") {		  
  			$_SESSION['filttienda'] = $_POST['filttienda'];
	  } 	
 }	  
 
  if ($linkid == "2_2_1") {
	  $_SESSION['init'] = "actopt2_1";
	  $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active3";
      if (isset($_GET['id'])) {
	  		$_SESSION['id'] = $_GET['id']; 
	  } else if (isset($_POST['id'])) {
			$_SESSION['id'] = $_POST['id'];
	  }
      $_SESSION['list'] = $_GET['list'];
      $_SESSION['estado'] = $_GET['estado'];
      $_SESSION['orden'] = $_GET['orden'];
      $_SESSION['ftienda'] = $_GET['ftienda'];
      $_SESSION['tabla'] = $_GET['tabla'];	  
  }  
  
  if ($linkid == "2_2_2") {
	  $_SESSION['init'] = "actopt2_2";
	  $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active3";
	  $_SESSION['id'] = "";
	  $_SESSION['list'] = ""; 
      $_SESSION['estado'] = "";
      $_SESSION['orden'] = "";
      $_SESSION['ftienda'] = "";
      $_SESSION['tabla'] = "";	  

      if (isset($_GET['id'])) {
	  		$_SESSION['id'] = $_GET['id']; 
	  } else if (isset($_POST['id'])) {
			$_SESSION['id'] = $_POST['id'];
	  }
	  
      if (isset($_GET['list'])) {
	  		$_SESSION['list'] = $_GET['list']; 
	  } else if (isset($_POST['list'])) {
			$_SESSION['list'] = $_POST['list'];
	  }
	  
	  if (isset($_GET['estado'])) {
	  		$_SESSION['estado'] = $_GET['estado']; 
	  } else if (isset($_POST['estado'])) {
			$_SESSION['estado'] = $_POST['estado'];
	  }

	  if (isset($_GET['orden'])) {
	  		$_SESSION['orden'] = $_GET['orden']; 
	  } else if (isset($_POST['orden'])) {
			$_SESSION['orden'] = $_POST['orden'];
	  }

	  if (isset($_GET['ftienda'])) {
	  		$_SESSION['ftienda'] = $_GET['ftienda']; 
	  } else if (isset($_POST['ftienda'])) {
			$_SESSION['ftienda'] = $_POST['ftienda'];
	  }

      if (isset($_GET['tabla'])) {
	  		$_SESSION['tabla'] = $_GET['tabla']; 
	  } else if (isset($_POST['tabla'])) {
			$_SESSION['tabla'] = $_POST['tabla'];
	  }    
  }  
  
  if ($linkid == "2_2_2_1") {
	  $_SESSION['init'] = "actopt2_2_1";
	  $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active3";
      $_SESSION['actdesc'] = $_POST['actdesc'];
      $_SESSION['actpropiedades'] = $_POST['actpropiedades'];
      $_SESSION['actestado'] = $_POST['actestado'];
      $_SESSION['actfecha'] = $_POST['actfecha'];
      $_SESSION['idact'] = $_POST['idact'];	  
	  $_SESSION['idtienda'] = $_POST['idtienda'];
	  $_SESSION['idact'] = $_POST['idact'];
	  $_SESSION['plist'] = $_POST['plist'];
	  $_SESSION['pestado'] = $_POST['pestado'];
	  $_SESSION['porden'] = $_POST['porden'];
	  $_SESSION['pftienda'] = $_POST['pftienda'];
	  $_SESSION['ptabla'] = $_POST['ptabla'];
  }  
  

 

  if ($linkid == "2_4") {
	  $_SESSION['init'] = "actopt4";
	  $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active3";
      if (isset($_GET['busqueda'])) {
	  		$_SESSION['busqueda'] = $_GET['busqueda']; 
	  } else if (isset($_POST['busqueda'])) {
			$_SESSION['busqueda'] = $_POST['busqueda'];
	  }
	  $_SESSION['busctipo'] = "";
      $_SESSION['filtorden'] = "";  
      $_SESSION['busctexto'] = "";
	  $_SESSION['campoafect'] = "";	
      if (isset ($_POST['busctipo'])) { 
		  	$_SESSION['busctipo'] = $_POST['busctipo'];
			$_SESSION['filtorden'] = $_POST['filtorden'];  	     	 	
	  }	
	  if ($_SESSION['busqueda'] == "portexto") {		  
  			$_SESSION['busctexto'] = $_POST['busctexto'];
			$_SESSION['campoafect'] = $_POST['campoafect'];
	  } 	
 }	  

  if ($linkid == "3") {
      $_SESSION['init'] = "progvisit";
      $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active4";
  }   

  if ($linkid == "4") {
      $_SESSION['init'] = "alta";
      $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active5";  
  }
  
  if ($linkid == "5") {
      $_SESSION['init'] = "modif";
      $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active6";
  }      
  
  if ($linkid == "6") {
      $_SESSION['init'] = "vertdet";
      $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active2";
	  $_SESSION['idt'] = $idt;
	  $_SESSION['muestra'] = $muestra;
  }
	  
  if ($linkid == "7") {
      $_SESSION['init'] = "vertact";
      $_SESSION['itnum'] = "active2";
      $_SESSION['subitnum'] = "active3";
	  $_SESSION['idt'] = $idt;
	  $_SESSION['muestra'] = $muestra;	  
  }      
  
// --------------- FIN DE LINKS DE MANTENIMIENTO --------------------

  // SOPORTE EN LINEA
  if ($linkid == "0_2") { 
      $_SESSION['init'] = "initsoporte";
      $_SESSION['itnum'] = "active4";
      $_SESSION['subitnum'] = "active1";
  }   
     
  // MENU SOPORTE EN LINEA

  // Enlace RESUMEN	
  if ($linkid == "lk_sp_1") { 
      $_SESSION['init'] = "initsoporte";
      $_SESSION['itnum'] = "active4";
      $_SESSION['subitnum'] = "active1";
  }	  

  // Enlace VISITAS
  if ($linkid == "lk_sp_2") { 
      $_SESSION['init'] = "listatickets";
      $_SESSION['itnum'] = "active4";
      $_SESSION['subitnum'] = "active2";
  }	  
//    if ($linkid == "S_1" and isset($_GET['idvisit'])) {
//    $_SESSION['idvisit'] = $_GET['idvisit'];
//      }
//	  if (isset($_GET['muestradet'])) {
//		  $_SESSION['muestradet'] = $_GET['muestradet'];
//	  } 
//  }   

  
  
  
  
  
  
  
  
  
  
  if ($linkid == "0_3") { 
      $_SESSION['init'] = "inicio";
      $_SESSION['itnum'] = "active4";
      $_SESSION['subitnum'] = "active1";
  }   
  
  if ($linkid == "0_4") { 
      $_SESSION['init'] = "inicio";
      $_SESSION['itnum'] = "active5";
      $_SESSION['subitnum'] = "active1";
  }   

//  headers_sent(&$file, &$line); 
//  var_dump($file, $line);

  header('Location: inicio.php');   
exit;
    

?>