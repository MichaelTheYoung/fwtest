<? class userQry extends core {

	public function create ($rc) {
		$db = $this->open("db");
		$SQL = "INSERT INTO tblUser (
			intIsActive
			, vcPin
			, vcLevel
			, vcFName
			, vcLName
			, vcEmail
			, vcLogPW";
		$SQL .= $this->open("util")->startStamp();
		$SQL .= ") VALUES (";
			$SQL .= $rc["intIsActive"] . ", '";
			$SQL .= $rc["vcPin"] . "', '";
			$SQL .= $rc["vcLevel"] . "', '";
			$SQL .= $db->clean($rc["vcFName"]) . "', '";
			$SQL .= $db->clean($rc["vcLName"]) . "', '";
			$SQL .= $db->clean($rc["vcEmail"]) . "', '";
			$SQL .= $rc['vcLogPW'] . "'";
			$SQL .= $this->open("util")->finishStamp();
		return $db->writeOneReturn($SQL);
	}

	public function update ($rc) {
		$db = $this->open("db");
		$SQL = "UPDATE tblUser SET ";
		$SQL .= "intIsActive = " . $rc["intIsActive"] . ", ";
		$SQL .= "vcLevel = '" . $db->clean($rc["vcLevel"]) . "', ";
		$SQL .= "vcFName = '" . $db->clean($rc["vcFName"]) . "', ";
		$SQL .= "vcLName = '" . $db->clean($rc["vcLName"]) . "', ";
		$SQL .= "vcEmail = '" . $db->clean($rc["vcEmail"]) . "' ";
		if (isset($rc["vcLogPW"])) {
			$SQL .= ", vcLogPW = '" . $rc["vcLogPW"] . "' ";
		}
		$SQL .= $this->open("util")->updateStamp();
		$SQL .= "WHERE intUserID = " . $rc["intUserID"];
		$db->writeOne($SQL);
	}

	public function load ($id) {
		if ($id > 0) {
			return $this->open("db")->getOne("SELECT * FROM tblUser WHERE intUserID = " . $id);
		} else {
			return $this->open("db")->getEmpty("tblUser");
		}
	}

	public function loadAll () {
		return $this->open("db")->getAll("SELECT * FROM tblUser WHERE vcLevel <> 'god' ORDER BY vcLName ASC, vcFName ASC");
	}

	public function getUserByEmailAndPin ($email, $pin) {
		$SQL = "SELECT intUserID FROM tblUser WHERE vcEmail LIKE '" . $email . "' AND vcPin = '" . $pin . "'";
		return $this->open("db")->getOne($SQL);
	}

	public function getPin ($email) {
		return $this->open("db")->getOne("SELECT vcPin FROM tblUser WHERE vcEmail LIKE '" . $email . "'");
	}

	public function login ($rc) {
		$SQL = "SELECT intUserID FROM tblUser WHERE vcEmail LIKE '" . $rc["email"] . "' AND vcLogPW = '" . $rc["logpw"] . "'";
		if ($RS = $this->open("db")->getOne($SQL)) {
			return $RS["intUserID"];
		} else {
			return 0;
		}
	}

} ?>


