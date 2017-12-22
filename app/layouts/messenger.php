<?
	if (isset($_SESSION["messages"])) {
		?><style>
			.nessagebox-off {
				width: 0px;
				height: 0px;
				overflow: hidden;
				visibility: hidden;
			}

			.messagebox-on {
				width: 100%;
				height: auto;
				padding: 6px;
				background-color: #EEDDDD;
				border: 1px solid #CCCCCC;
				border-radius: 2px;
				margin-bottom: 8px;
				visibility: visible;
			}

			.messagebox-on p {
				margin: 0px 0px 4px 0px;
			}

			.error {
				background-color: #EEDDDD;
			}

			.confirm {
				background-color: #DDEEDD;
			}
		</style>
		<div id="messagebox"><?
			$errs = new messenger;
			$errtype = $errs->showMessages();
		?></div>
		<script>
			document.getElementById("messagebox").className = "messagebox-on <?=$errtype?>";
		</script><?
	}
?>
