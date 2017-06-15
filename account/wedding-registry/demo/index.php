<?php
function redirectToPage($page){
	header('Location:'.$page);
}
session_start();

if(!isset($_SESSION['account']['status']) || $_SESSION['account']['status']!='logged_in'){
	$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Session Expired. Please log in.</div></div>';
	redirectToPage('../login/');
}

$_SESSION['page']['home_url'] = '../../';
	
	$FormData = array();
	$fieldCount = 13;
	for($i=0; $i<$fieldCount; $i++){
		$FormData[$i]='';
	 }
	 
$FormSubmitTo = "../bin/user.wedding.reg.php?usrReg=new";
$userImagePath = '../wedding-registry/'.str_replace('/','.',$_SESSION['account']['refUserId']);
$editStage = "new";

	function splitEntry($str,$split,$char){
		$arr = explode($char,$str);
		return $arr[$split];
	 }
	 
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Samedi: Registry</title>
<?php
include($_SESSION['page']['home_url'].'templates/script-tags.php');
?>
<script type="text/javascript" src="<?=$_SESSION['page']['home_url']?>js/registry.01.js"></script>
</head>

<body>

<?php
	include($_SESSION['page']['home_url'].'templates/top-nav.dev.php');

$WeddingRegistry = false;
$DBMS_temp = new user_DBMS('samedico_samedi');

	$sqlFind = $DBMS_temp->dataconn->prepare("SELECT active_registry FROM users WHERE userId=?");
	$sqlFind->execute(array($_SESSION['account']['refUserId']));
	$row = $sqlFind->fetch(PDO::FETCH_ASSOC);
	$arrRegistries = explode('*',$row['active_registry']);
	
	for($i=0; $i<count($arrRegistries); $i++){
		if($arrRegistries[$i]=="wedding_registry"){
			$WeddingRegistry = true;
			break;
		}
	}

$DBMS_temp->DBClose();
	

$DB_NAME = "samedico_wedding_registry";
	
if($WeddingRegistry){
	//getDatabase variables
	$FormSubmitTo = "../bin/user.wedding.reg.php?usrReg=update";
	$editStage = "repeat";
	
	$DBMS = new user_DBMS($DB_NAME);
	
	try{
		if($DBMS->dbconnection_status){
			$sqlSelect = $DBMS->dataconn->prepare("SELECT * FROM usr_registries WHERE userId=?");
			$sqlSelect->execute(array($_SESSION['account']['refUserId']));
			if($sqlSelect->rowCount()>0){
				$row = $sqlSelect->fetch(PDO::FETCH_NUM);
					$FormData[0] = splitEntry($row[2],0,'*');//brideFName
					$FormData[1] = splitEntry($row[2],1,'*');//brideMName
					$FormData[2] = splitEntry($row[3],0,'*');//groomFName
					$FormData[3] = splitEntry($row[3],1,'*');//groomMName
					$FormData[4] = splitEntry($row[4],0,' - ');//day
					$FormData[5] = splitEntry($row[4],1,' - ');//month
					$FormData[6] = splitEntry($row[4],2,' - ');//year
					$FormData[7] = $row[5];//image
					$FormData[8] = $row[6];//wlocation
					$FormData[9] = $row[7];//rlocation
					$FormData[10] = $row[8];//plocation
					$FormData[11] = $row[9];//wdstatus
					$FormData[12] = $row[10];//dateCreated
					
			 }
		 }
	$DBMS->DBClose();
	
	}catch(PDOExcetion $e){
		echo("Error ".$e->getMessage());
	 }
}

$selectData = $FormData[4].'|'.$FormData[5].'|'.$FormData[6].'|'.$FormData[11];

?>
<!--End top nav-->
<input type="hidden" id="pageLife" value="<?=$FormSubmitTo?>" />
<input type="hidden" id="editStage" value="<?=$editStage?>" />

<input type="hidden" id="selectData" value="<?=$selectData?>" />

<div class="body-content account-page row-fluid" style="margin-top:100px;">
	<div class="large-1 columns">&nbsp;</div>
	<div class="large-3 columns leftNavbar-container" style="margin-top:30px;">
		<?php
		include($_SESSION['page']['home_url'].'account/bin/left-navbar.php');
		?>
	</div>
	
	<div class="large-7 columns lowerContent">
		<br />
		<div class="row-fluid">
			<div class="large-12 columns row-fluid" style="height:130px; background:url('../../img/cloud-background.jpg')">
				<div class="large-3 columns"><img src="<?=$_SESSION['page']['home_url']?>img/wedding-rings-medium.png" style="opacity:0.6" /></div>
				<div class="large-6 columns account-registry-image" style="margin-top:30px">Wedding Registry<br /><br />
					<div style="color:#ffffff; font-style:italic; font-size:18px">Your gift for my special day</div>
				</div>
			</div>
		</div><br />

		<div class="innerBodyContent row-fluid">
		<?php
		if(isset($_SESSION['registry']['temp_detail_edit']) && $_SESSION['registry']['temp_detail_edit']!=""){
			echo($_SESSION['registry']['temp_detail_edit']);
		}
			unset($_SESSION['registry']['temp_detail_edit']);
		?>
			<form id="frmRegistry" method="post" enctype="multipart/form-data" action="<?=$FormSubmitTo?>">
				<div class="large-4 columns"><h3>Wedding details</h3></div><br />
				<div class="large-12 columns row-fluid">
					<div class="large-4 columns row-fluid" style="padding-left:20px">
						<div class="large-10 columns inner-heading">Bride</div><br /><br />
						<div class="control-group" id="inputBrideFNameGroup">
							<label class="control-label" for="inputBrideFName">First Name</label>
							<div class="controls">
								<input type="text" id="inputBrideFName" name="inputBrideFName" placeholder="Bride's First Name" value="<?=$FormData[0]?>">
							</div>
						</div>
						<div class="control-group" id="inputBrideMNameGroup">
							<label class="control-label" for="inputBrideMName">Middle Name</label>
							<div class="controls">
								<input type="text" id="inputBrideMName" name="inputBrideMName" placeholder="Bride's Middle Name" value="<?=$FormData[1]?>">
							</div>
						</div>
					</div>
					
					<div class="large-2 columns">
						<img src="<?=$_SESSION['page']['home_url']?>img/and-medium.png" style="opacity:0.6" />
					</div>
					
					<div class="large-4 columns row-fluid" style="padding-left:20px;">
						<div class="large-10 columns inner-heading">Groom</div><br /><br />
						<div class="control-group" id="inputGroomFNameGroup">
							<label class="control-label" for="inputGroomFName">First Name</label>
							<div class="controls">
								<input type="text" id="inputGroomFName" name="inputGroomFName" placeholder="Groom's First Name" value="<?=$FormData[2]?>">
							</div>
						</div>

						<div class="control-group" id="inputGroomMNameGroup">
							<label class="control-label" for="inputGroomMName">Middle Name</label>
							<div class="controls">
							  <input type="text" id="inputGroomMName" name="inputGroomMName" placeholder="Groom's Middle Name" value="<?=$FormData[3]?>">
							</div>
						 </div>

					</div>
				</div>

				<div class="large-12 columns row-fluid dateContainer" style="margin-top:3%">
					<div class="large-2 columns"><img src="<?=$_SESSION['page']['home_url']?>img/calendar-64.png" /></div>
					<div class="large-3 columns">
						<div>Day
							<?php echo(($FormData[4]!='')?'<div class="inline-heading">('.$FormData[4].')</div>':'') ?>
						</div><br />
						<select class="selectDate input-medium" disabled="disabled">
							<option selected="selected">Select Month</option>
						</select>
					</div>
					<div class="large-4 columns">
						<div>Month
							<?php echo(($FormData[5]!='')?'<div class="inline-heading">('.$FormData[5].')</div>':'') ?>
						</div><br />
						<select class="selectMonth" onchange="javascript:dateManager.monthChanges(this.value)">
							<option>-month-</option>
							<option value="January">January</option>
							<option value="February">February</option>
							<option value="March">March</option>
							<option value="April">April</option>
							<option value="May">May</option>
							<option value="June">June</option>
							<option value="July">July</option>
							<option value="August">August</option>
							<option value="September">September</option>
							<option value="October">October</option>
							<option value="November">November</option>
							<option value="December">December</option>
						</select>
					</div>
					<div class="large-3 columns">
						<div>Year 
							<?php echo(($FormData[6]!='')?'<div class="inline-heading">('.$FormData[6].')</div>':'') ?>
						</div><br />
						<select class="selectYear input-medium">
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
						</select>
					</div>
					<div  class="large-3 columns"></div>
					<div  class="large-7 columns dateError" id="dateError"></div>
				</div><br /><!--dateContainer-->
				
				<div class="large-9 columns row-fluid photoContainer" style="margin-top:5%">
					<div class="large-2 columns">
						<img src="<?=$_SESSION['page']['home_url']?>img/image-icon-64.png" />
					</div>
					<div class="large-9 columns">
						<div style="font-size:14px">
							Upload pre-wedding pictures&nbsp;&nbsp;<span class="help-inline">(Optional)</span>
						</div><br />
						<?php
						if(isset($_SESSION['registry']['image']) && $_SESSION['registry']['image']!=""){
							echo($_SESSION['registry']['image']);
						}
							unset($_SESSION['registry']['image']);
							
							
						if($FormData[7]!=''){
						?>
						<ul class="thumbnails">
							<li class="large-12 columns">
								<a href="<?=$userImagePath.'/'.$FormData[7]?>" target="_blank" title="click to view a larger image">
									<div class="thumbnail">
										<img src="<?=$userImagePath.'/'.$FormData[7]?>" alt="">
									</div>
								</a>
								<div>
									&raquo;&nbsp;Have extra pictures of the moment?
									<a href="javascript:void()">Start / Manage gallery</a> and let friends and family know and see about it.
								</div>
							</li>
						</ul>
						<div>
							&raquo;&nbsp;Need extra pictures to show out. 
							<a href="javascript:void()">Book a session</a> with us and let us capture those extra moments.
						</div>
						<?php
							}else{
						?>
						<div>
							<input type="file" name="imagesUpload" />
						</div><br />
						<div>
							Have no pictures? No worries. 
							<a href="javascript:void()">Book a session</a> with us and let us capture that moment.
						</div>
						<?php } ?>
					</div>
				</div><br /><!--photoContainer-->

				<div class="large-11 columns row-fluid otherDetailsContainer" style="margin-top:5%;">
					<div class="large-2 columns inner-heading">Other details</div>
					<div class="large-10 columns row-fluid">
						<div class="control-group" id="weddingLocationGroup">
							<label class="control-label large-4 columns" for="weddingLocation">Wedding Location</label>
							<div class="controls">
								<input type="text" id="weddingLocation" name="weddingLocation" placeholder="Wedding Location" value="<?=$FormData[8]?>">
							</div>
						</div>

						<div class="control-group" id="receptionLocationGroup">
							<label class="control-label large-4 columns" for="receptionLocation">Reception Location</label>
							<div class="controls">
								<input type="text" id="receptionLocation" name="receptionLocation" placeholder="Reception Location" value="<?=$FormData[9]?>">
								<span class="help-inline">(Optional)</span>
							</div>
						</div>

						<div class="control-group" id="eveningPartyGroup">
							<label class="control-label large-4 columns" for="eveningParty">Evening Party Location</label>
							<div class="controls">
								<input type="text" id="eveningParty" name="eveningParty" placeholder="Bridal Party - Optional" value="<?=$FormData[10]?>"><br />
								(Bridal Party - Optional)
							</div>
						</div>

					</div>
				</div><br /><!--otherDetailsContainer-->
				
				<div class="large-11 columns row-fluid weddingStatusContainer" style="margin-top:5%;">
					<div class="large-2 columns inner-heading">Wedding Status</div>
					<div class="large-9 columns row-fluid">
						<div class="">
							<select class="selectWeddingStatus input-medium" id="selectWeddingStatus" name="selectWeddingStatus">
								<option value="Private">Private</option>
								<option value="Public">Public</option>
							</select>
							<span class="help-inline"><a href="javascript:void()">What do I choose?</a></span>
						</div>
						<br />
					</div>
				</div><!--weddingStatusContainer-->
				
				<div class="large-9 columns row-fluid saveElement" style="margin-top:5%;">
					<input type="hidden" id="setDate" name="setDate" value="" />
					<div class="label-err-container" id="label-err-container">
						<div class="label-err">
							You have empty fields that are not optional in your form. Please check and try again!
						</div><br />
					</div>
					<?php
						if($editStage=="new"){
					?>
					<div class="large-5 columns">
						<button type="button" class="btn btn-primary btn-large" onclick="javascript:registry.verifyDate()">
							Save Details
						</button>
					</div>
					<?php
						}else{
					?>
					<div class="large-5 columns">
						<button type="button" class="btn btn-primary btn-large" onclick="javascript:registry.verifyDate()">Save Changes</button>
					</div>
					<?php } ?>
					<div class="large-3 columns">
						<button type="button" class="btn btn-inverse btn-large">Cancel</button>
					</div>
				</div><!--saveElement--><br />
				<div class="large-10 columns" style="padding-left:2%">
					<br />*You can always edit this registry. Just click <strong>Manage Registry</strong> - on the left.
				</div>
			</form>
		</div><!--innerBodyContent-->
		<?php
			echo('<br /><br /><br />'); //manual top margin
			include($_SESSION['page']['home_url']."templates/footer-account-pages.php");
		?>
	</div><!--lowerContent-->

</div><br /><!--end bodycontent-->

<div class="footer-container-end">
	<div class="large-1 columns" style="width:1%">
		&nbsp;
	</div>
	&copy;&nbsp;&nbsp;Samedi Registry Co.&nbsp;
	<?php echo(date('Y')); ?>
</div>
	
</body>
</html>

<script type="text/javascript">
//$selectData = $FormData[4].'|'.$FormData[5].'|'.$FormData[6].'|'.$FormData[11];
$(document).ready(function(){
	if($('#editStage').val()=='repeat'){
		if($("#selectData").val()!=""){
			var arrCheck = $("#selectData").val().split('|');
			$('#selectWeddingStatus').val(arrCheck[3]);
			$('.selectYear').val(arrCheck[2]);
			$('.selectMonth').val(arrCheck[1]);
			dateManager.monthChanges(arrCheck[1]);
			$('.selectDate').val(arrCheck[0]);
		}
	}
});
</script>