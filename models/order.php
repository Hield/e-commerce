<?php 
	class Order {

		public $id;
		public $date;
		public $userID;
		public $sum;
		public $order_details;
		public $username;

		public function __construct($id, $date, $userID){
			$this->id = $id;
			$this->date = $date;
			$this->userID = $userID;
			$this->order_details = OrderDetail::find($id);
			$this->sum = $this->getSum();
		}

		public static function all(){
			$list = [];
			$db = Db::getInstance();
			if ($_SESSION['permission'] == "admin"){
				$req = $db->query('SELECT * FROM orders WHERE state = "saved"');
			} else {
				if (!isset($_SESSION['id'])){
					return false;
				} else {
					$req = $db->prepare('SELECT * FROM orders WHERE userid = :userid AND state = "saved"');
					$req->execute(array(':userid' => $_SESSION['id']));
				}
			} 
			foreach($req->fetchAll() as $order){
				$list[] = new Order($order['id'], $order['date'], $order['userid']);
			}
			return $list;
		}

		public static function find($id){
			$id = intval($id);
			$db = Db::getInstance();
			$req = $db->prepare('SELECT * FROM orders WHERE id = :id');
			$req->execute(array(':id' => $id));
			$order = $req->fetch();
			if (empty($order)){
				return false;
			} else {
				return new Order($order['id'], $order['date'], $order['userid']);
			}
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

		public static function isSaved($id){
			if (!isset($_SESSION['id'])){
				return false;
			}
			$id = intval($id);
			$db = Db::getInstance();
			$req = $db->prepare('SELECT * FROM orders WHERE id = :id');
			$req->execute(array(':id' => $id));
			$order = $req->fetch();
			if (empty($order)){
				return false;
			}
			if ($order['state'] != "saved" || $order['userid'] != $_SESSION['id']){
				return false;
			}
			return true;
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

		public static function saveOrder($id){
			$id = intval($id);
			$db = Db::getInstance();
			$req = $db->prepare('UPDATE orders SET state = "saved" WHERE id = :id');
			$req->execute(array(':id' => $id));
		}

		private function getSum(){
			$sum = 0;
			foreach($this->order_details as $order_detail){
				$sum = $sum + $order_detail->unitPrice * $order_detail->quantity;
			}
			return $sum;
		}

		public function getUser(){
			if (!isset($this->username)){
				$db = Db::getInstance();
				$req = $db->prepare('SELECT username FROM users WHERE id = :id');
				$req->execute(array(':id' => $this->userID));
				$user = $req->fetch();
				if (empty($user)){
					$this->username = "Anonymous";
				} else {
					$this->username = $user['username'];
				}
			}
			return $this->username;
		}

	}
?>