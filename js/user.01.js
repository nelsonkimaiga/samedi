$userStatus = true;
$userData = [
			 '#inputFirstName',
			 '#inputLastName',
			 '#inputEmail',
			 '#inputPassword',
			 '#inputConfirmPassword'
			 ];
var AuthUser = {
	verifyUserData:function(){
			$userStatus = true;
			this.resetFields();
			console.log('Entered verification');
			for(var i=0; i<$userData.length; i++){
				if($($userData[i]).val()==""){
					$('#label-err-container').show();
					$($userData[i]+'Group').addClass('error');
					$userStatus = false;
					//console.log('Verifying fields- failed');
					$('.label-err').html('Some Fields are empty. Please check and try again!');
				}
				//console.log('Verifying fields- success');
			}
			if($userStatus){
				//console.log('Verifying pass stats');
				if($($userData[3]).val()!=$($userData[4]).val()){
					$('#label-err-container').show();
					$('.label-err').html('Passwords do not match. Please try again!');
					$($userData[3]+'Group').addClass('error');
					$($userData[4]+'Group').addClass('error');
					
					$userStatus = false;
				}
				
			}
			if($userStatus){
				//console.log('verifying email data');
				$.ajax({
					   url:"user.auth.php",
					   data:{emailAdd:$($userData[2]).val()},
					   method:"post",
					   error:function(XMLHTTPRequest, errorThrow){console.log('error')},
					   success:function(x){
						   if(x=='1'){
							   $('#frmSubmitSignUp').submit();
						   }else if(x=='2'){
								$('#label-err-container').show();
								$('.label-err').html('Another account exists with this email address!&nbsp;&nbsp;&nbsp;<a href="http://samedi.co.ke/account/login/">Log In if it\'s yours</a>.');
								$($userData[2]+'Group').addClass('error');
							}else{
								$('#label-err-container').show();
								$('.label-err').html('Fatal server error has occured. Please bear with us as we resolve this issue!');
							}
					   }
					});
			}

	},
	
	resetFields:function(){
		$('#label-err-container').css({'display':'none'});
		for(var i=0; i<$userData.length; i++){
			$($userData[i]+'Group').removeClass('error');
		}
	}
}




var AUTH_LOGIN = {
	validateLogForm:function(){
		var loginStatus = true;
		var details=['#inputEmail','#inputPassword'];
		$('.alert-login-container').html('');
		
		for(i=0; i<details.length; i++){
			if($(details[i]).val()==""){
				$(details[i]).focus();
				$('.alert-login-container').html('<div class="controls"><div class="alert">Username and password should not be empty.</div></div>');
				loginStatus = false;
				break;
			}
		}
		
		if(loginStatus){
			$('.form-login-submit').submit();
		}
	}
}