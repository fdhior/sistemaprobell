<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>opciones de busqueda</title>
<style type="text/css">
<!--
.letra_busc {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 9px;
        font-weight: normal;
        color: #000000;
}

.table_width {
        width: 100%;
}

.table_td1 {
        width: 80%;
}

.table_td2 {
        width: 20%;
}       

-->
</style>
</head>

<body>
<?php
        session_start();
        include "".$_SERVER['DOCUMENT_ROOT']."/sistemaprobell/consultas.php";

        $hostname = $_SESSION['hostname'];



        foreach ($_GET as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        ${$nombre} = $valor;
                }
        } // Cierre foreach

        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        ${$nombre} = $valor;
                }
        } // Cierre foreach


        if (isset($Opt2)) {
?>
  <br />
  <span class="letra_busc">Buscar Pedidos Por Origen</span>
    <table class="table_width" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <form id="form" name="form" method="post" action="<?php echo "$hostname$target_link"; ?>" target="pedlist_frame">
          <td class="table_td1"><label>
            <select name="sel_origen" id="select">
<?php
        // Definicion de los parametros de la consulta
        $cols_arr = array("idinmu", "nombre");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("gnrl_usrs");
        $num_tables = count($tables_arr);
        $where_clause = "idarea = 5";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        echo "<option>Elige un Origen</option>";

        while($row=mysql_fetch_row($result)) {
                        echo "<option>$row[1]</option>";
                }   // cierre de While
?>
            </select>
          </label>
            <label class="letra_busc">
            <input name="busca" type="hidden" id="busca" value="pororigen" />
            <input type="submit" name="button4" id="button3" value="Buscar" />
          </label></td>
          <td class="table_td2"><div class="letra_busc" align="center"><a href="<?php echo "".$_SERVER['PHP_SELF']."?target_link=$target_link"; ?>" target="_self"> Opciones Anteriores</a> </div></td>
        </form>
      </tr>
    </table>
<br />
  <span class="letra_busc">Buscar Pedidos Por Nombre de Archivo</span>
    <table class="table_width" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <form id="form" name="form" method="post" action="<?php echo "$hostname$target_link"; ?>" target="pedlist_frame">
          <td class="table_td1"><label class="letra_busc">
            <input name="nombre_archivo" type="text" id="nombrearchivo" size="15" maxlength="15" />
            <input name="busca" type="hidden" id="busca" value="pornombre" />
            <input type="submit" name="button4" id="button3" value="Buscar" />
          </label></td>
        </form>
      </tr>
    </table>
  <?php
        } else {
?>
  <br />
  <span class="letra_busc">Buscar Pedidos Por Fecha</span>
<table class="table_width" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <form id="form" name="form" method="post" action="<?php echo "$hostname$target_link"; ?>" target="pedlist_frame">
          <td class="table_td1"><label class="letra_busc">
            <input name="fechaesp" type="text" id="fechaesp" size="10" maxlength="10" />
          <input name="busca" type="hidden" id="busca" value="porfechaesp" />
            <input type="submit" name="button4" id="button3" value="Buscar" />
Formato: AAAA-MM-DD </label></td>
          <td class="table_td2"><div class="letra_busc" align="center"><a href="<?php echo "".$_SERVER['PHP_SELF']."?target_link=$target_link&Opt2=1"; ?>" target="_self">Mas Opciones</a></div></td>
        </form>
      </tr>

</table>



  <br />
<span class="letra_busc">Buscar Pedidos Por Rango de Fecha</span>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
  <form id="form1" name="form1" method="post" action="<?php echo "$hostname$target_link"; ?>" target="pedlist_frame">
      <td><label class="letra_busc"> Inicio
        <input name="fechainicio" type="text" id="fechainicio" size="10" maxlength="10" />
Fin:
<input name="fechafin" type="text" id="fechafin" size="10" maxlength="10" />
<input name="busca" type="hidden" id="busca" value="porrangofechas" />
<input type="submit" name="button" id="button4" value="Buscar" />
      Formato: AAAA-MM-DD</label></td>
  </form>
    </tr>
  </table>
<?php   
        }

?>
</body>
</html>
