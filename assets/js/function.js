$(document).ready(function(){

	//----- Toggle login and register form -----//

	$("#modal-registerLink").click(function(){
		$("#modal-loginForm").hide();
		$("#modal-registerForm").show();
		$("#modal-loginForm")[0].reset(); //Take in Use JavaScript not JQuery
		clearErrorMsg($("#err-msg-username-login"));
		clearErrorMsg($("#err-msg-pwd-login"));
		$("#modal-formTitle").html("Register");
	});

	$("#modal-loginLink").click(function(){
		$("#modal-loginForm").show();
		$("#modal-registerForm").hide();
		$("#modal-registerForm")[0].reset(); //Take in Use JavaScript not JQuery
		clearErrorMsg($("#err-msg-username-register"));
		clearErrorMsg($("#err-msg-pwd-register"));
		$("#modal-formTitle").html("Login");
	});

	//----- Display login form first when first go to web page -----//

	$("#modal-loginLink").click();
	$("#html-users-change-password").hide();

	//----- Change active tab in side-bar navbar -----//

	$(".js-sidebar a").click(function(){
		$("#html-users-personal").hide();
		$("#html-users-change-password").hide();
		$("#html-" + this.id).show();
		$(".js-sidebar .active").removeClass("active");
		$(this).parent().addClass("active");
	});

	//----- Display products modal -----//

	$(".thumbnail").click(function(){
		$(".modal-show-product-image-source").attr("src", $(this).find(".thumbnail-img").attr("src"));
		$(".modal-show-product-name").html($(this).find(".thumbnail-name").html());
		$(".modal-show-product-price").html($(this).find(".thumbnail-price").html());
		$(".modal-show-product-description").html($(this).find(".thumbnail-description").html());
		$(".modal-show-product-date").html($(this).find(".thumbnail-date").html());
		$(".modal-show-product-id").val($(this).find(".thumbnail-id").html());
		$(".modal-show-product-price").val($(this).find(".thumbnail-hidden-price").html());
	});
	
});