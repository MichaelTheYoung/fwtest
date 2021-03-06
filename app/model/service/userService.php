<? class users extends core {

	private function create ($rc) {
		$rc["vcPin"] = $this->makePin();
		$rc["vcLogPW"] = $this->makePassword($rc["vcLogPW"]);
		$this->open("userQry")->create($rc);
	}

	private function update ($rc) {
		$this->open("userQry")->update($rc);
	}

	public function save ($rc, $sendback = false) {
		if ($rc["intUserID"] == 0) {
			$id = $this->create($rc);
		} else {
			$this->update($rc);
			$id = $rc["intUserID"];
		}
		if ($sendback) {
			return $this->load($id);
		}
	}

	public function load ($id) {
		return $this->open("userQry")->load($id);
	}

	public function loadAll () {
		return $this->open("userQry")->loadAll();
	}

	public function makePassword ($pw) {
		return hash("SHA256", substr($pw, 0, 2)) . hash("SHA256", $pw);
	}

	public function makePin () {
		return substr(time(), -4);
	}

	public function getPin ($email) {
		$RS["Pin"] = "";
		if ($RS = $this->open("userQry")->getPin($email)) {
			return $RS["Pin"];
		}
		return $RS;
	}

	public function login ($rc) {
		if (isset($_SESSION["user"])) {
			unset($_SESSION["user"]);
		}
		$rc["logpw"] = $this->makePassword($rc["logpw"]);
		$id = $this->open("userQry")->login($rc);
		if ($id == 0) {
			$this->open("messenger")->addMessage("Login failed.");
			return false;
		}
		$this->makeUserSession($id);
		return true;
	}

	public function makeUserSession ($id) {
		$user = $this->load($id);
		$_SESSION["user"]["userid"] = $user["intUserID"];
		$_SESSION["user"]["level"] = $user["vcLevel"];
		$_SESSION["user"]["fname"] = $user["vcFName"];
		$_SESSION["user"]["lname"] = $user["vcLName"];
	}

	public function logout () {
		if (isset($_SESSION["user"])) {
			unset($_SESSION["user"]);
		}
	}

	public function forgot ($email) {

		$rs = $this->open("userQry")->getPin($email);

		if (strlen($rs["vcPin"])) {

			$header = "From: no-reply@" . $GLOBALS["appDomain"] . "\r\n";
			$subject = "Login Information";
			$msg = "Use this link to reset your password:\n\n";
			$msg .= $GLOBALS["hostPath"] . "index.php?action=admin.resetUser&pin=" . $pin . "\n\n";
			$msg = stripslashes($msg);
			if ($GLOBALS["useMail"] == "yes") {
				mail($email, $subject, $msg, $header);
			}

			$this->open("messenger")->addMessage("A link to reset your password has been sent to you at " . $email . ".", "confirm");
		} else {
			$this->open("messenger")->addMessage("We have no record of the email " . $email . ".");
		}
	}

	public function resetPassword ($email, $pin, $log1) {
		if ($rs = $this->open("userQry")->getUserByEmailAndPin($email, $pin)) {

			$rc["user"] = $this->load($rs["intUserID"]);
			$rc["user"]["vcLogPW"] = $this->makePassword($log1);

			$rc = $this->populate($rc, $rc["user"]);
			$rc = $this->save($rc);

			return true;
		}
		return false;
	}

	public function deleteUser ($id) {
		$this->open("userQry")->deleteUser($id);
	}

} ?>


