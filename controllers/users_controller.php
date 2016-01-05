<?php
	class UsersController {
		public function login(){
			if (!isset($_POST['username']) || !isset($_POST['pwd'])){
				return call('pages','error');
			}
			$user = User::find($_POST['username'], $_POST['pwd']);
			if (empty($user->id)){
				$_SESSION['alert'] = "Wrong username or password!";
				header("Location: index.php");
			} else {
				$_SESSION['id'] = $user->id;
				$_SESSION['username'] = $user->username;
				$_SESSION['permission'] = $user->permission;
				$_SESSION['notice'] = "Logged in successfully!";
				header("Location: index.php");
			}
		}
		
		public function register(){
			if (!isset($_POST['username']) || !isset($_POST['pwd'])){
				return call('pages','error');
			}
			if (User::find_by_username($_POST['username'])){
				$_SESSION['alert'] = "Username has been used!";
				return header("Location: index.php");
			}
			else if (!User::find_by_username($_POST['username'])){
				User::register($_POST['username'], $_POST['pwd']);
				$_SESSION['notice'] = "Registered in successfully!";
				header("Location: index.php");
			}
		}
		
		public function account(){
			if (!isset($_SESSION['id'])){
				return call('pages','error');
			}
			require_once('views/users/account.php');
		}

		public function personal(){
			if (!isset($_SESSION['id'])){
				return call('pages','error');
			}
			require_once('models/personal_info.php');
			$id = intval($_SESSION['id']);
			$info = PersonalInfo::find($id);
			require_once('views/users/personal.php');
		}

		public function setting(){
			if (!isset($_SESSION['id'])){
				return call('pages','error');
			}
			require_once('views/users/setting.php');
		}

		public function set_permission(){
			if (!isset($_POST['permission'])){
				return call('pages','error');
			}
			User::set_permission($_SESSION['id'], $_POST['permission']);
			$_SESSION['permission'] = $_POST['permission'];
			$_SESSION['notice'] = "Change permission successfully!";
			header("Location: index.php?controller=users&action=setting");
		}

		public function change_info(){
			if (!isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_POST['address'])){
				return call('pages','error');
			}
			require('models/personal_info.php');
			$id = intval($_SESSION['id']);
			if (!PersonalInfo::exist($id)){
				PersonalInfo::create($id, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phone'], $_POST['address']);
				$_SESSION['notice'] = "Create new profile successfully!";
				return header("Location: index.php?controller=users&action=personal");
			}
			PersonalInfo::update($id, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phone'], $_POST['address']);
			$_SESSION['notice'] = "Change personal information successfully!";
			return header("Location: index.php?controller=users&action=personal");
		}
		
		public function change_password() {
			if (!isset($_POST['old-password']) || !isset($_POST['new-password']) || !isset($_POST['new-password-again'])){
				return call('page', 'error');
			}
			require('models/personal_info.php');
			$user = User::find_by_username($_SESSION['username']);
			if ($_POST['old-password'] == "" || $_POST['new-password'] == "" || $_POST['new-password-again'] == ""){
				$_SESSION['notice'] = "Password change is not successful! (All the input fields were empty)!";
			}
			else if ($_POST['old-password'] != $user->pwd) {
				$_SESSION['notice'] = "Password change is not successful! (Old password was incorrect)";

			}
			else if ($_POST['new-password'] != $_POST['new-password-again']) {
				$_SESSION['notice'] = "Password change is not successful! (Retyped password field did not match)";
			}
			else {
				User::update_password($_SESSION['username'], $_POST['new-password']);
				$_SESSION['notice'] = "Change password successfully!";
			}
			return header("Location: index.php?controller=users&action=personal");
		}
	}
?>