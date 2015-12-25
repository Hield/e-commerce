<div class="container">
	<h1>Product <?php echo $product->name ?></h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo $_SERVER['PHP_SELF'];?>">Home</a></li>
		<li><a href="<?php getLink('products', 'index') ?>">Products</a></li>
		<li class="active"><?php echo $product->name ?></li>	
	</ol>
	<h3><?php echo $product->name ?></h3>
	<p>Price: <?php echo $product->price ?></p>
	<p>Description: <?php echo $product->description ?></p>
	<p><?php echo $product->date ?></p>
</div>