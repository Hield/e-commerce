<?php
	class OrdersController{

		public function index(){
			require('models/product.php');
			require_once('models/order_detail.php');
			$orders = Order::all();
			require_once('views/orders/index.php');
		}

		public function show(){
			if (!isset($_SESSION['id'])){
				return false;
			}
			$order = null;
			require('models/product.php');
			require_once('models/order_detail.php');
			if (isAdmin()){
				if (!isset($_GET['id'])){
					return call('pages', 'error');
				}
				$order = Order::find($_GET['id']);
			} else {
				if (isset($_SESSION['orderID'])){
					if (!isset($_GET['id'])){
						$order = Order::find($_SESSION['orderID']);
					} else {
						if (Order::isSaved($_GET['id'])){
							$order = Order::find($_GET['id']);
						} else {
							return call('pages', 'error');
						}
					}
				} else {
					if (isset($_GET['id'])){
						if (Order::isSaved($_GET['id'])){
							$order = Order::find($_GET['id']);
						}
					}
				}
			}
			require_once('views/orders/show.php');
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
			require_once('models/order_detail.php');
			if (OrderDetail::check($_SESSION['orderID'], $_POST['product_id'])){
				OrderDetail::setQuantity($_SESSION['orderID'], $_POST['product_id'], $_POST['quantity']);
			} else {
				OrderDetail::create($_SESSION['orderID'], $_POST['product_id'], $_POST['product_price'], $_POST['quantity']);
			}	
			$_SESSION['notice'] = "Added product to basket";
			header("Location: index.php?controller=products&action=index");
		}

		public function save_order(){
			if (!isset($_SESSION['orderID'])){
				return call('pages', 'error');
			}
			Order::saveOrder($_SESSION['orderID']);
			unset($_SESSION['orderID']);
			$_SESSION['notice'] = "Orders saved";
			header("Location: index.php?controller=products&action=index");
		}
	}
?>