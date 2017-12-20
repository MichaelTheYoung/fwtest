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

} ?>


