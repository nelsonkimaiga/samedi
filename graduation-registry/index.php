<?php
session_start();

$_SESSION['page']['home_url'] = '../';
define('local_url', '../');
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="title" content="Kenyas first Wedding Gift Registry. Don&apos;t just get gifts, get the gifts you desire.">
        <meta name="description" content="A Kenyan Gift Registry for all your events including; Wedding, Baby Shower, Birthday Party Graduation or any other events.">
        <meta name="keywords" content="Wedding gifts registry, gift registry, baby shower gifts registry, baby shower gift registry, graduation gifts registry, kenyan gift registry, birthday party events, registry gifts, wedding registry, baby shower registry, graduation registry, birthday party gifts registry">
        <title>Samedi: Graduation Registry</title>
        <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet"-->-->

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
        ?>
        <!--End top nav-->
        <div class="body-content account-page row" style="margin-top:3%">
            <div class="large-12 columns lowerContent">
                <div class="row">
                    <div class="  large-12 columns row" style="height:450px; background:url('../img/grads.jpg'); color:#9F5000" align="center">
                        <div class="large-7 columns">
                            &nbsp;
                        </div>
                        <div class="large-5 columns" style="margin-top:70px">
                            <div class="  large-12 columns account-registry-image" style="font-size:40px;">
                                Graduation Gift Registry<br /><br />
                            </div><br /><br />
                            <div class="  large-11 columns account-registry-image" style="font-size:20px; color:#000;">
                                <div style="padding-left:10%; line-height:1.9" align="left">
                                    -- &nbsp;Create a Graduation Gift Registry <br>
                                    -- &nbsp;Create a Photo Gallery<br>
                                    -- &nbsp;Add Gifts<br>
                                    -- &nbsp;Send Invites
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br />
            </div><!--lowerContent-->
            <div align="center">
                <a href="<?= $_SESSION['page']['home_url'] ?>account/registry/">
                    <div class="" style="display:inline-block; padding:10px; background:#00458A; color:#FFF; border-radius:4px">
                        Create a New Graduation Registry
                    </div>
                </a>
            </div>
        </div>
        <?php
        echo('<br /><br /><br />'); //manual top margin
        include($_SESSION['page']['home_url'] . "templates/footer-nav.php");
        ?>
    </body>
</html>
