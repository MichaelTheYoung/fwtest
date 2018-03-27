<? class userQry extends core {

	public function create ($rc) {
		$SQL = "INSERT INTO tblUser (
			intIsActive
			, vcPin
			, vcLevel
			, vcFName
			, vcLName
			, vcEmail
			, vcLogPW
			, intCreatedBy
			, vcCreateDate
			, vcCreateTime";
		$SQL .= ") VALUES (";
			$SQL .= $rc["intIsActive"] . ", '";
			$SQL .= $rc["vcPin"] . "', '";
			$SQL .= $rc["vcLevel"] . "', '";
			$SQL .= $this->clean($rc["vcFName"]) . "', '";
			$SQL .= $this->clean($rc["vcLName"]) . "', '";
			$SQL .= $this->clean($rc["vcEmail"]) . "', '";
			$SQL .= $rc['vcLogPW'] . "', ";
			isset($_SESSION["user"]["userid"]) ? $SQL .= $_SESSION["user"]["userid"] : $SQL .= "0";
			$SQL .= ", '" . date("Y-m-d");
			$SQL .= "', '" . date("h:i A") . "')";

		return $this->writeOneReturn($SQL);
	}

	public function update ($rc) {
		$SQL = "UPDATE tblUser SET ";
		$SQL .= "intIsActive = " . $rc["intIsActive"] . ", ";
		$SQL .= "vcLevel = '" . $this->clean($rc["vcLevel"]) . "', ";
		$SQL .= "vcFName = '" . $this->clean($rc["vcFName"]) . "', ";
		$SQL .= "vcLName = '" . $this->clean($rc["vcLName"]) . "', ";
		$SQL .= "vcEmail = '" . $this->clean($rc["vcEmail"]) . "', ";
		if (isset($rc["vcLogPW"])) {
			$SQL .= "vcLogPW = '" . $rc["vcLogPW"] . "', ";
		}
		$SQL .= "intModifiedBy = " . $_SESSION["user"]["userid"];
		$SQL .= "vcModifyDate = '" . date("Y-m-d") . "' ";
		$SQL .= "vcModifyTime = '" . date("g:i A") . "' ";
		$SQL .= "WHERE intUserID = " . $rc["intUserID"];
		$this->writeOne($SQL);
	}

	public function load ($id) {
		if ($id > 0) {
			return $this->getOne("SELECT * FROM tblUser WHERE intUserID = " . $id);
		} else {
			return $this->getEmpty("tblUser");
		}
	}

	public function loadAll () {
		return $this->getAll("SELECT * FROM tblUser WHERE vcLevel <> 'god' AND intIsActive < 9 ORDER BY vcLName ASC, vcFName ASC");
	}

	public function getUserByEmailAndPin ($email, $pin) {
		$SQL = "SELECT intUserID FROM tblUser WHERE vcEmail LIKE '" . $email . "' AND vcPin = '" . $pin . "'";
		return $this->getOne($SQL);
	}

	public function getPin ($email) {
		return $this->getOne("SELECT vcPin FROM tblUser WHERE vcEmail LIKE '" . $email . "'");
	}

	public function login ($rc) {
		$SQL = "SELECT intUserID FROM tblUser WHERE vcEmail LIKE '" . $rc["email"] . "' AND vcLogPW = '" . $rc["logpw"] . "'";
		if ($RS = $this->getOne($SQL)) {
			return $RS["intUserID"];
		} else {
			return 0;
		}
	}

	public function deleteUser ($id) {
		$SQL = "UPDATE tblUser SET intIsActive = 9 WHERE intUserID = " . $id;
		$this->writeOne($SQL);
	}

} ?>


