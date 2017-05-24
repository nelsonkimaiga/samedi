<?php
function redirectToPage($page){
	header('Location:'.$page);
}
session_start();

if(!isset($_SESSION['account']['status']) || $_SESSION['account']['status']!='logged_in'){
	$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Session Expired. Please log in.</div></div>';
	redirectToPage('../login/');
}

$_SESSION['page']['home_url'] = '../../../';
	
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Samedi: Make Payment</title>
<?php
include($_SESSION['page']['home_url'].'templates/script-tags.php');
?>
</head>

<body>

<?php
	include($_SESSION['page']['home_url'].'templates/top-nav.dev.php');

?>
<div class="body-content account-page row-fluid" style="margin-top:100px;">
	<div class="span2">&nbsp;</div>
	<div class="span9 lowerContent">
		<div class="row-fluid" style="background:#22B7FF; padding:10px 15px; color:#FFF; font-size:16px">
			Publish Registry - Wedding Gift Registry | <span style="color:#333; font-weight:bold">Payment</span>
		</div><br />
		<div class="innerBodyContent row-fluid" style="font-size:16px; line-height:1.9">
			<?php
				require_once('../../../cgi-bin/pesapal/pesapal-iframe.php');
			?>
		</div><!--innerBodyContent-->
	</div><!--lowerContent-->

</div><br /><!--end bodycontent-->
<div class="footer-container-end" style="margin-top:12%">
	<div class="span1" style="width:1%">
		&nbsp;
	</div>
	&copy;&nbsp;&nbsp;Samedi Gift Registry Co.&nbsp;
	<?php echo(date('Y')); ?>
</div>
	
</body>
</html>