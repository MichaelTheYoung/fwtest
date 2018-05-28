<?
	$counter = 0;

	?><div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
		<h4 class="modal-title profile-htitle">
			Image Bank
		</h4>
	</div>
	<div class="modal-body"><?
		foreach($rc["pics"] as $pic) {

			$counter++;

			if (!$this->isEven($counter)) {
				?><div class="row rowbottom"><?
			}

			?><div class="col-md-6">
				<div class="picThumbBox">
					<img src="<?=$GLOBALS["uploadPath"]?><?=$pic["vcPicFile"]?>" class="picThumbPic">
				</div>
				<input type="text" name="picText<?=$counter?>" id="picText<?=$counter?>" name="picText<?=$counter?>" class="form-control" onClick="selectAll('picText<?=$counter?>')"; value="<?=$GLOBALS["hostPath"]?><?=$GLOBALS["uploadPath"]?><?=$pic["vcPicFile"]?>">
			</div><?


			if ($this->isEven($counter)) {
				?></div><?
			}
		}
		if (!$this->isEven($counter)) {
			?></div><?
		}

	?></div>
	<div class="modal-footer">
		<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	</div>
