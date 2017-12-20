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
		return mysqli_fetch_array(mysqli_query($this->dbConn(), $SQL), MYSQLI_ASSOC);
	}

	public function getAll($SQL) {
		$tempArray = array();
		if ($rec = mysqli_fetch_array(mysqli_query($this->dbConn(), $SQL), MYSQLI_ASSOC)) {
			$counter = 0;
			while (list($key, $val) = each($rec)) {
				$fieldList[$counter] = $key;
				$counter++;
			}
			$counter = 0;
			$rec = mysqli_fetch_array(mysqli_query($this->dbConn(), $SQL), MYSQLI_ASSOC);
			while (list($key, $val) = each($rec)) {
				$nameList[$counter] = $key;
				$counter++;
			}
			$rec = mysqli_query($this->dbConn(), $SQL);
			while ($row = mysqli_fetch_row($rec)) {
				while (list($key, $val) = each($row)) {
					$rowList[$nameList[$key]] = $val;
				}
				array_push($tempArray, $rowList);
			}
		}
		return $tempArray;
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
		return $this->getOne("SELECT COUNT(*) FROM " . $table)[0];
	}


}