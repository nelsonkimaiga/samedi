// JavaScript Document
var product = {
	$vote:'',
	$itemCode:'',
	review:function(x,y){
		//display overlay
		$vote = x;
		$itemCode = y;
		if(x=='thumbs_up'){
			$('#modalImage').html('<img src="http://samedi.co.ke/img/thumbs-up-large.png" alt="thumbs up" />');
		}else{
			$('#modalImage').html('<img src="http://samedi.co.ke/img/thumbs-down-large.png" alt="thumbs down" />');
		}
		$('#reviewModal').modal('show');
	},
	
	postReview:function(){
		details = [
				   $vote,
				   $('#review').val(),
				   $itemCode
				   ];
		$.ajax({
			   url:"bin/product.reviews.php",
			   data:{vote:details[0],review:details[1],itemCode:details[2]},
			   method:"post",
			   error:function(XMLHTTPRequest){
				   $('.modal-footer').hide();
				   $('.modal-body').html('<p><div class="alert alert-important">Sorry. Your review could not be submitted at this time.</p></div><div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Close</a></div>');

			   },
			   success:function(x){
   				   $('.modal-footer').hide();
				   if(x=="OK"){
					   $('.modal-body').html('<p><div class="alert alert-success">Thank You. Your review has been submitted.</div></p><div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Close</a></div>');
				   }else{
					   $('.modal-body').html('<p><div class="alert alert-important">Sorry.Your review could not be submitted at this time.</div></p><div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Close</a></div>');
				   }
			   }
		});
	},
	
	processPriceAtCheckOut:function(quantity){
		var price = $('.price-per').html();
		price = parseInt(price.replace(/,/g,''));
		var totalPrice = price * quantity;
		var processPrice = REGISTRYMOD.processPrice.call(this,totalPrice);
		$('.total-price').html(processPrice);
	}
	
}