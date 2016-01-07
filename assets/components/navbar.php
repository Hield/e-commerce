<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
	
		<!-- Navigation header -->
	
		<div class="navbar-header">
		
			<!-- Responsive collapse navigation bar -->
			
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-navbar-collapse">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
			
			<!-- Navigation bar main link -->
			
			<a class="navbar-brand" href="<?php echo $_SERVER['PHP_SELF'];?>">
			    <img src="assets/img/brand.png" alt="Brand" id="brand">
			</a>
		</div>
		
		<!-- Navigation bar body -->
		
		<div class="navbar-collapse collapse main-navbar-collapse">
		
			<!-- Left navigation bar -->
		
			<ul class="nav navbar-nav">
				<li class="<?php if (isset($_GET["action"]) && $_GET["action"] == "home") { echo "active";}	else if (!isset($_GET["action"])) {echo "active";}?>"><a href="<?php getLink('pages','home'); ?>">Home</a></li>
				<li class="<?php if (isset($_GET["controller"]) && $_GET["controller"]=="products"){ echo "active";} ?>"><a href="<?php getLink('products','index'); ?>">Products</a></li>
				<?php if (isset($_SESSION["id"])){ ?>
					<li class="<?php if (isset($_GET["controller"]) && $_GET["controller"]=="orders" && $_GET["action"]=="index"){ echo "active"; } ?>"><a href="<?php getLink('orders', 'index'); ?>">Basket</a></li>
					<li class=""><a href="">History</a></li>
				<?php } ?>
				<li class="<?php if (isset($_GET["action"]) && $_GET["action"]=="about"){ echo "active";} ?>"><a href="<?php getLink('pages','about'); ?>">About</a></li>
				<li class="<?php if (isset($_GET["action"]) && $_GET["action"]=="contact"){ echo "active";} ?>"><a href="<?php getLink('pages','contact'); ?>">Contact</a></li>
			</ul>
			
			<!-- Right navigation bar -->
			
			<ul class="nav navbar-nav navbar-right">
				<?php
					if (isset($_SESSION["id"])){
				?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<?php echo $_SESSION["username"]; ?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="<?php getLink('users','account'); ?>">Account</a></li>
								<li><a href="<?php getLink('users','personal'); ?>">Personal Info</a></li>
								<li><a href="<?php getLink('users','setting'); ?>">Setting</a></li>
								<li><a href="<?php echo $_SERVER['PHP_SELF']; echo "?logout"; ?>">Logout</a></li>
							</ul>
						</li>
				<?php
					} else {
				?>
						<li><a href="#" data-toggle="modal" data-target="#loginForm">Login</a></li>
				<?php
					}
				?>
					
			</ul>
			
			<!-- add search form -->
            <form class="navbar-form navbar-right" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search this site">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>
			
			
		</div>
	</div>
</nav>