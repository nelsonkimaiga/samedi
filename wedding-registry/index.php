<?php
session_start();

$_SESSION['page']['home_url'] = '../';
define('local_url','../');

?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="title" content="Kenyas first Wedding Gift Registry. Don&apos;t just get gifts, get the gifts you desire.">
<meta name="description" content="A Kenyan Gift Registry for all your events including; Wedding, Baby Shower, Birthday Party Graduation or any other events.">
<meta name="keywords" content="Wedding gifts registry, gift registry, baby shower gifts registry, baby shower gift registry, graduation gifts registry, kenyan gift registry, birthday party events, registry gifts, wedding registry, baby shower registry, graduation registry, birthday party gifts registry">
<meta name="url" content="http://www.samedi.co.ke/wedding-registry/">
<title>Samedi: Registry</title>
<?php
include(local_url.'templates/script-tags.php');
?>
<script type="text/javascript" src="<?=local_url?>/js/product.js.js"></script>
</head>

<body>
<?php
	include(local_url.'templates/top-nav.dev.php');
?>
<!--End top nav-->
<div class="body-content account-page row-fluid" style="margin-top:3%">
	<div class="large-12 columns lowerContent">
		<div class="row-fluid">
			<div class="large-12 columns row-fluid" style="height:450px; background:url('../img/wedding-2.jpg'); color:#9F5000" align="center">
                <div class="large-7 columns">
                	&nbsp;
                </div>
                <div class="large-5 columns" style="margin-top:70px">
                    <div class="large-12 columns account-registry-image" style="font-size:40px;">
                        Wedding Gift Registry<br /><br />
                    </div><br /><br />
                    <div class="large-11 columns account-registry-image" style="font-size:20px; color:#000;">
                        <div style="padding-left:10%" align="left">
                        	<img src="<?=$_SESSION['page']['home_url']?>/img/rings.png" />&nbsp;Create a Wedding Gift Registry <br>
							<img src="<?=$_SESSION['page']['home_url']?>/img/rings.png"/>&nbsp;Create a Photo Gallery<br>
                            <img src="<?=$_SESSION['page']['home_url']?>/img/rings.png"/>&nbsp;Add Gifts<br>
                            <img src="<?=$_SESSION['page']['home_url']?>/img/rings.png"/>&nbsp;Send Invites
                        </div>
                    </div>
                </div>
			</div>
		</div><br />
	</div><!--lowerContent-->
<div align="center">
	<a href="<?=$_SESSION['page']['home_url']?>account/registry/">
    	<div class="" style="display:inline-block; padding:10px; background:#00458A; color:#FFF; border-radius:4px">
        	Create a New Wedding Registry
        </div>
    </a>
</div>
</div>
<?php
	echo('<br /><br /><br />'); //manual top margin
	include($_SESSION['page']['home_url']."templates/footer-nav.php");
?>

</body>
</html>
    