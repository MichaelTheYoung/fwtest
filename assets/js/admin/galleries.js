

	function checkGallery () {
		var errs = errors.start();
		if (checkNull("frmGallery", "intGType")) {
			errors.plus(errs, "Please select a Gallery Type.");
		}
		if (checkNull("frmGallery", "vcTitle")) {
			errors.plus(errs, "Please enter a Title.");
		}
		var sortNo = document.frmGallery.intSortNo.value;
		if ((isNaN(sortNo)) || (sortNo.trim() == "")) {
			document.frmGallery.intSortNo.value = "0";
		}
		if (!errors.output(errs)) {
			document.frmGallery.cbutton.disabled = true;
			document.frmGallery.sbutton.disabled = true;
			document.frmGallery.submit();
		}
	}

	function checkPics () {
		var ok = 0; var img; var ext;
		var errs = errors.start();
		var pics = new Array();
		for (var i = 1; i <= document.frmUpload.maxuploads.value; i++) {
			if (document.frmUpload["docfile-" + i].value != "") {
				pics.push(document.frmUpload["docfile-" + i].value);
				ok++;
			}
		}
		if (ok == 0) {
			errors.plus(errs, "Please select at least one photo to upload.");
		} else {
			for (var i = 0; i < pics.length; i++) {
				img = pics[0].toLowerCase();
				imgArray = img.split(".");
				ext = imgArray[(imgArray.length - 1)];
				if ((ext != "jpg") && (ext != "jpeg") && (ext != "png")) {
					errors.plus(errs, "Photos must be in JPG, JPEG, or PNG format.");
					break;
				}
			}
		}
		if (!errors.output(errs)) {
			document.getElementById("waiter").style.visibility = "visible";
			document.frmUpload.cbutton.disabled = true;
			document.frmUpload.sbutton.disabled = true;
			document.frmUpload.submit();
		}
	}

	function checkOrders () {
		var sortNo;
		var numstring = document.frmUpdate.numstring.value;
		var arr = numstring.split(",");
		for (var i = 0; i < arr.length; i++) {
			sortNo = document.frmUpdate["sort-" + arr[i]].value;
			if ((isNaN(sortNo)) || (sortNo.trim() == "")) {
				document.frmUpdate["sort-" + arr[i]].value = "0";
			}
		}
		document.frmUpdate.submit();
	}

	function checkVideos () {
		var errs = errors.start();
		var title;
		var numstring = document.frmUpdate.numstring.value;
		var arr = numstring.split(",");
		for (var i = 0; i < arr.length; i++) {
			title = document.frmUpdate["title-" + arr[i]].value;
			if (title.trim() == "") {
				errors.plus(errs, "Each video must have a title.");
				break;
			}
		}
		if (!errors.output(errs)) {
			checkOrders();
		}
	}

	function checkNewVid () {
		var errs = errors.start();
		if (checkNull("frmAdd", "vcVidTitle")) {
			errors.plus(errs, "Please enter a Title.");
		}
		if (checkNull("frmAdd", "vcVidCode")) {
			errors.plus(errs, "Please paste in the Embed Code.");
		}
		if (!errors.output(errs)) {
			document.frmAdd.cbutton.disabled = true;
			document.frmAdd.sbutton.disabled = true;
			document.frmAdd.submit();
		}
	}

	function removeItem (id) {
		if (confirm("This is permanent and can't be reversed!")) {
			document.location.href = PAGE.removeItem + "&intGalleryItemID=" + id + "&intGalleryID=" + document.frmUpdate.intGalleryID.value;
		}
	}

	function removeGallery (id) {
		if (confirm("This is permanent and can't be reversed!")) {
			document.location.href = PAGE.removeGallery + "&intGalleryID=" + id;
		}
	}


