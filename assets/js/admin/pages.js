
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
		postItem( "frmEditor", page.silentSave, "saved", "Saved!");
		setTimeout("eraseSaved()", 1500);
	}

	function eraseSaved() {
		document.getElementById("saved").innerHTML = "&nbsp;";
	}

	function getImageBank() {
		getItem(page.getImageBank, "popup-content");
	}

	function getDocBank() {
		getItem(page.getDocumentBank, "popup-content");
	}

	function selectAll(id) {
		document.getElementById(id).focus();
		document.getElementById(id).select();
	}

	function getPreview() {
		document.frmHide.submit();
	}



