<header>
	<nav class="navigationMain" >
		<?php echo $header->addLogoImage(); ?>
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