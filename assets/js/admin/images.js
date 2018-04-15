
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

	function killPic (id) {
		if (confirm("This is permanent and can't be reversed!")) {
			document.location.href = PAGE.removePic + "&id=" + id;
		}
	}


