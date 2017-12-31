<?

	?><div class="row">
		<div class="col-md-12">
			<legend>Your Admin Options</legend>
			<div class="row">
				<div class="col-md-6">

					<div class="panel panel-primary greyMenuBox">
						<div class="panel-heading greyMenu">Manage Pages</div>
						<div class="list-group">
							<a href="<?=$this->buildUrl("admin.viewPageMaker")?>" class="list-group-item directoryLink">Create / Manage Pages</a>
						</div>
					</div><?

					if (is_array($rc["nav"])) {

						?><div class="panel panel-primary greyMenuBox">
							<div class="panel-heading greyMenu">Edit Page Content</div>
							<div class="list-group"><?

							$nav = $rc["nav"];

							foreach ($nav as $page) {
								$page["intParentID"] > 0 ? $indent = " deepIndent" : $indent = "";
								?><a href="<?=$this->buildUrl("admin.viewPageEditor?intPageID=" . $page["intPageID"])?>" class="list-group-item directoryLink<?=$indent?>"><?=$page["vcNavName"]?></a><?
							}

							?></div>
						</div><?
					}

				?></div>
				<div class="col-md-6">
					<div class="panel panel-primary greyMenuBox">
						<div class="panel-heading greyMenu">Utilities</div>
						<div class="list-group">
							<a href="<?=$this->buildUrl("admin.listUsers")?>" class="list-group-item directoryLink">Work with Users</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


