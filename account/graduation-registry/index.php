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
	 
$FormSubmitTo = "../bin/user.graduation.reg.php?usrReg=new";
$userImagePath = '../graduation-registry/'.str_replace('/','.',$_SESSION['account']['refUserId']);
$editStage = "new";

	function splitEntry($str,$split,$char){
		$arr = explode($char,$str);
		return $arr[$split];
	 }
	 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Samedi: Registry</title>
<?php
include($_SESSION['page']['home_url'].'templates/script-tags.php');
?>
<script type="text/javascript" src="<?=$_SESSION['page']['home_url']?>js/registry.01.js"></script>
</head>

<body>

<?php
	include($_SESSION['page']['home_url'].'templates/top-nav.dev.php');

$GraduationRegistry = false;
$DBMS_temp = new user_DBMS('samedico_samedi');

	$sqlFind = $DBMS_temp->dataconn->prepare("SELECT active_registry FROM users WHERE userId=?");
	$sqlFind->execute(array($_SESSION['account']['refUserId']));
	$row = $sqlFind->fetch(PDO::FETCH_ASSOC);
	$arrRegistries = explode('*',$row['active_registry']);
	
	for($i=0; $i<count($arrRegistries); $i++){
		if($arrRegistries[$i]=="graduation_registry"){
			$GraduationRegistry = true;
			break;
		}
	}

$DBMS_temp->DBClose();
	

$DB_NAME = "samedico_graduation_registry";
	
if($GraduationRegistry){
	//getDatabase variables
	$FormSubmitTo = "../bin/user.graduation.reg.php?usrReg=update";
	$editStage = "repeat";
	
	$DBMS = new user_DBMS($DB_NAME);
	
	try{
		if($DBMS->dbconnection_status){
			$sqlSelect = $DBMS->dataconn->prepare("SELECT * FROM usr_registries WHERE userId=?");
			$sqlSelect->execute(array($_SESSION['account']['refUserId']));
			if($sqlSelect->rowCount()>0){
				$row = $sqlSelect->fetch(PDO::FETCH_NUM);
					$FormData[0] = $row[2];
					$FormData[1] = $row[3];
					$FormData[2] = $row[6];
					$FormData[3] = $row[7];
					$FormData[4] = splitEntry($row[4],0,' - ');//day
					$FormData[5] = splitEntry($row[4],1,' - ');//month
					$FormData[6] = splitEntry($row[4],2,' - ');//year
					$FormData[7] = $row[5];//image
					$FormData[8] = $row[8];//glocation
					$FormData[11] = $row[9];//gdstatus
					$FormData[12] = $row[11];//dateCreated
					
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

<div class="body-content account-page row-fluid" style="margin-top:70px;">
	<div class="span3">&nbsp;</div>
	<div class="span8 lowerContent">
		<br />
		<div class="row-fluid">
			<div class="span12 row-fluid" style="height:130px; background:#88C4FF">
				<div class="span3"><img src="<?=$_SESSION['page']['home_url']?>img/graduation-cap-medium.png" style="opacity:0.6" /></div>
				<div class="span6 account-registry-image" style="margin-top:30px; color:#fff">
                	Graduation Gift Registry<br /><br />
                    <span style="font-size:15px; font-style:italic">We are all in a gutter, but some of us are looking at the stars - Oscar Wilde</span>
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
				<div class="span12 row-fluid">
                	<div class="span2">&nbsp;</div>
					<div class="span10 row-fluid" style="padding-left:20px">
						<div class="control-group" id="inputFNameGroup">
							<label class="control-label span3" for="inputFName">First Name</label>
							<div class="controls">
								<input type="text" id="inputFName" name="inputFName" placeholder="First Name" value="<?=$FormData[0]?>">
							</div>
						</div>
						<div class="control-group" id="inputMNameGroup">
							<label class="control-label span3" for="inputMName">Middle Name</label>
							<div class="controls">
								<input type="text" id="inputMName" name="inputMName" placeholder="Middle Name" value="<?=$FormData[1]?>">
							</div>
						</div>
					</div>
				</div><br>
                <div class="span12 row-fluid" style="margin-left:0">
                	<div class="span2">&nbsp;</div>
					<div class="span10 row-fluid" style="padding-left:20px;">
						<div class="control-group" id="inputCourseGroup">
							<label class="control-label span3"for="inputCourse">Course</label>
							<div class="controls">
								<input type="text" id="inputCourse" name="inputCourse" placeholder="Course Name" value="<?=$FormData[2]?>">
							</div>
						</div>
						<div class="control-group" id="inputInstNameGroup">
							<label class="control-label span3" for="inputInstName">Institution</label>
							<div class="controls">
								<input type="text" id="inputInstName" name="inputInstName" placeholder="Institution" value="<?=$FormData[3]?>">
							</div>
						</div>
					</div>
				</div>

				<div class="span12 row-fluid dateContainer" style="margin-top:3%">
					<div class="span2"><img src="<?=$_SESSION['page']['home_url']?>img/calendar-64.png" /></div>
					<div class="span3">
						<div>Day
							<?php echo(($FormData[4]!='')?'<div class="inline-heading">('.$FormData[4].')</div>':'') ?>
						</div><br />
						<select class="selectDate input-medium" disabled="disabled">
							<option selected="selected">Select Month</option>
						</select>
					</div>
					<div class="span4">
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
					<div class="span3">
						<div>Year 
							<?php echo(($FormData[6]!='')?'<div class="inline-heading">('.$FormData[6].')</div>':'') ?>
						</div><br />
						<select class="selectYear input-medium">
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
						</select>
					</div>
					<div  class="span3"></div>
					<div  class="span7 dateError" id="dateError"></div>
				</div><br /><!--dateContainer-->
				
				<div class="span12 row-fluid photoContainer" style="margin-top:5%">
					<div class="span2">
						<img src="<?=$_SESSION['page']['home_url']?>img/image-icon-64.png" />
					</div>
					<div class="span9">
						<div style="font-size:14px">
							Upload pictures&nbsp;&nbsp;<span class="help-inline">(Optional)</span>
						</div><br />
						<?php
						if(isset($_SESSION['registry']['image']) && $_SESSION['registry']['image']!=""){
							echo($_SESSION['registry']['image']);
						}
							unset($_SESSION['registry']['image']);
							
							
						if($FormData[7]!=''){
						?>
						<ul class="thumbnails">
							<li class="span12">
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

				<div class="span12 row-fluid otherDetailsContainer" style="margin-top:6%;">
                	<div class="span2">
						<img src="<?=$_SESSION['page']['home_url']?>img/Location-64.png" />
					</div>
					<div class="span9 row-fluid">
						<div class="control-group" id="graduationLocationGroup">
							<label class="control-label span4" for="graduationLocation">Graduation Ceremony Location</label>
							<div class="controls">
								<input type="text" id="graduationLocation" name="graduationLocation" placeholder="Graduation Ceremony Location" value="<?=$FormData[8]?>">
							</div>
						</div>
					</div>
				</div><br /><!--otherDetailsContainer-->
				
				<div class="span12 row-fluid graduationStatusContainer" style="margin-top:5%;">
                	<div class="span2">
						<img src="<?=$_SESSION['page']['home_url']?>img/account-locked.png" />
					</div>
					<div class="span3">Graduation Status</div>
					<div class="span7 row-fluid">
						<div class="">
							<select class="selectgraduationStatus input-medium" id="selectgraduationStatus" name="selectgraduationStatus">
								<option value="Private">Private</option>
								<option value="Public">Public</option>
							</select>
							<span class="help-inline"><a href="javascript:void()">What do I choose?</a></span>
						</div>
						<br />
					</div>
				</div><!--babyshowerStatusContainer-->
				
				<div class="span9 row-fluid saveElement" style="margin-top:5%;">
					<input type="hidden" id="setDate" name="setDate" value="" />
					<div class="label-err-container" id="label-err-container">
						<div class="label-err">
							You have empty fields that are not optional in your form. Please check and try again!
						</div><br />
					</div>
					<?php
						if($editStage=="new"){
					?>
					<div class="span5">
						<button type="button" class="btn btn-primary btn-large" onclick="javascript:registry.verifyDate('graduationData')">
							Save Details
						</button>
					</div>
					<?php
						}else{
					?>
					<div class="span5">
						<button type="button" class="btn btn-primary btn-large" onclick="javascript:registry.verifyDate('graduationData')">Save Changes</button>
					</div>
					<?php } ?>
					<div class="span3">
						<button type="button" class="btn btn-inverse btn-large">Cancel</button>
					</div>
				</div><!--saveElement--><br />
			</form>
		</div><!--innerBodyContent-->
	</div><!--lowerContent-->

</div><br /><!--end bodycontent-->

<div class="footer-container-end">
	<div class="span1" style="width:1%">
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
			$('#selectgraduationStatus').val(arrCheck[3]);
			$('.selectYear').val(arrCheck[2]);
			$('.selectMonth').val(arrCheck[1]);
			dateManager.monthChanges(arrCheck[1]);
			$('.selectDate').val(arrCheck[0]);
		}
	}
});
</script>