<?php
session_start();

$_SESSION['page']['home_url'] = '../';
define('local_url','../');

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
			<div class="span12 row-fluid" style="height:230px;">
				<img src="cdn/wedding-gift-banner.jpg" width="1350"/>
			</div>
		  </div><br />
	</div><!--lowerContent-->
	
	<div class="innnerBodyContent" style="margin-top:12%">
		<div class="span1" style="">&nbsp;</div>
		<div class="span11 row-fluid item-shop-container" style="">
			<div class="span10 row-fluid item-shop-main" style="padding-top:10px; padding-left:10px;">
				<div class="span10 page-links">
					<a href="javascript:void()">Home</a>&nbsp;&raquo;&nbsp;
					<a href="javascript:void()">Gifts</a>&nbsp;&raquo;&nbsp;
					All
					<!-- developer sample (Add by refine)-->
				</div><br />
                <div class="row-fluid" style="margin-top:10px;"><!--000-->
                    <div class="span10 row-fluid refine-container" style="height:80px; width:100%; margin-top:20px; margin-left:0; border-bottom:solid thick #999999; padding-top:20px">
						<div class="span1">Refine</div>
						<div class="span3">
						        <div class="btn-group">
								  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width:150px">
									Price (Ksh.)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu">
									<li><label><input type="radio" style="margin:5px" />&nbsp;Ksh: 0.00 - 1000.00</label></li>
									<li><label><input type="radio" style="margin:5px" />&nbsp;Ksh: 1001.00 - 5000.00</label></li>
									<li><label><input type="radio" style="margin:5px" />&nbsp;Ksh: 5001.00 - 10000.00</label></li>
									<li><label><input type="radio" style="margin:5px" />&nbsp;Ksh: 1001.00 - 25000.00</label></li>
									<li><label><input type="radio" style="margin:5px" />&nbsp;Ksh: 25001.00 - 50000.00</label></li>
									<li><label><input type="radio" style="margin:5px" />&nbsp;Ksh: Above 50001.00</label></li>
								  </ul>
								</div>
						</div>
                        <div class="span3">
								 <div class="btn-group">
								  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width:150px">
									Orders&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu">
									<li><label><input type="radio" style="margin:5px" />&nbsp;Less Than 100</label></li>
									<li><label><input type="radio" style="margin:5px" />&nbsp;101 - 500</label></li>
									<li><label><input type="radio" style="margin:5px" />&nbsp;501 - 1000</label></li>
									<li><label><input type="radio" style="margin:5px" />&nbsp;Above 1001</label></li>
								  </ul>
								</div>
						</div>
						<div class="span3">
								<div class="btn-group">
								  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width:150px">
									Date Added&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu">
									<li><label><input type="radio" style="margin:5px" />&nbsp;Today</label></li>
									<li><label><input type="radio" style="margin:5px" />&nbsp;Less Than 1 Week</label></li>
									<li><label><input type="radio" style="margin:5px" />&nbsp;Less Than 2 Weeks</label></li>
									<li><label><input type="radio" style="margin:5px" />&nbsp;Less Than 1 Month</label></li>
									<li><label><input type="radio" style="margin:5px" />&nbsp;Less Than 3 Months</label></li>
								  </ul>
								</div>
						</div>
                      </div><br /><br />&nbsp;
                    <div class="row-fluid" style="margin-top:1%"><!--1-->
                    	<div class="span6">
                        	<div>
                            	<h4>OSB8 – Lumia 3+1+1 Sofa Set</h4>
                            </div><br />
                        	<img src="cdn/pic-3.jpg" /><br />
                            <div>
                            	<h5>Price: Ksh. 78,000</h5>
                            </div>
                            <div style="height:100px; overflow:hidden">
                            	<div style="height:40px;">
                            	Add style and comfort to your home with this Lumia 3+1+1 sofa set. It’s simple yet stylish design makes it a must-have in your home. You can enjoy a carefree and relaxed afternoon with this sophisticated sofa set design. 
                                </div><br />
                                <div style="height:40px; opacity:0.4;">
                                	You can now experience the online furniture shopping and have this piece of furniture at your home at attractive sofa set prices.
                                </div>
                            </div><br />
							<div class="row-fluid">
                            	<div class="span5" style="background:#F00; padding:10px 0; opacity:0.7" align="center">
	                            	<span style="color:#FFF; font-weight:bold">
                                    	View more details
                                    </span>
                                </div>
                                <div class="span5" style="background:#8080FF; padding:10px 0;" align="center">
                                	<span style="color:#FFF; font-weight:bold">
                                    	Add Item to registry
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="span6">
                        	<div>
                            	<h4>Veneza 3+1+1 sofa set Royale-4</h4>
                            </div><br />
                        	<img src="cdn/pic-2.jpg" /><br />
                            <div>
                            	<h5>Price: Ksh. 78,000</h5>
                            </div>
                            <div style="height:100px; overflow:hidden">
                            	<div style="height:40px;">
                            	The internal structures of this products is made with steel / wood, which is treated by seven step pre-treatment process to ensure maximum durability. Cushioning is done through robotically injected polyurethane that grants 
                                </div><br />
                                <div style="height:40px; opacity:0.4;">maximum durability and superior comfort. The Life of the polyurethane is also very high. Most of the furniture also has special patented mechanisms, which allow for maximum ergonomic comfort at various position 
                                </div>
                            </div><br />
							<div class="row-fluid">
                            	<div class="span5" style="background:#F00; padding:10px 0; opacity:0.7" align="center">
	                            	<span style="color:#FFF; font-weight:bold">
                                    	View more details
                                    </span>
                                </div>
                                <div class="span5" style="background:#8080FF; padding:10px 0;" align="center">
                                	<span style="color:#FFF; font-weight:bold">
                                    	Add Item to registry
                                    </span>
                                </div>
                            </div>
                        </div><!--span6-->
                        
                    </div><!--#1-->
                </div><!--#000-->
			</div><!--item-shop-main-->

		</div><!--item-shop-container-->
	</div><!--innnerBodyContent-->
</div><br /><!--end bodycontent-->
<?php
	echo('<br /><br /><br />'); //manual top margin
	include($_SESSION['page']['home_url']."templates/footer-nav.php");
?>
</body>
</html>
    