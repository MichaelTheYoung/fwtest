<? class main extends core {

	public function before ($rc) {
		return array(
			"messengerService",
			"pageService",
			"pageGateway"
		);
	}

	public function index ($rc) {

		$pages = new pages;

		$rc["nav"] = $pages->loadAll();

		if (!isset($rc["pageID"])) {
			$rc["pageID"] = $pages->findHome();
		}

		if ($rc["pageID"] > 0) {

			$rec = $pages->load($rc["pageID"]);
			$rc["pageContent"] = $this->wunclean($rec["ntBody"]);
			$rc["pageTitle"] = $this->unclean($rec["vcTitle"]);

		} else {
			$this->redirect("admin", $rc);
		}

		$rc["view"] = "main.index";
		return $rc;
	}


} ?>