<?php
session_start();

$_SESSION['page']['home_url'] = '../../../';
define('local_url','../../../');


include('../bin/class.invitation.php');
if(isset($_SESSION['registry']['invitation_code']) and $_SESSION['registry']['invitation_code']!='00000'){
	$invitation = new InvitationRegistry_Module($_SESSION['registry']['invitation_user'],$_SESSION['registry']['invitation_code']);
	$invitation->getDetails();
	$invitation->getItems();
}else{
	$invitationPublicReg = new InvitationRegistry_Module('public','00000');
	$invitationPublicReg->getPublicRegistries();
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Samedi: Registry</title>
<?php
include(local_url.'templates/script-tags.php');
?>
<script type="text/javascript" src="<?=local_url?>/js/product.js.js"></script>
</head>

<body>
<?php
	include(local_url.'templates/top-nav.dev.php');
?>
<!--End top nav-->
<div class="body-content account-page row-fluid">
	<div class="large-12 columns lowerContent">
		<div class="row-fluid">
			<div class="large-12 columns row-fluid" style="height:100px; background:url('../../../img/cloud-background.jpg')">
				<div class="large-2 columns">
					&nbsp;
				</div>
				<div class="large-3 columns" style="margin-top:30px;line-height:1.2">
					<strong style="font-size:25px">Find a perfect gift,</strong><br />
					<span style="font-size:16px">For the Perfect couple</span>
				</div>
				<div class="large-7 columns" style="margin-top:30px">
					<form class="form-horizontal invite-form" action="../bin/invitation.processing.php" method="post">
					  <input type="text" placeholder="Enter the Invitation Code" name="invitation_registry" id="invitation_registry" size="large-4 columns" />
					  <button type="button" class="btn" onclick="INVITATION_JSMOD.validateInviteCode()">View Registry</button><br />
					</form>
					<div class="alert alert-warning invitation-alert" style="position:relative; z-index:20; display:none">
						<button type="button" class="close close-alert" onclick="INVITATION_JSMOD.closeAlert()">&times;</button>
							The invitation code is required.<br />
							The invitation code is a 5 digit number that you received via an SMS. (<a href="">see more</a>).<br />
							To view public registries, enter <strong>00000</strong> as the invitation code..
					</div>
				</div>
			</div>
		  </div><br />
	</div><!--lowerContent-->
	
	<div class="innnerBodyContent publicRegDisplay row-fluid" id="publicRegDisplay" style="line-height:2.0">
		<div class="row-fluid" style="border-bottom:solid #CCCCCC; font-size:18px; font-family:Calibri">
			<div class="large-1 columns">
				&nbsp;
			</div>
			<div class="large-5 columns">
				(<?php
					echo($invitationPublicReg->publicRegCount);
				?> Registries Found)
			</div>
		</div>
		<?php
			echo($invitationPublicReg->strDivHTML);
		?>
	</div>
</div><br /><!--end bodycontent-->

<?php
	include($_SESSION['page']['home_url']."templates/footer-nav.php");
?>
</body>
</html>
    