<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script language="JavaScript" src="calendario/javascripts.js"></script>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="table.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
</head>

<?php
	session_start();
	
	$rutafunciones = $_SESSION['rutafunciones'];
	
	include $rutafunciones.'consultas.php';
	include "calendario/calendario.php";
	
	$hostname = $_SESSION['hostname'];
	
	$target_link = $_SESSION['hostname'].'administracion/cursos/cursos_ejecutamodificar.php';

/* 	echo "<span class=\"tipoletra\">Valores de _POST</span><br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
		}
	}  */

    if (isset($_SESSION['err_return'])) {
 		$invalid_check = $_SESSION['err_return']['invalid_check'];
		$err_return = $_SESSION['err_return'];
		foreach ($err_return as $nombre => $valor) {
		   	${$nombre} = $valor;
		} // Cierre foreach     
	} 
	unset($_SESSION['err_return']);




?>



<body>
<br />
<h2>Alta De cursos</h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form id="altaform" name="altaform" method="post" action="<?php echo $target_link; ?>">
      <table width="96%" border="0" align="center">
        <tr>
          <th scope="col"> <p align="left">
            <label class="captions">Ingresar curso en la tienda:</label>
              <label>
              <select name="mntpass" id="select">
              <option>Selecciona una Tienda</option>
<?php

		// Consulta para determinar Listar Nombres de tienda
    	// la consulta elige el numero de la tienda y su nombre
		$cols_arr = array("idinmu", "nombreinmu");
		$num_cols = count($cols_arr);
		$tables_arr = array("inmu_gdat");
		$where_clause = "idinmutipo <> 6 AND idinmutipo <> 5 AND idinmustat = '1'";
		$order = "nombreinmu";

		$recupera_nombres = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

		unset($where_clause);

/*		$recupera_nombres = mysql_query("SELECT idtienda, nombret FROM cursos_tiendas;", $conexion); // Recupera nombres de tiende para incluirlos en Menú
			if (!$recupera_nombres) {
				die('Consulta Invalida: ' . mysql_error());		
			}*/
           			
		while($row=mysql_fetch_row($recupera_nombres)) {
			echo "<option";
			if (isset($error_id) and $mntpass == $row[0]) {
				echo " selected";
			}	
			echo " value=\"$row[0]\">$row[1]</option>";
		}   // cierre de While    					 
?>
              </select>
              </label><?php
		if ($error_id == "0") {
	    	echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
    	}
?>

          </p></th>
        </tr>
        <tr>
          <th align="left" scope="col"><label class="captions">Nombre del Curso:</label>
              <label>
              <input type="text" name="ncurso" id="ncurso" value="<?php if ($invalid_check == "1") { echo "$ncurso"; }?>" />
              <?php
		if ($error_id == "1" or $error_id == "2") {
	    	echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
    	}
?>
            </label></th>
        </tr>
        <tr>
          <th align="left" scope="col"><label class="captions">Ingresa L&iacute;nea:</label>
              <label>
              <select name="nlinea" id="nlinea">
                <option selected="selected">Selecciona Una L&iacute;nea</option>
                <?php


//		include "conectarcursos.php";
		include "funciones_conversion.php"; 


		// Consulta para determinar y Listar Nombres de Lineas
        // la consulta elige nombre de la línea

		$cols_arr = array("idlinea", "nlinea");
		$num_cols = count($cols_arr);
		$tables_arr = array("curs_line");
		$order = "nlinea";

		$recupera_nlinea = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);


/*		$recupera_nlinea = mysql_query("SELECT nlinea FROM cursos_lineas;", $conexion); // Recupera nombres de tiende para incluirlos en Menú
			if (!$recupera_nlinea) {
				die('Consulta Invalida: ' . mysql_error());		
			}*/
           			
		while($row=mysql_fetch_row($recupera_nlinea)) {
//		$row_completa = cambia_espacios($row[0]);	    
			echo "<option";
			if (isset($error_id) and $nlinea == $row[0]) {
				echo " selected";
			}	
			echo " value=\"$row[0]\">$row[1]</option>";
		}   // cierre de While    					 
//		$row=mysql_fetch_row($recupera_nlinea);
?>
              </select>
              <?php
		if ($error_id == "3") {
	    	echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
    	}
?>
            </label></th>
        </tr>
        <tr>
          <th align="left" scope="col"><label class="captions">Fecha de Realizacion (formato aaaa-mm-dd):</label>
	      <?php if ($invalid_check == "1") { $errorparam = $dfecha; } escribe_formulario_fecha_vacio("dfecha","altaform",$dfecha); ?>
	  

              <label>
              <?php
		if ($error_id == "4" or $error_id == "5" or $error_id == "6") {
	    	echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
    	}
?>
            </label></th>
        </tr>
        <tr>
          <th align="left" scope="col"><label class="captions">Hora de Inicio:</label>
              <label>
              <select name="dhora" id="dhora">
                <option>Elige una Hora</option>

<?php

		if (isset($error_id)) {
			echo "<option selected>$dhora</option>";		
		}

?>
                <option>09:00:00</option>
                <option>09:30:00</option>
                <option>10:00:00</option>
                <option>10:30:00</option>
                <option>11:00:00</option>
                <option>11:30:00</option>
                <option>12:00:00</option>
                <option>12:30:00</option>
                <option>13:00:00</option>
                <option>13:30:00</option>
                <option>14:00:00</option>
                <option>14:30:00</option>
                <option>15:00:00</option>
                <option>15:30:00</option>
                <option>16:00:00</option>
                <option>16:30:00</option>
                <option>17:00:00</option>
                <option>17:30:00</option>
                <option>18:00:00</option>
                <option>18:30:00</option>
                <option>19:00:00</option>
              </select>
              <?php
		if ($error_id == "7") {
	    	echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
    	}
?>
            </label></th>
        </tr>
        <tr>
          <th align="left" scope="col"><label class="captions">Tecnico que Imparte:</label>
              <label>
              <select name="ntecnico" id="ntecnico">
                <option selected="selected">Selecciona Un T&eacute;cnico</option>
                <?php

		
		// Consulta para determinar y Listar Nombres de Tecnicos
        // la consulta elige el nombre de cada tecnico
		$cols_arr = array("idtecnico", "nombretec");
		$num_cols = count($cols_arr);
		$tables_arr = array("curs_tecn");
		$order = "nombretec";

		$recupera_ntec = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
		unset($order);
		
/*		$recupera_ntec = mysql_query("SELECT nombretec FROM cursos_tecnicos;", $conexion); // Recupera nombres de tiende para incluirlos en Menú
			if (!$recupera_ntec) {
				die('Consulta Invalida: ' . mysql_error());		
			} */
           			
		while($row=mysql_fetch_row($recupera_ntec)) {
//		$row_completa = cambia_espacios($row[0]);	    
			echo "<option";
			if (isset($error_id) and $ntecnico == $row[0]) {
				echo " selected";
			}	
			echo " value=\"$row[0]\">$row[1]</option>";
		}   // cierre de While    					 
//		$row=mysql_fetch_row($recupera_ntec);
?>
              </select>
              <?php
		if ($error_id == "8") {
	    	echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
    	}
?>
            </label></th>
        </tr>
        <tr>
          <th align="left" scope="col"><label class="captions">Estado Del Curso:</label>
              <label>
              <select name="destado" id="destado">
                
<?php

		if (!isset($error_id)) {
//			echo "<option selected>$destado</option>";		
//		} else {

?>
			<option value="2" selected="selected">Confirmado</option>

<?php
		}
		
		// Consulta para determinar y Listar Nombres de Tecnicos
        // la consulta elige el nombre de cada tecnico
		$cols_arr = array("idcursostat", "estado");
		$num_cols = count($cols_arr);
		$tables_arr = array("curs_csta");
//		$order = "nombretec";

		$recupera_cursostat = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
		
/*		$recupera_ntec = mysql_query("SELECT nombretec FROM cursos_tecnicos;", $conexion); // Recupera nombres de tiende para incluirlos en Menú
			if (!$recupera_ntec) {
				die('Consulta Invalida: ' . mysql_error());		
			} */
           			
		while($row=mysql_fetch_row($recupera_cursostat)) {
//			$row_completa = cambia_espacios($row[1]);	    
			if ($invalid_check == "1" and $row[0] <> "3") {
				echo "<option";
				if ($row[0] == $destado) {
					echo " selected";
				}
				echo " value=\"$row[0]\">$row[1]</option>";
//				echo "<option>entro aqui</option>";
			} else {
				if ($row[0] <> "3" and $row[0] <> "4") { 
					echo "<option";
					echo " value=\"$row[0]\">$row[1]</option>";
				}	
			}	
		}   // cierre de While    					 
//		$row=mysql_fetch_row($recupera_ntec);
?>                
              </select>
            </label></th>
        </tr>
        <tr>
          <th align="left" scope="col"><label class="captions">Observaciones:</label>
              <label><br />
              <textarea name="dobserv" id="dobserv2" cols="45" rows="5"></textarea>
              </label></th>
        </tr>
        <tr>
          <th align="left" scope="col"><label>
            <input type="submit" name="button" id="button" value="Enviar Datos" />
            <input type="reset" name="button" id="button" value="Borrar Todo" />
            <input name="modact" type="hidden" id="modact" value="insertacurso" />
            <input name="modactlist" type="hidden" id="modactlist" value="cursos" />
          </label></th>
        </tr>
      </table>
    </form>
      </td>
  </tr>
</table>
<p>&nbsp;</p>
<p>
<?php

// echo getcwd()."\n";


?>
</body>
</html>
