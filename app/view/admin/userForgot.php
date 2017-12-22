<?
	?><div class="row">
		<div class="col-md-12">
			<legend>Reset Your Password</legend>
			<p>Send us your email and we'll send you a link to reset your password:</p>
			<form name="frmForgot" method="post" action="<?=$this->buildURL("admin.forgotUser")?>">
			<input type="hidden" name="func" value="forgot">
			<div class="row rowbottom">
				<div class="col-md-2 formLabel alright">
					Your Email:
				</div>
				<div class="col-md-4">
					<input type="text" id="email" name="email" class="form-control">
				</div>
			</div>
			<div class="row rowbottom">
				<div class="col-md-6 alright">
					<input type="button" class="btn btn-primary" onClick="Forgot();" value="Send">
				</div>
			</div>
			</form>
		</div>
	</div>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/users.js"></script>


