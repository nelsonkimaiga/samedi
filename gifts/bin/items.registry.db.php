<?php
session_start();

$category = $_REQUEST['category'];
$itemCode = $_REQUEST['itemCode'];
$quantity = $_REQUEST['quantity'];


//up to here
include('shop.db.php');

include('../../bin/global.code.php');

$status = true;


$DB_NAME = "samedico_samedi";



if(!$_SESSION['account']['memberAccess']){//not logged in
	//create session
		$_SESSION['account']['logToAccess'] = true;
		$_SESSION['RedirectURL']['URLPrimayKey'] = '$itemCode'; //include script in logging and create account
		echo('2.0');

  }else{//member logged in
  		$DBMS = new Shop_DBMS($DB_NAME);
		try{
			if($DBMS->dbconnection_status){
				$sqlUser = $DBMS->dataconn->prepare("SELECT active_registry FROM users WHERE userId=?");
				$sqlUser->execute(array($_SESSION['account']['refUserId']));
				
				$row = $sqlUser->fetch(PDO::FETCH_ASSOC);
				
				if($row['active_registry']!=""){
					$status = storeToActiveRegistry($row['active_registry'],'registry');
				 }else{
				 	$status = storeToActiveRegistry('shop','add_registry');
				  }
			 }else{
			 	$strError1 = 'dbconnection_status 01 error';
				$status = false;
			  }
			  
			  echo($status);
			  
		 }catch(PDOException $e){
		 	$strError0 = 'try catch error-->'.$e->getMessage();
			$status = false;
		  }
    }

function storeToActiveRegistry($activeReg,$activeTbl){
	global $DBMS,$itemCode,$quantity;
	$funcReturn = '';
	$DBMS = new Shop_DBMS($activeReg);
	try{
		if($DBMS->dbconnection_status){
			$arrExists = checkIfEntryExists($DBMS,$activeTbl);
			if($arrExists[0]){
				$getNum = addNewNum($DBMS,$activeTbl);
				$itemStatus = matchUpItem($arrExists[1],$itemCode,$quantity);
				$arrItemStatus = explode('#',$itemStatus);
				if($arrItemStatus[0]=='INA'){
					$sqlUpdate = $DBMS->dataconn->prepare("UPDATE ".$activeTbl." SET strItems=?,lastModification=? WHERE userId=?");
					$sqlUpdate->execute(array($arrItemStatus[1],date_time(),$_SESSION['account']['refUserId']));
					$funcReturn = '1.0';
				}elseif($arrItemStatus[0]=='IU'){
					$sqlUpdate = $DBMS->dataconn->prepare("UPDATE ".$activeTbl." SET strItems=?,lastModification=? WHERE userId=?");
					$sqlUpdate->execute(array($arrItemStatus[1],date_time(),$_SESSION['account']['refUserId']));
					$funcReturn = '1.1';
				}else{
					$funcReturn = '1.2';
				}
			 }else{
			 	$getNum = addNewNum($DBMS,$activeTbl);
				$strItems = $itemCode.'*'.$quantity.'*default';
				$sqlInsert = $DBMS->dataconn->prepare("INSERT INTO ".$activeTbl." (entryId,userId,strItems,dateStarted,lastModification,active)
							values(:_a,:_b,:_c,:_d,:_e,:_f)");

				$sqlInsert->execute(array(
										  ':_a'=>$getNum,
										  ':_b'=>$_SESSION['account']['refUserId'],
										  ':_c'=>$strItems,
										  ':_d'=>date_time(),
										  ':_e'=>date_time(),
										  ':_f'=>'Yes'
										  ));
				$funcReturn = true;
			  }
		 }else{
		  	$strError1 = 'dbconnection_status storeToActiveRegistry error';
			$funcReturn = $strError1;
		  }
		return $funcReturn;
	 }catch(PDOException $e){
	 	$strError0 = "Error in try and catch storeToActiveRegistry() -- >".$e->getMessage().'<br />';
		$funcReturn = $strError0;
	  }
}

function matchUpItem($strItems,$curItemCode,$curItemQuantity){
	$strReturn = 'INA'; //Item Not Available
	$arrItems = explode('|', $strItems);
	for($i=0; $i<count($arrItems); $i++){
		$arrItemDetails = explode('*',$arrItems[$i]);
		if($curItemCode==$arrItemDetails[0]){
			if($curItemQuantity!=intval($arrItemDetails[1])){
				$arrItemDetails[1] = $curItemQuantity;
				$arrItems[$i] = $arrItemDetails[0].'*'.$arrItemDetails[1].'*'.$arrItemDetails[2];
				$strItems_sub = implode('|',$arrItems);
				$strReturn = 'IU#'.$strItems_sub; //Item Updated
				
			}else{
				$strReturn = 'IUTP#null'; //Item Up To Date
			}
			break;
		}
	}
	if($strReturn == 'INA'){
		$strReturn .= '|'.$curItemCode.'*'.$curItemQuantity.'*default';
	}
	return $strReturn;
}

function checkIfEntryExists($DBMS,$activeTbl){
	$strRet = array();
	$sqlExists = $DBMS->dataconn->prepare("SELECT strItems FROM ".$activeTbl." WHERE userId=? AND active=? LIMIT 1");
	$sqlExists->execute(array($_SESSION['account']['refUserId'],'Yes'));
	$row = $sqlExists->fetch(PDO::FETCH_ASSOC);
	if($sqlExists->rowCount()>0){
		$strRet[0] = true;
		$strRet[1] = $row['strItems'];
	 }else{
	 	$strRet[0] = false;
		$strRet[1] = '';
	  }
	  
	  return $strRet;
}

function addNewNum($DBMS,$activeTbl){
	$idNum = 1;
	$sqlNum = $DBMS->dataconn->query("SELECT entryId FROM ".$activeTbl." ORDER BY entryId DESC");
	$row = $sqlNum->fetch(PDO::FETCH_ASSOC);
	if($sqlNum->rowCount()>0){
		$idNum += $row['entryId'];
	  }
	  
	  return $idNum;
}


//develeoper.help
/*

$status = start using a *boolean>>true.
			if ay error occurs, switch to false.
			
	for customized status use,
	 1.1 = 'updated item'
	 1.2 = 'item is up to date'





*/
?>