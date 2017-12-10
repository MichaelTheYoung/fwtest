<?

	?><h1>Work with Users</h1>

	<p><a href="<?=$this->buildURL("admin.viewMenu")?>">Back</a>
		&nbsp;|&nbsp;
	<a href="<?=$this->buildURL("admin.formUser?id=0")?>">Add a User</a></p>

	<table><?

	foreach ($rc["users"] as $user) {
		?><tr><td><a href="<?=$this->buildURL("admin.formUser?id=" . $user["intUserID"])?>">Edit</a></td>
		<td class="spacer">&nbsp;</td>
		<td><?=$user["vcFName"]?> <?=$user["vcLName"]?></td></tr><?
	}

	?></table>


