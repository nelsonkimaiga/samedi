<?php

include('shop.db.php');

$DB_NAME = "samedico_shop";

$DBMS = new Shop_DBMS($DB_NAME);

function parseItemData($itemCode){
global $DBMS;
	if($DBMS->dbconnection_status){
		//get the product code
		$itemData = SQLConnect($DBMS,$itemCode);
		return $itemData;
	}else{
		return 'Error accessing database_err0';
	}
}



function SQLConnect($DBMS,$itemCode){
 try{
	$sqlSearch = $DBMS->dataconn->prepare("SELECT * FROM items_data WHERE item_code=? limit 1");
	$sqlSearch->execute(array($itemCode));
	$rows = $sqlSearch->fetch(PDO::FETCH_ASSOC);
	if($rows>0){
		return $rows;
	}else{
		return 'Error in retrieving data';
	}
 }catch(PDOException $e){
 	return 'Error102 '.$e->getMessage();
 }
}
?>