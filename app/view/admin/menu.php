<?

	?><div class="row">
		<div class="col-md-12">
			<h3>Your Admin Options</h3>
			<div class="row">
				<div class="col-md-6">

					<div class="panel panel-primary menuBox">
						<div class="panel-heading menu">Manage Pages</div>
						<div class="list-group">
							<a href="<?=$this->buildUrl("admin.viewPageMaker")?>" class="list-group-item adminLink">Create / Manage Pages</a>
						</div>
					</div><?

					if (is_array($rc["nav"])) {

						?><div class="panel panel-primary menuBox">
							<div class="panel-heading menu">Edit Page Content</div>
							<div class="list-group"><?

							$nav = $rc["nav"];

							foreach ($nav as $page) {
								$page["intParentID"] > 0 ? $indent = " deepIndent" : $indent = "";
								?><a href="<?=$this->buildUrl("admin.viewPageEditor?intPageID=" . $page["intPageID"])?>" class="list-group-item adminLink"><?=$page["vcNavName"]?></a><?
							}

							?></div>
						</div><?
					}

				?></div>
				<div class="col-md-6">
					<div class="panel panel-primary menuBox">
						<div class="panel-heading menu">Utilities</div>
						<div class="list-group">
							<a href="<?=$this->buildUrl("admin.listUsers")?>" class="list-group-item adminLink">Work with Users</a>
							<a href="<?=$this->buildUrl("admin.viewDocList")?>" class="list-group-item adminLink">Uploaded Documents</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


