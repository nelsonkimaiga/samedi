<?php

//process user
$userId = $_SESSION['account']['refUserId'];
$activeRegistry = $activeRegistry;
$userId_new = strtolower(str_replace("/","_",$userId));
$userTbl = $activeRegistry.'_'.$userId_new;

$DB_NAME = "samedico_gifts_registry";
$DBMS = new user_DBMS($DB_NAME);

_tableExists($userTbl);

$itemsCount = 0;
$sqlSelect = "SELECT * FROM ".$userTbl."";
$sqlSelect = $DBMS->dataconn->query($sqlSelect);

if($sqlSelect->rowCount()>0){
	$row = $sqlSelect->fetch(PDO::FETCH_ASSOC);	
	$itemsCount = $sqlSelect->rowCount();
	$sqlSelect = "SELECT * FROM ".$userTbl." ORDER BY entryId DESC LIMIT 1";
	$sqlSelect = $DBMS->dataconn->query($sqlSelect);
	$row = $sqlSelect->fetch(PDO::FETCH_ASSOC);	
	
	//last item entry
	$strHTML = '
			'.$row['giftName'].' ('.$row['giftCode'].')<br />
			Quantity: '.$row['quantity'].'<br />
			Description:<br />
				<em>
					'.$row['description'].'
				</em><hr />
				
			Selected Store:<br />
				'.$row['store'].'

	';
}else{
	$strHTML = 'No items added yet';
}

function _tableExists($userTbl){
 global $DBMS;
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
?>