<? class util extends core {

	public function killFile($tmp) {
		if (trim($tmp) !== "") {
			if (file_exists($GLOBALS["uploadPath"] . trim($tmp))) {
				unlink($GLOBALS["uploadPath"] . trim($tmp));
			}
		}
	}

	public function makeString($tmp, $add, $del) {
		return $tmp == "" ? $add : $tmp .= $del . $add;
	}

	public function dateAdd($sqldate, $inc) {
		date_default_timezone_set("UTC");
		$arr = explode("-", $sqldate);
		$oldStamp = mktime(0, 0, 0, $arr[1], $arr[2], $arr[0]);
		$newStamp = ($oldStamp + ($inc * 86400));
		$newDate = WriteDate(StraightDate(localtime($newStamp)));
		date_default_timezone_set("America/Chicago");
		return $newDate;
	}

	public function isEven($num) {
		if (strstr("24680", substr($num, -1))) {
			return true;
		}
		return false;
	}

	public function writeDate($tmp) {
		$dateArray = explode("/", $tmp);
		$yr = $dateArray[2];
		$dy = $dateArray[1];
		$mo = $dateArray[0];
		if (strlen($dy) == 1) {
			$dy = "0" . $dy;
		}
		if (strlen($mo) == 1) {
			$mo = "0" . $mo;
		}
		$newDate = $yr . "-" . $mo . "-" . $dy;
		return $newDate;
	}

	public function unWriteDate($tmp) {
		if (strstr($tmp, "-")) {
			$dateArray = explode("-", $tmp);
			$mo = $dateArray[1];
			$dy = $dateArray[2];
			$yr = $dateArray[0];
			if (substr($mo, 0, 1) == "0") {
				$mo = substr($mo, 1);
			}
			if (substr($dy, 0, 1) == "0") {
				$dy = substr($dy, 1);
			}
			$newDate = $mo . "/" . $dy . "/" . $yr;
		} else {
			$newDate = "Recurring";
		}
		return $newDate;
	}

	public function straightDate($sentTime) {
		$dateArray = $sentTime;
		$dy = $dateArray[3];
		$mo = ($dateArray[4] + 1);
		$yr = $dateArray[5] + 1900;
		$theDate = $mo . "/" . $dy . "/" . $yr;
		return $theDate;
	}

	public function updateStamp() {
		$stamp = ", intModifiedBy = " . $_SESSION["user"]["userid"];
		$stamp .= ", vcModifyDate = '" . $this->writeDate($this->straightDate(localtime())) . "' ";
		$stamp .= ", vcModifyTime = '" . $this->getTime(localtime()) . "' ";
		return $stamp;
	}

	public function startStamp() {
		return ", intCreatedBy, vcCreateDate, vcCreateTime";
	}

	public function finishStamp() {
		$stamp = ", ";
		isset($_SESSION["user"]["userid"]) ? $stamp .= $_SESSION["user"]["userid"] : $stamp .= "0";
		$stamp .= ", '" . $this->writeDate($this->straightDate(localtime()));
		$stamp .= "', '" . $this->getTime(localtime()) . "')";
		return $stamp;
	}

	public function getTime($sentTime) {
		$dateArray = $sentTime;
		$hr = $dateArray[2];
		$mn = $dateArray[1];
		if (strlen($mn) == 1) {
			$mn = "0" . $mn;
		}
		$daypart = "AM";
		if ($hr > 12) {
			if ($hr < 24) {
				$hr = $hr - 12;
				$daypart = "PM";
			} elseif ($hr == 24) {
				$hr = $hr - 12;
				$daypart = "AM";
			}
		} else if ($hr == 12) {
			$daypart = "PM";
		}
		$theTime = $hr . ":" . $mn . " " . $daypart;
		return $theTime;
	}

	public function getActiveList($style, $chosen) {
		$stuff = "<select id=\"intIsActive\" name=\"intIsActive\" class=\"" . $style . "\">";
		$stuff .= "<option value=\"0\"";
		if ($chosen == "0") {
			$stuff .= " selected";
		}
		$stuff .= ">Inactive</option>";
		$stuff .= "<option value=\"1\"";
		if ($chosen == "1") {
			$stuff .= " selected";
		}
		$stuff .= ">Active</option></select>";
		return $stuff;
	}

	public function StartSelect($useblank, $name, $aclass, $onchange) {
		$tmp = "<select  id=\"" . $name . "\" name=\"" . $name . "\" class=\"" . $aclass + "\"";
		if ($onchange != "") {
			$tmp .= " onChange=\"" + $onchange + ";\"";
		}
		$tmp .= ">";
		if ($useblank == 1) {
			$tmp .= "<option value=\"\">Select...</option>";
		}
		return $tmp;
	}

	public function MakeOption($key, $chosen, $value) {
		$key == $chosen ? $word = " selected" : $word = "";
		return "<option value=\"" . $key . "\"" . $word . ">" . $value . "</option>";
	}

	public function upload ($rc) {
		if (is_uploaded_file($_FILES["docfile"]["tmp_name"])) {
			$tempFile = $_FILES["docfile"]["name"];
			$tempArray = explode(".", $tempFile);
			$tempCount = count($tempArray);
			$ext = "." . strtolower($tempArray[$tempCount - 1]);
			$docFile = $rc["prefix"] . time() . $ext;
			$dest = $GLOBALS["uploadPath"] . $docFile;
			move_uploaded_file($_FILES["docfile"]["tmp_name"], $dest);
			if (($ext == ".jpg") || ($ext == ".jpeg")) {
				$this->resize($dest);
			}
			return $docFile;
		}
	}

	public function multiUpload ($rc) {
		$picArray = array();
		for ($i = 1; $i <= $rc["maxuploads"]; $i++) {
			if (is_uploaded_file($_FILES["docfile-" . $i]["tmp_name"])) {
				$tempFile = $_FILES["docfile-" . $i]["name"];
				$tempArray = explode(".", $tempFile);
				$tempCount = count($tempArray);
				$ext = "." . strtolower($tempArray[$tempCount - 1]);
				$docFile = $rc["prefix"] . time() . "-" . $i . $ext;
				$dest = $GLOBALS["uploadPath"] . $docFile;
				move_uploaded_file($_FILES["docfile-" . $i]["tmp_name"], $dest);
				if (($ext == ".jpg") || ($ext == ".jpeg")) {
					$this->resize($dest);
				}
				array_push($picArray, $docFile);
			}
		}
		return $picArray;
	}

	public function resize ($theFile) {
		$resize = 0;
		list($picW, $picH) = getimagesize($theFile);
		if ($picW > 1000) {
			$pct = 0.75;
			if ($picW > 1400) {
				$pct = 0.50;
			}
			if ($picW > 2000) {
				$pct = 0.35;
			}
			if ($picW > 3000) {
				$pct = 0.25;
			}
			$resize = 1;
		} else {
			if (filesize($theFile) > 100000) {
				$pct = 0.95;
				$resize = 1;
			}
		}
		if ($resize == 1) {
			echo "<meta http-equiv=\"content-type\" content=\"image/jpeg\">";
			$newW = ($picW * $pct);
			$newH = ($picH * $pct);
			$qual = 75;
			$image_p = imagecreatetruecolor($newW, $newH);
			$image = imagecreatefromjpeg($theFile);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $newW, $newH, $picW, $picH);
			imagejpeg($image_p, $theFile, $qual);
			ob_end_clean();
			ob_start();
			echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">";
		}
	}

} ?>


