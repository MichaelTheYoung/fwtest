<? class admin extends fw {

	public function before ($rc) {
		return array(
			"db",
			"util",
			"messenger",
			"userService",
			"userGateway"
		);
	}

	public function index ($rc) {
		if (!isset($rc["email"])) {
			$rc["email"] = ""; $rc["logpw"] = "";
		}
		$rc["view"] = "admin.index";
		return $rc;
	}

	public function processLogin ($rc) {
	if ($this->open("userService")->login($rc)) {
			$this->redirect("admin.viewMenu", $rc);
		} else {
			$this->redirect("admin.index", $rc, true);
		}
	}

	public function processLogout ($rc) {
		$this->open("userService")->logout();
		$this->redirect("admin.index", $rc);
	}

	public function viewMenu ($rc) {
		$rc["view"] = "admin.menu";
		return $rc;
	}

	public function listUsers ($rc) {
		$rc["users"] = $this->open("userService")->loadAll();
		$rc["view"] = "admin.userList";
		return $rc;
	}

	public function formUser ($rc) {

		$rc["user"] = $this->open("userService")->load($rc["id"]);

		$rc["activelist"] = $this->open("util")->getActiveList("formbox", $rc["user"]["intIsActive"]);

		if ($rc["id"] == 0) {
			$rc["button"] = "Add User";
			$rc["verb"] = "Add";
			$rc["user"]["vcLevel"] = "admin";
		} else {
			$rc["button"] = "Save Changes";
			$rc["verb"] = "Edit";
		}

		$rc["view"] = "admin.userForm";
		return $rc;
	}

	public function processUser ($rc) {
		$rc = $this->open("userService")->save($rc);
		$this->redirect("admin.listUsers", $rc);
	}


} ?>