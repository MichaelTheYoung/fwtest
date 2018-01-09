<? class admin extends core {

	public function before ($rc) {
		return array(
			"dbService",
			"utilityService",
			"messengerService",
			"userService",
			"userGateway",
			"pageService",
			"pageGateway",
			"documentService",
			"documentGateway"
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

		if ($this->open("db")->recCount("tblUser") == 0) {
			$rc["firstuser"] = true;
			$this->open("messenger")->addMessage("You are the first user. Create your account and you will have access to everything.", "confirm");
			$this->redirect("admin.formUser&id=0", $rc, true);
		}

		if ($this->open("users")->login($rc)) {
			$this->redirect("admin.viewMenu", $rc);
		} else {
			$this->redirect("admin", $rc, true);
		}
	}

	public function processLogout ($rc) {
		$this->open("users")->logout();
		$this->redirect("admin", $rc);
	}

	public function viewMenu ($rc) {

		$rc["nav"] = $this->open("pages")->loadAll();

		$rc["view"] = "admin.menu";
		return $rc;
	}

	public function listUsers ($rc) {
		$rc["users"] = $this->open("users")->loadAll();

		$rc["view"] = "admin.userList";
		return $rc;
	}

	public function formUser ($rc) {

		$rc["user"] = $this->open("users")->load($rc["id"]);

		$rc["activelist"] = $this->open("util")->getActiveList("form-control", $rc["user"]["intIsActive"]);

		if ($rc["id"] == 0) {
			$rc["button"] = "Add User";
			$rc["verb"] = "Add";
			$rc["user"]["vcLevel"] = "admin";

			if (in_array("firstuser", $rc)) {
				$rc["user"]["vcLevel"] = "god";
			}

		} else {
			$rc["button"] = "Save Changes";
			$rc["verb"] = "Edit";
		}

		$rc["view"] = "admin.userForm";
		return $rc;
	}

	public function processUser ($rc) {
		$rc = $this->open("users")->save($rc);
		$this->redirect("admin.listUsers", $rc);
	}

	public function forgotUser ($rc) {

		if (isset($rc["email"])) {
			$this->open("users")->forgot($rc["email"]);
			$this->redirect("admin", $rc);
		}

		$rc["view"] = "admin.userForgot";
		return $rc;
	}

	public function resetUser ($rc) {

		if (!isset($rc["pin"])) {
			$this->open("messenger")->addMessage("The link that brought you here was missing necessary elements.");
			$this->redirect("admin", $rc);
		}

		$rc["view"] = "admin.userReset";
		return $rc;
	}

	public function processResetUser ($rc) {

		if ($this->open("users")->resetPassword($rc["email"], $rc["pin"], $rc["log1"])) {

			$this->open("messenger")->addMessage("Your password was successfully reset.", "confirm");
			$this->redirect("admin", $rc);

		} else {

			$this->open("messenger")->addMessage("Your password reset failed.");
			$this->redirect("admin.resetUser&pin=" . $rc["pin"], $rc);
		}
	}

	public function viewPageMaker ($rc) {

		$rc["nav"] = $this->open("pages")->loadAll();

		if (isset($rc["intPageID"])) {
			$rc["page"] = $this->open("pages")->load($rc["intPageID"]);
			$rc["activelist"] = $this->open("util")->getActiveList("form-control", $rc["page"]["intIsActive"]);
		}

		$rc["view"] = "admin.pageMaker";
		return $rc;
	}

	public function processPageMaker ($rc) {
		$rc = $this->open("pages")->save($rc);
		$this->redirect("admin.viewPageMaker", $rc);
	}

	public function viewPageEditor ($rc) {

		$rc["page"] = $this->open("pages")->loadContent($rc["intPageID"]);

		$rc["view"] = "admin.pageEditor";
		return $rc;
	}

	public function processPageEditor ($rc) {

		$rc["page"] = $this->open("pages")->load($rc["intPageID"]);
		$rc["page"]["ntBody"] = $rc["ntBody"];

		$rc = $this->populate($rc, $rc["page"]);
		$rc = $this->open("pages")->save($rc);

		$this->redirect("admin.viewMenu", $rc);
	}

	public function processSilentPage ($rc) {

		$rc["page"] = $this->open("pages")->load($rc["intPageID"]);
		$rc["page"]["ntBody"] = $rc["otherbody"];

		$rc = $this->populate($rc, $rc["page"]);
		$rc = $this->open("pages")->save($rc);

		$rc["func"] = "silentSave";
		$rc["view"] = "admin.ajax";
		$rc["layout"] = "none";

		$this->render($rc);

		return $rc;
	}

	public function viewDocList ($rc) {

		$rc["docs"] = $this->open("docs")->loadAll();

		$rc["view"] = "admin.documentList";
		return $rc;
	}

	public function viewDocForm ($rc) {

		$rc["doc"] = $this->open("docs")->load($rc["id"]);

		$rc["view"] = "admin.documentForm";
		return $rc;
	}

	public function processDocForm ($rc) {

		$rc["prefix"] = "doc-";

		$rc["vcDocFile"] = $this->open("util")->upload($rc);

		$rc = $this->open("docs")->save($rc);

		$this->redirect("admin.viewDocList", $rc);
	}

	public function deleteDoc ($rc) {

		$this->open("docs")->delete($rc);

		$this->redirect("admin.viewDocList", $rc);
	}

	public function getDocumentBank ($rc) {

		$rc["docs"] = $this->open("docs")->loadAll();

		$rc["view"] = "admin.documentBank";
		$rc["layout"] = "none";

		$this->render($rc);

		return $rc;
	}

} ?>