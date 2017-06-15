<?php

class ManageRegistryModule{

private $DB_NAME;
private $UserID;
private $DBMS;

protected $RegistryName;
protected $RegistryDateStarted;
protected $RegistryDateModified;
protected $RegistryItems;
protected $strRegistryLink;


public $strRegistryHTML;


function __constructor(){
	$this->strRegistryHTML = "";
	$this->RegistryItems = 0;
	$this->RegistryDateModified = "(Not Started)";
	$this->RegistryDateStarted = "(Not Started)";
}

private function setSecondaryDatabase($database){
	$dbms_sec = new user_DBMS($database);
	return $dbms_sec;

}

public function getRegistryList($userId){
	$this->strRegistryHTML = "";
	$this->UserID = $userId;
	$this->getUserRegistry();
	
}

private function getUserRegistry(){
	$DBMS = $this->setSecondaryDatabase('samedico_samedi');
	if($DBMS->dbconnection_status){
		$sqlRegistryList = $DBMS->dataconn->prepare("SELECT active_registry FROM users WHERE userId=?");
		$sqlRegistryList->execute(array($this->UserID));
		if($sqlRegistryList->rowCount()>0){
			$row = $sqlRegistryList->fetch(PDO::FETCH_ASSOC);
			$strList = $row['active_registry'];
			if($strList!="" && $strList!="(empty)"){
				$this->processUserRegistry($strList);
			}else{
				$this->strRegistryHTML = '<div class="alert alert-info row-fluid" style="margin-left:0; margin-bottom:10px">
				You have not created a registry yet.
				</div>';
			}
		}
	}
}

private function processUserRegistry($strList){
	$arrList = explode('*',$strList);
	for($i=0; $i<count($arrList); $i++){
		$this->RegistryName = $this->getREGName($arrList[$i]);
		$DBMS_temp = $this->processIndividualREG($arrList[$i]);
		$this->getItemsCount($arrList[$i]);
		$this->createHTML();
	}
	
}

private function processIndividualREG($regDatabase){
	$DBMS_temp = $this->setSecondaryDatabase('samedico_'.$regDatabase);
	if($DBMS_temp->dbconnection_status){
		$sqlUserReg = $DBMS_temp->dataconn->prepare("SELECT date_created, last_modified FROM usr_registries WHERE userId=?");
		$sqlUserReg->execute(array($this->UserID));
		if($sqlUserReg->rowCount()>0){
			$row = $sqlUserReg->fetch(PDO::FETCH_ASSOC);
			$this->RegistryDateStarted = $row['date_created'];
			$this->RegistryDateModified = $row['last_modified'];
		}
	}
	
	return $DBMS_temp;
}

private function getItemsCount($registry){
	$userTable = $this->processUser($registry);
	$DBMS_temp = $this->setSecondaryDatabase('samedico_gifts_registry');
	if($DBMS_temp->dbconnection_status){
		$sqlItems = $DBMS_temp->dataconn->query("SELECT entryId FROM ".$userTable."");
			$this->RegistryItems = $sqlItems->rowCount();
	}
}

private function createHTML(){
	$this->strRegistryHTML .= '

		<div class="alert alert-info row-fluid" style="margin-left:0; margin-bottom:10px">
			<a href="'.$_SESSION['page']['home_url'].$this->strRegistryLink.'">
				<div class="large-3 columns">
					'.$this->RegistryName.'
				</div>
				<div class="large-3 columns">
					Started On: '.$this->RegistryDateStarted.'
				</div>
				<div class="large-3 columns">
					Last Modified: '.$this->RegistryDateModified.'
				</div>
				<div class="large-3 columns">
					Item(s) Selected:- '.$this->RegistryItems.'
				</div>
			</a>
		</div>
		';
}

private function getREGName($reg){
	$strName = '';
	switch($reg){
		case 'wedding_registry':
			$strName = "Wedding Registry";
			$this->strRegistryLink = 'account/wedding-registry/?edit_details=ok';
			break;
		case 'babyshower_registry':
			$strName = "Baby Shower Registry";
			$this->strRegistryLink = 'account/babyshower-registry/?edit_details=ok';
			break;
		case 'graduation_registry':
			$strName = "Graduation Registry";
			$this->strRegistryLink = 'account/graduation-registry/?edit_details=ok';
			break;
		default:
			break;
	}
	
	return $strName;
}

private function processUser($registry){
	$userId = $this->UserID;
	$activeRegistry = $registry;
	$userId_new = strtolower(str_replace("/","_",$userId));
	$userTbl = $activeRegistry.'_'.$userId_new;
	$this->_tableExists($userTbl);
	
	return $userTbl;
}

private function _tableExists($userTbl){
 $DBMS = $this->setSecondaryDatabase('samedico_gifts_registry');
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


}

?>