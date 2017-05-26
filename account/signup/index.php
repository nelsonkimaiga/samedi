<?php

function Redirect($page) {
    header("Location:" . $page);
}

session_start();

if (isset($_SESSION['account']['refName']) && isset($_SESSION['account']['refUserId'])) {
    Redirect('../');
}
$_SESSION['page']['home_url'] = '../../';
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Samedi: Sign Up</title>
        <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.0/css/foundation.css'>
        <!--fonts-->
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <!--font-awesome-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="<?= $_SESSION['page']['home_url'] ?>js/user.01.js"></script>
        <?php
        include($_SESSION['page']['home_url'] . 'templates/script-tags.php');
        ?>
    </head>

    <body>
        <?php
        include($_SESSION['page']['home_url'] . 'templates/top-nav.dev.php');
        ?>
        <!--End top nav-->
        <div class="body-content signup row container" style="margin-top:100px; padding-left:15px; padding-right:15px; margin-left: auto; margin-right: auto;">
            <div class="large-10 columns large-centered">
                <div class="form-heading" align="center">Create Your account &amp; Start Your Registry</div><br />
                <form id="frmSubmitSignUp" class="form-horizontal" method="post" action="<?= $_SESSION['page']['home_url'] ?>account/bin/sign-up.php">
                    <?php
                    if (isset($_SESSION['error']['signup']) && $_SESSION['error']['signup']) {
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
                    <div class="small-12 medium-6 large-6 columns">
                        <fieldset>
                            <label>YOUR NAMES</label>
                            <input type="text" id="inputFirstName" name="inputFirstName" placeholder="First Name">
                        </fieldset>
                    </div>
                    <div class="small-12 medium-6 large-6 columns">
                        <fieldset>
                            <label>LAST NAME</label>
                            <input type="text" id="inputLastName" name="inputLastName" placeholder="Last Name">
                        </fieldset>
                    </div>
                    <div class="large-12 columns">
                        <fieldset>
                            <label>EMAIL</label>
                            <input type="email" id="inputEmail" name="inputEmail" placeholder="susanna@email.com">
                        </fieldset>
                    </div>
                    <div class="large-12 columns">
                        <fieldset>
                            <label>PASSWORD</label>
                            <input type="password" id="inputPassword" name="inputPassword" placeholder="Password">
                        </fieldset>
                    </div>
                    <div class="large-12 columns">
                        <fieldset>
                            <label>CONFIRM PASSWORD</label>
                            <input type="password" id="inputConfirmPassword" name="inputConfirmPassword" placeholder="Confirm Password">
                        </fieldset>
                    </div>
                    <button type="button" class="button expanded alert" onclick="javascript:AuthUser.verifyUserData()">Create Account</button>
            </div>
        </div>
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
include($_SESSION['page']['home_url'] . "templates/footer-nav.php");
?>

</body>
</html>
