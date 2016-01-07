<?php
	function call($controller, $action){
		require_once('controllers/'.$controller.'_controller.php');
		
		switch($controller){
			case 'pages':
				$controller = new PagesController();
			break;
			case 'posts':
				// we need the model to query the database later in the controller
				require_once('models/post.php');
				$controller = new PostsController();
			break;
			case 'users':
				require_once('models/user.php');
				$controller = new UsersController();
			break;
			case 'products':
				require_once('models/product.php');
				$controller = new ProductsController();
			break;
			case 'orders':
				require_once('models/order.php');
				//require_once('models/order_detail.php');
				$controller = new OrdersController();
			break;
		}
		
		// call the action
		$controller->{ $action }();
	}
	
	// we're adding an entry for the new controller and its actions
	$controllers = array('pages'    => ['home','about','contact','error'],
						 'posts'    => ['index','show'],
						 'users'    => ['login','register','account','personal','setting','set_permission','change_info', 'change_password'],
						 'products' => ['index', 'show', 'new', 'edit', 'create', 'update', 'destroy'],
						 'orders'   => ['index', 'show', 'create', 'save_order']);
		
	if (array_key_exists($controller, $controllers)){
		if (in_array($action, $controllers[$controller])){
			call($controller, $action);
		} else {
			call('pages', 'error');
		} 
	} else {
		call('pages','error');
	}
?>