<header>
	<nav class="navigationMain" >
		<a href="<?php echo $data->getValue("baseUrl"); ?>" ><img src="/media/img/main/logo.png" height="42px" style="display: inline-block;" ></a>
		<input type="checkbox" id="mainNavigationToggle" checked>
		<label for="mainNavigationToggle" class="mobileNavButton">
			<span class="navIconChecked">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</span>
			<span class="navIconNotChecked">
				<span class="icon-bar-top"></span>
				<span class="icon-bar-mid"></span>
				<span class="icon-bar-bot"></span>
			</span>
		</label>
		<span class="navigationSpan" >
			<?php 
			$navArr = $header->generateNavigationArray();
			echo $header->generateNavUL($navArr);
			?>
		</span>
	</nav>
</header>
<?php
	$arrayOfObjects = array($baseXmlGen, $layoutFileGen);
	if(isset($module))
	{
		$arrayOfObjects[] = $module["moreInfo"];
	}
	$mobileNavPosition = $core->getSetting(
		$arrayOfObjects,
		array("settings","body","module","header","mobileNavPosition"),
		"right");
?>
<style type="text/css">
	.mobileNavButton{
		float: <?php echo $mobileNavPosition; ?>
	}
</style>