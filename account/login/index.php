<?php
session_start();

$_SESSION['page']['home_url'] = '../../';
define('local_url', '../../');

unset($_SESSION['account']['refName'], $_SESSION['account']['refEmail'], $_SESSION['account']['refUserId']);
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Samedi: Sign In</title>
        <!--foundation zurb-->
        <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.0/css/foundation.css' type="text/css">
        <!--fonts-->
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <!--font-awesome-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--foundation zurb-->
<link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.0/css/foundation.css' type="text/css">
        <!--fonts-->
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <?php
        include($_SESSION['page']['home_url'] . 'templates/script-tags.php');
        ?>
        <script type="text/javascript" src="<?= local_url ?>js/user.01.js"></script>
    </head>

    <body>
        <?php
        include($_SESSION['page']['home_url'] . 'templates/top-nav.dev.php');
        ?>
        <!--End top nav-->
        <div class="body-content signup row" style="margin-top:100px">
            <div class="large-3 columns">&nbsp;</div>
            <div class="large-7 columns">
                <div class="form-heading large-8 columns" align="center">Log In To Your Account</div>
                <br>
                <form class="form-login-submit" action="user.auth.login.php" method="post" autocomplete="off">
                    <div class="control-group alert-login-container" align="center">
                        <?php
                        if (isset($_SESSION['err']['login']) && $_SESSION['err']['login'] != "") {
                            echo($_SESSION['err']['login']);
                            unset($_SESSION['err']['login']);
                        }
                        ?>
                    </div>
                    <fieldset>
                        <label>Email Address</label>
                        <input type="email" id="inputEmail" name="inputEmail" placeholder="susanna@email.com">
                    </fieldset>
                    <fieldset>
                        <label>Password</label>
                        <input type="password" id="inputPassword" name="inputPassword" placeholder="password">
                    </fieldset>
                    <button type="button" class="button success" onclick="AUTH_LOGIN.validateLogForm()">Sign In</button>
                    <br>
                    <div class="row">
                        <div class="large-6 columns">
                            <a href="javascript:void()">Forgot password?</a>. Request a new one.
                        </div>
                        <div class="large-6 columns">
                             <label style="font-style:italic">Don't have an account? <a href="../signup/" class="button success">Create one now.</a></label>.
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <?php
        echo('<br /><br /><br />'); //manual top margin
        include($_SESSION['page']['home_url'] . "templates/footer-nav.php");
        ?>
    </body>
</html>
