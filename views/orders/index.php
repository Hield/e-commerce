<div class="container">
	<?php if (isAdmin()){ ?>
		<h1>Orders history</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>">Home</a></li>
			<li class="active">Orders history</li>	
		</ol>
		<?php if (empty($orders)) { ?>
			<h2>There aren't any orders</h2>
		<?php } else { ?>
			<table class="table">
				<thead>
					<tr>
						<th class="col-md-3">Order ID</th>
						<th class="col-md-3">Date</th>
						<th class="col-md-3">User</th>
						<th class="col-md-3">Details</a></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($orders as $order) { ?>
						<tr>
							<td><?php echo $order->id; ?></td>
							<td><?php echo $order->date; ?></td>
							<td><?php echo $order->getUser(); ?></td>
							<td><a href="index.php?controller=orders&action=show&id=<?php echo $order->id; ?>">Details</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php }?>
	<?php } else { ?>
		<h1>Your shopping history</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $_SERVER['PHP_SELF'];?>">Home</a></li>
			<li class="active">History</li>	
		</ol>
		<?php if (empty($orders)){ ?>
			<h3>You have not saved any orders </h3>
		<?php } else { ?>
			<table class="table">
				<thead>
					<tr>
						<th class="col-md-3">Order ID</th>
						<th class="col-md-3">Date</th>
						<th class="col-md-3">Details</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($orders as $order) { ?>
						<tr>
							<td><?php echo $order->id; ?></td>
							<td><?php echo $order->date; ?></td>
							<td><a href="index.php?controller=orders&action=show&id=<?php echo $order->id; ?>">Details</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php } ?>	
	<?php } ?>
</div>