<?php
function redirectToPage($page){
	header("Location:".$page);
}

session_start();

include('../../bin/shop.db.php');
include('../../../bin/global.code.php');

$DB_NAME = 'samedico_samedi';

$invitation_code = $_REQUEST['invitation_registry'];

if($invitation_code == '00000'){
	$_SESSION['registry']['invitation_user'] = 'public';
	redirectToPage('../invitation/');
}


$DBMS = new Shop_DBMS($DB_NAME);
$views = 1;
try{
	if($DBMS->dbconnection_status){
		$sqlInvitation = $DBMS->dataconn->prepare("SELECT * FROM invitations WHERE invitation_code=? LIMIT 1");
		$sqlInvitation->execute(array($invitation_code));
		if($sqlInvitation->rowCount()>0){
			$row = $sqlInvitation->fetch(PDO::FETCH_ASSOC);
			//update views
			$views += intval($row['views']);
			$sqlUpdate = $DBMS->dataconn->prepare("UPDATE invitations SET views=? AND last_viewed=? WHERE invitation_code=? ");
			$sqlUpdate->execute($views,date_time(),$invitation_code);
			$arrUser = explode('/',$row['userId']);
			redirectToPage('../view-registry/?regid='.$arrUser[1].'&regid_b='.md5($row['userId']).'&invite_code='.$invitation_code);
		}else{
			$_SESSION['registry']['invitation_user'] = 'Err 1.0'; //code not found
		}
	}else{
		$_SESSION['registry']['invitation_user'] = 'Err 2.0'; //server error
	}
}catch(PDOException $e){
	$_SESSION['registry']['invitation_user'] = 'Err 2.0'; //server error
	redirectToPage('../invitation/');
}


?>