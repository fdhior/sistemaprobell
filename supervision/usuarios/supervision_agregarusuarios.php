<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.tablaagruser {
        padding-left: 26px;
        width: 300px;
}

.letraaduser {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: normal;
        color: #000000;
        padding-left: 26px;
}

.letra_alertaestado {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 11px;
        color: #CC0000;
        font-weight: bold;
		padding-left: 26px;
}

.letra_alertaestado_nopadd {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        color: #CC0000;
        font-weight: bold;
}

#apDiv1 {
        position:absolute;
        left:27px;
        top:67px;
        width:257px;
        height:35px;
        z-index:1;
}
#apDiv2 {
        position:absolute;
        left:166px;
        top:219px;
        width:86px;
        height:54px;
        z-index:2;
}
-->
</style>
<?php
        session_start();
		$rutafunciones = $_SESSION['rutafunciones'];
        include $rutafunciones.'consultas.php';


        if (isset($_SESSION['invalid_check'])) {
                $invalid_check = $_SESSION['invalid_check'];
        }
        unset($_SESSION['invalid_check']);
		
		$hostname  = $_SESSION['hostname'];
		$idtipousr = $_SESSION['idtipousr'];
 		
		$rel_path    = 'supervision/usuarios/supervision_';
		$target_link = $hostname.$rel_path.'agregausuario.php';
//      echo "invalid check = $invalid_check<br />";

      /*echo '<span class="tipoletra">Valores de $_POST</span><br />';
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print '<span class=="tipoletra">Nombre de la Variable: <strong>'.$nombre.'</strong> Valor: <strong>'.$valor.'</strong></span><br />';
                }
        }*/ 
?>

</head>

<body>
<br />
<h2>Agregar Usuarios al Sistema <?php if ($idtipousr == '3' or $idtipousr == '2') { echo 'de Traslados y Pedidos'; } ?></h2>

<?php

        if (!isset($_POST['user_check']) and !isset($invalid_check)) {
?>

  <span class="letra_predeterminadamargen">Escribe un nombre para el nuevo usuario</span><br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
      <td><input type="text" name="nuevo_nombre" id="textfield" />
          </label>
          <label>
          <input type="submit" name="button" id="button" value="Agregar" />
          <input name="user_check" type="hidden" id="user_check" value="1" />
          </label></td>
    </form>
  </tr>
</table>

  <?php
        } // Cierre de if Inicial

        if ($_POST['user_check'] == "1") {

			$nuevo_nombre = $_POST['nuevo_nombre'];

            // Comprobar nombre de usuario contra la base de usuarios
            $cols_arr = array("username");
            $num_cols = count($cols_arr);
//          $join_tables = '0';
            $tables_arr = array("gnrl_usrs");
            $num_tables = count($tables_arr);
//          $where_clause = "idarea = 5";
//          $order = "gnrl_usrs.nombre";

       		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

          	if ($nuevo_nombre == "") {
               	echo '<span class="letra_alertaestado"><strong>Teclea un nombre para el usuario</strong></span>';
                $error_id = 0;
            } else {
	            while($row=mysql_fetch_row($result)) {
    	        	if ($row[0] == $nuevo_nombre) {
        	        	echo '<span class="letraaduser">El usuario <strong>'.$nuevo_nombre.'</strong> ya existe en la base de datos</span>';
           		        $error_id = 0;
	               	}
    	        }   // cierre de While
			} 
			
			if (!isset($error_id)) {
				$agr_usuario = "1";			
			} 

        }

        if ($error_id == "0") {

?>
<br /> <br />
<table class="tablaagruser" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
      <td></label>
          <label>
          <input type="submit" name="button" id="button" value="Reintentar" />
          </label></td>
    </form>
  </tr>
</table>

<?php

        } else {

			// Definicion de los parametros de la consulta
	        $cols_arr = array("idinmu",);
    	    $num_cols = count($cols_arr);
       		$join_tables = '0';
        	$tables_arr = array("inmu_gdat");
        	$num_tables = count($tables_arr);
        	$where_clause = "iduser = '76'";
//			$order = "inmu_gdat.nombreinmu";

			$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
	
			if (mysql_num_rows($result) > 0) {
			
				if ($agr_usuario == "1" or isset($invalid_check)) {
	
    	            if (isset($_SESSION['error_id'])) {
        	                $errorpass              = $_SESSION['errorpass'];
            	            $error_id               = $_SESSION['error_id'];
               				$idt                    = $_SESSION['idt'];
                        	$nombre_usuario         = $_SESSION['nombre_usuario'];
                       		$correoe                = $_SESSION['correoe'];
                        	$nuevo_nombre           = $_SESSION['nuevo_nombre'];
	        	    }
    	            unset($_SESSION['errorpass']);
        	        unset($_SESSION['error_id']);
           	    	unset($_SESSION['idt']);
                	unset($_SESSION['nombre_usuario']);
                	unset($_SESSION['correoe']);
                	unset($_SESSION['nuevo_nombre']);

?>
<span class="letra_predeterminadamargen" >Agregar al Usuario <strong><?php echo $nuevo_nombre; ?></strong> al sistema</span><br />
<table width="472" border="0" cellpadding="0" cellspacing="0" class="tablaagruser">
  <tr>
    <form action="<?php echo $target_link; ?>" method="post" name="form1" target="_self" id="form1">
      <td><br />
        </label>
          <span class="letra_predeterminada">Ingresa nueva  contraseña para este usuario:<br />
          <input type="password" name="pass1" id="pass1" value="<?php
																	if (isset($_SESSION['pass1'])) {
																		$pass1 = $_SESSION['pass1'];
																		echo "$pass1";
																	}
																?>" />

<?php
        if ($error_id == "1") {
                echo '<br /><span class="letra_alertaestado_nopadd"><strong>Error: '.$errorpass.'</strong></span>';
        }
?>
          <br />
        Confirma la Contraseña:<br />
        <input type="password" name="pass2" id="pass2" value="<?php
																	if (isset($_SESSION['pass2'])) {
																		$pass2 = $_SESSION['pass2'];
																		echo "$pass2";
																	}
																	unset($_SESSION['pass1']);
																	unset($_SESSION['pass2'])
																?>" />
<?php
        if ($error_id == "2" or $error_id == "3") {
                echo '<br /><span class="letra_alertaestado_nopadd"><strong>Error: '.$errorpass.'</strong></span>';
        }
?>
<!--    <br />
        <br />
        Ingresa el ID de que se utilizará para este Usuario<br />
        <input name="idt" type="text" id="idt" size="3" maxlength="3" value="<?php // echo "$idt";	?>" />
         (Debe coincidir con el número de tienda) -->
<?php
        if ($error_id == "4" or $error_id == "5" or $error_id == "6") {
                echo '<br /><span class="letra_alertaestado_nopadd"><strong>Error: '.$errorpass.'</strong></span>';
        }


		if ($idtipousr == 1) {
?>



        <br />
        <br />
         Elige e nombre de la tienda a la que estará asociado este usuario (sólo se puede asociar un usuario a una tienda existente y sin usuario asignado).<br />
	     <select name="sel_tienda" id="select">
  <?php
        // Definicion de los parametros de la consulta
        $cols_arr = array("idinmu",
		                  "nombreinmu");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("inmu_gdat");
        $num_tables = count($tables_arr);
        $where_clause = "idinmutipo <> '5' AND idinmutipo <> '6' AND iduser = '76' AND idinmu <> '33'";
		$order = "inmu_gdat.nombreinmu";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        while($row=mysql_fetch_row($result)) {
                        echo '<option>'.$row[1].'</option>';
                }   // cierre de While
?>
</select>
         <br />(Nombre de la Tienda)
<?php
        if ($error_id == "7") {
                echo '<br /><span class="letra_alertaestado_nopadd"><strong>Error: '.$errorpass.'</strong></span>';
        }
?>
         <br />
         <br />
         Correo Electronico<br />
         <input type="text" name="correoe" id="correoe" value="<?php echo "$correoe"; ?>" />
<?php
        if ($error_id == "8") {
                echo '<br /><span class="letra_alertaestado_nopadd"><strong>Error: '.$errorpass.'</strong></span>';
        }

	}

?>
         <br />
         <br />
         <input type="submit" name="button" id="button" value="Agregar Usuario" />
         <input type="hidden" name="nuevo_nombre" id="nuevo_nombre_pass" value="<?php echo $nuevo_nombre; ?>" />
      </span></td>
    </form>
  </tr>
</table>

<?php
		
			}
		} elseif ($agr_usuario == "1") {
		
?>
<p class="letra_predeterminadamargen">No existen Tiendas disponibles para agregarles usuarios<br />se debe crear una nueva tienda en el area de tiendas<br />o pedir al administrador que lo cree en caso de que<br />tu usuario no tenga acceso a ese modulo.</p>
		<table border="0" cellpadding="0" cellspacing="0" class="tablaagruser">
          <tr>
            <form action="supervision_agregarusuarios.php" method="post" name="form1" target="_self" id="form2">
              <td></label>
                  <label>
                  <input type="submit" name="button2" id="button2" value="Reintentar" />
                </label></td>
            </form>
          </tr>
        </table>
		<p class="letraaduser">&nbsp;</p>
		<?php

		} //Cierre else
	} // Cierre else primer if

?>
		
</body>

</html>
