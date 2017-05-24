<?php
function redirectToPage($page){
	header('Location:'.$page);
}

session_start();

include('../bin/user.db.php');
include('../../bin/global.code.php');

if(isset($_SESSION['account']['newUser']) && $_SESSION['account']['newUser']){
	$details = array($_SESSION['account']['refEmail'],$_SESSION['account']['_pass']);
	//unset relevant session
	unset($_SESSION['account']['_pass']);
}else{
	$details = array($_REQUEST['inputEmail'],$_REQUEST['inputPassword']);
}

$database = 'samedico_samedi';
$DBMS = new user_DBMS($database);

try{
	if($DBMS->dbconnection_status){
		$sqlLog = $DBMS->dataconn->prepare("SELECT * FROM users WHERE email_add=?");
		$sqlLog->execute(array($details[0]));
		if($sqlLog->rowCount()>0){
			$row = $sqlLog->fetch(PDO::FETCH_ASSOC);
			if($row['pass']==$details[1]){
				//set sessions and redirect
				$sqlUpdate = $DBMS->dataconn->prepare('UPDATE users SET last_login=? WHERE userId=?');
				$sqlUpdate->execute(array(date_time(),$_SESSION['account']['refUserId']));
				
				$_SESSION['account']['refName'] = $row['first_name'];
				$_SESSION['account']['refEmail'] = $row['email_add'];
				$_SESSION['account']['refUserId'] = $row['userId'];
				$_SESSION['account']['status'] = 'logged_in';
				$_SESSION['account']['newUser'] = false;
				redirectToPage('../');
			}else{
				$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Username or password is not correct. Please try again.</div></div>';
				redirectToPage('../login/');
				//redirect with an incorrect details
			}
		}else{
			//redirect with an incorrect details
			$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Username or password is not correct. Please try again.</div></div>';
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