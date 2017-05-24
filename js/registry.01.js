var monthIndex = -1;
var $strSetMonth = '';
var $strSetDate = '';
var $registryStatus = [true,'good'];
var dateManager = {
	monthSelected:'', daysStrOption:'',
	$days:['1','2','3','4','5','6',
			 '7','8','9','10','11','12',
			 '13','14','15','16','17','18',
			 '19','20','21','22','23','24','25',
			 '26','27','28'],
	$months:['January','February','March','April',
			   'May','June','July','August',
			   'September','October','November','December'],
	
	monthChanges:function(x){
		for(var i=0; i<this.$months.length; i++){
			if(x==this.$months[i]){
				monthIndex = i;
				$strSetMonth = this.$months[i];
				if(i==0||i==2||i==4||i==6||i==7||i==9||i==11){
					for(var j = 1; j<=((this.$days.length)+3); j++){
						this.daysStrOption+='<option value='+j+'>'+j+'</option>';
					}
					$('.selectDate')
						.empty()
						.append(this.daysStrOption)
						.removeProp("disabled")
					;	
				}else if(i==3||i==5||i==8||i==10){
					for(var j = 1; j<=((this.$days.length)+2); j++){
						this.daysStrOption+='<option value='+j+'>'+j+'</option>';
					}
					$('.selectDate')
						.empty()
						.append(this.daysStrOption)
						.removeProp("disabled")
					;
				}else{
					var yearG = $('.selectYear').val();
					isLeap = (yearG % 4==0)?28:29;
						for(var j = 1; j<=isLeap; j++){
							this.daysStrOption+='<option value='+j+'>'+j+'</option>';
						}
						$('.selectDate')
							.empty()
							.append(this.daysStrOption)
							.removeProp("disabled")
						;
				}
				this.daysStrOption='';//dumb variable
				break;
			}else{
				monthIndex = -1;
				$strSetMonth = '';
				$('.selectDate')
					.empty()
					.append('<option>Select Month</option>')
					.prop("disabled",true)
				;
			}
		}
	},//end monthChanges()
	dateComp:function(){
		if(monthIndex>=0){
			today = new Date();
			projectedDate = new Date();
			projectedDate.setFullYear($('.selectYear').val(), monthIndex, $('.selectDate').val());
			if(projectedDate>today){
				$registryStatus = [true,'Date Saved'];
				$strSetDate = $('.selectDate').val()+' - '+$strSetMonth+' - '+$('.selectYear').val();
				$("#setDate").val($strSetDate);
				console.log($registryStatus[0]);
			}else{
				$registryStatus = [false,'Set Date is already passed'];
				$('.dateError')
						.show()
						.html($registryStatus[1])
						;
				$('.label-err').html('Your set date has an Error');
				$('.label-err-container').show();
			}
		}else{
			$registryStatus = [false,'Date has not been set'];
			$('.dateError').show()
						   .html($registryStatus[1])
						;
			$('.label-err').html('Your set date has an Error');
			$('.label-err-container').show();
		}
	}
	
}//end datemanager

//stat form manager
var registry = {
	verifyDate:function(x){
		//error reset
		$('.dateError').hide();
		//
		dateManager.dateComp.call(this);
		if($registryStatus[0]){
			this.verifyData(x);
			
		}else
			console.log('invalid data');
	},
	weddingData:function(){
		$userData = [
					 '#inputBrideFName',
					 '#inputBrideMName',
					 '#inputGroomFName',
					 '#inputGroomMName',
					 '#weddingLocation'
					 ];
		$optionalUserData = [
							 '#receptionLocation',
							 '#eveningParty'
							 ];
		return $userData;
	},
	babyshowerData:function(){
		$userData = [
					 '#inputFName',
					 '#inputMName',
					 '#babyshowerLocation'
					 ];
		return $userData;
	},
	graduationData:function(){
		$userData = [
					 '#inputFName',
					 '#inputMName',
					 '#graduationLocation',
					 '#inputInstName'
					 ];
		return $userData;
	},
	verifyData:function(x){
		
		if(x=='babyshowerData'){
			$userData = this.babyshowerData();
		}else if(x=='weddingData'){
			$userData = this.weddingData();
		}else if(x=='graduationData'){
			$userData = this.graduationData();
		}
		this.resetFields($userData);
		console.log('verifying data');
		for(var i = 0; i<$userData.length; i++){
			if($($userData[i]).val().trim()==""){
				$($userData[i]+'Group').addClass('error');
				$('.label-err-container').show();
				$registryStatus=[false,'Empty Fields'];
				break;
			}
		}
		
		if(!$registryStatus[0]){
			console.log('Error');
		}else{
			$('#frmRegistry').submit();
		}
		
	},
	updateDetails:function(){
		console.log($('#pageLife').val());
	},
	resetFields:function(x){
		$('.label-err').html('You have empty fields that are not optional in your form. Please check and try again!');
		$('#label-err-container').hide();
		for(var i=0; i<x.length; i++){
			$(x[i]+'Group').removeClass('error');
		}
	}
}



var REGISTRY_CONTACTS = {
	contactStatus:true,
	verifyContact:function(){
		this.contactStatus=true;
		$(".add-contact .alert").hide().removeClass("alert-warning alert-error alert-success");
		details = ['inputName','inputNumber'];
		for(i=0; i<details.length; i++){
			if($('#'+details[i]).val()==''){
				$('#'+details[i]).focus();
				$(".add-contact .alert").addClass("alert-warning").html("Name and Mobile Number should not be empty.").show();
				this.contactStatus = false;
			}
		}
		
		if(this.contactStatus){
			phone = $('#'+details[1]).val();
			if(phone.length!=9){
				$(".add-contact .alert").addClass("alert-warning").html("Mobile Number is incorrect").show();
				this.contactStatus = false;
			}else{
				phonePattern = /[^0-9]/g;
				if(phone.match(phonePattern)!=null){
					$(".add-contact .alert").addClass("alert-warning").html("Mobile Number is incorrect").show();
					this.contactStatus = false;
				}
			}
		}
		
		if(this.contactStatus){
			$.ajax({
				   url:"bin/contacts.manage.php",
				   data:{name:$('#'+details[0]).val(),phone:$('#'+details[1]).val()},
				   method:"post",
				   error:function(XMLHTTPRequest){
					   $(".add-contact .alert").addClass("alert-error").html("An error has occurred. Please bear with us and try again later.").show();
				   },
				   success:function(x){
					   $arrX = x.split('*');
					   if($arrX[0]=='1.0'){
						   $(".add-contact .alert").addClass("alert-success").html("Mobile Number added successfully. Refresh page to view changes").show();
					   }else if($arrX[0]='1.1'){
						   $(".add-contact .alert").addClass("alert-warning").html("Mobile Number: "+$arrX[2]+" exists under "+$arrX[1]+"<br />Search number below to edit.").show();
					   }else{
						   $(".add-contact .alert").addClass("alert-error").html("An error has occurred. Please bear with us and try again later.").show();
					   }
				   }
			});
		}else{
			console.log("ahha... Hold on");
		}
	},
	
	
	//--------------------------------
	
	editContactLoad:function(x){
		$('#curEdit').val(x);
		$('.modal .number-to-edit').html($('.contact-'+x+' .contact-number').html());
		$('.modal .name-to-edit').html('<span class="modal-name-heading">Name: </span>'+$('.contact-'+x+' .contact-name').html());
		$('.modal').modal('show');
	},
	
	//___________________________
	validateEditContact:function(){
		var status = true;
		$('.modal-alert').hide().removeClass("alert-error alert-warning alert-success");
		var editDetails = ['inputName_edit','inputNumber_edit'];
		var currentDetails = ['curName','curPhone'];
		for(i=0; i<editDetails.length; i++){
			if($('#'+editDetails[i]).val()==''){
				$('.modal-alert').addClass('alert-warning').html("Name and Mobile should not be empty").show();
				$('#'+editDetails[i]).focus();
			}
		}
		
		curNum = $('#curEdit').val();
		phoneHTML = ('(+254) '+$('#'+editDetails[1]).val()).trim();
		curName = ($('#'+currentDetails[0]+'_'+curNum).val().trim()).toLowerCase();
		curPhone = $('#'+currentDetails[1]+'_'+curNum).val().trim();
		
		if(status){
				if((($('#'+editDetails[0]).val()).trim().toLowerCase()==curName) && ((phoneHTML).trim()==curPhone)){
					$('.modal-alert').addClass('alert-warning').html("No change has been made").show();
					status = false;
				}
		}
		
		if(status){
			phone = $('#'+editDetails[1]).val();
			phonePattern = /[^0-9]/g;
			if(phone.match(phonePattern)!=null || phone.length!=9){
				$('.modal-alert').addClass("alert-warning").html("Mobile Number is incorrect").show();
				status = false;
				$('#'+editDetails[1]).focus();
			}
		}
		
		if(status){
			$.ajax({
				   url:"bin/contacts.manage.php?config=update",
				   data:{name:$('#'+editDetails[0]).val(),phone:$('#'+editDetails[1]).val(),arrKey:curNum},
				   method:"post",
				   error:function(XMLHTTPRequest){
					   $(".add-contact .alert").addClass("alert-error").html("An error has occurred. Please bear with us and try again later.").show();
				   },
				   success:function(x){
					  if(x=='1.0'){
						  $(".modal-alert").addClass("alert-success").html("Changes saved. Refresh page to view.").show();
						  $(".modal-footer").html('<a class="btn btn-primary" onclick="REGISTRY_CONTACTS.closeModal()">Close</a>');
					  }else{
						  $(".modal-alert").addClass("alert-error").html("An error has occurred. Please bear with us and try again later.").show();
					  }
				   }
		   });
		}else{
			console.log('Failed');
		}
	},
	closeModal:function(){
		$('.modal').modal('hide');
	},
	deleteContact:function(x){
		curNum = x;
		var currentDetails = ['curName','curPhone'];
		curName = ($('#'+currentDetails[0]+'_'+curNum).val().trim()).toLowerCase();
		curPhone = $('#'+currentDetails[1]+'_'+curNum).val().trim();
				
		$.ajax({
			   url:"bin/contacts.manage.php?config=delete",
			   data:{name:curName,phone:curPhone,arrKey:curNum},
			   method:"post",
			   error:function(XMLHTTPRequest){
				   $(".add-contact .alert").addClass("alert-error").html("An error has occurred. Please bear with us and try again later.").show();
			   },
			   success:function(x){
					$(".add-contact .alert").addClass("alert-success").html("Contact Deleted. Refresh page to view cahnges.").show();
			   }
			   });
		
	}
	
	
}