<div class="container">
	<h1>Personal Infomation</h1>
	
	<!-- Breadcrumb -->
	
	<ol class="breadcrumb">
		<li><a href="<?php echo $_SERVER['PHP_SELF'];?>">Home</a></li>
		<li class="active">Personal information</li>	
	</ol>
	
	<!-- End breadcrumb -->
	
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
					
					<div class="navbar-collapse collapse sidebar-navbar-collapse js-sidebar">
						<ul class="nav navbar-nav">
							<li class="active"><a href="#" id="users-personal">General Information</a></li>
							<li><a href="#" id="users-change-password">Change password</a></li>
						</ul>
					</div>
				</div>
			</div>
			
			<!-- End navigation bar -->
			
		</div>
		<div class="col-sm-9">
						
			<!-- Main content -->
			
			<!-- First form is visiable as default -->
			<div class="container" id="html-users-personal">
				<h2>General Information</h2>
				<hr>
				<form class="form-horizontal js-change-personal-infos-form" role="form" method="post" action="<?php getLink('users','change_info'); ?>">
					<div class="form-group">
						<label class="control-label col-sm-2" for="personal-firstname">First name: </label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="firstname" id="personal-firstname" value="<?php echo $info->firstname; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="personal-lastname">Last name: </label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="lastname" id="personal-lastname" value="<?php echo $info->lastname; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="personal-email">Email: </label>
						<div class="col-sm-5">
							<input type="email" class="form-control" name="email" id="personal-email" value="<?php echo $info->email; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="personal-phone">Phone number: </label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" id="personal-phone" value="<?php echo $info->phone; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="personal-address">Address: </label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" id="personal-address" value="<?php echo $info->address; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-5">
							<div class="form-alert" id="change-personal-infos-alert">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-5">
							<button type="submit" class="btn btn-default">Save</button>
						</div>
					</div>
				</form>
			</div>
					
			<!-- Second form is hidden due to javascript -->
			<div class="container" id="html-users-change-password">
				<h2>Change Password</h2>
				<hr>
				<form class="form-horizontal js-change-password-form" role="form" method="post" action="<?php getLink('users','change_password'); ?>">
					<div class="form-group">
						<div class="col-sm-offset-3 err-msg" id="err-personal-old-password"></div>
						<label class="control-label col-sm-3" for="personal-old-password">Old password: </label>
						<div class="col-sm-5">
							<input type="password" class="form-control" name="old-password" id="personal-old-password">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 err-msg" id="err-personal-new-password"></div>
						<label class="control-label col-sm-3" for="personal-new-password">New password: </label>
						<div class="col-sm-5">
							<input type="password" class="form-control" name="new-password" id="personal-new-password">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 err-msg" id="err-personal-new-password-again"></div>
						<label class="control-label col-sm-3" for="personal-new-password-again">Confirm new password: </label>
						<div class="col-sm-5">
							<input type="password" class="form-control" name="new-password-again" id="personal-new-password-again">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 err-msg" id="err-change-password-form"></div>
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-default">Change password</button>
						</div>
					</div>
				</form>
			</div>
			<!-- End main content -->
						
		</div>		
	</div>
</div>