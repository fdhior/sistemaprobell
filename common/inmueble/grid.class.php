<?php

// start session
session_start();
// load configuration file
require_once('config.php');
include $_SESSION['rutafunciones'].'consultas.php';

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
  public function updateRecord($id, $razonsc, $direccion, $zona, $linkubica, $estado)
  {
    // escape input data for safely using it in SQL statements
    $id = $this->mMysqli->real_escape_string($id);
    $razonsc = $this->mMysqli->real_escape_string($razonsc);
    $direccion = $this->mMysqli->real_escape_string($direccion);
    $zona = $this->mMysqli->real_escape_string($zona);
	$linkubica = $this->mMysqli->real_escape_string($linkubica);
	$estado = $this->mMysqli->real_escape_string($estado);

    /*$price = $this->mMysqli->real_escape_string($price);
    $name = $this->mMysqli->real_escape_string($name);*/
    // build the SQL query that updates a product record

	// Actualizar Fila
	$aff_table = "inmu_gdat";
	if ($razonsc <> '0') {
		$colsvalarr[] = "idfis = '$razonsc'";
	}
	$colsvalarr[] = "direccion = '$direccion'";
	if ($zona <> '0') {
		$colsvalarr[] = "idzona = '$zona'";
	}	
	if ($estado <> '0') {
		$colsvalarr[] = "idinmustat = '$estado'";
	}	
	$numcols = count($colsvalarr);
	$where_clause = "idinmu = '$id'";


	$result = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 


	// Definicion de los parametros de la consulta
	$cols_arr      = array("idinmu");
	$num_cols      = count($cols_arr);
	$tables_arr    = array("inmu_gubc");
	$num_tables    = count($tables_arr);
	$where_clause = "idinmu = '$id'";

	$gubc_rset = select_gnrl_simple_query($num_cols, $cols_arr, $num_tables, $tables_arr, $where_clause);


	if (mysql_num_rows($gubc_rset) > 0) {
		
		$aff_table = "inmu_gubc";
		$colsvalarr = array("googlelink = '$linkubica'");
		$numcols = count($colsvalarr);
		$where_clause = "idinmu = '$id'";

		$up_link = gnrl_update_query($aff_table, $colsvalarr, $numcols, $where_clause); 
	} 


//    $queryString =  'UPDATE inmu_gdat SET direccion='.$direccion.', idfis='.$razaonsc.' WHERE idinmu=' . $id;        
    // execute the SQL command      
//    $this->mMysqli->query($queryString);  
  }

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
