<?

	?><h1>Please Log In</h1>
	<form name="frmLogin" method="post" action="./index.php?action=admin.processLogin">
	<input type="hidden" name="submitted" value="true">
	<table>
		<tr><td class="formcopy">Your Email:</td>
		<td><input type="text" name="email" class="formbox" value="<?=$rc["email"]?>"></td></tr>
		<tr><td class="formcopy">Password:</td>
		<td><input type="password" name="logpw" class="formbox" value="<?=$rc["logpw"]?>"></td></tr>
		<tr><td colspan="2" class="alright"><input type="button" class="formbutton" onClick="Login();" value="Log In"></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2" class="alright"><a href="<?=$this->buildURL("admin.forgotUser")?>">Forgot Password?</a></td></tr>
	</table>
	</form>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/users.js"></script>



