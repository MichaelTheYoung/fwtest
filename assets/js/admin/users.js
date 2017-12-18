
	function Login() {
		if (CheckNull("frmLogin", "email", "Please enter your Email address first.")) {
			return false;
		}
		if (CheckNull("frmLogin", "logpw", "Please enter your Password first.")) {
			return false;
		}
		if (CheckEmail("frmLogin", "email", "That Email doesn't look valid.")) {
			return false;
		}
		document.frmLogin.submit();
	}

	function Forgot() {
		if (CheckNull("frmForgot", "email", "Please enter your Email address first.")) {
			return false;
		}
		if (CheckEmail("frmForgot", "email", "That Email doesn't look valid.")) {
			return false;
		}
		document.frmForgot.submit();
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


		document.frmUser.submit();
	}

	function DoReset() {
		if (CheckNull("frmReset", "email", "Please enter your email first.")) {
			return false;
		}
		if (CheckEmail("frmReset", "email", "That email doesn't look valid.")) {
			return false;
		}
		if (CheckNull("frmReset", "log1", "Please enter your new password first.")) {
			return false;
		}
		if (CheckNull("frmReset", "log2", "Please repeat your new password.")) {
			return false;
		}
		if (trimit(document.frmReset.log1.value) != trimit(document.frmReset.log2.value)) {
			alert("The two entries of your password do not match.");
			return false;
		}

		document.frmReset.submit();
	}
