<?php
session_start();

$_SESSION['page']['home_url'] = '../';
define('local_url', '../');
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
    <head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Samedi: Registry</title>
        <!--foundation zurb-->
        <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.0/css/foundation.css' type="text/css">
        <!--fonts-->
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <!--font-awesome-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
            <div class="large 2">&nbsp;</div>
            <div class="innnerBodyContent large 8 row" style="margin-top:5%;">
                <div class="" align="center" style="font-size:30px;">
                    Find a Registry
                </div><br>
                <form class="form-horizontal form-login-submit" action="?find=true" method="post" autocomplete="off">
                        <div class="control-group">
                            <div class="controls">
                                REGISTRANT&apos;S NAME
                            </div>
                        </div>
                        <div class="row 12">
                            <div class="large 2">&nbsp;</div>
                            <div class="control-group large 6">
                                <div class="">
                                    <input type="text" id="inputRegistrantName" name="inputRegistrantName" class="large 11" placeholder="e.g Susanna" style="padding:20px; font-size:16px">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div align="center" class="large 8">
                                OR
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                REGISTRANT&apos;S UNIQUE CODE
                            </div>
                        </div>
                        <div class="row-fluid large 12">
                            <div class="large 2">&nbsp;</div>
                            <div class="control-group large 6">
                                <div class="">
                                    <input type="text" id="inputRegistrantCode" name="inputRegistrantCode" class="large 11" placeholder="e.g 6YTTE349B" style="padding:20px; font-size:16px">
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid large 12">
                            <div class="large 2">&nbsp;</div>
                            <div class="control-group large 6">
                                <div class="">
                                    <button type="button" class="button secondary expanded">Search</button>
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
