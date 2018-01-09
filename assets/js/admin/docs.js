

	function checkDoc() {
		var errs = errors.start();
		if (checkNull("frmDoc", "vcDocTitle")) {
			errors.plus(errs, "Please enter a Document Title.");
		}
		if (checkNull("frmDoc", "docfile")) {
			errors.plus(errs, "Please select a Document File.");
		}
		if (!errors.output(errs)) {
			document.frmDoc.submit();
		}
	}


