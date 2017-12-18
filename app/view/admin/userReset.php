<?
	?><h1>Reset Your Password</h1>
	<p>Enter your email address and your new password:</p>
	<form name="frmReset" method="post" action="<?=$this->buildURL("admin.processResetUser")?>">
	<input type="hidden" name="pin" value="<?=$rc["pin"]?>">
	<table>
		<tr><td class="formcopy">Your Email:</td>
		<td><input type="text" name="email" class="formbox"></td></tr>
		<tr><td class="formcopy">Your New Password:</td>
		<td><input type="password" name="log1" class="formbox"></td></tr>
		<tr><td class="formcopy">Repeat Password:</td>
		<td><input type="password" name="log2" class="formbox"></td></tr>
		<tr><td colspan="2" class="alright"><input type="button" class="formbutton" onClick="DoReset();" value="Submit"></td></tr>
	</table>
	</form>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/users.js"></script>


