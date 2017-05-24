<?php
session_start();

$_SESSION['page']['home_url'] = '../';
define('local_url','../');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Contact Us - Samedi Gift Registry</title>
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
	<div class="span3">&nbsp;</div>
	<div class="innnerBodyContent span6 row-fluid" style="margin-top:5%;">
		<div class="" align="center" style="font-size:30px;">
        	Follow Us For Amazing Offers
       	</div><br>
        <div style="font-size:16px; line-height:3">
        	<img src="<?=$_SESSION['page']['home_url']?>img/icons/phone-32.png" />
            	<span style="font-size:20px">+254 728 691 500</span><br>
            <img src="<?=$_SESSION['page']['home_url']?>img/icons/email-32.png" />
            	<span style="font-size:20px">info@samedi.co.ke</span><br>
            <img src="<?=$_SESSION['page']['home_url']?>img/icons/twitter-32.png" />
            	<span style="font-size:18px">@samedigifts</span><br>
            <img src="<?=$_SESSION['page']['home_url']?>img/icons/facebook-32.png" />
            	<span style="font-size:18px">Samedi gift registry</span><br>
            <img src="<?=$_SESSION['page']['home_url']?>img/icons/googleplus-32.png" />
            	<span style="font-size:18px">*************</span><br>
            <img src="<?=$_SESSION['page']['home_url']?>img/icons/instagram-32.png" />
            	<span style="font-size:18px">@samedigifts</span><br>
            <img src="<?=$_SESSION['page']['home_url']?>img/icons/linkedin-32.png" />
            	<span style="font-size:18px">Samedi Gift Registry</span><br>
        </div>
        
   </div>
</div>
<?php
	echo('<br /><br /><br />'); //manual top margin
	include($_SESSION['page']['home_url']."templates/footer-nav.php");
?>
</body>
</html>