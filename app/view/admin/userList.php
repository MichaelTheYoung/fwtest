<?

	?><div class="row">
		<div class="col-md-12">
			<h3>Work with Users</h3>
			<p><a href="<?=$this->buildUrl("admin.viewMenu")?>" class="adminLink">Back</a>
			&nbsp;|&nbsp;
			<a href="<?=$this->buildURL("admin.formUser?id=0")?>" class="adminLink">Add a New User</a></p><?

			if ($this->recCount("tblUser") > 1) {
				?><table class="listTable"><?
				foreach ($rc["users"] as $user) {
					?><tr>
						<td><a href="<?=$this->buildURL("admin.formUser?id=" . $user["intUserID"])?>">Edit</a></td>
						<td class="spacer">&nbsp;</td>
						<td><?=$user["vcFName"]?> <?=$user["vcLName"]?></td>
						<td class="spacer">&nbsp;</td>
						<td><a href="#3" onClick="killUser('<?=$user["intUserID"]?>');">Delete</a></td>
					</tr><?
				}
				?></table><?
			}

		?></div>
	</div>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/users.js"></script>

