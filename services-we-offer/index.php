<?php
session_start();

$_SESSION['page']['home_url'] = '../';
define('local_url','../');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Services We Offer - Samedi Gift Registry</title>
<?php
include(local_url.'templates/script-tags.php');
?>
</head>
<body>
<?php
	include(local_url.'templates/top-nav.dev.php');
?>
<!--End top nav-->
<div class="body-content account-page row-fluid">
	<div class="span2">&nbsp;</div>
	<div class="innnerBodyContent span8 row-fluid" style="margin-top:5%;">
		<div class="" align="center" style="font-size:30px;">
        	Services We Offer
       	</div><br>
        <div style="line-height:2.0">
        <strong>Samedi Gift Registry</strong> allows you to create a gift registry for any occasion with one account. Every registry has a wishlist; this is a list of items which you will create to direct your guests on which gifts you want for that occasion.<br/><br/>
A gift registry without an audience isn’t very efficient. Therefore, after creating a wishlist, build an audience by notifying a list of your preferred contacts list of your wishlist for a gift registry you have created with Samedi.
		</div>
   </div>
</div>
<?php
	echo('<br /><br /><br />'); //manual top margin
	include($_SESSION['page']['home_url']."templates/footer-nav.php");
?>
</body>
</html>