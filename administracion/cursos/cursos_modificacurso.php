<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cursos Probell - Modificar Cursos</title>
<link rel="stylesheet" type="text/css" href="../../css/sistemaprobell.css" />
<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />


<script language="JavaScript" src="calendario/javascripts.js"></script>
<style type="text/css">
<!--
body {
        background-color: #FFFFFF;
}
-->
</style>
<script language="javascript">
//                window.alert("Revisa el resultado de la transferencia.");
        function buscaportienda()
        {
                document.forms[0].submit();
        }

        function buscaporfolio()
        {
                document.forms[1].submit();
        }
        
        function buscaporcurso()
        {
                document.forms[3].submit();
        }

        function buscaporntec()
        {
                document.forms[5].submit();
        }

        function buscapornlin()
        {
                document.forms[7].submit();
        }
        
        
</script>

</head>

<?php
        
        session_start();

        // Incluye librerias
        $ruta_funciones = $_SERVER['DOCUMENT_ROOT'].'/sistemaprobell/funciones/';

        include $ruta_funciones.'consultas.php';
        include "calendario/calendario.php";
		
		$rel_path = 'administracion/cursos/';

        $target_link  = $_SESSION['hostname'].$rel_path.'cursos_ejecutamodificar.php';            
        $target_link2 = $_SESSION['hostname'].$rel_path.'cursos_cursoslistadoconsulta.php';
        $target_frame = "moduser_frame"; 

    // Mostrar los valores de _POST
/*      echo "Valores de _POST <br />";
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "Nombre de la variable: <b>$nombre</b> Valor de la variable: $valor<br />";
                }
        }*/


        if (isset($_SESSION['err_return']) or isset($_SESSION['motiv_return'])) {
                if (isset($_SESSION['err_return'])) {
                        $modificar = $_SESSION['err_return']['modificar'];
                } else {
                        $modificar = $_SESSION['motiv_return']['modificar'];
                }       
        } else {
                foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        ${$nombre} = $valor;
                        }
                } // Cierre foreach     
        }       


?>

<body>

  <?php

        switch($modificar) {
//                      } // Ciere  If moddatos
                case "moddatosform":

                    if (isset($_SESSION['err_return'])) {
                                $invalid_check = $_SESSION['err_return']['invalid_check'];
                                $err_return = $_SESSION['err_return'];
                                foreach ($err_return as $nombre => $valor) {
                                        ${$nombre} = $valor;
                                } // Cierre foreach     
                        } 
                        unset($_SESSION['err_return']);
        
?>

<br />
<h2>Modificar Datos Curso de Tienda: <?php echo "$ntpass"; ?></h2>
<?php
        
            $cols_arr      = array("curso",
                                       "nlinea", 
                                                           "fecha", 
                                                           "hora", 
                                                           "nombretec", 
                                                           "observaciones");
        $num_cols      = count($cols_arr);
        $join_tables   = '1';
        $tables_arr    = array("inmu_gdat",
                                       "curs_cdet", 
                                                           "curs_line", 
                                                           "curs_tecn");
        $num_tables    = count($tables_arr);
                $on_fields_arr = array("idinmu", 
                                       "idlinea", 
                                                           "idtecnico");
                $connect       = '1';
                $where_clause  = "idcurso = '$idcurpass'"; 

        $curso_edit = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
                unset($join_tables);
                unset($num_tables);             
                unset($on_fields_arr);
                unset($connect);
                unset($where_clause); 

                $row=mysql_fetch_row($curso_edit);

?>

<form id="form1" name="form1" method="post" action="<?php echo $target_link; ?>" target="_self">
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" scope="col"><label class="letra_predeterminada12">Folio No. : <?php echo "$idcurpass"; ?><br />
      Nombre del Curso:</label>
      <label>
      <input type="text" name="ncurso" id="ncurso" value="<?php if ($invalid_check == '2') { echo "$ncurso"; } else { echo "$row[0]"; } ?>" />
      <br />
      <?php
        if ($error_id == "0" or $error_id == "1") {
                echo "<span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span><br />";
        }
      ?> 
      </label>
      <label class="letra_predeterminada12">Cambiar  L&iacute;nea:</label>
      <label>
<select name="nlinea" id="nlinea">
<!--  <option selected="selected">Selecciona Una L&iacute;nea</option>-->
  <?php


//              include "conectarcursos.php";
                include "funciones_conversion.php"; 

                // Consulta para determinar y Listar Nombres de Lineas
        // la consulta elige nombre de la línea

                $cols_arr = array("idlinea", "nlinea");
                $num_cols = count($cols_arr);
                $tables_arr = array("curs_line");
                $order = "nlinea";

                $recupera_nlinea = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                while($rowl=mysql_fetch_row($recupera_nlinea)) {
                        echo "<option";
                        if ((!isset($error_id) and $rowl[1] == $row[1]) or (isset($error_id) and $rowl[0] == $nlinea)) {
                                echo " selected";
                        }       
                        echo " value=\"$rowl[0]\">$rowl[1]</option>";
                } // Cierre de While

?>
                </select>
<br />
      </label>
      <label class="letra_predeterminada12">Cambiar fecha de Realizacion:</label>
      <label><?php if ($invalid_check == "2") { $fecha_pass = $dfecha; } else { $fecha_pass = $row[2]; } escribe_formulario_fecha_vacio("dfecha","form1",$fecha_pass); ?>
          <br />
      <?php
        if ($error_id == "2" or $error_id == "3" or $error_id == "4") {
                echo "<span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span><br />";
        }
      ?> 
      </label>
      <label class="letra_predeterminada12">Cambiar hora de Inicio:</label>
      <label>
                <select name="dhora" id="dhora">
<!--  <option>Elige una Hora</option>
-->  <?php

                if ($invalid_check == "2") {
                        echo "<option selected>$dhora</option>";                
                } else {
                        echo "<option selected>$row[3]</option>";
                }

?>
  <option>09:00:00</option>
  <option>09:30:00</option>
  <option>10:00:00</option>
  <option>10:30:00</option>
  <option>11:00:00</option>
  <option>11:30:00</option>
  <option>12:00:00</option>
  <option>12:30:00</option>
  <option>13:00:00</option>
  <option>13:30:00</option>
  <option>14:00:00</option>
  <option>14:30:00</option>
  <option>15:00:00</option>
  <option>15:30:00</option>
  <option>16:00:00</option>
  <option>16:30:00</option>
  <option>17:00:00</option>
  <option>17:30:00</option>
  <option>18:00:00</option>
  <option>18:30:00</option>
  <option>19:00:00</option>
</select>
<br />
      <input type="submit" name="button" id="button" value="Actualizar Datos" />
      <input name="modact" type="hidden" id="modact" value="actcurso" />
      <input name="modactlist" type="hidden" id="hiddenField18" value="curso" />
      <input name="idcurpass" type="hidden" id="idcurpass" value="<?php echo "$idcurpass"; ?>" />
      <input name="ntpass" type="hidden" id="ntpass" value="<?php echo "$ntpass"; ?>" />
      <input name="modificarpass" type="hidden" id="ntpass4" value="<?php echo "$modificar"; ?>" />
      </label></td>
    <td align="left" valign="top" scope="col"><label class="letra_predeterminada12">Cambiar T&eacute;cnico:</label>
      <label>
                <select name="ntecnico" id="ntecnico">
<?php
                
                // Consulta para determinar y Listar Nombres de Tecnicos
        // la consulta elige el nombre de cada tecnico
                $cols_arr = array("idtecnico", "nombretec");
                $num_cols = count($cols_arr);
                $tables_arr = array("curs_tecn");
                $order = "nombretec";

                $recupera_ntec = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
                
                unset($order);
                
                while($rowt=mysql_fetch_row($recupera_ntec)) {
                        echo "<option";
                        if ((!isset($error_id) and $rowt[1] == $row[4]) or (isset($error_id) and $rowt[0] == $ntecnico)) {
                                echo " selected";
                        }       
                        echo " value=\"$rowt[0]\">$rowt[1]</option>";
                }   // cierre de While                                           
?>
</select>
<br />
      </label>
      <label class="letra_predeterminada12">Editar Observaciones:</label>
      <label><br />
      <textarea name="dobserv" id="dobserv" cols="45" rows="5"><?php echo "$row[5]"; ?></textarea>
      </label></td>
  </tr>
</table>
</form>
<p> 
  <?php 
                        break; // CIERRE DE BLOQUE MODDATOSFORM
                case "cambiaestado": // INICIA BLOQUE CAMBIAESTADO


?>
<br />
<h2>Modificar Estado De Curso en Tienda <?php echo "$ntpass"; ?></h2>
<span class="letra_predeterminadamargen">Cambia el estado de este curso: </span><br /><br />

<div id="divContent0" style="position: relative; left: 26px;">
<table class="tblConfirmStd" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr> 
      <td>Folio</td>
      <td>Curso</td>
      <td>Fecha</td>
      <td>Hora de Inicio</td>
      <td>Estado</td>
      <td>Modificar</td>
    </tr>
  </tbody>

<?php   

                $cols_arr      = array("idcurso", "curso", "fecha", "hora", "curs_csta.estado", "inmu_gdat.nombreinmu");
                $num_cols      = count($cols_arr);
                $join_tables   = '1';
                $tables_arr    = array("inmu_gdat", "curs_cdet", "curs_csta");
                $num_tables    = count($tables_arr);
                $on_fields_arr = array("idinmu", "idcursostat");
                $connect       = '1'; 
        
                $where_clause  = "idcurso = '$idcurpass'";

                $curso_busc_detalle = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                unset($join_tables);
                unset($num_tables);
                unset($on_fields_arr);
                unset($connect);
                unset($where_clause); 

                while($row=mysql_fetch_row($curso_busc_detalle)) {

?>

<form id="form5" name="form5" method="post" action="<?php echo $target_link; ?>" target="_self">
    <tr>

<?php

  /*$oddevencheck = $cuentlin % 2;  
  
  if ($oddevencheck == 0) {
                echo "row_even";
  } else {
                echo "row_odd";
  }*/

?>  
   
        <td class="tblTDStd"><?php echo "$row[0]"; ?></td>
        <td class="tblTDStd"><?php echo "$row[1]"; ?></td>
        <td class="tblTDStd"><?php echo "$row[2]"; ?></td>
        <td class="tblTDStd"><?php echo "$row[3]"; ?></td>
        <td class="tblTDStd"><select name="sel_estado" id="sel_estado">
<?php


                $cols_arr     = array("idcursostat", "estado");
                $num_cols     = count($cols_arr);
                $tables_arr   = array("curs_csta");
                $where_clause = "estado <> 'Eliminado'";

                $recupera_estado = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
                                
                while($rowe=mysql_fetch_row($recupera_estado)) {

                        echo "<option";
                        if ($rowe[1] == $row[4]) {
                                echo " selected";
                        }       
                        echo " value=\"$rowe[0]\">$rowe[1]</option>";
                } // Cierre de While

?>
    </select>
          </font></td>
      <td class="tblTDStd"><input type="submit" name="button6" id="button6" value="Cambiar" />
          <input name="modact" type="hidden" id="hiddenField" value="actestado" />
      <input name="modactlist" type="hidden" id="hiddenField17" value="curso" />
      <input name="idcurpass" type="hidden" id="hiddenField" value="<?php echo $row[0]; ?>" />
          <input name="ntpass" type="hidden" id="hiddenField" value="<?php echo $row[5]; ?>" />
      <input name="ncpass" type="hidden" id="hiddenField" value="<?php echo $row[1]; ?>" />   </td>
        </tr>
</form>
<?php
$cuentlin++;
}

?>
</table>
</div>
<br />
<table class="tblBttnStd" border="0">
  <tr>
    <form id="form5" name="form5" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
    <td scope="col">
      <div align="left">
        <input type="submit" name="button6" id="button6" value="Cancelar" />
        </div>
    </td>
    </form>
  </tr>
</table>


  <p>
<?php

                        break; // CIERRE DE BLOQUE CAMBIAESTADO
                case "motivocancela": // INICIA BLOQUE CAMBIAESTADO

                    if (isset($_SESSION['motiv_return'])) {
//                              $invalid_check = $_SESSION['err_return']['invalid_check'];
                                $motiv_return = $_SESSION['motiv_return'];
                                foreach ($motiv_return as $nombre => $valor) {
                                        ${$nombre} = $valor;
                                } // Cierre foreach     
                        } 
                        unset($_SESSION['motiv_return']);
                        
                    if (isset($_SESSION['err_return'])) {
                                $invalid_check = $_SESSION['err_return']['invalid_check'];
                                $err_return = $_SESSION['err_return'];
                                foreach ($err_return as $nombre => $valor) {
                                        ${$nombre} = $valor;
                                } // Cierre foreach     
                        } 
                        unset($_SESSION['err_return']);

?>
<br />
<h2>Cancelaci&oacute;n de Curso de la Tienda <?php echo "$ntpass"; ?></h2>
<span class="titulos">El curso <span class="curso"><?php echo "$ncpass"; ?></span> ser&aacute; cancelado especifica el motivo de cancelaci&oacute;n</span><br />

<table width="96%" border="0" align="center">
  <tr>
    <form id="form5" name="form5" method="post" action="<?php echo $target_link; ?>" target="_self">
    <td scope="col">
      <div align="left">
                <input name="motivocancela" type="text" id="motivocancela" size="50" maxlength="400">
                <br />
                <?php
        if ($error_id == "0") {
                echo "<span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span><br />";
        }
      ?>
                <br />
      <input type="submit" name="button" id="button" value="Cambiar Estado" />
          <input name="modact" type="hidden" id="hiddenField" value="actestado" />
      <input name="modactlist" type="hidden" id="hiddenField17" value="curso" />
      <input name="idcurpass" type="hidden" id="hiddenField" value="<?php echo "$idcurpass"; ?>" />
          <input name="ntpass" type="hidden" id="hiddenField" value="<?php echo "$ntpass"; ?>" />
      <input name="ncpass" type="hidden" id="hiddenField" value="<?php echo "$ncpass"; ?>" />
      <input name="sel_estado" type="hidden" id="hiddenField" value="<?php echo "$sel_estado"; ?>" />
      <input name="motivo_esp" type="hidden" id="hiddenField" value="1" />
      </div>
    </td>
    </form>

  </tr>
</table>

<table class="tblBttnStd" border="0">
  <tr>
    <form id="form5" name="form5" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
    <td scope="col">
      <div align="left">
        <input type="submit" name="button6" id="button6" value="Cancelar" />
        </div>
    </td>
    </form>

  </tr>
</table>


<?php                   

                        break;
                case "reactivarcurso": // INICIO BLOQUE REACTIVAR CURSO

?>
<br />
<h2>Reactivar Curso en Tienda <?php echo "$ntpass"; ?></h2>
<span class="letra_predeterminadamargen">¿Deseas Reactivar este curso?</span><br /><br />

<div id="divContent1" style="position: relative; left: 26px;">
<table class="tblConfirmStd" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr> 
      <td>Folio</td>
      <td>Curso</td>
      <td>Cancelado En</td>
      <td>Fecha/Hora</td>
      <td>Estado</td>
      <td>Reactivar</td>
    </tr>
  </tbody>

<?php   

                $cols_arr      = array("idcurso",
                                        "curso",
                                        "fecha",
                                        "hora",
                                        "curs_csta.estado",
                                        "inmu_gdat.nombreinmu",
                                        "fechahoracancelado");
                $num_cols      = count($cols_arr);
                $join_tables   = '1';
                $tables_arr    = array("inmu_gdat",
                                       "curs_cdet",
                                       "curs_csta");
                $num_tables    = count($tables_arr);
                $on_fields_arr = array("idinmu", "idcursostat");
                $connect       = '1'; 
        
                $where_clause  = "idcurso = '$idcurpass'";

                $curso_busc_detalle = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                unset($join_tables);
                unset($num_tables);
                unset($on_fields_arr);
                unset($connect);
                unset($where_clause); 

                while($row=mysql_fetch_row($curso_busc_detalle)) {

?>

<form id="form5" name="form5" method="post" action="<?php echo $target_link; ?>" target="_self">
    <tr class="

<?php

  $oddevencheck = $cuentlin % 2;  
  
  if ($oddevencheck == 0) {
                echo "row_even";
  } else {
                echo "row_odd";
  }

?>  
    ">
        <td class="texto_celdas"><?php echo "$row[0]"; ?></td>
        <td class="texto_celdas"><?php echo "$row[1]"; ?></td>
        <td class="texto_celdas"><?php echo "$row[6]"; ?></td>
    <td class="texto_celdas"><?php echo "$row[2] $row[3]"; ?></td>
        <td class="texto_celdas"><?php echo "$row[4]"; ?></td>

      <td align="center"><input type="submit" name="button6" id="button6" value="Reactivar" />
          <input name="modact" type="hidden" id="hiddenField" value="reactivacurso" />
          <input name="modactlist" type="hidden" id="hiddenField19" value="cancelados" />
      <input name="idcurpass" type="hidden" id="hiddenField" value="<?php echo "$row[0]"; ?>" />
      <input name="ntpass" type="hidden" id="ntpass" value="<?php echo "$row[5]"; ?>" />
      <input name="ncpass" type="hidden" id="ncpass" value="<?php echo "$row[1]"; ?>" />
      <input name="sel_estado" type="hidden" id="sel_estado" value="2" />       </td>
        </tr>
</form>
<?php
$cuentlin++;
}

?>
</table>
</div>

<br />
<table class="tblBttnStd" border="0">
  <tr>
    <form id="form5" name="form5" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
    <td scope="col">
      <div align="left">
        <input type="submit" name="button6" id="button6" value="Cancelar" />
        </div>
    </td>
    </form>
  </tr>
</table>


<p>
  <?php

                        break; // CIERRE DE BLOQUE REACTIVARCURSO
                case "confirmelmcurso": // INICIO DE BLOQUR CONFIRMAELIMIARCURSO

?>
  
<br />
<h2>Confirma Eliminar Curso Cancelado</h2>
<span class="letra_predeterminadamargen">¿Deseas Elimnar este curso de la base de datos?</span><br /><br />
  
<p class="textoext">El curso <span class="curso"><?php echo "$ncpass"; ?></span> cancelado en la tienda <span class="tienda"><?php echo "$ntpass"; ?></span> folio no. <?php echo "<span class=\""; 
        switch($estado[0]) {
                case "Confirmado":
                        echo "confirmado";
                        break;
                case "Cancelado":       
                        echo "cancelado";
                        break;
                case "Por Confirmar":
                        echo "porconfirmar";
                        break;
        }
        echo "\">$idcurpass"; ?></span></p>
<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <form id="form38" name="form4" method="post" action="<?php echo $target_link; ?>" target="_self">
    <td align="left" scope="col">
      <label class="letra_predeterminada12">Confirma:</label>
      <input name="button" type="submit" id="button" value="SI"  />
      <input name="modact" type="hidden" id="modact" value="ejecutaelmcurso" />
      <input name="modactlist" type="hidden" id="modact3" value="curso" />
      <input name="ntpass" type="hidden" id="ntpass" value="<?php echo "$ntpass"; ?>" />
      <input name="idcurpass" type="hidden" id="idcurpass" value="<?php echo "$idcurpass"; ?>" />
      <input name="ncpass" type="hidden" id="ncpass" value="<?php echo "$ncpass"; ?>" />
    </td>
    </form>
    <form id="form39" name="form6" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
    <td align="left" scope="col">
      <input type="submit" name="button" id="button" value="NO" />
    </td>
    </form>
  </tr>
</table>
<p>
<?php

                        break; // CIERRE DE BLOQUE CONFIRMAELIMINARCURSO
        case "agrtecnico": // INICIO BLOQUE AGREGARTECNICO

                    if (isset($_SESSION['err_return'])) {
                                $invalid_check = $_SESSION['err_return']['invalid_check'];
                                $err_return = $_SESSION['err_return'];
                                foreach ($err_return as $nombre => $valor) {
                                        ${$nombre} = $valor;
                                } // Cierre foreach     
                        } 
                        unset($_SESSION['err_return']);

?>

<br />
<h2>Agregar Tecnico a la base de datos</h2>
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="left">
<form id="form21" name="form21" method="post" action="<?php echo $target_link; ?>" target="_self">
    <td>
        <label class="letra_predeterminada12">Nombre de nuevo Tecnico(a):</label>
        <input name="ntecpass" type="text" id="ntecpass"  value="<?php if ($invalid_check == '3') { echo "$ntecpass"; } ?>"/>
        <?php
        if ($error_id == "0" or $error_id == "1" or $error_id == "2") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
        ?>
        <label class="letra_predeterminada12"></label>
        <br />
        <label class="letra_predeterminada12">Dirección:</label>
        <input name="tecdirec" type="text" id="tecdirec" size="50" value="<?php if ($invalid_check == '3') { echo "$tecdirecc"; } ?>" />
        <br />
        <span class="letra_predeterminada12">Número Telefónico:</span>
        <input name="tectel" type="text" id="tectel" size="10" maxlength="10" value="<?php if ($invalid_check == '3') { echo "$tectel"; } ?>" />
        <?php
        if ($error_id == "3") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
        ?>
                <br />  
        <span class="letra_predeterminada12">Número Celular:</span>
        <input name="teccel" type="text" id="teccel" size="13" maxlength="13"  value="<?php if ($invalid_check == '3') { echo "$teccel"; } ?>" />
        <?php
        if ($error_id == "4") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
            ?>
                <br />  
        <span class="letra_predeterminada12">Correo Electronico:</span>
        <input name="correoe" type="text" id="correoe" size="20" value="<?php if ($invalid_check == '3') { echo "$correoe"; } ?>" />
        <?php
        if ($error_id == "5") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
            ?>
        <input name="modact" type="hidden" id="modact" value="agrtecnico" />
                <input name="modactlist" type="hidden" id="modact4" value="tecnicos" />
                <br />
        <input type="submit" name="button" id="button" value="Agregar" />

    </td>
   </form> 
  </tr>
</table>
<br />
<?php

                        break; // CIERRE DE BLOQUE AGREGARTECNICO
                case "editatecnico":    // INICIO BLOQUE EDITATECNICO                   

                    if (isset($_SESSION['err_return'])) {
                                $invalid_check = $_SESSION['err_return']['invalid_check'];
                                $err_return = $_SESSION['err_return'];
                                foreach ($err_return as $nombre => $valor) {
                                        ${$nombre} = $valor;
                                } // Cierre foreach     
                        } 
                        unset($_SESSION['err_return']);

?>                      

<br />
<h2>Editar Datos de Técnico(a) <?php echo "$ntecpass"; ?></h2>

<?php

                //                          0           1         2        3            
            $cols_arr      = array("direccion", "telefono", "cel", "correo");
        $num_cols      = count($cols_arr);
        $tables_arr    = array("curs_tecn");

                $where_clause  = "idtecnico = '$idtecpass'"; 

        $tecnico_edit = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                $row=mysql_fetch_row($tecnico_edit);

?>
                        
<table width="96%" border="0" align="center">
    <tr>
        <form id="form34" name="form1" method="post" action="<?php echo $target_link; ?>" target="_self">
      <td align="left" scope="col"><label class="letra_predeterminada12">Dirección:</label>
        <label>
        <input name="tecdirecc" type="text" id="dhora5" size="50" maxlength="70" value="<?php if ($invalid_check == '4') { echo "$tecdirecc"; } else { echo "$row[0]"; } ?>" />
        <br />
        </label>
        <label class="letra_predeterminada12">Número telefónico:</label>
        <label>
        <input name="tectel" type="text" id="ntecnico5" size="10" maxlength="10" value="<?php if ($invalid_check == '4') { echo "$tectel"; } else { echo "$row[1]"; } ?>" />
        </label>
        <label class="letra_predeterminada12">
        <?php
        if ($error_id == "0") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
        ?>
        <br />
        Número celular:</label>
        <label>
        <input name="teccel" type="text" id="ntecnico6" size="13" maxlength="13" value="<?php if ($invalid_check == '4') { echo "$teccel"; } else { echo "$row[2]"; } ?>" />
        <?php
        if ($error_id == "1") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
        ?>
        <br />
        </label>
        <label class="letra_predeterminada12">Correo Eléctronico:</label>
        <label>
        <input name="correoe" type="text" id="ntecnico7" size="30" value="<?php if ($invalid_check == '4') { echo "$correoe"; } else { echo "$row[3]"; } ?>" />
        <?php
        if ($error_id == "2") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
        ?>
        <br />
        <input type="submit" name="button2" id="button35" value="Actualizar Datos" />
        <input name="modact" type="hidden" id="hiddenField10" value="ejecutaedittec" />
                <input name="modactlist" type="hidden" id="modact4" value="tecnicos" />
        <input name="ntecpass" type="hidden" id="hiddenField11" value="<?php echo "$ntecpass"; ?>" />
        <input name="idtecpass" type="hidden" id="hiddenField12" value="<?php echo "$idtecpass"; ?>" />
          </label></td>
                </form>
    </tr>
  </table>

<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <form id="form35" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <td align="left" scope="col"><label> </label>
        
          <input type="submit" name="button25" id="button36" value="Cancelar" />
    </td>
    </form>
  </tr>
</table>


<?php

                        break; // CIERRE DE BLOQUE EDITATECNICO         
                case "confelmtec": // INICIO DE BLOQUE CONFIRMAELIMINACIONDETECNICO
                
?>

<br />
<h2>Eliminar Tecnico(a)</h2>

<p class="textoext">¿Estas seguro de querer eliminar al Tecnico(a): <span class="tienda"><?php echo "$ntecpass"; ?></span> de la base de datos?</p>

<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <form id="form32" name="form4" method="post" action="<?php echo $target_link; ?>" target="_self">
        <td align="left" scope="col">
      <label class="letra_predeterminada12">Confirma:</label>
      <input name="button24" type="submit" id="button33" value="SI"  />
      <input name="modact" type="hidden" id="modact7" value="ejecutaelmtec" />
      <input name="modactlist" type="hidden" id="modact6" value="tecnicos" />
      <input name="ntecpass" type="hidden" id="ntecpass" value="<?php echo "$ntecpass"; ?>" />
      <input name="idtecpass" type="hidden" id="idtpass2" value="<?php echo "$idtecpass"; ?>" /></td>
    </form>
    <form id="form33" name="form6" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <td align="left" scope="col">
      <input type="submit" name="button24" id="button34" value="NO" />    </td>
    </form>
  </tr>
</table>
<p><?php
                        break; // CIERRE DE BLOQUE CONFIRMA ELIMINARTECNICO
                case "agrlinea": // INICIO DE BLOQUE AGREGALINEA

                    if (isset($_SESSION['err_return'])) {
                                $invalid_check = $_SESSION['err_return']['invalid_check'];
                                $err_return = $_SESSION['err_return'];
                                foreach ($err_return as $nombre => $valor) {
                                        ${$nombre} = $valor;
                                } // Cierre foreach     
                        } 
                        unset($_SESSION['err_return']);

?>

<br />
<h2>Agregar L&iacute;nea de Productos(a)</h2>

<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="left">
    <form id="form27" name="form6" method="post" action="<?php echo $target_link; ?>" target="_self">
    <td scope="col">
        <label class="letra_predeterminada12">
        Ingresa el nombre de la nueva l&iacute;nea:</label>
        <input name="nlinpass" type="text" id="ntpass5" value="<?php if ($invalid_check == '5') { echo "$nlinpass"; } ?>" />
        <span class="letra_predeterminada12">
        <?php
        if ($error_id == "0" or $error_id == "1") {
                echo "<br /><span class=\"letra_alertaestado_nopadd\"><strong>Error: $errorpass</strong></span>";
        }
        ?>
        </span><br /><br />
        <input type="submit" name="button22" id="button28" value="Agregar" />
        <input name="modact" type="hidden" id="modact5" value="ejecutaagrlin" />
        <input name="modactlist" type="hidden" id="modactlist" value="lineas" /></td>
    </form>
  </tr>
</table>
<br />
<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" scope="col"><label> </label>
        <form id="form29" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
          <input type="submit" name="button22" id="button30" value="Cancelar" />
      </form></td>
  </tr>
</table>

<?php

                        break; // CIERRE DE BLOQUE AGREGALINEA
                case "confelmlin":  // INICIO DE BLOQUE CONFIRMAELIMINARLINEA

?>

<br />
<h2>Confirma Eliminar L&iacute;nea</h2>

<p class="textoext">¿Estas seguro de querer eliminar la l&iacute;nea: <span class="tienda"><?php echo "$nlinpass"; ?></span>?</p>
    
<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <form id="form38" name="form4" method="post" action="<?php echo $target_link; ?>" target="_self">
    <td align="left" scope="col">
      <label class="letra_predeterminada12">Confirma:</label>
      <input name="button26" type="submit" id="button39" value="SI"  />
      <input name="modact" type="hidden" id="modact8" value="ejecutaelmlin" />
      <input name="modactlist" type="hidden" id="modactlist" value="lineas" />
      <input name="nlinpass" type="hidden" id="nlinpass" value="<?php echo "$nlinpass"; ?>" />
      <input name="idlinpass" type="hidden" id="idtpass3" value="<?php echo "$idlinpass"; ?>" />
    </form>
    </td>
    <form id="form39" name="form6" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_self">
    <td align="left" scope="col">
      <input type="submit" name="button26" id="button40" value="NO" />
      <input name="modificar" type="hidden" id="modificar" value="agrlinea" />
    </td><br />
        </form>
  </tr>
</table>
<?php  

                        break; // CIERRE DE BLOQUE CONFIRMAELINIMARLINEA
                case "opbusqueda": // INICIO DE BLOQUE OPCIONESBUSQUEDA                 

?>

<br />
<h2>Opciones de B&uacute;squeda</h2>


<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
        <!-- FORMULARIO NO. 0 -->
    <form id="form0" name="form0" method="post" action="<?php echo $target_link2; ?>" target="<?php echo "$target_frame"; ?>">
    <td width="473" class="letra_predeterminada12">Busqueda por Tienda:
<label>
          <select name="sel_tienda" id="sel_tienda" onchange="javascript: buscaportienda()">
         
<?php

                $cols_arr     = array("idinmu", "nombreinmu");
        $num_cols     = count($cols_arr);
                $tables_arr   = array("inmu_gdat");
                $where_clause = "idinmutipo <> 5 AND idinmutipo <> 6 AND idinmustat = 1";
                $order            = "nombreinmu";

                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
//    $row=mysql_fetch_row($result);
        
                while($row=mysql_fetch_row($result)) {
                        echo "<option value=\"$row[0]\">$row[1]</option>";
                }   // cierre de While

?>
        </select>
        </label>
    <input type="hidden" name="busca" id="busca" value="portienda" /></td>
    </form>
        <td width="837" valign="middle" class="letra_predeterminada12"><label>Busquedas por Rango de Fechas:</label></td>
  </tr>
  <tr>
    <!-- FORMULARIO NO. 1 -->
        <form id="form1" name="form1" method="post" action="<?php echo $target_link2; ?>" target="<?php echo "$target_frame"; ?>">
    <td width="473" class="letra_predeterminada12">Busqueda por folio:
<label>
          <input class="input_predeterminada" name="folio" type="text" id="folio" size="3" maxlength="3" onchange="javascript: buscaporfolio()"/>
          <input name="busca" type="hidden" id="busca" value="porfolio" />
        </label>    </td>
    </form>

        <form id="rfecha1" name="rfecha1" method="post" action="<?php echo $target_link2; ?>" target="<?php echo "$target_frame"; ?>">
        <td><span class="letra_predeterminada12"> Fecha A Realizarse: 
        <label>
        <?php if ($invalid_check == "1") { $errorparam = $dfechar1; } escribe_formulario_fecha_vacio("dfechar1","rfecha1",$dfechar1); ?>
        </label>
a
<label><?php if ($invalid_check == "1") { $errorparam = $dfechar2; } escribe_formulario_fecha_vacio("dfechar2","rfecha1",$dfechar2); ?>
<input class="letra_boton11" type="submit" name="button5" id="button4" value="Busca" />
</label>
        <input type="hidden" name="busca" id="busca" value="porrangofechasr" />
        </span></td>
    </form>
  </tr>
  <tr>
    <!-- FORMULARIO NO. 3 -->
    <form id="form2" name="form2" method="post" action="<?php echo $target_link2; ?>" target="<?php echo "$target_frame"; ?>">
    <td width="473" class="letra_predeterminada12">Busqueda por Curso:
      <label>
    <input class="input_predeterminada" name="ncurso" type="text" id="ncurso" size="30" maxlength="30" onchange="javascript: buscaporcurso()"/>
    </label>
    <input type="hidden" name="busca" id="busca" value="porcurso" /></td>
    </form>
    
    <form id="rfecha2" name="rfecha2" method="post" action="<?php echo $target_link2; ?>" target="<?php echo "$target_frame"; ?>">
    <td><span class="letra_predeterminada12"> Fecha Alta:
        <?php if ($invalid_check == "1") { $errorparam = $dfechaa1; } escribe_formulario_fecha_vacio("dfechaa1","rfecha2",$dfechaa1); ?>
        <label></label>
a
<label><?php if ($invalid_check == "1") { $errorparam = $dfechaa2; } escribe_formulario_fecha_vacio("dfechaa2","rfecha2",$dfechaa2); ?>
<input class="letra_boton11" type="submit" name="button7" id="button8" value="Busca" />
</label>
<input type="hidden" name="busca" id="busca" value="porrangofechasa" />
    </span></td>
   </form>
  </tr>
  <tr>
    <!-- FORMULARIO NO. 5 -->
    <form id="form3" name="form3" method="post" action="<?php echo $target_link2; ?>" target="<?php echo "$target_frame"; ?>">
    <td width="473" class="letra_predeterminada12">Busqueda por  Tecnico(a):
      <label>
    <input class="input_predeterminada" name="nombretec" type="text" id="nombretec" size="30" maxlength="30" onchange="javascript: buscaporntec()"/>
    </label>
    <input type="hidden" name="busca" id="busca" value="pornombretec" /></td>
    </form>
    <form id="rfecha3" name="rfecha3" method="post" action="<?php echo $target_link2; ?>" target="<?php echo "$target_frame"; ?>">
    <td valign="top"><span class="letra_predeterminada12"> Fecha Cancelado:
        <?php if ($invalid_check == "1") { $errorparam = $dfechac1; } escribe_formulario_fecha_vacio("dfechac1","rfecha3",$dfechac1); ?>
        <label></label>
a
<label><?php if ($invalid_check == "1") { $errorparam = $dfechac2; } escribe_formulario_fecha_vacio("dfechac2","rfecha3",$dfechac2); ?>
<input class="letra_boton11" type="submit" name="button8" id="button11" value="Busca" />
</label>
    </span><span class="letra_predeterminada12">
    <input type="hidden" name="busca" id="busca" value="porrangofechasc" />
    </span></td>
    </form>
  </tr>
  <tr>
    <!-- FORMULARIO NO. 7 -->
    <form id="form4" name="form4" method="post" action="<?php echo $target_link2; ?>" target="<?php echo "$target_frame"; ?>">
    <td width="473" class="letra_predeterminada12">Busqueda por L&iacute;nea de Productos:
      <label>
    <input class="input_predeterminada" name="nombrelin" type="text" id="nombrelin" size="20" maxlength="20" onchange="javascript: buscapornlin()"/>
    </label>
    <input type="hidden" name="busca" id="busca" value="pornombrelin" /></td>
    </form>
    <td>&nbsp;</td>
  </tr>
</table>
<?php

                        break;
                default: // INICIO BLOQUE DEFAULT

?>
<br />
    <span class="letra_predeterminadamargen">Para modificar las propiedades de un curso elige el bot&oacute;n <strong>Modificar</strong> en la lista</span><br />
    
    <?php

        // Definicion de los parametros de la consulta
        $cols_arr    = array("COUNT(idcurso)");
        $num_cols    = count($cols_arr);
        $join_tables = '0';
        $tables_arr  = array("curs_cdet");
        $num_tables  = count($tables_arr);
//      $where_clause = "inmu_gdat.idinmutipo <> 5 AND inmu_gdat.idinmutipo <> 6";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row=mysql_fetch_row($result)
               
?>
    
    <br />
    <span class="letra_predeterminadamargen">No. de Cursos Registrados: <strong><?php echo "$row[0]"; ?></strong></span>
    
    <?php

        // Definicion de los parametros de la consulta
        $cols_arr     = array("COUNT(idcurso)");
        $num_cols     = count($cols_arr);
        $join_tables  = '0';
        $tables_arr   = array("curs_cdet");
        $num_tables   = count($tables_arr);
        $where_clause = "idcursostat <> 3";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row1=mysql_fetch_row($result)
               
?>      
    
    <br />
    <span class="letra_predeterminadamargen">No. de Cursos Activos: <strong><?php echo "$row1[0]"; ?></strong></span>
    
    <?php

        // Definicion de los parametros de la consulta
        $cols_arr     = array("COUNT(idcurso)");
        $num_cols     = count($cols_arr);
        $join_tables  = '0';
        $tables_arr   = array("curs_cdet");
        $num_tables   = count($tables_arr);
        $where_clause = "idcursostat = 3";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
                unset($where_clause);
                
        $row2=mysql_fetch_row($result);
               
?>      
    <br />
    <span class="letra_predeterminadamargen">No. de Cursos Cancelados: <strong><?php echo "$row2[0]"; ?></strong></span>
    <?php

        // Definicion de los parametros de la consulta
        $cols_arr = array("COUNT(idlinea)");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("curs_line");
        $num_tables = count($tables_arr);
//      $where_clause = "inmu_gdat.idinmutipo <> 5 AND inmu_gdat.idinmutipo <> 6 AND inmu_gdat.idinmustat = 2";

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row3=mysql_fetch_row($result)
               
?>
  <br />
    <span class="letra_predeterminadamargen" >No. de Lineas Registradas: <strong><?php echo "$row3[0]"; ?></strong></span>
    
    <?php

        // Definicion de los parametros de la consulta
        $cols_arr = array("COUNT(idtecnico)");
        $num_cols = count($cols_arr);
        $join_tables = '0';
        $tables_arr = array("curs_tecn");
        $num_tables = count($tables_arr);

        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
      
        $row3=mysql_fetch_row($result)
               
?>      
   
    <br />
<span class="letra_predeterminadamargen">No. de Tecnicos Registrados: <strong><?php echo "$row3[0]"; ?></strong></span> </p>

  <?php
                        break; // CIERRE DE BLOQUE DEFAULT
        } // CIERRE DE WHILE

?>
</body>
</html>
