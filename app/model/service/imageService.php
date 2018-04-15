<? class pics extends core {

	private function create ($rc) {
		$this->open("picsQry")->create($rc);
	}

	public function save ($rc, $sendback = false) {
		$id = $this->create($rc);
		if ($sendback) {
			return $this->load($id);
		}
	}

	public function writeAll ($rc) {
		$rc["intIsActive"] = 1;
		foreach ($rc["picArray"] as $pic) {
			$rc["vcPicFile"] = $pic;
			$this->open("picsQry")->create($rc);
		}
	}

	public function load ($id) {
		return $this->open("picsQry")->load($id);
	}

	public function loadAll () {
		return $this->open("picsQry")->loadAll();
	}

	public function delete ($id) {
		$pic = $this->open("picsQry")->load($id);
		$this->open("picsQry")->delete($id);
		$this->killFile($pic["vcPicFile"]);
	}


} ?>