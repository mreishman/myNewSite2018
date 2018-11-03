<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $baseXmlGen->title; ?></title>
		<!-- Load css / js dynamically below -->
	</head>
	<body>
		<?php require_once($core->getModule($layoutFileGen,"header")); ?>
		<div class="mainContent" >
			<?php require_once($core->getContent($baseXmlGen)); ?>
		</div>
		<?php require_once($core->getModule($layoutFileGen,"footer")); ?>
	</body>
</html>