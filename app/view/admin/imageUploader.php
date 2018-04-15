<?

	?><div class="row">
		<div class="col-md-12">
			<h3>Image Bank Uploader</h3>
			<form name="frmUpload" enctype="multipart/form-data" method="post" action="<?=$this->buildUrl("admin.processImageUpload")?>">
			<input type="hidden" name="maxuploads" value="<?=$rc["maxuploads"]?>"><?

			for ($i = 1; $i <= $rc["maxuploads"]; $i++) {
				?><div class="row rowbottom">
					<div class="col-md-2 formLabel alright">
						Photo <?=$i?>:
					</div>
					<div class="col-md-4">
						<input type="file" name="docfile-<?=$i?>" class="form-control">
					</div>
				</div><?
			}

			?><div class="row rowbottom">
				<div class="col-md-6 alright">
					<img id="waiter" src="<?=$GLOBALS["assetsPath"]?>img/wait.gif">
					<input type="button" name="cbutton" class="btn btn-primary btn-admin" onClick="document.location.href='<?=$this->buildUrl("admin.viewMenu")?>';" value="Cancel">
					<input type="button" name="sbutton" class="btn btn-primary btn-admin" onClick="checkPics();" value="Upload Photos">
				</div>
			</div>
			</form>
			<hr style="margin-bottom: 14px;">
		</div>
	</div><?

	if (count($rc["pics"]) > 0) {

		$counter = 0;
		foreach ($rc["pics"] as $pic) {
			$counter++;
			if ($counter == 1) {
				?><div class="row rowbottom">
					<div class="col-md-12"><?
			}
			?><div class="col-md-3">
				<div class="picThumbBox">
					<img src="<?=$GLOBALS["uploadPath"]?><?=$pic["vcPicFile"]?>" class="picThumbPic">
				</div>
				<div class="picThumbLink"><?
					if (in_array($pic["vcPicFile"], $rc["usedPics"])) {
						?>In Use<?
					} else {
						?><a href="#3" onClick="killPic('<?=$pic["intImageID"]?>');">Remove</a><?
					}
				?></div>
			</div><?
			if ($counter == 4) {
					?></div>
				</div><?
				$counter = 0;
			}
		}
	}
	?><br><br>

	<script>
		PAGE = {
			"removePic" : "<?=$this->buildUrl("admin.removeImage")?>"
		};

	</script>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/images.js"></script>

