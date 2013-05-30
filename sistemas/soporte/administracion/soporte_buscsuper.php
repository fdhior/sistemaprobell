<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!-- <style type="text/css">
<!--
.tipoletra {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	font-weight: normal;
	font-variant: small-caps;		
}

</style> -->
<style type="text/css">
<!--
body {
	background-color: #EEE;
}
-->
</style></head>

<body>
<?php
include "consultas.php";
?>
<p class="tittextvisitadet">Mostrar Información de los Supervisores<br />
<table class="posbuscoptable" width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
   <td width="45%" valign="middle" align="left" scope="col"><form id="form1" name="form1" method="post" action="inicio_listasuperv.php" target="muestra_cambios">
        <label class="textvisitadetcap">Elige un Supervisor</label>
:
<?php
		$colsarr = array("nombre");
		$numcols = count($colsarr);
		$aff_table = "gnrl_usrs";

		// Consulta recupera nombres tienda
		$result2 = simp_query($numcols, $colsarr, $aff_table, $where_clause, $order, $dir, $limit);
    ?>
<select name="nsprvpass" id="select2">
  <?php
        while($row=mysql_fetch_row($result2)) {
		echo "<option";
		echo ">$row[0]</option>";
		}   // cierre de While    	
	?>
</select>
<input type="submit" name="button2" id="button2" value="Buscar" />
</p>
    </form></td>
  </tr>
</table>
</body>
</html>
