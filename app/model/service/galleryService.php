<? class gallery extends core {

	private function create ($rc) {
		$this->open("galleryQry")->create($rc);
	}

	private function update ($rc) {
		$this->open("galleryQry")->update($rc);
	}

	public function save ($rc, $sendback = false) {
		if ($rc["intGalleryID"] == 0) {
			$id = $this->create($rc);
		} else {
			$this->update($rc);
			$id = $rc["intGalleryID"];
		}
		if ($sendback) {
			return $this->load($id);
		}
	}

	public function load ($id) {
		return $this->open("galleryQry")->load($id);
	}

	public function loadAll () {
		return $this->open("galleryQry")->loadAll();
	}

	public function loadAllByType ($type) {
		return $this->open("galleryQry")->loadAllByType($type);
	}

	public function delete ($id) {
		$this->open("galleryQry")->delete($id);
	}

} ?>