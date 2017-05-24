<?php

function redirectToPage($page){
	header('Location:'.$page);
}
session_start();


include('../../../bin/user.db.php');
include('../../../../bin/global.code.php');
$DB_NAME = "samedico_samedi";
$DBMS = new user_DBMS($DB_NAME);

$itemCode = $_REQUEST['itemCode'];

if(!isset($_SESSION['account']['status']) || $_SESSION['account']['status']!='logged_in'){
	$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Session Expired. Please log in.</div></div>';
	//redirectToPage('../login/');
}else{
$strReturnHTML = '';
	if($_REQUEST['action']=='fetch_contacts'){
		try{
			if($DBMS->dbconnection_status){
				$sqlContacts = $DBMS->dataconn->prepare("SELECT registry_contacts FROM account_status WHERE userId=? LIMIT 1");
				$sqlContacts->execute(array($_SESSION['account']['refUserId']));
				$row = $sqlContacts->fetch(PDO::FETCH_ASSOC);
				
				$DBMS_temp = new user_DBMS('samedico_'.$_REQUEST['registry']);
				$sqlGetItemContacts = $DBMS_temp->dataconn->prepare("SELECT strItems FROM registry WHERE userId=? AND active=? LIMIT 1");
				$sqlGetItemContacts->execute(array($_SESSION['account']['refUserId'],'Yes'));
				$contacts_row = $sqlGetItemContacts->fetch(PDO::FETCH_ASSOC);
				$arrItems = explode('|',$contacts_row['strItems']);
				
				for($i=0; $i<count($arrItems); $i++){
					$arrItemDetails = explode('*',$arrItems[$i]);
					if($arrItemDetails[0]==$itemCode){
						$strContacts = $arrItemDetails[2];
						break;
					}
				}
				
				
				if($row['registry_contacts']!=""){
					$arrContacts = explode('|',$row['registry_contacts']);
					$strHTML = '';
					for($i=0; $i<count($arrContacts); $i++){
						$found = false;
						$arrEntry = explode('*',$arrContacts[$i]);
						$arrItemContacts = explode(',',$strContacts);
						for($i=0; $i<count($arrItemContacts); $i++){
							if($arrItemContacts[$i]==$arrEntry[1]){
								$found = true;
								break;
							}
						}
						if($found){
							$strHTML .= '
								<label title="'.$arrEntry[1].'">
									<input type="checkbox" name="checkcontact[]" checked="checked" disabled="disabled" value="'.$arrEntry[1].'" /> '.$arrEntry[0].'
								</label>
							';
						}else{
							$strHTML .= '
								<label title="'.$arrEntry[1].'">
									<input type="checkbox" name="checkcontact[]" value="'.$arrEntry[1].'" /> '.$arrEntry[0].'
								</label>
							';
						}
					}
					$strReturnHTML = $strHTML;
				}else{
					$strReturnHTML = '
						<div style="font-size:12px">
							You have not set any contact.
							<a href="'.$_SESSION['page']['home_url'].'account/registry/contacts">Click here</a>
							to add contacts or click <strong>Registry Contacts</strong> on the left.
						</div>
					';
				}
			}
		}catch(PDOException $e){
			$strReturnHTML = '<div style="color:#ff0000">Error Retrieving Contacts</div>'.$e->getMessage();
		}
	
	}elseif($_REQUEST['action']=='updateItemEntry'){
		$strUpdate = '';
		$messages = $_REQUEST['messages'];
		$strContacts = 'default';
		$itemCode = $_REQUEST['itemCode'];
		$entryQuantity = $_REQUEST['quantity'];
		if($messages=='specific'){
			$strContacts = implode(',',$_REQUEST['arrContacts']);
		}
		
		$registry = $_REQUEST['registry'];
		$change = false;
		$DBMS_temp = new user_DBMS('samedico_'.$registry);
		try{
			if($DBMS_temp->dbconnection_status){
				$sqlItems = $DBMS_temp->dataconn->prepare("SELECT strItems FROM registry WHERE userId=? AND active=?");
				$sqlItems->execute(array($_SESSION['account']['refUserId'],'Yes'));
				$row = $sqlItems->fetch(PDO::FETCH_ASSOC);
				if($row['strItems']!=""){
					$arrItems = explode('|',$row['strItems']);
					for($i=0; $i<count($arrItems); $i++){
						$arrItemEntry = explode('*',$arrItems[$i]);
						if($arrItemEntry[0]==$itemCode){
							$quantity = $arrItemEntry[1];
							$contacts = $arrItemEntry[2]=="default"?'':$arrItemEntry[2].',';
							if($quantity != $entryQuantity){
								$quantity = $entryQuantity;
								$change = true;
							}
							if($contacts!='default' || $contacts != $strContacts){
								$contacts .= $strContacts;
								$change = true;
							}
							
							$strItem = $itemCode.'*'.$quantity.'*'.$contacts;
							$arrItems[$i] = $strItem;
							
							break;
						}
					}
					if($change){
						$strItems = implode('|',$arrItems);
						$sqlUpdate = $DBMS_temp->dataconn->prepare("UPDATE registry SET strItems=?, lastModification=? WHERE userId=? AND active=?");
						$sqlUpdate->execute(array($strItems,date_time(),$_SESSION['account']['refUserId'],'Yes'));
						$strUpdate = '1.0'; //successful execution
					}else{
						$strUpdate = '1.1'; //no update done;
					}
				}else{
					$strUpdate = '1.2'; //strItems is empty;
				}
			}else{
					$strUpdate = '1.3'; //strItems is empty;
				}
		}catch(PDOException $e){
			$strUpdate = '2.1';  //error
		}
		
		$strReturnHTML = $strUpdate; 
	}

}

echo($strReturnHTML);


?>