<?php
session_start();

$_SESSION['page']['home_url'] = '../';
define('local_url','../');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>About Us - Samedi Gift Registry</title>
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
	<div class="innnerBodyContent large-8 columns row-fluid" style="margin-top:5%;">
		<div class="" align="center" style="font-size:30px;">
        	Find a Registry
       	</div><br>
        
   </div>
</div>
<?php
	echo('<br /><br /><br />'); //manual top margin
	include($_SESSION['page']['home_url']."templates/footer-nav.php");
?>
</body>
</html>