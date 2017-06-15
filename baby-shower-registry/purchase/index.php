<?php
session_start();

$_SESSION['page']['home_url'] = '../../../';
define('local_url','../../../');


include('../bin/class.invitation.php');
include('../../bin/shop.purchase.php');
if(isset($_REQUEST['regid']) && isset($_REQUEST['itemCode'])){
	$invitation = new InvitationRegistry_Module($_REQUEST['regid']);
	$invitation->getDetails();
	
	//get product information:
	$productInfo = new SHOPPurchase_Mod();
	$arrProducts = $productInfo->getProductDetails($_REQUEST['itemCode']);
	
	$activeItem = count($_SESSION['arrItems']);
	
	$quantity = $productInfo->processQuantity($_SESSION['arrItems']);
	
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
<script type="text/javascript" src="<?=local_url?>/js/registry.03.js"></script>
</head>

<body>
<?php
	include(local_url.'templates/top-nav.dev.php');
?>
<!--End top nav-->
<div class="body-content account-page row-fluid">
	<div class="large-12 columns lowerContent">
		<div class="row-fluid">
			<div class="large-12 columns row-fluid" style="height:50px; background:url('../../../img/cloud-background.jpg')">
				&nbsp;
			</div>
		  </div><br />
	</div><!--lowerContent-->
	
	<div class="innnerBodyContent" style="">
		<div class="large-1 columns" style="width:auto">&nbsp;</div>
		<div class="large-11 columns row-fluid item-shop-container" style="margin-left:0.5%">
			<div class="large-1 columns row-fluid">
				
			</div>
			
			<div class="large-11 columns row-fluid item-shop-main" style="padding-top:10px; padding-left:10px;">
				
				<div class="large-10 columns row-fluid" style="height:100px; width:100%; border:solid thin #000000; margin-left:0; padding:10px; background:url('../../../img/couple-banner.jpg'); background-size:cover">
					<div class="large-12 columns row-fluid">
						<div class="large-1 columns">&nbsp;</div>
						<div class="large-3 columns" style="font-size:40px; font-weight:bold; font-family: 'Playball', cursive; padding-top:20px; text-align:right">
							<?php echo($invitation->brideInfo); ?>
						</div>
						<div class="large-1 columns"><img src="<?=$_SESSION['page']['home_url']?>img/and-medium.png" style="opacity:0.6" /></div>
						<div class="large-3 columns" style="font-size:40px; font-weight:bold; font-family: 'Tangerine', cursive; padding-top:20px">
							<?php echo($invitation->groomInfo); ?>
						</div>
					 </div>
					<div style="font-size:20px; color:#FF3E3E; font-weight:bold">
						Your perfect gift, for this perfect couple
					</div>
				</div>
				
				
				<div class="large-10 columns row-fluid refine-container" style="height:80px; width:100%; margin-top:20px; margin-left:0; border-bottom:solid thick #999999; padding-top:20px">
					<h4>You wish to purchase this item.</h4><br /><br />
					
					<!--item display -->
					<div class="row-fluid item-div-container container-white" style="padding:5px">
						<div class="large-5 columns">
							<img class="" src="<?=$_SESSION['page']['home_url']?>img/<?=$arrProducts['image']?>" /><br /><br />
						</div>
						<div class="large-6 columns row-fluid">						
							<div class="large-12 columns item-abstract" style="font-size:16px">
								<a href="<?=local_url.'shop/'.$arrProducts['url']?>"><?php echo($arrProducts['abstract']); ?></a>
							</div>
							<div class="large-12 columns item-quantity row-fluid" style="font-size:20px; font-weight:bold">
								<div class="large-3 columns">Price</div>
								<div class="large-7 columns">
									<sup>Ksh.</sup><span class="item-price-itemCode price-per"><?php echo($arrProducts['price']); ?></span><sup>00</sup>&nbsp;
									<span style="font-size:14px; color:#666666;">(From Ksh. <?php echo($arrProducts['org_price']); ?>)</span>
								</div>
							</div>
							<div class="large-12 columns item-quantity row-fluid" style="font-size:16px; font-weight:bold">
								<div class="large-3 columns">Quantity</div>
								<div class="large-5 columns">
									<select class="large-5 columns" onchange="javascript:product.processPriceAtCheckOut(this.value)">
									<?php
										for($i=1; $i<=$quantity; $i++){
											echo('<option>'.$i.'</option>');
										 }
									?>
									</select>
								</div>
							</div>
							<div class="large-12 columns item-quantity row-fluid" style="font-size:20px; font-weight:bold">
								<div class="large-3 columns">=</div>
								<div class="large-5 columns">
									<sup>Ksh.</sup>&nbsp;<span class="item-price-itemCode total-price">23,400</span>&nbsp;<sup>00</sup>&nbsp;
								</div>
							</div>
							<div class="large-12 columns row-fluid" style="font-size:20px; font-weight:bold">
								<div class="large-3 columns">&nbsp;</div>
								<div class="large-8 columns">
									<label>
										<input type="checkbox" name="giftCard"/>&nbsp;Include Gift Card and Gift Wrapping
									</label>
								</div>
							</div>
							<div class="large-12 columns row-fluid" style="font-size:14; border-top:solid 2px #CCCCCC">
								<div class="large-3 columns"><strong>Delivery</strong></div>
								<div class="large-8 columns row-fluid" style="margin-top:2%">
									<label class="large-11 columns">
										<input type="radio" name="deliveryOptions" value="1" checked="checked"/>&nbsp;Deliver to my location
									</label>
									<label class="large-11 columns" style="margin-left:0">
										<input type="radio" name="deliveryOptions" value="2" />&nbsp;Delivery to couple's location
									</label>
									<label class="large-11 columns" style="margin-left:0">
										<input type="radio" name="deliveryOptions" value="3" />&nbsp;Pick-up from nearest store (<a href="">View nearest store</a>)
									</label>
								</div>
							</div>
							<div class="large-11 columns item-buttons">
								<div><button class="btn btn-warning">Proceed to Checkout</button></div>
							</div>
						</div>
					</div>
					<!--end item display -->
					
					
				</div><!--refine-container-->
				
			</div><!--item-shop-main-->

		</div><!--item-shop-container-->
	</div>
</div><br /><!--end bodycontent-->
<?php
		echo('<div style="margin-top:25%;">&nbsp;</div>');
	include($_SESSION['page']['home_url']."templates/footer-nav.php");
?>
<div class="modal hide fade" id="reviewModal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="modalImage"></h3>
      </div>
      <div class="modal-body">
	  <?php
	  
	  if(isset($_SESSION['account']['refUserId'])){
	  ?>
        <p>
			Thank You for your vote. Please write us a review<br /><br />
			<textarea id="review" rows="4" placeholder="Write your review ..." class="large-4 columns"></textarea>
		</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Cancel</a>
        <a href="javascript:product.postReview()" class="btn btn-primary">Save Review</a>
      </div>
	  <?php
	  }else{	  
	  ?>
	    <p>
			<div class="alert alert-warning">
				You must be signed in to submit a vote and a review.
			</div>
		</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
      </div>
	  <?php
	  }
	  ?>
    </div>
</body>
</html>
    