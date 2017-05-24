<?php
function redirectToPage($page){
	header('Location:'.$page);
}

session_start();

if(!isset($_SESSION['account']['status']) || $_SESSION['account']['status']!='logged_in'){
	$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Session Expired. Please log in.</div></div>';
	redirectToPage('../login/');
}


include('user.db.php');
include('../../bin/global.code.php');
//page variables
$addName = '';
$addFname = trim($_REQUEST['inputFpartner']) != ""? $_REQUEST['inputFpartner'] : NULL;
$addMname = trim($_REQUEST['inputMName_add']) != ""? $_REQUEST['inputMName_add'] : NULL;


$FormData = array(
				  0=>$_REQUEST['inputFName'],
				  $_REQUEST['inputMName'],
				  $addFname,
				  $addMname,
				  $_REQUEST['babyshowerLocation'],
				  $_REQUEST['selectbabyshowerStatus'],
				  $_REQUEST['setDate'],
				  $_REQUEST['babyshowerLocation']
				  );

$date_created = date_time();
$FormData[8] = $date_created;

//modify add. names
if($addFname==NULL || $addMname==NULL){
	$addName = NULL;
}else{
	$addName = $FormData[2].'*'.$FormData[3];
}

$DB_NAME = "samedico_babyshower_registry";
$DBMS = new user_DBMS($DB_NAME);


if(isset($_REQUEST['usrReg']) && $_REQUEST['usrReg']=='new'){
	try{
		//$entryID = generateEntryID($DBMS); -- the entryId row is set to auto_increment
		if($DBMS->dbconnection_status){
			$sqlInsert = $DBMS->dataconn->prepare("INSERT INTO usr_registries		(userId,register_names,partner_names,date,images,location,status,description,date_created,last_modified,active,comments)values(:_b,:_c,:_d,:_e,:_f,:_a,:_g,:_h,:_i,:_j,:_k,:_l)");
			
			$sqlInsert->execute(array(
									  ':_b'=>$_SESSION['account']['refUserId'],
									  ':_c'=>$FormData[0].'*'.$FormData[1],
									  ':_d'=>$addName,
									  ':_e'=>$FormData[6],
									  ':_f'=>'',
									  ':_a'=>$FormData[7],
									  ':_g'=>$FormData[5],
									  ':_h'=>NULL,
									  ':_i'=>$FormData[8],
									  ':_j'=>$FormData[8],
									  ':_k'=>'Yes',
									  ':_l'=>NULL
									  ));
			//image shughulikialing
			//not verified
			if(isset($_FILES["imagesUpload"]["name"]) && $_FILES["imagesUpload"]["name"]){
				//uploadImages($DBMS,$_SESSION['account']['refUserId']);
			}
			//update the user account on registry
			$DB_NAME = "samedico_samedi";
			$DBMS = new user_DBMS($DB_NAME);
			
			$sqlUpdateUserDB = $DBMS->dataconn->prepare("UPDATE users SET active_registry='babyshower_registry' WHERE userId=? LIMIT 1");
			$sqlUpdateUserDB->execute(array($_SESSION['account']['refUserId']));
			//update user registry above
			
			
			$_SESSION['registry']['temp_detail_edit'] = '<div class="alert alert-success">Your Details have been successfully saved</div>';
			
		}else{
		$_SESSION['registry']['temp_detail_edit'] = '<div class="alert alert-error">A fatal error prevented a successful comppletion of your request.<br /> We are looking into the issue. Please try again after sometime.</div>';
		}
		
		//redirect
		redirectToPage('../babyshower-registry/?edit_details=ok');
		
	}catch(PDOException $e){
		$_SESSION['registry']['temp_detail_edit'] = '<div class="alert alert-error">A fatal error prevented a successful comppletion of your request.<br /> We are looking into the issue. Please try again after sometime.</div>';
		//redirect
		redirectToPage('../babyshower-registry/?edit_details=ok');
	}
}elseif(isset($_REQUEST['usrReg']) && $_REQUEST['usrReg']=='update'){
	try{
		if($DBMS->dbconnection_status){
			$sqlUpdate = $DBMS->dataconn->prepare("UPDATE usr_registries SET register_names=? ,partner_names=? ,date=? ,location=? ,status=?, last_modified=? WHERE userId=? AND active=?");
			
			$sqlUpdate->execute(array(
									  $FormData[0].'*'.$FormData[1],
									  $addName,
									  $FormData[6],
									  $FormData[7],
									  $FormData[5],
									  $FormData[8],
									  $_SESSION['account']['refUserId'],
									  'Yes'
									  ));
		
			$_SESSION['registry']['temp_detail_edit'] = '<div class="alert alert-success">Your Details have been successfully updated.</div>';
		}else{
		$_SESSION['registry']['temp_detail_edit'] = '<div class="alert alert-error">A fatal error prevented a successful comppletion of your request.<br /> We are looking into the issue. Please try again after sometime.</div>';
		}	
		//redirect
		redirectToPage('../babyshower-registry/?edit_details=ok');
			
	}catch(PDOException $e){
		$_SESSION['registry']['temp_detail_edit'] = '<div class="alert alert-error">A fatal error prevented a successful comppletion of your request.<br /> We are looking into the issue. Please try again after sometime.</div>';
		//redirect
		redirectToPage('../babyshower-registry/?edit_details=ok');
	}
}

function generateEntryID($DBMS){
	$id = 1;
	$sqlId = $DBMS->dataconn->query("SELECT entryId FROM usr_registries ORDER BY entryId Desc limit 1");
	if($sqlId->rowCount()>0){
		$row = $sqlId->fetch(PDO::FETCH_ASSOC);
		$id = $row['entryId'] + 1;
	}
	
	return $id;
}

function uploadImages($DBMS,$userId){
	$allowedExts = array("jpeg","jpg","png");
	//create this user's folder,
	$strDir = '../wedding-registry/'.str_replace('/','.',$_SESSION['account']['refUserId']);
	if(!file_exists($strDir)){
		mkdir($strDir);
	 }
	 
	$path = $strDir;

		$temp = explode(".", $_FILES["imagesUpload"]["name"]);
		$extension = end($temp);
		if ((($_FILES["imagesUpload"]["type"] == "image/jpeg")
		|| ($_FILES["imagesUpload"]["type"] == "image/jpg")
		|| ($_FILES["imagesUpload"]["type"] == "image/png"))
		&& ($_FILES["imagesUpload"]["size"] < 3000000)
		&& in_array($extension, $allowedExts)){
			if ($_FILES["imagesUpload"]["error"] > 0){
				$_SESSION['registry']['temp_detail_edit'] = '<div class="alert alert-error">Your selected image is not supported.</div>';
				$_SESSION['registry']['image'] = 'There was a technical error uploading your picture. Please try again.';
			 }else{
				move_uploaded_file($_FILES["imagesUpload"]["tmp_name"],$path."/". $_FILES["imagesUpload"]["name"]);
				//update database
				$sqlUpdate = $DBMS->dataconn->prepare("UPDATE usr_registries SET images=? WHERE userId=?");
				$sqlUpdate->execute(array($_FILES["imagesUpload"]["name"],$userId));
				
			 }
		}else{
		$_SESSION['registry']['temp_detail_edit'] = '<div class="alert alert-error">Your selected image is not supported.</div>';
			$_SESSION['registry']['image'] = 'Your picture was not uploaded either by being of a large size or unsupported size. <a href="javascript:void()">View requirements</a>.';
		}
		
}

?>