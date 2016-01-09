$(document).ready(function(){

	//----- Toggle login and register form -----//

	$("#modal-registerLink").click(function(){
		$("#modal-loginForm").hide();
		$("#modal-registerForm").show();
		$("#modal-loginForm")[0].reset(); //Take in Use JavaScript not JQuery
		clearErrorMsg($("#modal-login-error"));
		$("#modal-formTitle").html("Register");
	});

	$("#modal-loginLink").click(function(){
		$("#modal-loginForm").show();
		$("#modal-registerForm").hide();
		$("#modal-registerForm")[0].reset(); //Take in Use JavaScript not JQuery
		clearErrorMsg($("#modal-register-username-error"));
		clearErrorMsg($("#modal-register-pwd-error"));
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
		$("#modal-product-delete-id").val($(this).find(".thumbnail-id").html());
	});

	//----- Change quantity in basket -----//

	$(".btn-number").click(function(e){
		e.preventDefault();

		fieldName = $(this).attr('data-field');
		type = $(this).attr('data-type');

		var input = $('input[id="' + fieldName + '"]');
		var currentVal = parseInt(input.val());

		if (!isNaN(currentVal)){
			if (currentVal < 1){
				input.val(1);
			} else {
				if (type == 'minus'){
					if (currentVal > input.attr('min')){
						input.val(currentVal - 1);
					}
					if (parseInt(input.val()) == input.attr('min')){
						$(this).attr('disabled', true);
					}
				} else if (type == 'plus'){
					input.val(currentVal + 1);
					$(this).parent().prev().prev().find(".btn").attr("disabled", false);
				}
			}
		} else {
			input.val(1);
		}
	});

	$(".js-basket-change-quantity-form").submit(function(){
		var input = $(this).find("input").val();
		if (isNaN(input)){
			$(this).find(".js-basket-change-quantity-alert").html("Please input a correct number");
			return false;
		}
		if (input < 1){
			$(this).find(".js-basket-change-quantity-alert").html("Please input a correct number");
			return false;
		}
		return true;
	});
});