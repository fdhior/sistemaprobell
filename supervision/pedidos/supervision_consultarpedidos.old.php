<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../../css/sistemaprobell.css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />

<?php
	
	session_start();

    include $_SESSION['rutafunciones'].'consultas.php';

    $userinmuid  = $_SESSION['userinmuid'];
    $userespname = $_SESSION['userespname'];
    $loggeduser  = $_SESSION['compltusrname'];
    $idusrarea   = $_SESSION['idusrarea'];
    $tipousr     = $_SESSION['tipousr'];
    $iduser      = $_SESSION['iduser'];

    if (isset($_SESSION['busq_guardada'])) {
    	unset($_SESSION['busq_guardada']);
    }       

    $target_link  = $_SESSION['hostname'].'supervision/pedidos/supervision_pedidoslista.php';
    $target_frame = "pedlist_frame";

?>

<style type="text/css">
<!--
.trhdfontbgcolor {
        background-image: url(bg-submenu-td2.png);
        background-repeat: repeat-x;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        font-style: normal;
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
        width: 968px;
        height: 255px;
}

.letra_tablehead {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        font-weight: bold;
}
.letra_boton {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 9px;
        font-weight: normal;
        font-variant: small-caps;
}
#apDiv1 {
        position:absolute;
        left:26px;
        top:459px;
        width:320px;
        height:109px;
        z-index:1;
        padding: 10px;
        border: 1px solid #000000;
}
#apDiv2 {
        position:absolute;
        left:370px;
        top:459px;
        width:605px;
        height:109px;
        z-index:2;
        padding: 10px;
        border: 1px solid #000000;
}-->
</style>
</head>

<body>


<br />
<br />
<h2><?php echo "$loggeduser"; ?>,  Consulta la actividad de Pedidos enviados a los almacenes CEDIS y Muebles de tiendas (Ultimos 100):</h2>
<br />


<div style="position: relative; left: 26px">
<table class="tblHeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33">No.</td>
    <td width="84">Archivo</td>
    <td width="110">Origen</td>
    <td width="110">Destino</td>
    <td width="170">Enviado el D&iacute;a</td>
    <td width="170">Descargado el D&iacute;a</td>
    <td width="187">Observaciones</td>
    <td width="90">Descargado</td>
  </tr>
</table>
</div>

<table class="pedlist_table" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><iframe class="pedlist_frame" align="left" frameborder="0" hspace="0" vspace="0" name="pedlist_frame" scrolling="Yes" src="<?php echo $target_link; ?>" id="pedlist_frame" marginheight="0" marginwidth="0"></iframe></td>
  </tr>
</table><p>&nbsp;</p>


<div id="apDiv1"> <span>Ordenar Lista</span>
    <table width="100%" border="1" cellspacing="0" cellpadding="5">
      <tr>
        <form id="form3" name="form3" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
          <td><div align="center">
              <input name="orden" type="hidden" id="orden" value="pororigen" />
              <input class="letra_boton" type="submit" name="button" id="button" value="Por Origen" />
          </div></td>
        </form>

        <form id="form4" name="form4" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
          <td><div align="center">
              <input name="orden" type="hidden" id="orden" value="pordestino" />
              <input class="letra_boton" type="submit" name="button" id="button" value="Por Destino" />
          </div></td>
        </form>
     </tr>
      <tr>
        <form id="form5" name="form5" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
          <td><div align="center">
            <input name="orden" type="hidden" id="orden" value="porfechaenv" />
            <input class="letra_boton" type="submit" name="button" id="button" value="Por Fecha Enviado" />
          </div></td>
        </form>
        <form id="form6" name="form6" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
          <td><div align="center">
              <input name="orden" type="hidden" id="orden" value="porfechadesc" />
              <input class="letra_boton" type="submit" name="button" id="button" value="Por Fecha Descargado" />
          </div></td>
        </form>
      </tr>
      <tr>
        <form id="form7" name="form7" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
          <td><div align="center">
              <input name="lista" type="hidden" id="orden" value="todos" />
              <input class="letra_boton" type="submit" name="button" id="button" value="Ultimos 100" />
          </div></td>
        </form>
        <form id="form8" name="form8" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
          <td>&nbsp;</td>
        </form>
      </tr>
    </table>
  <br />
</div> <!-- Cierre de div1 -->




<div id="apDiv2">
  <table width="100%" border="1" cellpadding="5" cellspacing="0" class="table_width">
    <form id="form" name="form" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>" >
    <tr>
      <td width="43%" class="table_td1"><label class="letra_busc"> </label>
          <label></label><label class="letra_busc"></label>
          <label></label>
          <label class="letra_busc"><span class="table_td11">Limitar lista al almacen<br />
          <select class="letra_boton" name="sel_destino" id="sel_destino">
            <option>Todos</option>
            <option>CEDIS</option>
            <option>Muebles</option>
          </select>
          <br />

                </span></label>
        <label class="letra_busc"></label></td>
      <td width="57%" class="table_td2"><span class="table_td11">
        <label class="letra_busc">
        <input type="radio" name="busca" id="radio2" value="pornombre" />
Filtrar por texto en Nombre de Archivo:<br />
<input class="letra_boton" name="nombre_archivo" type="text" id="nombrearchivo" size="30" maxlength="30" />
        </label>
</span></td>
    </tr>
    <tr>
      <td class="table_td1"><span class="table_td11">
        <label class="letra_busc">
        <input type="radio" name="busca" id="radio" value="pororigen" checked="checked" />
Filtrar por  Origen<br />
<select class="letra_boton" name="sel_origen" id="select">
  <?php
        // Definicion de los parametros de la consulta
        $cols_arr = array("idinmu", "nombre");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("gnrl_usrs");
        $num_tables = count($tables_arr);
        $where_clause = "idarea = 5";
                $order = "gnrl_usrs.nombre";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

?>
  <option selected="selected">Todos</option>
  <?php

        while($row=mysql_fetch_row($result)) {
                        echo "<option>$row[1]</option>";
                }   // cierre de While
?>
</select>
</label>
</span></td>
      <td align="left" class="table_td2"><span class="letra_busc">
        </span>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span class="table_td11">
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
            <td align="center"><span class="letra_busc">
              <input class="letra_boton" type="submit" name="button3" id="button3" value="Buscar" />
            </span></td>
          </tr>
        </table>
        <span class="letra_busc">
        <label class="letra_busc"></label>
        </span></td>
    </tr>
        </form>
  </table>
</div> <!-- Cierre de div2 -->


</body>
</html>
