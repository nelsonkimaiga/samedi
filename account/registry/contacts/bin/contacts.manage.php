<?php

session_start();

include('../../../bin/user.db.php');
include('../../../../bin/global.code.php');

$DB_NAME = 'samedico_samedi';
$DBMS = new user_DBMS($DB_NAME);

$strScriptReturn = '';

$name = removeCharacters($_REQUEST['name'],'*,|');
$phone = '(+254) '.$_REQUEST['phone'];

if(isset($_REQUEST['config']) && $_REQUEST['config'] == 'update'){
	$strScriptReturn=updateExisitingContact($_REQUEST['arrKey']);
}elseif(isset($_REQUEST['config']) && $_REQUEST['config'] == 'delete'){
	$strScriptReturn=deleteContact($_REQUEST['arrKey']);
}else{
	$strScriptReturn=addANewContact();
}

echo($strScriptReturn);

function addANewContact(){
	try{
		global $DBMS,$name, $phone;
		if($DBMS->dbconnection_status){
			$strContact = '';
			$found = false;
			$sqlContact = $DBMS->dataconn->prepare("SELECT registry_contacts FROM account_status WHERE userId=? LIMIT 1");
			$sqlContact->execute(array($_SESSION['account']['refUserId']));
			
			$row = $sqlContact->fetch(PDO::FETCH_ASSOC);
			if($row['registry_contacts']=='(empty)'){
				$strContact = $name.'*'.$phone;
				$found = false;
			}else{
				$strContact = $row['registry_contacts'];
				$arrContacts = explode('|',$strContact);
				for($i=0; $i<count($arrContacts); $i++){
					$arrSub = array();
					$arrSub = explode('*',$arrContacts[$i]);
					if($arrSub[0]!=''){
						$found = ($arrSub[1]==$phone)?true:false;
						$strScriptReturn = '1.1*'.$arrSub[0].'*'.$arrSub[1];
						break;
					}
				}
				if(!$found){
					$strContact .= '|'.$name.'*'.$phone;
				 }
			}
			if(!$found){
				$sqlUpdateContact = $DBMS->dataconn->prepare("UPDATE account_status SET registry_contacts=?, last_contact_added=? WHERE userId=?");
				$sqlUpdateContact->execute(array($strContact,date_time(),$_SESSION['account']['refUserId']));
				$strScriptReturn = '1.0*nill';
			 }
					
		}else{
			$strScriptReturn = '1.2*nill';
		}
		
		return $strScriptReturn;
	}catch(PDOException $e){
		$strScriptReturn = '1.3*nill';
		return $strScriptReturn;
	}
}


function updateExisitingContact($contactKey){
	try{
		global $DBMS,$name, $phone;
		if($DBMS->dbconnection_status){
			$strContact = '';
			$found = false;
			$sqlContact = $DBMS->dataconn->prepare("SELECT registry_contacts FROM account_status WHERE userId=? LIMIT 1");
			$sqlContact->execute(array($_SESSION['account']['refUserId']));
			if($sqlContact->rowCount()>0){
				$row = $sqlContact->fetch(PDO::FETCH_ASSOC);
				if($row['registry_contacts']!='(empty)'){
					$arrContacts = explode('|',$row['registry_contacts']);
					$itemDetails = $arrContacts[$contactKey];
					$arrDetails = explode('*',$itemDetails);
					$arrDetails[0]=$name;
					$arrDetails[1]=$phone;
					$arrContacts[$contactKey] = implode('*',$arrDetails);
					$strContact = implode('|',$arrContacts);
					$sqlUpdate = $DBMS->dataconn->prepare("UPDATE account_status SET registry_contacts=?, last_contact_added=? WHERE userId=?");
					$sqlUpdate->execute(array($strContact,date_time(),$_SESSION['account']['refUserId']));
					
					$strScriptReturn = '1.0';
				}else{
					$strScriptReturn = '1.1a';
				}
			}else{
				$strScriptReturn = '1.1b';
			}
		}else{
			$strScriptReturn = '1.1c';
		}
		return $strScriptReturn;
		
	}catch(PDOException $e){
		$strScriptReturn = '1.1d';
		return $strScriptReturn;
	}
}

function deleteContact($contactKey){
	try{
		global $DBMS,$name;
		$phone = $_REQUEST['phone'];
		$deleted = false;
		if($DBMS->dbconnection_status){
			$strContact = '';
			$found = false;
			$strScriptReturn = 'none';
			$sqlContact = $DBMS->dataconn->prepare("SELECT registry_contacts FROM account_status WHERE userId=? LIMIT 1");
			$sqlContact->execute(array($_SESSION['account']['refUserId']));
			if($sqlContact->rowCount()>0){
				$row = $sqlContact->fetch(PDO::FETCH_ASSOC);
				if($row['registry_contacts']!='(empty)'){
					$arrContacts = explode('|',$row['registry_contacts']);
					for($i=0; $i<count($arrContacts); $i++){
						$arrSub = explode('*',$arrContacts[$i]);
						if($arrSub[0]!=''){
							if(strtolower($arrSub[0])==$name && $arrSub[1]==$phone){
								$deleted = true;
								$strScriptReturn = 'deleted';
								continue;
							}else{
								if($i==0){
									$strContact = $arrSub[0].'*'.$arrSub[1];
								}else{
									$strContact .= '|'.$arrSub[0].'*'.$arrSub[1];
								}
							}
						}else{
							$strScriptReturn = '1.1e';
						}
					}
				 }else{
					$strScriptReturn = '1.1a';
				}
			}else{
				$strScriptReturn = '1.1b';
			}
		}else{
			$strScriptReturn = '1.1c';
		}
		
		if($deleted){
			if($strContact==""){
				$strContact = '(empty)';
			}
			$sqlUpdate = $DBMS->dataconn->prepare("UPDATE account_status SET registry_contacts=?, last_contact_added=? WHERE userId=? LIMIT 1");
			$sqlUpdate->execute(array($strContact,$strContact,$_SESSION['account']['refUserId']));
			$strScriptReturn = '1.0';
		}
		
		return $strScriptReturn;
	}catch(PDOException $e){
		$strScriptReturn = '1.1d'.$e->getMessage();
		return $strScriptReturn;
	}
}

?>