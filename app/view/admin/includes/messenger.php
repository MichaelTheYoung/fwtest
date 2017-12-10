<?
	if (isset($_SESSION["messages"])) {
		?><div id="errorbox"><?
			$errs = new messenger;
			$errs->showMessages();
		?></div>
		<script>
			document.getElementById("errorbox").className = "errorbox-on";
		</script><?
	}
?>

