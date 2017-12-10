<? class util {

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

	public function GetMonths() {
		$moList["1"] = "January";
		$moList["2"] = "February";
		$moList["3"] = "March";
		$moList["4"] = "April";
		$moList["5"] = "May";
		$moList["6"] = "June";
		$moList["7"] = "July";
		$moList["8"] = "August";
		$moList["9"] = "September";
		$moList["10"] = "October";
		$moList["11"] = "November";
		$moList["12"] = "December";
		return $moList;
	}

	public function GetStates() {
		$usList["AL"] = "Alabama";
		$usList["AK"] = "Alaska";
		$usList["AZ"] = "Arizona";
		$usList["AR"] = "Arkansas";
		$usList["CA"] = "California";
		$usList["CO"] = "Colorado";
		$usList["CT"] = "Connecticut";
		$usList["DC"] = "District of Columbia";
		$usList["DE"] = "Delaware";
		$usList["FL"] = "Florida";
		$usList["GA"] = "Georgia";
		$usList["HI"] = "Hawaii";
		$usList["ID"] = "Idaho";
		$usList["IL"] = "Illinois";
		$usList["IN"] = "Indiana";
		$usList["IA"] = "Iowa";
		$usList["KS"] = "Kansas";
		$usList["KY"] = "Kentucky";
		$usList["LA"] = "Louisiana";
		$usList["ME"] = "Maine";
		$usList["MD"] = "Maryland";
		$usList["MA"] = "Massachusetts";
		$usList["MI"] = "Michigan";
		$usList["MN"] = "Minnesota";
		$usList["MS"] = "Mississippi";
		$usList["MO"] = "Missouri";
		$usList["MT"] = "Montana";
		$usList["NE"] = "Nebraska";
		$usList["NV"] = "Nevada";
		$usList["NH"] = "New Hampshire";
		$usList["NJ"] = "New Jersey";
		$usList["NM"] = "New Mexico";
		$usList["NY"] = "New York";
		$usList["NC"] = "North Carolina";
		$usList["ND"] = "North Dakota";
		$usList["OH"] = "Ohio";
		$usList["OK"] = "Oklahoma";
		$usList["OR"] = "Oregon";
		$usList["PA"] = "Pennsylvania";
		$usList["RI"] = "Rhode Island";
		$usList["SC"] = "South Carolina";
		$usList["SD"] = "South Dakota";
		$usList["TN"] = "Tennessee";
		$usList["TX"] = "Texas";
		$usList["UT"] = "Utah";
		$usList["VT"] = "Vermont";
		$usList["VA"] = "Virginia";
		$usList["WA"] = "Washington";
		$usList["WV"] = "West Virginia";
		$usList["WI"] = "Wisconsin";
		$usList["WY"] = "Wyoming";
		return $usList;
	}

	public function NumSuffix($num) {
		$digit = substr(strval($num), -1);
		switch ($digit) {
			case "1":
				$suffix = "st";
				break;
			case "2":
				$suffix = "nd";
				break;
			case "3":
				$suffix = "rd";
				break;
			default:
				$suffix = "th";
		}
		return $num .= $suffix;
	}

	public function TrimZero($num) {
		if (substr($num, 0, 1) == "0") {
			$num = substr($num, 1, strlen($num));
		}
		return $num;
	}

	public function FormatNumber($tmp) {
		$tmp = ($tmp * 1);
		$tmp = number_format($tmp, 2);
		$tmp = str_replace(",", "", $tmp);
		return $tmp;
	}

	public function KillFile($tmp) {
		if (trim($tmp) !== "") {
			$file = "./uploads/" . trim($tmp);
			if (file_exists($file)) {
				unlink($file);
			}
		}
	}

	public function FullKillFile($file) {
		if (trim($file) !== "") {
			if (file_exists($file)) {
				unlink($file);
			}
		}
	}

	public function FixTable($cols, $max) {
		if ($cols > 0) {
			while ($cols < $max) {
				?><td>&nbsp;</td><?
				$cols++;
			}
			if ($cols == $max) {
				?></tr><?
			}
		}
	}

	public function FixCommas($tmp) {
		$tmp = str_replace(",", " ", $tmp);
		return $tmp;
	}

	public function MakeString($tmp, $add, $del) {
		return $tmp == "" ? $add : $tmp .= $del . $add;
	}

	public function SwapColors($tmp) {
		return $tmp == "FFFFFF" ? "EEEEEE" : "FFFFFF";
	}

	public function GetDays() {
		$dayList["0"] = "Sunday";
		$dayList["1"] = "Monday";
		$dayList["2"] = "Tuesday";
		$dayList["3"] = "Wednesday";
		$dayList["4"] = "Thursday";
		$dayList["5"] = "Friday";
		$dayList["6"] = "Saturday";
		return $dayList;
	}

	public function GetDay($sqlDate) {
		$arr = explode("-", $sqlDate);
		$timeStamp = mktime(0, 0, 0, $arr[1], $arr[2], $arr[0]);
		$dateArray = localtime($timeStamp);
		$dayList["0"] = "Sunday";
		$dayList["1"] = "Monday";
		$dayList["2"] = "Tuesday";
		$dayList["3"] = "Wednesday";
		$dayList["4"] = "Thursday";
		$dayList["5"] = "Friday";
		$dayList["6"] = "Saturday";
		return $dayList[$dateArray[6]];
	}

	public function GetDayNumeric($sqlDate) {
		$arr = explode("-", $sqlDate);
		$timeStamp = mktime(0, 0, 0, $arr[1], $arr[2], $arr[0]);
		$dateArray = localtime($timeStamp);
		return $dateArray[6];
	}

	public function MilitaryTime($tmp) {
		$theTime = strtoupper($tmp);
		$timePair = explode(" ", $theTime);
		$timestamp = str_replace(":", "", $timePair[0]);
		if (($timePair[1] == "PM") && ($timestamp < 1200)) {
			$timestamp = ($timestamp + 1200);
		}
		if (strlen($timestamp) < 4) {
			$timestamp = "0" . $timestamp;
		}
		if ((substr($timestamp, 0, 2) == "12") && ($timePair[1] == "AM")) {
			$timestamp = "00" . substr($timestamp, 2, 2);
		}
		return $timestamp;
	}

	public function CivilianTime($tmp) {
		$hr = substr($tmp, 0, 2);
		$mn = substr($tmp, 2, 2);
		$daypart = " AM";
		$hrNum = intval($hr);
		if ($hrNum == 12) {
			$daypart = " PM";
		} else if ($hrNum > 12) {
			$hrNum = ($hrNum - 12);
			$hr = $hrNum . "";
			$daypart = " PM";
		} else if ($hrNum == 0) {
			$hr = "12";
		}
		$tmp = $hr . ":" . $mn . $daypart;
		return $tmp;
	}

	public function PrettyDate($tmp) {
		$monthList["01"] = "January";
		$monthList["02"] = "February";
		$monthList["03"] = "March";
		$monthList["04"] = "April";
		$monthList["05"] = "May";
		$monthList["06"] = "June";
		$monthList["07"] = "July";
		$monthList["08"] = "August";
		$monthList["09"] = "September";
		$monthList["10"] = "October";
		$monthList["11"] = "November";
		$monthList["12"] = "December";
		$theArray = explode("-", $tmp);
		$dy = $theArray[2];
		if (substr($dy, 0, 1) == "0") {
			$dy = substr($dy, 1, 1);
		}
		$theDate = $monthList[$theArray[1]] . " " . $dy . ", " . $theArray[0];
		return $theDate;
	}

	public function PrettyDate2($tmp) {
		$monthList["01"] = "Jan";
		$monthList["02"] = "Feb";
		$monthList["03"] = "Mar";
		$monthList["04"] = "Apr";
		$monthList["05"] = "May";
		$monthList["06"] = "Jun";
		$monthList["07"] = "Jul";
		$monthList["08"] = "Aug";
		$monthList["09"] = "Sep";
		$monthList["10"] = "Oct";
		$monthList["11"] = "Nov";
		$monthList["12"] = "Dec";
		$theArray = explode("-", $tmp);
		$dy = $theArray[2];
		if (substr($dy, 0, 1) == "0") {
			$dy = substr($dy, 1, 1);
		}
		$theDate = $monthList[$theArray[1]] . " " . $dy . ", " . $theArray[0];
		return $theDate;
	}

	public function ShortMonths() {
		$monthList["01"] = "Jan";
		$monthList["02"] = "Feb";
		$monthList["03"] = "Mar";
		$monthList["04"] = "Apr";
		$monthList["05"] = "May";
		$monthList["06"] = "Jun";
		$monthList["07"] = "Jul";
		$monthList["08"] = "Aug";
		$monthList["09"] = "Sep";
		$monthList["10"] = "Oct";
		$monthList["11"] = "Nov";
		$monthList["12"] = "Dec";
		return $monthList;
	}

	public function CardYears() {
		$year = GetYear(); $years = array();
		for ($i = $year; $i < ($year + 15); $i++) {
			array_push($years, $i);
		}
		return $years;
	}

	public function DateAdd($sqldate, $inc) {
		date_default_timezone_set("UTC");
		$arr = explode("-", $sqldate);
		$oldStamp = mktime(0, 0, 0, $arr[1], $arr[2], $arr[0]);
		$newStamp = ($oldStamp + ($inc * 86400));
		$newDate = WriteDate(StraightDate(localtime($newStamp)));
		date_default_timezone_set("America/Chicago");
		return $newDate;
	}

	public function IsEven($num) {
		if (strstr("24680", substr($num, -1))) {
			return true;
		}
		return false;
	}

	public function Strip($what, $where) {
		return str_replace($what, "", $where);
	}

	public function GetYear() {
		$arr = explode("-", WriteDate(StraightDate(localtime())));
		return $arr[0];
	}

	public function WriteDate($tmp) {
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

	public function UnWriteDate($tmp) {
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

	public function StraightDate($sentTime) {
		$dateArray = $sentTime;
		$dy = $dateArray[3];
		$mo = ($dateArray[4] + 1);
		$yr = $dateArray[5] + 1900;
		$theDate = $mo . "/" . $dy . "/" . $yr;
		return $theDate;
	}

	public function GetTime($sentTime) {
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

} ?>


