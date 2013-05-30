
<?php
// load configuration file
require_once('config.php');

// include('consultas.php');
// start session
session_start();

$rutafunciones = $_SESSION['rutafunciones'];
include $rutafunciones.'consultas.php';

// includes functionality to manipulate the products list 
class Grid 
{      
  // grid pages count
  public $mTotalPages;
  // grid items count
  public $mItemsCount;
  // index of page to be returned
  public $mReturnedPage;    
  // database handler
  private $mMysqli;
  // database handler
  private $grid;
  
  // class constructor
  function __construct() 
  {   
    // create the MySQL connection
    $this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,
                                DB_DATABASE);
    // call countAllRecords to get the number of grid records
    $this->mItemsCount = $this->countAllRecords();
  }

  // class destructor, closes database connection  
  function __destruct() 
  {
    $this->mMysqli->close();
  }
  // read a page of products and save it to $this->grid
  public function readPage($page)
  {
    // create the SQL query that returns a page of products
	$result_query = 'SELECT * FROM inmu_gdat';
	
    $queryString = $this->createSubpageQuery($result_query, 
                                             $page);
 
    // execute the query
    if ($result = $this->mMysqli->query($queryString)) 
    {
      // fetch associative array 
      while ($row = $result->fetch_assoc()) 
      {
        // build the XML structure containing products
        $this->grid .= '<row1>';
        foreach($row as $name=>$val)
          $this->grid .= '<' . $name . '>' . 
                         htmlentities($val) . 
                         '</' . $name . '>';
        $this->grid .= '</row1>';   
      }
      // close the results stream                     
      $result->close();
    }       
  }

  // update a product
  public function updateRecordEmpSis($id, $pbnoempleado, $sel_templeado, $sel_inmu, $contra)
  {
    // escape input data for safely using it in SQL statements
    $id            = $this->mMysqli->real_escape_string($id);
    $pbnoempleado  = $this->mMysqli->real_escape_string($pbnoempleado);
    $sel_templeado = $this->mMysqli->real_escape_string($sel_templeado);
    $sel_inmu      = $this->mMysqli->real_escape_string($sel_inmu);
	$contra        = $this->mMysqli->real_escape_string($contra);

	// Definicion de los parametros de la consulta
	// Actualizar Fila
	$aff_table = "gnrl_empl";

	$colsvalarr = array("pbnoempleado = '$pbnoempleado'");
		
	if ($sel_templeado <> '0' or $sel_inmu <> '0' or $contra <> "") { 
	
		if ($sel_templeado <> '0') {
			$colsvalarr[] = "idtempleado = '$sel_templeado'";
		}
		if ($sel_inmu <> '0') {
		
			$cols_arr     = array("idinmu");
			$num_cols     = count($cols_arr);
			$tables_arr   = array("inmu_gdat");
			$num_tables   = count($tables_arr);
			$where_clause = "inmucount = '$sel_inmu'";

			$idinmu_rset = select_gnrl_simple_query($num_cols, $cols_arr, $num_tables, $tables_arr, $where_clause);
	
			$idinmu=mysql_fetch_row($idinmu_rset);

			$colsvalarr[] = "idinmu = '$idinmu[0]'";
		}

		if ($contra <> "") {
			$md5_contra  = MD5($contra);
			$colsvalarr[] = "contra = '$md5_contra'";
		}	
	} // Cierre de if 

	$numcols = count($colsvalarr);
	$where_clause = "idempleado = '$id'";

	$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 


    } // Cierre de Funcion

	  	

	public function updateRecordEmpGen($id, $nombres, $apaterno, $amaterno, $fechanac, $nss, $direccion, $notelefonico, $correoe, $horaentrada, $horasalida, $tolerancia)	
	{

    // escape input data for safely using it in SQL statements
    $id           = $this->mMysqli->real_escape_string($id);
    $nombres      = $this->mMysqli->real_escape_string($nombres);
    $apaterno     = $this->mMysqli->real_escape_string($apaterno);
	$amaterno     = $this->mMysqli->real_escape_string($amaterno);
    $fechanac     = $this->mMysqli->real_escape_string($fechanac);
	$nss          = $this->mMysqli->real_escape_string($nss);
    $direccion    = $this->mMysqli->real_escape_string($direccion);
	$notelefonico = $this->mMysqli->real_escape_string($notelefonico);
	$correoe      = $this->mMysqli->real_escape_string($correoe);
	$horaentrada  = $this->mMysqli->real_escape_string($horaentrada);
	$horasalida   = $this->mMysqli->real_escape_string($horasalida);
	$tolerancia   = $this->mMysqli->real_escape_string($tolerancia); 

	// Actualizar Fila
	$aff_table = "gnrl_empl";

	$colsvalarr = array("nombres = '$nombres'", 
						"apaterno = '$apaterno'",
						"amaterno = '$amaterno'", 
						"fechanac = '$fechanac'", 
						"nss = '$nss'", 
						"direccion = '$direccion'", 
						"notelefonico = '$notelefonico'",
						"correoe = '$correoe'");
//						"horaentrada = '$horaentrada'",
//						"horasalida = '$horasalida'",
//						"tolerancia = '$tolerancia'");

	if ($horaentrada <> '0') {

		$cols_arr      = array("hora");
		$num_cols      = count($cols_arr);
		$tables_arr    = array("gnrl_hora");
		$num_tables   = count($tables_arr);
		$where_clause = "idhora = '$horaentrada'";

		$horaentrada_rset = select_gnrl_simple_query($num_cols, $cols_arr, $num_tables, $tables_arr, $where_clause);

		$horadeentrada=mysql_fetch_row($horaentrada_rset);

		$colsvalarr[] = "horaentrada = '$horadeentrada[0]'";
	}	

	if ($horasalida <> '0') {
	
		$cols_arr      = array("hora");
		$num_cols      = count($cols_arr);
		$tables_arr    = array("gnrl_hora");
		$num_tables   = count($tables_arr);
		$where_clause = "idhora = '$horasalida'";

		$horasalida_rset = select_gnrl_simple_query($num_cols, $cols_arr, $num_tables, $tables_arr, $where_clause);

		$horadesalida=mysql_fetch_row($horasalida_rset);

		$colsvalarr[] = "horasalida = '$horadesalida[0]'";
	}	
	
	if ($tolerancia <> '0') {
	
		$cols_arr      = array("valortolerancia");
		$num_cols      = count($cols_arr);
		$tables_arr    = array("empl_tole");
		$num_tables   = count($tables_arr);
		$where_clause = "idtolerancia = '$tolerancia'";

		$tolerancia_rset = select_gnrl_simple_query($num_cols, $cols_arr, $num_tables, $tables_arr, $where_clause);

		$valortolerancia=mysql_fetch_row($tolerancia_rset);

		$colsvalarr[] = "tolerancia = '$valortolerancia[0]'";
	}	

  /*if ($sel_estado <> '0') {
		$colsvalarr[] = "idempstat = '$sel_estado'";
	}*/

	$numcols = count($colsvalarr);
	$where_clause = "idempleado = '$id'";

	$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 



	} // Cierre de funcion 



  // returns data about the current request (number of grid pages, etc)
  public function getParamsXML()
  { 
    // calculate the previous page number
    $previous_page = 
      ($this->mReturnedPage == 1) ? '' : $this->mReturnedPage-1;    
    // calculate the next page number
    $next_page = ($this->mTotalPages == $this->mReturnedPage) ? 
                 '' : $this->mReturnedPage + 1; 
    // return the parameters
    return '<params>' .
           '<returned_page>' . $this->mReturnedPage . '</returned_page>'.
           '<total_pages>' . $this->mTotalPages . '</total_pages>'.
           '<items_count>' . $this->mItemsCount . '</items_count>'.
           '<previous_page>' . $previous_page . '</previous_page>'.
           '<next_page>' . $next_page . '</next_page>' .
           '</params>';
  }

  // returns the current grid page in XML format
  public function getGridXML()
  {
    return '<grid>' . $this->grid . '</grid>';
  } 

  // returns the total number of records for the grid
  private function countAllRecords()
  {
    /* if the record count isn't already cached in the session, 
       read the value from the database */
 
    if (!isset($_SESSION['record_count'])) 
    {
      // the query that returns the record count
      $count_query = 'SELECT COUNT(idinmu) FROM inmu_gdat';
      // execute the query and fetch the result 
      if ($result = $this->mMysqli->query($count_query)) 
      {
        // retrieve the first returned row
        $row = $result->fetch_row(); 
        /* retrieve the first column of the first row (it represents the 
           records count that we were looking for), and save its value in 
           the session */
        $_SESSION['record_count'] = $row[0];
        // close the database handle
        $result->close();
      }
    }    
    // read the record count from the session and return it
    return $_SESSION['record_count'];
  }         
  
  // receives a SELECT query that returns all products and modifies it
  // to return only a page of products
  private function createSubpageQuery($queryString, $pageNo) 
  {
    // if we have few products then we don't implement pagination  
    if ($this->mItemsCount <= ROWS_PER_VIEW) 
    {
      $pageNo = 1;
      $this->mTotalPages = 1;
    }
    // else we calculate number of pages and build new SELECT query
    else 
    {
      $this->mTotalPages = ceil($this->mItemsCount / ROWS_PER_VIEW);
      $start_page = ($pageNo - 1) * ROWS_PER_VIEW;   
      $queryString .= ' LIMIT ' . $start_page . ',' . ROWS_PER_VIEW;
    }
    // save the number of the returned page
    $this->mReturnedPage = $pageNo;
    // returns the new query string
    return $queryString;
  } 
// end class Grid
} 
?>
