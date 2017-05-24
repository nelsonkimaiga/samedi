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
<title>Samedi: Publish Registry</title>
<?php
include($_SESSION['page']['home_url'].'templates/script-tags.php');
?>
</head>

<body>

<?php
	include($_SESSION['page']['home_url'].'templates/top-nav.dev.php');

include_once('../payments/class.payments_module.php');
$payments_module = new SamediPaymentModule();

$payments_module->getAmountToPay($activeRegistry);

?>
<div class="body-content account-page row-fluid" style="margin-top:100px;">
	<div class="span2">&nbsp;</div>
	<div class="span9 lowerContent">
		<div class="row-fluid" style="background:#22B7FF; padding:10px 15px; color:#FFF; font-size:16px">
			Publish Registry - Wedding Gift Registry
		</div><br />
		<div class="innerBodyContent row-fluid" style="font-size:16px; line-height:1.9">
			<div class="span12">Make your registry live!<br /><br>
            Alfred, please pay <strong>Ksh. <?php echo $payments_module->amountToPay;?>.00</strong> and let your wedding gift registry be seen. From here your can send it to friends and family, make changes, create a gallery and enjoy more features.
            </div><br>
            <div class="span2">
            	&nbsp;
            </div>
            <div class="span4" style="margin-top:2%">
            	<form action="../payments/" method="post" id="formSubmit">
                <input type="hidden" name="amount" value="<?=$payments_module->amountToPay;?>" />
                <input type="hidden" name="activeRegistry" value="<?=$activeRegistry?>" />
                <input type="hidden" name="description" value="<?=$pageHeading?>" />
            	<div class="span8" style="background:#FFC082; padding:10px 15px; font-weight:bold; border-radius:5px; cursor:pointer;" align="center" id="btnPay">
                	Make Payment
                </div>
                </form>
            </div>
		</div><!--innerBodyContent-->
	</div><!--lowerContent-->

</div><br /><!--end bodycontent-->
<div class="footer-container-end" style="margin-top:10%">
	<div class="span1" style="width:1%">
		&nbsp;
	</div>
	&copy;&nbsp;&nbsp;Samedi Gift Registry Co.&nbsp;
	<?php echo(date('Y')); ?>
</div>
	
</body>
</html>
<script>
$(document).ready(function(){
	$("#btnPay").click(function(){
		$("#formSubmit").submit();
	});
});
</script>