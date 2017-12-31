<?

	?><div class="row rowbottom">
		<legend>Edit Page: <?=$rc["page"]["vcTitle"]?></legend>
	</div>

	<div class="row rowbottom">
		<p><a href="<?=$this->buildUrl("admin.viewMenu")?>">Back</a>
		&nbsp;|&nbsp;
		<a href="#3" onClick="GetImageBank();">Image Bank</a>
		&nbsp;|&nbsp;
		<a href="#3" onClick="GetDocBank();">Document Bank</a>
		&nbsp;|&nbsp;
		<a href="#3" onClick="GetPreview();">Preview Page</a></p>
	</div>

	<script src="<?=$GLOBALS["editorPath"]?>ckeditor.js"></script>

	<form name="frmEditor" method="post" action="<?=$this->buildUrl("admin.processPageEditor")?>">
	<input type="hidden" name="intPageID" value="<?=$rc["page"]["intPageID"]?>">
	<input type="hidden" name="otherbody" value="">

	<div class="row rowbottom">
		<textarea id="ntBody" name="ntBody" class="form-control" style="width: 100%; height: 600px; resize: none;"><?=$this->wunclean($rc["page"]["ntBody"])?></textarea>
	</div>

	<div class="row rowbottom alright">
		<input type="button" class="btn btn-primary" onClick="savePage();" value="Save Changes">
		<input type="button" class="btn btn-primary" onClick="checkEditor('ntBody');" value="Save and Exit">
	</div>

	<div id="saved" class="row rowbottom alright">&nbsp;</div>

	<script>
		CKEDITOR.replace("ntBody");

		var page = new Object;
		page.silentSave = "<?=$this->buildUrl("admin.processSilentPage")?>";

	</script>
	</form>

	<form name="frmHide" method="post" action="<?=$this->buildUrl("admin.viewPagePreview")?>" target="_blank">
	<input type="hidden" name="id" value="<?=$rc["intPageID"]?>">
	</form>


	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/pages.js"></script>

