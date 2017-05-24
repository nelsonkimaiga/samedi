<?php
function redirectToPage($page){
	header('Location:'.$page);
}
//include the relevant files
session_start();

if(!isset($_SESSION['account']['status']) || $_SESSION['account']['status']!='logged_in'){
	$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Session Expired. Please log in.</div></div>';
	redirectToPage('../login/');
}


include('../../account/bin/user.db.php');
include('../../bin/global.code.php');

$date_created = date_time();

$DB_NAME = "samedico_gifts_registry";
$DBMS = new user_DBMS($DB_NAME);

//user data
$giftDetails = array(0=>$_REQUEST['activeReg'],
						$_REQUEST['giftName'],
						$_REQUEST['giftCode'],
						$_REQUEST['quantity'],
						$_REQUEST['description'],
						$_REQUEST['store']);

//process user
$userId = $_SESSION['account']['refUserId'];
$activeRegistry = $giftDetails[0];
$userId_new = strtolower(str_replace("/","_",$userId));
$userTbl = $activeRegistry.'_'.$userId_new;
$_SESSION['registry']['mod'] = 404;
//insert records;
if($_REQUEST['process'] == 'new'){
	$sqlInsert = "INSERT INTO ".$userTbl." (giftCode,giftName,quantity,description,store,image,dateAdded) VALUES (:_a,:_b,:_c,:_d,:_e,:_f,:_g)";
	$sqlInsert = $DBMS->dataconn->prepare($sqlInsert);
	
	$sqlInsert->execute(array(
								':_a'=>$giftDetails[2],
								':_b'=>$giftDetails[1],
								':_c'=>$giftDetails[3],
								':_d'=>$giftDetails[4],
								':_e'=>$giftDetails[5],
								':_f'=>NULL,
								':_g'=>$date_created
								));
	$_SESSION['registry']['mod'] = 0;
}elseif($_REQUEST['process'] == 'update'){
	$sqlUpdate = "UPDATE ".$userTbl." SET giftCode=?, giftName=?, quantity=?, description=?, store=?, dateModified=? WHERE entryId=? LIMIT 1";
	$sqlUpdate = $DBMS->dataconn->prepare($sqlUpdate);
	$sqlUpdate->execute(array(
								$giftDetails[2],
								$giftDetails[1],
								$giftDetails[3],
								$giftDetails[4],
								$giftDetails[5],
								$date_created,
								$_REQUEST['entryId']
								));
	$_SESSION['registry']['mod'] = 2;
}

redirectToPage('../add-manual/');
?>