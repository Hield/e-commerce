<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	
	if (isset($_GET['logout'])){
		session_unset();
		$_SESSION['notice'] = "Logged out successfully!";
	}
	if (!isset($_SESSION['permission'])){
		$_SESSION['permission'] = "user";
	}
	function getLink($controller, $action){
		if ($controller == "pages" && $action == "home"){
			echo $_SERVER['PHP_SELF'];
		} else {
			echo $_SERVER['PHP_SELF']; 
			echo "?controller=".$controller."&action=".$action;
		}
	}
	
	function checkActive(){
		
	}
?>
