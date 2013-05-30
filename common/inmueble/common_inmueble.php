<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" type="text/css" href= "../../css/sistemaprobell.css" />



<style type="text/css">
<!--

.tablaagrtienda {
	padding-left: 26px;
	width: 500px;
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
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

	session_start();
	include $_SESSION['rutafunciones'].'consultas.php';
	$loggeduser = $_SESSION['compltusrname'];
	$hostname   = $_SESSION['hostname'];
//	$idusrarea 	= $_SESSION['idusrarea'];
//	$tipousr    = $_SESSION['tipousr'];
//	$iduser     = $_SESSION['iduser'];
	
	$target_link = "common/inmueble/common_agregainmueble.php";

	/*echo "<span class=\"tipoletra\">Valores de _GET</span><br />";
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
	}   

 	echo "<span class=\"tipoletra\">Valores de _SESSION</span><br />";
	foreach ($_SESSION as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
		}
	}*/    


?>

<br />
<br />
<h2><?php echo "Usuario: ".$loggeduser; ?>, Crear una Tienda<?php if ($_SESSION['modo'] == "inmueble") {  echo ", Almacen u Oficina"; } ?> para Supervisar y Administrar:</h2>

<?php
    if (isset($_SESSION['invalid_check'])) {
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
//  unset($_SESSION['invalid_check']);

    if (isset($_GET['agr_tienda'])) {
	    $agr_tienda = $_GET['agr_tienda'];
    }


//      echo "invalid check = $invalid_check<br />";

/*  echo "<span class=\"tipoletra\">Valores de _GET</span><br />";
    foreach ($_GET as $nombre => $valor) {
 	   if(stristr($nombre, 'button') === FALSE) {
    	   print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />";
       }
   }  */


    if (!isset($_POST['tienda_check']) && !isset($invalid_check) && !isset($_GET['agr_tienda'])) {

?>
<table class="tablaagrtienda" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
      <td><span class="letraadtienda_nopadd">Teclea el nombre que tendr&aacute; la nueva tienda:</span>
        <input type="text" name="nueva_tienda" id="textfield" />
        <label> <br />
        <span class="letraadtienda_nopadd">Elige el tipo de tienda</span>
      <select name="sel_ttienda" id="sel_ttienda">
            <option selected="selected">Elige un tipo</option>
            <option>Probell</option>
            <option>Nail Mart</option>
            <option>Pronail</option>	
          </select>
          <br />
        <br />
        <input type="submit" name="button2" id="button2" value="Agregar" />
          <input name="tienda_check" type="hidden" id="tienda_check" value="1" />
      </label></td>
    </form>
  </tr>
</table>

<?php
	} // Cierre de if Inicial

        if ($_POST['tienda_check'] == "1") {
			
//			echo "entro a tienda check";	
			if ($_POST) {
				$nueva_tienda = $_POST['nueva_tienda'];
				$sel_ttienda  = $_POST['sel_ttienda'];
			}	

            // Comprobar nombre de usuario contra la base de usuarios
            $cols_arr = array("nombreinmu");
            $num_cols = count($cols_arr);
//          $join_tables = '0';
            $tables_arr = array("inmu_gdat");
            $num_tables = count($tables_arr);
//          $where_clause = "idarea = 5";
//          $order = "gnrl_usrs.nombre";

       		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

          	if ($nueva_tienda == "") {
               	echo "<span class=\"letra_alertaestado\"><strong>Teclea un nombre para la tienda</strong></span><br />";
                $error_id = 0;
            } else {
				if ($sel_ttienda == "Elige un tipo") {
			       	echo "<span class=\"letra_alertaestado\"><strong>Elige un tipo de tienda a agregar</strong></span>";
    	            $error_id = 0;
				} else {	
				    while($row=mysql_fetch_row($result)) {
						$row_to_low = strtolower($row[0]);
						$tprefijo = strtolower($sel_ttienda);
						$tienda_entra = strtolower($nueva_tienda);
						$tienda_entrante = $tprefijo." ".$tienda_entra;
						// if anterior ereg($tienda_entrante, $row_to_low)
   	    		    	if ($tienda_entrante == $row_to_low) {
       	    		    	echo "<span class=\"letra_alertaestado\">La Tienda <strong>$row[0]</strong> ya existe en la base de datos</span><br />";
       		    		    $error_id = 0;
               			}
   	    			}    // cierre de While
				}
			}
			
			if (!isset($error_id)) {
				$agr_tienda = "1";			
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
			if ($agr_tienda == "1" or isset($invalid_check)) {

				foreach ($_POST as $nombre => $valor) {
	     			if(stristr($nombre, 'button') === FALSE) {
    	    			${$nombre} = $valor;
			         }
				 }// Cierre foreach     


/*
	Nombre de la Variable: idt Valor: 
	Nombre de la Variable: sel_inmu Valor: tienda
	Nombre de la Variable: encargado Valor: 
	Nombre de la Variable: sel_rsc Valor: Selecciona una Razon Social
	Nombre de la Variable: nueva_tienda Valor: Probell Michoacan  */

                if (isset($_SESSION['error_id'])) {
            	    $errorpass    = $_SESSION['errorpass'];
                    $error_id     = $_SESSION['error_id'];
                    $idt          = $_SESSION['idt'];
                    $sel_inmu     = $_SESSION['sel_inmu'];
                    $encargado    = $_SESSION['encargado'];
                    $sel_rsc      = $_SESSION['sel_rsc'];
                    $nueva_tienda = $_SESSION['nueva_tienda'];
					$check_no_enc =	$_SESSION['check_no_enc'];

					if (isset($_SESSION['sel_ttienda'])) {
	    				$sel_ttienda = $_SESSION['sel_ttienda'];
					}	
				}
         	    unset($_SESSION['errorpass']);
                unset($_SESSION['error_id']);
                unset($_SESSION['idt']);
                unset($_SESSION['sel_inmu']);
                unset($_SESSION['encargado']);
                unset($_SESSION['sel_rsc']);
                unset($_SESSION['nueva_tienda']);

?>
<span class="letraadtienda">Agregar <?php $muestrat = ucwords($nueva_tienda); if ($_SESSION['modo'] == "inmueble") { echo "el inmueble <strong>$sel_ttienda $muestrat</strong>"; } else { echo "la tienda <strong>$sel_ttienda $muestrat</strong>"; } ?> al sistema</span><br />
<table class="tablaagrtienda" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo "$hostname$target_link"; ?>" method="post" name="form1" target="_self" id="form1">
      <td><label class="letraadtienda_nopadd"><br />
       Ingresa el Numero que se le asignar&aacute; a <?php if ($_SESSION['modo'] == "inmueble") {  echo "este inmueble."; } else { echo "esta tienda"; } ?><br />
        <input name="idt" type="text" id="idt" size="3" maxlength="3" value="<?php echo "$idt";	?>" />
        <?php
        if ($error_id == "1" or $error_id == "2" or $error_id == "3") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
		
		if ($_SESSION['modo'] == "inmueble") { 
?>
        <br />
        <br />
        Selecciona el Tipo de Inmueble:<br />
       </label>
        <label>
        <input type="radio" name="sel_inmu" id="sel_inmu" value="tienda" 
		<?php
		if ($sel_inmu == "tienda" or !isset($invalid_check)) {
			echo "checked=\"checked\" ";
		} 
        ?> />
        </label>
        <span class="letraadtienda_nopadd">Tienda</span>
        <label>
        <input type="radio" name="sel_inmu" id="sel_inmu" value="oficina" 
  		<?php
		if ($sel_inmu == "oficina") {
			echo "checked=\"checked\" ";
		} 
        ?> />
        </label>
        <span class="letraadtienda_nopadd">Oficina</span>
         <label>
         <input type="radio" name="sel_inmu" id="sel_inmu" value="almacen" 
         <?php
		if ($sel_inmu == "almacen") {
			echo "checked=\"checked\" ";
		} 
        ?> />
         </label>
        <span class="letraadtienda_nopadd">Almacen</span>
        <label class="letraadtienda_nopadd">
		<?php 
		} else { ?>
		<input type="hidden" name="sel_inmu" id="sel_inmu" value="tienda" />
		<?php 
		}
		?>
        <br />
        <br />
Teclea el nombre de &eacute;l/la encargado(a)<br />
         <input type="text" name="encargado" id="correoe" value="<?php echo "$encargado"; ?>" />
        </label>
        <label>
        <input name="check_no_enc" type="checkbox" id="check_no_enc" value="1" <?php if ($check_no_enc == "1") { echo "checked=\"checked\""; } ?> />
        </label>
        <span class="letraadtienda_nopadd">No Asociar Encargado(a) a esta tienda</span> 
        <label class="letraadtienda_nopadd">
        <?php
        if ($error_id == "4" or $error_id == "5") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
?>
        <br />
         <br />
         Selecciona la raz&oacute;n social que le corresponder&aacute; a 
         <?php if ($_SESSION['modo'] == "inmueble") {  echo "este inmueble."; } else { echo "esta tienda"; } ?><br />
        </label>
        <label>
        <select name="sel_rsc" id="sel_rsc">
		<option>Selecciona una Razon Social</option> 
<?php

		if (isset($error_id)) {
			echo "<option selected>$sel_rsc</option>";		
		}


        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr = array("razonsc");
        $num_cols = count($cols_arr);
//      $join_tables = '0';
        $tables_arr = array("inmu_dfis");
        $num_tables = count($tables_arr);
//      $where_clause = "idarea = 5";
//      $order = "gnrl_usrs.nombre";

  		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

         while($row=mysql_fetch_row($result)) {
	       	if ($row[0] <> $sel_rsc) {	
				echo "<option>$row[0]</option>";
			}	
        }   // cierre de While
		

?>

        </select>
        </label>
        <label class="letraadtienda_nopadd"><br />
<?php

        if ($error_id == "6") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";

        }
?>
<br />
         <input type="submit" name="button" id="button" value="Enviar Datos" />
         <input type="hidden" name="nueva_tienda" id="nueva_tienda" value="<?php echo $nueva_tienda; ?>" />
         <input name="verifica" type="hidden" id="verifica" value="1" />
         <input name="sel_ttienda" type="hidden" id="sel_ttienda" value="<?php echo $sel_ttienda; ?>" />

      </label></td>
    </form>
  </tr>
</table>

<?php
		}
	} // Cierre de else
	
	if ($agr_tienda == "2" or isset($invalid_check2)) {

	    // Convertir vaariables POST en locales
//		if (isset($_GET)) {
	    foreach ($_GET as $nombre => $valor) {
		    if(stristr($nombre, 'button') === FALSE) {
    		     ${$nombre} = $valor;
    	 	}
		} // Cierre foreach     

//		} else {
		if (isset($_SESSION['error_id'])) {
    	    $errorpass    = $_SESSION['errorpass'];
            $error_id     = $_SESSION['error_id'];
/*          $idt          = $_SESSION['idt'];
            $sel_inmu     = $_SESSION['sel_inmu'];
            $encargado    = $_SESSION['encargado'];
            $sel_rsc      = $_SESSION['sel_rsc'];
            $nueva_tienda = $_SESSION['nueva_tienda'];
			if (isset($_SESSION['sel_ttienda'])) {
	   			$sel_ttienda = $_SESSION['sel_ttienda'];
			} */
    		$direccion = $_SESSION['direccion'];
    		$notel1    = $_SESSION['notel1'];
    		$notel2    = $_SESSION['notel2'];
    		$nocel     = $_SESSION['nocel'];
			$sel_zona  = $_SESSION['sel_zona'];				
    	}
       	unset($_SESSION['errorpass']);
        unset($_SESSION['error_id']);
        unset($_SESSION['idt']);
        unset($_SESSION['sel_inmu']);
        unset($_SESSION['encargado']);
        unset($_SESSION['sel_rsc']);
 	    unset($_SESSION['nueva_tienda']);
		unset($_SESSION['sel_ttienda']);
		unset($_SESSION['direccion']);
    	unset($_SESSION['notel1']);
    	unset($_SESSION['notel2']);
    	unset($_SESSION['nocel']);
	  	unset($_SESSION['sel_zona']);				
//		}			 

/*	echo "agrtienda: $agr_tienda<br />";	
	echo "errorpass: $errorpass<br />";
 	echo "<span class=\"tipoletra\">Valores de _GET</span><br />";
	foreach ($_GET as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
		}
	}   */

	
?>

<span class="letraadtienda">Datos especificos <?php if ($_SESSION['modo'] == "inmueble") {  echo "del inmueble."; } else { echo "de la tienda"; } ?> <strong><?php $muestrat = ucwords($nueva_tienda); echo "$sel_ttienda $muestrat"; ?></strong></span><br />

<table class="tablaagrtienda" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo "$hostname$target_link"; ?>" method="post" name="form1" target="_self" id="form1">
      <td>
<?php

//		if ($sel_inmu == "tienda") {

?>
<!--   <label class="letraadtienda_nopadd"><br />
       Especifica el tipo de Tienda.<br />
      </label>
        <label>
        <select name="sel_ttienda" id="sel_ttienda">
          <option>Tienda Probell</option>
          <option>Tienda Nail Mart</option>
        </select>
        </label>
        <label class="letraadtienda_nopadd">
        <br /> -->
        <?php

//		}

?>
        <br />
        <span class="letraadtienda_nopadd">Ingresa la dirreccion donde se ubica <?php if ($_SESSION['modo'] == "inmueble ") {  echo "el Inmueble."; } else { echo "la tienda "; } ?><strong><?php echo "$sel_ttienda $muestrat"; ?></strong></span><br />
        </label>
        <label>
        <textarea name="direccion" id="direccion" cols="45" rows="5"><?php echo "$direccion"; ?></textarea>
        </label>
<label class="letraadtienda_nopadd">
<?php
       if ($error_id == "0") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
?>
<br />
        <br />
No. Telefonico (1):
       <input type="text" name="notel1" id="correoe" value="<?php echo "$notel1"; ?>" />
       <?php
        if ($error_id == "1") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
?>
       <br />
         No. Telefonico (2):
         <input type="text" name="notel2" id="correoe2" value="<?php echo "$notel2"; ?>" />
        <?php
        if ($error_id == "2") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
?>
         <br />
No. de Celular:
<input type="text" name="nocel" id="correoe3" value="<?php echo "$nocel"; ?>" />
<?php
        if ($error_id == "3") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
?>
<br />
         <br />
   Zona en la que se encuentra <?php if ($_SESSION['modo'] == "inmueble") {  echo "el Inmueble."; } else { echo "la tienda"; } ?><strong> <?php echo "$sel_ttienda $muestrat"; ?></strong><br />
        </label>
        <label>
        <select name="sel_zona" id="sel_zona">
		<option selected="selected">Selecciona una zona</option> 
        
<?php

		if (isset($error_id)) {
			echo "<option selected>$sel_zona</option>";		
		}

        // Comprobar nombre de usuario contra la base de usuarios
        $cols_arr = array("zona");
        $num_cols = count($cols_arr);
//      $join_tables = '0';
        $tables_arr = array("inmu_zona");
        $num_tables = count($tables_arr);
//      $where_clause = "idarea = 5";
//      $order = "gnrl_usrs.nombre";

  		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

         while($row=mysql_fetch_row($result)) {
	       	if ($row[0] <> $sel_zona) {	
		       	echo "<option>$row[0]</option>";
			}	
        }   // cierre de While

?>
        </select>
        <br />
        </label>
        <label class="letraadtienda_nopadd">
        <?php
        if ($error_id == "4") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
?>
        <br />
         <br />
         <input type="submit" name="button" id="button" value="<?php if ($_SESSION['modo'] == "inmueble") {  echo "Agregar Inmueble."; } else { echo "Agregar Tienda"; } ?>" />
<!--     <input type="hidden" name="verifica" id="nuevo_nombre_pass" value="2" /> -->
         <input type="hidden" name="idt" id="idt" value="<?php echo "$idt"; ?>" />
         <input type="hidden" name="sel_inmu" id="sel_inmu" value="<?php echo "$sel_inmu"; ?>" />
         <input type="hidden" name="encargado" id="encargado" value="<?php echo "$encargado"; ?>" />
         <input type="hidden" name="sel_rsc" id="sel_rsc" value="<?php echo "$sel_rsc"; ?>" />
         <input type="hidden" name="nueva_tienda" id="nueva_tienda" value="<?php echo "$nueva_tienda"; ?>" />

         
         
         
<!-- Nombre de la Variable: agr_tienda Valor: 2
	 Nombre de la Variable: idt Valor: 90
	 Nombre de la Variable: sel_inmu Valor: tienda
	 Nombre de la Variable: encargado Valor: Pancho Rabales
	 Nombre de la Variable: sel_rsc Valor: PROBEL BEAUTY SUPPLY S.A. DE C.V.
	 Nombre de la Variable: nueva_tienda Valor: Villa Hermosa -->



        <input type="hidden" name="sel_ttienda" id="sel_ttienda" value="<?php echo "$sel_ttienda"; ?>" />
        <input type="hidden" name="verifica" id="verifica" value="2" />
        <input type="hidden" name="check_no_enc" id="check_no_enc" value="<?php echo "$check_no_enc"; ?>" />
      </label></td>
    </form>
  </tr>
</table>


<?php

	}

?>

</body>
</html>
