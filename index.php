	<?php get_header(); ?>

	<div id="carouselExampleIndicators" class="carousel slide">
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
		</div>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: First slide" preserveAspectRatio="xMidYMid slice" focusable="false">
					<title>Placeholder</title>
					<rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#555" dy=".3em">First slide</text>
				</svg>
			</div>
			<div class="carousel-item">
				<svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Second slide" preserveAspectRatio="xMidYMid slice" focusable="false">
					<title>Placeholder</title>
					<rect width="100%" height="100%" fill="#666"></rect><text x="50%" y="50%" fill="#444" dy=".3em">Second slide</text>
				</svg>
			</div>
			<div class="carousel-item">
				<svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Third slide" preserveAspectRatio="xMidYMid slice" focusable="false">
					<title>Placeholder</title>
					<rect width="100%" height="100%" fill="#555"></rect><text x="50%" y="50%" fill="#333" dy=".3em">Third slide</text>
				</svg>
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>

	<?php
	while ( have_posts() ) {
		the_post();
	?>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<button type="button" class="btn btn-primary">Primary</button>

		<?php the_content(); ?>dddd
		<hr>
	<?php }

	get_footer();

	?>
