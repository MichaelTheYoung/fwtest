<? class db extends core {

	public function dbConn() {
		$db = mysqli_connect($GLOBALS["hostName"], $GLOBALS["userName"], $GLOBALS["password"]);
		mysqli_select_db($db, $GLOBALS["database"]);
		return $db;
	}

	public function writeOneReturn($SQL) {
		mysqli_query($this->dbConn(), $SQL);
		return mysqli_insert_id($this->dbConn());
	}

	public function writeOne($SQL) {
		mysqli_query($this->dbConn(), $SQL);
	}

	public function getOne($SQL) {
		return $this->batchUnclean(mysqli_fetch_array(mysqli_query($this->dbConn(), $SQL), MYSQLI_ASSOC));
	}

	public function getAll($SQL) {
		$tempArray = array();
		if ($rec = mysqli_fetch_array(mysqli_query($this->dbConn(), $SQL), MYSQLI_ASSOC)) {
			$kounter = 0;
			while (list($key, $val) = each($rec)) {
				$fieldList[$kounter] = $key;
				$kounter++;
			}
			$kounter = 0;
			$rec = mysqli_fetch_array(mysqli_query($this->dbConn(), $SQL), MYSQLI_ASSOC);
			while (list($key, $val) = each($rec)) {
				$nameList[$kounter] = $key;
				$kounter++;
			}
			$rec = mysqli_query($this->dbConn(), $SQL);
			while ($row = mysqli_fetch_row($rec)) {
				while (list($key, $val) = each($row)) {
					$rowList[$nameList[$key]] = $val;
				}
				array_push($tempArray, $rowList);
			}
		}
		return $this->batchUnclean($tempArray);
	}

	public function getEmpty($table) {
		$columns = $this->getAll("SHOW COLUMNS IN " . $table);
		foreach ($columns as $col) {
			if ($col["Extra"] == "auto_increment") {
				$rec[$col["Field"]] = 0;
			} else {
				$rec[$col["Field"]] = $col["Default"];
			}
		}
		return $rec;
	}

	public function recCount ($table) {
		$rs = $this->getOne("SELECT COUNT(*) AS RecCount FROM " . $table);
		return $rs["RecCount"];
	}

	public function clean($tmp) {
		$clean = trim($tmp);
		$clean = mysqli_real_escape_string($this->dbConn(), $clean);
		if (strlen($clean) < 1) {
			$clean = " ";
		}
		$pbreak = chr(13) . chr(10);
		$clean = str_replace($pbreak, "<br>", $clean);
		$otherpbreak = "\\n";
		$clean = str_replace($otherpbreak, "<br>", $clean);
		$toFix = "\%";
		$clean = str_replace($toFix, "\\%", $clean);
		return $clean;
	}

	public function unclean($tmp, $inBox = 0) {
		$unclean = trim($tmp);
		if ($inBox == 1) {
			$pbreak = chr(13) . chr(10);
			$pbreak = "\n";
			$unclean = str_replace("<br>", $pbreak, $unclean);
		}
		$toFix = "\\" . chr(34);
		$unclean = str_replace($toFix, chr(34), $unclean);
		$toFix = "\\%";
		$unclean = str_replace($toFix, "\%", $unclean);
		$toFix = "\'";
		$unclean = str_replace($toFix, "'", $unclean);
		$toFix = chr(92) . chr(92);
		$unclean = str_replace($toFix, chr(92), $unclean);
		return $unclean;
	}

	public function wclean($tmp) {
		$clean = trim($tmp);
		$clean = mysqli_real_escape_string($this->dbConn(), $clean);
		if (strlen($clean) < 1) {
			$clean = " ";
		}
		$toFix = "\%";
		$clean = str_replace($toFix, "\\%", $clean);
		$clean = str_replace("<TBODY>", "", $clean);
		$clean = str_replace("</TBODY>", "", $clean);
		$clean = str_replace("<SPAN>", "", $clean);
		$clean = str_replace("</SPAN>", "", $clean);
		$clean = str_replace("<span>", "", $clean);
		$clean = str_replace("</span>", "", $clean);
		return $clean;
	}

	public function wunclean($tmp) {
		$unclean = trim($tmp);
		$toFix = "\\" . chr(34);
		$unclean = str_replace($toFix, chr(34), $unclean);
		$toFix = "\\%";
		$unclean = str_replace($toFix, "\%", $unclean);
		$toFix = "\'";
		$unclean = str_replace($toFix, "'", $unclean);
		$toFix = chr(92) . chr(92);
		$unclean = str_replace($toFix, chr(92), $unclean);
		return $unclean;
	}

	private function batchUnclean($rs) {
		while (list($key, $val) = each($rs)) {
			if ((substr($key, 0, 2) == "vc") || (substr($key, 0, 2) == "nt")) {
				$rs[$key] = $this->unclean($val);
			}
		}
		return $rs;
	}

}