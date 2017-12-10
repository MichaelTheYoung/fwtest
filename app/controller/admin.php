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
		$users = new userService;
		if ($users->login($rc)) {
			$this->redirect("admin.viewMenu", $rc);
		} else {
			$this->redirect("admin.index", $rc, true);
		}
	}

	public function processLogout ($rc) {
		$users = new userService;
		$users->logout();
		$this->redirect("admin.index", $rc);
	}

	public function viewMenu ($rc) {
		$rc["view"] = "admin.menu";
		return $rc;
	}

	public function listUsers ($rc) {

		$users = new userService;
		$rc["users"] = $users->loadAll();

		$rc["view"] = "admin.userList";
		return $rc;
	}

	public function formUser ($rc) {

		$users = new userService;
		$rc["user"] = $users->load($rc["id"]);

		$util = new util;
		$rc["activelist"] = $util->getActiveList("formbox", $rc["user"]["intIsActive"]);

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

		$users = new userService;
		$rc = $users->save($rc);

		$this->redirect("admin.listUsers", $rc);
	}


} ?>