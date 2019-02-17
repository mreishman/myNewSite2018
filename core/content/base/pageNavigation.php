<div class="pageNav">
	<?php
	$workNavArray = $header->generateNavigationArray(array(
		"include"	=>	$baseXmlGen->menu->key
	));
	echo $header->generatePageNavUL($workNavArray);
	?>
</div>
<style type="text/css">
	.pageNav a{
		text-decoration: none;
	}

	.pageNav ul{
		padding: 0;
	}

	.pageNav li{
		min-height: 250px;
		list-style: none;
	}

	.pageNav img{
		height: 200px;
		width: 350px;
		padding-right: 15px;
	}
	@media only screen and (max-width : 800px) {
		.pageNav img{
			float: none;
			width: 100%;
			height: auto;
		}
	}
</style>