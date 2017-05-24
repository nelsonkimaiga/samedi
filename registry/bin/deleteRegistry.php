<?php
session_start();
include("../../account/bin/user.db.php");

$DB_NAME = "samedico_gifts_registry";
$DBMS = new user_DBMS($DB_NAME);

$userId = $_SESSION['account']['refUserId'];
$entryId = $_REQUEST['itemId'];

//process user table
	$activeRegistry = $_REQUEST['activeRegistry'];
	$userId_new = strtolower(str_replace("/","_",$userId));
	$userTbl = $activeRegistry.'_'.$userId_new;

$status = 1; //okay, 1-- not okay
try{
	if($DBMS->dbconnection_status){
		$sqlselect = $DBMS->dataconn->query("SELECT entryId FROM ".$userTbl." WHERE entryId=".$entryId." LIMIT 1");
		if($sqlselect->rowCount()>0){
			$sqlDelete = "DELETE FROM ".$userTbl." WHERE entryId=".$entryId."";
			$DBMS->dataconn->exec($sqlDelete);	
			$status = 0;
		}
	}
}catch(PDOException $e){
	$DBMS->writeToFile($e->getMessage(), 'deleteRegistry.php');
}

echo $status;
?>