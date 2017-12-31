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

	public function loadContent ($id) {
		return $this->open("pageQry")->load($id);
	}

	public function loadAll () {

		$parents = $this->open("pageQry")->loadParents();
		$children = $this->open("pageQry")->loadChildren();

		$counter = 0;

		foreach ($parents as $parent) {
			$counter++;
			$nav[$counter] = $parent;
			foreach ($children as $child) {
				if ($child["intParentID"] == $parent["intPageID"]) {
					$counter++;
					$nav[$counter] = $child;
				}
			}
		}

		return isset($nav) ? $nav : null;
	}

	private function fixLinks ($text) {
		$text = str_replace("http://http://", "http://", $text);
		$text = str_replace("https://https://", "https://", $text);
		$text = str_replace($GLOBALS["hostPath"], "", $text);
		$otherhost = str_replace("http://", "https://", $GLOBALS["hostPath"]);
		$text = str_replace($otherhost, "", $text);
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

	public function unTag ($tmp) {
		$fixed = "";
		for ($i = 0; $i < (strlen($tmp) - 1); $i++) {
			if (substr($tmp, $i, 1) == "<") {
				$keep = "off";
			}
			if ($keep == "on") {
				$fixed .= substr($tmp, $i, 1);
			}
			if (substr($tmp, $i, 1) == ">") {
				$keep = "on";
			}
		}
		return $fixed;
	}

	public function getFirstWords ($text, $count) {
		$wordArray = explode(" ", $text);
		if (count($wordArray) <= $count) {
			return $text;
		} else {
			$words = "";
			for ($i = 0; $i < $count; $i++) {
				if ($i > $count) {
					break;
				}
				$words .= $wordArray[$i] . " ";
			}
		}
		return trim($words);
	}

} ?>

