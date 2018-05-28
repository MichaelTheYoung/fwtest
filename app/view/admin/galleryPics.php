<?

	?><div class="row">
		<div class="col-md-12">
			<h3>Gallery Photos: <?=$rc["gallery"]["vcTitle"]?></h3>
			<form name="frmUpload" enctype="multipart/form-data" method="post" action="<?=$this->buildUrl("admin.processGalleryPics")?>">
			<input type="hidden" name="intGalleryID" value="<?=$rc["intGalleryID"]?>">
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
					<input type="button" name="cbutton" class="btn btn-primary btn-admin" onClick="document.location.href='<?=$this->buildUrl("admin.listGalleries")?>';" value="Cancel">
					<input type="button" name="sbutton" class="btn btn-primary btn-admin" onClick="checkPics();" value="Upload Photos">
				</div>
			</div>
			</form>
			<hr style="margin-bottom: 14px;"><?

			if ($rc["picCount"] > 0) {

				?><form name="frmUpdate" method="post" action="<?=$this->buildUrl("admin.processGalleryOrders")?>">
				<input type="hidden" name="intGalleryID" value="<?=$rc["intGalleryID"]?>">
				<input type="hidden" name="intGType" value="<?=$rc["gallery"]["intGType"]?>"><?

				$counter = 0; $numstring = "";

				foreach ($rc["pics"] as $pic) {

					$numstring = $this->listappend($numstring, $pic["intGalleryItemID"]);

					$counter++;

					if ($counter == 1) {
						?><div class="row rowbottom"><?
					}

					?><div class="galleryPicBox">

						<div class="galleryPicName">
							<?=$pic["vcPicFile"]?>
						</div>

						<div class="galleryPicContainer">
							<img src="<?=$GLOBALS["uploadPath"]?><?=$pic["vcPicFile"]?>" class="galleryPic">
						</div>

						<div class="galleryPicBottom">
							Display Order: <input type="text" name="sort-<?=$pic["intGalleryItemID"]?>" style="width: 40px;" value="<?=$pic["intSortNo"]?>">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="#3" onClick="removeItem('<?=$pic["intGalleryItemID"]?>');">Remove</a>
						</div>

					</div><?

					if ($counter == 2) {
						?></div><?
						$counter = 0;
					}

					?><input type="hidden" name="title-<?=$pic["intGalleryItemID"]?>" value="<?=$pic["vcVidTitle"]?>"><?

				}

				if ($counter == 1) {
					?></div><?
				}

				?><input type="hidden" name="numstring" value="<?=$numstring?>">
				<div class="row rowbottom alright">
					<div class="col-md-9" style="padding-right: 38px;">
						<input type="button" name="cbutton" class="btn btn-primary btn-admin" onClick="document.location.href='<?=$this->buildUrl("admin.listGalleries")?>';" value="Cancel">
						<input type="button" name="sbutton" class="btn btn-primary btn-admin" onClick="checkOrders();" value="Save Changes">
					</div>
				</div>
				</form><?
			}

		?></div>
		<div class="bottomSpace">&nbsp;</div>
	</div>
	<script>
		var PAGE = {
			removeItem : "<?=$this->buildUrl('admin.removeGalleryItem')?>"
		};
	</script>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/galleries.js"></script>


