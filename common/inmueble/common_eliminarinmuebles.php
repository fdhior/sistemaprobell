<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />


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


-->
</style>
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<br />
<h2>Eliminar  Tiendas del Sistema</h2>
<?php
	    session_start();

	    include $_SESSION['rutafunciones'].'consultas.php';

/*      echo "<span class=\"tipoletra\">Valores de _SESSION</span><br />";
        foreach ($_SESSION as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />";
                }
        } */

?>
  <span class="letraaduser">Elige una tienda a eliminar</span><br /><br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="common_eliminainmueble.php" method="post" name="form1" target="_self" id="form1">
      <td width="43" valign="top"><label>
        <select name="sel_elmtien" size="10" id="sel_elmtien">
<?php
        // Definicion de los parametros de la consulta
        $cols_arr = array("nombreinmu");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("inmu_gdat");
//        $num_tables = count($tables_arr);
        $where_clause = "(idinmutipo = 1 OR idinmutipo = 2 OR idinmutipo = 3 OR idinmutipo = 4) AND idinmustat <> 3";
		$order = "inmu_gdat.nombreinmu";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        while($row=mysql_fetch_row($result)) {
	        echo "<option>$row[0]</option>";
        }   // cierre de While
?>
		</select>
        </label>
          </label>
      <label></label></td>
      <td width="257" valign="top"><input type="submit" name="button2" id="button2" value="Eliminar" /></td>
    </form>
  </tr>
</table>
</body>
</html>
