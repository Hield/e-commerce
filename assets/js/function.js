$(document).ready(function(){
	$("#modal-registerLink").click(function(){
		$("#modal-loginForm").hide();
		$("#modal-registerForm").show();
		$("#modal-formTitle").html("Register");
	});
	$("#modal-loginLink").click(function(){
		$("#modal-loginForm").show();
		$("#modal-registerForm").hide();
		$("#modal-formTitle").html("Login");
	});
	$("#modal-loginLink").click();
	$("#html-users-change-password").hide();
	$(".js-sidebar a").click(function(){
		$("#html-users-personal").hide();
		$("#html-users-change-password").hide();
		$("#html-" + this.id).show();
		$(".js-sidebar .active").removeClass("active");
		$(this).parent().addClass("active");
	});
	$(".js-change-password-form").submit(function(){
		if ($("#personal-old-password").val() == "" || $("#personal-new-password").val() == "" || $("#personal-new-password-again").val() == ""){
			$("#change-password-alert").html("Please fill in all the fields");
			return false;
		}
		if ($("#personal-new-password").val() != $("#personal-new-password-again").val()){
			$("#change-password-alert").html("New passwords are not the same");
			return false
		}
		return true;
	});
	$(".js-change-personal-infos-form").submit(function(){
		if ($("#personal-firstname").val() == "" || $("#personal-lastname").val() == "" || $("#personal-email").val() == "" || $("#personal-phone").val() == "" || $("#personal-address").val() == ""){
			$("#change-personal-infos-alert").html("Please fill in all the fields");
			return false;
		}
		return true;
	});

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