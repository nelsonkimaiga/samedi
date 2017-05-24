<?php
include($_SESSION['page']['home_url'].'shop/bin/shop.db.php');

class Module_ManageUserRegistry{

private $DBMS;
private $DB_NAME;
private $setHeadingHTML;

public $strDivHTML;
public $strItemsCount;

function __construct($database,$userId){
	$this->DB_NAME = $database;
	$this->DBMS = new Shop_DBMS($this->DB_NAME);
	$this->userID = $userId;
	$this->strDivHTML = '';
	$this->setHeadingHTML = 0;
}

private function setSecondaryDatabase($database){
	$dbms_sec = new Shop_DBMS($database);
	return $dbms_sec;
}

public function getRegistry(){
	$strItems = $this->grapItemString();
	if($strItems!='abort'){
		$this->processStrItems($strItems);
	}else{
		$this->strDivHTML =  '<div class="alert alert-info row-fluid" style="margin-left:0; margin-bottom:20%">
				You have not created a registry yet.
				</div>';
	}
}

private function grapItemString(){
	$strReturn = 'nill';
	$sqlStrItems=$this->DBMS->dataconn->prepare("SELECT active_registry FROM users WHERE userId=?");
	$sqlStrItems->execute(array($this->userID));
	$row = $sqlStrItems->fetch(PDO::FETCH_ASSOC);
	
	if($row['active_registry']!='' && $row['active_registry']!='(empty)'){
		$registry = $row['active_registry'];
		$temp_DB = $this->setSecondaryDatabase('samedico_'.$registry);
		if($temp_DB->dbconnection_status){
			$sqlGetStr = $temp_DB->dataconn->prepare("SELECT * FROM registry WHERE userId=?");
			$sqlGetStr->execute(array($this->userID));
			$row = $sqlGetStr->fetch(PDO::FETCH_ASSOC);
			$strReturn = $row['strItems'];
		}
	}else{
		$strReturn = 'abort';
	}
	
	return $strReturn;
}

private function processStrItems($strItems){
	$items_tempDB = $this->setSecondaryDatabase('samedico_shop');
	$arrItems = explode('|',$strItems);
	$this->strItemsCount = count($arrItems);
	for($i=0; $i<count($arrItems); $i++){
		$arrItemDetails = explode('*',$arrItems[$i]);
		$sqlItemDetails = $items_tempDB->dataconn->prepare("SELECT * FROM items_data WHERE item_code=?");
		$sqlItemDetails->execute(array($arrItemDetails[0]));
		
		$row = $sqlItemDetails->fetch(PDO::FETCH_ASSOC);
		
		$detailsContainer = $this->appendToContainer($row,$arrItemDetails[0],$arrItemDetails[1]);
	}
}

private function appendToContainer($details, $itemCode, $itemQuantity){
	//modify and preset variables

	$castPrice = intval($this->replaceChars($details['sale_price'], ',', ''));
	$itemSum = $castPrice * $itemQuantity;
	
	$quantityHTML = '';
	for($i=1; $i<=$details['set_max_quantity']; $i++){
		if($itemQuantity == $i){
			$quantityHTML .= '<option selected="selected" value="'.$i.'">'.$i.'</option>';
		}else{
			$quantityHTML .= '<option value="'.$i.'">'.$i.'</option>';
		}
	}
	
	if($this->setHeadingHTML == 0){
		$strDivHead = '<div class="row-fluid item-div-container container-grey item-specific-'.$itemCode.'">';
		$this->setHeadingHTML = 1;
	}else{
		$strDivHead = '<div class="row-fluid item-div-container container-white item-specific-'.$itemCode.'">';
		$this->setHeadingHTML = 0;
	}
	$this->strDivHTML .=	$strDivHead.
				'<div class="span3">
					<img class="" src="'.$_SESSION['page']['home_url'].'img/'.$details['image'].'" /><br />
					<div class="item-abstract">
						<a href="'.$_SESSION['page']['home_url'].'shop/'.$details['page_url'].'">'.substr($details['abstract'],0,60).'</a>
					</div>
				</div>
				
				<div class="span3">
					<div class="heading-16">
						<sup>Ksh.</sup><span class="item-price-'.$itemCode.'">'.$details['sale_price'].'</span><sup>00</sup>&nbsp;
					</div>
					<div class="item-quantity"><h5>Quantity: <span class="item-quantity-'.$itemCode.'">'.$itemQuantity.'</span></h5></div>
					<div class="row-fluid">
						<div class="span2">Change Quantity</div>
						<div class="span1">&nbsp;</div>
						<div class="span7">
							<select class="input-small item-set-quantity-'.$itemCode.'" onchange="javascript:REGISTRYMOD.modifyQuantity('.$itemCode.','.$castPrice.')">
								'.$quantityHTML.'
							</select>
						</div>
					</div><br />
					<div class="amount-total">
							 = Ksh. <span class="item-sum-'.$itemCode.'">'.$this->reFormatPrice($itemSum).'</span>
					</div>
				</div>
				
				<div class="span3 item-messages">
					<div class="heading-13">Message:</div>
					<div>
						<label><input type="radio" name="radio-contact-'.$itemCode.'" checked="checked" value="Default" onclick="javascript:REGISTRYMOD.itemMessages('.$itemCode.',\'default\')"/>Use default</label>
						<label><input type="radio" name="radio-contact-'.$itemCode.'" value="Specified Contacts" onclick="javascript:REGISTRYMOD.itemMessages('.$itemCode.',\'load_contacts\')"/>Select contact(s) to send a request for this item</label><br />	
					</div>
					
					<div class="item-contacts item-contacts-'.$itemCode.'">
						Default Messages
					</div>
				</div>
				<div class="span3 item-buttons">
					<div><button class="btn btn-primary btn-mini" onclick="javascript:REGISTRYMOD.saveItemChanges('.$itemCode.')">Save Changes</button></div><br /><br />
					<div><button class="btn btn-warning btn-mini">Remove item</button></div><br />
					<div class="alert alert-warning item-alert-'.$itemCode.'" style="display:none">
						You have not selected any contacts. Select a contact or re-select <strong>Use Default</strong>.
					</div>
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