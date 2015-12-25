<?php 
	class Order {

		public $id;
		public $date;
		public $userID;

		public function __construct($id, $date, $userID){
			$this->id = $id;
			$this->date = $date;
			$this->userId = $userID;
		}

		public static function isValid($id){
			$id = intval($id);
			$db = Db::getInstance();
			$req = $db->prepare('SELECT * FROM personal_infos WHERE id = :id');
			$req->execute(array('id' => $id));
			$profile = $req->fetch();
			if (empty($profile)){
				return false;
			} else {
				return true;
			}
		}

		public static function create($userID){
			$db = Db::getInstance();
			$userID = intval($userID);
			$req = $db->prepare('INSERT INTO orders(date, userid) VALUES(CURDATE(), :userid)');
			$req->execute(array('userid' => $userID));		
			$req = $db->prepare('SELECT id FROM orders WHERE userid = :userid ORDER BY id DESC LIMIT 1');
			$req->execute(array('userid' => $userID));	
			$order = $req->fetch();
			return $order['id'];
		}
	}
?>