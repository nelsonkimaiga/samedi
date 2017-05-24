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



$FormData = array(
				  0=>$_REQUEST['inputFName'],
				  $_REQUEST['inputMName'],
				  $_REQUEST['inputCourse'],
				  $_REQUEST['inputInstName'],
				  $_REQUEST['graduationLocation'],
				  $_REQUEST['selectgraduationStatus'],
				  $_REQUEST['setDate'],
				  $_REQUEST['graduationLocation']
				  );

$date_created = date_time();
$FormData[8] = $date_created;

$DB_NAME = "samedico_graduation_registry";
$DBMS = new user_DBMS($DB_NAME);


if(isset($_REQUEST['usrReg']) && $_REQUEST['usrReg']=='new'){
	createTable();
	try{
		//$entryID = generateEntryID($DBMS); -- the entryId row is set to auto_increment
		if($DBMS->dbconnection_status){
			$sqlInsert = $DBMS->dataconn->prepare("INSERT INTO usr_registries(userId,firstName, middleName, date, images, course, institution, ceremonyLocation, status, date_created, last_modified, active) values (:_b, :_c, :_d, :_e, :_f, :_a, :_g, :_h, :_i, :_j, :_k, :_l)");
			
			$sqlInsert->execute(array(
									  ':_b'=>$_SESSION['account']['refUserId'],
									  ':_c'=>$FormData[0],
									  ':_d'=>$FormData[1],
									  ':_e'=>$FormData[6],
									  ':_f'=>'',
									  ':_a'=>$FormData[2],
									  ':_g'=>$FormData[3],
									  ':_h'=>$FormData[7],
									  ':_i'=>$FormData[5],
									  ':_j'=>$FormData[8],
									  ':_k'=>$FormData[8],
									  ':_l'=>'Yes'
									  ));
			//image shughulikialing
			//not verified
			if(isset($_FILES["imagesUpload"]["name"]) && $_FILES["imagesUpload"]["name"]){
				//uploadImages($DBMS,$_SESSION['account']['refUserId']);
			}
			//update the user account on registry
			$DB_NAME = "samedico_samedi";
			$DBMS = new user_DBMS($DB_NAME);
			
			$sqlUpdateUserDB = $DBMS->dataconn->prepare("UPDATE users SET active_registry='graduation_registry' WHERE userId=? LIMIT 1");
			$sqlUpdateUserDB->execute(array($_SESSION['account']['refUserId']));
			//update user registry above
			
			
			$_SESSION['registry']['temp_detail_edit'] = '<div class="alert alert-success">Your Details have been successfully saved</div>';
			
		}else{
		$_SESSION['registry']['temp_detail_edit'] = '<div class="alert alert-error">A fatal error prevented a successful comppletion of your request.<br /> We are looking into the issue. Please try again after sometime.</div>';
		}
		
		//redirect
		redirectToPage('../graduation-registry/?edit_details=ok');
		
	}catch(PDOException $e){
		$_SESSION['registry']['temp_detail_edit'] = '<div class="alert alert-error">A fatal error prevented a successful comppletion of your request.<br /> We are looking into the issue. Please try again after sometime.</div>';
		//redirect
		redirectToPage('../graduation-registry/?edit_details=ok');
	}
}elseif(isset($_REQUEST['usrReg']) && $_REQUEST['usrReg']=='update'){
	try{
		if($DBMS->dbconnection_status){
			$sqlUpdate = $DBMS->dataconn->prepare("UPDATE usr_registries SET firstName=?, middleName=?, date=?, ceremonyLocation=?, status=?, last_modified=? WHERE userId=? AND active=?");
			
			$sqlUpdate->execute(array(
									  $FormData[0],
									  $FormData[1],
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
		redirectToPage('../graduation-registry/?edit_details=ok');
			
	}catch(PDOException $e){
		$_SESSION['registry']['temp_detail_edit'] = '<div class="alert alert-error">A fatal error prevented a successful comppletion of your request.<br /> We are looking into the issue. Please try again after sometime.</div>';
		//redirect
		redirectToPage('../graduation-registry/?edit_details=ok');
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

function createTable(){
	$DB_NAME = "samedico_gifts_registry";
	$DBMS = new user_DBMS($DB_NAME);
	
	$userId = $_SESSION['account']['refUserId'];
	$activeRegistry = 'graduation_registry';
	$userId_new = strtolower(str_replace("/","_",$userId));
	$userTbl = $activeRegistry.'_'.$userId_new;

 try{
	$sqlTable = "CREATE TABLE IF NOT EXISTS ".$userTbl." (
	  entryId smallint(6) NOT NULL AUTO_INCREMENT,
	  giftCode varchar(100) NOT NULL DEFAULT 'xxxxxxxxxx',
	  giftName varchar(255) NOT NULL,
	  quantity smallint(6) NOT NULL DEFAULT '1',
	  description text,
	  store varchar(255) NOT NULL,
	  image varchar(100) DEFAULT NULL,
	  purchased varchar(50) NOT NULL DEFAULT 'No',
	  pledged varchar(50) NOT NULL DEFAULT 'No',
	  comment text,
	  dateAdded varchar(50) DEFAULT NULL,
	  dateModified varchar(50) DEFAULT NULL,
	  PRIMARY KEY (entryId)
	)";
		 
	return $DBMS->dataconn->exec($sqlTable);
 }catch(PDOException $e){
	 echo "0X256";
 }	
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