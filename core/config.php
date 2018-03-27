<?
	$GLOBALS["appName"] = "Framework Test";
	$GLOBALS["appDomain"] = "heymichael.com";

	$GLOBALS["appBase"] = "app/";

	$GLOBALS["controlPath"] = $appBase . "controller/";
	$GLOBALS["servicePath"] = $appBase . "model/service/";
	$GLOBALS["gatewayPath"] = $appBase . "model/gateway/";
	$GLOBALS["viewPath"] = $appBase . "view/";
	$GLOBALS["layoutPath"] = $appBase . "layouts/";

	$GLOBALS["assetsPath"] = "assets/";
	$GLOBALS["uploadPath"] = "uploads/";
	$GLOBALS["editorPath"] = "ckeditor/";

	$GLOBALS["defaultPage"] = "index";

	$GLOBALS["maxPages"] = 8;

	$GLOBALS["timeZone"] = "America/Chicago";


	if (strstr($_SERVER["SERVER_NAME"], "localhost")) {

		$GLOBALS["hostPath"] = "http://" . $_SERVER["HTTP_HOST"] . "/sites/fwtest/";

		$GLOBALS["hostName"] = "localhost";
		$GLOBALS["userName"] = "root";
		$GLOBALS["password"] = "";
		$GLOBALS["database"] = "fwbase";

		$GLOBALS["useMail"] = "no";
		$GLOBALS["mailContact"] = "michael@heymichael.com";

	} else if (strstr($_SERVER["SERVER_NAME"], "heymichael")) {

		$GLOBALS["hostPath"] = "http://" . $_SERVER["HTTP_HOST"] . "/fwbase/";

		$GLOBALS["hostName"] = "newcatchall.db.3847793.hostedresource.com";
		$GLOBALS["userName"] = "fwbase";
		$GLOBALS["password"] = "catsH8idiots";
		$GLOBALS["database"] = "fwbase";

		$GLOBALS["useMail"] = "no";
		$GLOBALS["mailContact"] = "michael@heymichael.com";

	} else {


	}

	date_default_timezone_set($GLOBALS["timeZone"]);

?>
