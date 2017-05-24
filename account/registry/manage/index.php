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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
	<div class="span1">&nbsp;</div>
	<div class="span2 leftNavbar-container">
		<?php
			include(local_url.'account/bin/left-navbar.php');
		?>
	</div>
	<div class="span8">
		<div class="inline-heading">Manage your Registry</div><br />
		<div>Need help, let's give you a <a href="javascript:void()">quick and informative tour</a>.</div><!--do not remove-->
		<br />		
		<?php
		 
		 //here will be a script calln a function  - no idea which
		?>
		<div class="row-fluid span12" style="margin-left:0; border-top:solid 3px #333333"><br />
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
		<div class="span1" style="width:1%">
			&nbsp;
		</div>
		&copy;&nbsp;&nbsp;Samedi Registry Co.&nbsp;
		<?php echo(date('Y')); ?>
	</div>
</body>
</html>
