<?
	$rs = $rc["user"];

	?><div class="row">
		<div class="col-md-12">
			<legend><?=$rc["verb"]?> User</legend>
			<form name="frmUser" method="post" action="<?=$this->buildUrl("admin.processUser")?>">
			<input type="hidden" name="intUserID" value="<?=$rs["intUserID"]?>">
			<input type="hidden" name="vcLevel" value="<?=$rs["vcLevel"]?>">
			<div class="row rowbottom">
				<div class="col-md-2 formLabel alright">
					Status:
				</div>
				<div class="col-md-4">
					<?=$rc["activelist"]?>
				</div>
			</div>
			<div class="row rowbottom">
				<div class="col-md-2 formLabel alright">
					First Name:
				</div>
				<div class="col-md-4">
					<input type="text" id="vcFName" name="vcFName" class="form-control" value="<?=$this->unclean($rs["vcFName"], 0)?>">
				</div>
			</div>
			<div class="row rowbottom">
				<div class="col-md-2 formLabel alright">
					Last Name:
				</div>
				<div class="col-md-4">
					<input type="text" id="vcLName" name="vcLName" class="form-control" value="<?=$this->unclean($rs["vcLName"], 0)?>">
				</div>
			</div>
			<div class="row rowbottom">
				<div class="col-md-2 formLabel alright">
					Email:
				</div>
				<div class="col-md-4">
					<input type="text" id="vcEmail" name="vcEmail" class="form-control" value="<?=$this->unclean($rs["vcEmail"], 0)?>">
				</div>
			</div><?
			if ($rs["intUserID"] == 0) {
				?><div class="row rowbottom">
					<div class="col-md-2 formLabel alright">
						Password:
					</div>
					<div class="col-md-4">
						<input type="text" id="vcLogPW" name="vcLogPW" class="form-control">
					</div>
				</div><?
			}
			?><div class="row rowbottom">
				<div class="col-md-6 alright">
					<input type="button" class="btn btn-primary" onClick="document.location.href='<?=$this->buildUrl("admin.listUsers")?>';" value="Cancel">
					<input type="button" class="btn btn-primary" onClick="WriteUser();" value="<?=$rc["button"]?>">
				</div>
			</div>
			</form>
		</div>
	</div>
	<script src="<?=$GLOBALS["assetsPath"]?>js/admin/users.js"></script>





