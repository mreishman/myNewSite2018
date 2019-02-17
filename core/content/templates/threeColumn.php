<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $baseXmlGen->title; ?></title>
		<link rel="shortcut icon" type="image/png" href="/media/img/main/favicon.png"/>
	</head>
	<body>
		<?php
			$headerModules = $core->getModules($layoutFileGen,"header");
			foreach ($headerModules as $module)
			{
				require_once($module["file"]);
			}
		?>
		<div class="mainContentInline">
			<?php
				$contentClass 	= $core->getSetting(
					array($baseXmlGen, $layoutFileGen),
					array("settings","body","mainContent","content","columnWidth"),
					"30");
				$hideMobile 		= (string)$core->getSetting(
					array($baseXmlGen, $layoutFileGen),
					array("settings","body","mainContent","content","hideMobile"),
					"false");
				if($hideMobile === "true")
				{
					$contentClass .= " hideMobile";
				}
			?>
			<div class="column width<?php echo $contentClass; ?>">
				<!-- Default content -->
				<?php include($core->getContent($baseXmlGen)); ?>
			</div>
			<?php
				$contentClass 	= $core->getSetting(
					array($baseXmlGen, $layoutFileGen),
					array("settings","body","mainContent","contentThree","columnWidth"),
					"40");
				$hideMobile 		= (string)$core->getSetting(
					array($baseXmlGen, $layoutFileGen),
					array("settings","body","mainContent","contentThree","hideMobile"),
					"false");
				if($hideMobile === "true")
				{
					$contentClass .= " hideMobile";
				}
			?>
	  		<div class="column width<?php echo $contentClass; ?>">
	  			<!-- contentTwo -->
	  			<?php include($core->getContent($baseXmlGen, "contentTwo")); ?>
	  		</div>
	  		<?php
	  			$contentClass 	= $core->getSetting(
					array($baseXmlGen, $layoutFileGen),
					array("settings","body","mainContent","contentThree","columnWidth"),
					"30");
				$hideMobile 		= (string)$core->getSetting(
					array($baseXmlGen, $layoutFileGen),
					array("settings","body","mainContent","contentThree","hideMobile"),
					"false");
				if($hideMobile === "true")
				{
					$contentClass .= " hideMobile";
				}
			?>
	  		<div class="column width<?php echo $contentClass; ?>">
	  			<!-- contentThree -->
	  			<?php include($core->getContent($baseXmlGen, "contentThree")); ?>
	  		</div>
	  	</div>
		<?php
			$headerModules = $core->getModules($layoutFileGen,"footer");
			foreach ($headerModules as $module)
			{
				require_once($module["file"]);
			}
		?>
	</body>
</html>