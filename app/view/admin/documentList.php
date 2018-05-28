<?

	?><div class="row">
		<div class="col-md-12">
			<h3>Uploaded Documents</h3>
			<p><a href="<?=$this->buildUrl("admin.viewMenu")?>" class="adminLink">Back</a>
			&nbsp;|&nbsp;
			<a href="<?=$this->buildURL("admin.viewDocForm?id=0")?>" class="adminLink">Upload a New Document</a></p><?

			if ($this->recCount("tblDocument") > 0) {
				?><table class="listTable"><?
					foreach ($rc["docs"] as $doc) {
						?><tr><td><?=$doc["vcDocTitle"]?></td>
						<td><a href="<?=$this->buildURL("admin.deleteDoc?id=" . $doc["intDocumentID"])?>">Delete</a></td></tr><?
					}
				?></table><?
			}
		?></div>
	</div>

