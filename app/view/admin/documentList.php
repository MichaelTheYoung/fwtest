<?

	?><div class="row">
		<div class="col-md-8">
			<legend>Uploaded Documents</legend>
			<div class="row rowbottom">
				<a href="<?=$this->buildUrl("admin.viewMenu")?>">Back</a> &nbsp;|&nbsp; <a href="<?=$this->buildURL("admin.viewDocForm?id=0")?>">Upload a New Document</a>
			</div>
			<div class="row rowbottom">&nbsp;</div>
			<div class="row"><?
				if ($this->open("db")->recCount("tblDocument") > 0) {
					?><table id="docTable" class="table table-condensed table-bordered table-striped">
						<tbody><?
							foreach ($rc["docs"] as $doc) {
								?><tr class="tableRow"">
									<td><?=$this->unclean($doc["vcDocTitle"])?></td>
									<td><a href="<?=$this->buildURL("admin.deleteDoc?id=" . $doc["intDocumentID"])?>">Delete</a></td></tr>
								</tr><?
							}
						?></tbody>
					</table><?
				}
			?></div>
		</div>
	</div>
