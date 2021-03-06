<?php
// load error handling script and the Grid class
require_once('error_handler.php');
require_once('grid.class.php');
// the 'action' parameter should be FEED_GRID_PAGE or UPDATE_ROW 
// if (!isset($_GET['action']))
// $rutafunciones = $_SESSION['rutafunciones'];
// include $rutafunciones.'consultas.php';

if (!isset($_POST['action']))
{  
  echo 'Server error: client command missing.';
  exit;
}      
else 
{
  // store the action to be performed in the $action variable
//  $action = $_GET['action'];
//  $action = $_POST['action'];
	foreach ($_POST as $nombre => $valor) {
		if(stristr($nombre, 'Actualizar') === FALSE) {
    		${$nombre} = $valor;
    	}
    }// Cierre foreach     
}
// create Grid instance
$grid = new Grid($action);
// valid action values are FEED_GRID_PAGE and UPDATE_ROW 
if ($action == 'FEED_GRID_PAGE')
{
  // retrieve the page number
  $page = $_GET['page'];
  // read the products on the page
  $grid->readPage($page);
}
else if ($action == 'UPDATE_ROW')
{

  $cols_arr      = array("idtusr");                 // 2    
  $num_cols      = count($cols_arr);
  $tables_arr    = array("gnrl_usrs");
  $num_tables    = count($tables_arr);
  $where_clause = "gnrl_usrs.iduser = '$id'";

  $userType_rset = select_gnrl_simple_query($num_cols, $cols_arr, $num_tables, $tables_arr, $where_clause);

  $userType=mysql_fetch_row($userType_rset);

  $usertypepass = $userType[0]; 		

  $grid->updateRecord($id, $contra, $sel_usrstatus, $usertypepass);
 
// header("showvars.php?id=$id&direccion=$direccion");

 
}
else 
  echo 'Server error: client command unrecognized.';
// clear the output 
if(ob_get_length()) ob_clean();
// headers are sent to prevent browsers from caching
header('Expires: Fri, 25 Dec 1980 00:00:00 GMT'); // time in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT'); 
header('Cache-Control: no-cache, must-revalidate'); 
header('Pragma: no-cache');
header('Content-Type: text/xml');
// generate the output in XML format
header('Content-type: text/xml'); 
echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
echo '<data>';
echo '<action>' . $action . '</action>';
echo $grid->getParamsXML();
echo $grid->getGridXML();
echo '</data>';
?>
