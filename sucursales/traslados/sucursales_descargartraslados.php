<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../../css/sistemaprobell.css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.desctras_table {
        position: relative;
        left: 25px;
        width: 972px;
}

.desctras_frame {
	position: relative;
	width: 970px;
	height: 250px;
	left: 26px;
	border: 1px solid #000;
}

.letra_tablehead {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 10px;
        font-weight: bold;
}
#apDiv1 {
        position:absolute;
        left:36px;
        top:330px;
        width:330px;
        height:108px;
        z-index:1;
        padding: 10px;
        border: 1px solid #000000;
}

#apDiv2 {
        position:absolute;
        left:455px;
        top:330px;
        width:530px;
        height:108px;
        z-index:2;
        padding: 10px;
        border: 1px solid #000000;
}

.letra_tablas {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 9px;
        font-style: normal;
        font-weight: normal;
}
.letra_busc
{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 9px;
        font-weight: normal;
        color: #000000;
}
-->
</style>
<?php

        session_start();


        $userinmuid  = $_SESSION['userinmuid'];
        $userespname = $_SESSION['userespname'];
        $loggeduser  = $_SESSION['compltusrname'];
        $idusrarea   = $_SESSION['idusrarea'];
        $tipousr     = $_SESSION['tipousr'];
        $iduser      = $_SESSION['iduser'];

        if (isset($_SESSION['busq_guardada'])) {
                unset($_SESSION['busq_guardada']);
        }

		$rel_path     =  'sucursales/traslados/sucursales_';
        $target_link  = $_SESSION['hostname'].$rel_path.'trasladoslista.php';
        $target_frame = "traslist_frame";

?>
</head>

<body>

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
    <p><br />
        </p>
</div> <!-- Fin de div1 -->

<div id="apDiv2">
  <table class="table_width" border="1" cellspacing="0" cellpadding="5">
        <form id="form" name="form" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>" >
    <tr>
      <td width="41%" class="table_td1"><label class="letra_busc"> </label>
          <label>
          <input type="radio" name="busca" id="radio" value="pororigen" checked="checked" />
          </label>
          <label class="letra_busc">Busqueda por Origen<br />
          <select class="letra_boton" name="sel_origen" id="select">
          <option>Elige un Origen</option>
          <option>Todos</option>
          <option>CEDIS</option>
          <option>Muebles</option>
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

<br />
<h2><?php echo "$loggeduser $userespname"; ?>,  Descarga tus Traslados:</h2><br />

<div id="divContent0" style="position: relative; left: 26px; top: 0px;">
<table class="tblHeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33">No.</td>
    <td width="106">Archivo</td>
    <td width="83">Tama&ntilde;o</td>
    <td width="138">Almacen Origen</td>
    <td width="235">Enviado el Dia</td>
    <td width="172">Descargar</td>
    <td width="">&nbsp;</td>
  </tr>
</table>
</div>


<iframe class="desctras_frame" align="left" name="traslist_frame" id="traslist_frame" frameborder="0" hspace="0" vspace="0" scrolling="Yes" src="<?php echo $target_link; ?>" marginheight="0" marginwidth="0"></iframe>

</body>
</html>