<div class="container">
	<div class="main-container">
		<h1>List of available products</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>">Home</a></li>
			<li class="active">Products</li>	
		</ol>
		<h3>Click on the products to see details about the products </h3>
		<?php if (isAdmin()){ ?>
			<button class="btn btn-success" data-toggle="modal" data-target="#addProductForm">Add product</button><br><br>
		<?php } ?>

		<div class="row">
		<?php foreach($products as $product) { ?>
			<div class="col-xs-12 col-md-3">
				<div class="thumbnail">
					<img class="thumbnail-img" src="<?php echo $product->img_src; ?>" data-toggle="modal" data-target="#showProduct"/>
					<h4 class="thumbnail-name"><?php echo $product->name; ?></h4>
					<p class="thumbnail-price">€<?php echo $product->price; ?></p>
					<p class="thumbnail-description" hidden><?php echo $product->description ?></p>
					<p class="thumbnail-date" hidden><?php echo $product->date ?></p>
					<p class="thumbnail-id" hidden><?php echo $product->id ?></p>
					<p class="thumbnail-hidden-price" hidden><?php echo $product->price ?></p>
					<?php if (isAdmin()){ ?>
						<button class="btn btn-warning js-delete-product-btn" data-toggle="modal" data-target="#confirmDeleteProductForm">Delete</button>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</div>