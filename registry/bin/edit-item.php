<?php

class _MANAGE_ITEM_EDIT{
public $strData;

private $UserID;
private $registry;
private $userTable;
private $entryId;

function __construct($entryId, $registry,$user){
	$this->registry = $registry;
	$this->entryId = $entryId;
	$this->UserID = $user;
}

private function setDatabase(){
	$DBMS = new user_DBMS('samedico_gifts_registry');
	return $DBMS;
	
}
public function processItem(){
	$items = array();
	$DBMS = $this->setDatabase();
	$this->processUser();
	
	if($DBMS->dbconnection_status){
		$sqlSelect = $DBMS->dataconn->prepare("SELECT * FROM ".$this->userTable." WHERE entryId=?");
		$sqlSelect->execute(array($this->entryId));
		if($sqlSelect->rowCount()>0){
			$row = $sqlSelect->fetch(PDO::FETCH_ASSOC);
			$items = array(0=>$row['entryId'],
							$row['giftCode'],
							$row['giftName'],
							$row['quantity'],
							$row['description'],
							$row['store']
							);
		}
	}
	
	return $items;
}

public function processUser(){
	$userId = $this->UserID;
	$activeRegistry = $this->registry;
	$userId_new = strtolower(str_replace("/","_",$userId));
	$userTbl = $activeRegistry.'_'.$userId_new;
	
	$this->userTable = $userTbl;
}



}
?>