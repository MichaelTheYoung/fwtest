<? class galleryQry extends core {

	public function create ($rc) {
		$SQL = "INSERT INTO tblGallery (
			intIsActive
			, intGType
			, intSortNo
			, vcTitle
			, intCreatedBy
			, vcCreateDate
			, vcCreateTime";
		$SQL .= ") VALUES (";
			$SQL .= $rc["intIsActive"] . ", ";
			$SQL .= $rc["intGType"] . ", ";
			$SQL .= $rc["intSortNo"] . ", '";
			$SQL .= $this->clean($rc["vcTitle"]) . "', ";
			$SQL .= $_SESSION["user"]["userid"] . ", '";
			$SQL .= date("Y-m-d") . "', '";
			$SQL .= date("h:i A") . "')";
		return $this->writeOneReturn($SQL);
	}

	public function update ($rc) {
		$SQL = "UPDATE tblGallery SET ";
		$SQL .= "intIsActive = " . $rc["intIsActive"] . ", ";
		$SQL .= "intGType = " . $rc["intGType"] . ", ";
		$SQL .= "intSortNo = " . $rc["intSortNo"] . ", ";
		$SQL .= "vcTitle = '" . $this->clean($rc["vcTitle"]) . "', ";
		$SQL .= "intModifiedBy = " . $_SESSION["user"]["userid"] . ", ";
		$SQL .= "vcModifyDate = '" . date("Y-m-d") . "', ";
		$SQL .= "vcModifyTime = '" . date("g:i A") . "' ";
		$SQL .= "WHERE intGalleryID = " . $rc["intGalleryID"];
		$this->writeOne($SQL);
	}

	public function load ($id) {
		if ($id > 0) {
			return $this->getOne("SELECT * FROM tblGallery WHERE intGalleryID = " . $id);
		} else {
			return $this->getEmpty("tblGallery");
		}
	}

	public function loadAllByType ($type) {
		return $this->getAll("
			SELECT 
				g.intGalleryID
				, g.vcTitle 
				, COUNT(i.intGalleryID) AS itemCount
			FROM 
				tblGallery AS g 
			LEFT OUTER JOIN 
				tblGalleryItem AS i 
			ON 
				i.intGalleryID = g.intGalleryID
			WHERE 
				g.intGType = $type 
			GROUP BY 
				g.intGalleryID
				, g.vcTitle 
			ORDER BY 
				g.intSortNo ASC 
		");
	}

	public function delete ($id) {

		$this->writeOne("DELETE FROM tblGallery WHERE intGalleryID = " . $id);
	}


} ?>