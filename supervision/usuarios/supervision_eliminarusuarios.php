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


-->
</style>

</head>

<body>
<br />
<h2>Eliminar  Usuarios del sistema de Traslados y Pedidos</h2>
<?php
      session_start();

 	  $rutafunciones = $_SESSION['rutafunciones'];

      include $rutafunciones.'consultas.php';

	  $hostname    = $_SESSION['hostname'];
	  
	  $rel_path    = 'supervision/usuarios/supervision_';
	  $target_link = $hostname.$rel_path.'eliminausuario.php';
	  	

/*      echo "<span class=\"tipoletra\">Valores de _SESSION</span><br />";
        foreach ($_SESSION as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />";
                }
        } */

?>
  <span class="letraaduser">Elige un usuario que eliminar</span><br /><br />
<table class="tablaagruser" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $target_link; ?>" method="post" name="form1" target="_self" id="form1">
      <td width="43" valign="top"><label>
        <select name="sel_elmusr" size="10" id="sel_elmusr">
<?php
        // Definicion de los parametros de la consulta
        $cols_arr = array("iduser",
		                  "username");
        $num_cols = count($cols_arr);
//        $join_tables = '0';
        $tables_arr = array("gnrl_usrs");
        $num_tables = count($tables_arr);
        $where_clause = "gnrl_usrs.idarea = 5 AND gnrl_usrs.idusrstatus = 1";
		$order = "gnrl_usrs.nombre";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        while($row=mysql_fetch_row($result)) {
	        echo '<option value="'.$row[0].'">'.$row[1].'</option>';
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
