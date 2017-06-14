<?php
session_start();

$_SESSION['page']['home_url'] = '../';
define('local_url','../');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Creating A Gift Registry</title>
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
        	Creating A Gift Registry
       	</div><br>
        <div style="line-height:2.0">
        	<h4>Create a Samedi account</h4>
			You need a samedi account to be allowed to create a gift registry. Only one account is used to create any gift registry.
            <h4>Create a gift registry</h4>
			With a samedi account, you can now select the gift registry you want to create. You can have two simultaneous registries running.
            
			<h4>Add a Wishlist</h4>
			This is a list of all the gifts you would like to get on that special day.
            
			<h4>Create a Contacts list</h4>
			Select a tailored list of contacts so as to target an appropriate guest who is eligible to get  you a gift on the special day. This allows us to notify them of the existence of your registry and its wishlist.
            <h4>Pricing</h4>
                <em>The first 20 gift registries are FREE!</em><br>
                
                 - Wedding gift registry package <strong>Ksh 2,990</strong><br>
                
                 - Baby-shower gift registry package <strong>Ksh 1,490</strong><br>
                
                 - Birthday gift registry package <strong>Ksh 1,490</strong> <br>
                
                 - Graduation gift registry package <strong>Ksh 990</strong><br>
                 
                 - Other gift registry package <strong>Ksh 990</strong><br>
                
                <h4>Broadcasting to guests</h4>
                Once the invoice is settled, the contact list you created is notified of your gift registry. Periodic reminders are sent out to ensure they do not forget about the big day.
        </div>
   </div>
</div>
<?php
	echo('<br /><br /><br />'); //manual top margin
	include($_SESSION['page']['home_url']."templates/footer-nav.php");
?>
</body>
</html>