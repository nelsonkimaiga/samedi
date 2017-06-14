<?php

function redirectToPage($page) {
    header('Location:' . $page);
}

session_start();

if (!isset($_SESSION['account']['status']) || $_SESSION['account']['status'] != 'logged_in') {
    $_SESSION['err']['login'] = '<div class="controls"><div class="alert">Session Expired. Please log in.</div></div>';
    redirectToPage('login/');
}



if (isset($_REQUEST['acc'])) {
    if ($_REQUEST['acc'] == '001') {
        $_SESSION['account']['age'] = 'new';
    } else {
        $_SESSION['account']['age'] = '';
    }
} else {
    $_SESSION['account']['age'] = '';
}


$_SESSION['page']['home_url'] = '../';
$local_url = '../';
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Samedi: Account Dashboard</title>
        <?php
        include($local_url . 'templates/script-tags.php');
        ?>
        <!--foundation zurb-->
        <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.0/css/foundation.css' type="text/css">
            <!--fonts-->
            <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
                <!--font-awesome-->
                <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
                    </head>

                    <body>
                        <?php
                        include('../templates/top-nav.dev.php');
                        include($_SESSION['page']['home_url'] . 'account/bin/class.manage.registry.php');
                        $registry = new ManageRegistryModule();
                        $registry->getRegistryList($_SESSION['account']['refUserId']);
                        ?>
                        <!--End top nav-->
                        <div class="body-content account-page row" style="margin-top:100px;">
                            <div class="large-3 columns">&nbsp;</div>
                            <div class="large-9 columns">
                                <div class="inline-heading">Welcome To Your Samedi
<?php echo($_SESSION['account']['age']); ?>
                                    Account, <?php echo($_SESSION['account']['refName']) ?>!</div><br />
                                <div>Need help, let&rsquo;s give you a <a href="javascript:void()">quick and informative tour</a>.</div><br />
                                <div class="body-inline">
                                    <a href="<?= $_SESSION['page']['home_url'] ?>account/registry/"><div class="" style="display:inline-block; padding:10px; background:#00458A; color:#FFF; border-radius:4px">
                                            Create a New Registry
                                        </div></a>

                                    <div class="inline-heading" style="margin-top:50px">Manage Existing Registries</div><br />
                                    <div class="no-information-div large-9 columns" style="margin-left:0">
                                        <?php
                                        echo($registry->strRegistryHTML);
                                        ?>
                                    </div><br>&nbsp;
                                </div>
                                <div style="margin-top:8%">
                                    For any queries or assistance, <a href="<?= $_SESSION['page']['home_url'] ?>/contact-us/">Contact Us</a>
                                </div>
                            </div><br />
                        </div><br /><!--end bodycontent-->
                    </body>
                    </html>
