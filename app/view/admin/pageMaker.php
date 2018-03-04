<?

	?><div class="row">
		<div class="col-md-12">
			<h3>Create / Manage Pages</h3>
			<div class="row">
				<div class="col-md-3"><div class="panel panel-primary menuBox">
					<div class="panel-heading menu">Existing Pages</div>
					<div class="list-group"><?

						$counter = 0;
						if (is_array($rc["nav"])) {

							$nav = $rc["nav"];

							foreach ($nav as $page) {

								if ($page["intParentID"]== 0) {
									$counter++;
								}
								$page["intParentID"] > 0 ? $indent = " indent" : $indent = "";
								?><a href="<?=$this->buildUrl("admin.viewPageMaker?intPageID=" . $page["intPageID"])?>" class="list-group-item adminLink<?=$indent?>"><?=$page["vcNavName"]?></a><?
							}
						}
						if ($counter < $GLOBALS["maxPages"]) {
							?><br><br><a href="<?=$this->buildUrl("admin.viewPageMaker?intPageID=0")?>" class="list-group-item adminLink">MAKE A NEW PAGE</a><?
						}
						?><a href="<?=$this->buildUrl("admin.viewMenu")?>"><input type="button" class="btn btn-primary btn-admin btn-pager" value="Done"></button></a>
					</div>
				</div></div>
				<div class="col-md-9"><?
					if (isset($rc["page"])) {

						?><div class="panel panel-primary menuBox">
							<div class="panel-heading menu">
								<?=$rc["verb"]?> Page
							</div><br><br>
							<div class="list-group"><?

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
									<input type="text" id="vcNName" name="vcNavName" class="form-control" value="<?=$rs["vcNavName"]?>">
								</div>
							</div>

							<div class="row rowbottom">
								<div class="col-md-3 formLabel alright">
									Page Title:
								</div>
								<div class="col-md-6">
									<input type="text" id="vcTitle" name="vcTitle" class="form-control" value="<?=$rs["vcTitle"]?>">
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
									<input type="text" id="intSortOrder" name="intSortOrder" class="form-control numbox" value="<?=$rs["intSortOrder"]?>">
								</div>
							</div>

							<div class="row rowbottom">
								<div class="col-md-9 alright">
									<input type="button" class="btn btn-primary btn-admin btn-pager" onClick="document.location.href='<?=$this->buildUrl("admin.viewPageMaker")?>';" value="Cancel">
									<input type="button" class="btn btn-primary btn-admin btn-pager" onClick="writePage();" value="<?=$rc["button"]?>">
								</div>
							</div><?

							if (!is_array($rc["nav"])) {
								?><input type="hidden" name="intParentID" value="<?=$rs["intParentID"]?>"><?
							}

							?><input type="hidden" name="intLevel" value="<?=$rs["intLevel"]?>">
							<input type="hidden" name="vcSection" value="<?=$rs["vcSection"]?>">
							<input type="hidden" name="vcItem" value="<?=$rs["vcItem"]?>">
							<input type="hidden" name="ntBody" value='<?=$rs["ntBody"]?>'>

							</form>
						</div><?

					}

				?></div>
			</div>
		</div>
	</div>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/pages.js"></script>

