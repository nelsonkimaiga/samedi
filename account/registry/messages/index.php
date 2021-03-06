<?php
function redirectToPage($page){
	header('Location:'.$page);
}
session_start();

if(!isset($_SESSION['account']['status']) || $_SESSION['account']['status']!='logged_in'){
	$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Session Expired. Please log in.</div></div>';
	redirectToPage('../../login/');
}

define('local_url','../../../');

$_SESSION['page']['home_url'] = '../../../';


?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Samedi: Registry Messages</title>
<?php
include($_SESSION['page']['home_url'].'templates/script-tags.php');
?>
<script type="text/javascript" src="<?=local_url?>js/registry.01.js"></script>
</head>

<body>
<?php
	include($_SESSION['page']['home_url'].'templates/top-nav.dev.php');
?>
<!--End top nav-->
<div class="body-content account-page row" style="margin-top:100px;">
	<div class="large-1 columns">&nbsp;</div>
	<div class="large-2 columns leftNavbar-container">
		<?php
			include(local_url.'account/bin/left-navbar.php');
		?>
	</div>
	<div class="large-8 columns">
		<div class="inline-heading">Manage your Registry Messages</div><br />
		<div>Need help, let's give you a <a href="javascript:void()">quick and informative tour</a>.</div><!--do not remove-->
		<br />		
		
		<div class="row large-12 columns" style="margin-left:0; border-top:solid 3px #333333"><br />
			<div class="">
                <div class="alert alert-warning">
                    Sorry. We are yet to integrate the messages. Please bear with us.
                </div>
			</div>
			<hr />
			
			
		</div>
	
		<?php
		echo('<br />'); //manual top margin
		include($_SESSION['page']['home_url']."templates/footer-account-pages.php");
		?>
	</div>
</div><br /><!--end bodycontent-->


    
	
	<div class="footer-container-end">
		<div class="large-1 columns" style="width:1%">
			&nbsp;
		</div>
		&copy;&nbsp;&nbsp;Samedi Registry Co.&nbsp;
		<?php echo(date('Y')); ?>
	</div>
</body>
</html>
