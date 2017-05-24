<?php

class REGISTRY_SEARCH{
	public $strResults;

	private $nameSearch;
	
	function __construct(){
		$this->strResults = '';
		$this->nameSearch = '';
	}
	
	private function setDatabase(){
		$dbms = new user_DBMS('samedico_samedi');
		return $dbms;
	}
	
	public function getResultsHTML($searchName){
		$this->nameSearch = $searchName;
		$DBSM = $this->setDatabase();
		if($DBMS->dbconnection_status){
			$sqlStr = "SELECT * FROM users WHERE (first_name=? OR last_name=?) AND active_registry!=? ORDER BY entryId DESC";
			$sqlSelect = $DBMS->dataconn->prepare($sqlStr);
			$sqlSelect->execute(array($this->nameSearch,
									  $this->nameSearch,
									  '(empty)'
										));
			if($sqlSelect->rowCount()>0){
				$this->strResults = 'found';	
			}
			
			
		}
	}
}
?>