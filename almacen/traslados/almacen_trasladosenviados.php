<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../../css/sistemaprobell.css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.trhdfontbgcolor {
        background-image: url(bg-submenu-td2.png);
        background-repeat: repeat-x;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        font-style: normal;
        font-weight: bold;
        font-variant: small-caps;
        color: #FFFFFF;
}


.pedlist_table {
        position: relative;
        left: 25px;
        width: 972px;
}
.pedlist_frame {
	position: relative;
	width: 970px;
	height: 260px;
	left: 26px;
	border: 1px solid #000;
}

#apDiv1 {
	position:absolute;
	left:36px;
	top:345px;
	width:320px;
	height:102px;
	z-index:1;
	padding: 10px;
	border: 1px solid #000000;
}
#apDiv2 {
	position:absolute;
	left:379px;
	top:345px;
	width:605px;
	height:102px;
	z-index:2;
	padding: 10px;
	border: 1px solid #000000;
}
-->
</style>
<?php

        /*****************************************************/
        /* Administra los Traslados enviados a las tiendas   */
        /*****************************************************/

        session_start();

        include $_SESSION['rutafunciones'].'consultas.php';
        date_default_timezone_set('America/Mexico_City');
        $loggeduser = $_SESSION['compltusrname'];

        $rel_path     = 'almacen/traslados/almacen_';
		$target_link  = $_SESSION['hostname'].$rel_path.'trasladoslista.php';
        $target_frame = "pedlist_frame";

        if (isset($_SESSION['busq_guardada'])) {
                unset($_SESSION['busq_guardada']);
        }       


/*      echo "<span class=\"tipoletra\">Valores de _SERVER</span><br />";
        foreach ($_SERVER as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
                }
        } */



?>
</head>

<body>

<div id="apDiv2">
  <table class="table_width" border="1" cellspacing="0" cellpadding="5">
        <form id="form" name="form" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>" >
    <tr>
      <td width="41%" class="table_td1"><label class="letra_busc"> </label>
          <label>
          <input type="radio" name="busca" id="radio" value="pordestino" checked="checked" />
          </label>
          <label class="letra_busc">Busqueda por Destino<br />
          <select class="letra_boton" name="sel_destino" id="select">
            <?php
        // Definicion de los parametros de la consulta
        $cols_arr     = array("idinmu", "nombre");
        $num_cols     = count($cols_arr);
        $join_tables  = '0';
        $tables_arr   = array("gnrl_usrs");
        $num_tables   = count($tables_arr);
        $where_clause = "idarea = 5";
        $order        = "gnrl_usrs.nombre";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        echo "<option>Elige un Destino</option>";
?>

        <option>Todos</option>

<?php

        while($row=mysql_fetch_row($result)) {
                        echo "<option>$row[1]</option>";
                }   // cierre de While
?>
          </select>
          </label>
          <label class="letra_busc"></label></td>
      <td width="59%" class="table_td2"><span class="letra_busc">
        <input type="radio" name="busca" id="radio2" value="pornombre" />
        <label class="letra_busc">Por texto en Nombre de Archivo:<br />
        <input class="letra_boton" name="nombre_archivo" type="text" id="nombrearchivo" size="30" maxlength="30" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td class="table_td1"><span class="table_td11">
        <label class="letra_busc">Usar Rango de fechas </label>
        <label>
        <input name="filtfecha" type="checkbox" class="letra_boton" id="checkbox" />
        </label>
        <label class="letra_busc"> Formato AAAA-MM-DD<br />
          inicio
          <input class="letra_boton" name="fechaesp" type="text" id="fechaesp" size="10" maxlength="10" />
          Fin</label>
        <label>
        <input name="textfield" type="text" class="letra_boton" id="textfield" size="10" maxlength="10" />
        </label>
        <label class="letra_busc"></label>
      </span></td>
      <td align="center" class="table_td2"><span class="letra_busc">
        <input class="letra_boton11" type="submit" name="button3" id="button3" value="Buscar" />
      </span></td>
    </tr>
        </form>
  </table>
</div> <!-- Fin de div2 -->



<div id="apDiv1"> <span>Ordenar Lista</span>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <form id="form3" name="form3" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
          <td><div align="left">
              <input name="orden" type="hidden" id="orden" value="pororigen" />
              <input class="letra_boton11" type="submit" name="button" id="button" value="Por Origen" />
          </div></td>
        </form>
        <form id="form4" name="form4" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
          <td><div align="left">
              <input name="orden" type="hidden" id="orden" value="porfechareb" />
              <input class="letra_boton11" type="submit" name="button" id="button" value="Por Fecha Recibido" />
          </div></td>
        </form>
        <form id="form5" name="form5" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
          <td><div align="left">
              <input name="lista" type="hidden" id="orden" value="todos" />
              <input class="letra_boton11" type="submit" name="button" id="button" value="Ultimos 100" />
          </div></td>
        </form>
      </tr>
    </table>
    <br />
</div> <!-- Fin de div1 -->

<br />

<h2><?php echo $loggeduser; ?>,  En esta lista puedes consultar que Traslados ya  has enviado:</h2>
<br />

<div id="divContent0" style="position: relative; left: 26px; top: 0px;">
<table class="tblHeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="42">No.</td>
    <td width="106">Traslado</td>
    <td width="83">Tama&ntilde;o</td>
    <td width="203">Destino</td>
    <td width="181">Fecha de Envio</td>
    <td width="152">Descargado en Destino</td>
    <td>&nbsp;</th>
  </tr>
</table>
</div>

<iframe class="pedlist_frame" align="left" frameborder="0" hspace="0" vspace="0" name="pedlist_frame" scrolling="Yes" src="<?php echo $target_link; ?>" id="pedlist_frame" marginheight="0" marginwidth="0"></iframe>


</body>
</html>
