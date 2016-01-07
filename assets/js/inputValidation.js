
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

	/*--- Check username for register form ---*/

	$("#modal-register-username").keyup( function(){
		usernameStatus = false; //Global variable
		var username = $(this).val();
		var err_el = $("#modal-register-username-error");
		var httpRequest = userCheck(username, "");

		httpRequest
				.done(function(data) {
					if (data.split(",")[0] == 1) {
						showError(err_el, "(Username is already taken)");
					}
					else if ((data.split(",")[0]) == 0) {
						usernameStatus = true;
						clearErrorMsg(err_el);
					}
				});

	});

	/*--- Check password for register form ---*/

	$("#modal-register-pwd").keyup( function() {
		pwdStatus = pwdCheck($(this).val(),  $("#modal-register-pwd-error"));
	});

	/*---- Check if input is empty when submitting register form----*/

	$("#modal-registerForm").submit( function() {
		var username = $("#modal-register-username").val();
		var pwd = $("#modal-register-pwd").val();
		var err_el1 = $("#modal-register-username-error");
		var err_el2 = $("#modal-register-pwd-error");

		if (username === "") {
			showError(err_el1, "(Username is empty)");
			if (pwd === ""){
				showError(err_el2, "(Password is empty)");
			}
			return (usernameStatus && pwdStatus);
		}
		else if (pwd === ""){
			showError(err_el2, "(Password is empty)");
			return (usernameStatus && pwdStatus);
		}
		else 
			return (usernameStatus && pwdStatus);
	});

	/*--- Check username for login form ---*/

	$("#modal-login-username").keyup(function(){
		usernameStatus = false;
		var username = $(this).val();
		var httpRequest = userCheck(username, "");

		clearErrorMsg($("#modal-login-username-error"));

		httpRequest
				.done(function (data) {
					if(data.split(",")[0] == 0) {
					}
					else if(data.split(",")[0] == 1) {
						usernameStatus = true;
					}
				});
	});

	/*--- Check password for login form ---*/

	$("#modal-login-pwd").keyup(function(){
		pwdStatus = false;
		var username = $("#modal-login-username").val();
		var pwd = $(this).val();
		var httpRequest = userCheck(username, pwd);

		clearErrorMsg($("#modal-login-pwd-error"));

		if(usernameStatus == true){
			httpRequest
					.done(function (data) {
						if(data.split(",")[1] == 0) {
						}
						else if(data.split(",")[1] == 1){
							pwdStatus = true;
						}
					});
		}
	});

	/*---- Check input before submitting  login form----*/

	$("#modal-loginForm").submit( function() {
		var username = $("#modal-login-username").val();
		var pwd = $("#modal-login-pwd").val();
		var err_el1 = $("#modal-login-username-error");
		var err_el2 = $("#modal-login-pwd-error");

		clearErrorMsg(err_el1);
		clearErrorMsg(err_el2);

		if (username === "") {
			showError(err_el1, "(Username is empty)");
			if (pwd === "") {
				showError(err_el2, "(Password is empty)");
			}
			return (usernameStatus && pwdStatus);
		}
		else if (!usernameStatus) {
			showError(err_el1, "(Username does not exist)");
			return (usernameStatus && pwdStatus);
		}
		else if (pwd == "") {
			showError(err_el2, "(Password is empty)");
			return (usernameStatus && pwdStatus);
		}
		else if (usernameStatus && !pwdStatus) {
			showError(err_el2, "(Password does not match)");
			return (usernameStatus && pwdStatus);
		} else
			return (usernameStatus && pwdStatus);
		
	});

	/*--- Check password in user change password form---*/

	$("#personal-new-password").keyup( function(){
		var pwd = $(this).val();
		var err_el = $("#personal-new-password-error");
		pwdCheck(pwd, err_el);
	});

	/*--- Clear the error message when typing again password in user change password form---*/

	$("#personal-new-password-again").keyup( function(){
		clearErrorMsg($("#personal-new-password-again-error"));
	});

	/*--- Check the old password in user change password form---*/

	$("#personal-old-password").keyup( function() {
		var username = document.getElementById("username-session").childNodes[0].nodeValue.trim();
		var pwd = $(this).val();
		var err_el = $("#personal-old-password-error");
		var httpRequest = userCheck(username, pwd);

		clearErrorMsg(err_el);

		httpRequest.done( function(data){
			if(data.split(",")[0] == 1 && data.split(",")[1] == 1) {
				changePwdStatus = true;
			}
		});
	})

	/*--- Check input before submitting user change password form---*/

	$(".js-change-password-form").submit(function(){
		var oldPwd = $("#personal-old-password");
		var newPwd = $("#personal-new-password");
		var newPwdAgain = $("#personal-new-password-again");
		var err_el1 = $("#change-password-form-error");
		var err_el2 = $("#personal-new-password-again-error");
		var err_el3 = $("#personal-old-password-error");

		if (oldPwd.val() == "" || newPwd.val() == "" || newPwdAgain.val() == "") {
			showError(err_el1, "Please fill in all the fields");
			return false;
		}
		else if (newPwd.val() != newPwdAgain.val()){
			clearErrorMsg(err_el1);
			showError(err_el2, "Retyped password does not match");
			return false;
		}
		else if (!changePwdStatus) {
			clearErrorMsg(err_el1);
			showError(err_el3, "(Old password is incorrect)");
			return changePwdStatus;
		}
		else
			return  changePwdStatus;
	});

	$(".js-change-personal-infos-form").submit(function() {
		var firstName_el = $("#personal-firstname");
		var lastName_el = $("#personal-lastname");
		var email_el = $("#personal-email");
		var phone_el = $("#personal-phone");
		var address_el = $("#personal-address");
		var err_el =$("#personal-infos-alert");

		if (firstName_el.val() == "" || lastName_el.val() == "" || email_el.val() == "" ||
			phone_el.val() == "" || address_el.val() == "") {
			showError(err_el,"(Please fill in all the fields)");
			return false;
		}
		return true;
	});
});
