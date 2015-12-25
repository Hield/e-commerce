<?php
	session_start();
?>
<!doctype html>
<html>
	<head>
		<title>Online shop</title>
		<meta charset='utf-8'>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	</head>
	<body>

		<?php require_once('assets/components/prepare.php'); ?>
		<?php require_once('assets/components/navbar.php'); ?>
		<?php if (isset($_SESSION['alert'])) { ?>
			<div class="container alert"><?php echo $_SESSION['alert']; unset($_SESSION['alert']); ?></div>
		<?php } ?>
		<?php if (isset($_SESSION['notice'])) { ?>
			<div class="container notice"><?php echo $_SESSION['notice']; unset($_SESSION['notice']); ?></div>
		<?php } ?>
		<div class="page-wrap">
			<?php require_once('routes.php'); ?>
		</div>
		
		<footer class="footer">
			<div class="container">
				<p class="text-muted">Copyright © 2015 THL Team. All rights reserved.</p>
			</div>
		</footer>


		<?php require_once('assets/components/modals.php'); ?>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/function.js"></script>
	</body>
</html>