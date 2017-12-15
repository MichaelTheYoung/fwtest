<?
	if (isset($_SESSION["messages"])) {
		?><div id="errorbox"><?
			$this->open("messenger")->showMessages();
		?></div>
		<script>
			document.getElementById("errorbox").className = "errorbox-on";
		</script><?
	}
?>

