<?php
function redirectToPage($page){
	header('Location:'.$page);
}
session_start();

if(!isset($_SESSION['account']['status']) || $_SESSION['account']['status']!='logged_in'){
	$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Session Expired. Please log in.</div></div>';
	redirectToPage('../login/');
}

$_SESSION['page']['home_url'] = '../../';

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Samedi: Registry</title>
<?php
include($_SESSION['page']['home_url'].'templates/script-tags.php');
?>
</head>

<body>
<?php
	include($_SESSION['page']['home_url'].'templates/top-nav.dev.php');
	//start userdb dependent classes	
	
?>
<!--End top nav-->
<div class="body-content account-page row-fluid" style="margin-top:100px;">
	<div class="span2">&nbsp;</div>
	<div class="span9">
		<div class="inline-heading">Create A New Gift Registry</div><br />
		<br />
		<div class="row-fluid">
        	<a href="<?=$_SESSION['page']['home_url']?>account/wedding-registry/">
			<div class="span6 row-fluid" style="height:130px; background:#88C4FF">
				<div class="span5"><img src="<?=$_SESSION['page']['home_url']?>img/wedding-rings-medium.png" style="opacity:0.6" /></div>
				
				<div class="span6 account-registry-select" style="color:#333">Wedding Gift Registry<br /><br />
					<div style="color:#ffffff;">Start / Manage<i class="icon-chevron-right icon-white" style="margin-top:4px"></i></div>
				</div>
			</div>
            </a>
            <a href="<?=$_SESSION['page']['home_url']?>account/babyshower-registry/">
			<div class="span6 row-fluid" style="height:130px; background:#88C4FF; margin-left:10px">
				<div class="span5"><img src="<?=$_SESSION['page']['home_url']?>img/baby-cart-medium.png" style="opacity:0.6" /></div>
				<div class="span6 account-registry-select" style="color:#333">Baby Shower Gift Registry<br /><br />
					<div style="color:#ffffff;">Start / Manage<i class="icon-chevron-right icon-white" style="margin-top:4px"></i></div>
				</div>
			</div>
            </a>
            <a href="<?=$_SESSION['page']['home_url']?>account/graduation-registry/">
			<div class="span6 row-fluid" style="height:130px; margin-left:0; margin-top:20px; background:#88C4FF">
				<div class="span5"><img src="<?=$_SESSION['page']['home_url']?>img/graduation-cap-medium.png" style="opacity:0.6" /></div>
				<div class="span6 account-registry-select" style="color:#333">Graduation Gift Registry<br /><br />
					<div style="color:#ffffff;">Start / Manage<i class="icon-chevron-right icon-white" style="margin-top:4px"></i></div>
				</div>
			</div>
            </a>
            <a href="<?=$_SESSION['page']['home_url']?>account/birthday-registry/">
            <div class="span6 row-fluid" style="height:130px; margin-top:20px; background:#88C4FF; margin-left:10px">
				<div class="span5"><img src="<?=$_SESSION['page']['home_url']?>img/birthday-medium.png" style="opacity:0.6" /></div>
				<div class="span6 account-registry-select" style="color:#333">Birthday Gift Registry<br /><br />
					<div style="color:#ffffff;">Start / Manage<i class="icon-chevron-right icon-white" style="margin-top:4px"></i></div>
				</div>
			</div>
          </div>
          </a>
          <br><hr /><br>
          <a href="">
          <div class="row-fluid">
			<div class="span6 row-fluid" style="height:130px; margin-top:20px; background:#88C4FF;">
				<div class="span5"><img src="<?=$_SESSION['page']['home_url']?>img/gift-medium.png" style="opacity:0.6" /></div>
				<div class="span6 account-registry-select" style="color:#333">Specify Other Gift Registry<br /><br />
					<div style="color:#ffffff;">Start / Manage<i class="icon-chevron-right icon-white" style="margin-top:4px"></i></div>
				</div>
			</div>
          </div>
          </a>			
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
