<?php
class HandlerLeftNavBar extends user_DBMS{
protected $db_host;
protected $db_name;
protected $db_user;
protected $db_pass;
protected $DBMS_TEMP;
protected $strUserCode;
protected $strReqURL;

public $registryContactsHTML;
public $messageCreditsHTML;

function __construct($dbname, $userCode, $url){
	$this->db_name = $dbname;
	$this->strUserCode = $userCode;
	$this->strReqURL = $url;
	
	$this->TempDBConnection();
	$this->registryContacts();
	$this->messageCredits();
}

function TempDBConnection(){
	$this->DBMS_TEMP = new user_DBMS($this->db_name);
	
}
function registryContacts(){
	$sqlContacts=$this->DBMS_TEMP->dataconn->prepare('SELECT * FROM account_status WHERE userId=?');
	$sqlContacts->execute(array($this->strUserCode));
	$row = $sqlContacts->fetch(PDO::FETCH_ASSOC);
	if($row['registry_contacts']=='(empty)'){
		$this->registryContactsHTML = '<a href="'.$this->strReqURL.'account/registry/contacts/" title="You have not set a contact list">Registry Contacts&nbsp;<span class="label label-warning">!</span></a>';
	 }else{
	 	$this->registryContactsHTML = '<a href="'.$this->strReqURL.'account/registry/contacts/">Registry Contacts</a>';
	 }
}

function messageCredits(){
	$sqlMessage=$this->DBMS_TEMP->dataconn->prepare('SELECT * FROM account_status WHERE userId=?');
	$sqlMessage->execute(array($this->strUserCode));
	$row = $sqlMessage->fetch(PDO::FETCH_ASSOC);
	if($row['message_credits']=='(empty)'){
		$this->messageCreditsHTML = '<a href="#" title="You have ran out of credit">Message Credits&nbsp;<span class="label label-important">!</span></a>';
	 }elseif(intval($row['message_credits'])<10){
	 	$this->messageCreditsHTML = '<a href="#" title="You are running low on credit">Message Credits&nbsp;<span class="label label-warning">!</span></a>';
	 }else{
	 	$this->messageCreditsHTML = '<a href="#">Registry Contacts</a>';
	 }
}

}
?>