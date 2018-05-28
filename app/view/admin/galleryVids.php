<?

	?><div class="row">
		<div class="col-md-12">
			<h3>Gallery Videos: <?=$rc["gallery"]["vcTitle"]?></h3>
			<form name="frmAdd" method="post" action="<?=$this->buildUrl("admin.processGalleryVid")?>">
			<input type="hidden" name="intGalleryID" value="<?=$rc["intGalleryID"]?>">

			<div class="row rowbottom">
				<div class="col-md-2 formLabel alright">
					Video Title:
				</div>
				<div class="col-md-4">
					<input type="text" name="vcVidTitle" class="form-control">
				</div>
			</div>

			<div class="row rowbottom">
				<div class="col-md-2 formLabel alright">
					Embed Code:
				</div>
				<div class="col-md-4">
					<textarea name="vcVidCode" class="form-control galleryVidCode"></textarea>
				</div>
			</div>

			<div class="row rowbottom">
				<div class="col-md-6 alright">
					<input type="button" name="cbutton" class="btn btn-primary btn-admin" onClick="document.location.href='<?=$this->buildUrl("admin.listGalleries")?>';" value="Cancel">
					<input type="button" name="sbutton" class="btn btn-primary btn-admin" onClick="checkNewVid();" value="Add New Video">
				</div>
			</div>

			</form>
			<hr style="margin-bottom: 14px;"><?

			if ($rc["vidCount"] > 0) {

				?><form name="frmUpdate" method="post" action="<?=$this->buildUrl("admin.processGalleryOrders")?>">
				<input type="hidden" name="intGalleryID" value="<?=$rc["intGalleryID"]?>">
				<input type="hidden" name="intGType" value="<?=$rc["gallery"]["intGType"]?>"><?

				$counter = 0; $numstring = "";

				foreach ($rc["vids"] as $vid) {

					$numstring = $this->listappend($numstring, $vid["intGalleryItemID"]);

					$counter++;

					if ($counter == 1) {
						?><div class="row rowbottom"><?
					}

					?><div class="galleryVidOuter">

						<div class="galleryVidTop">
							<input type="text" name="title-<?=$vid["intGalleryItemID"]?>" class="form-control" value="<?=$vid["vcVidTitle"]?>">
						</div>
						<img class="galleryVid" src="<?=$this->open('galleryItem')->makeVidThumb($vid["vcVidCode"])?>">
						<div class="vidtop">
							Display Order: <input type="text" name="sort-<?=$vid["intGalleryItemID"]?>" style="width: 40px;" value="<?=$vid["intSortNo"]?>">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="#3" onClick="removeItem('<?=$vid["intGalleryItemID"]?>');">Remove</a>
						</div>

					</div><?

					if ($counter == 2) {
						?></div><?
						$counter = 0;
					}
				}

				if ($counter == 1) {
					?></div><?
				}

				?><input type="hidden" name="numstring" value="<?=$numstring?>">
				<div class="row rowbottom alright" style="margin-top: 20px;">
					<div class="col-md-10" style="padding-right: 80px;">
						<input type="button" name="cbutton" class="btn btn-primary btn-admin" onClick="document.location.href='<?=$this->buildUrl("admin.listGalleries")?>';" value="Cancel">
						<input type="button" name="sbutton" class="btn btn-primary btn-admin" onClick="checkVideos();" value="Save Changes">
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



