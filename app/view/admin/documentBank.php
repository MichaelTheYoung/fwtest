<?

	?><div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
		<h4 class="modal-title profile-htitle">
			Document Bank
		</h4>
	</div>
	<div class="modal-body"><?
		foreach($rc["docs"] as $doc) {
			?><div class="row rowbottom">
				<div class="col-md-10">
					<h4><?=$this->unclean($doc["vcDocTitle"], 0)?></h4>
					<input type="text" name="doc<?=$doc["intDocumentID"]?>" id="doc<?=$doc["intDocumentID"]?>" onClick="selectAll('doc<?=$doc["intDocumentID"]?>');" value="<?=$GLOBALS["hostPath"]?><?=$GLOBALS["uploadPath"]?><?=$doc["vcDocFile"]?>">
				</div>
			</div><?
		}
	?></div>
	<div class="modal-footer">
		<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	</div>

