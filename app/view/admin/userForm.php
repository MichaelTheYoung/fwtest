<?
	$rs = $rc["user"];

	?><h1><?=$rc["verb"]?> User</h1>

	<form name="frmUser" method="post" action="<?=$this->buildUrl("admin.processUser")?>">
	<input type="hidden" name="intUserID" value="<?=$rs["intUserID"]?>">
	<input type="hidden" name="vcLevel" value="<?=$rs["vcLevel"]?>">
	<input type="hidden" name="submitted" value="true">
	<table class="formtable">
		<tr><td class="formcopy">Status:</td>
		<td><?=$rc["activelist"]?></tr>
		<tr><td class="formcopy">First Name:</td>
		<td><input type="text" name="vcFName" class="formbox" value="<?=$this->unclean($rs["vcFName"], 0)?>"></td></tr>
		<tr><td class="formcopy">Last Name:</td>
		<td><input type="text" name="vcLName" class="formbox" value="<?=$this->unclean($rs["vcLName"], 0)?>"></td></tr>
		<tr><td class="formcopy">Email:</td>
		<td><input type="text" name="vcEmail" class="formbox" value="<?=$this->unclean($rs["vcEmail"], 0)?>"></td></tr><?
		if ($rs["intUserID"] == 0) {
			?><tr><td class="formcopy">Password:</td>
			<td><input type="text" name="vcLogPW" class="formbox"></td></tr><?
		}
		?><tr><td colspan="2" class="alright">
			<input type="button" class="formbutton" onClick="document.location.href='<?=$this->buildUrl("admin.listUsers")?>';" value="Cancel">
			<input type="button" class="formbutton" onClick="WriteUser();" value="<?=$rc["button"]?>">
		</td></tr>
	</table>
	</form>


