<?php
// BOX 1.
$opt_featured_1 = kkw_get_option( 'featured_content_1', 'kkw_opt_hp_layout' );
$fc1            = count( $opt_featured_1 ) > 0 ? $opt_featured_1[0] : null;
$fc1_content    = $fc1 && array_key_exists('box_content', $fc1 ) ? explode( ',', $fc1['box_content'] )[0] : null;
$fc1_img_side   = $fc1['box_image_side'];
// BOX 2.
$opt_featured_2 = kkw_get_option( 'featured_content_2', 'kkw_opt_hp_layout' );
$fc2            = count( $opt_featured_2 ) > 0 ? $opt_featured_2[0] : null;
$fc2_content    = $fc2 && array_key_exists('box_content', $fc2 ) ? explode( ',', $fc2['box_content'] )[0] : null;
$fc2_img_side   = $fc2['box_image_side'];
// BOX 3.
$opt_featured_3 = kkw_get_option( 'featured_content_3', 'kkw_opt_hp_layout' );
$fc3            = count( $opt_featured_3 ) > 0 ? $opt_featured_3[0] : null;
$fc3_content    = $fc3 && array_key_exists('box_content', $fc3 ) ? explode( ',', $fc3['box_content'] )[0] : null;
$fc3_img_side   = $fc3['box_image_side'];
?>

<div id="carouselExampleIndicators" class="carousel slide">
	<!-- INDICATORS -->
	<div class="carousel-indicators">
		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
		<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
	</div>

	<!-- ITEMS -->
	<div class="carousel-inner">

	<div class="carousel-item active" >
		<div class="card mb-3" style="width: 800; height: 400px; background-color:#f5f5dc">
			<div class="row g-0">
				<div class="col-md-4 g-0 p-0 m-0">
					<img style="max-height: 400px" src="http://localhost/writer/wp-content/uploads/2024/04/tessere-alla-deriva-321457.jpg"  class="img-fluid rounded-start" alt="...">
				</div>
				<div class="col-md-8">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
						<p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
					</div>
				</div>
			</div>
		</div>
	</div>


		
		<div class="carousel-item">
			<svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Second slide" preserveAspectRatio="xMidYMid slice" focusable="false">
				<title>Placeholder</title>
				<rect width="100%" height="100%" fill="#f5f5dc"></rect><text x="50%" y="50%" fill="#444" dy=".3em">Second slide</text>
			</svg>
		</div>


	</div>

	<!-- BUTTONS 
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
	-->
</div>