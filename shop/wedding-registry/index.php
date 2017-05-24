<?php
session_start();

$_SESSION['page']['home_url'] = '../../';
define('local_url','../../');

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
			<div class="span12 row-fluid" style="height:160px; background:url('../../img/cloud-background.jpg')">
				<div class="span2"></div>
				<div class="span2" style="margin-top:25px">
					<img src="../../img/wedding-rings-medium.png" />
				</div>
				<div class="span5 account-registry-image" style="margin-top:100px; margin-left:0;">A special gift for the special day.<br /><br />
				</div>
				<div class="span3" style="margin-top:100px;">
					<div class="input-append" style="height:25px">
						<form class="form-horizontal invite-form" action="bin/invitation.processing.php" method="post">
						  <input type="text" placeholder="Enter the Invitation Code" name="invitation_registry" id="invitation_registry" size="span4" />
						  <button type="button" class="btn" onclick="INVITATION_JSMOD.validateInviteCode()">View Registry</button><br />
						</form>
					</div>
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
	
	<div class="innnerBodyContent" style="margin-top:12%">
		<div class="span1" style="width:auto">&nbsp;</div>
		<div class="span11 row-fluid item-shop-container" style="margin-left:0.5%">
			<div class="span1 row-fluid">
				
			</div>
			
			<div class="span11 row-fluid item-shop-main" style="padding-top:10px; padding-left:10px;">
				
				<div class="span10" style="height:150px; width:100%; margin-left:0">
					<div style="font-size:24px">
						<img class="span4" src="../../img/gift_vouchers.jpg" />
						<img class="span4" src="../../img/kitchenware.jpg" />
						<img class="span4" src="../../img/furniture1-big.jpg" />
					</div><br />
					<div style="font-family:Cambria; font-size:18px; font-weight:bold" align="center">
						Select the best and the biggest deals of items for your registry.
					</div><br />&nbsp;
				</div>
				
				<div class="span10 row-fluid refine-container" style="height:80px; width:100%; margin-top:80px; margin-left:0; border-bottom:solid thick #999999; padding-top:20px">
					<div class="span2">Refine</div>
					<div class="span3">
						        <div class="btn-group">
								  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width:150px">
									Price (Ksh.)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu">
									<li><label><input type="radio" name="priceFilter" value="priceGroup1" style="margin:5px" />&nbsp;Ksh: 0.00 - 1000.00</label></li>
									<li><label><input type="radio" name="priceFilter" value="priceGroup2" style="margin:5px" />&nbsp;Ksh: 1001.00 - 5000.00</label></li>
									<li><label><input type="radio" name="priceFilter" value="priceGroup3" style="margin:5px" />&nbsp;Ksh: 5001.00 - 10000.00</label></li>
									<li><label><input type="radio" name="priceFilter" value="priceGroup4" style="margin:5px" />&nbsp;Ksh: 1001.00 - 25000.00</label></li>
									<li><label><input type="radio" name="priceFilter" value="priceGroup5" style="margin:5px" />&nbsp;Ksh: 25001.00 - 50000.00</label></li>
									<li><label><input type="radio" name="priceFilter" value="priceGroup6" style="margin:5px" />&nbsp;Ksh: Above 50001.00</label></li>
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
									<li><label><input type="radio" name="ordersFilter" value="orderFilter1" style="margin:5px" />&nbsp;Less Than 100</label></li>
									<li><label><input type="radio" name="ordersFilter" value="orderFilter2" style="margin:5px" />&nbsp;101 - 500</label></li>
									<li><label><input type="radio" name="ordersFilter" value="orderFilter3" style="margin:5px" />&nbsp;501 - 1000</label></li>
									<li><label><input type="radio" name="ordersFilter" value="orderFilter4" style="margin:5px" />&nbsp;Above 1001</label></li>
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
									<li><label><input type="radio" name="dateFilter" value="dateFilter1" style="margin:5px" />&nbsp;Today</label></li>
									<li><label><input type="radio" name="dateFilter" value="dateFilter2" style="margin:5px" />&nbsp;Less Than 1 Week</label></li>
									<li><label><input type="radio" name="dateFilter" value="dateFilter3" style="margin:5px" />&nbsp;Less Than 2 Weeks</label></li>
									<li><label><input type="radio" name="dateFilter" value="dateFilter4" style="margin:5px" />&nbsp;Less Than 1 Month</label></li>
									<li><label><input type="radio" name="dateFilter" value="dateFilter5" style="margin:5px" />&nbsp;Less Than 3 Months</label></li>
								  </ul>
								</div>
					</div><br /><br />
				</div><!--refine-container-->
				
		<?php
			include('../bin/shop.db.php');
			include('../bin/shop.scripts.php');
			
			$DB_NAME = "samedico_shop";
			
			
			$DBMS = new Shop_DBMS($DB_NAME);
			$ITEMS_DISPLAY = '';
			$count = 0;
			try{
				if($DBMS->dbconnection_status){
					$sqlQuery = $DBMS->dataconn->query("SELECT item_code,brand,sale_price,original_price,abstract,page_url,image,thumbs_up,thumbs_down FROM items_data limit 1");
					while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC)){
						if($row['original_price']>$row['sale_price']){
							$strSave = '
									<div class="span5" style="margin-top:5px; font-family:Calibri; font-size:12px">
										Was <span style="text-decoration:line-through">Ksh. '.$row['original_price'].'</span><br />
										Save Ksh. '.substractCash($row['original_price'],$row['sale_price']).'
									</div>
							 ';
						 }
						 $str = strtoupper($row['abstract']);
							if(strlen($str) > 45){
								$str = substr($str,0,45).' ...';
							 }elseif(strlen($str) < 26){
							 	$str = $str.'<br />';
							 }
						$strVoteHTML = '
							<div class="span5">
								<img src="'.local_url.'img/thumbs-up.png" onclick="product.review(\'thumbs_up\','.$row['item_code'].')" />&nbsp;&nbsp;
									'.$row['thumbs_up'].'
								</div>
							<div class="span5">
								<img src="'.local_url.'img/thumbs-down.png" onclick="product.review(\'thumbs_down\','.$row['item_code'].')"/>&nbsp;&nbsp;
									'.$row['thumbs_down'].'
								</div>
						';
						
						if(isset($_SESSION['account']['refUserId'])){
							$sqlVotes = $DBMS->dataconn->prepare("SELECT vote FROM reviews WHERE item_code=? and userId=? LIMIT 1");
							$sqlVotes->execute(array($row['item_code'],$_SESSION['account']['refUserId']));
							
							if($sqlVotes->rowCount()>0){
								$voteRow = $sqlVotes->fetch(PDO::FETCH_ASSOC);
								if($voteRow['vote']=='thumbs_up'){
									$strVoteHTML = '<div class="span6"><img src="'.local_url.'img/thumbs-up.png"/>&nbsp;&nbsp;
									'.($row['thumbs_up']).' + <span style="font-size:13px">Your Vote</span>&nbsp;</div><div class="span5"><img src="'.local_url.'img/thumbs-down.png"/>&nbsp;&nbsp;
									'.$row['thumbs_down'].'</div>';
								}else{
									$strVoteHTML = '<div class="span6"><img src="'.local_url.'img/thumbs-up.png"/>&nbsp;&nbsp;
									'.$row['thumbs_up'].'</div><div class="span5"><img src="'.local_url.'img/thumbs-down.png"/>&nbsp;&nbsp;
									'.$row['thumbs_down'].'</div>';
								}
							}
						}
						$sqlReviews = $DBMS->dataconn->prepare("SELECT review FROM reviews WHERE item_code=? and review<>?");
						$sqlReviews->execute(array($row['item_code'],'(empty)'));
						$reviews = $sqlReviews->rowCount().' Reviews';
						
						$count ++;
						if($count%4==0 || $count==1){
							$strContainer = '<div class="span3" style="margin-left:0; margin-top:10px;">';
						 }else{
						   $strContainer = '<div class="span3">';
						   }	 
							$ITEMS_DISPLAY .= $strContainer.'
								<div class="item-image">
									<a href="'.local_url.'shop/'.$row['page_url'].'"><img class="img-rounded" src="'.$_SESSION['page']['home_url'].'img/'.$row['image'].'" /></a>
								</div><br />
								<div class="span6 item-price" style="padding-top:10px">
									<sup>Ksh.</sup>'.$row['sale_price'].'<sup>00</sup>&nbsp;
								</div>
								'.$strSave.'
								<br /><br />&nbsp;
								<div class="item-description" style="height:40px; overflow:hidden">
									<a href="'.local_url.'shop/'.$row['page_url'].'">'.$str.'</a>
								</div><br />
								'.$strVoteHTML.'
								<div class="row-fluid span12">
									'.$reviews.'
								</div>
							 </div>
							';
						   
					}
				 }
			
			 }catch(PDOException $e){
			 	echo('error--'.$e->getMessage());
			  }
		
		
		?>		
				<?php echo($ITEMS_DISPLAY); ?>				
				
				
				
			</div><!--item-shop-main-->

		</div><!--item-shop-container-->
	</div>
</div><br /><!--end bodycontent-->

<?php
	echo('<br /><br /><br />'); //manual top margin
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
			<textarea id="review" rows="4" placeholder="Write your review ..." class="span4"></textarea>
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
    