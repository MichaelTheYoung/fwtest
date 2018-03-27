<? class docsQry extends core {

	public function create ($rc) {
		$SQL = "INSERT INTO tblDocument (
			vcDocTitle
			, vcDocFile
			, intCreatedBy
			, vcCreateDate
			, vcCreateTime";
		$SQL .= ") VALUES ('";
			$SQL .= $this->clean($rc["vcDocTitle"]) . "', '";
			$SQL .= $rc["vcDocFile"] . "', ";
			$SQL .= $_SESSION["user"]["userid"] . ", '";
			$SQL .= date("Y-m-d") . "', '";
			$SQL .= date("h:i A") . "')";
		return $this->writeOneReturn($SQL);
	}

	public function load ($id) {
		if ($id > 0) {
			return $this->getOne("SELECT intDocumentID, vcDocTitle, vcDocFile FROM tblDocument WHERE intDocumentID = " . $id);
		} else {
			return $this->getEmpty("tblDocument");
		}
	}

	public function loadAll () {
		return $this->getAll("SELECT intDocumentID, vcDocTitle, vcDocFile FROM tblDocument ORDER BY vcDocTitle ASC");
	}

	public function delete ($rc) {
		$this->writeOne("DELETE FROM tblDocument WHERE intDocumentID = " . $rc["id"]);
	}

} ?>

