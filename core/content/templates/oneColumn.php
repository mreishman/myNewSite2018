<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $baseXmlGen->title; ?></title>
		<!-- Load css / js dynamically below -->
	</head>
	<body>
		<?php
			require_once($core->getModule($layoutFileGen,"header"));
			require_once($core->getContent($baseXmlGen));
			require_once($core->getModule($layoutFileGen,"footer"));
		?>
	</body>
</html>