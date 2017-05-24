<?php

$memberAccess = (isset($_SESSION['account']['status']) && $_SESSION['account']['status']=='logged_in')?true:false;
$_SESSION['account']['memberAccess'] = $memberAccess;

  if(!$memberAccess){
		$memberContainer = '
			<div style="color:#FFC120" class="span5">Hello, <a href="'.$_SESSION["page"]["home_url"].'account/login/" style="color:#FFC120">Sign In</a> <span style="color:#000000">or</span><br />
			<a href="'.$_SESSION["page"]["home_url"].'account/signup/"><span style="color:#FFFFFF; font-weight:bold">Create a new account</span></a>
			</div>
		';
  }else{
		$memberContainer = '
			<a href="'.$_SESSION["page"]["home_url"].'account/" style="color:#FFC120" class="topNavLinkAcc">
				<div style="color:#FFC120; overflow:hidden" class="span5">Hello, '.$_SESSION['account']['refName'].'<br />
				<div style="color:#FFFFFF; font-weight:bold; width:100%; overflow:hidden;">email</div>
				</div>
			</a>
		';
		}

if($memberAccess){
	$userData = new UserDataModule($_SESSION['account']['refUserId']);
	$userData->getDetails($_SESSION['account']['refUserId']);
	
	$cartCount = $userData->intCartCount;
	$registryCount = $userData->intRegistryCount;
}else{
	$cartCount = 0;
	$registryCount = 0;
	 if(isset($_SESSION['shop']['Registry']) && $_SESSION['shop']['Registry']!=''){
	 	$arrItems = explode('|',$_SESSION['shop']['Registry']);
		$registryCount = count($arrItems);
	 }
	 if(isset($_SESSION['shop']['Cart']) && $_SESSION['shop']['Cart']!=''){
	 	$arrItems = explode('|',$_SESSION['shop']['Cart']);
		$cartCount = count($arrItems);
	 }
}


$strTOPNAV = '
<div class="row-fluid topnav" style="">
<div class="span1" id="topnav-logo">
	<div class="row-fluid">
		<div align="center" class="span12">
			<a href="'.$_SESSION["page"]["home_url"].'">
				<div class="span3 logo-char-container" style="font-size:24px">
					S
				</div>
				<div class="span9 logo-line-container" style="font-size:18px;">
					amedi.co.ke
				</div>
			</a>
		</div>
	</div>
</div>
<div style="" class="span7" id="topnav-search-quickLinks">
	<div class="row-fluid">
		<div align="right" style="margin-right:10px;">
			<a href="javascript:void()">&raquo; Gift Sets</a>&nbsp;&nbsp;
			<a href="javascript:void()">&raquo; Quick Registry Shopping</a>&nbsp;&nbsp;
			<a href="javascript:void()">&raquo; Find a store</a>&nbsp;&nbsp;
			<a href="javascript:void()">&raquo; Shop &amp; Save</a>
		</div>
		<div>
			<form class="form-search">
			  <div class="span1">&nbsp;</div>
			  <div class="input-append span10">
				<input type="text" class="span12 search-query" id="search-query">
				<button type="submit" class="btn btn-warning btn-search">Search</button>
			  </div>
			</form>
		</div>
	</div>
</div>
<div style="margin-left:5%" class="span3" id="topnav-help-cart">
	<div class="row-fluid">
		<div align="right" style="margin-right:10px;"><i class="icon-question-sign icon-white"></i>&nbsp;Help</div><br />
		'.$memberContainer.'
		<div class="span6 row-fluid" id="shopping-cart">
		  <div class="span5" title="Cart">
		  <a href="'.$_SESSION["page"]["home_url"].'shop/cart/" style="color:#FFFFFF">
			<img src="'.$_SESSION["page"]["home_url"].'img/shoping_cart-img.png" height="30" width="30" id="shopping-cart-img" />
			(<span class="cart-count">
					'.$cartCount.'
			</span>)
			</a>
		  </div>
		  <div class="span5" title="Registry">
		  <a href="'.$_SESSION["page"]["home_url"].'account/registry/manage/" style="color:#FFFFFF">
			<img src="'.$_SESSION["page"]["home_url"].'img/check_list-48.png" height="30" width="30" id="shopping-cart-img" />
			(<span class="registry-count">
				'.$registryCount.'
			</span>)
			</a>
		  </div>
			
		</div><br />
	</div>
</div>
</div>
<div style="width:100%; height:40px; z-index:10; position:absolute;" class="row-fluid appending-topnav">

	<a href="'.$_SESSION["page"]["home_url"].'shop/wedding-registry/"><div class="span3" id="registryMenuWedding" style="width:20%">
		<img src="'.$_SESSION["page"]["home_url"].'img/icons/wedding-rings.png"/>
		&nbsp;&nbsp;Wedding Gift Registry
	</div></a>
	<a href="javascript:void()"><div class="span3" id="registryMenuBaby">
		<img src="'.$_SESSION["page"]["home_url"].'img/icons/baby-cart.png"/>
		&nbsp;&nbsp;Baby Shower Gift Registry</div></a>
	<a href="javascript:void()"><div class="span3" id="registryMenuGraduation">
		<img src="'.$_SESSION["page"]["home_url"].'img/icons/graduation.png"/>
		&nbsp;&nbsp;Graduation Gift Registry</div></a>
	<a href="javascript:void()"><div class="span2" id="registryMenuOther">
		<img src="'.$_SESSION["page"]["home_url"].'img/icons/gift.png"/>
		&nbsp;&nbsp;Other</div></a>
	<div class="span2" id="registryMenuShop">
		<div style="margin-left:0px; font-weight:bold; color:#FFC120" class="button-link all-products">Registry Shopping&nbsp;<i class="icon-chevron-down icon-white" style="margin-top:2px"></i></div>
<!--All products--loaded via javascript-->
		<div class="all-products-container">
			<a href="javascript:void()">Clothing, Shoes &amp; Jewellery</a><br />
			<a href="javascript:void()">Men &amp; Women Fragrances</a><br />
			<a href="javascript:void()">Baby &amp; Kids Ware</a><br />
			<a href="javascript:void()">Home Electronics</a><br />
			<a href="javascript:void()">Office Electronics</a><br />
			<a href="javascript:void()">Sports &amp; Fittness</a><br />
			<a href="javascript:void()">Gift Cards &amp; Gift Sets</a><br />
			<a href="javascript:void()">View all categories&nbsp;&nbsp;&raquo;</a><br />
		</div>
<!--All products-->
	</div><br />
	<div style="margin-top:20px; margin-left:1%; width:20%; background:#007DC6; display:none">
		You have 3 items in your registry. <a href="javascript:void()">Manage Registry</a>
	</div>

</div>
	
	

<script type="text/javascript">
$(document).ready(function(){
	$(\'#registryMenuShop\').mouseenter(function(){
		$(\'.all-products>i\').removeClass(\'icon-chevron-down\');
		$(\'.all-products>i\').addClass(\'icon-chevron-up\');
		$(\'.all-products-container\').slideDown();
	});
	$(\'#registryMenuShop\').mouseleave(function(){
		$(\'.all-products>i\').removeClass(\'icon-chevron-up\');
		$(\'.all-products>i\').addClass(\'icon-chevron-down\');
		$(\'.all-products-container\').slideUp();
	});
});

</script>
';
function returnStrTOPNAV(){
	global $strTOPNAV;
	return $strTOPNAV;
}
?>