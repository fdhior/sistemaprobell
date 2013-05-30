<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<title>Untitled Document</title>



<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />


<style type="text/css">
<!--

.letramoduser {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    font-weight: normal;
    color: #000000;
	padding-left: 26px;
}


-->
</style>
</head>
<?php
	session_start();
	
	$rutafunciones = $_SESSION['rutafunciones'];

	include $rutafunciones.'consultas.php';
	
    // Mostrar los valores de _POST
/*  echo "Valores de _SESSION <br />";
	foreach ($_SESSION as $nombre => $valor) {
    	if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
        }
	}  */

/*  echo "Valores de _POST <br />";
	foreach ($_POST as $nombre => $valor) {
    	if(stristr($nombre, 'button') === FALSE) {
			print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
        }
	} */


    if (isset($_SESSION['invalid_check'])) {
  		$invalid_check = $_SESSION['invalid_check'];
    }
    unset($_SESSION['invalid_check']);

//	echo "$invalid_check";

	if (isset($_POST['iduser']) or isset($invalid_check)) {	       
	
		foreach ($_POST as $nombre => $valor) {
        	if(stristr($nombre, 'button') === FALSE) {
            	${$nombre} = $valor;
			}
		} // Cierre foreach     


	    if (isset($_SESSION['error_id'])) {
			$errorpass 	       = $_SESSION['errorpass'];
			$error_id  	       = $_SESSION['error_id'];
	        $iduser 		   = $_SESSION['iduser'];
			$act_nombreusuario = $_SESSION['act_nombreusuario'];
			$act_password 	   = $_SESSION['act_password'];
			$act_idt           = $_SESSION['act_idt'];
			$act_nomtienda     = $_SESSION['act_nomtienda'];
			$act_correoe 	   = $_SESSION['act_correoe'];
   	    }
		unset($_SESSION['errorpass']);
		unset($_SESSION['error_id']);
	    unset($_SESSION['iduser']);
		unset($_SESSION['act_nombreusuario']);
		unset($_SESSION['act_password']);
		unset($_SESSION['act_idt']);
		unset($_SESSION['act_nomtienda']);
		unset($_SESSION['act_correoe']);
	
	
        // Definicion de los parametros de la consulta
        $cols_arr = array("iduser",
		                  "idinmu", 
						  "username", 
						  "correoe");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("gnrl_usrs");
        $num_tables = count($tables_arr);
        $where_clause = "gnrl_usrs.iduser = '$iduser'";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row4=mysql_fetch_row($result)

?>	

<body>
<br />
<h2> Modificar Datos de Usuario <?php $errorpass; ?><br />
</h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><span class="letra_predeterminadamargen">No. de Usuario: <strong><?php echo "$iduser"; ?></strong></span><br /><br />

      <form id="form1" name="form1" method="post" action="supervision_actualizausuario.php" target="_self">
        <label class="letra_predeterminadamargen" >Cambiar nombre de usuario <strong>(<?php echo $row4[2]; ?>)</strong>:
          <input name="act_nombreusuario" type="text" id="act_nombreusuario" value="<?php echo "$act_nombreusuario"; ?>" />
        </label>          
<?php
        if ($error_id == "0") {
                echo "<span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
?>
        <br />
        <label class="letra_predeterminadamargen"> Cambiar contraseña: </label>
        <input type="password" name="act_password" id="act_password" value="<?php echo "$act_password" ?>" />
        <br />

<!--        <label class="letramoduser"> Cambiar ID de Tienda <strong>(<?php // echo "$row4[1]"; ?>)</strong>: </label>
        <input name="act_idt" type="text" id="act_idt" size="5" maxlength="5" value="<?php // echo "$act_idt"; ?>" />
<?php
/*      if ($error_id == "1" or $error_id == "2") {
                echo "<span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }  */
?>
		</label>
        <br />  -->
<!--    <label class="letramoduser"> Cambiar Nombre de Tienda <strong>(<?php echo "$row4[2]"; ?>)</strong>:
          <input name="act_nomtienda" type="text" id="act_nomtienda" value="<?php echo "$act_nomtienda"; ?>" />
        </label>
<?php
/*      if ($error_id == "3") {
                echo "<span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        } */
?>
        <br /> -->
        <label class="letra_predeterminadamargen"> Actualizar Diección de correo electronico <strong>(<?php
																							if ($row4[3] == "") {	
																								echo "No Registrado"; 
																							} else {	
																								echo "$row4[3]"; 
																							}	
																			    		?>)</strong>:
          <input type="text" name="act_correoe" id="act_correoe" value="<?php echo "$act_correoe"; ?>" />
<?php
        if ($error_id == "4") {
                echo "<span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
?>
          <br />
        </label>
        <label class="letramoduser">
        <input class="letra_boton12" type="submit" name="button" id="button" value="Actualizar Datos" />
        </label>
        <input name="iduser" type="hidden" id="iduser" value="<?php echo "$iduser" ?>" />
        <input name="actualiza" type="hidden" id="actualiza" value="modusuario" />
        <br />
      </form></td>
  </tr>
</table>

<?php

	} else {

?>

<br />
</body>
</html>
