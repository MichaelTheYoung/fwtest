<?

	?><!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<title>Framework Test</title>
		<meta name="viewport" content="width=1024, user-scalable=no">
		<link href="<?=$GLOBALS["assetsPath"]?>css/admin.css?v=<?=time()?>" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto+Condensed">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro">
		<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="//code.jquery.com/jquery-1.12.4.js"></script>
		<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="<?=$GLOBALS["assetsPath"]?>js/java.js?v=<?=time()?>"></script>
	</head>
	<body>
		<div id="fheader">
			<div id="fheadercontent">
				<div id="fhtext">New Framework Test</div>
			</div>
		</div>
		<div id="wrapper">
			<div id="fheaderback"> </div>
			<div id="content-left">
				<? include($GLOBALS["layoutPath"] . "messenger.php"); ?>
				<?=$this->showPage($rc)?>
			</div>
			<div id="content-spacer">&nbsp;</div>
			<div id="content-right">
				<!-- right-side notes go here -->
			</div>
		</div>
		<div class="pad-bottom">&nbsp;</div>
		<div id="hideaction"></div>
		<div id="mask" class="mask-off"><div id="detail-outer" class="vanish"><div id="detail" class="detail-off"></div></div></div>
	</body>
	</html>
