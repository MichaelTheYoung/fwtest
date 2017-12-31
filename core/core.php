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
				$rc["_querystring_"] = $_SERVER["QUERY_STRING"];
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

		public function render($rc) {
			$this->showPage($rc);
		}

		public function open($class) {
			return $class = new $class;
		}

		public function populate($rc, $struct) {
			while (list($key, $val) = each($struct)) {
				$rc[$key] = $struct[$key];
			}
			return $rc;
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

		function wclean($tmp) {
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

		function wunclean($tmp) {
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


