<?php

function displayScript($DBMS,$sqlArg,$specialCateg){
try{
	$ITEMS_DISPLAY = '1.0##';
	$count = 0;
	if($DBMS->dbconnection_status){
		$sqlQuery = $DBMS->dataconn->query($sqlArg);
		if($sqlQuery->rowCount()>0){
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
						$strVoteHTML = '<div class="large-6 columns"><img src="'.local_url.'img/thumbs-up.png"/>&nbsp;&nbsp;
						'.($row['thumbs_up']).' + <span style="font-size:13px">Your Vote</span>&nbsp;</div><div class="span5"><img src="'.local_url.'img/thumbs-down.png"/>&nbsp;&nbsp;
						'.$row['thumbs_down'].'</div>';
					}else{
						$strVoteHTML = '<div class="large-6 columns"><img src="'.local_url.'img/thumbs-up.png"/>&nbsp;&nbsp;
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
					<div class="large-6 columns item-price" style="padding-top:10px">
						<sup>Ksh.</sup>'.$row['sale_price'].'<sup>00</sup>&nbsp;
					</div>
					'.$strSave.'
					<br /><br />&nbsp;
					<div class="item-description" style="height:40px; overflow:hidden">
						<a href="'.local_url.'shop/'.$row['page_url'].'">'.$str.'</a>
					</div><br />
					'.$strVoteHTML.'
					<div class="row-fluid large-12 columns">
						'.$reviews.'
					</div>
				 </div>
				';
			   
		  }
		}else{
			if($specialCateg=='baby_shower'){
				$ITEMS_DISPLAY = '2.0##
					<div class="alert alert-info large-12 columns" style="margin-left:0; margin-top:10px;">
						There are no items specified for the baby shower registry yet.
						Please select other items below:
					</div><br />
				';
			}elseif($specialCateg=='graduation'){
				$ITEMS_DISPLAY = '2.0##
					<div class="alert alert-info large-12 columns" style="margin-left:0; margin-top:10px;">
						There are no items specified for the graduation registry yet.
						Please select other items below:
					</div><br />
				';
			}
			
		}
	 }

 }catch(PDOException $e){
	$ITEMS_DISPLAY = '3.0##error--'.$e->getMessage();
  }

	return $ITEMS_DISPLAY;
}

?>