<?php
class SHOPPurchase_Mod{

protected $itemCode;
protected $registry;
protected $userKey;

public $arrItemData;
function __construct(){

}

private function setDatabase($database){
	$db_temp = new Shop_DBMS($database);
	
	return $db_temp;
}

public function getProductDetails($itemKey){
	$this->itemCode = $itemKey;
	
	return $this->productDetails(); 
}
private function productDetails(){
	$productDB = $this->setDatabase('samedico_shop');
	$sqlItem = $productDB->dataconn->prepare("SELECT * FROM items_data WHERE item_code=? LIMIT 1");
	$sqlItem->execute(array($this->itemCode));
	
	if($sqlItem->rowCount()>0){
		$row = $sqlItem->fetch(PDO::FETCH_ASSOC);
		$this->arrItemData = array('image'=>$row['image'],
		                           'abstract'=>$row['abstract'],
								   'price'=>$row['sale_price'],
								   'maxQuantity'=>$row['set_max_quantity'],
								   'giftcard'=>$row['gift_card'],
								   'delivery'=>$row['shipping_delivery'],
								   'pickup'=>$row['shipping_pickup'],
								   'org_price'=>$row['original_price'],
								   'url'=>$row['page_url']);
		
	}else{
		$this->arrItemData = array();
	}
	
	return $this->arrItemData;
}

public function getItems(){
	$userCode = $userCode;
	$productDB = $this->setDatabase('samedico_samedi');
	$sqlUsers = $productDB->dataconn->prepare("SELECT userId,active_registry FROM users WHERE entryId=? LIMIT 1");
	$sqlUsers->execute(array($userCode));
	if($sqlUsers->rowCount()>0){
		$row = $sqlUsers->fetch(PDO::FETCH_ASSOC);
		$arrTempConf = explode('/',$row['userId']);
		if($arrTempConf[1]===$userCode){
			$registry = $row['active_registry'];
			$this->userKey = $row['userId'];
			$this->getRegistryItems();
		}
	}
	
}

private function getRegistryItems($registry,$userKey){
	$this->registry = $registry;
	$productDB = $this->setDatabase('samedico_'.$registry);
	$sqlItems = $productDB->dataconn->prepare("SELECT strItems FROM registry WHERE userId=? AND active=? LIMIT 1");
	$sqlItems->execute(array($userKey,'Yes'));
	if($sqlItems->rowCount()>0){
		$row = $sqlItems->fetch(PDO::FETCH_ASSOC);
		$this->items=$row['strItems'];
	}
	
}

public function getItemQuantity($itemCode){
	$arrItemsL1 = explode('|',$this->items);
	for($i=0; $i<count($arrItemsL1); $i++){
		$arrItemsL2 = explode('*',$arrItemsL1[$i]);
		for($j=0; $j<count($arrItemsL2); $j++){
			if($itemCode == $arrItemsL2[0]){
				$quantity = $arrItemsL2[1];
				break 2;
			}
		}
	}
}

private function getPurchases($itemCode){
	$regsitry_TEMPDB = $this->setDatabase('samedico'.$this->registry);
	$purchasedQuantity = 0;
	$sqlPurchases = $regsitry_TEMPDB->dataconn->prepare("SELECT purchases FROM registry WHERE userId=? LIMIT 1");
	$sqlPurchases->execute(array($this->userKey));
	if($sqlPurchases->rowCount()>0){
		$row = $sqlPurchases->fetch(PDO::FETCH_ASSOC);
		$purchases = $row['purchases'];
		if($purchases != '' || $purchases != '(empty)'){
			$arrPurchases = explode('|',$purchases);
			for($i=0; $i<count($arrPurchases); $i++){
				$arrPurchasesItem = explode('*',$arrPurchases[$i]);
				if($arrPurchasesItem[0]  == $itemCode){
					$purchasedQuantity = $arrPurchasesItem[1];
					break;
				}
			}
		}
	}else{
	
	}
	
	return $purchasedQuantity;
}

public function processQuantity($arrItemsQuantity){
	$remainingQuantity = 1;
	for($i=0; $i<count($arrItemsQuantity); $i++){
		$arrItem_sec = explode('_',$arrItemsQuantity[$i]);
		if($arrItem_sec[0] == $this->itemCode){
			$remainingQuantity = $arrItem_sec[1];
			break;
		}
	}
	return $remainingQuantity;
 }

}
?>