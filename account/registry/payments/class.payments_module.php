<?php

class SamediPaymentModule{

public $amountToPay;
public $dateDone;

private $userRef;
private $merchantRef;
private $pesapalTransactionId;
private $pageHeading; //Holds the registry being paid for

function __construct(){
	
}
private function setDatabaseConnection($database){
	$dbms = new user_DBMS($database);
	return $dbms;
}

private function setDate(){
	date_default_timezone_set("Africa/Nairobi");
	$t_date = date("d/m/Y") . "_" . date("H:i");
	return $t_date;
}
public function getAmountToPay($registry){
	$amount = 0;
	switch($registry){
		case 'wedding_registry':
			$amount = 2900;
			break;
		case 'babyshower_registry':
			$amount = 1490;
			break;
		case 'graduation_registry':
			$amount = 1490;
			break;
		case 'graduation_registry':
			$amount = 990;
			break;
	}
	
	$this->amountToPay = $amount;
}
public function setCallbackParams($a, $b, $c, $d){
	$this->userRef = $a;
	$this->merchantRef = $c;
	$this->pesapalTransactionId = $b;
	$this->pageHeading = $d;
}

public function storeCallbackToDB(){
	$dbms = $this->setDatabaseConnection('samedico_user_transactions');
	if($dbms->dbconnection_status){
		$sqlPayments = $dbms->dataconn->prepare("INSERT INTO user_payments (userRef, payment_for, transaction_merchant_reference, pesapal_transaction_id, pesapal_status, date_paid, last_modified) VALUES (:_a, :_b,:_c,:_d,:_e,:_f,:_g)");
		/*$sqlPayments->execute(array(
								':_a'=>$this->userRef,
								':_b'=>$this->pageHeading,
								':_c'=>$this->merchantRef,
								':_d'=>$this->pesapalTransactionId,
								':_e'=>'PENDING',
								':_f'=>$this->setDate(),
								':_g'=>$this->setDate()
								));*/
	$this->dateDone = $this->setDate();
		
	}
}



}

?>