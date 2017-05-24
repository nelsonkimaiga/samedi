<?php
function Redirect($page){
	header("Location:".$page);
}
session_start();

if(isset($_SESSION['account']['refName']) && isset($_SESSION['account']['refUserId'])){
	Redirect('../');
}
$_SESSION['page']['home_url'] = '../../';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Samedi: Sign Up</title>
<script type="text/javascript" src="<?=$_SESSION['page']['home_url']?>js/user.01.js"></script>
<?php
include($_SESSION['page']['home_url'].'templates/script-tags.php');
?>
</head>

<body>
<?php
include($_SESSION['page']['home_url'].'templates/top-nav.dev.php');
?>
<!--End top nav-->
<div class="body-content signup row-fluid" style="margin-top:100px">
	<div class="span2">&nbsp;</div>
	<div class="span8">
		<div class="form-heading" align="center">Create Your account &amp; Start Your Registry</div><br />
		    <form id="frmSubmitSignUp" class="form-horizontal" method="post" action="<?=$_SESSION['page']['home_url']?>account/bin/sign-up.php">
			<?php
				if(isset($_SESSION['error']['signup']) && $_SESSION['error']['signup']){
			?>
			<div>
				<div class="alert alert-error" style="font-size:14px">
					A server error has occured. This occurence has been noted and will be resolved shortly.<br />
					Apologies for the inconviniences.
				</div>
			</div>
			<?php
				}
				unset($_SESSION['error']['signup']);
			?>
			 <div class="control-group" id="label-err-container">
				<div class="controls">
				  <label class="label-err" style="padding: 10px; font-size:16px">
					Some Fields are empty. Please check and try again!
				  </label>
				 </div>
			 </div>
             <div class="control-group">
             	<div class="controls">
             		YOUR NAMES
                </div>
             </div>
             <div class="row-fluid span12">
             	<div class="span2">&nbsp;</div>
                  <div class="control-group span4" id="inputFirstNameGroup">
                    <div class="">
                      <input type="text" id="inputFirstName" name="inputFirstName" placeholder="First Name">
                    </div>
                  </div>
                  <div class="control-group span4" id="inputLastNameGroup">
                    <div class="">
                      <input type="text" id="inputLastName" name="inputLastName" placeholder="Last Name">
                    </div>
                  </div>
              </div>
              <div class="control-group">
             	<div class="controls">
             		EMAIL ADDRESS
                </div>
              </div>
              <div class="row-fluid span12">
              	  <div class="span2">&nbsp;</div>
                  <div class="control-group span4" id="inputEmailGroup">
                    <div class="">
                      <input type="text" id="inputEmail" name="inputEmail" placeholder="susanna@email.com">
                    </div>
                  </div>
              </div>
              <div class="control-group">
             	<div class="controls">
             		PASSWORD
                </div>
              </div>
              <div class="row-fluid span12">
              	  <div class="span2">&nbsp;</div>
                  <div class="control-group span4" id="inputPasswordGroup">
                    <div class="">
                      <input type="password" id="inputPassword" name="inputPassword" placeholder="Password">
                    </div>
                  </div>
                  <div class="control-group span4" id="inputConfirmPasswordGroup">
                    <div class="">
                      <input type="password" id="inputConfirmPassword" name="inputConfirmPassword" placeholder="Confirm Password">
                    </div>
                  </div>
              </div>
			  <div class="control-group">
				<div class="controls">
				  <button type="button" class="btn btn-primary btn-medium" onclick="javascript:AuthUser.verifyUserData()">Create Account</button>
				</div>
			  </div><br />
			  <div class="control-group">
				<div class="controls">
				  <label class="" style="font-style:italic">By creating an account, you agree to our <a href="javascript:void()">Terms and Conditions</a> and our <a href="javascript:void()">Client Policy</a></label>
				</div>
			  </div>
			</form>
	</div>
</div><br />
<br />
<?php
	echo('<br /><br /><br />'); //manual top margin
	include($_SESSION['page']['home_url']."templates/footer-nav.php");
?>

</body>
</html>
