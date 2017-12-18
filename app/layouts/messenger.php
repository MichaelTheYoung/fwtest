<?
	if (isset($_SESSION["messages"])) {
		?><style>
			.errorbox-off {
				width: 0px;
				height: 0px;
				overflow: hidden;
				visibility: hidden;
			}

			.errorbox-on {
				width: 100%;
				height: auto;
				padding: 6px;
				background-color: #EEDDDD;
				visibility: visible;
			}

			.errorbox-on p {
				margin: 0px 0px 4px 0px;
			}

			.error {
				background-color: #EEDDDD;
			}

			.confirm {
				background-color: #DDEEDD;
			}
		</style>
		<div id="errorbox"><?
			$errs = new messenger;
			$errtype = $errs->showMessages();
		?></div>
		<script>
			document.getElementById("errorbox").className = "errorbox-on <?=$errtype?>";
		</script><?
	}
?>
