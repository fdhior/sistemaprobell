<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.letraaduser {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 11px;
        font-weight: normal;
        color: #000000;
        padding-left: 26px;
		left: 26px;
		margin-left: 26;
}

.tablaagruser {
        padding-left: 26px;
        width: 300px;
}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php
    session_start();

	$rutafunciones = $_SESSION['rutafunciones'];

	include $rutafunciones.'consultas.php';
	$hostname    = $_SESSION['hostname'];
	$rel_path    = 'supervision/usuarios/supervision_';
	$target_link = $hostname.$rel_path.'eliminarusuarios.php';
	
	
		
/* 	echo "<span class=\"tipoletra\">Valores de _POST</span><br />";
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'button') === FALSE) {
			print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
		}
	}   */

     // Convertir vaariables POST en locales
     foreach ($_POST as $nombre => $valor) {
	     if(stristr($nombre, 'button') === FALSE) {
    	     ${$nombre} = $valor;
         }
	 }// Cierre foreach     

?>

<body>
<br />
<h2>Eliminar  Usuarios del sistema de Traslados y Pedidos</h2>

<?php	

	if (!isset($ejecuta_eliminar)) {
        $cols_arr     = array("gnrl_usrs.username", 
		                      "inmu_gdat.nombreinmu");
        $num_cols     = count($cols_arr);
        $join_tables  = '1';
        $tables_arr   = array("gnrl_usrs", 
		                      "inmu_gdat");
        $num_tables   = count($tables_arr);
		$on_fields_arr = array("idinmu");
        $where_clause = "gnrl_usrs.iduser = '$sel_elmusr'";
//		$order = "gnrl_usrs.nombre";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

		$row=mysql_fetch_row($result);

?>
<p class="letra_predeterminadamargen">El usuario de acceso para la tienda <strong><?php echo $row[1];  ?></strong>,<br />
Con nombre de usuario: <strong><?php echo $row[0]; ?></strong><br />
ser&aacute; eliminado<br /><br />
¿Deseas continuar?</p>
<br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
      <td width="32"></label>
        <label>
        <input type="submit" name="button" id="button" value="Si" />
        <input type="hidden" name="ejecuta_eliminar" id="ejecuta_eliminar" />
        <input type="hidden" name="nuser" id="nuser" value="<?php echo $row[0]; ?>" />
        <input type="hidden" name="ntpass" id="ntpass" value="<?php echo $row[1]; ?>" />
        </label></td>
    </form>    
    <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post" name="form2" target="_self" id="form2">
      <td width="268"><input type="submit" name="button" id="button" value="No" /></td>
    </form>
  </tr>
</table> 
<br />
<p class="letra_predeterminadamargen"><strong>Advertiencia: Los Traslados y Pedidos asociados a la tienda</strong><br/>
<strong>no se podr&aacute;n consultar hasta que se le asigne un nuevo usuario</strong></p><br /><br />

<?php 

	} // Cierre de if

	if (isset($ejecuta_eliminar)) {
/* ---------------------------------------- ACTUALIZAR DATOS -------------------------------------- */

	$aff_table    = "gnrl_usrs";
	$where_clause = "gnrl_usrs.iduser = '$sel_elmusr'";

	$result = gnrl_delete_query($aff_table, $where_clause);

	$action = 'AUTO_INCREMENT = 0';

	$result = gnrl_altertable_query($aff_table, $action, $modifiers);

	$aff_table = "inmu_gdat";
    $colsvalarr = array("iduser = '76'");
    $numcols = count($colsvalarr);
    $where_clause = "iduser = '$sel_elmusr'";

    $result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 



/* --------------------------------------- TERMINA ACTUALIZAR DATOS -------------------------------- */

?>

<p class="letra_predeterminadamargen">El usuario <strong><?php echo $nuser; ?></strong> para la tienda <br /><strong><?php echo $ntpass; ?></strong> fu&eacute; eliminado</p><br />
<br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $target_link; ?>" method="post" name="form3" target="_self" id="form3">
      <td></label>
        <label>
          <input type="submit" name="button" id="button" value="Continuar" />
    </label></td></form>
  </tr>
</table>
<?php

	} // Cierre de if 

?>

</body>
</html>
