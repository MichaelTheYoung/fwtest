<?

	?><div class="row">
		<div class="col-md-12">
			<legend>Create / Manage Pages</legend>
			<div class="row">
				<div class="col-md-3"><?

					$counter = 0;
					if (is_array($rc["nav"])) {

						$nav = $rc["nav"];

						foreach ($nav as $page) {

							if ($page["intParentID"]== 0) {
								$counter++;
							}
							$page["intParentID"] > 0 ? $indent = " class=\"indent\"" : $indent = "";
							?><p<?=$indent?>><a href="<?=$this->buildUrl("admin.viewPageMaker?intPageID=" . $page["intPageID"])?>"><?=$page["vcNavName"]?></a></p><?
						}
					}
					if ($counter < $GLOBALS["maxPages"]) {
						?><p>&nbsp;</p>
						<p><a href="<?=$this->buildUrl("admin.viewPageMaker?intPageID=0")?>">MAKE A NEW PAGE</a></p><?
					}
					?><a href="<?=$this->buildUrl("admin.viewMenu")?>"><input type="button" class="btn btn-primary" value="Done"></button></a>
				</div>
				<div class="col-md-9"><?
					if (isset($rc["page"])) {

						$rs = $rc["page"];

						?><form name="frmPage" method="post" action="<?=$this->buildUrl("admin.processPageMaker")?>">
						<input type="hidden" name="intPageID" value="<?=$rs["intPageID"]?>">
						<input type="hidden" name="parentID" value="<?=$rs["intParentID"]?>"><?

						if (is_array($rc["nav"])) {

							?><div class="row rowbottom">
								<div class="col-md-3 formLabel alright">
									Parent Page:
								</div>
								<div class="col-md-6">
									<select id="intParentID" name="intParentID" class="form-control">
									<option value="0">This is a Parent Page</option><?

									$nav = $rc["nav"];

									foreach ($nav as $page) {

										if ($page["intParentID"] == 0) {

											?><option value="<?=$page["intPageID"]?>"<?

											if ($page["intPageID"] == $rs["intParentID"]) {
												?> selected<?
											}
											?>><?=$page["vcNavName"]?></option><?
										}
									}

									?></select>
								</div>
							</div><?

						}

						?><div class="row rowbottom">
							<div class="col-md-3 formLabel alright">
								Nav Label:
							</div>
							<div class="col-md-6">
								<input type="text" id="vcNName" name="vcNavName" class="form-control" value="<?=$this->unclean($rs["vcNavName"], 0)?>">
							</div>
						</div>

						<div class="row rowbottom">
							<div class="col-md-3 formLabel alright">
								Page Title:
							</div>
							<div class="col-md-6">
								<input type="text" id="vcTitle" name="vcTitle" class="form-control" value="<?=$this->unclean($rs["vcTitle"], 0)?>">
							</div>
						</div>

						<div class="row rowbottom">
							<div class="col-md-3 formLabel alright">
								Status:
							</div>
							<div class="col-md-6">
								<?=$rc["activelist"]?>
							</div>
						</div>

						<div class="row rowbottom">
							<div class="col-md-3 formLabel alright">
								Sort Order:
							</div>
							<div class="col-md-6">
								<input type="text" id="intSortOrder" name="intSortOrder" class="form-control numbox" value="<?=$this->unclean($rs["intSortOrder"], 0)?>">
							</div>
						</div>

						<div class="row rowbottom">
							<div class="col-md-9 alright">
								<input type="button" class="btn btn-primary" onClick="document.location.href='<?=$this->buildUrl("admin.viewPageMaker")?>';" value="Cancel">
								<input type="button" class="btn btn-primary" onClick="writePage();" value="Save Changes">
							</div>
						</div><?

						if (!is_array($rc["nav"])) {
							?><input type="hidden" name="intParentID" value="<?=$rs["intParentID"]?>"><?
						}

						?><input type="hidden" name="intLevel" value="<?=$rs["intLevel"]?>">
						<input type="hidden" name="vcSection" value="<?=$rs["vcSection"]?>">
						<input type="hidden" name="vcItem" value="<?=$rs["vcItem"]?>">
						<input type="hidden" name="ntBody" value="<?=$rs["ntBody"]?>">

						</form><?
					}

				?></div>
			</div>
		</div>
	</div>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/pages.js"></script>

