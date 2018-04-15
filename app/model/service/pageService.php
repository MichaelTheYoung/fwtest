<? class pages extends core {

	private function create ($rc) {
		return $this->open("pageQry")->create($rc);
	}

	private function update ($rc) {
		$this->open("pageQry")->update($rc);
	}

	public function save ($rc, $sendback = false) {
		$rc["ntBody"] = $this->fixLinks($rc["ntBody"]);
		$rc["ntBody"] = $this->fixPics($rc["ntBody"]);
		if ($rc["intPageID"] == 0) {
			$id = $this->create($rc);
		} else {
			$this->update($rc);
			$id = $rc["intPageID"];
		}
		if ($sendback) {
			return $this->load($id);
		}
	}

	public function load ($id) {
		return $this->open("pageQry")->load($id);
	}

	public function loadAll () {

		$parents = $this->open("pageQry")->loadParents();
		$counter = 0;

		foreach ($parents as $parent) {
			$counter++;
			$nav[$counter] = $parent;

			$children = $this->open("pageQry")->loadChildren($parent["intPageID"]);
			$childCounter = 0;

			foreach ($children as $child) {
				$childCounter++;
				$nav[$counter]["children"][$childCounter] = $child;
			}
		}

		return isset($nav) ? $nav : null;
	}

	public function loadAllContent () {
		$blob = "";
		$recs = $this->open("pageQry")->loadAllContent();
		foreach ($recs as $rec) {
			$blob .= $rec["ntBody"];
		}
		return $blob;
	}

	public function findHome () {
		return $this->open("pageQry")->findHome();
	}

	private function fixLinks ($text) {
		$text = str_replace("http://http://", "http://", $text);
		$text = str_replace("https://https://", "https://", $text);
		$local = str_replace("http://", "", $GLOBALS["hostPath"]);
		$text = str_replace($local, "/", $text);
		return $text;
	}

	private function fixPics ($text) {
		$arr = explode(" ", $text);
		for ($i = 0; $i < count($arr); $i++) {
			if (strstr($arr[$i], "<img")) {
				$arr[$i] = str_replace("<img", "<img class=\"img-responsive\" ", $arr[$i]);
			}
			if (strstr($arr[$i], "height:")) {
				$arr[$i] = "height:auto; ";
			}
		}
		$text = implode(" ", $arr);
		$double = " class=\"img-responsive\" class=\"img-responsive\"";
		$text = str_replace($double, " class=\"img-responsive\" ", $text);
		return $text;
	}


} ?>

