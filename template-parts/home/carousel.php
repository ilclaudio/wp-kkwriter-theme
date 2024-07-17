<?php
/**
 * KK Writer Theme: The carousel in the Home Page oif the site.
 *
 * @package KK_Writer_Theme
 */

 // Get wrapped items to show.
$items     = KKW_ContentsManager::get_home_carousel_contents();
$num_items = count( $items );

if ( $num_items > 0 ){
?>

	<div id="carouselExampleIndicators" class="carousel slide">

		<!-- INDICATORS -->
		<div class="carousel-indicators">
			<?php
				$count = 0;
			 foreach ( $items as $item ){
			?>
			<button type="button"
				data-bs-target="#carouselExampleIndicators"
				data-bs-slide-to="<?php echo $count; ?>"
				class="<?php if ( $count === 0 ) echo 'active'; ?>"
				aria-current="<?php if ( $count === 0 ) echo 'true'; ?>"
				aria-label="Slide <?php echo $count; ?>"></button>
			<?php
				$count++;
			 }
			?>
		</div>

		<!-- BEGIN slides -->
		<div class="carousel-inner">
			<?php
			$first = true;
			foreach ( $items as $item ) {
				$img_id    = get_post_thumbnail_id( $item->id );
				$img_array = wp_get_attachment_image_src( $img_id, 'carousel-item' );
				$img_src   = $img_array ? $img_array[0] : '';
				$img_alt   = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
				$img_alt   = $img_alt ? $img_alt : $item->title;
				$item_url  = $item->detail_url;
			?>
				<!-- begin slide -->
				<div class="carousel-item <?php if ( $first ) echo 'active'; ?>" >
					<div class="card mb-3 fill-primary" style="width: 600; height: 300px;">
						<div class="row g-0">
							<!-- slide image -->
							<div class="col-md-4 g-0 p-0 m-0">
								<a class="kkw_link" href="<?php echo esc_url( $item_url ); ?>">
									<img style="max-height: 300px" 
									src="<?php echo esc_url( $img_src ); ?>"
									class="img-fluid rounded-start p-3" 
									alt="<?php echo esc_attr( $img_alt ); ?>">
								</a>
							</div>
							<!-- slide text -->
							<div class="col-md-8">
								<div class="card-body">
									<h5 class="card-title">
										<a class="kkw_link" href="<?php echo esc_url( $item_url ); ?>">
											<b><?php echo esc_attr( $item->title ); ?></b>
										</a>
									</h5>
									<p class="card-text">
										<?php echo wp_kses_post( $item->description ); ?>
									</p>
									<p class="card-text">
										<small class="text-body-secondary">
											<a class="kkw_link"
												href="<?php echo esc_url( $item_url ); ?>"><?php echo __( 'Keep reading...', 'kk_writer_theme' ); ?>
											</a>
										</small>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end slide -->
			<?php
			$first = false;
			}
			?>
		</div>
		<!-- END slides -->


		<!-- BUTTONS -->
		 <!--
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
		-->

	</div> <!-- carousel-->
<?php
}
?>