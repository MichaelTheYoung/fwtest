<? 
	session_start();

	include("core/config.php");
	include("core/index.php");

	!isset($rc) ? $rc = array() : null;
	$fw = new fw;
	$rc = $fw->init($rc);
?>
