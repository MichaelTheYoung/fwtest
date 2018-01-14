<?

	?><div class="row">
		<div class="col-md-8">
			<legend>Work with Users</legend>
			<div class="col-md-4 roleFilter">
				<a href="<?=$this->buildUrl("admin.viewMenu")?>">Back</a> &nbsp;|&nbsp; <a href="<?=$this->buildURL("admin.formUser?id=0")?>">Add a New User</a>
			</div><?
			if ($this->open("db")->recCount("tblUser") > 1) {
				?><table id="userTable" class="table table-condensed table-striped">
					<thead><tr><td>&nbsp;</td></tr></thead>
					<tbody><?
						foreach ($rc["users"] as $user) {
							?><tr class="tableRow">
								<td><a href="<?=$this->buildURL("admin.formUser?id=" . $user["intUserID"])?>">Edit</a></td>
								<td class="spacer">&nbsp;</td>
								<td><?=$user["vcFName"]?> <?=$user["vcLName"]?></td>
								<td class="spacer">&nbsp;</td>
								<td><a href="#3" onClick="killUser('<?=$user["intUserID"]?>');">Delete</a></td>
							</tr><?
						}
					?></tbody>
				</table><?
			}
		?></div>
	</div>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/users.js"></script>

