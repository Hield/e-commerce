<?php
	class Product {

		public $id;
		public $name;
		public $img_src;
		public $price;
		public $description;
		public $date;

		public function __construct($id, $name, $img_src, $price, $description, $date){
			$this->id = $id;
			$this->name = $name;
			$this->img_src = $img_src;
			$this->price = $price;
			$this->description = $description;
			$this->date = $date;
		}

		public static function all(){
			$list = [];
			$db = Db::getInstance();
			$req = $db->query('SELECT * FROM products');

			foreach($req->fetchAll() as $product){
				$list[] = new Product($product['id'], $product['name'], $product['img_src'], $product['price'], $product['description'], $product['date']);
			}
			return $list;
		}

		public static function find($id){
			$db = Db::getInstance();
			$id = intval($id);
			$req = $db->prepare('SELECT * FROM products WHERE id = :id');
			$req->execute(array('id' => $id));
			$product = $req->fetch();

			return new Product($product['id'], $product['name'], $product['img_src'], $product['price'], $product['description'], $product['date']); 
		}

		public static function create($name, $img_src, $price, $description){
			$db = Db::getInstance();
			$req = $db->prepare('INSERT INTO products(name, img_src, price, description, date) VALUES(:name, :img_src, :price, :description, CURDATE())');
			$req->execute(array('name' => $name, 'img_src' => $img_src, 'price' => $price, 'description' => $description));
		}

		public static function destroy($id){
			$db = Db::getInstance();
			$req = $db->prepare('DELETE FROM products WHERE id = :id');
			$id = intval($id);
			$req->execute(array('id' => $id));
		}
	}
?>