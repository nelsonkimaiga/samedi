<?php
session_start();

$_SESSION['page']['home_url'] = '../';
define('local_url', '../');
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
    <head>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Samedi: Registry</title>
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
        include(local_url . 'templates/script-tags.php');
        ?>
        <script type="text/javascript" src="<?= local_url ?>/js/product.js.js"></script>
    </head>

    <body>
        <?php
        include(local_url . 'templates/top-nav.dev.php');


        if (isset($_REQUEST['find']) && $_REQUEST['find']) {
            
        }
        ?>
        <!--End top nav-->
        <div class="body-content account-page row">
            <div class="large-2 columns">&nbsp;</div>
            <div class="row innnerBodyContent large-8 columns" style="margin-top:5%;">
                <div class="" align="center" style="font-size:30px;">
                    Find a Registry
                </div>
                <form class="form-horizontal form-login-submit" action="?find=true" method="post" autocomplete="off">
                        <div class="control-group">
                            <div class="controls">
                                REGISTRANT&apos;S NAME
                            </div>
                        </div>
                        <div class="row large-12 columns">
                            <div class="large-2 columns">&nbsp;</div>
                            <div class="control-group large-6 columns">
                                <div class="">
                                    <input type="text" id="inputRegistrantName" name="inputRegistrantName" class="large-11 columns" placeholder="e.g Susanna" style="padding:20px; font-size:16px">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div align="center" class="large-8 columns">
                                OR
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                REGISTRANT&apos;S UNIQUE CODE
                            </div>
                        </div>
                        <div class="row large-12 columns">
                            <div class="large-2 columns">&nbsp;</div>
                            <div class="control-group large-6 columns">
                                <div class="">
                                    <input type="text" id="inputRegistrantCode" name="inputRegistrantCode" class="large-11 columns" placeholder="e.g 6YTTE349B" style="padding:20px; font-size:16px">
                                </div>
                            </div>
                        </div>
                        <div class="row large-12 columns">
                            <div class="large-2 columns">&nbsp;</div>
                            <div class="control-group large-6 columns">
                                <div class="">
                                    <button type="button" class="button secondary expanded">Search <i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        <?php
        echo('<br /><br /><br />'); //manual top margin
        include($_SESSION['page']['home_url'] . "templates/footer-nav.php");
        ?>
    </body>
</html>
