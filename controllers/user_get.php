<?php
	require_once(__DIR__.'/../models/user.php');
	require_once(__DIR__.'/../connection.php');

	$checkUser = array("foundUserName"  => 0, "pwdMatch" => 0);
	$databasePwd = '';

	//$user = User::find($_POST['username'], $_POST['pwd']);
	$user = User::find_userName($_POST['username']);
	$inputPwd = $_POST['pwd'];
	
	 if ($user) {
	 	$checkUser['foundUserName'] = 1;
	 	$databasePwd = $user->pwd;
	if($databasePwd == $inputPwd){
	 		$checkUser['pwdMatch'] = 1;
	 	}
	 }

	echo $checkUser['foundUserName'].',';
	echo $checkUser['pwdMatch'];

?>