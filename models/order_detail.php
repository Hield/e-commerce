<?php
	class OrderDetail{

		public $orderID;
		public $productID;
		public $product;
		public $unitPrice;
		public $quantity;
		public $discount;

		public function __construct($orderID, $productID, $product, $unitPrice, $quantity, $discount){
			$this->orderID = $orderID;
			$this->productID = $productID;
			$this->product = $product;
			$this->unitPrice = $unitPrice;
			$this->quantity = $quantity;
			$this->discount = $discount;
		}

		public static function create($orderID, $productID, $unitPrice, $quantity){
			$db = Db::getInstance();
			$orderID = intval($orderID);
			$productID = intval($productID);
			$req = $db->prepare('INSERT INTO order_details(orderid, productid, unitprice, quantity) VALUES(:orderid, :productid, :unitprice, :quantity)');
			$req->execute(array('orderid' => $orderID, 'productid' => $productID, 'unitprice' => $unitPrice, 'quantity' => $quantity));		
		}

		public static function find($orderID){
			$list = [];
			$orderID = intval($orderID);
			$db = Db::getInstance();
			$req = $db->prepare('SELECT * FROM order_details WHERE orderid = :orderid');
			$req->execute(array('orderid' => $orderID));
			foreach($req->fetchAll() as $order){
				$list[] = new OrderDetail($order['orderid'], $order['productid'], Product::find($order['productid']), $order['unitprice'], $order['quantity'], 0);
			}
			return $list;
		}

		public static function check($orderID, $productID){
			$db = Db::getInstance();
			$orderID = intval($orderID);
			$productID = intval($productID);
			$req = $db->prepare('SELECT * FROM order_details WHERE orderid = :orderid AND productid = :productid');
			$req->execute(array('orderid' => $orderID, 'productid' => $productID));
			if (!empty($req->fetch())){
				return true;
			} else {
				return false;
			}
		}

		public static function setQuantity($orderID, $productID, $quantity){
			$db = Db::getInstance();
			$orderID = intval($orderID);
			$productID = intval($productID);
			$quantity = intval($quantity);
			$req = $db->prepare('UPDATE order_details SET quantity = quantity + :quantity WHERE orderid = :orderid AND productid = :productid');
			$req->execute(array('quantity' => $quantity, 'orderid' => $orderID, 'productid' => $productID));
		}
	}	
?>