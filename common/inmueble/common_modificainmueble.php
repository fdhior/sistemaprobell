<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--


.textoboton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 8px;
	font-weight: bold;
}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php
	session_start();

	include $_SESSION['rutafunciones'].'consultas.php';
	
	$hostname    = $_SESSION['hostname'];
	$abshostname = $_SESSION['abshostname'];
	
	$target_link  = "common/inmueble/common_actualizainmueble.php";
	$target_link2 = "cursos/ubicacion.php";


    // Mostrar los valores de _SESSION
/*    echo "Valores de _SESSION <br />";
	foreach ($_SESSION as $nombre => $valor) {
    	if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
        }
	}  */

//	print_r($_SESSION['err_return']);
/*	echo "Valores de _POST <br />";
	foreach ($_POST as $nombre => $valor) {
    	if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
        }
	} */

	if (isset($_SESSION['err_return'])) {
		$modoed = $_SESSION['err_return']['modoed'];
	} else {
		foreach ($_POST as $nombre => $valor) {
    	   	if(stristr($nombre, 'button') === FALSE) {
        	   	${$nombre} = $valor;
			}
		} // Cierre foreach     
	}	

?>

<body>


<?php

	switch ($modoed) {
		case "editatienda":	

//			print_r($_SESSION['err_return']); 
		    if (isset($_SESSION['err_return'])) {
  				$invalid_check = $_SESSION['err_return']['invalid_check'];
				$err_return = $_SESSION['err_return'];
				foreach ($err_return as $nombre => $valor) {
		   		   	${$nombre} = $valor;
				} // Cierre foreach     
			} 
			unset($_SESSION['err_return']);

//			echo "$invalid_check";
		

	       	// Definicion de los parametros de la consulta
			//                          0                  1                   2               3          4         5         6        7              8
	        $cols_arr      = array("nombreinmu", "gnrl_enca.nombre", "inmu_dfis.razonsc", "direccion", "notel1", "notel2", "nocel", "nofax", "inmu_gdat.idubica");
       		$num_cols      = count($cols_arr);
        	$join_tables   = '1';
	        $tables_arr    = array("gnrl_enca", "inmu_gdat", "inmu_dfis");
    	    $num_tables    = count($tables_arr);
			$on_fields_arr = array("idenc", "idfis");
			$connect      = '1';
	       	$where_clause = "inmu_gdat.idinmu = '$idinmu'";

	        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
    	    $row0=mysql_fetch_row($result);
		
       		unset($join_tables);
			unset($on_fields_arr);
			unset($connect);
       		unset($where_clause);
			
			$guarda_idubica = $row0[8];
//			$guarda_nombretienda = $row0[8];


?>	


<br />
<h2> Modificar Datos de Tienda <?php echo "$row0[0]"; ?>
</h2>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
	<form id="form1" name="form1" method="post" action="<?php echo "$hostname$target_link"; ?>" target="_self">
      <td width="40%" valign="top"><label class="letramoduser">Nombre de Tienda: <strong><?php echo "$row0[0] $row[8]"; ?></strong></label>
          <br />
          <label class="letramoduser">No. de Tienda: <strong><?php echo "$idinmu"; ?></strong></label>
        <br />
          <label class="letramoduser">Encargado(a): <strong><?php echo "$row0[1]"; ?></strong></label>
        <br />
        <label class="letramoduser">Editar Direccion:<br />
</label>
        <label class="letramoduser">
          <textarea name="direccion" id="direccion" cols="30" rows="5"><?php if ($invalid_check == '1') { echo "$direccion"; } else { echo "$row0[3]"; } ?></textarea>
        </label><br />
          <?php
        if ($error_id == "0") {
                echo "<span class=\"letra_alertaestado\"><strong>Error: $errorpass</strong></span>";
        }
?>
        <br />
          <label class="letramoduser"></label>
<br />      </td>
  <td width="40%" valign="top">
    <label class="letramoduser_nopadd">Cambiar Razón Social:</label>
        <label>
            <select name="sel_rsc" id="sel_rsc">
              <?php

		if ($invalid_check == '1') {
			echo "<option selected>$sel_rsc</option>";		
		} else {
			echo "<option selected>$row0[2]</option>";		
		}

//		$sel_rsc = $row0[2];
        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr = array("razonsc");
        $num_cols = count($cols_arr);
//      $join_tables = '0';
        $tables_arr = array("inmu_dfis");
        $num_tables = count($tables_arr);
//      $where_clause = "idarea = 5";
//      $order = "gnrl_usrs.nombre";

  		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

         while($row1=mysql_fetch_row($result)) {
	       	if ($row1[0] <> $row0[2]) {	
				echo "<option>$row1[0]</option>";
			}	
        }   // cierre de While
		

?>
            </select>
        </label>
<br />
            <label class="letramoduser_nopadd">Editar N&uacute;meros Telef&oacute;nicos:</label>
            <br />
            <label class="letramoduser_nopadd">No. Tel. 1:</label>
            <label>
            <input name="notel1" type="text" id="notel1" size="10" maxlength="20" value="<?php if ($invalid_check == '1') { echo "$notel1"; } else { echo "$row0[4]"; } ?>" />
            </label>
<label class="letramoduser">No. Tel.2:</label>
            <label>
            <input name="notel2" type="text" id="notel2" size="10" maxlength="20" value="<?php if ($invalid_check == '1') { echo "$notel2"; } else { echo "$row0[5]"; } ?>" />
            </label>
    <br />
            <label class="letramoduser_nopadd">No. Cel:</label>
            <label>
            <input name="nocel" type="text" id="nocel" size="12" maxlength="20" value="<?php if ($invalid_check == '1') { echo "$nocel"; } else { echo "$row0[6]"; } ?>" />
            </label>
    <label class="letramoduser">No. Fax:</label>
            <label>
            <input name="nofax" type="text" id="nofax" size="10" maxlength="10" value="<?php if ($invalid_check == '1') { echo "$nofax"; } else { echo "$row0[7]"; } ?>" />
            </label>


          <p>
            <label class="letramoduser_nopadd">
            <input type="submit" name="button" id="button" value="Actualizar Datos" />
            </label>
            <input name="idinmupass" type="hidden" id="idinmupass" value="<?php echo "$idinmu"; ?>" />
            <input name="nombretpass" type="hidden" id="nombretpass" value="<?php echo "$row0[0]"; ?>" />
            <input name="modoedpass" type="hidden" id="modoedpass" value="<?php echo "$modoed"; ?>" />
            <br />
            <?php
        if ($error_id == "1" or $error_id == "2" or $error_id == "3" or $error_id == "4") {
                echo "<span class=\"letra_alertaestado\"><strong>Error: $errorpass</strong></span>";
        }
?>
      </p>      </td></form>

<?php

	if ($row0[8] == '0') {
	
?>	

        <form name="form11" id="form12" method="post" action="<?php echo "$hostname$target_link"; ?>" target="_self">
    		<td width="20%" valign="top">        
            <span class="letramoduser_nopadd">Agregar Enlace de ubicación(Google Maps)</span>
                    <label>
                    <input type="text" name="linkpass" id="linkpass" />
                    </label>
            <br />
            <label>
                    <?php
        if ($error_id == "5") {
                echo "<span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
?>
                    <input type="submit" value="Agregar Enlace" />
            </label>
                    <input name="modoedpass" type="hidden" id="modoedpass" value="<?php echo "agregalinktienda"; ?>" />
                    <input name="idinmupass" type="hidden" id="idinmupass" value="<?php echo "$idinmu"; ?>" />
                    <input name="ntpass" type="hidden" id="ntpass" value="<?php echo "$row0[0]"; ?>" />
		</form></td>

<?php

	} else {
	
?>

  		<td width="20%" valign="top">        
            <span class="letramoduser_nopadd">Mostrar ubicacion de la tienda</span>
            <br />
            <a class="letramoduser_nopadd" href="<?php echo "$abshostname$target_link2"; ?>?ntpass=<?php echo "$row0[0]"; ?>&idinmupass=<?php echo "$idinmu"; ?>" target="_blank">Ver ubicacion</a>
		</td>


<?php	

	}
	
?>	
    </tr>
  </table>




<?php

			break;
		case "editaencargado":

		    if (isset($_SESSION['err_return'])) {
  				$invalid_check = $_SESSION['err_return']['invalid_check'];
				$err_return = $_SESSION['err_return'];
				foreach ($err_return as $nombre => $valor) {
		   		   	${$nombre} = $valor;
				} // Cierre foreach     
			} 
			unset($_SESSION['err_return']);

	       	// Definicion de los parametros de la consulta
	        $cols_arr      = array("nombreinmu", "gnrl_enca.nombre");
        	$num_cols      = count($cols_arr);
    	    $join_tables   = '1';
	        $tables_arr    = array("gnrl_enca", "inmu_gdat");
    	    $num_tables    = count($tables_arr);
			$on_fields_arr = array("idenc");
			$connect      = '1';
        	$where_clause = "inmu_gdat.idinmu = '$idinmu'";

	        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
    	    $row0=mysql_fetch_row($result);
		
        	unset($join_tables);
			unset($on_fields_arr);
			unset($connect);
        	unset($where_clause);

?>

<br />
<h2> Editar Encargado(a) de Tienda <?php if (!isset($add_opt)) { echo "$row0[0]"; } ?></h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="54%" valign="top"><?php 

	    if (isset($_SESSION['err_return'])) {
  			$invalid_check = $_SESSION['err_return']['invalid_check'];
			$err_return = $_SESSION['err_return'];
			foreach ($err_return as $nombre => $valor) {
	   		   	${$nombre} = $valor;
			} // Cierre foreach     
		} 
		unset($_SESSION['err_return']);

		if (isset($add_opt)) {
			switch ($add_opt) {
				case "1":
					if ($submodoed == "editanombreencargado") {

					$extrae_idenc = substr($sel_enc,0,strpos($sel_enc," - ")-0);

					$cols_arr      = array("gnrl_enca.nombre", "inmu_gdat.nombreinmu");
			    	$num_cols      = count($cols_arr);
				    $join_tables   = '1';
					$tables_arr    = array("gnrl_enca", "inmu_gdat");
				    $num_tables    = count($tables_arr);
					$on_fields_arr = array("idenc");
					//	$connect      = '1';
				  	$where_clause = "inmu_gdat.idenc = '$extrae_idenc'";

					$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

					$row=mysql_fetch_row($result);

?>

      <span class="letramoduser">Edita el nombre del Encargado(a) de la tienda: <strong><?php echo "$row[1]"; ?></strong></span><br />
      <br />
      <form id="form8" name="form8" method="post" action="<?php echo "$hostname$target_link"; ?>" target="_self">
        <label class="letramoduser">
        <input name="encargado" type="text" id="encargado" value="<?php echo "$row[0]"; ?>" size="30" maxlength="30" />
        </label>
        <label>
        <input type="submit" name="button" id="button" value="Actualizar" />
        </label>
        <input name="modoedpass" type="hidden" id="modoedpass" value="editanombreencargado" />
        <input name="idencpass" type="hidden" id="idencpass" value="<?php echo "$extrae_idenc" ?>" />
        <input name="nombretpass" type="hidden" id="nombretpass" value="<?php echo "$row[1]" ?>" />
      </form>	

<?php

					} else {

?>
      <span class="letramoduser">Edita el nombre de un(a) Encargado(a) existente</span><br />
      <span class="letramoduser">Elije un encargado de la lista siguiente para editar su nombre:</span><br />
      <br />
      <form id="form8" name="form8" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">

	  <label class="letramoduser">
      <select name="sel_enc" id="sel_enc">
<?php

		$cols_arr      = array("gnrl_enca.idenc", "gnrl_enca.nombre", "inmu_gdat.nombreinmu");
    	$num_cols      = count($cols_arr);
	    $join_tables   = '1';
		$tables_arr    = array("gnrl_enca", "inmu_gdat");
	    $num_tables    = count($tables_arr);
		$on_fields_arr = array("idenc");
//			$connect      = '1';
	  	$where_clause = "gnrl_enca.idenc <> '0' AND gnrl_enca.asig = '1'";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
//    $row=mysql_fetch_row($result);
	
		while($row=mysql_fetch_row($result)) {
			echo "<option>$row[0] - $row[1] de $row[2]</option>";
		}   // cierre de While

?>
        </select>
        </label>
            <label>
            <input type="submit" name="button" id="button" value="Editar" />
            </label>
            <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
            <input name="submodoed" type="hidden" id="modoed" value="editanombreencargado" />
            <input name="add_opt" type="hidden" id="add_opt" value="1" />
      </form>
      <br />
      <?php
					}
					break;
				case "2":
?>				

      <span class="letramoduser">Agrega un Encargado(a) a la base de datos sin asignarlo a una tienda</span><br /><br />

      <form id="form8" name="form8" method="post" action="<?php echo "$hostname$target_link"; ?>" target="_self">
	  <label class="letramoduser">
	  <input name="encargado" type="text" id="encargado" size="30" maxlength="30" value="<?php if ($invalid_check == '3') { echo "$encargado"; } ?>" />
	  </label>
            <label>
            <input type="submit" name="button" id="button" value="Agregar" />
            </label>
            <input name="modoedpass" type="hidden" id="modoedpass" value="agregaencargado" />
            <input name="add_optpass" type="hidden" id="add_optpass" value="2" /><br />
            <?php
        if ($error_id == "0" or $error_id == "1" or $error_id == "2") {
                echo "<span class=\"letra_alertaestado\"><strong>Error: $errorpass</strong></span>";
        }
?>
      </form>
      <br />				

<?php
				
					break;
				case "3":

					if ($submodoed == "checaencargadoestado") {

					$cols_arr      = array("gnrl_enca.nombre", "inmu_gdat.idinmu");
			    	$num_cols      = count($cols_arr);
				    $join_tables   = '1';
					$tables_arr    = array("gnrl_enca", "inmu_gdat");
				    $num_tables    = count($tables_arr);
					$on_fields_arr = array("idenc");
				  	$where_clause  = "inmu_gdat.nombreinmu = '$sel_tiend'";

					$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
				    $row=mysql_fetch_row($result);
	
						if ($row[0] <> "(sin asignar)") {
?>

      <span class="letramoduser">La tienda <strong><?php echo "$sel_tiend"; ?></strong> ya tiene asignado a <strong><?php echo "$row[0]" ?></strong></span>.<br />
      <span class="letramoduser">como encargado, asignar al nuevo encargado <strong><?php echo "$sel_enc"; ?></strong> desasociará</span><br />
      <span class="letramoduser">al encargado anterior de la tienda, pero no lo quitará de la base de datos</span><br />
      <span class="letramoduser">¿Deseas continuar?.<br />
      </span>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
		<form id="form10" name="form10" method="post" action="<?php echo "$hostname$target_link"; ?>" target="_self">
          <td width="4%">
            <label class="letramoduser">
              <input type="submit" name="button" id="button" value="Si" />
              <input name="modoedpass" type="hidden" id="modoedpass" value="asignanoasigencargado" />
               <input name="idinmupass" type="hidden" id="idinmupass" value="<?php echo "$row[1]"; ?>" />
               <input name="encargado" type="hidden" id="encargado" value="<?php echo "$sel_enc"; ?>" />
               <input name="encargado_ant" type="hidden" id="encargado_ant" value="<?php echo "$row[0]"; ?>" />
               <input name="nombretpass" type="hidden" id="nombretpass" value="<?php echo "$sel_tiend"; ?>" />

              </label>          </td>
          </form>
		<form id="form11" name="form11" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
          <td width="96%">
            <label>
              <input type="submit" name="button" id="button" value="No" />
              <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
              <input name="add_opt" type="hidden" id="add_opt" value="3" />
              </label>          </td>
          </form>
        </tr>
      </table>
      .<br />
      </br />
			

<?php 

						} else {
?>						
      <span class="letramoduser">La tienda <strong><?php echo "$sel_tiend"; ?></strong> no tiene un encargado asociado.</span><br />
      <span class="letramoduser">se le asiganrá el nuevo encargado <strong><?php echo "$sel_enc"; ?></strong>.</span><br />
      <span class="letramoduser">¿Deseas continuar?.</span><br /><br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
		<form id="form10" name="form10" method="post" action="<?php echo "$hostname$target_link"; ?>" target="_self">
          <td width="4%">
            <label class="letramoduser">
              <input type="submit" name="button" id="button" value="Si" />
              <input name="modoedpass" type="hidden" id="modoedpass" value="asignanoasigencargado" />
               <input name="submodoedpass" type="hidden" id="submodoedpass" value="encsinasignar" />
               <input name="idinmupass" type="hidden" id="idinmupass" value="<?php echo "$row[1]"; ?>" />
               <input name="encargado" type="hidden" id="encargado" value="<?php echo "$sel_enc"; ?>" />
               <input name="encargado_ant" type="hidden" id="encargado_ant" value="<?php echo "$row[0]"; ?>" />
               <input name="nombretpass" type="hidden" id="nombretpass" value="<?php echo "$sel_tiend"; ?>" />

              </label>          </td>
          </form>
		<form id="form11" name="form11" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
          <td width="96%">
            <label>
              <input type="submit" name="button" id="button" value="No" />
              <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
              <input name="add_opt" type="hidden" id="add_opt" value="3" />
              </label>          </td>
          </form>
        </tr>
      </table>
						

<?php

						}	
					} else {

?>

      <span class="letramoduser">Asigna un Encargado(a) existente en la base y no asignado a una tienda</span>.<br /><br />
      <form id="form9" name="form9" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
        <label class="letramoduser">Elige el encargado:</label><br />
		<label class="letramoduser">
        <select name="sel_enc" id="sel_enc">
          <?php

		$cols_arr     = array("gnrl_enca.nombre");
    	$num_cols     = count($cols_arr);
		$tables_arr   = array("gnrl_enca");
	  	$where_clause = "gnrl_enca.idenc <> '0' AND gnrl_enca.asig = '0'";
		$order 		  = "gnrl_enca.nombre";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
//    $row=mysql_fetch_row($result);
	
		while($row=mysql_fetch_row($result)) {
			echo "<option>$row[0]</option>";
		}   // cierre de While

?>
        </select>
        </label>
        <br />
        <br />
        <label class="letramoduser">Elige la tienda a donde lo quieres asignar</label><br />
		<label class="letramoduser"> 
        <select name="sel_tiend" id="sel_tiend">
          <?php

		$cols_arr     = array("inmu_gdat.nombreinmu");
    	$num_cols     = count($cols_arr);
		$tables_arr   = array("inmu_gdat");
	  	$where_clause = "inmu_gdat.idinmutipo <> 5 AND inmu_gdat.idinmutipo <> 6 AND inmu_gdat.idinmustat = 1";
		$order 		  = "inmu_gdat.nombreinmu";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
//    $row=mysql_fetch_row($result);
	
		while($row=mysql_fetch_row($result)) {
			echo "<option>$row[0]</option>";
		}   // cierre de While

?>
        </select>
        </label><br /><br />
        <label class="letramoduser">
        <input type="submit" name="button" id="button" value="Asignar " />
        </label>
                  <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
                  <input name="submodoed" type="hidden" id="submodoed" value="checaencargadoestado" />
                  <input name="add_opt" type="hidden" id="add_opt" value="3" />
      </form>
      <br />


<?php
					}
					break;
				case "4":
					if ($submodoed == "confirmaeliminaestado1") {

?>
      <span class="letramoduser">El/la encargado(a) No. <?php echo "$sel_enc"; ?></span><br />
      <span class="letramoduser">será eliminado(a) de manera definitiva de la base de datos.</span><br />
      <br />
      <span class="letramoduser">¿Deseas continuar?.<br />
      </span>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
		<form id="form10" name="form10" method="post" action="<?php echo "$hostname$target_link"; ?>" target="_self">
          <td width="4%">
            <label class="letramoduser">
              <input type="submit" name="button" id="button" value="Si" />
              <input name="modoedpass" type="hidden" id="modoedpass" value="eliminaencargado" />
              <input name="sel_encpass" type="hidden" id="sel_encpass" value="<?php echo "$sel_enc"; ?>" />
            </label>          </td>
          </form>
		<form id="form11" name="form11" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
          <td width="96%">
            <label>
              <input type="submit" name="button" id="button" value="No" />
              <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
              <input name="add_opt" type="hidden" id="add_opt" value="4" />
              </label></td>
          </form>
        </tr>
      </table>

<?php

					} else {

?>

      <span class="letramoduser">Elimina un encargado(a) asignado a una tienda</span>.<br />
      <span class="letramoduser">Elige el encargado(a) que deseas eliminar:</span>.<br /><br />
     
      <form id="form12" name="form12" method="post" action="">
        <label>
          <label class="letramoduser">
          <select name="sel_enc" id="sel_enc">
            <?php

		$cols_arr      = array("gnrl_enca.idenc", "gnrl_enca.nombre", "inmu_gdat.nombreinmu");
    	$num_cols      = count($cols_arr);
	    $join_tables   = '1';
		$tables_arr    = array("gnrl_enca", "inmu_gdat");
	    $num_tables    = count($tables_arr);
		$on_fields_arr = array("idenc");
//			$connect      = '1';
	  	$where_clause  = "gnrl_enca.idenc <> '0' AND gnrl_enca.asig = '1'";
		$order         = "gnrl_enca.idenc";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
//    $row=mysql_fetch_row($result);
	
		while($row=mysql_fetch_row($result)) {
			echo "<option>$row[0] - $row[1] de $row[2]</option>";
		}   // cierre de While

?>
          </select>
        </label>
          <input type="submit" name="button" id="button" value="Eliminar " />
        </label>
        <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
        <input name="submodoed" type="hidden" id="submodoed" value="confirmaeliminaestado1" />
        <input name="add_opt" type="hidden" id="add_opt" value="4" />
      </form>
      <br />

<?php				
					}
					break;
				case "5":	

					if ($submodoed == "confirmaeliminaestado2") {

?>

      <span class="letramoduser">El/la encargado(a) No. <?php echo "$sel_enc"; ?></span><br />
      <span class="letramoduser">será eliminado(a) de manera definitiva de la base de datos.</span><br />
      <br />
      <span class="letramoduser">¿Deseas continuar?.<br />
      </span>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
		<form id="form10" name="form10" method="post" action="<?php echo "$hostname$target_link"; ?>" target="_self">
          <td width="4%">
            <label class="letramoduser">
              <input type="submit" name="button" id="button" value="Si" />
              <input name="modoedpass" type="hidden" id="modoedpass" value="eliminaencargado" />
              <input name="submodoedpass" type="hidden" id="submodoedpass" value="encsinasignar" />
              <input name="sel_encpass" type="hidden" id="sel_encpass" value="<?php echo "$sel_enc"; ?>" />
            </label>          </td>
          </form>
		<form id="form11" name="form11" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
          <td width="96%">
            <label>
              <input type="submit" name="button" id="button" value="No" />
              <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
              <input name="add_opt" type="hidden" id="add_opt" value="5" />
              </label></td>
          </form>
        </tr>
      </table>

<?php

					} else {

						$cols_arr      = array("gnrl_enca.idenc", "gnrl_enca.nombre");
				    	$num_cols      = count($cols_arr);
						$tables_arr    = array("gnrl_enca");
					  	$where_clause  = "gnrl_enca.idenc <> '0' AND gnrl_enca.asig = '0'";
						$order         = "gnrl_enca.idenc";

						$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

						if (mysql_num_rows($result) < 1) {
?>

      <span class="letramoduser">Por el momento no hay encargados sin asignar en la base de datos</span>.<br /><br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
		<form id="form11" name="form11" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
          <td>
            <label class="letramoduser">
              <input type="submit" name="button" id="button" value="Continuar" />
            </label></td>
          </form>
        </tr>
      </table>

<?php
 
 						} else {
 
?> 

      <span class="letramoduser">Elimina un encargado(a) no asignado a una tienda</span>.<br />
      <span class="letramoduser">Elige el encargado(a) que deseas eliminar:</span>.<br /><br />
     
      <form id="form12" name="form12" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
        <label>
          <label class="letramoduser">
          <select name="sel_enc" id="sel_enc">

<?php

	
		while($row=mysql_fetch_row($result)) {
			echo "<option>$row[0] - $row[1]</option>";
		}   // cierre de While

?>
          </select>
        </label>
          <input type="submit" name="button" id="button" value="Eliminar " />
        </label>
        <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
        <input name="submodoed" type="hidden" id="submodoed" value="confirmaeliminaestado2" />
        <input name="add_opt" type="hidden" id="add_opt" value="5" />
      </form>
      <br />
				
				
<?php				
		
					}
				}								
				break;	
			} // Cierre de switch
		} else {

			if ($row0[1] == "(sin asignar)") {

?>
	<span class="letramoduser">Esta Tienda no tiene un encargado asignado</span><br />
      <span class="letramoduser">para asignarle uno teclea su nombre a continuacion:</span><br />
      <br />
      <?php
		
			} else {
			
?>
      <span class="letramoduser">Esta Tienda ya tiene al encargado(a): <strong><?php echo "$row0[1]"; ?></strong></span><br />
      <span class="letramoduser">Puedes intercambiarlo con alguno de otra tienda</span>:<br />
      <br />
      <form id="form3" name="form3" method="post" action="<?php echo "$hostname$target_link"; ?>" target="_self">
        <label class="letramoduser">
        <select name="inter_enc" id="inter_enc">
          <?php
	$cols_arr      = array("gnrl_enca.nombre", "inmu_gdat.nombreinmu", "inmu_gdat.idinmu");
    $num_cols      = count($cols_arr);
    $join_tables   = '1';
	$tables_arr    = array("gnrl_enca", "inmu_gdat");
    $num_tables    = count($tables_arr);
	$on_fields_arr = array("idenc");
//			$connect      = '1';
  	$where_clause = "gnrl_enca.idenc <> '0' AND gnrl_enca.asig = '1'";

	$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
//    $row=mysql_fetch_row($result);
	
	while($row=mysql_fetch_row($result)) {
		echo "<option>$row[2] - $row[1] &middot; $row[0]</option>";
	}   // cierre de While

?>
        </select>
        </label>
        <label>
        <input type="submit" name="button" id="button" value="Intercambiar" />
        </label>
        <input name="modoedpass" type="hidden" id="modoedpass" value="intercambiaenc" />
	    <input name="idinmupass" type="hidden" id="idinmupass" value="<?php echo "$idinmu"; ?>" />
	    <br />
        <br />
      </form>
      <span class="letramoduser">O Agregar un nuevo encargado para esta Tienda:</span><br />
      <br />
      <?php
			} // Cierre de Else
?>
      <!-- Forma Commun a los dos casos -->
      <form id="form2" name="form2" method="post" action="<?php echo "$hostname$target_link"; ?>" target="_self">
        <label class="letramoduser">
        <input type="text" name="encargado" id="encargado" />
        </label>
        <label>
        <input type="submit" name="button" id="button" value="Agregar" />
        </label>
        <input name="nombretpass" type="hidden" id="nombretpass" value="<?php echo "$row0[0]"; ?>" />
        <input name="idinmupass" type="hidden" id="idinmupass" value="<?php echo "$idinmu"; ?>" />
        <input name="modoedpass" type="hidden" id="modoedpass" value="<?php echo "$modoed"; ?>" />
        <?php 

	if  ($row0[1] <> "(sin asignar)") {

?>
        <input name="encargadopass" type="hidden" id="modoedpass" value="<?php echo "$row0[1]"; ?>" />
        <?php

	}

?>
        <br />
        <?php
        if ($error_id == "0" or $error_id == "1") {
                echo "<span class=\"letra_alertaestado\"><strong>Error: $errorpass</strong></span>";
        }
?>
      </form>
<?php      
	}	
?>    </td>
    <td width="46%" valign="top"><span class="letramoduser">Adicionalmente Puedes:</span><br /><br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
         <form id="form4" name="form4" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
          <td width="89%"><label class="letramoduser">- Editar el nombre de un(a) Encargado(a) existente.</label></td>
          <td width="11%"> <input class="textoboton" type="submit" name="button3" id="button3" value="Ir" />
            <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
            <input name="add_opt" type="hidden" id="add_opt" value="1" /></td>
      </form>
        </tr>
        <tr>
      <form id="form5" name="form5" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
          <td><label class="letramoduser">- Agregar un encargado sin asignarlo a una tienda.</label></td>
          <td><input class="textoboton" type="submit" name="button4" id="button4" value="Ir" />
            <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
            <input name="add_opt" type="hidden" id="add_opt" value="2" /></td>
      </form>
        </tr>
        <tr>
      <form id="form6" name="form6" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
          <td><span class="letramoduser">- Asignar un encargado existente y no asignado, a una tienda.</span></td>
          <td><input class="textoboton" type="submit" name="button6" id="button7" value="Ir" />
            <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
            <input name="add_opt" type="hidden" id="add_opt" value="3" /></td>
      </form>
        </tr>
        <tr>
          <form id="form6" name="form4" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
            <td><label class="letramoduser"> - Eliminar un encargado asignado a una tienda.</label></td>
            <td><input class="textoboton" type="submit" name="button5" id="button5" value="Ir" />
            <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
            <input name="add_opt" type="hidden" id="add_opt" value="4" /></td>
          </form>
        </tr>
        <tr>
          <form id="form7" name="form5" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
            <td><label class="letramoduser">- Eliminar un encargado no asignado a una tienda.</label></td>
            <td><input class="textoboton" type="submit" name="button5" id="button6" value="Ir" />
              <input name="modoed" type="hidden" id="modoed" value="editaencargado" />
              <input name="add_opt" type="hidden" id="add_opt" value="5" /></td> 
          </form>
        </tr>
    </table>    </td>
  </tr>
</table>
<p>
  <?php 			
			break;	
		default:

?>
  <br />
  <span class="letramoduser">Para modificar las propiedades de un usuario elige el bot&oacute;n <strong>Modificar</strong> en la lista</span><br />

  <?php

        // Definicion de los parametros de la consulta
        $cols_arr = array("COUNT(idinmu)");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("inmu_gdat");
        $num_tables = count($tables_arr);
        $where_clause = "inmu_gdat.idinmutipo <> 5 AND inmu_gdat.idinmutipo <> 6";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row=mysql_fetch_row($result)
	       
?>

  <br />
  <span class="letramoduser">No. de Inmuebles/Tiendas Registrados: <strong><?php echo "$row[0]"; ?></strong></span>

  <?php

        // Definicion de los parametros de la consulta
        $cols_arr = array("COUNT(idinmu)");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("inmu_gdat");
        $num_tables = count($tables_arr);
        $where_clause = "inmu_gdat.idinmutipo <> 5 AND inmu_gdat.idinmutipo <> 6 AND inmu_gdat.idinmustat = 1";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row1=mysql_fetch_row($result)
	       
?>	

  <br />
  <span class="letramoduser">No. de Inmuebles/Tiendas Activos: <strong><?php echo "$row1[0]"; ?></strong></span>

  <?php

        // Definicion de los parametros de la consulta
        $cols_arr = array("COUNT(iduser)");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("inmu_gdat");
        $num_tables = count($tables_arr);
        $where_clause = "inmu_gdat.idinmutipo <> 5 AND inmu_gdat.idinmutipo <> 6 AND inmu_gdat.idinmustat = 2";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row2=mysql_fetch_row($result)
	       
?>	

  <br />
  <span class="letramoduser">No. de Inmuebles/Tiendas Inactivas: <strong><?php echo "$row2[0]"; ?></strong></span>

  <?php

        // Definicion de los parametros de la consulta
        $cols_arr = array("COUNT(iduser)");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("inmu_gdat");
        $num_tables = count($tables_arr);
        $where_clause = "inmu_gdat.idinmutipo <> 5 AND inmu_gdat.idinmutipo <> 6 AND inmu_gdat.idinmustat = 3";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row3=mysql_fetch_row($result)
	       
?>	

  <br />
  <span class="letramoduser">No. de Inmuebles/Tiendas Eliminadas: <strong><?php echo "$row3[0]"; ?></strong></span>

  <?php
			break;
	} // Cierre de switch

?>	
</p>
</body>
</html>
