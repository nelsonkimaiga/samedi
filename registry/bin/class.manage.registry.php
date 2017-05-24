<?php


class Module_ManageUserRegistry{

private $DBMS;
private $DB_NAME;
private $userTbl;
private $setHeadingHTML;
private $activeRegistry;

public $strDivHTML;
public $strItemsCount;

function __construct($database,$userId){
	$this->DB_NAME = $database;
	$this->DBMS = new user_DBMS($this->DB_NAME);
	$this->userID = $userId;
	$this->strDivHTML = '';
	$this->setHeadingHTML = 0;
}

private function setSecondaryDatabase($database){
	$dbms_sec = new user_DBMS($database);
	return $dbms_sec;
}

public function getRegistry(){
	$strItems = $this->grapItemString();
	if($strItems!='abort'){
		$this->processStrItems();
	}else{
		$this->strDivHTML =  '<div class="alert alert-info row-fluid" style="margin-left:0; margin-bottom:20%">
				You have not created a registry yet.
				</div>';
	}
}

private function processUserRegistryID($registry){
	$userId = $this->userID;
	$activeRegistry = $registry;
	$userId_new = strtolower(str_replace("/","_",$userId));
	$userTbl = $activeRegistry.'_'.$userId_new;
	
	return $userTbl;
}

private function grapItemString(){
	$strReturn = 'nill';
	$sqlStrItems=$this->DBMS->dataconn->prepare("SELECT active_registry FROM users WHERE userId=?");
	$sqlStrItems->execute(array($this->userID));
	$row = $sqlStrItems->fetch(PDO::FETCH_ASSOC);
	
	if($row['active_registry']!='' && $row['active_registry']!='(empty)'){
		$registry = $row['active_registry'];
		$this->activeRegistry = $registry;
		$this->userTbl = $this->processUserRegistryID($registry);
	}else{
		$strReturn = 'abort';
	}
	
	return $strReturn;
}

private function processStrItems(){
	$items_tempDB = $this->setSecondaryDatabase('samedico_gifts_registry');
	
	$sqlSelect = "SELECT * FROM ".$this->userTbl." ORDER BY entryId DESC";
	$sqlSelect = $items_tempDB->dataconn->query($sqlSelect);
	$this->strItemsCount = $sqlSelect->rowCount();
	
	while($row = $sqlSelect->fetch(PDO::FETCH_ASSOC)){
		$detailsContainer = $this->appendToContainer($row);
	}

}

private function appendToContainer($row){
	$itemId = $row['entryId'];
	if($this->setHeadingHTML == 0){
		$strDivHead = '<div class="row-fluid item-div-container container-grey item-specific-'.$row['entryId'].'">';
		$this->setHeadingHTML = 1;
	}else{
		$strDivHead = '<div class="row-fluid item-div-container container-white item-specific-'.$row['entryId'].'">';
		$this->setHeadingHTML = 0;
	}
	if($row['image'] == NULL){
		$imageURL = 'default.jpg';
	}else{
		$imageURL = $row['image'];
	}
	$this->strDivHTML .=	$strDivHead.
				'<div class="span5 row-fluid">
					<img class="span6" src="'.$_SESSION['page']['home_url'].'img/registry/'.$this->activeRegistry.'/'.$imageURL.'" /><br />
				</div>
				<div class="span5" style="margin-left:-10%">
					<div style="background:#0078B3; opacity:0.7; color:#FFF; padding:10px">
						'.$row['giftName'].'&nbsp;('.$row['giftCode'].')
					</div><br />
					<div>
						'.$row['description'].'
					</div><br />
					<div>
						Requested: '.$row['quantity'].'<br />
						Purchased: '.$row['purchased'].'<br />
						Pledged: '.$row['pledged'].'
					</div>
					
				</div>
					<div class="span2">
						<div><button class="btn btn-info btn-mini" onclick="MANAGE_REGISTRY.editItem('.$itemId.',\''.$this->activeRegistry.'\')">Edit item</button></div><br />
						<div><button class="btn btn-warning btn-mini" onclick="javascript:MANAGE_REGISTRY.deleteItem('.$itemId.',\''.$this->activeRegistry.'\')">Remove item</button></div><br />
					</div>
				
			</div>';
	
}

private function replaceChars($strToSearch, $charToReplace, $charToSet){
	//$arrChar = explode('|',$charToReplace);
	if(strpos($strToSearch,$charToReplace)){
		$strToSearch = str_replace($charToReplace,$charToSet,$strToSearch);
	}
	
	return $strToSearch;
}

private function reFormatPrice($price){
	$strLen = strlen($price);
	$strPrice = '';
	if($strLen==4){
		$str_pre = substr($price,0,1);
		$str_post = substr($price,1);
		$strPrice = $str_pre.','.$str_post;
	}elseif($strLen==5){
		$str_pre = substr($price,0,2);
		$str_post = substr($price,2);
		$strPrice = $str_pre.','.$str_post;
	}elseif($strLen==6){
		$str_pre = substr($price,0,3);
		$str_post = substr($price,3);
		$strPrice = $str_pre.','.$str_post;
	}else{
		$strPrice = $price;
	}

	return $strPrice;
}

}
?>