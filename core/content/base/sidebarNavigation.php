<div class="sidebarPageNav">
	<?php
	$workNavArray = $header->generateNavigationArray(array(
		"include"	=>	$baseXmlGen->menu->key
	));
	echo $header->generateNavUL($workNavArray);
	?>
</div>
<style type="text/css">
	.sidebarPageNav ul{
		padding: 0;
	}

	.sidebarPageNav li{
		list-style: none;
	}
</style>