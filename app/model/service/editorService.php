<? class editor extends core {

	private function create ($rc) {
		$rc["ntBody"] = $this->fixLinks($rc["ntBody"]);
		$rc["ntBody"] = $this->fixPics($rc["ntBody"]);
		return $this->open("editorQry")->create($rc);
	}

	private function update ($rc) {
		$this->open("editorQry")->update($rc);
	}

	public function save ($rc, $sendback = false) {
		if ($rc["intEditorID"] == 0) {
			$id = $this->create($rc);
		} else {
			$this->update($rc);
			$id = $rc["intEditorID"];
		}
		if ($sendback) {
			return $this->load($id);
		}
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
			for (var $i = 0; $i < $count; $i++) {
				if ($i > $count) {
					break;
				}
				$words .= $wordArray[$i] . " ";
			}
		}
		return trim($words);
	}

} ?>

