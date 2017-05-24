<?php
session_start();

include('../bin/user.db.php');

$emailAdd = $_REQUEST['emailAdd'];
$userStatus = true;

$DB_NAME = "samedico_samedi";


$DBMS = new user_DBMS($DB_NAME);

try{
	if($DBMS->dbconnection_status){
		$sqlVerify = $DBMS->dataconn->prepare("SELECT email_add FROM users WHERE email_add=?");
		$sqlVerify->execute(array($emailAdd));
		if($sqlVerify->rowCount()>0){
			$userStatus = 2;
		}else{
			$userStatus = 1;
		}
	}else{
		echo('Error in database');
	}
 
 echo($userStatus);	
}catch(PDOException $e){
	echo('Error accessing database');
}





?>