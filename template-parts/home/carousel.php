<?php
/**
 * KK Writer Theme: The carousel in the Home Page oif the site.
 *
 * @package KK_Writer_Theme
 */

$contents     = KKW_ContentsManager::get_home_carousel_contents();
$num_contents = count( $contents );

if ( $num_contents > 0 ){
?>

	<div id="carouselExampleIndicators" class="carousel slide">
		<!-- INDICATORS -->
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
		</div>

		<!-- ITEMS -->
		<div class="carousel-inner">

		<?php
		$first = true;
		foreach ( $contents as $c ){
		?>
		<div class="carousel-item <?php if ( $first ) echo 'active'; ?>" >
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
		<?php
		$first = false;
		}
		?>




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
<?php
}
?>