<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../css/sistemaprobell.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="table.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cursos Probell - Datos Modificados</title>
<style type="text/css">
<!--
.tablaagruser {   
        padding-left: 26px;
        width: 300px;
}
-->
</style>
<script language="javascript">

        var target_link = "cursos_modificacurso.php";

        function actualizalista()
        {
                document.forms[0].submit();
                setTimeout ("redireccionar()", 8000);
        }

        function actualizalistacompleta()
        {
                document.forms[1].submit();
        }

        function redireccionar()
        {
                window.location.replace(target_link);
        }

 </script>

<link href="../../css/modulo.css" rel="stylesheet" type="text/css" />
</head>

<?php

        session_start();
        date_default_timezone_set('America/Mexico_City');

        // Incluye librerias 

        $ruta_funciones = $_SERVER['DOCUMENT_ROOT'].'/sistemaprobell/funciones/';
        include $ruta_funciones.'consultas.php';
        include $ruta_funciones.'valida_fechas.php';
        include $ruta_funciones.'valida_correo.php';
        
//      include "mensajes.php";//

        $hostname    = $_SESSION['hostname'];
        $rel_path    = 'administracion/cursos/';
        
        $target_link  = $hostname.$rel_path.'cursos_cursoslistado.php';
        $target_link2 = $hostname.$rel_path.'cursos_tecnicoslistado.php';
        $target_link3 = $hostname.$rel_path.'cursos_lineaslistado.php';

        $target_frame = "moduser_frame";


        /*echo "<span class=\"tipoletra\">Valores de _POST</span><br />";
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        print "<span class==\"tipoletra\">Nombre de la Variable: <strong>$nombre</strong> Valor: <strong>$valor</strong></span><br />"; 
                }
        }*/  

        // Convierte las variables del array $_POST en variables locales 
        foreach ($_POST as $nombre => $valor) {
                if(stristr($nombre, 'button') === FALSE) {
                        ${$nombre} = $valor;
                }
        } // Cierre foreach     
?>

<body <?php if ($modact <> "insertacurso") { echo 'onload="javascript: actualizalista()"'; } ?>>


<!-- FORMA NO. 0 -->

<form id="form0" name="form0" method="post" action="<?php switch($modactlist) {
                    case "curso": 
                            echo $target_link.'#fila'.$idcurpass; 
                            break; 
                    case "cancelados": 
                            echo $target_link.'#fila'.$idcurpass;
                            break;
                    case "tecnicos": 
                            echo $target_link2.'#fila'.$idtecpass; 
                            break;
                    case "lineas": 
                            echo $target_link3; 
                            break; 
              } ?>" target="<?php echo $target_frame; ?>">
<?php

        switch($modactlist) { 
                case "curso": 

?>

  <input name="sel_tcurso" type="hidden" id="sel_tcurso" value="activos" />

<?php
                        break;
                case "cancelados": 

?>

  <input name="sel_tcurso" type="hidden" id="sel_tcurso" value="cancelados" />

<?php
                        break;

                case "tecnicos":

?>

  <input name="sel_ttecnico" type="hidden" id="sel_ttecnico" value="activos" />

<?php

                        break;
                case "lineas": 

?>

  <input name="sel_tlinea" type="hidden" id="sel_tlinea" value="activos" />





<?php
                        break;
        }

?>

        </form><!-- FORMA DE ENVIO AUTOMATICO POR JAVASCRIPT -->


<?php

// BLOQUE INSERTA CURSO
        switch($modact)  {
                case "insertacurso":
                        /* --------------------------------------- INICIA VALIDACION DE DATOS ---------------------------- */
                        if (trim($_POST['mntpass']) == "Selecciona una Tienda") {
                                $error = "Debes elegir la tienda donde se dar&aacute; de alta el curso";
                                $error_id = 0;
                        } else {
                                if (trim($_POST['ncurso']) == "") {     
                                        $error = "Ingresa un nombre para el curso";
                                        $error_id = "1"; 
                                } else {        
                                        if (is_numeric($ncurso)) {      
                                                $error = "El nombre del curso necesita ser un una cadena de caracteres";
                                                $error_id = "2";
                                        } else {
                                                if ($nlinea == "Selecciona Una Línea") {       
                                                        $error = "Debes seleccionar una l&iacute;nea de productos";
                                                        $error_id = "3";
                                                } else {         
                                                        if (trim($_POST['dfecha']) == "") {     
                                                                $error = "Ingresa una fecha en el formato indicado o dando clic en el boton seleccionar fecha";
                                                                $error_id = "4";
                                                        } else {         
                                        $checa_fecha = checkDateFormat($dfecha);

//                                      if ($dfecha <> '') { 
                                    if (($checa_fecha == false)) {
                                    $error    = "Error en la fecha fecha introducida, el formato es AAAA-MM-DD (año, mes, dia) y debe ser v&aacute;lida";
                                                                        $error_id = "5";
//                                                              }       
                                                                } else {
                                                                        
                                                                        // Convertimos la fecha actual a segundos
                                                                        $fecha_actual=mktime(0,0,0,date('m'),date('d'),date('Y'));
                                                                                
                                                                        $fecha_ingresada = $dfecha;
                                                                                
                                                                        # separamos los valores de la fecha con la que queremos operar
                                                                        list($año,$mes,$dia)=explode('-',$fecha_ingresada);

                                                                        # redefinimos la variable $fecha_operar y le almacenamos el valor unix
                                                                        $fecha_ingresada=mktime(0,0,0,$mes,$dia,$año);                                                                 
                                                                        
                                                                        if ($fecha_ingresada < $fecha_actual){
                                            $error    = "No se pueden dar de alta cursos que \"sucedan en el pasado\"";
                                                                                $error_id = "6";
                                                                        } else {
                                                                        
                                                                                if (trim($_POST['dhora']) == "Elige una Hora") {        
                                                                                        $error = "Elige una hora de inicio del curso";
                                                                                        $error_id = "7";
                                                                                } else {
                                                                                        if (trim($_POST['ntecnico']) == "Selecciona Un Técnico") {     
                                                                                                $error = "Elige el tecnico que impartir&aacute; el curso";
                                                                                                $error_id = "8";
                                                                                        }
                                                                                }       
                                                                        }       
                                }
                                }
                                                }       
                                        }
                                }               
                        }
                        /* ---------------------------------------- TERMINA VALIDACION DE DATOS ---------------------------- */

                        if (isset($error)) {
        
                                $_SESSION['err_return'] = array("errorpass" => "$error", "error_id" => "$error_id", "mntpass" => "$mntpass", "ncurso" => "$ncurso", "nlinea" => "$nlinea", "dfecha" => "$dfecha", "dhora" => "$dhora", "ntecnico" => "$ntecnico", "destado" => "$destado", "dobserv" => "$dobserv", "invalid_check"=> "1");

                                header("Location: ".$_SERVER['HTTP_REFERER']."");
                                exit();
                        }
//      }                                       

        
/* ------------------  INSERTA LOS DATOS EN LA BASE ------------- */                     

                
                // Inserta información del curso en la base de datos
                $colsarr = array("idcurso", "idinmu", "curso", "idlinea", "fecha", "hora", "idtecnico", "idcursostat", "fechahoraalta", "observaciones");
                $numcols = count($colsarr);
                $valarr  = array("NULL", "'$mntpass'", "'$ncurso'", "'$nlinea'", "'$dfecha'", "'$dhora'", "'$ntecnico'", "'$destado'", "CURRENT_TIMESTAMP", "'$dobserv'");
                $aff_table = "curs_cdet";

                $inserta_curso = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 


?>
<br />
<h2>Curso Dado de Alta</h2>
  <br />
<span class="titulos">Detalle del alta de curso</span><br />

<?php

        // Recuperar idcurso
        $cols_arr      = array("MAX(idcurso)");
        $num_cols      = count($cols_arr);
        $tables_arr    = array("curs_cdet");

        $enc_id_curso = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

    $curso_id=mysql_fetch_row($enc_id_curso);

                        break; // CIERRE DE BLOQUE INSERTA CURSO
                case "actcurso":  // INICIO BLOQUE ACTCURSO     
                        /* --------------------------------------- INICIA VALIDACION DE DATOS ---------------------------- */
                        if (trim($_POST['ncurso']) == "") {     
                                $error = "Ingresa un nombre para el curso";
                                $error_id = "0"; 
                        } else {        
                                if (is_numeric($ncurso)) {      
                                        $error = "El nombre del curso necesita ser una cadena de caracteres";
                                        $error_id = "1";
                                } else {
                                        if (trim($_POST['dfecha']) == "") {     
                                                $error = "Ingresa una fecha en el formato indicado o dando clic en el boton seleccionar fecha";
                                                $error_id = "2";
                                        } else {         
                                                $checa_fecha = checkDateFormat($dfecha);

                        if (($checa_fecha == false)) {
                                $error    = "Error en la fecha fecha introducida, el formato es AAAA-MM-DD (año, mes, dia) y debe ser v&aacute;lida";
                                                        $error_id = "3";
                                                } else {
                                                                        
                                                        // Convertimos la fecha actual a segundos
                                                        $fecha_actual=mktime(0,0,0,date('m'),date('d'),date('Y'));
                                                                                
                                                        $fecha_ingresada = $dfecha;
                                                                                
                                                        # separamos los valores de la fecha con la que queremos operar
                                                        list($año,$mes,$dia)=explode('-',$fecha_ingresada);

                                                        # redefinimos la variable $fecha_operar y le almacenamos el valor unix
                                                        $fecha_ingresada=mktime(0,0,0,$mes,$dia,$año);                                                                 
                                                                        
                                                        if ($fecha_ingresada < $fecha_actual){
                                    $error    = "No se le puede dar una fecha \"en el pasado\" al curso";
                                                                $error_id = "4";
                                                        } 
                                                }       
                                        }
                                }               
                        }
                        /* ---------------------------------------- TERMINA VALIDACION DE DATOS ---------------------------- */

                        if (isset($error)) {
                                

                                $_SESSION['err_return'] = array("errorpass" => "$error", "error_id" => "$error_id", "ncurso" => "$ncurso", "nlinea" => "$nlinea", "dfecha" => "$dfecha", "dhora" => "$dhora", "ntecnico" => "$ntecnico", "dobserv" => "$dobserv", "modificar" => "$modificarpass", "ntpass" => "$ntpass", "idcurpass" => "$idcurpass", "invalid_check"=> "2");
                                
                                header("Location: ".$_SERVER['HTTP_REFERER']."");
                                exit();
                        }
                        

/* ------------------  ACTUALIZA LOS DATOS EN LA BASE ------------- */                   

                        $aff_table = "curs_cdet";
                        $colsvalarr = array("curso = '$ncurso'", "idlinea = '$nlinea'", "fecha = '$dfecha'", "hora = '$dhora'", "idtecnico = '$ntecnico'", "observaciones = '$dobserv'");
                        $numcols = count($colsvalarr);
                        $where_clause = "idcurso = '$idcurpass'";

                        $result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 

                        $curso_id = $idcurpass;

?>

<br />
<h2>Datos de Curso Modificados</h2>
<span class="titulos">El curso ha realizarse en la tienda <?php echo "$ntpass"; ?> ha sido actualizado</span><br />

<?php

                        break; // CIERRE DE BLOQUE ACTCURSO
                case "actestado":  // INICIA BLOQUE ACTESTADO

?>
<br />
<h2>Estado del curso modificado</h2>

<?php

                        if ($sel_estado == '3') {       
                                if (!isset($motivo_esp)) {
                                        $_SESSION['motiv_return'] = array("modificar" => "motivocancela", "modact" => "$modact", "modactlist" => "$modactlist", "idcurpass" => "$idcurpass", "ntpass" => "$ntpass", "ncpass" => "$ncpass", "sel_estado" => "$sel_estado");
                                        header("Location: ".$_SERVER['HTTP_REFERER']."");
                                        exit();
                                } else if ($motivo_esp == '1') {
                                        if (trim($_POST['motivocancela']) == "") {      
                                                $error = "Debes especificar el motivo por el cual se cancelar&aacute; este curso";
                                                $error_id = "0"; 
                                        }       

                                        if (isset($error)) {
                                                $_SESSION['err_return'] = array("errorpass" => "$error", "error_id" => "$error_id", "modificar" => "motivocancela", "modact" => "$modact", "modactlist" => "$modactlist", "idcurpass" => "$idcurpass", "ntpass" => "$ntpass", "ncpass" => "$ncpass", "sel_estado" => "$sel_estado", "invalid_check"=> "6");
                                                header("Location: ".$_SERVER['HTTP_REFERER']."");
                                                exit();
                                        }
                                } //Cierre de Switch                    
                        }

        // Consulta para actualizar el estado de los cursos
        $aff_table = "curs_cdet";
        if ($sel_estado == "3") {       
                $colsvalarr = array("idcursostat = '$sel_estado'", "fechahoramodificado = CURRENT_TIMESTAMP", "fechahoracancelado = CURRENT_TIMESTAMP", "motivocancelacion = '$motivocancela'");
        } else {
                $colsvalarr = array("idcursostat = '$sel_estado'", "fechahoramodificado = CURRENT_TIMESTAMP");
        }       
        $numcols = count($colsvalarr);
        $where_clause = "idcurso = '$idcurpass'";

        $act_estado = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 
                        
        $cols_arr      = array("estado");
        $num_cols      = count($cols_arr);
        $join_tables   = '1';
        $tables_arr    = array("curs_cdet", "curs_csta");
        $num_tables    = count($tables_arr);
        $on_fields_arr = array("idcursostat");
        $connect       = '1';

        $where_clause  = "idcurso = '$idcurpass'";

        $curso_stat = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        $estado=mysql_fetch_row($curso_stat);           
                        
// Cuadro de anuncio de cambios
?>
<p class="textoext">El estado del curso de <span class="curso"><?php echo "$ncpass"; ?></span> en la tienda <span class="tienda"><?php echo "$ntpass"; ?></span> se actualizado a: <?php echo "<span class=\""; 
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
        echo "\">$estado[0]"; ?></span></p>
<span class="titulos">El Folio del curso es: <span class="folio"><?php echo "$idcurpass"; ?></span></span><br /><br />
<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr>

<?php

        if ($sel_estado == "1" or $sel_estado == "2") {

?>

        <form id="form1" name="form1" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>">
    <th align="center" scope="col">
      <label>
      <input type="submit" name="button" id="button" value="Modificar Curso" />
      <input name="modificar" type="hidden" id="hiddenField" value="moddatosform" />
      </label>
      <input name="idcurpass" type="hidden" id="idcurpass" value="<?php echo "$idcurpass"; ?>" />
      <input name="ntpass" type="hidden" id="ntpass" value="<?php echo "$ntpass";  ?>" /></th>
    </form>   
    <form id="form3" name="form3" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>">
        <th align="center" scope="col">
          <label>
            <input type="submit" name="button3" id="button3" value="Cambiar Estado" />
            <input name="idcurpass" type="hidden" value="<?php echo "$idcurpass"; ?>" />
        <input name="modificar" type="hidden" value="cambiaestado" />
        <input name="ntpass" type="hidden" value="<?php echo "$ntpass"; ?>" />
            </label>    </th>
    </form>
    

<?php
        
        } // Cierre de if       

        if ($sel_estado == "3") {

?>        

        <form id="form1" name="form1" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>">
    <th align="center" scope="col">
      <label>
      <input type="submit" name="button" id="button" value="Reactivar Curso" />
      <input name="idcurpass" type="hidden" value="<?php echo "$idcurpass"; ?>" />
      <input name="modificar" type="hidden" value="reactivarcurso" />
      <input name="ntpass" type="hidden" value="<?php echo "$ntpass"; ?>" />
      </label>     </th>
    </form>
    <form id="form3" name="form3" method="post" action="<?php // echo $_SERVER['HTTP_REFERER']; ?>">
        <th align="center" scope="col">
          <label>
            <input type="submit" name="button3" id="button3" value="Eliminar Curso" />
        <input name="idcurpass" type="hidden" value="<?php echo "$idcurpass"; ?>" />
        <input name="modificar" type="hidden" value="confirmelmcurso" />
        <input name="ncpass" type="hidden" value="<?php echo "$row[2]"; ?>" />
        <input name="ntpass" type="hidden" value="<?php echo "$ncpass"; ?>" /></td>
            </label>    </th>
    </form>


<?php

        }

?>


        <form id="form5" name="form5" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>" target="_self">
    <th align="left" scope="col">
      <input type="submit" name="button2" id="button2" value="Continuar" onclick="javascript: actualizalistacompleta()" />    </th>
    </form>
  </tr>
</table>
<?php
                        break; // CIERRE DE BLOQUE ACTESTADO
                case "reactivacurso" // INICIA BLOQUE REACTIVARCURSO

?>

<br />
<h2>Curso Reactivado</h2>

<?php

        // Consulta para actualizar el estado de los cursos
        $aff_table = "curs_cdet";
        $colsvalarr = array("idcursostat = '2'",
                            "fechahoramodificado = CURRENT_TIMESTAMP",
                            "fechahoracancelado = '0000-00-00 00:00:00'",
                            "motivocancelacion = NULL");
        $numcols = count($colsvalarr);
        $where_clause = "idcurso = '$idcurpass'";

        $reactivado = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 
                        
        $cols_arr      = array("estado");
        $num_cols      = count($cols_arr);
        $join_tables   = '1';
        $tables_arr    = array("curs_cdet", "curs_csta");
        $num_tables    = count($tables_arr);
        $on_fields_arr = array("idcursostat");
        $connect       = '1';

        $where_clause  = "idcurso = '$idcurpass'";

        $curso_stat = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

        $estado=mysql_fetch_row($curso_stat);           

// Cuadro de anuncio de cambios
?>
<p class="textoext">El curso <span class="curso"><?php echo "$ncpass"; ?></span> en la tienda <span class="tienda"><?php echo "$ntpass"; ?></span> fué reactivado con el estado: <?php echo "<span class=\""; 
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
        echo "\">$estado[0]"; ?></span></p>
<span class="titulos">El Folio del curso es: <span class="folio"><?php echo "$idcurpass"; ?></span></span><br /><br />
<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr>
        <form id="form5" name="form5" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>" target="_self">
    <th align="center" scope="col">
      <input type="submit" name="button2" id="button2" value="Continuar" />    </th>
    </form>
  </tr>
</table>
<?php
                        break; // CIERRE DE BLOQUE REACTIVACURSO
                case "ejecutaelmcurso" // INICIA BLOQUE ELIMINACURSO

?>

<br />
<h2>Curso Eliminado</h2>

<?php

        // Consulta para actualizar el estado de los cursos

        $aff_table = "curs_cdet";
        $colsvalarr = array("idcursostat = '4'");
        $numcols = count($colsvalarr);
        $where_clause = "idcurso = '$idcurpass'";

        $eliminado = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 


        /*$aff_table = "curs_cdet";
        $where_clause = "idcurso = '$idcurpass'";

        $eliminado = gnrl_delete_query($aff_table, $where_clause);*/

// Cuadro de anuncio de cambios
?>
<p class="textoext">El curso <span class="curso"><?php echo "$ncpass"; ?></span> en la tienda <span class="tienda"><?php echo "$ntpass"; ?></span> fu&eacute; eliminado de la base de datos.</span></p>

<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr>
        <form id="form5" name="form5" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>" target="_self">
    <th align="center" scope="col">
      <input type="submit" name="button" id="button" value="Continuar" /></th>
    
        </form>
  </tr>
</table>
<?php
                        break; // CIERRE DE BLOQUE EJECUTAELIMINARCURSO
                case "agrtecnico": // INICIA BLOQUE AGREGATECNICO

                        /* --------------------------------------- INICIA VALIDACION DE DATOS ---------------------------- */
                        if (trim($_POST['ntecpass']) == "") {   
                                $error = "Ingresa un nombre para el t&eacute;cnico";
                                $error_id = "0"; 
                        } else {        
                                if (is_numeric($ncurso)) {      
                                        $error = "El nombre del tecnico debe ser una cadena de caracteres";
                                        $error_id = "1";
                                } else {
                        
                                        // Comprobar nombre de usuario contra la base de usuarios
                                        $cols_arr      = array("nombretec");
                                        $num_cols      = count($cols_arr);
                                        $tables_arr    = array("curs_tecn");

                                        $where_clause  = "nombretec = '$ntecpass'";

                                        $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                                        $ntecpass = strtolower($ntecpass);
                                        $ntecpass = ucwords($ntecpass);
                                        $tempstr_b = $ntecpass;
                                        $tempstr_b = strtolower($tempstr_b);
                                        
                                        $row=mysql_fetch_row($result);
                                        $tempstr_a = $row[0];   
                                        $tempstr_a = strtolower($tempstr_a);
                                        if ($tempstr_a == $tempstr_b) {
                                                $evennm = "1";
                                        } // Cierre de if
                
                                        if ($evennm == "1") {
                                                $error = "Este t&eacute;cnico o t&eacute;cnica ya existe en la base de datos";
                                        $error_id = 2;
//                                              $encargado = strtolower($encargado);
//                                              $encargado = ucwords($encargado);
                                        } else {
                                        
                                                if (trim($_POST['tectel']) <> "" and !is_numeric($tectel)) {    
                                                        $error = "El dato necesita ser un n&uacute;mero";
                                                        $error_id = "3"; 
                                                } else {

                                                        if (trim($_POST['teccel']) <> "" and !is_numeric($teccel)) {    
                                                                $error = "El dato necesita ser un n&uacute;mero";
                                                                $error_id = "4"; 
                                                        } else {
                                                                if (trim($_POST['correoe']) <> "" and comprobar_email($correoe) == "0") { 
                                                                $error = "Hay un error en la escritura de esta direcci&oacute;n de correo";
                                                            $error_id = 5;
                                                                }       
                                                        }       
                                                }
                                        }
                                }               
                        }
                        /* ---------------------------------------- TERMINA VALIDACION DE DATOS ---------------------------- */

                        if (isset($error)) {
                                

/*                      Nombre de la Variable: ntecpass Valor: 
                        Nombre de la Variable: tecdirec Valor: 
                        Nombre de la Variable: tectel Valor: 
                        Nombre de la Variable: teccel Valor: 
                        Nombre de la Variable: correoe Valor: 
                        Nombre de la Variable: modact Valor: agrtecnico */


                        $_SESSION['err_return'] = array("errorpass" => "$error", "error_id" => "$error_id", "ntecpass" => "$ntecpass", "tecdirec" => "$tecdirec", "tectel" => "$tectel", "teccel" => "$teccel", "correoe" => "$correoe", "modificar" => "$modact", "invalid_check"=> "3");
                                
                                header("Location: ".$_SERVER['HTTP_REFERER']."");
                                exit();
                        }
                        

/* ------------------  AGREGA TECNICO(A) A LA BASE DE DATOS ------------- */                     


                // Inserta información del curso en la base de datos
                $colsarr = array("idtecnico", "nombretec", "direccion", "telefono", "cel", "correo", "fechaalta", "activo");
                $numcols = count($colsarr);
                $valarr  = array("NULL", "'$ntecpass'", "'$tecdirec'", "'$tectel'", "'$teccel'", "'$correoe'", "CURRENT_TIMESTAMP", "'1'"); 
                $aff_table = "curs_tecn";

                $inserta_tecnico = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

                $cols_arr   = array("MAX(idtecnico)");
                $num_cols   = count($cols_arr);
                $tables_arr = array("curs_tecn");

                $tec_id     = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

            $idtecpass=mysql_fetch_row($tec_id);

?>

<br />
<h2>Tecnico(a) Agregado</h2>
<p class="textoext">El T&eacute;cnico o la T&eacute;cnica <span class="tienda"><?php echo "$ntecpass"; ?></span> ha sido agregado(a) a la base de datos, <br />ahora puede ser elegido ha para impartir cursos</p>
<br />
<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr>
        <form id="form20" name="form4" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>">
    <th align="left" scope="col">
      <input type="submit" name="button" id="button" value="Agregar Nuevo Técnico" />
      <input name="modificar" type="hidden" id="modificar" value="agrtecnico" />
    </th>
    </form>
        <form id="form20" name="form4" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>">
    <th align="left" scope="col">
      <input type="submit" name="button" id="button" value="Editar T&eacute;cnico(a)" />
      <input name="modificar" type="hidden" id="modificar2" value="editatecnico" />
          <input name="idtecpass" type="hidden" id="iderr" value="<?php echo "$idtecpass[0]"; ?>" />
          <input name="ntecpass" type="hidden" id="iderr" value="<?php echo "$ntecpass"; ?>" />    </th>
    </form>
    <form id="form21" name="form6" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <th align="left" scope="col">
      <input type="submit" name="button14" id="button18" value="Continuar" />    </th><br />
        </form>
  </tr>
</table>

<?php 

                        break; // CIERRE DE BLOQUE AGREGATECNICO
                case "ejecutaedittec": // INICIA BLOQUE EJECUTAEDITATECNICO

                        /* --------------------------------------- INICIA VALIDACION DE DATOS ---------------------------- */
                
                        if (trim($_POST['tectel']) <> "" and !is_numeric($tectel)) {    
                                $error = "El dato necesita ser un n&uacute;mero";
                                $error_id = "0"; 
                        } else {
                                if (trim($_POST['teccel']) <> "" and !is_numeric($teccel)) {    
                                        $error = "El dato necesita ser un n&uacute;mero";
                                        $error_id = "1"; 
                                } else {
                                        if (comprobar_email($correoe) == "0") { 
                                                $error = "Hay un error en la escritura de esta direcci&oacute;n de correo";
                                            $error_id = 2;
                                        }       
                                }       
                        }

                        /* ---------------------------------------- TERMINA VALIDACION DE DATOS ---------------------------- */

                        if (isset($error)) {
                                

                        $_SESSION['err_return'] = array("errorpass" => "$error", "error_id" => "$error_id", "tecdirecc" => "$tecdirecc", "tectel" => "$tectel", "teccel" => "$teccel", "correoe" => "$correoe", "modificar" => "editatecnico", "invalid_check" => "4");
                                
                                header("Location: ".$_SERVER['HTTP_REFERER']."");
                                exit();
                        }

                        // Consulta para actualizar el estado de los cursos
                        $aff_table = "curs_tecn";
                        $colsvalarr = array("direccion = '$tecdirecc'",
						                     "telefono = '$tectel'", 
											 "cel = '$teccel'", 
											 "correo = '$correoe'");
                        $numcols = count($colsvalarr);
                        $where_clause = "curs_tecn.idtecnico = '$idtecpass'";

                        $actualiza_tecnico = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 

?>

<br />
<h2>Datos de T&eacute;cnico(a) actualizados</h2>

<p class="textoext">Los datos del Tecnico(a) <?php echo "$ntecpass"; ?> han sido actualizados.</p>
<br />
<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <form id="form16" name="form16" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>">
    <th align="left" scope="col">
      <input name="button" type="submit" id="button" value="Editar De Nuevo" />
      <input name="modificar" type="hidden" id="modificar" value="editatecnico" />
      <input name="idtecpass" type="hidden" id="iderr3" value="<?php echo "$idtecpass"; ?>" />
      <input name="ntecpass" type="hidden" id="iderr3" value="<?php echo "$ntecpass"; ?>" /></th>
    </form>
    <form id="form16" name="form16" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <th align="left" scope="col"><input type="submit" name="button" id="button" value="Continuar" /> 
    </th>
    </form>
  </tr>
</table>

<?php 

                        break; // CIERRLE DE BLOQUE EJECUTAEDITARTECNICO
                case "ejecutaelmtec": // INICIA BLOQUE EJECUTAELIMINARTECNICO

                        
                        /*$cols_arr     = array("idcurso");
                        $num_cols     = count($cols_arr);
                        $tables_arr   = array("curs_cdet");
                        $where_clause = "idtecnico = '$ntecpass'";

                        $tecnico_con_cursos = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);
                        
                        if (mysql_num_rows($result) > 0) {*/
?>

<!--<br />
<h2>No se puede Eliminar T&eacute;cnico</h2>                            

<p class="textoext">Aún existen cursos asociados al Ténico<span class="tienda"><?php // echo "$ntecpass"; ?></span> y no puede ser eliminado, ha sido eliminado(a) de la base de datos</p>-->

                        
<?php           
                        // Consulta eliminar el registro del tecnico deseado
                        $aff_table = "curs_tecn";
                        $where_clause = "idtecnico = '$idtecpass'";
                        
                        $elimina_tecnico = gnrl_delete_query($aff_table, $where_clause);



?>

<br />
<h2>T&eacute;cnico Eliminado</h2>

<p class="textoext">El tecnico <span class="tienda"><?php echo "$ntecpass"; ?></span> ha sido eliminado(a) de la base de datos</p>

<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <form id="form6" name="form16" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <th align="left" scope="col"><input type="submit" name="button4" id="button4" value="Continuar" />
      </th>
    </form>
  </tr>
</table>

<?php 

                        break; // CIERRE DE BLOQUE EJECUTAELIMINARTECNICO 
                case "ejecutaagrlin": // INICIO DE BLOQUE EJECUTAAGREGARLINEA

                        /* --------------------------------------- INICIA VALIDACION DE DATOS ---------------------------- */

                        if (trim($_POST['nlinpass']) == "") {   
                                $error = "Teclea el nombre de una l&iacute;nea para agregarla";
                                $error_id = "0"; 
                        } else {

                                // Comprobar nombre de la linea contra la base de usuarios
                                $cols_arr      = array("nlinea");
                                $num_cols      = count($cols_arr);
                                $tables_arr    = array("curs_line");

                                $where_clause  = "nlinea = '$nlinpass'";

                                $result = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);

                                $nlinpass = strtolower($nlinpass);
                                $nlinpass = ucwords($nlinpass);
                                $tempstr_b = $nlinpass;
                                $tempstr_b = strtolower($tempstr_b);
                                        
                                $row=mysql_fetch_row($result);
                                $tempstr_a = $row[0];   
                                $tempstr_a = strtolower($tempstr_a);
                                if ($tempstr_a == $tempstr_b) {
                                        $evennm = "1";
                                } // Cierre de if
                
                                if ($evennm == "1") {
                                        $error = "Esta L&iacute;nea ya existe en la base de datos";
                                $error_id = 1;
                                }       
                        }

                        /* ---------------------------------------- TERMINA VALIDACION DE DATOS ---------------------------- */

                        if (isset($error)) {
                                

                        $_SESSION['err_return'] = array("errorpass" => "$error", "error_id" => "$error_id", "nlinpass" => "$nlinpass", "modificar" => "agrlinea", "invalid_check" => "5");
                                
                                header("Location: ".$_SERVER['HTTP_REFERER']."");
                                exit();
                        }

                        // Inserta información de la linea en la base de datos
                        $colsarr = array("idlinea", "nlinea", "fechaalta", "activo");
                        $numcols = count($colsarr);
                        $valarr  = array("NULL", "'$nlinpass'", "CURRENT_TIMESTAMP", "'1'"); 
                        $aff_table = "curs_line";

                        $inserta_linea = gnrl_insert_query($numcols, $colsarr, $valarr, $aff_table); 

?>

<br />
<h2> L&iacute;nea Agregada</h2>

<p class="textoext">La L&iacute;nea <span class="tienda"><?php echo "$nlinpass"; ?></span> ha sido agregada a la base de datos, <br />ahora puede ser elegida para especificar la l&iacute;nea al dar de alta un curso</p>
<br />
<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <form id="form22" name="form4" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>" target="_self">
    <th align="left" scope="col">
       <input type="submit" name="button" id="button" value="Agregar Nueva L&iacute;nea" />
      <input name="modificar" type="hidden" id="modificar" value="agrlinea" />
        </th>
    </form>
    <form id="form22" name="form4" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>" target="_self">
    <th align="left" scope="col">
      <input type="submit" name="button" id="button" value="Eliminar L&iacute;nea" />
      <input name="modificar" type="hidden" id="modificar3" value="confelmlin" />
      <input name="idlinpass" type="hidden" id="iderr2" value="<?php echo "$idlinpass"; ?>" />
      <input name="nlinpass" type="hidden" id="iderr4" value="<?php echo "$nlinpass"; ?>" /></th>
    </form>
    <form id="form23" name="form6" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>" target="_self">
    <th align="left" scope="col">
      <input type="submit" name="button" id="button" value="Continuar" />    </th>
    </form>
  </tr>
</table>

<?php 

                        break; // CIERRE DE BLOQUE EJECUTAAGREGARLINEA
                case "ejecutaelmlin": // INICIO DE BLOQUE EJECUTAELIMINARLINEA

                        // Consulta eliminar el registro del tecnico deseado
                        $aff_table = "curs_line";
                        $where_clause = "idlinea = '$idlinpass'";
                        
                        $elimina_tecnico = gnrl_delete_query($aff_table, $where_clause);


            // ALTER TABLE `sucr_tlog` MODIFY COLUMN `idtras` INTEGER UNSIGNED DEFAULT NULL, DROP PRIMARY KEY;
//            $aff_table = "curs_tecn";
/*            $action = "MODIFY COLUMN `idlinea`";
            $modifiers = "INTEGER UNSIGNED DEFAULT NULL, DROP PRIMARY KEY";

            $result = gnrl_altertable_query($aff_table, $action, $modifiers);       
                
            // ALTER TABLE `sucr_tlog` AUTO_INCREMENT = 0;
            $action = "AUTO_INCREMENT = 0";
            $modifiers = "";

            $result = gnrl_altertable_query($aff_table, $action, $modifiers);       

                // ALTER TABLE `sucr_tlog` ADD COLUMN `idtrastemp` INTEGER UNSIGNED NOT NULL DEFAULT NULL AUTO_INCREMENT AFTER `idtras`, ADD PRIMARY KEY (`idtrastemp`);
            $action = "ADD COLUMN `idlineatemp`";
            $modifiers = "INTEGER UNSIGNED NOT NULL DEFAULT NULL AUTO_INCREMENT AFTER `idlinea`, ADD PRIMARY KEY (`idlineatemp`)";

            $result = gnrl_altertable_query($aff_table, $action, $modifiers);       

            // ALTER TABLE `sucr_tlog` DROP COLUMN `idtras`;
            $action = "DROP COLUMN `idlinea`";
            $modifiers = "";

            $result = gnrl_altertable_query($aff_table, $action, $modifiers);       

            // ALTER TABLE sucr_tlog CHANGE idtrastemp idtras INTEGER UNSIGNED AUTO_INCREMENT;                
            $action = "CHANGE idlineatemp idlinea";
            $modifiers = "INTEGER UNSIGNED AUTO_INCREMENT";

            $result = gnrl_altertable_query($aff_table, $action, $modifiers);*/       
                
?>
<br />
<h2>L&iacute;nea Eliminada</h2>

<p class="textoext">La L&iacute;nea <span class="tienda"><?php echo "$nlinpass"; ?></span> ha sido eliminada de la base de datos.</p>

<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <form id="form28" name="form6" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>" target="_self">
    <th width="82%" align="left" scope="col">
      <input type="submit" name="button" id="button" value="Continuar" />
    </th>
    </form>
  </tr>
</table>

<?php 

                        break; // CIERRE DE BLOQUE EJECUTAELIMINARLINEA
        } // CIERRE DE SWITCH


// ----------------------------- MUDULOS DE RESULTADOS COMUNES  ------------------------------------

        // Consulta sobre el curso insertado/modificado 
        $cols_arr      = array("inmu_gdat.idinmu", 
                               "inmu_gdat.nombreinmu",
                               "curso",
                               "nlinea",
                               "fecha",
                               "hora",
                               "nombretec",
                               "curs_csta.estado",
                               "observaciones",
                               "idcurso");
        $num_cols      = count($cols_arr);
        $join_tables   = '1';
        $tables_arr    = array("inmu_gdat",
                               "curs_cdet",
                               "curs_line",
                               "curs_tecn",
                               "curs_csta");
        $num_tables    = count($tables_arr);
        $on_fields_arr = array("idinmu",
                               "idlinea",
                               "idtecnico",
                               "idcursostat");
        $connect       = '1';

        switch ($modact) {
                case "insertacurso":
                        $where_clause = "curs_cdet.idcurso = '$curso_id[0]'";
                        break;
                case "actcurso":
                        $where_clause = "curs_cdet.idcurso = '$curso_id'";
                        break;
        }

        $curso_ins_detalle = select_gnrl_query($num_cols, $cols_arr, $join_tables, $num_tables, $tables_arr, $connect, $on_fields_arr, $where_clause, $order, $dir, $limit);




if ($modact == "insertacurso" or $modact == "actcurso") {
?>

</h2>
<div id="divContent0" style="position: relative; left: 26px;">
<table class="tblResultStd" border="0" cellpadding="0" cellspacing="0">
   <tr> 
      <td>Folio</td>
      <td>Tienda</td>
      <td>Curso</td>
      <td>L&iacute;nea</td>
      <td>Fecha</td>
      <td>Hora</td>
      <td>T&eacute;cnico que imparte</td>
      <td>Estado</td>
      <td>Observaciones</td>
    </tr>
    




<?php

        $fontsize = '1';
        $cell_align = "center";
        $cuentlin = 1;

// While que muestra los resultados de la base de datos

        while($row=mysql_fetch_row($curso_ins_detalle)) { 

?>
<tr>
      <td class="tblTDStd"><?php echo $row[9]; ?></td>
      <td class="tblTDStd"><?php echo $row[1]; ?></td>
      <td class="tblTDStd"><?php echo $row[2]; ?></td>
      <td class="tblTDStd"><?php echo $row[3]; ?></td>
      <td class="tblTDStd"><?php echo $row[4]; ?></td>
      <td class="tblTDStd"><?php echo $row[5]; ?></td>
      <td class="tblTDStd"><?php echo $row[6]; ?></td>
      <td class="tblTDStd"><?php echo "<span class=\""; 
        
        switch($row[7]) {
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

        echo "\">$row[7]"; ?></td>
      <td class="tblTDStd"><?php echo "$row[8]"; ?></td>
    </tr><?php

        } // cierre de while 

?>








  </table>
</div>



<?php

                if ($modact == "insertacurso") {

?>
<br />

<table class="tblBttnStd" border="0" cellpadding="0" cellspacing="0">
  <tr> 
        <form name="form2" id="form2" method="post" action="<?php echo $_SERVER['HTTP_REFERER']; ?>">
    <td width="10%" align="left">
        <div align="left">
          <input type="submit" name="Submit2" value="Continuar" />
          <input name="modificar" type="hidden" value="altacurso" />
        </div>
    </td>
        </form>
  </tr>
</table>

<?php
                } // Cierre de if

                if ($modact == "actcurso") {

?>



<table class="tblBttnStd" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post" name="form25" target="_self" id="form25">
      <td></label>
          <label>
          <input type="submit" name="button21" id="button30" value="Continuar" onclick="javascript: actualizalista()" />
        </label></td>
    </form>
  </tr>
</table>
  <?php

                } // Cierre de if actcurso
        } // Cierre de if detalle de cursos insertados o actualizados


?>
</body>
</html>
