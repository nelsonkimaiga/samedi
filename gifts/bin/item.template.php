<?php

$var_url = $_SESSION["page"]["home_url"];


include('item.var.db.php');
include('shop.scripts.php');
include('../../templates/top-nav.item.template.php');

$header_scripts = contentScript($var_url."templates/script-tags.inc");
//go to database
$itemData = parseItemData($item_code);


//get the item variables
$hierachyLinks = parseHierachy($itemData['merchant_category']);


function contentScript($file){
$myfile = fopen($file, "r");
return fread($myfile,filesize($file));
fclose($myfile);
}

function parseHierachy($rawData){
$str = '';
$url_0 = 'http://samedi.co.ke/shop/';

$hieArray = explode('-',$rawData);
$str .= '<a href="'.$url_0.'">'.$hieArray[0].'</a>&nbsp;&raquo;&nbsp;';

switch($hieArray[1]){
case 'Electronics':
	$str .= '<a href="'.$url_0.'?shop_cat_1=electronics">'.$hieArray[1].'</a>&nbsp;&raquo;&nbsp;';
	break;

}

switch($hieArray[2]){
case 'Tv&Radio':
	$str .= '<a href="'.$url_0.'?shop_cat_1=electronics&shop_cat_2=tvRadio">'.$hieArray[2].'</a>';
	break;

}

return $str;
}

//offers
if($itemData['original_price']>$itemData['sale_price']){
	$strSave = '
			<div class="large-5 columns" style="margin-top:5px; font-family:Calibri; font-size:14px">
				Was <span style="text-decoration:line-through">Ksh. '.$itemData['original_price'].'</span><br />
				Save Ksh. '.substractCash($itemData['original_price'],$itemData['sale_price']).'
			</div>
	 ';
	}

//item quantity
$strQuantity = '';
$maxQuantity = $itemData['maximum_quantity'];
for($i = 1; $i<=$maxQuantity; $i++){
	$strQuantity .= '<option>'.$i.'</option>';
}

//topNav

$strTopNav = returnStrTOPNAV();

$header = '
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>'.$itemData['abstract'].': Samed Gift Registry</title>
'.$header_scripts.'
</head>'; //end header

$body = '
<body>'.
$strTopNav
.'
<div class="body-content account-page row-fluid">
	<div class="large-12 columns lowerContent">
		<div class="row-fluid">
			<div class="large-12 columns row-fluid" style="height:150px; background:url(\'../../img/cloud-background.jpg\')">
				<div class="large-3 columns"></div>
				<div class="large-6 columns account-registry-image" style="margin-top:60px">Start shopping, Save more, smile more<br /><br />
				</div>
			</div>
		  </div><br />
	</div><!--lowerContent-->
	
<div class="innnerBodyContent" style="margin-top:12%">
		<div class="large-1 columns" style="width:auto">&nbsp;</div>
		<div class="large-11 columns row-fluid item-shop-container" style="margin-left:2%">
			<div class="large-12 columns row-fluid item-shop-main" style="padding-top:10px; padding-left:10px;">
				<div class="large-12 columns page-links">
					'.$hierachyLinks.'
				</div><br />				
				<div class="large-12 columns row-fluid" style="margin-left:0; margin-top:20px">
					<div class="item-heading large-12 columns row-fluid">
						<div class="large-6 columns">
							<div class="item-title">'.$itemData['abstract'].'</div>
							<div class="item-heading-sub">by <a href="javascript:void()">'.$itemData['manufacturer'].'</a></div>
							<div class="row-fluid item-heading-sub" style="margin-left:0; margin-top:10px">
								<div class="large-2 columns">
									<img src="../../img/thumbs-up.png" />&nbsp;&nbsp;
									'.$itemData['thumbs_up'].'
								</div>
								<div class="large-2 columns">
									<img src="../../img/thumbs-down.png" />&nbsp;&nbsp;
									'.$itemData['thumbs_down'].'
								</div>
							</div>
						</div>
					</div>
				</div><br />
				<div class="large-1 columns">&nbsp;</div>
				<div class="large-6 columns row-fluid item-display" style="margin-left:0; margin-top:3%;">
					<div class="item-image">
						<img class="img-rounded" src="../../img/'.$itemData['image'].'" />
					</div><br />
				</div>
				
				<div class="large-5 columns item-shop-container row-fluid" style="margin-top:3%; background:#F0F0FF;">
					<div class="large-12 columns">
						<div class="item-shop-price">
						<sup>Ksh.</sup>'.$itemData['sale_price'].'<sup>00</sup>&nbsp;
						</div>
						<div class="item-shop-special-offers" style="margin-top:4%">
							'.$strSave.'
						</div>
					</div><br /><br />
					<div class="large-12 columns row-fluid" style="margin-left:0; margin-top:5%">
						<div class="large-2 columns">Quantity</div>
						<div class="large-4 columns">
							<select class="input-small" name="selectQuantity" id="itemQuantity">
								'.$strQuantity.'
							</select>
						</div>
						<div class="large-1 columns">&nbsp;</div>
						<div class="large-5 columns add-to-cart" style=""><button class="btn btn-warning" style="padding:5px 35px">Add to Cart</button></div>
					</div>
					<div class="large-12 columns" style="margin-top:30px">
						<div class="large-6 columns add-to-registry">
							<button class="btn" style="padding:5px 35px" onclick="javascript:SHOP.addToRegistry('.$itemData['item_code'].',\'Registry\')">Add to Registry</button>
						</div>
						<div class="large-6 columns add-to-wishlist">
							<button class="btn" style="padding:5px 35px">Add to Wishlist</button>
						</div>
					</div>
					<div class="large-12 columns" style="margin-top:30px">
						<div class="item-shop-store">
							Sold by <a href="'.$var_url.'store/'.strtolower($itemData['store_name']).'/">'.$itemData['store_name'].'</a>
						</div><br />
						<div class="item-shop-shipping">
							<div class="inner-heading">Shipping & Pickup</div>
							If <span class="spn-heading">Added to Cart</span>, you will select and specify your preferred mode of delivery. If <span class="spn-heading">Added to Registry</span>, edit your delivery option in your profile settings.
						</div>
					</div><br />
					<div class="large-12 columns" style="margin-top:30px">
						<div class="inner-heading">Product Specifications</div>
						<div>			
							'.$itemData['specification'].'
							<a href="#product-description">See more about this product below</a><br />&nbsp;
						</div>
					</div>
				</div>
				
			<div class="large-12 columns item-shop-product-descrption">
			<a name="product-description"></a>
				<div class="item-heading">Product Description</div><br />
				'.$itemData['description'].'
				<a name="specifications">&nbsp;</a>
				<div class="item-heading" style="margin-top:2%">Product Specifications</div><br />
				   '.$itemData['specification'].'
				
			</div>
			<div class="large-12 columns item-shop-other-items" style="margin-top:5%">
				<div class="item-heading">Customers who bought this item also bought these items</div><br />
			</div>
			
			<div class="large-12 columns item-shop-other-items" style="margin-top:5%">
				<div class="item-heading">Customers\' Reviews</div><br />
			</div>
			
			<div class="large-8 columns item-shop-other-items" style="margin-top:5%">
				<div class="item-heading">Product Policy</div><br />
				<div class="inner-heading">Warranty Plan</div>
				'.$itemData['pricing_policy'].'<br /><br />
				<div class="inner-heading">Pricing Policy</div>
				'.$itemData['warranty_plan'].'<br /><br />
				<div class="inner-heading">Returns</div>
				'.$itemData['returns'].'
			</div>
			
			</div><!--item-shop-main-->

		</div><!--item-shop-container-->
	</div>
</div><br /><!--end bodycontent-->

</body>
</html>';

echo($header.$body);

?>