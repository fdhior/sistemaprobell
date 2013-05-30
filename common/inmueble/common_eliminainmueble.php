<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
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

	include $_SESSION['rutafunciones'].'consultas.php';
	$hostname   = $_SESSION['hostname'];
	
	$target_link = "common/inmueble/common_eliminainmueble.php";
	
		
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
<h2>Eliminar una Tienda del sistema</h2>

<?php	

	if (!isset($ejecuta_eliminar)) {
        $cols_arr = array("idinmu");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("inmu_gdat");
//      $num_tables = count($tables_arr);
//		$connect = 1;
//		$on_fields_arr = array("idinmutipo");
        $where_clause = "inmu_gdat.nombreinmu = '$sel_elmtien'";
//		$order = "gnrl_usrs.nombre";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

		$row=mysql_fetch_row($result);
		
		$sel_elmtien = ucwords($sel_elmtien);

?>
<span class="letraaduser">La Tienda <strong><?php echo "$sel_elmtien"; ?></strong>,</span><br />
<span class="letraaduser">Con n&uacute;mero de Tienda: <strong><?php echo "$row[0]";  ?></strong> ser&aacute; eliminada</span><br /><br />
<span class="letraaduser">¿Deseas continuar?</span><br />
<br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $hostname.$target_link; ?>" method="post" name="form1" target="_self" id="form1">
      <td width="32"></label>
        <label>
          <input type="submit" name="button" id="button" value="Si" />
        <input type="hidden" name="ejecuta_eliminar" id="ejecuta_eliminar" />
          <input type="hidden" name="sel_elmtien" id="sel_elmtien" value="<?php echo "$sel_elmtien"; ?>" />
        </label></td>
    </form>    
    <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post" name="form2" target="_self" id="form2">
      <td width="268"><input type="submit" name="button" id="button" value="No" /></td>
    </form>
  </tr>
</table> 
<br />
<p class="letraaduser">Nota: el usuario del sistema de Pedidos y Traslados<br/>
y otro contenido asociado de la tienda no se eliminar&aacute; hasta<br/> 
que se de de baja en la opci&oacute;n <strong>modificar tienda</strong>.</p><br /><br />

<?php 

	} // Cierre de if

	if (isset($ejecuta_eliminar)) {
/* ---------------------------------------- ACTUALIZAR DATOS -------------------------------------- */

	$colsvalarr   = array("inmu_gdat.idinmustat = 3");
	$numcols      = count($colsvalarr);
	$aff_table    = "inmu_gdat";
	$where_clause = "inmu_gdat.nombreinmu = '$sel_elmtien'";

	$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 

/* --------------------------------------- TERMINA ACTUALIZAR DATOS -------------------------------- */

?>

<p class="letraaduser">La tienda <strong><?php echo "$sel_elmtien"; ?></strong> ha sido eliminada<br />
y no será posible acceder a los datos asociados con ella<br />
para modificar este estado o eliminar el contenido asociado<br />
elije la opci&oacute;n <strong>modificar tienda</strong>.</p>

<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="common_eliminarinmuebles.php" method="post" name="form3" target="_self" id="form3">
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
