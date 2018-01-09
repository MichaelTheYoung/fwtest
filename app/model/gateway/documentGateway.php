<? class docsQry extends core {

	public function create ($rc) {
		$db = $this->open("db");
		$SQL = "INSERT INTO tblDocument (vcDocTitle, vcDocFile) VALUES ('" . $db->clean($rc["vcDocTitle"]) . "', '" . $rc["vcDocFile"] . "')";
		return $db->writeOneReturn($SQL);
	}

	public function load ($id) {
		if ($id > 0) {
			return $this->open("db")->getOne("SELECT intDocumentID, vcDocTitle, vcDocFile FROM tblDocument WHERE intDocumentID = " . $id);
		} else {
			return $this->open("db")->getEmpty("tblDocument");
		}
	}

	public function loadAll () {
		return $this->open("db")->getAll("SELECT intDocumentID, vcDocTitle, vcDocFile FROM tblDocument ORDER BY vcDocTitle ASC");
	}

	public function delete ($rc) {
		$this->open("db")->writeOne("DELETE FROM tblDocument WHERE intDocumentID = " . $rc["id"]);
	}

} ?>

