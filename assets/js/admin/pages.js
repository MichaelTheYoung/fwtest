
	if (document.getElementById("intParentID") != null) {
		document.frmPage.intParentID.value = document.frmPage.parentID.value;
	}

	function writePage() {
		var errs = errors.start();
		if (checkNull("frmPage", "vcNavName")) {
			errors.plus(errs, "Please enter the Nav Label.");
		}
		if (checkNull("frmPage", "vcTitle")) {
			errors.plus(errs, "Please enter the Page Title.");
		}
		if (notInteger("frmPage", "intSortOrder")) {
			document.frmPage.intSortOrder.value = "0";
		}
		if (document.frmPage.intParentID.value > 0) {
			document.frmPage.intLevel.value = 2;
		} else {
			document.frmPage.intLevel.value = 1;
		}
		if (!errors.output(errs)) {
			document.frmPage.submit();
		}
	}

	function checkEditor(where) {
		var tmp = CKEDITOR.instances[where].getData();
		var para = "<p>&nbsp;</p>";
		tmp = tmp.replace(para, "");
		if (IsNull(tmp)) {
			alert("Your entry is empty. You can do that if you want to. Just letting you know.");
		}
		document.frmEditor.submit();
	}

	function savePage() {
		document.frmEditor.otherbody.value = CKEDITOR.instances["ntBody"].getData();
		PostItem(page.silentSave, "frmEditor", "saved");
		setTimeout("eraseSaved()", 1500);
	}

	function eraseSaved() {
		document.getElementById("saved").innerHTML = "&nbsp;";
	}

	function getImageBank() {
		var whole = screen.width;
		var left = ((whole - 280) - 100);
		var top = 20;
		var wide = 280;
		var high = 700;
	//	DoBox2('index.php?action=admin.imagebank', wide, high, top, left);
	}

	function getDocBank() {
		var whole = screen.width;
		var left = ((whole - 300) - 100);
		var top = 20;
		var wide = 350;
		var high = 700;
	//	DoBox2('index.php?action=admin.docbank', wide, high, top, left);
	}

	function getPreview() {
		document.frmHide.submit();
	}



