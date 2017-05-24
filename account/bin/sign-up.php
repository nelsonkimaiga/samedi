<?php
function Redirect($page){
	header("Location:".$page);
}
session_start();

include('user.db.php');
include('../../bin/global.code.php');

$notifications = isset($_REQUEST['updateNotifications'])?'Yes':'No';

$userData = array(
				0=>$_REQUEST['inputFirstName'],
				$_REQUEST['inputLastName'],
				$_REQUEST['inputEmail'],
				$_REQUEST['inputPassword'],
				$notifications
				);

$date_created = date_time();
$userData[5] = $date_created;

$DB_NAME = 'samedico_samedi';
$DBMS = new user_DBMS($DB_NAME);

try{
	if($DBMS->dbconnection_status){
		$entryID = generateEntryID($DBMS);
		$userID = generateUserId($entryID);
		
		$sqlInsert = $DBMS->dataconn->prepare("INSERT INTO users 
			(entryId,userID,first_name,last_name,email_add,pass,phone,str_shipping,images,notifications,active_registry,date_created,last_login)
			value(:_a,:_b,:_c,:_d,
				  :_e,:_f,:_g,:_h,	
				  :_i,:_j,:_m,:_k,:_l)");
		$sqlInsert->execute(array(':_a'=>$entryID,
								  ':_b'=>$userID,
								  ':_c'=>$userData[0],
								  ':_d'=>$userData[1],
								  ':_e'=>$userData[2],
								  ':_f'=>$userData[3],
								  ':_g'=>'',
								  ':_h'=>'',
								  ':_i'=>'',
								  ':_j'=>$userData[4],
								  ':_m'=>'(empty)',
								  ':_k'=>$userData[5],
								  ':_l'=>$userData[5]
								  ));
								  
		$sqlInsert = $DBMS->dataconn->prepare("INSERT INTO account_status 
			(entryId,userID,registry_contacts,last_contact_added,message_credits,last_credit_recharge)
			value(:_a,:_b,:_c,:_d,:_e,:_f)");
			
		$sqlInsert->execute(array(':_a'=>$entryID,
								  ':_b'=>$userID,
								  ':_c'=>'(empty)',
								  ':_d'=>'(empty)',
								  ':_e'=>'(empty)',
								  ':_f'=>'(empty)'
								  ));
		$_SESSION['account']['newUser'] = true;
		$_SESSION['account']['refName'] = $userData[0];
		$_SESSION['account']['refEmail'] = $userData[2];
		$_SESSION['account']['_pass'] = $userData[3];
		$_SESSION['account']['refUserId'] = $userID;
		$_SESSION['account']['status'] = 'logged_in';
		Redirect('../login/user.auth.login.php');
	}
}catch(PDOException $e){
	echo('Error-->'.$e->getMessage()); //write to admin page
	$_SESSION['error']['signup'] = true;
	Redirect('../signup/');
}
//store details
function generateEntryID($DBMS){
	$id = 1;
	$sqlId = $DBMS->dataconn->query("SELECT entryId FROM users ORDER BY entryId Desc limit 1");
	if($sqlId->rowCount()>0){
		$row = $sqlId->fetch(PDO::FETCH_ASSOC);
		$id = $row['entryId'] + 1;
	}
	
	return $id;
}

function generateUserId($entryID){
	$userID = 'SAM/'.$entryID.'/'.date('Y');
	return $userID;
}
?>
