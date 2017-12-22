<?
	?><!DOCTYPE html>
	<html>
	<head>
		<title><?=$GLOBALS["appName"]?></title>
		<link rel="stylesheet" href="<?=$GLOBALS["assetsPath"]?>css/jquery-ui-1.11.2-smoothness.css">
		<link rel="stylesheet" href="<?=$GLOBALS["assetsPath"]?>css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=$GLOBALS["assetsPath"]?>css/bootstrap-toggle.min.css">
		<link rel="stylesheet" href="<?=$GLOBALS["assetsPath"]?>css/bootstrap-multiselect.css">
		<link rel="stylesheet" href="<?=$GLOBALS["assetsPath"]?>css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="<?=$GLOBALS["assetsPath"]?>css/selectize.default.css">
		<link rel="stylesheet" href="<?=$GLOBALS["assetsPath"]?>css/admin.css?v=<?=time()?>">
  		<script src="<?=$GLOBALS["assetsPath"]?>js/jquery-2.1.3.min.js"></script>
  		<script src="<?=$GLOBALS["assetsPath"]?>js/jquery-ui-1.11.2.min.js"></script>
  		<script src="<?=$GLOBALS["assetsPath"]?>js/lodash-3.6.0.min.js"></script>
		<script src="<?=$GLOBALS["assetsPath"]?>js/bootstrap.min.js"></script>
		<script src="<?=$GLOBALS["assetsPath"]?>js/bootstrap-toggle.min.js"></script>
		<script src="<?=$GLOBALS["assetsPath"]?>js/bootstrap-multiselect.js"></script>
		<script src="<?=$GLOBALS["assetsPath"]?>js/jquery.DataTables.js"></script>
		<script src="<?=$GLOBALS["assetsPath"]?>js/dataTables.bootstrap.min.js"></script>
	        <script src="<?=$GLOBALS["assetsPath"]?>js/jscolor.js"></script>
	        <script src="<?=$GLOBALS["assetsPath"]?>js/maskedInput.min.js"></script>
	        <script src="<?=$GLOBALS["assetsPath"]?>js/selectize.min.js"></script>
	        <script src="<?=$GLOBALS["assetsPath"]?>js/selectize.plugin.js"></script>
		<script src="<?=$GLOBALS["assetsPath"]?>js/global.js?v=<?=time()?>"></script>
	</head>
	<body>
		<? include("includes/nav.php") ?>
		<div class="container">
			<div class="row">
				<div class="col-md-9 primaryView">
					<div id="errorbox" class="vanish"></div>
					<? include($GLOBALS["layoutPath"] . "messenger.php"); ?>
					<?=$this->showPage($rc)?>
				</div>
				<div class="col-md-3">
				<!--	<legend>Notes</legend> -->
				</div>
			</div>
		</div>
		<div class="spacer"></div>
		<div id="hideaction"></div>
	</body>
</html>



