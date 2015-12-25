<?php 
	class PersonalInfo {
		public $firstname;
		public $lastname;
		public $email;
		public $phone;
		public $address;

		public function __construct($id, $firstname, $lastname, $email, $phone, $address){
			$this->firstname = $firstname;
			$this->lastname = $lastname;
			$this->email = $email;
			$this->phone = $phone;
			$this->address = $address;
		}

		public static function find($id){
			$db = Db::getInstance();
			$req = $db->prepare('SELECT * FROM personal_infos WHERE id = :id');
			$id = intval($_SESSION['id']);
			$req->execute(array('id' => $id));
			$info = $req->fetch();
			return new PersonalInfo($info['id'], $info['firstname'], $info['lastname'], $info['email'], $info['phone'], $info['address']);
		}

		public static function create($id, $firstname, $lastname, $email, $phone, $address){
			$db = Db::getInstance();
			$req = $db->prepare('INSERT INTO personal_infos VALUES(:id, :firstname, :lastname, :email, :phone, :address)');
			$id = intval($id);
			$req->execute(array('id' => $id, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone, 'address' => $address));
		}

		public static function update($id, $firstname, $lastname, $email, $phone, $address){
			$db = Db::getInstance();
			$req = $db->prepare('UPDATE personal_infos SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone, address = :address WHERE id = :id');
			$id = intval($id);
			$req->execute(array('id' => $id, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone, 'address' => $address));
		}

		public static function exist($id){
			$db = Db::getInstance();
			$req = $db->prepare('SELECT * FROM personal_infos WHERE id = :id');
			$id = intval($id);
			$req->execute(array('id' => $id));
			if (empty($req->fetch())){
				return 0;
			}
			return 1;
		}
	}
?>