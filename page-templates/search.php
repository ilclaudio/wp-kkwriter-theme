<?php
/**
 * KK Writer Theme: The SEARCH page.
 *
 * @package KK_Writer_Theme
 */
?>
<?php

get_header();
define( 'SITESEARCH_CELLS_PER_PAGE', 10 );

$post_data    = $_POST;
$searchstring = isset( $post_data['searchstring'] ) ? sanitize_text_field( $post_data['searchstring'] ) : '';
$redirection  = (sanitize_text_field( isset( $post_data['redirection'] ) && sanitize_text_field( $post_data['redirection'] ) === 'yes') ? true : false );

$content_types_filters = KKW_ContentsManager::get_ct_filters();
$num_results           = 0;
$selected_contents     = array();

?>

<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<!-- BODY -->
	<div class="container mt-2">

		<FORM action="." id="ricercasitoform" method="POST" 
			role="search" aria-label="<?php echo __( 'Site search' , 'kk_writer_theme' ); ?>">
			<?php wp_nonce_field( 'sf_cercasito_nonce', 'cercasito_nonce_field' ); ?>

			<!-- search BANNER -->
			<div class="row mb-4 py-4 primary-bg">
				<h1><?php echo __( 'Site search' , 'kk_writer_theme' ); ?></h1>
				<div class="col-12">
					<div class="form-group col text-left mb-2">
							<input type="text" name="searchstring" class="form-control" placeholder="<?php echo __( 'Text to search...' , 'kk_writer_theme' ); ?>">
							<div class="mt-4">
								<button type="button" class="btn btn-outline-secondary">
									<?php echo __( 'Cancel' , 'kk_writer_theme' ); ?>
								</button>
								<button type="submit" class="btn btn-secondary">
									<?php echo __( 'Search' , 'kk_writer_theme' ); ?>
								</button>
							</div>
					</div>
				</div>
			</div>

			<!-- search filters and results -->
			<div class="row pt-4">

				<!-- FILTERS columns -->
				<aside class="col-md-3 border-end mb-5">
					<h5 class="text-uppercase border-bottom"><?php echo __( 'Filter by content type' , 'kk_writer_theme' ); ?></h5>
					<fieldset class="fs-5">
						<?php
							foreach( $content_types_filters as $ct_name => $ct_label ) {
						?>
							<div class="form-check">
								<input type="checkbox" name="selected_contents[]" id="<?php echo $ct_label; ?>" 
									value="<?php echo $ct_name; ?>"
									<?php if (count( $selected_contents ) > 0 && in_array( $ct_name, $selected_contents ) ) {
											echo "checked='checked'";
									} ?>
								>
								<label for="<?php echo $ct_label ; ?>">
									<?php echo __( $ct_label , 'kk_writer_theme' ); ?>
								</label>
							</div>
						<?php
							}
						?>
					</fieldset>
				</aside>


				<!-- RESULTS column -->
				<section class="col-md-9" aria-label="<?php echo __( 'Search results' , 'kk_writer_theme' ); ?>">
					<h5 class="text-center"><?php echo __( 'Results found' , 'kk_writer_theme' ); ?>: <?php echo $num_results; ?></h5>
					<article class="result-item mb-3">
						<div class="media">
							<img src="path/to/image1.jpg" class="mr-3" alt="...">
							<div class="media-body">
								<h6 class="mt-0">PROGETTO</h6>
								<a href="#" class="h5">Quarto progetto</a>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultricies ligula neque, sit amet elementum orci molestie vitae. Donec sollicitudin nisi vitae egestas accumsan. Donec eget quam et nibh maximus faucibus. Nulla dignissim id sapien vitae vestibulum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultricies ligula neque, sit...</p>
							</div>
						</div>
					</article>
					<article class="result-item mb-3">
						<div class="media">
							<img src="path/to/image2.jpg" class="mr-3" alt="...">
							<div class="media-body">
								<h6 class="mt-0">PROGETTO</h6>
								<a href="#" class="h5">Terzo progetto</a>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultricies ligula neque, sit amet elementum orci molestie vitae. Donec sollicitudin nisi vitae egestas accumsan. Donec eget quam et nibh maximus faucibus. Nulla dignissim id sapien vitae vestibulum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultricies ligula neque, sit...</p>
							</div>
						</div>
					</article>
				</section>

			</div>

		</FORM>
	</div>

</main>


<?php get_footer(); ?>