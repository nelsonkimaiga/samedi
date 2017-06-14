<?php

function redirectToPage($page) {
    header('Location:' . $page);
}

session_start();

if (!isset($_SESSION['account']['status']) || $_SESSION['account']['status'] != 'logged_in') {
    $_SESSION['err']['login'] = '<div class="controls"><div class="alert">Session Expired. Please log in.</div></div>';
    redirectToPage('../login/');
}

$_SESSION['page']['home_url'] = '../../';
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--foundation zurb-->
        <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.0/css/foundation.css' type="text/css">
        <!--fonts-->
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <title>Samedi: Registry</title>
        <?php
        include($_SESSION['page']['home_url'] . 'templates/script-tags.php');
        ?>
    </head>

    <body>
        <?php
        include($_SESSION['page']['home_url'] . 'templates/top-nav.dev.php');
        //start userdb dependent classes	
        ?>
        <!--End top nav-->
        <div class="body-content account-page row" style="margin-top:100px;">
            <div class="large-2 columns">&nbsp;</div>
            <div class="large-9 columns">
                <div class="inline-heading">Create A New Gift Registry</div><br />
                <br />
                <div class="row">
                    <a href="<?= $_SESSION['page']['home_url'] ?>account/wedding-registry/">
                        <div class="large-6 columns row" style="height:130px; background:#88C4FF">
                            <div class="large-5 columns"><img src="<?= $_SESSION['page']['home_url'] ?>img/wedding-rings-medium.png" style="opacity:0.6" /></div>

                            <div class="large-6 columns account-registry-select" style="color:#333">Wedding Gift Registry<br /><br />
                                <div style="color:#ffffff;">Start / Manage<i class="icon-chevron-right icon-white" style="margin-top:4px"></i></div>
                            </div>
                        </div>
                    </a>
                    <a href="<?= $_SESSION['page']['home_url'] ?>account/babyshower-registry/">
                        <div class="large-6 columns row" style="height:130px; background:#88C4FF; margin-left:10px">
                            <div class="large-5 columns"><img src="<?= $_SESSION['page']['home_url'] ?>img/baby-cart-medium.png" style="opacity:0.6" /></div>
                            <div class="large-6 columns account-registry-select" style="color:#333">Baby Shower Gift Registry<br /><br />
                                <div style="color:#ffffff;">Start / Manage<i class="icon-chevron-right icon-white" style="margin-top:4px"></i></div>
                            </div>
                        </div>
                    </a>
                    <a href="<?= $_SESSION['page']['home_url'] ?>account/graduation-registry/">
                        <div class="large-6 columns row" style="height:130px; margin-left:0; margin-top:20px; background:#88C4FF">
                            <div class="large-5 columns"><img src="<?= $_SESSION['page']['home_url'] ?>img/graduation-cap-medium.png" style="opacity:0.6" /></div>
                            <div class="large-6 columns account-registry-select" style="color:#333">Graduation Gift Registry<br /><br />
                                <div style="color:#ffffff;">Start / Manage<i class="icon-chevron-right icon-white" style="margin-top:4px"></i></div>
                            </div>
                        </div>
                    </a>
                    <a href="<?= $_SESSION['page']['home_url'] ?>account/birthday-registry/">
                        <div class="large-6 columns row" style="height:130px; margin-top:20px; background:#88C4FF; margin-left:10px">
                            <div class="large-5 columns"><img src="<?= $_SESSION['page']['home_url'] ?>img/birthday-medium.png" style="opacity:0.6" /></div>
                            <div class="large-6 columns account-registry-select" style="color:#333">Birthday Gift Registry<br /><br />
                                <div style="color:#ffffff;">Start / Manage<i class="icon-chevron-right icon-white" style="margin-top:4px"></i></div>
                            </div>
                        </div>
                </div>
                </a>
                <br><hr /><br>
                        <a href="">
                            <div class="row">
                                <div class="large-6 columns row" style="height:130px; margin-top:20px; background:#88C4FF;">
                                    <div class="large-5 columns"><img src="<?= $_SESSION['page']['home_url'] ?>img/gift-medium.png" style="opacity:0.6" /></div>
                                    <div class="large-6 columns account-registry-select" style="color:#333">Specify Other Gift Registry<br /><br />
                                        <div style="color:#ffffff;">Start / Manage<i class="icon-chevron-right icon-white" style="margin-top:4px"></i></div>
                                    </div>
                                </div>
                            </div>
                        </a>			
                        </div>

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
