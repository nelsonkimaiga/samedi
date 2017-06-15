<?php
session_start();

$_SESSION['page']['home_url'] = '../../';
define('local_url', '../../');
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Items to the registry</title>
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
        <style type="text/css">
            #custom_overlay{
                display:none;
                z-index:110;
                position:fixed;
                border:solid thin #000;
                width:100%;
                height:100%;
                opacity:0.4;
                background:#000;	
            }
            #container_overlay{
                display:none;
                z-index:120;
                position:fixed;
                top:30%;
                left:38%;
                color:#fff;
                background:#00B300;
                padding:10px 100px;
                opacity:0.8;
            }
        </style>

    </head>

    <body>
        <div id="container_overlay">Item has been added!</div>
        <div id="custom_overlay"></div>
<?php
include(local_url . 'templates/top-nav.dev.php');

$formData = array();
for ($i = 0; $i < 6; $i++) {
    if ($i == 3)
        continue;
    else
        $formData[$i] = '';
}
$formData[3] = 1;
$formData[6] = '../bin/process-manual.php?process=new';
$formData[7] = 'Add Item to registry';
//section contains code for an item edit	
if (isset($_REQUEST['eid']) && isset($_REQUEST['reg'])) {
    if (trim($_REQUEST['eid']) != '' && trim($_REQUEST['reg']) != '') {
        $entryId = $_REQUEST['eid'];
        $registry = $_REQUEST['reg'];

        include('../bin/edit-item.php');
        $editItem = new _MANAGE_ITEM_EDIT($entryId, $registry, $_SESSION['account']['refUserId']);
        $userDefinedTable = $editItem->processItem();

        echo $userDefinedTable[2];
        $formData[0] = $userDefinedTable[0]; //entryid
        $formData[1] = $userDefinedTable[1]; //giftCode
        $formData[2] = $userDefinedTable[2]; //giftName
        $formData[3] = $userDefinedTable[3]; //quantity
        $formData[4] = $userDefinedTable[4]; //description
        $formData[5] = $userDefinedTable[5]; //store
        $formData[6] = '../bin/process-manual.php?process=update'; //url
        $formData[7] = 'Update Item on Registry';
    }
}
?>
        <!--End top nav-->
        <div class="body-content account-page row" style="margin-top:5%">
            <div class="large-1 columns">&nbsp;</div>
            <div class="large-2 columns leftNavbar-container">
        <?php
        include(local_url . 'account/bin/left-navbar.php');
        ?>
            </div>
            <!--<div class="large-12 columns lowerContent">
                    <div class="row">
                            <div class="large-12 columns row" style="height:140px; color:#9F5000" align="center">
                    <img src="<?= local_url ?>img/cdn-large/gift-06.jpg" />
                            </div>
                      </div><br />
            </div><!--lowerContent-->

            <div class="innnerBodyContent row large-8 columns">
                <div class="row large-12 columns" style="margin-top:20px; background:#FBFBFB; padding:10px 5px;" align="center">
                    <div class="large-12 columns in-content-h1">
                        Create a gift list <a href="" style="font-size:14px; margin-left:10%; font-weight:normal">help</a>
                    </div><br /><br /><br />
<?php
if (isset($userData) && $registries == 0) {
    ?>
                        <div style="margin-left:0; padding:2px">
                            <div align="left"  style="margin-left:2%; background:#FFEFE8; padding:10px 5px">
                                You do not have a registry to put items
                            </div><br />

                        </div><br />
                        <div class="large-1 columns0" align="left" style="margin-left:10%">
                            <a href="../../account/registry/"><button class="btn btn-primary">Create Registry</button></a>
                        </div>
                        <br /><br /><br />
    <?php
} elseif (isset($userData) && $registries > 0) {
    include("../bin/processDefault.php");
    ?>
                        <div class="large-8 columns" style="margin-left:0; border-right:solid thin #0078B3" align="left">
                            <div style="background:#0078B3; opacity:0.7; color:#FFF; padding:10px; font-size:24px">
                        <?php echo $pageHeading; ?>
                            </div><br />

    <?php
    if (isset($_SESSION['registry']['mod'])) {
        if ($_SESSION['registry']['mod'] == 404)
            echo '<div class="alert alert-error">Your request could not be completed. Please try again later</div><br />';
        elseif ($_SESSION['registry']['mod'] == 0)
            echo '<div class="alert alert-success">Item has been successfully added.</div><br />';
        else
            echo '<div class="alert alert-success">Item has been successfully updated.</div><br />';
    }

    unset($_SESSION['registry']['mod']);
    ?>

                            <form id="frmItemAdd" class="form-horizontal" style="position:relative; z-index:101" action="<?= $formData[6] ?>" method="post">
                                <input type="hidden" name="activeReg" id="activeReg" value="<?= $activeRegistry ?>" />
                                <input type="hidden" name="entryId" value="<?= $formData[0] ?>" />
                                <div class="alert alert-frm-error" style="display:none">Gift Name is required</div>
                                <div class="control-group">
                                    <label class="control-label" for="inputGiftName">Gift Name</label>
                                    <div class="controls">
                                        <input type="text" name="giftName" class="large-9 columns" id="inputGiftName" placeholder="e.g SAMSUNG '42 LED TV" value="<?= $formData[2] ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputGiftCode">Gift Code</label>
                                    <div class="controls">
                                        <input type="text" name="giftCode" class="large-9 columns" id="inputGiftCode" placeholder="e.g 23422397623934 (optional)" value="<?= $formData[1] ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputQuantity">Quantity</label>
                                    <div class="controls input-prepend input-append" style="margin-left:20px">
                                        <input type="number" name="quantity" min="1" max="10" step="1" class="large-9 columns" id="inputQuantity" value="<?= $formData[3] ?>">
                                    </div>
                                </div>
                                <!--
                                -- am yet to understand the purpose of the price?
                                -->
                                <div class="control-group">
                                    <label class="control-label" for="giftDescription">Description</label>
                                    <div class="controls">
                                        <textarea rows="6" name="description" class="large-9 columns" id="giftDescription" placeholder="Write a small description of your preferred style, e.g color"><?= $formData[4] ?></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="storeSelector">Store</label>
                                    <input type="hidden" id="storeSet" value="<?= $formData[5] ?>" />
                                    <div class="controls">
                                        <select id="storeSelector" name="store">
                                            <option value="Nakumatt - Thika Road Mall">Nakumatt - Thika Road Mall</option>
                                            <option value="Nakumatt - Garden City">Nakumatt - Garden City</option>
                                            <option value="Tuskys - Juja City Mall">Tuskys - Juja City Mall</option>
                                            <option value="Naivas - Mountain Mall">Naivas - Mountain Mall</option>
                                            <option value="Nakumatt LifeStyle">Nakumatt LifeStyle</option>
                                            <option value="Woolworth - Garden City">Woolworth - Garden City</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="large-5 columns" onclick="javascript:addItem.add()" style="background:#8080FF; padding:10px 0; cursor:pointer" align="center">
                                            <span style="color:#FFF; font-weight:bold">
    <?php echo $formData[7]; ?>
                                            </span>
                                        </div>
                                        <!--<div class="large-2 columns btn-warning" style="padding:10px 0;" align="center">
                                          <span style="color:#FFF; font-weight:bold">
                                                Cancel
                                          </span>
                                        </div> -- cancel code--> 
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="large-4 columns" style="position:relative; z-index:101">
                            <div style="background:#0078B3; opacity:0.7; color:#FFF; padding:10px">
                                View Registry Items (<?php echo $itemsCount; ?>)
                            </div>
                            <br />
                            <div style="background:#E0E0E0; opacity:0.7; color:#333; padding:10px; line-height:2.0">
                                <strong>Last Entry</strong><br />
    <?php echo $strHTML; ?>
                            </div>

                        </div>
    <?php
}else {
    ?>
                        <div class="large-8 columns" style="margin-left:0; border-right:solid thin #0078B3" align="left">
                            Done
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    echo('<br /><br /><br />'); //manual top margin
                    include($_SESSION['page']['home_url'] . "templates/footer-account-pages.php");
                    ?>
                </div>
            </div>



        </div>

        <div class="footer-container-end">
            <div class="large-1 columns" style="width:1%">
                &nbsp;
            </div>
            &copy;&nbsp;&nbsp;Samedi Registry Co.&nbsp;
<?php echo(date('Y')); ?>
        </div>
    </body>
</html>

<script>
    var addItem = {
    add:function(){
    //ensure that none of the essential items is empty
    var _AUTH = true;
    if($("#inputGiftName").val() == ''){
    _AUTH = false;
    $(".alert-frm-error").show();
    return false;
    }else{
    $("#frmItemAdd").submit();
    }

    }
    }
    $(document).ready(function(){

    if($("#storeSet").val() != ''){
    $("#storeSelector option[value='"+$("#storeSet").val()+"'").prop('selected', true);
    }
    });
</script>