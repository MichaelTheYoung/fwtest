<?

	?><div class="row rowbottom">
		<h3>Work with Users</h3>
		<div class="col-md-6">
			<a href="<?=$this->buildUrl("admin.viewMenu")?>" class="adminLink">Back</a> &nbsp;|&nbsp; <a href="<?=$this->buildURL("admin.formUser?id=0")?>" class="adminLink">Add a New User</a>
		</div>
	</div>
	<div class="row rowbottom">&nbsp;</div>
	<div class="row">
		<div class="col-md-6"><?
		if ($this->open("db")->recCount("tblUser") > 1) {
			?><table class="table table-condensed table-striped">
				<tbody><?
					foreach ($rc["users"] as $user) {
						?><tr class="tableRow">
							<td><a href="<?=$this->buildURL("admin.formUser?id=" . $user["intUserID"])?>" class="adminLink">Edit</a></td>
							<td class="spacer">&nbsp;</td>
							<td><?=$user["vcFName"]?> <?=$user["vcLName"]?></td>
							<td class="spacer">&nbsp;</td>
							<td><a href="#3" onClick="killUser('<?=$user["intUserID"]?>');" class="adminLink">Delete</a></td>
						</tr><?
					}
				?></tbody>
			</table><?
		}
		?></div>
	</div>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/users.js"></script>

