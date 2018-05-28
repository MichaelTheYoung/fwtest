<? 
	class core {

		private function showPage($rc) {
			if ($this->getView($rc) != "") {
				include($this->getView($rc));
			}
		}

		private function getLayout($rc) {
			$layout = "";
			if (isset($rc["layout"])) {
				if (strtolower($rc["layout"]) != "none") {
					if (strstr($rc["layout"], ".")) {
						$arr = explode(".", $rc["layout"]);
						$layout = $GLOBALS["layoutPath"] . $arr[0] . "/" . $arr[1] . ".php";
					} else {
						$layout = $GLOBALS["layoutPath"] . $rc["layout"] . ".php";
					}
				}
				unset($rc["layout"]);
			} else {
				if (file_exists($GLOBALS["layoutPath"] . $rc["section"] . "/" . $GLOBALS["defaultPage"] . ".php")) {
					$layout = $GLOBALS["layoutPath"] . $rc["section"] . "/" . $GLOBALS["defaultPage"] . ".php";
				} else {
					$layout = $GLOBALS["layoutPath"] . "/index.php";
				}
			}
			return $layout;
		}

		private function getView($rc) {
			$view = "";
			if (isset($rc["view"])) {
				$arr = explode(".", $rc["view"]);
				$view = $GLOBALS["viewPath"] . $arr[0] . "/" . $arr[1] . ".php";
				unset($rc["view"]);
			}
			return $view;
		}

		private function loadServices($rc) {
			$arr = $this->doFunction($rc["section"], "before", $rc);
			foreach ($arr as $svc) {
				if (file_exists($GLOBALS["servicePath"] . $svc . ".php")) {
					include($GLOBALS["servicePath"] . $svc . ".php");
				}
				if (file_exists($GLOBALS["gatewayPath"] . $svc . ".php")) {
					include($GLOBALS["gatewayPath"] . $svc . ".php");
				}
			}
			return $rc;
		}

		private function getContent($rc) {
			$obj = $rc["section"];
			$func = $rc["item"];
			return $this->doFunction($obj, $func, $rc);
		}

		private function doFunction($obj, $func, $rc) {
			$obj = new $obj;
			return $obj->$func($rc);
		}

		private function loadRequest($rc) {
			if (isset($_REQUEST)) {
				while (list($key, $val) = each($_REQUEST)) {
					$rc[$key] = $val;
				}
			}
			return $rc;
		}

		private function loadQueryString($rc) {
			if (trim($_SERVER["QUERY_STRING"]) != "") {
				$arr = explode("&", $_SERVER["QUERY_STRING"]);
				foreach ($arr as $elm) {
					$subarr = explode("=", $elm);
					$rc[$subarr[0]] = $subarr[1];
				}
				if (isset($rc["action"])) {
					unset($rc["action"]);
				}
				$rc["querystring"] = $_SERVER["QUERY_STRING"];
			}
			return $rc;
		}

		private function findSection($rc) {
			if (!isset($_REQUEST["action"])) {
				$section = "main";
				$thispage = $GLOBALS["defaultPage"];
			} else {
				if (strstr($_REQUEST["action"], ".")) {
					$pair = explode(".", $_REQUEST["action"]);
					$section = $pair[0];
					$thispage = $pair[1];
				} else {
					$section = $_REQUEST["action"];
					$thispage = $GLOBALS["defaultPage"];
				}
			}
			$rc["section"] = $section;
			$rc["item"] = $thispage;
			return $rc;
		}

		private function loadControllers($rc) {
			$controllers = array();
			if ($dh = opendir($GLOBALS["controlPath"])) {
				while ($file = readdir($dh)) {
					if (strstr(strtolower($file), ".php")) {
						include($GLOBALS["controlPath"] . $file);
						array_push($controllers, $GLOBALS["controlPath"] . $file);
					}
				}
				closedir($dh);
			}
			$rc["controllers"] = $controllers;
			return $rc;
		}

		private function makeError($errorText) {
			?><div style="width: auto; height: auto; margin: 12px; padding: 16px; font-family: helvetica; background-color: #EEDDDD; border: 1px solid #666666;"><?=$errorText?></div><?
			exit;
		}

		public function render($rc) {
			$this->showPage($rc);
		}

		public function open($class) {
			return new $class;
		}

		public function populate($rc, $struct) {
			while (list($key, $val) = each($struct)) {
				$rc[$key] = $struct[$key];
			}
			return $rc;
		}

		public function refresh($rc, $struct) {
			while (list($key, $val) = each($struct)) {
				if (isset($rc[$key])) {
					$struct[$key] = $rc[$key];
				}
			}
			return $struct;
		}

		public function buildUrl($tmp) {
			$sectionpage = $tmp;
			$ustring = "";
			if (strstr($tmp, "?")) {
				$arr = explode("?", $tmp);
				$ustring = $arr[1];
				$sectionpage = $arr[0];
			}
			if (strstr($sectionpage, ".")) {
				$arr = explode(".", $sectionpage);
				$section = $arr[0];
				$page = $arr[1];
				$sectionpage = $section . "." . $page;
			}
			if ($ustring != "") {
				$sectionpage .= "&" . $ustring;
			}
			$newurl = "index.php?action="  . $sectionpage;
			return $newurl;
		}

		public function redirect($action, $rc, $keep = false) {
			$keep ? $_SESSION["rc"] = $rc : null;
			$url = "index.php?action=" . $action;
			header("Location: " . $url); exit;
		}

		public function hardRedirect($action, $rc, $keep = false) {
			$keep ? $_SESSION["rc"] = $rc : null;
			$url = "index.php?action=" . $action;
			$base = "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=NEXT\">";
			echo str_replace("NEXT", $url, $base); exit;
		}

		public function dumpvar($var, $stop = true) {
			if (!is_array($var)) {
				$arr = array($var);
			} else {
				$arr = $var;
			}
			?><table style="background-color: #EEEEEE; border: 1px solid #666666; margin-left: 40px; margin-top: 40px;"><?
			while (list($key, $val) = each($arr)) {
				?><tr><td style="padding: 4px; white-space: nowrap; text-align: right; vertical-align: top; color: #000000; white-space: nowrap;"><?=$key?></td>
				<td style="width: 20px; text-align: center; vertical-align: top; color: #000000;">:</td>
				<td style="padding: 4px; white-space: nowrap; vertical-align: top; color: #000000; white-space: nowrap;"><?
				if (is_array($val)) {
					foreach ($val as $elm) {
						?><?=$elm?><br><?
					}
				} else if (is_object($val)) {
					?>[object]<?
				} else {
					?><?=$val?><?
				}
				?></td></tr><?
			}
			?></table><?
			if ($stop) {
				exit;
			}
		}

		public function killFile($tmp) {
			if (trim($tmp) !== "") {
				if (file_exists($GLOBALS["uploadPath"] . trim($tmp))) {
					unlink($GLOBALS["uploadPath"] . trim($tmp));
				}
			}
		}

		public function makeString($tmp, $add, $del) {
			return $tmp == "" ? $add : $tmp .= $del . $add;
		}

		public function dateAdd($sqldate, $inc) {
			date_default_timezone_set("UTC");
			$arr = explode("-", $sqldate);
			$oldStamp = mktime(0, 0, 0, $arr[1], $arr[2], $arr[0]);
			$newStamp = ($oldStamp + ($inc * 86400));
			$newDate = date("Y-m-d", $newStamp);
			date_default_timezone_set($GLOBALS["timeZone"]);
			return $newDate;
		}

		public function dateToUnix($sqlDate) {
			$arr = explode("-", $sqldate);
			return mktime(0, 0, 0, $arr[1], $arr[2], $arr[0]);
		}

		public function isEven($num) {
			if (strstr("24680", substr($num, -1))) {
				return true;
			}
			return false;
		}

		public function updateStamp() {
			$stamp = ", intModifiedBy = " . $_SESSION["user"]["userid"];
			$stamp .= ", vcModifyDate = '" . date("Y-m-d") . "' ";
			$stamp .= ", vcModifyTime = '" . date("g:i A") . "' ";
			return $stamp;
		}

		public function startStamp() {
			return ", intCreatedBy, vcCreateDate, vcCreateTime";
		}

		public function finishStamp() {
			$stamp = ", ";
			isset($_SESSION["user"]["userid"]) ? $stamp .= $_SESSION["user"]["userid"] : $stamp .= "0";
			$stamp .= ", '" . date("Y-m-d");
			$stamp .= "', '" . date("g:i A") . "')";
			return $stamp;
		}

		public function getActiveList($style, $chosen) {
			$stuff = "<select id=\"intIsActive\" name=\"intIsActive\" class=\"" . $style . "\">";
			$stuff .= "<option value=\"0\"";
			if ($chosen == "0") {
				$stuff .= " selected";
			}
			$stuff .= ">Inactive</option>";
			$stuff .= "<option value=\"1\"";
			if ($chosen == "1") {
				$stuff .= " selected";
			}
			$stuff .= ">Active</option></select>";
			return $stuff;
		}

		public function StartSelect($useblank, $name, $aclass, $onchange) {
			$tmp = "<select  id=\"" . $name . "\" name=\"" . $name . "\" class=\"" . $aclass + "\"";
			if ($onchange != "") {
				$tmp .= " onChange=\"" + $onchange + ";\"";
			}
			$tmp .= ">";
			if ($useblank == 1) {
				$tmp .= "<option value=\"\">Select...</option>";
			}
			return $tmp;
		}

		public function MakeOption($key, $chosen, $value) {
			$key == $chosen ? $word = " selected" : $word = "";
			return "<option value=\"" . $key . "\"" . $word . ">" . $value . "</option>";
		}

		public function upload ($rc) {
			if (is_uploaded_file($_FILES["docfile"]["tmp_name"])) {
				$tempFile = $_FILES["docfile"]["name"];
				$tempArray = explode(".", $tempFile);
				$tempCount = count($tempArray);
				$ext = "." . strtolower($tempArray[$tempCount - 1]);
				$docFile = $rc["prefix"] . time() . $ext;
				$dest = $GLOBALS["uploadPath"] . $docFile;
				move_uploaded_file($_FILES["docfile"]["tmp_name"], $dest);
				if (($ext == ".jpg") || ($ext == ".jpeg")) {
					$this->resize($dest);
				}
				return $docFile;
			}
		}

		public function multiUpload ($rc) {
			$picArray = array();
			for ($i = 1; $i <= $rc["maxuploads"]; $i++) {
				if (is_uploaded_file($_FILES["docfile-" . $i]["tmp_name"])) {
					$tempFile = $_FILES["docfile-" . $i]["name"];
					$tempArray = explode(".", $tempFile);
					$tempCount = count($tempArray);
					$ext = "." . strtolower($tempArray[$tempCount - 1]);
					$docFile = $rc["prefix"] . time() . "-" . $i . $ext;
					$dest = $GLOBALS["uploadPath"] . $docFile;
					move_uploaded_file($_FILES["docfile-" . $i]["tmp_name"], $dest);
					if (($ext == ".jpg") || ($ext == ".jpeg")) {
						$this->resize($dest);
					}
					array_push($picArray, $docFile);
				}
			}
			return $picArray;
		}

		public function resize ($theFile) {
			$resize = 0;
			list($picW, $picH) = getimagesize($theFile);
			if ($picW > 1000) {
				$pct = 0.75;
				if ($picW > 1400) {
					$pct = 0.50;
				}
				if ($picW > 2000) {
					$pct = 0.35;
				}
				if ($picW > 3000) {
					$pct = 0.25;
				}
				$resize = 1;
			} else {
				if (filesize($theFile) > 100000) {
					$pct = 0.95;
					$resize = 1;
				}
			}
			if ($resize == 1) {
				echo "<meta http-equiv=\"content-type\" content=\"image/jpeg\">";
				$newW = ($picW * $pct);
				$newH = ($picH * $pct);
				$qual = 75;
				$image_p = imagecreatetruecolor($newW, $newH);
				$image = imagecreatefromjpeg($theFile);
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $newW, $newH, $picW, $picH);
				imagejpeg($image_p, $theFile, $qual);
				ob_end_clean();
				ob_start();
				echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">";
			}
		}

		public function listappend($str, $add, $del = ",") {
			return $str == "" ? $add : $str . $del . $add;
		}

		public function dbConn() {
			$db = mysqli_connect($GLOBALS["hostName"], $GLOBALS["userName"], $GLOBALS["password"]);
			mysqli_select_db($db, $GLOBALS["database"]);
			return $db;
		}

		public function writeOneReturn($SQL) {
			mysqli_query($this->dbConn(), $SQL);
			return mysqli_insert_id($this->dbConn());
		}

		public function writeOne($SQL) {
			mysqli_query($this->dbConn(), $SQL);
		}

		public function getOne($SQL) {
			return mysqli_fetch_array(mysqli_query($this->dbConn(), $SQL), MYSQLI_ASSOC);
		}

		public function getAll($SQL) {
			$tempArray = array();
			if ($rec = mysqli_fetch_array(mysqli_query($this->dbConn(), $SQL), MYSQLI_ASSOC)) {
				$kounter = 0;
				while (list($key, $val) = each($rec)) {
					$fieldList[$kounter] = $key;
					$kounter++;
				}
				$kounter = 0;
				$rec = mysqli_fetch_array(mysqli_query($this->dbConn(), $SQL), MYSQLI_ASSOC);
				while (list($key, $val) = each($rec)) {
					$nameList[$kounter] = $key;
					$kounter++;
				}
				$rec = mysqli_query($this->dbConn(), $SQL);
				while ($row = mysqli_fetch_row($rec)) {
					while (list($key, $val) = each($row)) {
						$rowList[$nameList[$key]] = $val;
					}
					array_push($tempArray, $rowList);
				}
			}
			return $this->batchUnclean($tempArray);
		}

		public function getEmpty($table) {
			$columns = $this->getAll("SHOW COLUMNS IN " . $table);
			foreach ($columns as $col) {
				if ($col["Extra"] == "auto_increment") {
					$rec[$col["Field"]] = 0;
				} else {
					$rec[$col["Field"]] = $col["Default"];
				}
			}
			return $rec;
		}

		public function recCount ($table) {
			$rs = $this->getOne("SELECT COUNT(*) AS RecCount FROM " . $table);
			return $rs["RecCount"];
		}

		public function clean($tmp) {
			$clean = trim($tmp);
			$clean = mysqli_real_escape_string($this->dbConn(), $clean);
			if (strlen($clean) < 1) {
				$clean = " ";
			}
			$pbreak = chr(13) . chr(10);
			$clean = str_replace($pbreak, "<br>", $clean);
			$otherpbreak = "\\n";
			$clean = str_replace($otherpbreak, "<br>", $clean);
			$toFix = "\%";
			$clean = str_replace($toFix, "\\%", $clean);
			return $clean;
		}

		public function unclean($tmp, $inBox = 0) {
			$unclean = trim($tmp);
			if ($inBox == 1) {
				$pbreak = chr(13) . chr(10);
				$pbreak = "\n";
				$unclean = str_replace("<br>", $pbreak, $unclean);
			}
			$toFix = "\\" . chr(34);
			$unclean = str_replace($toFix, chr(34), $unclean);
			$toFix = "\\%";
			$unclean = str_replace($toFix, "\%", $unclean);
			$toFix = "\'";
			$unclean = str_replace($toFix, "'", $unclean);
			$toFix = chr(92) . chr(92);
			$unclean = str_replace($toFix, chr(92), $unclean);
			return $unclean;
		}

		public function wclean($tmp) {
			$clean = trim($tmp);
			$clean = mysqli_real_escape_string($this->dbConn(), $clean);
			if (strlen($clean) < 1) {
				$clean = " ";
			}
			$toFix = "\%";
			$clean = str_replace($toFix, "\\%", $clean);
			$clean = str_replace("<TBODY>", "", $clean);
			$clean = str_replace("</TBODY>", "", $clean);
			$clean = str_replace("<SPAN>", "", $clean);
			$clean = str_replace("</SPAN>", "", $clean);
			$clean = str_replace("<span>", "", $clean);
			$clean = str_replace("</span>", "", $clean);
			return $clean;
		}

		public function wunclean($tmp) {
			$unclean = trim($tmp);
			$toFix = "\\" . chr(34);
			$unclean = str_replace($toFix, chr(34), $unclean);
			$toFix = "\\%";
			$unclean = str_replace($toFix, "\%", $unclean);
			$toFix = "\'";
			$unclean = str_replace($toFix, "'", $unclean);
			$toFix = chr(92) . chr(92);
			$unclean = str_replace($toFix, chr(92), $unclean);
			return $unclean;
		}

		private function batchUnclean($rs) {
			while (list($key, $val) = each($rs)) {
				if ((substr($key, 0, 2) == "vc") || (substr($key, 0, 2) == "nt")) {
					$rs[$key] = $this->unclean($val);
				}
			}
			return $rs;
		}

		public function init($rc) {
			if (isset($_SESSION["rc"])) {
				$rc = $_SESSION["rc"];
				unset($_SESSION["rc"]);
			}
			$rc = $this->findSection($rc);
			$rc = $this->loadRequest($rc);
			$rc = $this->loadQueryString($rc);
			$rc = $this->loadControllers($rc);
			$rc = $this->loadServices($rc);
			$rc = $this->getContent($rc);
			$layout = $this->getLayout($rc);
			if ($layout != "") {
				include($layout);
			}
			return $rc;
		}

	}

	session_start();

	include("config.php");

	!isset($rc) ? $rc = array() : null;
	$core = new core;
	$rc = $core->init($rc);

?>


