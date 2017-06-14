<?php
include('../../bin/shop.db.php');

class InvitationRegistry_Module{
protected $userId;
protected $inviteCode;
protected $itemCounter;
protected $arrItems;

public $brideInfo;
public $groomInfo;
public $weddingDate;
public $weddingLocation;
public $registry;
public $strHTMLContainer;
public $itemsCount;
public $weddingImages;

public $publicRegCount;
public $strDivHTML;
public $existingUser;

function __construct($userId){
	$this->userId = $userId;
	$this->inviteCode = '';
	$this->itemCounter = 0;
	$this->strHTMLContainer = '';
	$this->publicRegCount = 0;
	$this->strDivHTML = '';
	$this->existingUser = true;
	$_SESSION['items']['item_quantity'] = array();
}
private function setDatabase($database){
	$db_temp = new Shop_DBMS($database);
	
	return $db_temp;
}
public function getDetails(){
	$this->registryDetails();
}

public function getPublicRegistries(){
	$invite_TEMPDB = $this->setDatabase('samedico_samedi');
	try{
		if($invite_TEMPDB->dbconnection_status){
			$sqlRegistry = $invite_TEMPDB->dataconn->prepare("SELECT * FROM invitations WHERE registry=? AND access=?");
			$sqlRegistry->execute(array('graduation_registry','public'));
			if($sqlRegistry->rowCount()>0){
				$this->publicRegCount = $sqlRegistry->rowCount();
				while($row = $sqlRegistry->fetch(PDO::FETCH_ASSOC)){
					$this->strDivHTML .= $this->strPublicRegEntries($row['userId']);
				}
			}else{
				$this->strDivHTML = '
					<div class="alert alert-info large-12 columns" style="margin-left:0; margin-top:10px;">
						There are no graduation registries yet.
					</div>
				';
		}
		}else{
			
		}
	}catch(PDOException $e){
		
	}
	
}

private function strPublicRegEntries($userId){
	$invite_TEMPDB = $this->setDatabase('samedico_graduation_registry');
	$itemsCount = 0;
	try{
		if($invite_TEMPDB->dbconnection_status){
			$sqlRegistry = $invite_TEMPDB->dataconn->prepare("SELECT * FROM usr_registries WHERE userId=? AND active=? LIMIT 1");
			$sqlRegistry->execute(array($userId,'Yes'));
			if($sqlRegistry->rowCount()>0){
				$row = $sqlRegistry->fetch(PDO::FETCH_ASSOC);
				$brideInfoP = explode('*',$row['bride_info']);
				$groomInfoP = explode('*',$row['groom_info']);
				$weddingDateP = $row['wedding_date'];
				$profileImage = $row['images'];
			$sqlRegistryCount = $invite_TEMPDB->dataconn->prepare("SELECT * FROM registry WHERE userId=? AND active=? LIMIT 1");
			$sqlRegistryCount->execute(array($userId,'Yes'));
				if($sqlRegistryCount->rowCount()>0){
					$row = $sqlRegistryCount->fetch(PDO::FETCH_ASSOC);
					$arrItems = explode('|',$row['strItems']);
					$itemsCount = count($arrItems);
				}
			}
			
			$userURL = explode('/',$userId);
			$userIdFormat = str_replace('/','.',$userId);
			$strToDiv = '
				<a href="../view-registry/?regid='.$userURL[1].'&regid_b='.md5($userId).'" class="span3">
				<div class="" style="border-right:solid 2px #000000">
					<div class="regNames" style="padding:2%; background:#E6E6E6; border-bottom:solid 2px #999999; font-size:18px; font-weight:bold">
						<div style="float:left">
							<img src="http://localhost/samedi/account/wedding-registry/'.strtoupper($userIdFormat).'/'.$profileImage.'" height="70" width="70" />&nbsp;&nbsp;
						</div>
						<div style="height:80px">'.$brideInfoP[0].' &  '.$groomInfoP[0].'&rsquo;s Wedding</div>
					</div>
					<div class="regDate">
						Date: &nbsp;<span style="font-size:14px; font-weight:bold">'.$weddingDateP.'</span>
					</div>
					<div class="regItems">
						&nbsp;&nbsp;&nbsp;<strong>'.$itemsCount.'</strong> Item(s) in their registry
					</div>
				</div>
			</a>
			';
		}else{
		
		}
	}catch(PDOException $e){
		
	}
	
	return $strToDiv;
}


private function registryDetails(){
	$invite_TEMPDB = $this->setDatabase('samedico_samedi');
	try{
		if($invite_TEMPDB->dbconnection_status){
			$sqlUser = $invite_TEMPDB->dataconn->prepare("SELECT * FROM users WHERE entryId=? LIMIT 1");
			$sqlUser->execute(array($this->userId));
			if($sqlUser->rowCount()>0){
				$row = $sqlUser->fetch(PDO::FETCH_ASSOC);
				$this->userId = $row['userId'];
				$sqlRegistry = $invite_TEMPDB->dataconn->prepare("SELECT * FROM invitations WHERE userId=? AND registry=? LIMIT 1");
				$sqlRegistry->execute(array($this->userId,'graduation_registry'));
				if($sqlRegistry->rowCount()>0){
					$row = $sqlRegistry->fetch(PDO::FETCH_ASSOC);
					$registry_TEMPDB = $this->setDatabase('samedico_'.$row['registry']);
					$this->registry = $row['registry'];
					//$_SESSION['registry']['invitation_user'] = $this->userId;
					//$_SESSION['registry']['invitation_code'] = '';
					$sqlGetDetails = $registry_TEMPDB->dataconn->prepare("SELECT * FROM usr_registries WHERE userId=?");
					$sqlGetDetails->execute(array($this->userId));
					
					$row = $sqlGetDetails->fetch(PDO::FETCH_ASSOC);
					$this->brideInfo = $this->strSplitNames($row['bride_info'],'*');
					$this->groomInfo = $this->strSplitNames($row['groom_info'],'*');
					$this->weddingDate = $row['wedding_date'];
					$this->weddingLocation = $row['wedding_location'];
					$this->weddingImages = $row['images'];
				}else{
					$this->existingUser = false;
				}
			}else{
				//user does not exist
				$this->existingUser = false;
			}
		}else{
			//connection error
		}
	}catch(PDOException $e){
		
	}
}

public function processImages(){
	 //begin with one image
	 $userId = str_replace('/','.',$this->userId);
	 $imageLink = '<img src="'.$_SESSION['page']['home_url'].'account/graduation-registry/'.$userId.'/'.$this->weddingImages.'" />';
	 return $imageLink;
}

private function strSplitNames($str, $char){
	$arrStr = explode($char,$str);
	
	$firstName = $arrStr[0];
	$secondName = $arrStr[1];
	
	return $firstName.' '.$secondName;
}

public function getItems(){
	$registry_TEMPDB = $this->setDatabase('samedico_'.$this->registry);
	$sqlItems = $registry_TEMPDB->dataconn->prepare("SELECT * FROM registry WHERE userId=? AND active=? LIMIT 1");
	$sqlItems->execute(array($this->userId,'Yes'));
	
	if($sqlItems->rowCount()>0){
		$row = $sqlItems->fetch(PDO::FETCH_ASSOC);
		$this->processStrItmes($row['strItems']);
	}else{
		$this->strHTMLContainer = '<div class="alert alert-info">We have not started a registry yet.</div>';
	}
	
}

private function processStrItmes($strItems){                         
	$shop_TEMPDB = $this->setDatabase('samedico_shop');
	$arrItems = explode('|',$strItems);
	$this->itemsCount = count($arrItems);
	
	for($i=0; $i<count($arrItems); $i++){
		$arrItemDetails = explode('*',$arrItems[$i]);
		$sqlItem = $shop_TEMPDB->dataconn->prepare("SELECT * FROM items_data WHERE item_code=?");
		$sqlItem->execute(array($arrItemDetails[0]));
		if($sqlItem->rowCount()>0){
			$row = $sqlItem->fetch(PDO::FETCH_ASSOC);
			$this->setHTMLContainer($row,$arrItemDetails[1],$arrItemDetails[0]);
		}
	}
	
	
}

private function setHTMLContainer($details,$quantity,$itemCode){
	$strHTML = '';
	if($this->itemCounter==0){
		$contHeading = '<div class="row-fluid item-div-container container-grey" style="padding:5px">';
		$this->itemCounter = 1;
	}else{
		$contHeading = '<div class="row-fluid item-div-container container-white" style="padding:5px">';
		$this->itemCounter = 0;
	}
	
	$arrUser = explode('/',$this->userId);
	
	$quantityPurchased = $this->getPurchases($itemCode,$quantity);
	if($quantityPurchased == $quantity){
		$strBtnHTML = '
			<br><br>
			<div class="alert alert-info">Fully Purchased</div>
			';	
	}else{
		$dir = $this->replaceChar($this->registry,'_');
		$strBtnHTML = '
			<br /><br />
			<div><button class="btn btn-warning" onclick="javascript:window.location.assign(\''.$_SESSION['page']['home_url'].'shop/'.$dir.'/purchase/?regid='.$arrUser[1].'&itemCode='.$itemCode.'&amp;VserNo='.md5($itemCode).'&amp;encrypt_connection=true\')">Purchase this item</button></div>
			';
	}
	$strHTML = $contHeading.'
						<div class="span3">
							<img class="" src="'.$_SESSION['page']['home_url'].'img/'.$details['image'].'" /><br /><br />
						</div>
						<div class="span3 item-abstract" style="font-size:16px">
							<a href="'.$_SESSION['page']['home_url'].'shop/'.$details['page_url'].'">'.$details['abstract'].'</a>
						</div>
						<div class="span2 item-quantity" style="font-size:16px">
							<h4>Quantity</h4>
							<h5>Items Bought : '.$quantityPurchased.'<br /><br />
							Items Remaining: '.($quantity - $quantityPurchased).'</h5>
						</div>
						<div class="span1 item-quantity" style="font-size:20px; font-weight:bold">
							<h4>Price @</h4>
							<sup>Ksh.</sup><span class="item-price-itemCode">'.$details['sale_price'].'</span><sup>00</sup>&nbsp;
						</div>
						<div class="span1">&nbsp;</div>
						<div class="span2 item-buttons">
							'.$strBtnHTML.'
						</div>
					</div>
		';
		
		$this->strHTMLContainer .= $strHTML;
}

private function getPurchases($itemCode,$quantity){
	$regsitry_TEMPDB = $this->setDatabase('samedico_'.$this->registry);
	$purchasedQuantity = 0;
	$sqlPurchases = $regsitry_TEMPDB->dataconn->prepare("SELECT purchases FROM registry WHERE userId=? LIMIT 1");
	if($sqlPurchases->rowCount()>0){
		$row = $sqlPurchases->fetch(PDO::FETCH_ASSOC);
		$purchases = $row['purchases'];
		if($purchases != '' || $purchases != '(empty)'){
			$arrPurchases = explode('|',$purchases);
			for($i=0; $i<count($arrPurchases); $i++){
				$arrPurchasesItem = explode('*',$arrPurchases[$i]);
				if($arrPurchasesItem[0] == $itemCode){
					$purchasedQuantity = $arrPurchasesItem[1];
					break;
				}
			}
		}
	}else{
	
	}
	
	return $purchasedQuantity;
}

private function replaceChar($strTo, $charTo){
	if(strpos($strTo,$charTo)){
		$strTo = str_replace($charTo,'-',$strTo);
	}
	return $strTo;
}


public function getPurchaseItem(){
	
}

private function processPurchaseItem($itemCode){
	$shop_TEMPDB = $this->setDatabase('samedico_shop');

	$sqlItem = $shop_TEMPDB->dataconn->prepare("SELECT * FROM items_data WHERE item_code=?");
	$sqlItem->execute(array($itemCode));
	if($sqlItem->rowCount()>0){
		$row = $sqlItem->fetch(PDO::FETCH_ASSOC);
		$this->setPurchaseHTMLContainer($row,$arrItemDetails[1],$arrItemDetails[0]);
	}
}



} //end class

?>