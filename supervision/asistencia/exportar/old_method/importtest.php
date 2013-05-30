<?php
	
	include("mysql_excel.inc.php");
	
	$import=new HarImport();
	$import->openDatabase("localhost","root","probell","egprobell_local");
	
	//To import the data from table
	$import->ImportDataFromTable("inmu_gdat");
	
	//To import the data from sql query
	/*
	$sql="select r.user_name,p.amount from recruiter r ,payment p where p.user_name=r.user_name"
	$import->ImportData($sql,"myXls.xls");*/

	//To force to download
	//$import->ImportDataFromTable("graduate","",true);
	//Or
	//$import->ImportData($sql,"myXls.xls",true);

?>