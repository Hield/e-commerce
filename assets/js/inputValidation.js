
function showError(el, msg0) {
	el.text(msg0);
	el.css("font-weight", "bold");
	el.css("font-size", "12px");
	el.css("color", "red");
	el.show("slow");
}

/*-- Functions In Use--*/

function clearErrorMsg(el) {
	if(el.text() != "") {
		el.text("");
		el.removeAttr("style");
	}
}

function userCheck(username0, pwd0){
	return $.ajax({
				type: "POST",
				cache: false,
				async: true,
				url: "ajax/user_request.php",
				data: {username: username0, pwd: pwd0},
				dataType : "text"
			});
}

function pwdCheck(pwd0, err_el0) {
	var pwdStatus = false;
	var MAXLENGTH = 7;
	var hasNum = false;
	var hasUpperCase = false;
	var hasLowerCase = false;

	clearErrorMsg(err_el0);

		if(pwd0.length < MAXLENGTH && pwd0.length > 0){
			showError(err_el0, "(Password does not contain 7 characters)");
		}
		else {
			for(var i = 0; i < pwd0.length; i++) {
				var character = pwd0.charAt(i);

				if(!isNaN(character*1)) {
					hasNum = true;
				}
				else if(character == character.toUpperCase()) {
					hasUpperCase = true;
				}
				else if(character == character.toLowerCase()) {
					hasLowerCase = true;
				}

				if(hasUpperCase && hasLowerCase && hasNum){
					pwdStatus = true;
					break;
				}

				if(i ==(pwd0.length-1)){
					if(!hasNum) {
						showError(err_el0, "(Password does not contain a number)");
					}
					else if(!hasUpperCase) {
						showError(err_el0, "(Password does not contain a uppercase letter)");
					}
					else if(!hasLowerCase) {
						showError(err_el0, "(Password does not contain a lowercase letter)");
					}
					else {
						showError(err_el0, "(Unknown Error)");
					}
				}
			}
		}

	return pwdStatus;
}


/* ----- Global Variable -----*/

var usernameStatus= false;
var pwdStatus = false;
var changePwdStatus = false;

/* ----- MAIN FUNCTION -----*/

$(document).ready(function(){

	/*--- Display the password tip ----*/

	//In the login form in modals.php
	$("#modal-register-pwd").popover({
		placement: 'right',
		trigger: 'hover',
		title: 'Password Rule',
		content: 'Password must have at least 7 characters and contain: a capital letter(A-Z), a small letter(a-z) and a number(0-9)'
	});

	//In the change password form in personal.php
	$("#personal-new-password").popover({
		placement: 'right',
		trigger: 'hover',
		title: 'Password Rule',
		content: 'Password must have at least 7 characters and contain: a capital letter(A-Z), a small letter(a-z) and a number(0-9)'
	});

	
	/****** REGISTER FORM *****/

	/*--- Check username for register form ---*/

	$("#modal-register-username").change( function(){
		usernameStatus = false; //Global variable
		var username = $(this).val();
		var err_msg = $("#modal-register-username-error");
		var httpRequest = userCheck(username, "");

		httpRequest
				.done(function(data) {
					if (data.split(",")[0] == 1) {
						showError(err_msg, "(Username is already taken)");
					}
					else if ((data.split(",")[0]) == 0) {
						usernameStatus = true;
						clearErrorMsg(err_msg);
					}
				});

	});

	/*--- Clear the error message for password in register form ---*/

	$("#modal-register-pwd").change( function(){
		clearErrorMsg($("#modal-register-pwd-error"));
	});

	/*---- Check password and input when submitting register form----*/

	$("#modal-registerForm").submit( function() {
		var username = $("#modal-register-username").val();
		var pwd = $("#modal-register-pwd").val();
		var err_msg_1 = $("#modal-register-username-error");
		var err_msg_2 = $("#modal-register-pwd-error");

		if (username === "") {
			showError(err_msg_1, "(Username is empty)");
			if (pwd === "") { 
				showError(err_msg_2, "(Password is empty)");
			}
			return (usernameStatus && pwdStatus);
		}
		else if (pwd === ""){
			showError(err_msg_2, "(Password is empty)");
			return (usernameStatus && pwdStatus);
		}
		else if (username != "" && pwd != "") {
			pwdStatus = pwdCheck(pwd, err_msg_2);
			return (usernameStatus && pwdStatus);
		}
		else 
			return (usernameStatus && pwdStatus);
	});

	/****** LOGIN FORM *****/

	/*---- Check input when submitting login form----*/
		
	$("#modal-loginForm").submit( function() {
		var username = $("#modal-login-username").val();
		var pwd = $("#modal-login-pwd").val();
		var loginForm = $("#modal-loginForm");
		var httpRequest;
		var err_msg = $("#modal-login-error");
		var msg = "(Incorrect username andd/or password)";

		if(username === "" || pwd === "") {
			showError(err_msg, msg);
			return false;
		}
		else 
			return true;
		
	});

	/****** CHANGE PASSWORD FORM *****/

	/*--- Check password in 'user change password' form---*/

	$("#personal-new-password").change( function(){
		var pwd = $(this).val();
		var err_msg = $("#personal-new-password-error");
		pwdCheck(pwd, err_msg);
	});

	/*--- Clear the error message when typing again password in 'user change password' form---*/

	$("#personal-new-password-again").change( function(){
		clearErrorMsg($("#personal-new-password-again-error"));
	});

	/*--- Check the old password in 'user change password form'---*/

	$("#personal-old-password").keyup( function() {
		var username = $("#username-session").text();
		var pwd = $(this).val();
		var err_msg = $("#personal-old-password-error");
		var httpRequest = userCheck(username, pwd);

		clearErrorMsg(err_msg);

		httpRequest.done( function(data){
			if(data.split(",")[0] == 1 && data.split(",")[1] == 1) {
				changePwdStatus = true;
			}
		});
	})

	/*--- Check input before submitting user change password form---*/

	$(".js-change-password-form").submit(function(){
		var oldPwd = $("#personal-old-password").val();
		var newPwd = $("#personal-new-password").val();
		var newPwdAgain = $("#personal-new-password-again").val();
		var err_msg_1 = $("#change-password-form-error");
		var err_msg_2 = $("#personal-new-password-again-error");
		var err_msg_3 = $("#personal-old-password-error");

		if (oldPwd == "" || newPwd == "" || newPwdAgain == "") {
			showError(err_msg_1, "Please fill in all the fields");
			return false;
		}
		else if (newPwd != newPwdAgain){
			clearErrorMsg(err_msg_1);
			showError(err_msg_2, "Retyped password does not match");
			return false;
		}
		else if (!changePwdStatus) {
			clearErrorMsg(err_msg_1);
			showError(err_msg_3, "(Old password is incorrect)");
			return changePwdStatus;
		}
		else
			return  changePwdStatus;
	});

	
	/****** CHANGE PERSONAL INFO FORM *****/

	$(".js-change-personal-infos-form").submit(function() {
		var firstName = $("#personal-firstname").val();
		var lastName = $("#personal-lastname").val();
		var email = $("#personal-email").val();
		var phone = $("#personal-phone").val();
		var address = $("#personal-address").val();
		var err_msg =$("#personal-infos-alert");

		if (firstName == "" || lastName == "" || email_el == "" || phone == "" || address == "") {
			showError(err_msg,"(Please fill in all the fields)");
			return false;
		}
		return true;
	});
});
