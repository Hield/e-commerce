<!-- Modal -->
<div id="loginForm" class="modal fade" role="dialog">
	<div class="modal-dialog">
			
		<!-- Modal content -->
		<div class="modal-content">
			
			<!-- Modal header -->
				
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title" id="modal-formTitle"></h3>
			</div>
					
			<!-- Modal body -->
					
			<div class="modal-body">
				<form id="modal-loginForm" role="form" action="index.php?controller=users&action=login" method="post">
					<div class="form-group">
						<label for="modal-login-username">Username: </label>
						<input type="text" class="form-control" name="username" id="modal-login-username">
					</div>
					<div class="form-group">
						<label for="modal-login-pwd">Password: </label>
						<input type="password" class="form-control" name="pwd" id="modal-login-pwd"> 
					</div>
					<button type="submit" class="btn btn-default">Login</button>
					<a href="#" id="modal-registerLink"><p>Register</p></a>
				</form>
				<form id="modal-registerForm" role="form" action="index.php?controller=users&action=register" method="post">
					<div class="form-group">
						<label for="modal-register-username">Username: </label>
						<input type="text" class="form-control" name="username" id="modal-register-username">
					</div>
					<div class="form-group">
						<label for="modal-register-pwd">Password: </label>
						<input type="password" class="form-control" name="pwd" id="modal-register-pwd"> 
					</div>
					<button type="submit" class="btn btn-default">Register</button>
					<a href="#" id="modal-loginLink"><p>Login</p></a>
				</form>
			</div>
					
			<!-- Modal footer -->
				
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="addProductForm" class="modal fade" role="dialog">
	<div class="modal-dialog">
			
		<!-- Modal content -->
		<div class="modal-content">
			
			<!-- Modal header -->
				
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Add product</h3>
			</div>
					
			<!-- Modal body -->
					
			<div class="modal-body">
				<form role="form" action="index.php?controller=products&action=create" method="post">
					<div class="form-group">
						<label for="modal-product-name">Product name: </label>
						<input type="text" class="form-control" name="name" id="modal-product-name">
					</div>
					<div class="form-group">
						<label for="modal-product-image-source">Image source: </label>
						<input type="text" class="form-control" name="img_src" id="modal-product-image-source">
					</div>
					<div class="form-group">
						<label for="modal-product-price">Price: </label>
						<input type="text" class="form-control" name="price" id="modal-product-price"> 
					</div>
					<div class="form-group">
						<label for="modal-product-description">Description: </label>
						<textarea class="form-control" name="description" id="modal-product-description" rows="5"></textarea> 
					</div>
					<div class="form-group">
						<label for="modal-product-password">Confirm password: </label>
						<input type="password" class="form-control" name="pwd" id="modal-product-password">
					</div>
					<button type="submit" class="btn btn-default">Add product</button>
				</form>
			</div>
					
			<!-- Modal footer -->
				
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="confirmDeleteProductForm" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title" id="modal-formTitle">Confirmation</h3>
			</div>

			<div class="modal-body">
				<p>Are you sure you want to delete this product?
				</p>
				<p>This action cannot be reversed!
				</p>
			</div>
						
			<div class="modal-footer">
				<button type="button" class="btn btn-primary">Yes</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>

		</div>
	</div>
</div>

<!-- Modal -->
<div id="showProduct" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="row">
					<div class="col-md-6">
						<img class="modal-show-product-image-source" src="https://i.s-jcrew.com/is/image/jcrew/02337_WD9388?$pdp_fs418$" />
					</div>
					<div class="col-md-6">
						<h2 class="modal-show-product-name"></h2>
						<h3 class="modal-show-product-price"></h3>
						
						<div class="modal-description">
							<p class="modal-show-product-description"></p>
							<p class="modal-show-product-date"></p>
						</div>
						<form class="form-inline" role="form" action="index.php?controller=orders&action=create" method="post">
							<div class="form-group">
								<label for="quantity">Qty</label>
								<input type="text" class="form-control" name="quantity" id="quantity" value="1">
							</div>	
							<input type="hidden" name="product_id" class="modal-show-product-id" value="">
							<input type="hidden" name="product_price" class="modal-show-product-price" value="">
							<button type="submit" class="btn btn-default">ADD TO BASKET</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>