<?php
session_start();

$_SESSION['page']['home_url'] = '../../../';
define('local_url','../../../');


include('../bin/class.invitation.php');
if(isset($_REQUEST['regid'])){
	$invitation = new InvitationRegistry_Module($_REQUEST['regid']);
	$invitation->getDetails();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
	<div class="span12 lowerContent">
		<div class="row-fluid">
			<div class="span12 row-fluid" style="height:50px; background:url('../../../img/cloud-background.jpg')">
				&nbsp;
			</div>
		  </div><br />
	</div><!--lowerContent-->
	
	<div class="innnerBodyContent" style="">
		<div class="span1" style="width:auto">&nbsp;</div>
		<div class="span11 row-fluid item-shop-container" style="margin-left:0.5%">
			<div class="span1 row-fluid">
				
			</div>
			
			<div class="span11 row-fluid item-shop-main" style="padding-top:10px; padding-left:10px;">
				<?php
					if($invitation->existingUser){
				?>
				<div class="span10 row-fluid" style="height:420px; width:100%; border:solid thin #000000; margin-left:0; padding:10px; background:url('../../../img/couple-banner.jpg'); background-size:cover">
					<div class="span12 row-fluid">
						<div class="span1">&nbsp;</div>
						<div class="span3" style="font-size:40px; font-weight:bold; font-family: 'Playball', cursive; padding-top:20px; text-align:right">
							<?php echo($invitation->brideInfo); ?>
						</div>
						<div class="span1"><img src="<?=$_SESSION['page']['home_url']?>img/and-medium.png" style="opacity:0.6" /></div>
						<div class="span3" style="font-size:40px; font-weight:bold; font-family: 'Tangerine', cursive; padding-top:20px">
							<?php echo($invitation->groomInfo); ?>
						</div>
						<div class="span3" style="font-size:18px ;font-family: 'Nunito', sans-serif; padding-top:20px">
							<?php echo($invitation->weddingDate); ?>
						</div>
					</div>
					
					<div class="span12 row fluid">
						<div class="image-banner-1 span4">
							<?php
								echo($invitation->processImages());
							?>
						</div>
						<div class="span2">&nbsp;</div>
						<div class="image-banner-2 span4" style="background:#FFFFFF; padding:10px; font-family: 'Tangerine', cursive; font-size:30px; line-height:1.3">
							You are cordially invited to celebrate our wedding on <?php echo($invitation->weddingDate); ?> at ten o&rsquo;clock in <?php echo($invitation->weddingLocation);?>. Come. Share with us a very precious moment, the beginning of our life together.
						</div>
					</div>
					
					<div class="span12 row fluid">
						<div class="span4">&nbsp;</div>
						<div class="span7"  style="font-size:18px ;font-family: 'Nunito', sans-serif; background:#FFFFFF; padding:3px">
							Venue:&nbsp;&nbsp;<?php echo($invitation->weddingLocation); ?>
						</div>
					</div>

				</div>
				
				<?php $invitation->getItems(); ?>
				<div class="span11 row-fluid" style="margin-top:20px; margin-left:0; border-bottom:solid thick #999999; padding-top:20px">
					<h4>Our Registry: <?php echo($invitation->itemsCount); ?> Item(s)</h4><br /><br />
					<?php
						echo($invitation->strHTMLContainer);
					?>
					
				</div><!--refine-container-->
				
				<?php
					}else{
				?>
					<div class="alert alert-info">
						We seem not to recognize the registry. This can be a result of wrong information. Please check your invitation code.
					</div>
					<h4>Verify your invitation code</h4>
					<div class="span7" style="margin-top:30px">
					<form class="form-horizontal invite-form" action="../bin/invitation.processing.php" method="post">
					  <input type="text" placeholder="Enter the Invitation Code" name="invitation_registry" id="invitation_registry" size="span4" />
					  <button type="button" class="btn" onclick="INVITATION_JSMOD.validateInviteCode()">View Registry</button><br />
					</form>
					<div class="alert alert-warning invitation-alert" style="position:relative; z-index:20; display:none">
						<button type="button" class="close close-alert" onclick="INVITATION_JSMOD.closeAlert()">&times;</button>
							The invitation code is required.<br />
							The invitation code is a 5 digit number that you received via an SMS. (<a href="">see more</a>).<br />
							To view public registries, enter <strong>00000</strong> as the invitation code..
					</div>
				</div>
				<?php
					}//no user
				?>
			</div><!--item-shop-main-->

		</div><!--item-shop-container-->
	</div>
</div><br /><!--end bodycontent-->

<?php
	include($_SESSION['page']['home_url']."templates/footer-nav.php");
?>
</body>
</html>
    