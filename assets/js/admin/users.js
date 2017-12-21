
	function Login() {
		var errs = errors.start();
		if (checkEmail("frmLogin", "email")) {
			errors.plus(errs, "That email doesn't look valid.");
		}
		if (checkNull("frmLogin", "logpw")) {
			errors.plus(errs, "Please enter your Password.");
		}
		if (!errors.output(errs)) {
			document.frmLogin.submit();
		}
	}

	function Forgot() {
		var errs = errors.start();
		if (checkEmail("frmForgot", "email")) {
			errors.plus(errs, "That email doesn't look valid.");
		}
		if (!errors.output(errs)) {
			document.frmForgot.submit();
		}
	}

	function DoneForgot() {
		document.location.href = "index.php?action=admin";
	}

	function KillUser(id) {
		if (confirm("This is permanent and can't be reversed!")) {
			document.location.href = "index.php?action=admin.userlist&del=" + id;
		}
	}

	function WriteUser() {
		var errs = errors.start();
		if (checkNull("frmUser", "vcFName")) {
			errors.plus(errs, "Please enter the First Name.");
		}
		if (checkNull("frmUser", "vcLName")) {
			errors.plus(errs, "Please enter the Last Name.");
		}
		if (checkEmail("frmUser", "vcEmail")) {
			errors.plus(errs, "That email doesn't look valid.");
		}
		if (document.frmUser.vcLogPW) {
			if (checkNull("frmUser", "vcLogPW")) {
				errors.plus(errs, "Please enter a Password.");
			}
		}
		if (!errors.output(errs)) {
			document.frmUser.submit();
		}
	}

	function DoReset() {
		var errs = errors.start();
		if (checkEmail("frmReset", "email")) {
			errors.plus(errs, "That email doesn't look valid.");
		}
		if (checkNull("frmReset", "log1")) {
			errors.plus(errs, "Please enter your new Password.");
		}
		if (checkNull("frmReset", "log2")) {
			errors.plus(errs, "Please repeat your new Password.");
		}
		if (trimit(document.frmReset.log1.value) != trimit(document.frmReset.log2.value)) {
			errors.plus(errs, "The two entries of your password do not match.");
		}
		if (!errors.output(errs)) {
			document.frmReset.submit();
		}
	}
