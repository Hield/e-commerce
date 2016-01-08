<div class="container">
	<?php if (isAdmin()) {?>
		<h1>Order ID <?php echo $_GET['id']; ?> - User <?php echo $order->getUser(); ?> ID <?php echo $order->userID; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>">Home</a></li>
			<li><a href="<?php getLink('orders', 'index'); ?>">Orders history</a></li>
			<li class="active">Order ID <?php echo $_GET['id'] ?></li>	
		</ol>
		<h3>List of the items in the order</h3>
		<table class="table">
			<thead>
				<th class="col-md-3">ITEM IMAGE</th>
				<th class="col-md-3">ITEM DESCRIPTION</th>
				<th class="col-md-3">ITEM QUANTITY</th>
				<th class="col-md-3">TOTAL PRICE</th>
			</thead>
			<tbody>
				<?php foreach($order->order_details as $order_detail) { ?>
					<tr>
						<td class="col-md-3"><img class="basket-table-img" src="<?php echo $order_detail->product->img_src ?>"></td>
						<td>
							<p class="basket-table-name"><?php echo $order_detail->product->name ?></p>
							<p  class="basket-table-description"><b>Description:</b> <?php echo $order_detail->product->description ?></p>
							<p  class="basket-table-description"><b>Manufacturing date:</b> <?php echo $order_detail->product->date ?></p>
						</td>
						<td class="basket-table-quantity"><?php echo $order_detail->quantity ?></td>
						<td class="basket-table-price">€<?php echo $order_detail->quantity * $order_detail->unitPrice; ?></td>
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
				<p class="basket-table-total-price">€<?php echo $order->sum; ?></p>
			</div>
			<br>
			<div class="col-md-3">
				<a href="index.php?controller=orders&action=index" class="btn btn-default">< BACK</a>
			</div>
		</div>
	<?php } else if (isset($_GET['id'])) {?>
		<h1>Order ID <?php echo $_GET['id'] ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>">Home</a></li>
			<li><a href="<?php getLink('orders', 'index'); ?>">Orders history</a></li>
			<li class="active">Order ID <?php echo $_GET['id'] ?></li>	
		</ol>
		<h3>List of the items in the order</h3>
		<table class="table">
			<thead>
				<th class="col-md-3">ITEM IMAGE</th>
				<th class="col-md-3">ITEM DESCRIPTION</th>
				<th class="col-md-3">ITEM QUANTITY</th>
				<th class="col-md-3">TOTAL PRICE</th>
			</thead>
			<tbody>
				<?php foreach($order->order_details as $order_detail) { ?>
					<tr>
						<td class="col-md-3"><img class="basket-table-img" src="<?php echo $order_detail->product->img_src ?>"></td>
						<td>
							<p class="basket-table-name"><?php echo $order_detail->product->name ?></p>
							<p  class="basket-table-description"><b>Description:</b> <?php echo $order_detail->product->description ?></p>
							<p  class="basket-table-description"><b>Manufacturing date:</b> <?php echo $order_detail->product->date ?></p>
						</td>
						<td class="basket-table-quantity"><?php echo $order_detail->quantity ?></td>
						<td class="basket-table-price">€<?php echo $order_detail->quantity * $order_detail->unitPrice; ?></td>
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
				<p class="basket-table-total-price">€<?php echo $order->sum; ?></p>
			</div>
			<br>
			<div class="col-md-3">
				<a href="index.php?controller=orders&action=index" class="btn btn-default">< BACK</a>
			</div>
		</div>
	<?php } else { ?>
		<h1>Shopping Basket</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>">Home</a></li>
			<li class="active">Basket</li>	
		</ol>
		<?php if (!isset($_SESSION['orderID']) || !isset($order)){ ?>
			<h3>You have not added any product to your shopping basket </h3>
		<?php } else if (count($order->order_details) == 0){ ?>
			<h3>You have not added any product to your shopping basket </h3>
		<?php } else { ?>
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
					<?php foreach($order->order_details as $order_detail) { ?>
						<tr>
							<td class="col-md-3"><img class="basket-table-img" src="<?php echo $order_detail->product->img_src ?>"></td>
							<td>
								<p class="basket-table-name"><?php echo $order_detail->product->name ?></p>
								<p  class="basket-table-description"><b>Description:</b> <?php echo $order_detail->product->description ?></p>
								<p  class="basket-table-description"><b>Manufacturing date:</b> <?php echo $order_detail->product->date ?></p>
							</td>
							<td class="basket-table-quantity"><?php echo $order_detail->quantity ?></td>
							<td class="basket-table-price">€<?php echo $order_detail->quantity * $order_detail->unitPrice; ?></td>
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
					<p class="basket-table-total-price">€<?php echo $order->sum; ?></p>
				</div>
				<br>
				<div class="col-md-3">
					<a href="index.php?controller=products&action=index" class="btn btn-default">< CONTINUE SHOPPING</a>
				</div>
				<div class="col-md-6"></div>
				<div class="col-md-3">
					<a href="index.php?controller=orders&action=save_order" class="btn btn-default">CHECKOUT</a>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
</div>