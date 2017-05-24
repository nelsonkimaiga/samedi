<?php
class user_DBMS{

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
	$this->DB_USER = "root"; //root --localhost ---cgcadmin1
	$this->DB_PASSWORD = "shadowNet0080";
	$this->setFileParams();
	$this->DB_CONNECT();
	
  }
private function setFileParams(){
	$this->errorLogFile = '../../cgi-bin/logs/client-log/LOG01.txt';
}

private function DB_CONNECT(){	
	try{
	  $this->dataconn = new PDO("mysql:host=".$this->DB_HOST.";dbname=".$this->DB_NAME.";",$this->DB_USER,$this->DB_PASSWORD);
	  $this->dataconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	    $this->dbconnection_status = true;
	}catch(PDOException $e){
		$this->dbLog = $e->getMessage(); //send to log file
		$this->dbconnection_status = false;
		//send to log
		$this->writeToFile($this->dbLog,'File:class.admin.001.php');
		return 'error';
	  }
 } 

public function writeToFile($error,$page){
	$file = fopen($this->errorLogFile,"a") or exit("Unable to open file");
	$entry = $page.", Time: ".$this->curTime.",".$error."; \n";
	fwrite($file,$entry);
	fclose($file);
}

function DBClose(){
	$this->dataconn = null;
} 

}
?>