<? class main extends core {

	public function before ($rc) {
		return array(
			"dbService",
			"messengerService",
			"pageService",
			"pageGateway"
		);
	}

	public function index ($rc) {




		$rc["view"] = "main.index";
		return $rc;
	}


} ?>