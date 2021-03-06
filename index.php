<?php
session_start();

$_SESSION['page']['home_url'] = '';
?>

<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="SAM">
        <meta name="title" content="Kenyas first Gift Registry platform. No just get gifts, get the gifts you desire.">
        <meta name="description" content="A Kenyan Gift registry platform for your Wedding, Baby Shower, Birthday Party or Graduation events.">
        <meta name="keywords" content="Wedding gifts, gift registry, baby shower gifts, baby shower, graduation gifts, kenyan gift registry, birthday party events, registry gifts, wedding registry, baby shower registry, graduation registry">
        <meta name="url" content="http://www.samedi.co.ke">
        <title>Samedi Registry | Wedding Registry | Baby Shower Registry | Graduation Registry</title>
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
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-85416087-1', 'auto');
            ga('send', 'pageview');

        </script>
    </head>
    <body>
        <div class="container">
            <?php
            include($_SESSION['page']['home_url'] . 'templates/top-nav.dev.php');
            ?>
        </div>
        <div id="slider" class="container" style="z-index:0; position:relative">
            <img src="<?= $_SESSION['page']['home_url'] ?>img/wedding-gift-banner.jpg" alt="" />
            <img src="<?= $_SESSION['page']['home_url'] ?>img/girl-at-shopping-online.png" alt="Create a gifts list of what you would like to receive" />
        </div>

        <!--body content-->
        <div class="row inline-links container" style="margin-top:20px">
            <div class="row extra-links-images" style="cursor:default; background:#F5F5F5">
                <div class="large-2 columns" style="width:7.5%">&nbsp;</div>
                <div class="large-2 columns">
                    <img src="img/icons/seo-60-64.png"/><br />
                    Website Pages
                </div>
                <div class="large-2 columns">
                    <img src="img/icons/user_group-64.png"  /><br />
                    Guest Management
                </div>
                <div class="large-2 columns">
                    <img src="img/icons/8-64.png"  /><br />
                    Gifts List
                </div>
                <div class="large-2 columns">
                    <img src="img/icons/wedding_42-64.png"  /><br />
                    Registry Services
                </div>
            </div>

        </div><!--inline-links-->

        <div class="row exline-links" id="exline-links" style="margin-top:50px;">
            <div class="large-12 columns in-content-h1" style="text-align:center">
                <h4>Create a registry of your choice. The only Gift Registry Provider in Kenya</h4>
            </div>
            <br>
            <div class="large-4 columns" id="banner-one">
                <div class="row">
                    <div class="large-12 columns"><img src="img/wedding-registry.jpg"></div>
                    <div class="large-12 columns"  id="banner_one-heading">Create your Wedding Registry</div><br />
                    <div class="large-12 columns" id="banner-wedding-phone-description" style="font-size:16px; line-height:1.4">
                        <hr>
                        <p style="text-align: justify;">Its your big day! Make it that special. Create your registry today, customize it to what you prefer, select your gift list, add a gallery and invite family and friends and let them know how excited you are!.</p>
                    </div>
                </div>
                <a href="wedding-registry/"><div class="button-link" id="banner_one-button-link">Learn more&nbsp;<i class="icon-chevron-right" style="margin-top:2px"></i></div></a>
            </div>
            <div class="large-4 columns" id="banner-two">
                <div class="row">
                    <div class="large-12 columns"><img src="img/shower.jpg"></div>
                    <div class="large-12 columns" id="banner_two-heading">Create your Baby Shower Registry</div><br />
                    <div class="large-12 columns" id="banner-baby-phone-description" style="font-size:16px; line-height:1.4">
                        <hr>
                        <p style="text-align: justify;">Congratulations! After looking forward to it, your family is now bigger. Let's help you celebrate. Create a baby shower registry and select your themes, add a gift list, make it memorable.</p>
                    </div>
                </div>
                <a href="baby-shower-registry/"><div class="button-link" id="banner_two-button-link">Learn more&nbsp;<i class="icon-chevron-right" style="margin-top:2px"></i></div></a>
            </div>
            <div class="large-4 columns" id="banner-two">
                <div class="row">
                    <div class="large-12 columns"><img src="img/graduation_registry.jpg"/></div>
                    <div class="large-12 columns" id="banner_two-heading">Create your Graduation Registry</div><br />
                    <div class="large-12 columns" id="banner-baby-phone-description" style="font-size:16px; line-height:1.4"><br>
                        <hr>
                        <p style="text-align: justify;">Congratulations for studying hard and excelling. Create a registry to help invite your family and friends. Create and post to your gallery to show your excitement and select and create a gift list. You deserve it!</p>
                    </div>
                </div>
                <a href="graduation-registry/"><div class="button-link" id="banner_two-button-link">Learn more&nbsp;<i class="icon-chevron-right" style="margin-top:2px"></i></div></a>
            </div>

        </div>

    </div><!--exline-links-->

    <div class="row down-links visible-desktop" style="margin-top:">

        <div class="large-10 columns in-content-h1" style="text-align:center">
            <h3>Control the look, Customize and Share the information</h3>
        </div>
        <br>
        <div class="large-1 columns" style="margin-left:0">&nbsp;</div>

        <div class="large-4 columns" id="banner-one">
            <div class="large-5 columns heading">Create</div>
            <div class="large-12 columns banner-image">
                <p style="text-align: justify;">Create your preferred registry and include all the information you want according to how you want it to be. Be it your Wedding, Baby shower or Graduation. Lets help you see what you are looking forward to.</p>
            </div>
        </div>


        <div class="large-4 columns" style="" id="banner-two">
            <div class="large-5 columns heading">Customize</div>
            <div class="large-7 columns banner-image">
                <p style="text-align: justify;">Choose your favorite theme from a list of more than 30 and customize to your liking. Create a photo gallery and upload unlimited photos. Let us give you control for the big day.</p>
            </div>
        </div>


        <div class="large-4 columns" id="banner-three">
            <div class="large-5 columns heading">Share</div>
            <div class="large-7 columns banner-image">
                <p style="text-align: justify;">Invite your family, friends and colleagues from your web-page. Update them on what you are up to as you prepare to give them the show of their lives. You control the information, we don't.</p>
            </div>
        </div>

    </div>

    <?php
    echo('<br /><br /><br />'); //manual top margin
    include($_SESSION['page']['home_url'] . "templates/footer-nav.php");
    ?>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="dev/Foundation/js/smooth-scroll.js"></script>
    <script src="dev/Foundation/js/vendor/jquery.js"></script>
    <script src="dev/Foundation/js/vendor/what-input.js"></script>
    <script src="dev/Foundation/js/vendor/foundation.min.js"></script>
    <script src="dev/Foundation/js/app.js"></script>
    <script>
            smoothScroll.init();
    </script>

</body>
</html>
