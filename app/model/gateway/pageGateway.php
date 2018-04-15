<? class pageQry extends core {

	public function create ($rc) {
		$SQL = "INSERT INTO tblPage (
			intParentID
			, intLevel
			, intSortOrder
			, intIsActive
			, vcSection
			, vcItem
			, vcNavName
			, vcTitle
			, ntBody
			, intCreatedBy
			, vcCreateDate
			, vcCreateTime";
		$SQL .= ") VALUES (";
			$SQL .= $rc["intParentID"] . ", ";
			$SQL .= $rc["intLevel"] . ", ";
			$SQL .= $rc["intSortOrder"] . ", ";
			$SQL .= $rc["intIsActive"] . ", '";
			$SQL .= $rc["vcSection"] . "', '";
			$SQL .= $rc["vcItem"] . "', '";
			$SQL .= $this->wclean($rc["vcNavName"]) . "', '";
			$SQL .= $this->wclean($rc["vcTitle"]) . "', '";
			$SQL .= $this->wclean($rc["ntBody"]) . "', ";
			$SQL .= $_SESSION["user"]["userid"] . ", '";
			$SQL .= date("Y-m-d") . "', '";
			$SQL .= date("h:i A") . "')";
		return $this->writeOneReturn($SQL);
	}

	public function update ($rc) {
		$SQL = "UPDATE tblPage SET ";
		$SQL .= "intParentID = " . $rc["intParentID"] . ", ";
		$SQL .= "intLevel = " . $rc["intLevel"] . ", ";
		$SQL .= "intSortOrder = " . $rc["intSortOrder"] . ", ";
		$SQL .= "intIsActive = " . $rc["intIsActive"] . ", ";
		$SQL .= "vcSection = '" . $this->wclean($rc["vcSection"]) . "', ";
		$SQL .= "vcItem = '" . $this->wclean($rc["vcItem"]) . "', ";
		$SQL .= "vcNavName = '" . $this->wclean($rc["vcNavName"]) . "', ";
		$SQL .= "vcTitle = '" . $this->wclean($rc["vcTitle"]) . "', ";
		$SQL .= "ntBody = '" . $this->wclean($rc["ntBody"]) . "', ";
		$SQL .= "intModifiedBy = " . $_SESSION["user"]["userid"] . ", ";
		$SQL .= "vcModifyDate = '" . date("Y-m-d") . "', ";
		$SQL .= "vcModifyTime = '" . date("g:i A") . "' ";
		$SQL .= "WHERE intPageID = " . $rc["intPageID"];
		$this->writeOne($SQL);
	}

	public function load ($id) {
		if ($id > 0) {
			return $this->getOne("SELECT * FROM tblPage WHERE intPageID = " . $id);
		} else {
			return $this->getEmpty("tblPage");
		}
	}

	public function loadAll ($active = false) {
		$SQL = "SELECT * FROM tblPage";
		if ($active) {
			$SQL .= " WHERE intIsActive = 1";
		}
		return $this->getAll($SQL);
	}

	public function loadAllContent () {
		return $this->getAll("SELECT ntBody FROM tblPage");
	}

	public function loadContent ($id) {
		return $this->getOne("SELECT inPageID, vcTitle, ntBody FROM tblPage WHERE intPageID = " . $id);
	}

	public function loadBySection ($section, $item) {
		return $this->getOne("SELECT * FROM tblPage WHERE vcSection = '" . $section . "' AND vcItem = '" . $item . "'");
	}

	public function loadParents () {
		return $this->getAll("SELECT * FROM tblPage WHERE intParentID = 0 ORDER BY intSortOrder ASC, intPageID ASC");
	}

	public function loadChildren ($parentID) {
		return $this->getAll("SELECT * FROM tblPage WHERE intParentID = " . $parentID . " ORDER BY intSortOrder ASC");
	}

	public function findHome () {
		if ($rec = $this->getOne("SELECT intPageID FROM tblPage WHERE intParentID = 0 ORDER BY intSortOrder ASC LIMIT 1")) {
			return $rec["intPageID"];
		} else {
			return 0;
		}
	}


} ?>
