<?php
include($_SESSION["page"]["home_url"] . 'account/bin/class.load.user.data.php');

$memberAccess = (isset($_SESSION['account']['status']) && $_SESSION['account']['status'] == 'logged_in') ? true : false;

if ($memberAccess) {
    $userData = new UserDataModule($_SESSION['account']['refUserId']);
    $userData->getDetails($_SESSION['account']['refUserId']);

    $cartCount = $userData->intCartCount;
    $registryCount = $userData->intRegistryCount;
    $registries = $userData->intRegistries;
    $activeRegistry = $userData->activeRegistry;

    $pageHeading = "";
    switch ($activeRegistry) {
        case 'wedding_registry':
            $pageHeading = "Wedding Registry";
            break;
        case 'babyshower_registry':
            $pageHeading = "Baby Shower Registry";
            break;
        case 'graduation_registry':
            $pageHeading = "Graduation Registry";
            break;
        case 'birthday_registry':
            $pageHeading = "Graduation Registry";
            break;
    }
} else {
    $cartCount = 0;
    $registryCount = 0;
    if (isset($_SESSION['shop']['Registry']) && $_SESSION['shop']['Registry'] != '') {
        $arrItems = explode('|', $_SESSION['shop']['Registry']);
        $registryCount = count($arrItems);
    }
    if (isset($_SESSION['shop']['Cart']) && $_SESSION['shop']['Cart'] != '') {
        $arrItems = explode('|', $_SESSION['shop']['Cart']);
        $cartCount = count($arrItems);
    }
}
?>
<input type="hidden" value="<?= $_SESSION["page"]["home_url"] ?>" class="local_url" />

<div class="row topnav" style="background:#FFF">
    <div class="large-4 columns" id="topnav-logo">
        <a href="<?= $_SESSION["page"]["home_url"] ?>">
            <div class="large-12 columns">
                <img src="<?= $_SESSION["page"]["home_url"] ?>img/samedi-white.jpg">
            </div>
        </a>
    </div>
    <div class="large-5 columns">&nbsp;</div>
    <div class="large-3 columns" id="topnav-help-cart">
        <div class="row">
            <div style="margin-right:10px;" class="top-nav-help-log large-3 columns">
<?php
if ($memberAccess) {
    ?>
                    <a href="<?= $_SESSION["page"]["home_url"] ?>account/signout/" style="color:#FFC120; font-size:12px; font-weight:bold">Log Out</a>&nbsp;&nbsp;&nbsp;
                    <?php
                }
                ?>
            </div>
                <?php
                if (!$memberAccess) {
                    ?>
                <div class="large-12 columns" style="color:#FFFFFF; font-size:14px" align="right">
                    <a href="<?= $_SESSION["page"]["home_url"] ?>account/login/" style="background:#FFC082; color:#FFF; weight:bold; padding:7px; border-radius:8px">Login</a>

                    <a href="<?= $_SESSION["page"]["home_url"] ?>account/signup/" style="background:#FFC082; color:#FFF; weight:bold; padding:7px; border-radius:8px">Sign Up</a>
                </div>
    <?php
} else {
    ?>
                <a href="<?= $_SESSION["page"]["home_url"] ?>account/" style="color:#FFC120" class="topNavLinkAcc">
                    <div style="color:#FFC120; overflow:hidden;" class="large-8 columns">Hello, <?php echo($_SESSION['account']['refName']) ?><br />
                        <div style="color:#FFC120; font-weight:bold; width:100%; overflow:hidden;"><?php echo($_SESSION['account']['refEmail']); ?></div>
                    </div>
                </a>
    <?php
}
?>
            <!--Add to cart is temporarily disabled
                    <div class="span6 row-fluid" id="shopping-cart">
                      <div class="span5" title="Cart">
                      <a href="<?= $_SESSION["page"]["home_url"] ?>shop/cart/" style="color:#FFFFFF">
                            <img src="<?= $_SESSION["page"]["home_url"] ?>img/shoping_cart-img.png" height="30" width="30" id="shopping-cart-img" />
                            (<span class="cart-count">
<?php
//echo($cartCount);
?>
                            </span>)
                            </a>
                      </div>
                      <div class="span5" title="Registry">
                      <a href="<?= $_SESSION["page"]["home_url"] ?>account/registry/manage/" style="color:#FFFFFF">
                            <img src="<?= $_SESSION["page"]["home_url"] ?>img/check_list-48.png" height="30" width="30" id="shopping-cart-img" />
                            (<span class="registry-count">
<?php
//echo($registryCount);
?>
                            </span>)
                            </a>
                      </div>
                            
                    </div><br />
            -->
        </div>
    </div>
</div>
<div style="width:100%; height:40px; z-index:50; position:absolute;" class="row appending-topnav visible-desktop">

    <a href="<?= $_SESSION["page"]["home_url"] ?>wedding-registry/"><div class="large-3 columns" id="registryMenuWedding" style="width:20%">
            <img src="<?= $_SESSION["page"]["home_url"] ?>img/icons/wedding-rings.png"/>
            &nbsp;&nbsp;Wedding Gift Registry
        </div></a>
    <a href="<?= $_SESSION["page"]["home_url"] ?>baby-shower-registry/"><div class="large-3 columns" id="registryMenuBaby">
            <img src="<?= $_SESSION["page"]["home_url"] ?>img/icons/baby-cart.png"/>
            &nbsp;&nbsp;Baby Shower Gift Registry</div></a>
    <a href="<?= $_SESSION["page"]["home_url"] ?>graduation-registry/"><div class="large-3 columns" id="registryMenuGraduation">
            <img src="<?= $_SESSION["page"]["home_url"] ?>img/icons/graduation.png"/>
            &nbsp;&nbsp;Graduation Gift Registry</div></a>
    <a href="javascript:void()"><div class="large-2 columns" id="registryMenuOther" style="width:10%">
            <img src="<?= $_SESSION["page"]["home_url"] ?>img/icons/gift.png"/>
            &nbsp;&nbsp;Other</div></a>

    <!--search for a registry-->
    <div class="large-2 columns" id="search_registry">
        <a href="<?= $_SESSION["page"]["home_url"] ?>search/"><div style="margin-left:-10%; margin-top:-2.8%; font-weight:bold; color:#000; padding:10px 0px; font-size:16px; background:#FFC082;" class="button-link all-products" align="center">
                Find a Registry
            </div></a><br />
    </div>

</div>
<div class="row visible-phone registry-list-container" style="padding:10px; border:solid thin #000000; width:auto">
    <div class="large-12 columns heading">
        <h4>Registry List&nbsp;&nbsp;<img src="<?= $_SESSION["page"]["home_url"] ?>img/down-32.png" /></h4>
    </div>
    <input type="hidden" value="0" class="toggleValue" />
    <div class="row large-12 columns registry-list" style="display:none">
        
        <div class="large-3 columns" style="padding:5px 3px">
            <img src="<?= $_SESSION["page"]["home_url"] ?>img/icons/wedding-rings.png" />&nbsp;&nbsp;Wedding Registry
        </div>
        
        <div class="large-3 columns" style="padding:5px 3px">
            <img src="<?= $_SESSION["page"]["home_url"] ?>img/icons/baby-cart.png" />&nbsp;&nbsp;Baby Shower Registry
        </div>
        
        <div class="large-3 columns" style="padding:5px 3px">
            <img src="<?= $_SESSION["page"]["home_url"] ?>img/icons/graduation.png" />&nbsp;&nbsp;Graduation Registry
        </div>
        
        <div class="large-3 columns" style="padding:5px 3px">
            <img src="<?= $_SESSION["page"]["home_url"] ?>img/icons/gift.png" />&nbsp;&nbsp;Other Registries
        </div>
        
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('#registryMenuShop').mouseenter(function () {
            $('.all-products>i').removeClass('icon-chevron-down');
            $('.all-products>i').addClass('icon-chevron-up');
            $('.all-products-container').slideDown();
        });
        $('#registryMenuShop').mouseleave(function () {
            $('.all-products>i').removeClass('icon-chevron-up');
            $('.all-products>i').addClass('icon-chevron-down');
            $('.all-products-container').slideUp();
        });

        $('.registry-list-container .heading').click(function () {
            if ($('.toggleValue').val() == 0) {
                $('.toggleValue').val(1);
                $('.registry-list').slideDown();
                $('.registry-list-container .heading img').attr('src', $('.local_url').val() + 'img/icons/up-32.png');
            } else {
                $('.toggleValue').val(0);
                $('.registry-list').slideUp();
                $('.registry-list-container .heading img').attr('src', $('.local_url').val() + 'img/icons/down-32.png');
            }
        });
    });

</script>