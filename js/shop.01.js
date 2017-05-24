// JavaScript Document
var SHOP = {
	addToRegistry:function(itemCode,category_org){
		//replace div
		$('.add-to-registry').html('<img class="span3" src="http://samedi.co.ke/dev/ripple.gif" />&nbsp;&nbsp;Adding ...');
		category = category_org.toLowerCase();
		$.ajax({
			   	url:"../../shop/bin/items.registry.db.php",
				data:{itemCode:itemCode,category:category,quantity:$('#itemQuantity').val()},
				method:"post",
				error:function(XMLHTTPRequest, errorThrow){console.log('Error--ajax->error');},
				success:function(x){
					if(x=='1'||x=='1.0'){
						$('.add-to-'+category).html('<img src="http://samedi.co.ke/img/011_yes-2-24.png" /> Added To '+category_org)
												.addClass('alert alert-success');
						if(x=='1'){
							var curNum = parseInt($('.'+category+'-count').html());
							var addNum = 1;
							
							var sum = curNum + addNum;
							
							var defaultSize = 24;
							$('.'+category+'-count').html(sum);
							var fadeOut = setInterval(function(){
								defaultSize--;
								  if(defaultSize>=12){
									 $('.'+category+'-count').css({'font-size':+defaultSize+'px'});
									}else{
									   clearInterval(fadeOut);
									  }
								},40);
						}
					  }else if(x=='1.1'){
						  
						  $('.add-to-'+category).html('<img src="http://samedi.co.ke/img/011_yes-2-24.png" /> '+category_org+' item has been updated')
						  						.addClass('alert alert-success');
					  }else if(x=='1.2'){
						  $('.add-to-'+category).html('<img src="http://samedi.co.ke/img/011_yes-2-24.png" /> '+category_org+' item is already upto date')
						  						.addClass('alert alert-warning');
					  }else{
						  if(x=='2.0'){
							  $('#logginModal').modal('show');
							  $('.add-to-'+category).html('<button class="btn" style="padding:5px 35px" onclick="javascript:SHOP.addToRegistry('+itemCode+',\''+category_org+'\')">Add to '+category_org+'</button>');
							  console.log('not logged in');
						  }else{
						  	console.log(x);
						  }
					  }
						  
				}
			   });
		//send to php
			//||process feedback
		console.log('finished processings');	
	}
}