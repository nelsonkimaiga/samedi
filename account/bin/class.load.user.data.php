<?php
include($_SESSION['page']['home_url'].'account/bin/user.db.php');

class UserDataModule{

private $DB_NAME;
private $UserID;
private $DBMS;

public $intCartCount;
public $intRegistryCount;
public $intRegistries;
public $activeRegistry;

function __constructor(){
	$this->intCartCount = 0;
	$this->intRegistryCount = 0;
	$this->intRegistries = 0;
	$this->activeRegistry = NULL;
}

private function setSecondaryDatabase($database){
	$dbms_sec = new user_DBMS($database);
	return $dbms_sec;
}

public function getDetails($userId){
	$this->processCart($userId);
	$this->processRegistry($userId);
}

private function processCart($userId){
	$cart_TEMPDB = $this->setSecondaryDatabase('samedico_shop');
	try{
		if($cart_TEMPDB->dbconnection_status){
			$sqlCart = $cart_TEMPDB->dataconn->prepare("SELECT strItems FROM cart WHERE userId=? and active<>?");
			$sqlCart->execute(array($userId, 'No'));
			if($sqlCart->rowCount()>0){
				$row = $sqlCart->fetch(PDO::FETCH_ASSOC);
				$this->intCartCount = $this->setCount($row['strItems']);
			}else{
				$this->intCartCount = 0;
			}
		}
	}catch(PDOException $e){
		$strResp = 'Error in  try catch';
	}
	
}

private function processRegistry($userId){
try{
	$registry_TEMPDB = $this->setSecondaryDatabase('samedico_samedi');
	if($registry_TEMPDB->dbconnection_status){
		$sqlUserRegistry = $registry_TEMPDB->dataconn->prepare("SELECT * FROM users WHERE userId=?");
		$sqlUserRegistry->execute(array($userId));
		$row = $sqlUserRegistry->fetch(PDO::FETCH_ASSOC);
		
		if(trim($row['active_registry'])!='(empty)'){
			$this->registeredRegistries($row['active_registry']);
			$reg_TEMPDB = $this->setSecondaryDatabase('samedico_'.$row['active_registry']);
			$sqlReg = $reg_TEMPDB->dataconn->prepare("SELECT strItems FROM registry WHERE userId=? and active=?");
			$sqlReg->execute(array($userId, 'Yes'));
			if($sqlReg->rowCount()>0){
				$row = $sqlReg->fetch(PDO::FETCH_ASSOC);
				$this->intRegistryCount = $this->setCount($row['strItems']);
			}else{
				$this->intRegistryCount = 0;
		}
		}else{
			$this->intRegistryCount = 0;
		}
	}else{
		$this->intRegistryCount = 0;
	}
}catch(PDOException $e){
	$this->intRegistryCount = -1;
}

}

public function registeredRegistries($str){
	$arr = explode("*", $str);
	$this->intRegistries = count($arr);
	if($this->intRegistries == 1){
		$this->activeRegistry = $arr[0];	
	}
}

private function setCount($strItems){
	$arrItems = explode('|',$strItems);
	return count($arrItems);
}


}

?>