<?
	?><div class="row">
		<div class="col-md-12">
			<legend>Reset Your Password</legend>
			<p>Enter your email address and your new password:</p>
			<form name="frmReset" method="post" action="<?=$this->buildURL("admin.processResetUser")?>">
			<input type="hidden" name="pin" value="<?=$rc["pin"]?>">
			<div class="row rowbottom">
				<div class="col-md-3 formLabel alright">
					Your Email:
				</div>
				<div class="col-md-4">
					<input type="text" id="email" name="email" class="form-control">
				</div>
			</div>
			<div class="row rowbottom">
				<div class="col-md-3 formLabel alright">
					Your New Password:
				</div>
				<div class="col-md-4">
					<input type="text" id="log1" name="log1" class="form-control">
				</div>
			</div>
			<div class="row rowbottom">
				<div class="col-md-3 formLabel alright">
					Repeat Password:
				</div>
				<div class="col-md-4">
					<input type="text" id="log2" name="log2" class="form-control">
				</div>
			</div>
			<div class="row rowbottom">
				<div class="col-md-7 alright">
					<input type="button" class="btn btn-primary" onClick="DoReset();" value="Submit">
				</div>
			</div>
			</form>
		</div>
	</div>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/users.js"></script>



