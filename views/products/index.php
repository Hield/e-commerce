<div class="container">
	<div class="main-container">
		<h1>List of available products</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>">Home</a></li>
			<li class="active">Products</li>	
		</ol>
		<?php if ($_SESSION['permission'] == 'admin'){ ?>
			<button class="btn btn-success" data-toggle="modal" data-target="#addProductForm">Add product</button><br><br>
		<?php } ?>

		<div class="row">
		<?php foreach($products as $product) { ?>
			<div class="col-xs-12 col-md-3">
				<div class="thumbnail" data-toggle="modal" data-target="#showProduct">
					<img class="thumbnail-img" src="<?php echo $product->img_src; ?>" />
					<h4 class="thumbnail-name"><?php echo $product->name; ?></h4>
					<p class="thumbnail-price">€<?php echo $product->price; ?></p>
					<p class="thumbnail-description" hidden><?php echo $product->description ?></p>
					<p class="thumbnail-date" hidden><?php echo $product->date ?></p>
					<p class="thumbnail-id" hidden><?php echo $product->id ?></p>
					<p class="thumbnail-hidden-price" hidden><?php echo $product->price ?></p>
					<?php if ($_SESSION['permission'] == 'admin'){ ?>
						<form method="post" action ="<?php getLink('products','destroy'); ?>">
							<input type="hidden" name="product_id" value="<?php echo $product->id ?>">
							<button type="submit" class="product-del-btn btn btn-warning">Delete</button>
						</form>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</div>