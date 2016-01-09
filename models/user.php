<?php
	class User {
		public $id;
		public $username;
		public $pwd;
		public $permission;
		
		public function __construct($id, $username, $pwd, $permission) {
			$this->id = $id;
			$this->username = $username;
			$this->pwd = $pwd;
			$this->permission = $permission;
		}
		
		public static function find($username, $pwd){
			$db = Db::getInstance();
			$req = $db->prepare('SELECT * FROM users WHERE username = :username AND pwd = :pwd');
			$req->execute(array('username' => $username, 'pwd' => sha1($pwd)));
			$user = $req->fetch();
			if (empty($user)){
				return 0;
			}
			return new User($user['id'], $user['username'], $user['pwd'], $user['permission']);
		}	

		public static function find_by_id($id){
			$db = Db::getInstance();
			$req = $db->prepare('SELECT * FROM users WHERE id = :id');
			$id = intval($id);
			$req->execute(array('id' => $id));
			return new User($user['id'], $user['username'], $user['pwd'], $user['permission']);
		}

		public static function register($username, $pwd){
			$db = Db::getInstance();
			$req = $db->prepare('SELECT * FROM users WHERE username = :username');
			$req->execute(array('username' => $username));
			$user = $req->fetch();
			if (!empty($user['id'])){
				return 0;
			}
			$req = $db->prepare('INSERT INTO users(username, pwd) VALUES(:username,:pwd)');
			$req->execute(array('username' => $username, 'pwd' => sha1($pwd)));
		}

		public static function set_permission($id, $permission){
			$db = Db::getInstance();
			$req = $db->prepare('UPDATE users SET permission = :permission WHERE id = :id');
			$id = intval($id);
			$req->execute(array('permission' => $permission, 'id' => $id));
		}

		public static function update_password($username, $pwd){
			$db = Db::getInstance();
			$req = $db->prepare('UPDATE users SET pwd = :pwd WHERE username = :username');
			$req -> execute(array('username' => $username, 'pwd' => sha1($pwd)));
		}
		
		public static function find_by_username($username) {
			$db = Db::getInstance();
			$req = $db->prepare('SELECT * FROM users WHERE username = :username');
			$req->execute(array('username' => $username));
			$user = $req->fetch();
			if(empty($user)){
				return false;
			}
			else
				return new User($user['id'], $user['username'], $user['pwd'], $user['permission']);
		}
	}
?>