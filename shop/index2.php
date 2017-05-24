<?
include('bin/shop.db.php');
$DB_NAME = "samedico_samedi";
$DBMS = new Shop_DBMS($DB_NAME);

if($DBMS->dbconnection_status){
	echo('Connection successful');
}
else{
	echo('Connection not successful! <br /><br />'.$DBMS->dbLog);
}
?>