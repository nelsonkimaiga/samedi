<?php
class Shop_DBMS{

private $DB_HOST;
private $DB_NAME;
private $DB_USER;
private $DB_PASSWORD;

public $dataconn;
public $dbconnection_status;
public $dbLog;


function __construct($database){
	$this->DB_HOST = "localhost";
	$this->DB_NAME = $database;
	$this->DB_USER = "samedico_s_user"; //do not change
	$this->DB_PASSWORD = "k7A*!Eb{xqH2"; // do not change
	
	$this->DB_CONNECT();
  }
  
function DB_CONNECT(){	
	try{
	  $this->dataconn = new PDO("mysql:host=".$this->DB_HOST.";dbname=".$this->DB_NAME.";",$this->DB_USER,$this->DB_PASSWORD);
	  $this->dataconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	    $this->dbconnection_status = true;
	}catch(PDOException $e){
		$this->dbLog = $e->getMessage(); //send to log file
		$this->dbconnection_status = false;
	  }
 }  

}
?>