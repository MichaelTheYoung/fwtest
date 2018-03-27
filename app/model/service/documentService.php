<? class docs extends core {

	private function create ($rc) {
		$this->open("docsQry")->create($rc);
	}

	public function save ($rc, $sendback = false) {
		$id = $this->create($rc);
		if ($sendback) {
			return $this->load($id);
		}
	}

	public function load ($id) {
		return $this->open("docsQry")->load($id);
	}

	public function loadAll () {
		return $this->open("docsQry")->loadAll();
	}

	public function delete ($rc) {
		$doc = $this->open("docsQry")->load($rc["id"]);
		$rc = $this->populate($rc, $doc);
		$this->open("docsQry")->delete($rc);
		$this->killFile($rc["vcDocFile"]);
	}

}



