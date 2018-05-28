<? class galleryItem extends core {

	private function create ($rc) {

		if (isset($rc["isVid"])) {
			$rc["vcVidCode"] = $this->fixVidCode($rc["vcVidCode"]);
		}

		$this->open("galleryItemQry")->create($rc);
	}

	private function update ($rc) {
		$this->open("galleryItemQry")->update($rc);
	}

	public function save ($rc, $sendback = false) {
		if ($rc["intGalleryItemID"] == 0) {
			$id = $this->create($rc);
		} else {
			$this->update($rc);
			$id = $rc["intGalleryItemID"];
		}
		if ($sendback) {
			return $this->load($id);
		}
	}

	public function load ($id) {
		return $this->open("galleryItemQry")->load($id);
	}

	public function loadAll () {
		return $this->open("galleryItemQry")->loadAll();
	}

	public function loadAllByGalleryID ($id) {
		return $this->open("galleryItemQry")->loadAllByGalleryID($id);
	}

	public function delete ($id) {
		$this->open("galleryItemQry")->delete($id);
	}

	public function fixVidCode($code) {
		$newcode = "";
		$arr = explode(" ", $code);
		for ($i = 0; $i < count($arr); $i++) {
			if (strstr($arr[$i], "width=")) {
				$arr[$i] = "class=\"vid\"";
			}
			if (strstr($arr[$i], "height=")) {
				$arr[$i] = "";
			}
			$newcode .= $arr[$i] . " ";
		}
		return trim(str_replace("  ", " ", $newcode));
	}

	public function makeVidThumb($code) {
		$arr = explode(" ", $code);
		$url = $arr[3];
		$url = str_replace("https://www.youtube.com/embed/", "", $url);
		$url = str_replace("src=", "", $url);
		$url = str_replace(chr(34), "", $url);
		$vid = $url;
		if (strstr($vid, "?")) {
			$newarr = explode("?", $vid);
			$vid = $newarr[0];
		}
		return "http://img.youtube.com/vi/" . $vid . "/0.jpg";
	}




} ?>