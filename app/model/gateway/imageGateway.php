<? class picsQry extends core {

	public function create ($rc) {
		$SQL = "INSERT INTO tblImage (
			intIsActive
			, vcPicFile
			, intCreatedBy
			, vcCreateDate
			, vcCreateTime";
		$SQL .= ") VALUES (";
			$SQL .= $rc["intIsActive"] . ", '";
			$SQL .= $rc["vcPicFile"] . "', ";
			$SQL .= $_SESSION["user"]["userid"] . ", '";
			$SQL .= date("Y-m-d") . "', '";
			$SQL .= date("h:i A") . "')";
		return $this->writeOneReturn($SQL);
	}

	public function load ($id) {
		if ($id > 0) {
			return $this->getOne("SELECT intImageID, intIsActive, vcPicFile FROM tblImage WHERE intImageID = " . $id);
		} else {
			return $this->getEmpty("tblImage");
		}
	}

	public function loadAll () {
		return $this->getAll("SELECT intImageID, intIsActive, vcPicFile FROM tblImage ORDER BY intImageID ASC");
	}

	public function delete ($id) {

		$this->writeOne("DELETE FROM tblImage WHERE intImageID = " . $id);
	}



} ?>