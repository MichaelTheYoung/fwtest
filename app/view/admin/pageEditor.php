<?

	?><div class="row rowbottom">
		<h3>Edit Page: <?=$rc["page"]["vcTitle"]?></h3>
	</div>

	<div class="row rowbottom">
		<p><a href="<?=$this->buildUrl("admin.viewMenu")?>" class="adminLink">Back</a>
		&nbsp;|&nbsp;
		<a href="#3" onClick="GetImageBank();" class="adminLink">Image Bank</a>
		&nbsp;|&nbsp;
		<a href="#3" data-toggle="modal" data-target="#popup" onClick="getDocBank();" class="adminLink">Document Bank</a>
		&nbsp;|&nbsp;
		<a href="#3" onClick="GetPreview();" class="adminLink">Preview Page</a></p>
	</div>

	<script src="<?=$GLOBALS["editorPath"]?>ckeditor.js"></script>

	<form name="frmEditor" method="post" action="<?=$this->buildUrl("admin.processPageEditor")?>">
	<input type="hidden" name="intPageID" value="<?=$rc["page"]["intPageID"]?>">
	<input type="hidden" name="otherbody" value="">

	<div class="row rowbottom">
		<textarea id="ntBody" name="ntBody" class="form-control" style="width: 100%; height: 600px; resize: none;"><?=$rc["page"]["ntBody"]?></textarea>
	</div>

	<div class="row rowbottom alright">
		<a href="<?=$this->buildUrl("admin.viewMenu")?>" class="btn btn-primary btn-admin">Cancel</a>
		<input type="button" class="btn btn-primary btn-admin" onClick="savePage();" value="Save Changes">
		<input type="button" class="btn btn-primary btn-admin" onClick="checkEditor('ntBody');" value="Save and Exit">
	</div>

	<div id="saved" class="row rowbottom alright">&nbsp;</div>

	<script>
		CKEDITOR.replace("ntBody");

		var page = new Object;
		page.silentSave = "<?=$this->buildUrl("admin.processSilentPage")?>";
		page.getDocumentBank = "<?=$this->buildUrl("admin.getDocumentBank")?>";

	</script>
	</form>

	<form name="frmHide" method="post" action="<?=$this->buildUrl("admin.viewPagePreview")?>" target="_blank">
	<input type="hidden" name="id" value="<?=$rc["intPageID"]?>">
	</form>


	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/pages.js"></script>

