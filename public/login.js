$(document).ready(function(){

	$('.hideShow').on('click',function() {
		hideShow()
	})
})


function hideShow(){
    $('#loginView').toggle();
    $('#regForm').toggle();
    var currentForm = $('#regForm').is(':visible') ? 'Registration' : 'Login';
	$('.card-title h2').text(currentForm);
}

function registerUser(){

	var formData = $('#regForm').serializeArray();
	var formObj = {};
	var errors = new Array;
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var passwordValidation = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/;

	$.each(formData,function(i,row) {
		
		formObj[row.name] = row.value;
	})
	
	if(formObj.username==""){
		errors.push("User name cannot be empty");
	}
	if(formObj.email==""){
		errors.push("email cannot be empty");
	}else{

		var email = formObj.email;
		if(mailformat.test(email)==false){
			errors.push("Please enter a valid email");
		}
	}
	if(formObj.password==""){
		errors.push("password cannot be empty.");
	}else{
		var password = formObj.password;
		if(passwordValidation.test(password)==false){
			errors.push("Please include at least one uppercase letter, one lowercase letter, one number, and special characters.");
		}
	}

	if(errors!=""){
		bootbox.alert({
			message:errors.join('<br>'),
			closeButton:false
		});
	}else{

		$.ajax({
			url:baseUrl+'/registerUser',
			type: 'POST',
			data : JSON.stringify(formObj),
			success:function (response) {

				response = JSON.parse(response);

				if(response.success){

					bootbox.alert({
						message:'Registration successfull! Please login',
						closeButton:false,
						callback:function() {
							hideShow();
						}
					})

				}else{
					bootbox.alert({
						message:response.message,
						closeButton:false,
					})
				}
			}
		})
	}

}
function updateDetails() {
	var formData = $('#editForm').serializeArray();
	var formObj = {};
	var errors = new Array;
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	$.each(formData,function(i,row) {
		
		formObj[row.name] = row.value;
	})
	
	if(formObj.username==""){
		errors.push("User name cannot be empty");
	}
	if(formObj.name==""){
		errors.push("name cannot be empty");
	}
	if(formObj.age==""){
		errors.push("age cannot be empty");
	}
	if(formObj.gender==0){
		errors.push("please select gender");
	}else{

		if(formObj.gender==3){
			if(formObj.others==""){
				errors.push("please enter others");
			}
		}

	}
	if(formObj.address==""){
		errors.push("address cannot be empty");
	}
	if(formObj.email==""){
		errors.push("email cannot be empty");
	}else{
		var email = formObj.email;
		if(mailformat.test(email)==false){
			errors.push("Please enter a valid email");
		}
	}
	if(formObj.password==""){
		errors.push("password cannot be empty");
	}

	if(errors!=""){
		bootbox.alert({
			message:errors.join('<br>'),
			closeButton:false
		});
	}else{
		$.ajax({
			url:baseUrl+'/editUserData',
			type: 'POST',
			data : JSON.stringify(formObj),
			success:function (response) {

				response = JSON.parse(response);

				if(response.success){

					bootbox.alert({
						message:response.message,
						closeButton:false,
						callback:function() {
							location.reload();
						}
					})

				}else{
					bootbox.alert({
						message:response.message,
						closeButton:false,
					})
				}
			}
		});
	}
}

function strengthValidation(){
	var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/;
	$('.validationErros').html("");
	var password = "";
	if(pageType=="login"){
		password = $('#password').val();
	}else{
		password = $('#newPassword').val();
	}

	if(regex.test(password)==false){
		
		var html = "Please include at least one uppercase letter, one lowercase letter, one number, and special characters.";
		$('.validationErros').html(html);
	}

}
function emailValidation(){
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var email = $('#email').val();
	$('.validationEmails').html("");
	if(mailformat.test(email)==false){
		
		var html = "Please enter a valid email.";
		$('.validationEmails').html(html);
	}
}
function matchConfirmPassword(){

	var newPassword = $('#newPassword').val();
	var confirmPassword = $('#confirmPassowrd').val();
	$('.matchErros').html("");
	if(newPassword!=confirmPassword){
		console.log('hello')
		var html = "Confirm password should match with new passowrd";
		$('.matchErros').html(html);
	}

}

function changePassword(){

	var oldPassowrd = $('#oldPassowrd').val();
	var id = $('#id').val();
	var newPassword = $('#newPassword').val();
	var confirmPassword = $('#confirmPassowrd').val();
	var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/;
	var errors =new Array;
	var data = {};
	if(oldPassowrd==""){
		errors.push("please enter old passowrd.");

	}
	if(newPassword==""){
		errors.push("please enter new passowrd.");

	}
	if(confirmPassword==""){
		errors.push("please enter confirm passowrd.");

	}
	if(newPassword!=confirmPassword){
		errors.push("New password and confirm passowrd doesnot match.");
	}
	if(regex.test(newPassword)==false){
		
		errors.push("Please include at least one uppercase letter, one lowercase letter, one number, and special characters.");
	}

	if(errors!=""){
		bootbox.alert({

			message:errors.join('<br>'),
			closeButton:false,
		})
	}else{
		data.oldPassowrd=oldPassowrd;
		data.newPassword=newPassword;
		data.confirmPassword=confirmPassword;
		data.id=id;
		$.ajax({
			url:baseUrl+'/changePassword',
			type: 'POST',
			data : JSON.stringify(data),
			success:function (response) {

				response = JSON.parse(response);

				if(response.success){

					bootbox.alert({
						message:'password updated successfully',
						closeButton:false,
						callback:function() {
							location.reload();
						}
					})

				}else{
					bootbox.alert({
						message:response.message,
						closeButton:false,
					})
				}
			}
		})
	}
}