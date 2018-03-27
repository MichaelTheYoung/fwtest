<?

	?><div class="row rowbottom">
		<h3>Uploaded Documents</h3>
		<div class="col-md-6">
			<a href="<?=$this->buildUrl("admin.viewMenu")?>" class="adminLink">Back</a> &nbsp;|&nbsp; <a href="<?=$this->buildURL("admin.viewDocForm?id=0")?>" class="adminLink">Upload a New Document</a>
		</div>
	</div>
	<div class="row rowbottom">&nbsp;</div>
	<div class="row">
		<div class="col-md-6"><?
		if ($this->recCount("tblDocument") > 0) {
			?><table class="table table-condensed table-striped">
				<tbody><?
				foreach ($rc["docs"] as $doc) {
					?><tr class="tableRow"">
						<td><?=$doc["vcDocTitle"]?></td>
						<td><a href="<?=$this->buildURL("admin.deleteDoc?id=" . $doc["intDocumentID"])?>" class="adminLink">Delete</a></td></tr>
					</tr><?
				}
				?></tbody>
			</table><?
		}
		?></div>
	</div>

