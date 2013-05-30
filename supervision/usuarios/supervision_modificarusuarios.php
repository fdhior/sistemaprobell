<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

.frmListaUsuarios {
	position: relative;
    width: 970px;
    height: 200px;
	left: 26px;
	border: 1px solid #000;
}

#divUsuariosDetalles {
	position: absolute;
	width: 556px;
	height: 165px;
	left: 36px;
	border: 1px solid #000;
	top: 297px;
}

#form3 {
	position: absolute;
	left: 631px;
	border: 1px solid #000;
	top: 339px;
	width: 247px;
}

#form4 {
	position: absolute;
	left: 632px;
	border: 1px solid #000;
	top: 383px;
	width: 247px;
}

.btnListaContras {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	position: absolute;
	top: 265px;
	left: 895px;
}

.tblOpciones {
	position: relative;
 	left: 26px;
	width: 973px;
}

#divOpBusc {
	position:absolute;
	left:602px;
	top:297px;
	width:404px;
	height:165px;
	border: 1px solid #000;
	z-index:1;
}

-->
</style>
<?php
	session_start();

	include $_SESSION['rutafunciones'].'consultas.php';
	$idtipousr     = $_SESSION['idtipousr'];
	$hostname      = $_SESSION['hostname'];

	$rel_path      = 'supervision/usuarios/supervision_';
	$target_link   = $hostname.$rel_path.'usuarioslistado.php';
    $target_link2  = $hostname.$rel_path.'modificausuario.php';

	$target_frame  = "frmListaUsuarios"; 

	unset($_SESSION['sel_pattern']);
?>

<script language="javascript">

var maxAnchoDisp=screen.availWidth, maxAltoDisp=screen.availHeight; // Se determina el espacio disponible en la pantalla

function listarContras()
{

	var anchoVent=400, altoVent=400; // Se determina el ancho y el alto iniciales de la ventana
	
   	/* En las líneas siguientes se calcula la posición inicial de la ventana. Para ello, se resta el tamaño inicial del tamaño disponible y se divide por dos */
	var esqIzq=(maxAnchoDisp-anchoVent)/2;
	var esqSup=(maxAltoDisp-altoVent)/2;

	var nomArchivo = 'supervision_usuarioscontras.php';
	var nomVent = 'listaContras';
	abreVentana(nomArchivo, nomVent, anchoVent, altoVent, esqSup, esqIzq);

}

function abreVentana(nomArchivo, nomVent, anchoVent, altoVent, esqSup, esqIzq)
{

	ventParaAbrir = window.open(nomArchivo, nomVent, 'width='+ anchoVent +',height='+ altoVent +',top='+ esqSup +',left='+ esqIzq +',scrollbars=NO,resizable=NO,directories=NO,location=NO,menubar=NO,status=NO,titlebar=NO,toolbar=NO');

	ventParaAbrir.focus();

}



	function usuariosactivos()
	{
		document.forms[0].submit();
	}
	
	function usuariosinactivos()
	{
		document.forms[1].submit();
	}

	function usuarioseliminados()
	{
		document.forms[2].submit();
	}

	function buscaporbnombre()
	{
		document.forms[3].submit();
	}

	function buscaportienda() 
	{
		document.forms[4].submit();
	}
	
</script>

</head>

<body>

<!-- iframe de lista usuarios -->
<input class="btnListaContras" name="btnListaContras" type="button" value="Listar Contrase&ntilde;as" onclick="javascript: listarContras()" />
<div id="divOpBusc"><br /><h2>Opciones de B&uacute;squeda</h2></div>
<br />
<h2>Modificar Propiedades de Usuarios Registrados</h2>

<div id="divContent0" style="position: relative; left: 26px; top: 0px;">
<table class="tblHeaderStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33">No.</td>
    <td width="110">Nombreusuario</td>
    <td width="200">Tienda</td>
    <td width="100">Contraseña</td>
    <td width="150">Numero de Tienda</td>
    <td width="150">Fecha de Alta</td>
    <td width="100">Estado</td>
    <td>Opciones</td>
  </tr>
</table>
</div>


<iframe class="frmListaUsuarios" name="frmListaUsuarios" id="frmListaUsuarios" src="<?php echo $target_link; ?>" align="left" hspace="0" vspace="0" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0"></iframe>


<table class="tblOpciones" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="145" class="letra_predeterminada12"><label>
      <input name="sel_tuser" type="radio" id="radio" value="activos" checked="checked" onclick="javascript: usuariosactivos()" />
    </label>
    Usuarios Activos</td>
    <td width="187" class="letra_predeterminada12"><label>
      <input type="radio" name="sel_tuser" id="radio2" value="deshab" onclick="javascript: usuariosinactivos()" />
    </label>
    Usuarios Deshabilitados</td>
    <td width="172" class="letra_predeterminada12"><label>
      <input type="radio" name="sel_tuser" id="radio3" value="elemn" onclick="javascript: usuarioseliminados()" />
    </label>
    Usuarios Eliminados</td>
 
    <td width="469" class="letra_predeterminada12">&nbsp;</td>
    
  </tr>
</table>
<form id="form0" name="form0" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
  <input name="sel_user" type="hidden" id="sel_user" value="activos" />
</form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->
<form id="form1" name="form1" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
  <input name="sel_user" type="hidden" id="sel_user" value="deshabilitados" />
</form>
<form id="form2" name="form2" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
  <input name="sel_user" type="hidden" id="sel_user" value="eliminados" />
</form>

<form id="form3" name="form3" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
    <label class="letra_predeterminada12">Busqueda por nombre:
          <input name="nombreusuario" type="text" id="nombreusuario" size="15" maxlength="15" onchange="javascript: buscapornombre()"/>
          <input name="busca" type="hidden" id="busca" value="pornombre" />
  </label>
</form>   

<form id="form4" name="form4" method="post" action="<?php echo $target_link; ?>" target="<?php echo $target_frame; ?>">
<label class="letra_predeterminada12">Busqueda por Tienda:

        <select name="sel_inmu" class="letra_botton11" id="sel_inmu" onchange="javascript: buscaportienda()">
          <?php

		$cols_arr     = array("idinmu", "nombreinmu");
    	$num_cols     = count($cols_arr);
		$tables_arr   = array("inmu_gdat");
		if ($idtipousr == '2' or $idtipousr == '3') {
		  	$where_clause = "idinmutipo <> 5 AND idinmutipo <> 6 AND idinmustat = 1";
		}	
		$order 		  = "nombreinmu";

		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
		unset($where_clause);
		unset($order);
//    $row=mysql_fetch_row($result);
	
		while($row=mysql_fetch_row($result)) {
			echo "<option value=\"$row[0]\">$row[1]</option>";
		}   // cierre de While

?>
        </select>
     
        <input name="busca" type="hidden" id="busca" value="portienda" />
  </label>
</form>      


<div id="divUsuariosDetalles">
<br />
<span class="letra_predeterminadamargen">Para modificar las propiedades de un usuario elige el bot&oacute;n Modificar en la lista de usuarios</span><br />
  <?php

        // Definicion de los parametros de la consulta
        $cols_arr = array("COUNT(iduser)");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("gnrl_usrs");
        $num_tables = count($tables_arr);

		if ($idtipousr == '2' or $idtipousr == '3') {
    	    $where_clause = "gnrl_usrs.idarea = 5";
		}

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row=mysql_fetch_row($result)
	       
?>
  <br />
  <span class="letra_predeterminadamargen">No. de Usuarios <?php if ($idtipousr == '3' or $idtipousr == '2') { echo 'de Tienda '; } ?>Registrados: <strong><?php echo "$row[0]"; ?></strong></span>
  <?php

        // Definicion de los parametros de la consulta
        $cols_arr = array("COUNT(iduser)");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("gnrl_usrs");
        $num_tables = count($tables_arr);

   		switch ($idtipousr) {
			case "1":			
				$where_clause = "gnrl_usrs.idusrstatus = 1";
				break;
			case "2":
			case "3":
				$where_clause = "gnrl_usrs.idarea = 5 AND gnrl_usrs.idusrstatus = 1";
				break;
		}
        
		$result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row1=mysql_fetch_row($result)
	       
?>
  <br />
  <span class="letra_predeterminadamargen">No. de Usuarios <?php if ($idtipousr == '3' or $idtipousr == '2') { echo 'de Tienda '; } ?>Activos: <strong><?php echo "$row1[0]"; ?></strong></span>
  <?php

        // Definicion de los parametros de la consulta
        $cols_arr = array("COUNT(iduser)");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("gnrl_usrs");
        $num_tables = count($tables_arr);
      
   		switch ($idtipousr) {
			case "1":			
				$where_clause = "gnrl_usrs.idusrstatus = 2";
				break;
			case "2":
			case "3":
				$where_clause = "gnrl_usrs.idarea = 5 AND gnrl_usrs.idusrstatus = 2";
				break;
		}


        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row2=mysql_fetch_row($result)
	       
?>
  <br />
  <span class="letra_predeterminadamargen">No. de Usuarios <?php if ($idtipousr == '3' or $idtipousr == '2') { echo 'de Tienda '; } ?>Inhabilitados: <strong><?php echo "$row2[0]"; ?></strong></span>
  <?php

        // Definicion de los parametros de la consulta
        $cols_arr = array("COUNT(iduser)");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("gnrl_usrs");
        $num_tables = count($tables_arr);

   		switch ($idtipousr) {
			case "1":			
		        $where_clause = "gnrl_usrs.idusrstatus = 3";
				break;
			case "2":
			case "3":
			    $where_clause = "gnrl_usrs.idarea = 5 AND gnrl_usrs.idusrstatus = 3";
				break;
		}

		

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row3=mysql_fetch_row($result)
	       
?>
  <br />
  <span class="letra_predeterminadamargen">No. de Usuarios <?php if ($idtipousr == '3' or $idtipousr == '2') { echo 'de Tienda '; } ?>Eliminados: <strong><?php echo "$row3[0]"; ?></strong></span>
</div>

<p>&nbsp;</p>

</body>

</html>
