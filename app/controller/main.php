<? class main {

	public function before ($rc) {
		return array(
			"testService",
			"testGateway"
		);
	}

	public function index ($rc) {

		$rc["pagetitle"] = "Hi There";

		$rc["greeting"] = "Well fuck.";

		$obj = new testService;

		$rc["newtest"] = $obj->newTest();

		$rc["query"] = $obj->dataTest();

		$rc["view"] = "main.index";

		return $rc;
	}

	public function pageTwo ($rc) {

		$rc["pagetitle"] = "Page Two";

		$rc["view"] = "main.pageTwo";

		return $rc;
	}


} ?>