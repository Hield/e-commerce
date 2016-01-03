
function showError(elem, msg0) {
	elem.text(msg0);
	elem.css("font-weight", "bold");
	elem.css("font-size", "12px");
	elem.css("color", "red");
	elem.show("slow");
}

/*-- Fundtions In Use--*/

function clearErrorMsg(elem) {
	if(elem.text() != "") {
		elem.text("");
		elem.removeAttr("style");
	}
}

function userCheck(username0, pwd0){
	return $.ajax({
				type: "POST",
				cache: false,
				async: true,
				url: "controllers/user_get.php",
				data: {username: username0, pwd: pwd0},
				dataType : "text"
			});
}

function pwdCheck(pwd0, err_elem0, pwdStatus0) {
	pwdStatus = false;
	var MAXLENGTH = 7;
	var hasNum = false;
	var hasUpperCase = false;
	var hasLowerCase = false;

	clearErrorMsg(err_elem0);

		if(pwd0.length < MAXLENGTH && pwd0.length != 0){
			showError(err_elem0, "(Password does not contain 7 characters)");
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
					pwdStatus0 = true;
					break;
				}

				if(i ==(pwd0.length-1)){
					if(!hasNum) {
						showError(err_elem0, "(Password does not contain a number)");
					}
					else if(!hasUpperCase) {
						showError(err_elem0, "(Password does not contain a uppercase letter)");
					}
					else if(!hasLowerCase) {
						showError(err_elem0, "(Password does not contain a lowercase letter)");
					}
					else {
						showError(err_elem0, "(Unknown Error)");
					}
				}
			}
		}

	return pwdStatus0;
}

/* ----- Global Variable -----*/

var usernameStatus= false;
var pwdStatus = false;

/* ----- MAIN FUNCTION -----*/

$(document).ready(function(){

	/*--- Display the password tip ----*/

	$("#modal-register-pwd").popover({
		placement: 'right',
		trigger: 'hover',
		title: 'Password Rule',
		content: 'Password must have at least 7 characters and contain: a capital letter(A-Z), a small letter(a-z) and a number(0-9)'
	});

	/*---- Check if input is empty when submitting register form----*/

	$("#modal-registerForm").submit( function() {
		var username = $("#modal-register-username").val();
		var pwd = $("#modal-register-pwd").val();
		var err_elem1 = $("#err-msg-username-register");
		var err_elem2 = $('#err-msg-pwd-register');

		if (username === "") {
			showError(err_elem1, "(Username is empty)");
			if (pwd === ""){
				showError(err_elem2, "(Password is empty)");
			}
			return (usernameStatus && pwdStatus);
		}
		else if (pwd === ""){
			showError(err_elem2, "(Password is empty)");
			return (usernameStatus && pwdStatus);
		}
		else 
			return (usernameStatus && pwdStatus);
	});


	/*--- Check username for register form ---*/

	$("#modal-register-username").keyup( function(){
		usernameStatus = false; //Global variable
		var username = $(this).val();
		var err_elem = $("#err-msg-username-register");
		var httpRequest = userCheck(username, "");
			
			httpRequest
					.done(function(data) {
						if (data.split(",")[0] == 1) {
							showError(err_elem, "(Username is already taken)");
						}
						else if ((data.split(",")[0]) == 0) {
							usernameStatus = true;
							clearErrorMsg(err_elem);
						}
					});
		
	});

	/*--- Check password for register form ---*/

	$("#modal-register-pwd").keyup( function() {
		var pwd = $(this).val();
		var err_elem = $('#err-msg-pwd-register');

		clearErrorMsg(err_elem);
		pwdCheck(pwd, err_elem, pwdStatus);
	});

	/*---- Check input before submitting  login form----*/

	$("#modal-loginForm").submit( function() {
		var username = $("#modal-login-username").val();
		var pwd = $("#modal-login-pwd").val();
		var err_elem1 = $("#err-msg-username-login");
		var err_elem2 = $("#err-msg-pwd-login");

		clearErrorMsg(err_elem1);
		clearErrorMsg(err_elem2);

		if (username === "") {
			showError(err_elem1, "(Username is empty)");
			console.log(164);
			if (pwd === "") {
				showError(err_elem2, "(Password is empty)");
			}
			return (usernameStatus && pwdStatus);
		}
		else if (pwd == "") {
			showError(err_elem2, "(Password is empty)");
			return (usernameStatus && pwdStatus);
		}
		else if (!usernameStatus) {
			showError(err_elem1, "(Username does not exist)");
			return (usernameStatus && pwdStatus);
		}
		else if (usernameStatus && !pwdStatus) {
			showError(err_elem2, "(Password does not match)");
			return (usernameStatus && pwdStatus);
		} else
			return (usernameStatus && pwdStatus);
		
	});

	/*--- Check username for login form ---*/

	$("#modal-login-username").keyup(function(){
		usernameStatus = false;
		var username = $(this).val();
		var err_elem = $("#err-msg-username-login");
		var httpRequest = userCheck(username, "");
		
		clearErrorMsg($("#err-msg-username-login"));

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
		var err_elem = $("#err-msg-pwd-login");
		var pwd = $(this).val();
		var httpRequest = userCheck(username, pwd);
		
		clearErrorMsg($("#err-msg-pwd-login"));

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
});
