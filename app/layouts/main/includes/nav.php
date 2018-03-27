
	<nav class="navbar navbar-default navbar-static-top navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#thenav">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>
				<a class="navbar-brand nav-font" href="/"><?=$GLOBALS["appName"]?></a>
			</div>
			<div class="collapse navbar-collapse" id="thenav">
				<ul class="nav navbar-nav navbar-right"><?
				if (isset($rc["nav"])) {
					$nav = $rc["nav"];
					$counter = 0;
					foreach ($nav as $page) {
						$counter++;
						if (isset($nav[$counter]["children"])) {
							?><li class="dropdown">
								<a href="#3" class="dropdown-toggle" data-toggle="dropdown"><?=$page["vcNavName"]?></a>
								<ul id="actions-submenu" class="dropdown-menu">
									<li><a href="<?=$this->buildUrl("main.index?pageID=" . $page["intPageID"])?>"><?=$page["vcNavName"]?></a></li><?
									foreach ($nav[$counter]["children"] as $child) {

										?><li><a href="<?=$this->buildUrl("main.index?pageID=" . $child["intPageID"])?>"><?=$child["vcNavName"]?></a></li><?
									}
								?></ul>
							</li><?
						} else {
							?><li><a href="<?=$this->buildUrl("main.index?pageID=" . $page["intPageID"])?>"><?=$page["vcNavName"]?></a><?
						}
					}
				}
				?></ul>
			</div>
		</div>
	</nav>


