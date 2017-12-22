<?

	?><div class="row">
		<div class="col-md-8">
			<legend>Work with Users</legend>
			<div class="col-md-4 roleFilter">
				<a href="<?=$this->buildUrl("admin.viewMenu")?>">Back</a> &nbsp;|&nbsp; <a href="<?=$this->buildURL("admin.formUser?id=0")?>">Add a New User</a>
			</div><?
			if ($this->open("db")->recCount("tblUser") > 1) {
				?><table id="userTable" class="table table-condensed table-bordered table-striped">
					<thead>
						<tr><th>Click Any User to Edit</th></tr>
					</thead>
					<tbody><?
						foreach ($rc["users"] as $user) {
							?><tr class="tableRow" data-href="<?=$this->buildURL("admin.formUser?id=" . $user["intUserID"])?>">
								<td><?=$user["vcFName"]?> <?=$user["vcLName"]?></td></tr>
							</tr><?
						}
					?></tbody>
				</table>
				<script>
					$(function() {
						setDataTable($("#userTable"));
						$('tbody').on('click', '.tableRow td', function() {
							window.location = $(this).parent().data('href');
						});
					});
				</script><?
			}
		?></div>
	</div>

