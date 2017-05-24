/*invitaion js...
This js is used to process the clients registry. Page.. registry/manage/

*/

//this module contains heavily obsolete code. ** usidelete anyway
var REGISTRYMOD = {
	
	modifyQuantity:function(itemCode,castPrice){
		var quantity = parseInt($('.item-set-quantity-'+itemCode).val());
		var price = parseInt(castPrice);
		var sum = quantity * price;
		$('.item-sum-'+itemCode).html(this.processPrice(sum));
	},
	
	processPrice:function(x){
		$strPrice = '';
		strX = x.toString();
		strlen = strX.length;
		if(strlen==4){ //0,000
			$strPrice_pre = strX.substr(0,1);
			$strPrice_post = strX.substr(1);
			$strPrice = $strPrice_pre+','+$strPrice_post;
		}else if(strlen==5){ //00,000
			$strPrice_pre = strX.substr(0,2);
			$strPrice_post = strX.substr(2);
			$strPrice = $strPrice_pre+','+$strPrice_post;
		}else if(strlen==6){ //000,000
			$strPrice_pre = strX.substr(0,3);
			$strPrice_post = strX.substr(3);
			$strPrice = $strPrice_pre+','+$strPrice_post;
		}

		return $strPrice;
	},
	
	itemMessages:function(itemCode,action){
		if(action=='load_contacts'){
			$('.item-contacts-'+itemCode).html('<div style="font-size:12px">fetching contacts...please wait</div><img src="../../../dev/ripple.gif" class="span4" />');
			$.ajax({
				   url:"bin/manage.changes.registry.php",
				   data:{action:'fetch_contacts',itemCode:itemCode,registry:'wedding_registry'},
				   method:"get",
				   error:function(){console.log('Error')},
				   success:function(x){
					   if(x!="reload"){
						   $('.item-contacts-'+itemCode).html(x);
					   }else{
						   console.log('Reload');
					   }
				   }
			});
			
		}else{
			$('.item-contacts-'+itemCode).html('Default Messages');
			$('.item-alert-'+itemCode).hide();
		}
		
	},
	
	//this code is obsolete
	saveItemChanges:function(itemCode){
		$('.item-alert-'+itemCode).hide();
		quantity = $('.item-set-quantity-'+itemCode).val();
		messages = $(':radio[name="radio-contact-'+itemCode+'"]:checked').val()=="Default"?"default":"specific";
		arrContacts = [];
		contactSelected = false;
		$continue = true;
		if(messages=="specific"){
			$('.item-contacts-'+itemCode).find(':checkbox[name="checkcontact[]"]').each(function(){
										if($(this).prop('checked')){
											arrContacts[arrContacts.length] = $(this).val();
											contactSelected = true;
										}
									});
		}
		
		if(messages == 'specific' && arrContacts.length==0){
			$continue = false;
			$('.item-alert-'+itemCode).show();
		}
		
		if(messages=='default'){arrContacts = ['default'];}
		
		if($continue){
			$.ajax({
			   url:"bin/manage.changes.registry.php?action=updateItemEntry",
			   data:{messages:messages,arrContacts:arrContacts,itemCode:itemCode,registry:'wedding_registry',quantity:quantity},
			   method:"post",
			   error:function(){
					console.log("Error executing request");
			   },
			   success:function(x){
				   console.log(x);
			   }
			   });
		}else{
			console.log("Do not bother--"+messages);
		}
		
		
	}
}

var MANAGE_REGISTRY = {
	deleteItem:function(itemId,activeRegistry){
		$.ajax({
			url:"../bin/deleteRegistry.php",
			data:{itemId:itemId,activeRegistry:activeRegistry},
			method:"post",
			error: function(){
				console.log('error');
			},
			success: function(x){
				s = x=0?console.log('success'):console.log(x);
				$(".item-specific-"+itemId).hide();
			}
		});
	},
	editItem:function(itemId,activeRegistry){
		if(itemId != 'undefined' && activeRegistry != 'undefined'){
			window.location.href = '../add-manual/?eid='+itemId+'&reg='+activeRegistry;
		}
	}
	
}