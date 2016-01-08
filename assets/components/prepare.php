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
	
	function checkActive($controller, $action){
		if (!isset($_GET['controller']) || !isset($_GET['action'])){
			if ($controller == "pages" && $action == "home"){
				return true;
			} else {
				return false;
			}
		}
		if ($_GET['controller'] == $controller && $_GET['action'] == $action){
			return true;
		} else {
			return false;
		}
	}

	function isAdmin(){
		if (!isset($_SESSION['permission'])){
			return false;
		}
		if ($_SESSION['permission'] == "admin"){
			return true;
		} else {
			return false;
		}
	}
?>
