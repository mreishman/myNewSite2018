<div>
	<div class="hero-image">
		<div class="hero-text">
    		<h1>2.5D Productions</h1>
    		<p>Matt Reishman</p>
  		</div>
	</div>
	<div></div>
	<div align="center" >
		<div style="background-color: red; " class="category-buttons">
		</div>
		<div style="background-color: green;" class="category-buttons">
		</div>
		<div style="background-color: blue; " class="category-buttons">
		</div><div style="background-color: red" class="category-buttons">
		</div>
		<div style="background-color: green;" class="category-buttons">
		</div>
		<div style="background-color: blue; " class="category-buttons">
		</div>
		<div style="background-color: red; " class="category-buttons">
		</div>
		<div style="background-color: green;" class="category-buttons">
		</div>
	</div>
</div>

<style type="text/css">
	body, html {
	    height: 100%;
	}

	.category-buttons{
		height: 200px;
		width: 350px;
		display: inline-block;
		margin: 2%;
	}

	/* The hero image */
	.hero-image {
	    /* Use "linear-gradient" to add a darken background effect to the image (photographer.jpg). This will make the text easier to read */
	    background-image: linear-gradient(rgba(25, 25, 25, 0.5), rgba(0, 0, 0, 0.5)), url("media/test.png");

	    /* Set a specific height */
	    height: 50%;

	    /* Position and center the image to scale nicely on all screens */
	    background-position: center;
	    background-repeat: no-repeat;
	    background-size: cover;
	    position: relative;
	}

	/* Place text in the middle of the image */
	.hero-text {
	    text-align: center;
	    position: absolute;
	    top: 50%;
	    left: 50%;
	    transform: translate(-50%, -50%);
	    color: white;
	}
</style>