<?php
function redirectToPage($page){
	header('Location:'.$page);
}

session_start();

if(!isset($_SESSION['account']['status']) || $_SESSION['account']['status']!='logged_in'){
	$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Session Expired.</div></div>';
	redirectToPage('login/');
}


include('../bin/user.db.php');
include('../../bin/global.code.php');

$details = array($_REQUEST['inputEmail'],$_REQUEST['inputPassword']);

$database = 'samedico_samedi';
$DBMS = new user_DBMS($database);

try{
	if($DBMS->dbconnection_status){
		$sqlLog = $DBMS->dataconn->prepare("SELECT * FROM users WHERE userId=?");
		$sqlLog->execute(array($_SESSION['account']['refUserId']));
		if($sqlLog->rowCount()>0){
			//unset sessions and redirect
				unset($_SESSION['account']['refName'],
					  $_SESSION['account']['refEmail'],
				      $_SESSION['account']['refUserId'],
				      $_SESSION['account']['status']);
				redirectToPage('../login/');
				$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Successfully Signed Out</div></div>';
			
		}else{
			//redirect with an incorrect details
			$_SESSION['err']['login'] = '<div class="controls"><div class="alert alert-error">An error ocurred login out.</div></div>';
			redirectToPage('../login/');
		}
	}else{
		$_SESSION['err']['login'] = '<div class="controls"><div class="alert alert-error">A server error has occured. Please bear with us with correct the error. 1.0</div></div>';
		redirectToPage('../login/');
	}
}catch(PDOException $e){
	$_SESSION['err']['login'] = '<div class="controls"><div class="alert alert-error">A server error has occured. Please bear with us with correct the error. 2.0</div></div>';
	redirectToPage('../login/');
}
?>