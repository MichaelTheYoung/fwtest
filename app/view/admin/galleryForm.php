<?

	?><div class="row">
		<div class="col-md-12">
			<h3><?=$rc["verb"]?> Gallery</h3>

			<form name="frmGallery" method="post" action="<?=$this->buildUrl('admin.processGalleryForm')?>">
			<input type="hidden" name="intGalleryID" value="<?=$rc["gallery"]["intGalleryID"]?>">

			<div class="row rowbottom">
				<div class="col-md-2 formLabel alright">
					Status:
				</div>
				<div class="col-md-4">
					<?=$rc["activeList"]?>
				</div>
			</div>

			<div class="row rowbottom">
				<div class="col-md-2 formLabel alright">
					Gallery Type:
				</div>
				<div class="col-md-4">
					<select name="intGType" class="form-control">
					<option value="">Select...</option><?
					while (list($key, $val) = each($rc["typeList"])) {
						$sel = $rc["gallery"]["intGType"] == $key ? "selected" : "";
						?><option value="<?=$key?>"<?=$sel?>><?=$val?></option><?
					}
					?></select>
				</div>
			</div>

			<div class="row rowbottom">
				<div class="col-md-2 formLabel alright">
					Gallery Title
				</div>
				<div class="col-md-4">
					<input type="text" name="vcTitle" class="form-control" value="<?=$rc["gallery"]["vcTitle"]?>">
				</div>
			</div>

			<div class="row rowbottom">
				<div class="col-md-2 formLabel alright">
					Display Order
				</div>
				<div class="col-md-4">
					<input type="text" name="intSortNo" class="form-control" style="width: 50px;" value="<?=$rc["gallery"]["intSortNo"]?>">
				</div>
			</div>

			<div class="row rowbottom">
				<div class="col-md-6 alright">
					<input type="button" name="cbutton" class="btn btn-primary btn-admin" onClick="document.location.href='<?=$this->buildUrl("admin.listGalleries")?>';" value="Cancel">
					<input type="button" name="sbutton" class="btn btn-primary btn-admin" onClick="checkGallery();" value="<?=$rc["button"]?>">
				</div>
			</div>

			</form>
		</div>
	</div>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/galleries.js"></script>

