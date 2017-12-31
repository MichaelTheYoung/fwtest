<? class pageQry extends core {

	public function create ($rc) {
		$db = $this->open("db");
		$SQL = "INSERT INTO tblPage (
			intParentID
			, intLevel
			, intSortOrder
			, intIsActive
			, vcSection
			, vcItem
			, vcNavName
			, vcTitle
			, ntBody";
		$SQL .= $this->open("util")->startStamp();
		$SQL .= ") VALUES (";
			$SQL .= $rc["intParentID"] . ", ";
			$SQL .= $rc["intLevel"] . ", ";
			$SQL .= $rc["intSortOrder"] . ", ";
			$SQL .= $rc["intIsActive"] . ", '";
			$SQL .= $rc["vcSection"] . "', '";
			$SQL .= $rc["vcItem"] . "', '";
			$SQL .= $db->wclean($rc["vcNavName"]) . "', '";
			$SQL .= $db->wclean($rc["vcTitle"]) . "', '";
			$SQL .= $db->wclean($rc["ntBody"]) . "'";
			$SQL .= $db->open("util")->finishStamp();
		return $db->writeOneReturn($SQL);
	}

	public function update ($rc) {
		$db = $this->open("db");
		$SQL = "UPDATE tblPage SET ";
		$SQL .= "intParentID = " . $rc["intParentID"] . ", ";
		$SQL .= "intLevel = " . $rc["intLevel"] . ", ";
		$SQL .= "intSortOrder = " . $rc["intSortOrder"] . ", ";
		$SQL .= "intIsActive = " . $rc["intIsActive"] . ", ";
		$SQL .= "vcSection = '" . $db->wclean($rc["vcSection"]) . "', ";
		$SQL .= "vcItem = '" . $db->wclean($rc["vcItem"]) . "', ";
		$SQL .= "vcNavName = '" . $db->wclean($rc["vcNavName"]) . "', ";
		$SQL .= "vcTitle = '" . $db->wclean($rc["vcTitle"]) . "', ";
		$SQL .= "ntBody = '" . $db->wclean($rc["ntBody"]) . "' ";
		$SQL .= $this->open("util")->updateStamp();
		$SQL .= "WHERE intPageID = " . $rc["intPageID"];
		$db->writeOne($SQL);
	}

	public function load ($id) {
		if ($id > 0) {
			return $this->open("db")->getOne("SELECT * FROM tblPage WHERE intPageID = " . $id);
		} else {
			return $this->open("db")->getEmpty("tblPage");
		}
	}

	public function loadContent ($id) {
		return $this->open("db")->getOne("SELECT inPageID, vcTitle, ntBody FROM tblPage WHERE intPageID = " . $id);
	}

	public function loadBySection ($section, $item) {
		return $this->open("db")->getOne("SELECT * FROM tblPage WHERE vcSection = '" . $section . "' AND vcItem = '" . $item . "'");
	}

	public function loadAll () {
		return $this->open("db")->getAll("SELECT * FROM tblPage");
	}

	public function loadParents () {
		return $this->open("db")->getAll("SELECT * FROM tblPage WHERE intParentID = 0 ORDER BY intSortOrder ASC, intPageID ASC");
	}

	public function loadChildren () {
		return $this->open("db")->getAll("SELECT * FROM tblPage WHERE intParentID > 0 ORDER BY intParentID ASC, intSortOrder ASC, intPageID ASC");
	}

} ?>
