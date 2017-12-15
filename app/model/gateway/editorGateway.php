<? class editorGateway extends fw {

	public function create ($rc) {
		$obj = $this->open("db");
		$SQL = "INSERT INTO tblEditor (
			intParentID
			, intLevel
			, intSortOrder
			, intIsActive
			, vcSection
			, vcItem
			, vcNavName
			, vcTitle
			, ntBody

		) VALUES (";
			$SQL .= $rc["intParentID"] . ", ";
			$SQL .= $rc["intLevel"] . ", ";
			$SQL .= $rc["intSortOrder"] . ", ";
			$SQL .= $rc["intIsActive"] . ", '";
			$SQL .= $rc["vcSection"] . "', '";
			$SQL .= $rc["vcItem"] . "', '";
			$SQL .= $obj->wclean($rc["vcNavName"]) . "', '";
			$SQL .= $obj->wclean($rc["vcTitle"]) . "', '";
			$SQL .= $obj->wclean($rc["ntBody"]) . "'
		)";
		return $obj->writeOneReturn($SQL);
	}

	public function update ($rc) {
		$obj = $this->open("db");
		$SQL = "UPDATE tblEditor SET ";
		$SQL .= "intParentID = " . $rc["intParentID"] . ", ";
		$SQL .= "intLevel = " . $rc["intLevel"] . ", ";
		$SQL .= "intSortOrder = " . $rc["intSortOrder"] . ", ";
		$SQL .= "intIsActive = " . $rc["intIsActive"] . ", ";
		$SQL .= "vcSection = '" . $obj->wclean($rc["vcSection"]) . "', ";
		$SQL .= "vcItem = '" . $obj->wclean($rc["vcItem"]) . "', ";
		$SQL .= "vcNavName = '" . $obj->wclean($rc["vcNavName"]) . "', ";
		$SQL .= "vcTitle = '" . $obj->wclean($rc["vcTitle"]) . "' ";
		$SQL .= "ntBody = '" . $obj->wclean($rc["ntBody"]) . "' ";
		$SQL .= "WHERE intUserID = " . $rc["intUserID"];
		$obj->writeOne($SQL);
	}

	public function load ($id) {
		if ($id > 0) {
			return $this->open("db")->getOne("SELECT * FROM tblEditor WHERE intUserID = " . $id);
		} else {
			return $this->open("db")->getEmpty("tblEditor");
		}
	}

	public function loadBySection ($section, $item) {
		return $this->open("db")->getOne("SELECT * FROM tblEditor WHERE vcSection = '" . $section . "' AND vcItem = '" . $item . "'");
	}

	public function loadAll () {
		return $this->open("db")->getAll("SELECT * FROM tblEditor");
	}

} ?>
