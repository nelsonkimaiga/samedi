
/*invitaion js...
This js is used to process users invited, validate purchases by users


*/
var INVITATION_JSMOD = {
	validateInviteCode:function(){
		if($('#invitation_registry').val()==""){
			$('#invitation_registry').focus();
			$('.invitation-alert').show();
		}else{
			$('.invite-form').submit();
		}
		
	},
	closeAlert:function(){
		$('.invitation-alert').hide();
	}
}