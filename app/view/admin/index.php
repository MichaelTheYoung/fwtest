<?

	?><div class="row">
		<div class="col-md-offset-2 col-md-8">
			<form name="frmLogin" class="form-horizontal" method="post" action="<?=$this->buildURL("admin.processLogin")?>">
				<fieldset>
					<h3>Please Log In</h3>
					<div class="form-group">
						<label class="control-label col-md-3" for="email">Your Email:</label>
						<div class="col-md-6">
							<input type="text" id="email" name="email" class="form-control" value="<?=$rc["email"]?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3" for="logpw">Password:</label>
						<div class="col-md-6">
							<input type="password" id="logpw" name="logpw" class="form-control" value="<?=$rc["logpw"]?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-3 col-md-6 alright">
							<input type="button" class="btn btn-primary btn-admin" onClick="Login();" value="Log In">
							<br><br>
							<a href="<?=$this->buildURL("admin.forgotUser")?>" class="adminLink">Forgot Password?</a>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/users.js"></script>



