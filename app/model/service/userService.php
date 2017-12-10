<? class userService extends fw {


	private function create ($rc) {
		$rc["vcPin"] = $this->makePin();
		$rc["vcLogPW"] = $this->makePassword($rc["vcLogPW"]);
		$obj = new userGateway;
		return $obj->create($rc);
	}

	private function update ($rc) {
		$obj = new userGateway;
		$obj->update($rc);
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
		$obj = new userGateway;
		return $obj->load($id);
	}

	public function loadAll () {
		$obj = new userGateway;
		return $obj->loadAll();
	}

	public function makePassword ($pw) {
		return hash("SHA256", substr($pw, 0, 2)) . hash("SHA256", $pw);
	}

	public function makePin () {
		return substr(time(), -4);
	}

	public function getPin ($email) {
		$RS["Pin"] = "";
		$obj = new userGateway;
		if ($RS = $obj->loadAll($email)) {
			return $RS["Pin"];
		}
		return $RS;
	}

	public function login ($rc) {
		if (isset($_SESSION["user"])) {
			unset($_SESSION["user"]);
		}
		$rc["logpw"] = $this->makePassword($rc["logpw"]);
		$obj = new userGateway;
		$id = $obj->login($rc);
		if ($id == 0) {
			$obj = new messenger;
			$obj->addMessage("Login failed.");
			return false;
		}
		$this->makeUserSession($id);
		return true;
	}

	public function makeUserSession ($id) {
		$user = $this->load($id);
		$_SESSION["user"]["level"] = $user["vcLevel"];
		$_SESSION["user"]["fname"] = $user["vcFName"];
		$_SESSION["user"]["lname"] = $user["vcLName"];
	}

	public function logout () {
		if (isset($_SESSION["user"])) {
			unset($_SESSION["user"]);
		}
	}

} ?>


