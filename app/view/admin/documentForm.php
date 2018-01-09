<?

	?><div class="row">
		<div class="col-md-12">
			<legend>Upload a Document</legend>
			<form name="frmDoc" enctype="multipart/form-data" method="post" action="<?=$this->buildUrl("admin.processDocForm")?>">
			<div class="row rowbottom">
				<div class="col-md-2 formLabel alright">
					Document Title:
				</div>
				<div class="col-md-4">
					<input type="text" id="vcDocTitle" name="vcDocTitle" class="form-control" value="<?=$this->unclean($rc["doc"]["vcDocTitle"], 0)?>">
				</div>
			</div>
			<div class="row rowbottom">
				<div class="col-md-2 formLabel alright">
					Document File:
				</div>
				<div class="col-md-4">
					<input type="file" id="docfile" name="docfile" class="form-control">
				</div>
			</div>
			<div class="row rowbottom">
				<div class="col-md-6 alright">
					<input type="button" class="btn btn-primary" onClick="document.location.href='<?=$this->buildUrl("admin.viewDocList")?>';" value="Cancel">
					<input type="button" class="btn btn-primary" onClick="checkDoc();" value="Upload Document">
				</div>
			</div>
			</form>
		</div>
	</div>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/docs.js"></script>

