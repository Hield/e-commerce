<div class="container">
	<h1>Setting</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo $_SERVER['PHP_SELF'];?>">Home</a></li>
		<li class="active">Setting</li>	
	</ol>

	<div class="row">
		<div class="col-sm-3">
						
			<!-- Side navigation bar -->
							
			<div class="sidebar-nav">
				<div class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<span class="visible-xs navbar-brand">Overview</span>
					</div>
					
					<!-- List of navigation bars -->
					
					<div class="navbar-collapse collapse sidebar-navbar-collapse">
						<ul class="nav navbar-nav">
							<li class="active"><a href="#">General Settings</a></li>
							<li><a href="#">Advanced Settings</a></li>
						</ul>
					</div>
				</div>
			</div>
			
			<!-- End navigation bar -->
			
		</div>
		<div class="col-sm-9">
						
			<!-- Main content -->
							
			<div class="container">
				<h2>Switch to admin or user (Dev tools!)</h2>
				<form role="form" method="post" action="<?php getLink('users','set_permission'); ?>">
					<div class="radio">
						<label><input type="radio" name="permission" value="user" <?php if ($_SESSION['permission'] == 'user'){ echo "checked";}?>>User</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="permission" value="admin" <?php if ($_SESSION['permission'] == 'admin'){ echo "checked";} ?>>Admin</label>
					</div>
					<button type="submit" class="btn btn-default">Save</button>
				</form>
			</div>
						
			<!-- End main content -->
						
		</div>		
	</div>
</div>