<?php
session_start();

$_SESSION['page']['home_url'] = '../../';
define('local_url','../../');

unset($_SESSION['account']['refName'],$_SESSION['account']['refEmail'],$_SESSION['account']['refUserId']);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Samedi: Sign In</title>
<?php
include($_SESSION['page']['home_url'].'templates/script-tags.php');
?>
<script type="text/javascript" src="<?=local_url?>js/user.01.js"></script>
</head>

<body>
<?php
include($_SESSION['page']['home_url'].'templates/top-nav.dev.php');
?>
<!--End top nav-->
<div class="body-content signup row-fluid" style="margin-top:100px">
	<div class="span3">&nbsp;</div>
	<div class="span7">
		<div class="form-heading span8" align="center">Log In To Your Account</div><br />
            <form class="form-horizontal form-login-submit" action="user.auth.login.php" method="post">
                <div class="control-group alert-login-container" align="center">
                <?php
                if(isset($_SESSION['err']['login'])&& $_SESSION['err']['login']!=""){
                echo($_SESSION['err']['login']);
                unset($_SESSION['err']['login']);
                }
                ?>
                </div>
            	<div class="control-group">
            		<div class="controls">
           				EMAIL ADDRESS
            		</div>
            	</div>
            	<div class="row-fluid span12">
                	<div class="span2">&nbsp;</div>
            		<div class="control-group span4">
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
                    <div class="control-group span4">
                        <div class="">
                            <input type="password" id="inputPassword" name="inputPassword" placeholder="******">
                        </div>
                    </div>
                </div>
            	<div class="control-group">
            		<div class="controls">
            			<label class="" style="font-style:italic"><a href="javascript:void()">Forgot password?</a>. Request a new one.</label>
            		</div>
            	</div>
            	<div class="control-group">
            		<div class="controls">
            			<br />
            			<button type="button" class="btn btn-primary btn-medium" onclick="AUTH_LOGIN.validateLogForm()">Sign In</button>
            		</div>
            	</div>
            	<div class="control-group">
            		<div class="controls">
            			<label class="" style="font-style:italic">Don't have an account? <a href="../signup/">Create one now.</a></label>
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
