<header>
	<nav class="navigationMain" >
		<?php 
		$navArr = $header->generateNavigationArray();
		echo $header->generateNavUL($navArr);
		?>
	</nav>
</header>