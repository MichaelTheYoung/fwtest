<?
	?><h1>Reset Your Password</h1>
	<div id="forgot">
		<p>Send us your email and we'll send you a link to reset your password:</p>
		<form name="frmForgot" method="post" action="<?=$this->buildURL("admin.forgotUser")?>">
		<input type="hidden" name="func" value="forgot">
		<table>
			<tr><td class="formcopy">Your Email:</td>
			<td><input type="text" name="email" class="formbox"></td></tr>
			<tr><td colspan="2" class="alright"><input type="button" class="formbutton" onClick="Forgot();" value="Send"></td></tr>
		</table>
		</form>
	</div>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/users.js"></script>

