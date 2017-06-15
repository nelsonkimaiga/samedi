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
include('bin/class.manage.registry.php');

$itemDetails = new Module_ManageUserRegistry('samedico_samedi',$_SESSION['account']['refUserId']);
$itemDetails->getRegistry();
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Samedi: Registry</title>
<?php
include($_SESSION['page']['home_url'].'templates/script-tags.php');
?>
<script type="text/javascript" src="<?=$_SESSION['page']['home_url']?>js/registry.03.js"></script>
</head>
<body>

<?php
	include($_SESSION['page']['home_url'].'templates/top-nav.dev.php');
?>
<!--End top nav-->
<div class="body-content account-page row-fluid" style="margin-top:100px;">
	<div class="large-1 columns">&nbsp;</div>
	<div class="large-2 columns leftNavbar-container">
		<?php
			include(local_url.'account/bin/left-navbar.php');
		?>
	</div>
	<div class="large-8 columns">
		<div class="inline-heading">Manage your Registry</div><br />
		<div>Need help, let's give you a <a href="javascript:void()">quick and informative tour</a>.</div><!--do not remove-->
		<br />		
		<?php
		 
		 //here will be a script calln a function  - no idea which
		?>
		<div class="row-fluid large-12 columns" style="margin-left:0; border-top:solid 3px #333333"><br />
			<div class="items-heading-count">
				<h4>
					<span class="item-count"><?php echo($itemDetails->strItemsCount); ?></span>
					 Item(s)
				</h4>
			</div>
			
	<?php
				echo($itemDetails->strDivHTML);

			echo('<br /><br /><br />'); //manual top margin
			include($_SESSION['page']['home_url']."templates/footer-account-pages.php");
	?>
		</div> <!-- end item-div-container-->
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
