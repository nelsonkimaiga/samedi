<?php
session_start();

$_SESSION['page']['home_url'] = '../../';
define('local_url','../../');


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Items to the registry</title>
<?php
include(local_url.'templates/script-tags.php');
?>
<script type="text/javascript" src="<?=local_url?>/js/product.js.js"></script>
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
	include(local_url.'templates/top-nav.dev.php');
	
	$formData = array();
	for($i=0; $i<6; $i++){
		if($i==3)
			continue;
		else
			$formData[$i] = '';	
	}
	$formData[3] = 1;
	$formData[6] = '../bin/process-manual.php?process=new';
	$formData[7] = 'Add Item to registry';
//section contains code for an item edit	
	if(isset($_REQUEST['eid']) && isset($_REQUEST['reg'])){
		if(trim($_REQUEST['eid']) != '' && trim($_REQUEST['reg']) != ''){
			$entryId = $_REQUEST['eid'];
			$registry = $_REQUEST['reg'];
			
			include('../bin/edit-item.php');
			$editItem = new _MANAGE_ITEM_EDIT($entryId, $registry,$_SESSION['account']['refUserId']);
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
<div class="body-content account-page row-fluid" style="margin-top:5%">
	<div class="span1">&nbsp;</div>
	<div class="span2 leftNavbar-container">
		<?php
			include(local_url.'account/bin/left-navbar.php');
		?>
	</div>
	<!--<div class="span12 lowerContent">
		<div class="row-fluid">
			<div class="span12 row-fluid" style="height:140px; color:#9F5000" align="center">
            	<img src="<?=local_url?>img/cdn-large/gift-06.jpg" />
			</div>
		  </div><br />
	</div><!--lowerContent-->
	
	<div class="innnerBodyContent row-fluid span8">
		<div class="row-fluid span12" style="margin-top:20px; background:#FBFBFB; padding:10px 5px;" align="center">
        	<div class="span12 in-content-h1">
	        	Create a gift list <a href="" style="font-size:14px; margin-left:10%; font-weight:normal">help</a>
			</div><br /><br /><br />
            <?php
				if(isset($userData) && $registries==0){
					?>
                    	<div style="margin-left:0; padding:2px">
                        	<div align="left"  style="margin-left:2%; background:#FFEFE8; padding:10px 5px">
                            	You do not have a registry to put items
                            </div><br />
         
                        </div><br />
                        <div class="span10" align="left" style="margin-left:10%">
                        	<a href="../../account/registry/"><button class="btn btn-primary">Create Registry</button></a>
                        </div>
                        <br /><br /><br />
                    <?php
				}elseif(isset($userData) && $registries>0){
					include("../bin/processDefault.php");
			?>
            <div class="span8" style="margin-left:0; border-right:solid thin #0078B3" align="left">
            	<div style="background:#0078B3; opacity:0.7; color:#FFF; padding:10px; font-size:24px">
                	<?php echo $pageHeading; ?>
                </div><br />
                
                <?php
                	if(isset($_SESSION['registry']['mod'])){
						if($_SESSION['registry']['mod'] == 404)
							echo '<div class="alert alert-error">Your request could not be completed. Please try again later</div><br />';
						elseif($_SESSION['registry']['mod'] == 0)
							echo '<div class="alert alert-success">Item has been successfully added.</div><br />';
						else
							echo '<div class="alert alert-success">Item has been successfully updated.</div><br />';
						
					}
					
					unset($_SESSION['registry']['mod']);
					
				?>
                
                <form id="frmItemAdd" class="form-horizontal" style="position:relative; z-index:101" action="<?=$formData[6]?>" method="post">
                	<input type="hidden" name="activeReg" id="activeReg" value="<?=$activeRegistry?>" />
                    <input type="hidden" name="entryId" value="<?=$formData[0]?>" />
                  <div class="alert alert-frm-error" style="display:none">Gift Name is required</div>
                  <div class="control-group">
                    <label class="control-label" for="inputGiftName">Gift Name</label>
                    <div class="controls">
                      <input type="text" name="giftName" class="span9" id="inputGiftName" placeholder="e.g SAMSUNG '42 LED TV" value="<?=$formData[2]?>">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="inputGiftCode">Gift Code</label>
                    <div class="controls">
                      <input type="text" name="giftCode" class="span9" id="inputGiftCode" placeholder="e.g 23422397623934 (optional)" value="<?=$formData[1]?>">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="inputQuantity">Quantity</label>
                    <div class="controls input-prepend input-append" style="margin-left:20px">
                    	<input type="number" name="quantity" min="1" max="10" step="1" class="span9" id="inputQuantity" value="<?=$formData[3]?>">
                    </div>
                  </div>
                  <!--
                  -- am yet to understand the purpose of the price?
                  -->
                  <div class="control-group">
                    <label class="control-label" for="giftDescription">Description</label>
                    <div class="controls">
                      <textarea rows="6" name="description" class="span9" id="giftDescription" placeholder="Write a small description of your preferred style, e.g color"><?=$formData[4]?></textarea>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="storeSelector">Store</label>
                    <input type="hidden" id="storeSet" value="<?=$formData[5]?>" />
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
                  		<div class="span5" onclick="javascript:addItem.add()" style="background:#8080FF; padding:10px 0; cursor:pointer" align="center">
                          <span style="color:#FFF; font-weight:bold">
                           	<?php echo $formData[7];?>
                          </span>
                        </div>
                        <!--<div class="span2 btn-warning" style="padding:10px 0;" align="center">
                          <span style="color:#FFF; font-weight:bold">
                           	Cancel
                          </span>
                        </div> -- cancel code--> 
                    </div>
                  </div>
                </form>
            </div>
            <div class="span4" style="position:relative; z-index:101">
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
				}else{
					?>
                    	<div class="span8" style="margin-left:0; border-right:solid thin #0078B3" align="left">
                        	Done
                        </div>
                    <?php	
				}
			?>
            <?php
	            echo('<br /><br /><br />'); //manual top margin
				include($_SESSION['page']['home_url']."templates/footer-account-pages.php");
			?>
        </div>
    </div>
    
    
    
</div>

<div class="footer-container-end">
		<div class="span1" style="width:1%">
			&nbsp;
		</div>
		&copy;&nbsp;&nbsp;Samedi Registry Co.&nbsp;
		<?php echo(date('Y')); ?>
	</div>
</body>
</html>

<script type="application/javascript">
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