<?php
	include($_SESSION['page']['home_url'].'account/bin/class.left-navbar.manage.php');
	$LeftNavBarHTML = new HandlerLeftNavBar('samedico_samedi',$_SESSION['account']['refUserId'],$_SESSION['page']['home_url']);
?>
<ul class="nav nav-list left-navbar" data-spy="affix" data-offset-top="200">
	<li class="nav-header">Registry</li>
	<li class=""><a href="<?=$_SESSION['page']['home_url']?>account/registry/">Create / Manage Registry</a></li>
	<li><a href="<?=$_SESSION["page"]["home_url"]?>registry/add-manual/">Manually add items</a></li>
	<li><a href="<?=$_SESSION["page"]["home_url"]?>registry/manage/">Manage Registry Items</a></li>
	<li><?php echo($LeftNavBarHTML->registryContactsHTML); ?></li>
	<li><a href="<?=$_SESSION["page"]["home_url"]?>account/registry/messages/" title="You have unsent messages">Registry Messages&nbsp;</a></li>
	<!--<li class="nav-header">Orders</li>
	<li><a href="#">Track Orders</a></li>
	<li><a href="#">Recent Orders</a></li>
	<li><a href="#">Orders History</a></li>
	<li class="nav-header">Shopping</li>	
	<li><a href="#">Shop & Save</a></li>
	<li><a href="#">Gift Sets</a></li>-->
	<li class="nav-header">Settings</li>	
	<!--<li><a href="#">Shipping Address</a></li>
	<li><a href="#">Pick Up Location</a></li>-->
	<li><a href="#">Contact Details</a></li>
	<li><?php echo($LeftNavBarHTML->messageCreditsHTML); ?></li>
	<li class="nav-header">Customer Service</li>	
	<li><a href="#">Contact Us</a></li>
	<li><a href="#">Help & F.A.Qs</a></li>
</ul>
