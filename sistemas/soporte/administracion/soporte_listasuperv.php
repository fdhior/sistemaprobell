
<style type="text/css">
<!--
.tipoletra {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;		
}

-->
</style>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
    
<?php 
include "consultas.php";
// session_start();
// $tipousr = $_SESSION['tipousr'];

//echo "$tipouser";

foreach ($_POST as $nombre => $valor) {
	if(stristr($nombre, 'button') === FALSE) {
		${$nombre} = $valor;
	}
} // Cierre foreach	


	$colsarr = array("idvisita");
	$numcols = count($colsarr);
	$aff_table = "sprv_visitas";
	$where_clause = "nombre='$nsprvpass'";

	// Llama a la función de las consultas
	$result0 = simp_query($numcols, $colsarr, $aff_table, $where_clause, $order, $dir, $limit);

    $i = '0';
	while($row=mysql_fetch_row($result0)){
	$++	
	}
	
	$Cuentas
	
//                       0          1          2            3        4    
	$colsarr = array("iduser", "username", "tipousr", "nombre", "correoe");
	$numcols = count($colsarr);
	$aff_table = "gnrl_usrs";
	$where_clause = "nombre='$nsprvpass'";

	// Llama a la función de las consultas
	$result = simp_query($numcols, $colsarr, $aff_table, $where_clause, $order, $dir, $limit);


	while($row=mysql_fetch_row($result)){
  	$upname = strtoupper($row[1]);
?>  
	<tr bgcolor="#FFFFFF">
        <th width="3%" scope="col"><span class="tipoletra"><?php echo "$row[0]"; ?></span></th>
        <th width="18%" scope="col"><span class="tipoletra"><?php echo "$upname"; ?></span></th>
      <th width="9%" scope="col"><span class="tipoletra">
		<?php
		switch ($row[2]) {
			case "STS" or "STN":
				echo "Supervisor Sistemas";
				break;
			case "SPN":
				echo "Supervisor Tiendas";
				break;
		}		
		?></span></th>
        <th width="15%" scope="col"><span class="tipoletra"><?php echo "$row[3]"; ?></span></th>
        <th width="15%" scope="col"><span class="tipoletra"><?php echo "$row[4]"; ?></span></th>
        <th width="15%" scope="col"><span class="tipoletra"><?php echo "$row[6]"; ?></span></th>
      <th width="15%" scope="col"><span class="tipoletra"><?php echo "$row[7]"; ?></span></th>
      <th width="10%" scope="col"><span class="tipoletra"><a href="inicio_visitdetext.php?idv=<?php echo "$row[0]"; ?>" target="muestra_acciones">Ver Detalle</a></span></th>
  </tr>
<?php
} // Cierre de While
?>
</table> 

<?php
if (isset ($_POST['busqueda'])) {
	if (mysql_num_rows($result) < 1) {
?>

 	<table align="center" width="100%" border="1" cellpadding="0" cellspacing="0">	
	<tr>
		<td scope="col"><span class="tipoletra">No se encontraron resultados para esta busqueda</span></td>
	</tr>
</table>
<?php
	} // Cierre de if norows
} // Cierre de if busqueda	

?>
    

