<? class userGateway extends fw {

	public function create ($rc) {
		$obj = new db;
		$SQL = "INSERT INTO tblUser (
			intIsActive
			, vcPin
			, vcLevel
			, vcFName
			, vcLName
			, vcEmail
			, vcLogPW
		) VALUES (";
			$SQL .= $rc["intIsActive"] . ", '";
			$SQL .= $rc["vcPin"] . "', '";
			$SQL .= $rc["vcLevel"] . "', '";
			$SQL .= $obj->clean($rc["vcFName"]) . "', '";
			$SQL .= $obj->clean($rc["vcLName"]) . "', '";
			$SQL .= $obj->clean($rc["vcEmail"]) . "', '";
			$SQL .= $rc['vcLogPW'] . "'
		)";
		return $obj->writeOneReturn($SQL);
	}

	public function update ($rc) {
		$obj = new db;
		$SQL = "UPDATE tblUser SET ";
		$SQL .= "intIsActive = " . $rc["intIsActive"] . ", ";
		$SQL .= "vcLevel = '" . $obj->clean($rc["vcLevel"]) . "', ";
		$SQL .= "vcFName = '" . $obj->clean($rc["vcFName"]) . "', ";
		$SQL .= "vcLName = '" . $obj->clean($rc["vcLName"]) . "', ";
		$SQL .= "vcEmail = '" . $obj->clean($rc["vcEmail"]) . "' ";
		$SQL .= "WHERE intUserID = " . $rc["intUserID"];
		$obj->writeOne($SQL);
	}

	public function load ($id) {
		$obj = new db;
		if ($id > 0) {
			return $obj->getOne("SELECT * FROM tblUser WHERE intUserID = " . $id);
		} else {
			return $obj->getEmpty("tblUser");
		}
	}

	public function loadAll () {
		$obj = new db;
		return $obj->getAll("SELECT * FROM tblUser");
	}

	public function getPin ($email) {
		$obj = new db;
		return $obj->getOne("SELECT vcPin FROM tblUser WHERE Email LIKE '" . $email . "'");
	}

	public function login ($rc) {
		$SQL = "SELECT intUserID FROM tblUser WHERE vcEmail LIKE '" . $rc["email"] . "' AND vcLogPW = '" . $rc["logpw"] . "'";
		$obj = new db;
		if ($RS = $obj->getOne($SQL)) {
			return $RS["intUserID"];
		} else {
			return 0;
		}
	}

} ?>


