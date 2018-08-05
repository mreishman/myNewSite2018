<header>
	<nav>
		<ul>
			<?php 
			$navArr = $header->generateNavigationArray();
			echo $header->generateNavUL($navArr);
			?>
		</ul>
	</nav>
</header>