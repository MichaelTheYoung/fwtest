<? class admin extends core {

	public function before ($rc) {
		return array(
			"messengerService",
			"userService",
			"userGateway",
			"pageService",
			"pageGateway",
			"documentService",
			"documentGateway",
			"imageService",
			"imageGateway",
			"galleryService",
			"galleryGateway",
			"galleryItemService",
			"galleryItemGateway"
		);
	}

	public function index ($rc) {
		if (!isset($rc["email"])) {
			$rc["email"] = ""; $rc["logpw"] = "";
		}
		$rc["view"] = "admin.index";
		return $rc;
	}

	public function processLogin ($rc) {

		if ($this->recCount("tblUser") == 0) {
			$rc["firstuser"] = true;
			$this->open("messenger")->addMessage("You are the first user. Create your account and you will have access to everything.", "confirm");
			$this->redirect("admin.formUser&id=0", $rc, true);
		}

		if ($this->open("users")->login($rc)) {
			$this->redirect("admin.viewMenu", $rc);
		} else {
			$this->redirect("admin", $rc, true);
		}
	}

	public function processLogout ($rc) {
		$this->open("users")->logout();
		$this->redirect("admin", $rc);
	}

	public function viewMenu ($rc) {

		$rc["nav"] = $this->open("pages")->loadAll();

		$rc["view"] = "admin.menu";
		return $rc;
	}

	public function listUsers ($rc) {

		if (isset($rc["del"])) {
			$this->open("users")->deleteUser($rc["del"]);
		}

		$rc["users"] = $this->open("users")->loadAll();

		$rc["view"] = "admin.userList";
		return $rc;
	}

	public function formUser ($rc) {

		$rc["user"] = $this->open("users")->load($rc["id"]);

		$rc["activelist"] = $this->getActiveList("form-control", $rc["user"]["intIsActive"]);

		if ($rc["id"] == 0) {
			$rc["button"] = "Add User";
			$rc["verb"] = "Add";
			$rc["user"]["vcLevel"] = "admin";

			if (in_array("firstuser", $rc)) {
				$rc["user"]["vcLevel"] = "god";
			}

		} else {
			$rc["button"] = "Save Changes";
			$rc["verb"] = "Edit";
		}

		$rc["view"] = "admin.userForm";
		return $rc;
	}

	public function processUser ($rc) {
		$rc = $this->open("users")->save($rc);
		$this->redirect("admin.listUsers", $rc);
	}

	public function forgotUser ($rc) {

		if (isset($rc["email"])) {
			$this->open("users")->forgot($rc["email"]);
			$this->redirect("admin", $rc);
		}

		$rc["view"] = "admin.userForgot";
		return $rc;
	}

	public function resetUser ($rc) {

		if (!isset($rc["pin"])) {
			$this->open("messenger")->addMessage("The link that brought you here was missing necessary elements.");
			$this->redirect("admin", $rc);
		}

		$rc["view"] = "admin.userReset";
		return $rc;
	}

	public function processResetUser ($rc) {

		if ($this->open("users")->resetPassword($rc["email"], $rc["pin"], $rc["log1"])) {

			$this->open("messenger")->addMessage("Your password was successfully reset.", "confirm");
			$this->redirect("admin", $rc);

		} else {

			$this->open("messenger")->addMessage("Your password reset failed.");
			$this->redirect("admin.resetUser&pin=" . $rc["pin"], $rc);
		}
	}

	public function viewPageMaker ($rc) {

		$pages = new pages;

		$rc["nav"] = $pages->loadAll();

		if (isset($rc["intPageID"])) {
			$rc["page"] = $pages->load($rc["intPageID"]);
			$rc["activelist"] = $this->getActiveList("form-control", $rc["page"]["intIsActive"]);
			$rc["intPageID"] == 0 ? $rc["verb"] = "Add New" : $rc["verb"] = "Edit " . $rc["page"]["vcNavName"];
			$rc["intPageID"] == 0 ? $rc["button"] = "Add Page" : $rc["button"] = "Save Changes";
		}

		$rc["view"] = "admin.pageMaker";
		return $rc;
	}

	public function processPageMaker ($rc) {
		$rc = $this->open("pages")->save($rc);
		$this->redirect("admin.viewPageMaker", $rc);
	}

	public function viewPageEditor ($rc) {

		$rc["page"] = $this->open("pages")->load($rc["intPageID"]);

		$rc["view"] = "admin.pageEditor";
		return $rc;
	}

	public function processPageEditor ($rc) {

		$pages = new pages;

		$rc["page"] = $pages->load($rc["intPageID"]);
		$rc["page"]["ntBody"] = $rc["ntBody"];

		$rc = $this->populate($rc, $rc["page"]);
		$rc = $pages->save($rc);

		$this->redirect("admin.viewMenu", $rc);
	}

	public function processSilentPage ($rc) {

		$pages = new pages;

		$rc["page"] = $pages->load($rc["intPageID"]);
		$rc["page"]["ntBody"] = $rc["otherbody"];

		$rc = $this->populate($rc, $rc["page"]);
		$rc = $pages->save($rc);
	}

	public function viewDocList ($rc) {

		$rc["docs"] = $this->open("docs")->loadAll();

		$rc["view"] = "admin.documentList";
		return $rc;
	}

	public function viewDocForm ($rc) {

		$rc["doc"] = $this->open("docs")->load($rc["id"]);

		$rc["view"] = "admin.documentForm";
		return $rc;
	}

	public function processDocForm ($rc) {

		$rc["prefix"] = "doc-";

		$rc["vcDocFile"] = $this->upload($rc);

		$rc = $this->open("docs")->save($rc);

		$this->redirect("admin.viewDocList", $rc);
	}

	public function deleteDoc ($rc) {

		$this->open("docs")->delete($rc);

		$this->redirect("admin.viewDocList", $rc);
	}

	public function getDocumentBank ($rc) {

		$rc["docs"] = $this->open("docs")->loadAll();

		$rc["view"] = "admin.documentBank";
		$rc["layout"] = "none";

		$this->render($rc);

		return $rc;
	}

	public function viewImageUploader ($rc) {

		$rc["maxuploads"] = $GLOBALS["maxUploads"];

		$blob = $this->open("pages")->loadAllContent();

		$rc["pics"] = $this->open("pics")->loadAll();

		$rc["usedPics"] = array();

		foreach ($rc["pics"] as $pic) {
			if (strstr($blob, $pic["vcPicFile"])) {
				array_push($rc["usedPics"], $pic["vcPicFile"]);
			}
		}

		$rc["view"] = "admin.imageUploader";
		return $rc;
	}

	public function processImageUpload ($rc) {

		$rc["prefix"] = "pic-";

		$rc["picArray"] = $this->multiUpload($rc);

		$this->open("pics")->writeAll($rc);

		$this->redirect("admin.viewImageUploader", $rc);
	}

	public function removeImage ($rc) {

		$this->open("pics")->delete($rc["id"]);

		$this->redirect("admin.viewImageUploader", $rc);
	}

	public function getImageBank ($rc) {

		$rc["pics"] = $this->open("pics")->loadAll();

		$rc["view"] = "admin.imageBank";
		$rc["layout"] = "none";

		$this->render($rc);

		return $rc;
	}

	public function listGalleries ($rc) {

		$rc["maxuploads"] = $GLOBALS["maxUploads"];

		$rc["picGalleries"] = $this->open("gallery")->loadAllByType(10);
		$rc["vidGalleries"] = $this->open("gallery")->loadAllByType(20);

		$rc["view"] = "admin.galleryList";
		return $rc;
	}

	public function viewGalleryForm ($rc) {

		$rc["gallery"] = $this->open("gallery")->load($rc["id"]);

		$rc["activeList"] = $this->getActiveList("form-control", $rc["gallery"]["intIsActive"]);

		$rc["typeList"]["10"] = "Photos";
		$rc["typeList"]["20"] = "Videos";

		if ($rc["id"] == 0) {
			$rc["button"] = "Add Gallery";
			$rc["verb"] = "Add";
			$rc["gallery"]["intIsActive"] = "0";
		} else {
			$rc["button"] = "Save Changes";
			$rc["verb"] = "Edit";
		}

		$rc["view"] = "admin.galleryForm";
		return $rc;
	}

	public function processGalleryForm ($rc) {

		$rc = $this->open("gallery")->save($rc);

		$this->redirect("admin.listGalleries", $rc);
	}

	public function viewGalleryPics ($rc) {

		$rc["gallery"] = $this->open("gallery")->load($rc["intGalleryID"]);

		$rc["pics"] = $this->open("galleryItem")->loadAllByGalleryID($rc["intGalleryID"]);

		$rc["picCount"] = count($rc["pics"]);

		$rc["maxuploads"] = $GLOBALS["maxUploads"];

		$rc["view"] = "admin.galleryPics";
		return $rc;
	}

	public function processGalleryPics ($rc) {

		$rc["prefix"] = "gal-";

		$tempId = $rc["intGalleryID"];

		$rc["picArray"] = $this->multiUpload($rc);

		foreach ($rc["picArray"] as $pic) {

			$newPic = $this->open("galleryItem")->load(0);
			$newPic["vcPicFile"] = $pic;
			$newPic["intGalleryID"] = $tempId;

			$rc = $this->populate($rc, $newPic);
			$rc = $this->open("galleryItem")->save($rc);
		}

		$rc["intGalleryID"] = $tempId;

		$this->redirect("admin.viewGalleryPics", $rc, true);
	}

	public function processGalleryOrders ($rc) {

		$arr = explode(",", $rc["numstring"]);

		foreach ($arr as $id) {

			$pic = $this->open("galleryItem")->load($id);

			$pic["intSortNo"] = $rc["sort-" . $id];
			$pic["vcVidTitle"] = $rc["title-" . $id];

			$rc = $this->populate($rc, $pic);

			$this->open("galleryItem")->save($rc);
		}

		if (strlen(trim($pic["vcVidTitle"])) == 0) {
			$this->redirect("admin.viewGalleryPics", $rc, true);
		} else {
			$this->redirect("admin.viewGalleryVids", $rc, true);
		}
	}

	public function viewGalleryVids ($rc) {

		$rc["gallery"] = $this->open("gallery")->load($rc["intGalleryID"]);

		$rc["vids"] = $this->open("galleryItem")->loadAllByGalleryID($rc["intGalleryID"]);

		$rc["vidCount"] = count($rc["vids"]);

		$rc["view"] = "admin.galleryVids";
		return $rc;
	}

	public function processGalleryVid ($rc) {

		$vid = $this->open("galleryItem")->load(0);
		$vid = $this->refresh($rc, $vid);

		$rc["isVid"] = true;

		$this->open("galleryItem")->save($vid);

		$this->redirect("admin.viewGalleryVids", $rc, true);
	}

	public function removeGallery ($rc) {

		$items = $this->open("galleryItem")->loadAllByGalleryID($rc["intGalleryID"]);

		foreach ($items as $item) {

			if (trim($item["vcPicFile"]) != "") {
				$this->killFile($item["vcPicFile"]);
			}

			$this->open("galleryItem")->delete($item["intGalleryItemID"]);
		}

		$this->open("gallery")->delete($rc["intGalleryID"]);

		$this->redirect("admin.listGalleries", $rc);
	}

	public function removeGalleryItem ($rc) {

		$rc["item"] = $this->open("galleryItem")->load($rc["intGalleryItemID"]);

		if (strlen(trim($rc["item"]["vcVidCode"])) == 0) {
			$this->killFile($rc["item"]["vcPicFile"]);
			$goNext = "admin.viewGalleryPics";
		} else {
			$goNext = "admin.viewGalleryVids";
		}

		$this->open("galleryItem")->delete($rc["intGalleryItemID"]);

		$this->redirect($goNext, $rc, true);
	}


} ?>


