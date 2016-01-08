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
				<li class="<?php if (checkActive('pages', 'home')) { echo "active"; } ?>"><a href="<?php getLink('pages','home'); ?>">Home</a></li>
				<li class="<?php if (checkActive('products', 'index')) { echo "active"; } ?>"><a href="<?php getLink('products','index'); ?>">Products</a></li>
				<?php if (isset($_SESSION["id"])){ ?>
					<?php if (!isAdmin()) { ?>
						<li class="<?php if (checkActive('orders', 'show') && !isset($_GET['id']) ) { echo "active"; } ?>"><a href="<?php getLink('orders', 'show'); ?>">Basket</a></li>
					<?php } ?>
					<li class="<?php if (checkActive('orders', 'index')) { echo "active"; } if (isAdmin()){ if (checkActive('orders', 'show')) { echo "active"; } } else { if (checkActive('orders', 'show') && isset($_GET['id'])) { echo "active"; } } ?>"><a href="<?php getLink('orders', 'index') ?>"><?php if ($_SESSION['permission'] == "admin"){ echo "Orders history"; } else { echo "Shopping History"; } ?></a></li>
				<?php } ?>
				<li class="<?php if (checkActive('pages', 'about')) { echo "active"; } ?>"><a href="<?php getLink('pages','about'); ?>">About</a></li>
				<li class="<?php if (checkActive('pages', 'contact')) { echo "active"; } ?>"><a href="<?php getLink('pages','contact'); ?>">Contact</a></li>
			</ul>
			
			<!-- Right navigation bar -->
			
			<ul class="nav navbar-nav navbar-right">
				<?php
					if (isset($_SESSION["id"])){
				?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<?php if ($_SESSION['permission'] == "admin") {?>
									<span class="label label-success">Admin</span> 
								<?php } else { ?>
									<span class="label label-primary">User</span> 
								<?php }?>
								<span id="username-session"><?php echo $_SESSION["username"]; ?></span>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<!-- <li><a href="<?php getLink('users','account'); ?>">Account</a></li> -->
								<li><a href="<?php getLink('users','personal'); ?>">Personal Info</a></li>
								<li><a href="<?php getLink('users','setting'); ?>">Setting</a></li>
								<li><a href="<?php echo $_SERVER['PHP_SELF']; echo "?logout"; ?>">Logout</a></li>
							</ul>
						</li>
				<?php
					} else {
				?>
						<li><a href="#" data-toggle="modal" data-target="#loginForm">Login / Register</a></li>
				<?php
					}
				?>
					
			</ul>
			
			<!-- add search form -->
			<!--
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
			-->
			
		</div>
	</div>
</nav>