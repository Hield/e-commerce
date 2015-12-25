<?php
	class OrdersController{

		public function index(){
			require('models/order_detail.php');
			$orders = null;
			if (isset($_SESSION['orderID'])){
				$orders = OrderDetail::find($_SESSION['orderID']);
			}
			require_once('views/orders/index.php');
		}

		public function create(){
			if (!isset($_POST['quantity']) || !isset($_POST['product_id']) || !isset($_POST['product_price'])){
				return call('pages','error');
			}
			if (!isset($_SESSION['id'])){
				$_SESSION['alert'] = "Please log in before shopping";
				return header("Location: index.php?controller=products&action=index");
			}
			if (!Order::isValid($_SESSION['id'])){
				$_SESSION['alert'] = "Before you can buy products, you must provide necessary perfonal information";
				return header("Location: index.php?controller=products&action=index");
			}
			if (!isset($_SESSION['orderID'])){
				$_SESSION['orderID'] = Order::create($_SESSION['id']);
			}
			require('models/order_detail.php');
			if (OrderDetail::check($_SESSION['orderID'], $_POST['product_id'])){
				OrderDetail::setQuantity($_SESSION['orderID'], $_POST['product_id'], $_POST['quantity']);
			} else {
				OrderDetail::create($_SESSION['orderID'], $_POST['product_id'], $_POST['product_price'], $_POST['quantity']);
			}	
			$_SESSION['notice'] = "Added product to basket";
			header("Location: index.php?controller=products&action=index");
		}
	}
?>