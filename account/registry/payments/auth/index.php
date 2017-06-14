<?php
function redirectToPage($page){
	header('Location:'.$page);
}
session_start();

if(!isset($_SESSION['account']['status']) || $_SESSION['account']['status']!='logged_in'){
	$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Session Expired. Please log in.</div></div>';
	redirectToPage('../login/');
}

$_SESSION['page']['home_url'] = '../../../../';
	
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Samedi: Payment Initiated</title>
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
	<div class="large-9 columns lowerContent">
		<div class="row-fluid" style="background:#22B7FF; padding:10px 15px; color:#FFF; font-size:16px">
			Publish Registry - Wedding Gift Registry | <span style="color:#333; font-weight:bold">Payment</span>
		</div><br />
		<div class="innerBodyContent row-fluid" style="font-size:16px; line-height:1.9">
			<?php
				include($_SESSION['page']['home_url']."cgi-bin/pesapal/pesapal-ipn-listener.php");
				
				//create the payments instance
				include_once('../class.payments_module.php');
				$callBackInst = new SamediPaymentModule();
				$callBackInst->setCallbackParams($_SESSION['account']['refUserId'],$_REQUEST['pesapal_transaction_tracking_id'],$_REQUEST['pesapal_merchant_reference'],$pageHeading);
				
				$callBackInst->storeCallbackToDB();
			?>
            Your payment has been received and is being processed. Below is the invoice:<hr />
            <table border="1" cellpadding="4px">
            	<thead style="font-weight:bold">
                	<tr>
                    	<td>
                        	Date
                        </td>
                    	<td>
                        	Transaction Reference
                        </td>
                        <td>
                        	Amount Paid
                        </td>
                        <td>
                        	Status
                        </td>
                    </tr>
                </thead>
            	<tr>
                	<td>
                    	<?php echo $callBackInst->dateDone; ?>
                    </td>
                	<td>
                    	<?php echo $_REQUEST['pesapal_merchant_reference'];?>
                    </td>
                    <td>
                    	Ksh. 2990
                    </td>
                    <td>
                    	PENDING
                    </td>
                </tr>
            </table><br>
            <button class="btn btn-medium">Refresh Invoice</button>
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