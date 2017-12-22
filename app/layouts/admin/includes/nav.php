<?
	?><nav class="navbar navbar-default navbar-static-top navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand white" href="#"><?=$GLOBALS["appName"]?></a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right"><?
					if (isset($_SESSION["user"])) {
						?><li class="dropdown">
							<a href="#" class="dropdown-toggle white" data-toggle="dropdown">
								<i class="icon-user icon-white"></i>

									<?=$_SESSION["user"]["fname"]?> <?=$_SESSION["user"]["lname"]?>

								<b class="caret"></b>
							</a>
							<ul id="actions-submenu" class="dropdown-menu">
								<li><a href="<?=$this->buildUrl("admin.processLogout")?>">Logout</a></li>
							</ul>
						</li><?
					}
				?></ul>
			</div>
		</div>
	</nav>
