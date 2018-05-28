<?

	?><div class="row">
		<div class="col-md-12">
			<h3>Photo / Video Galleries</h3>
			<p><a href="<?=$this->buildUrl('admin.viewMenu')?>">Back</a>
			&nbsp;|&nbsp;
			<a href="<?=$this->buildUrl('admin.viewGalleryForm?id=0')?>">Add a New Gallery</a></p>
			<table class="listTable"><?

			$counter = 0;

			foreach ($rc["picGalleries"] as $gal) {

				$counter++;

				if ($counter == 1) {
					?><tr><td colspan="7"><h4>Photo Galleries</h4></td></tr><?
				}

				?><tr><td><a href="<?=$this->buildUrl('admin.viewGalleryForm?id=' . $gal['intGalleryID'])?>">Edit</a></td>
				<td class="spacer">&nbsp;</td>
				<td><?=$this->unclean($gal["vcTitle"], 0)?></td>
				<td class="spacer">&nbsp;</td>
				<td class="alright"><a href="<?=$this->buildUrl('admin.viewGalleryPics?intGalleryID=' . $gal['intGalleryID'])?>"><?=$gal["itemCount"]?> Photos</a></td>
				<td class="spacer">&nbsp;</td>
				<td><a href="#3" onClick="removeGallery('<?=$gal['intGalleryID']?>');">Delete</a></td></tr><?
			}

			$counter = 0;

			foreach ($rc["vidGalleries"] as $gal) {

				$counter++;

				if ($counter == 1) {
					?><tr><td colspan="7">&nbsp;</td></tr>
					<tr><td colspan="7"><h4>Video Galleries</h4></td></tr><?
				}

				?><tr><td><a href="<?=$this->buildUrl('admin.viewGalleryForm?id=' . $gal['intGalleryID'])?>">Edit</a></td>
				<td class="spacer">&nbsp;</td>
				<td><?=$this->unclean($gal["vcTitle"], 0)?></td>
				<td class="spacer">&nbsp;</td>
				<td class="alright"><a href="<?=$this->buildUrl('admin.viewGalleryVids?intGalleryID=' . $gal['intGalleryID'])?>"><?=$gal["itemCount"]?> Videos</a></td>
				<td class="spacer">&nbsp;</td>
				<td><a href="#3" onClick="removeGallery('<?=$gal['intGalleryID']?>');">Delete</a></td></tr><?
			}
			?></table>
		</div>
	</div>
	<script>
		var PAGE = {
			removeGallery : "<?=$this->buildUrl('admin.removeGallery')?>"
		};
	</script>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/galleries.js"></script>





