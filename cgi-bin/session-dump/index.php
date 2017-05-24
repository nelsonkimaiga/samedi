<?php
//-- !!!!! IMPORTANT : This page hard-dumps all the session assigned to the current user___
function redirectToPage($page){
	header('Location:'.$page);
}

session_start();


//unset sessions and redirect
session_unset();

redirectToPage('../../index.php');
//$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Hard Dump Succeded!!</div></div>';
?>