<? class galleryItemQry extends core {

	public function create ($rc) {
		$SQL = "INSERT INTO tblGalleryItem (
			intGalleryID
			, intSortNo
			, vcVidTitle
			, vcCaption
			, vcPicFile
			, vcVidCode
			, intCreatedBy
			, vcCreateDate
			, vcCreateTime";
		$SQL .= ") VALUES (";
			$SQL .= $rc["intGalleryID"] . ", ";
			$SQL .= $rc["intSortNo"] . ", '";
			$SQL .= $rc["vcVidTitle"] . "', '";
			$SQL .= $rc["vcCaption"] . "', '";
			$SQL .= $rc["vcPicFile"] . "', '";
			$SQL .= $rc["vcVidCode"] . "', ";
			$SQL .= $_SESSION["user"]["userid"] . ", '";
			$SQL .= date("Y-m-d") . "', '";
			$SQL .= date("h:i A") . "')";
		return $this->writeOneReturn($SQL);
	}

	public function update ($rc) {
		$SQL = "UPDATE tblGalleryItem SET ";
		$SQL .= "intSortNo = " . $rc["intSortNo"] . ", ";
		$SQL .= "vcVidTitle = '" . $rc["vcVidTitle"] . "', ";
		$SQL .= "vcCaption = '" . $rc["vcCaption"] . "', ";
		$SQL .= "vcPicFile = '" . $rc["vcPicFile"] . "', ";
		$SQL .= "vcVidCode = '" . $rc["vcVidCode"] . "', ";
		$SQL .= "intModifiedBy = " . $_SESSION["user"]["userid"] . ", ";
		$SQL .= "vcModifyDate = '" . date("Y-m-d") . "', ";
		$SQL .= "vcModifyTime = '" . date("g:i A") . "' ";
		$SQL .= "WHERE intGalleryItemID = " . $rc["intGalleryItemID"];
		$this->writeOne($SQL);
	}

	public function load ($id) {
		if ($id > 0) {
			return $this->getOne("SELECT * FROM tblGalleryItem WHERE intGalleryItemID = " . $id);
		} else {
			return $this->getEmpty("tblGalleryItem");
		}
	}

	public function loadAllByGalleryID ($id) {
		return $this->getAll("
			SELECT 
				intGalleryItemID
				, intSortNo
				, vcVidTitle
				, vcCaption
				, vcPicFile
				, vcVidCode 
			FROM 
				tblGalleryItem 
			WHERE 
				intGalleryID = $id 
			ORDER BY 
				intSortNo ASC 
		");
	}

	public function delete ($id) {

		$this->writeOne("DELETE FROM tblGalleryItem WHERE intGalleryItemID = " . $id);
	}


} ?>