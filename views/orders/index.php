<div class="container">
	<h1>Shopping Basket</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo $_SERVER['PHP_SELF'];?>">Home</a></li>
		<li class="active">Basket</li>	
	</ol>
	<?php if (!isset($_SESSION['orderID'])){ ?>
		<h3>You have not added any product to your shopping basket </h3>
	<?php } else if (count($orders) == 0){ ?>
		<h3>You have not added any product to your shopping basket </h3>
	<?php } else { $sum = 0;?>
		<h3>List of the items in your basket</h3>
		<table class="table">
			<thead>
				<tr>
					<th class="col-md-3">ITEM IMAGE</th>
					<th class="col-md-3">ITEM DESCRIPTION</th>
					<th class="col-md-3">ITEM QUANTITY</th>
					<th class="col-md-3">TOTAL PRICE</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($orders as $order) { ?>
					<tr>
						<td><img class="basket-table-img" src="<?php echo $order->product->img_src ?>"></td>
						<td>
							<p class="basket-table-name"><?php echo $order->product->name ?></p>
							<p  class="basket-table-description"><b>Description:</b> <?php echo $order->product->description ?></p>
							<p  class="basket-table-description"><b>Manufacturing date:</b> <?php echo $order->product->date ?></p>
						</td>
						<td class="basket-table-quantity"><?php echo $order->quantity ?></td>
						<td class="basket-table-price">€<?php echo $order->quantity * $order->unitPrice; $sum+= $order->quantity * $order->unitPrice; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<div class="row total-price-division">
			<div class="col-md-6"></div>
			<div class="col-md-3">
				<p class="basket-table-total-price">TOTAL PRICE:</p>
			</div>
			<div class="col-md-3">
				<p class="basket-table-total-price">€<?php echo $sum; ?></p>
			</div>
			<br>
			<div class="col-md-3">
				<a href="index.php?controller=products&action=index" class="btn btn-default">< CONTINUE SHOPPING</a>
			</div>
			<div class="col-md-6"></div>
			<div class="col-md-3">
				<a href="#" class="btn btn-default">CHECKOUT</a>
			</div>
		</div>
	<?php } ?>
</div>