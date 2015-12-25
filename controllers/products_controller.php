<?php
	class ProductsController{
		public function index(){
			$products = Product::all();
			require_once('views/products/index.php');
		}

		public function show(){
			if (!isset($_GET['id'])){
				return call('pages','error');
			}

			$product = Product::find($_GET['id']);
			require_once('views/products/show.php');
		}

		public function create(){
			if (!isset($_POST['name']) || !isset($_POST['price']) || !isset($_POST['description']) || !isset($_POST['pwd']) || !isset($_POST['img_src'])){
				return call('pages','error');
			}
			require_once('models/user.php');
			if (!User::find($_SESSION['username'], $_POST['pwd'])){
				$_SESSION['alert'] = "Wrong password!";
				return header("Location: index.php?controller=products&action=index"); 
			}
			$price = floatval($_POST['price']);
			Product::create($_POST['name'], $_POST['img_src'], $price, $_POST['description']);
			$_SESSION['notice'] = "Added product successfully!";
			header("Location: index.php?controller=products&action=index");
		}

		public function destroy(){
			if (!isset($_POST['product_id'])){
				return call('pages','error');
			}
			$id = intval($_POST['product_id']);
			Product::destroy($_POST['product_id']);
			$_SESSION['notice'] = "Deleted product successfully!";
			header("Location: index.php?controller=products&action=index");
		}

/*
		public function new(){

		}

		public function edit(){

		}

		public function update(){

		}
		
*/
	}
?>