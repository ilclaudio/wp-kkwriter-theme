<?php
/**
 * KK Writer Theme: The SEARCH page.
 *
 * @package KK_Writer_Theme
 */
?>
<?php

get_header();

// BEGIN prepare search parameters.
$request_data  = $_GET;
$search_string = isset( $request_data['search_string'] ) ? sanitize_text_field( $request_data['search_string'] ) : '';
$redirection   = (sanitize_text_field( isset( $request_data['redirection'] ) && sanitize_text_field( $request_data['redirection'] ) === 'yes') ? true : false );

$content_types_filters = KKW_ContentsManager::get_custom_contents_filters();
$num_results           = 0;
$selected_contents     = array();

if ( isset( $_GET['is_reset'] ) && ( sanitize_text_field( $_GET['is_reset'] ) === 'yes' ) ) {
	// Set the parameters to reset the search form.
	$selected_contents = KKW_ContentsManager::get_custom_contents_filter_keys();
	$search_string      = '';
} else {
	// Retrieve the the content types to search in.
	if ( isset( $_GET['selected_contents'] ) ) {
		$selected_contents = $_GET['selected_contents'];
		if ( ! is_array( $selected_contents ) ) {
			$selected_contents = array();
		}
	} else {
		$selected_contents = KKW_ContentsManager::get_custom_contents_filter_keys();
	}
	// Retrieve the string to search.
	if ( isset( $_GET['search_string'] ) ) {
		$search_string = sanitize_text_field( $_GET['search_string'] );
	} else {
		$search_string = '';
	}
}

$the_query = null;

if ( '' !== $search_string ) {
	// Check the NONCE.
	if (
		isset( $_GET['site_search_nonce_field'] ) && 
		(
			wp_verify_nonce( sanitize_text_field( $_GET['site_search_nonce_field'] ), 'kkw_search_nonce' ) ||
			wp_verify_nonce( sanitize_text_field( $_GET['site_search_nonce_field'] ), 'sf_site_search_nonce' )
		)
	) {
		$the_query = KKW_ContentsManager::search_contents(
			$selected_contents,
			$search_string,
			SITE_SEARCH_CELLS_PER_PAGE
		);
		$num_results = $the_query->found_posts;
	}
} else {
	$num_results = 0;
}
// END search parameters preparation.
?>

<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<!-- BODY -->
	<div class="container mt-2">

		<FORM action="." id="search_site_form" method="GET"
			role="search" aria-label="<?php echo __( 'Site search' , 'kk_writer_theme' ); ?>">
			<?php wp_nonce_field( 'sf_site_search_nonce', 'site_search_nonce_field', false ); ?>

			<!-- search BANNER -->
			<div class="row mb-4 py-4 primary-bg">
				<h1><?php echo __( 'Site search' , 'kk_writer_theme' ); ?></h1>
				<div class="col-12">
					<div class="form-group col text-left mb-2">
							<input type="text" name="search_string" 
							class="form-control"
							value="<?php echo esc_attr( $search_string ? $search_string : '' );  ?>"
							placeholder="<?php echo __( 'Text to search...' , 'kk_writer_theme' ); ?>">
							<input type="hidden" name="is_reset" id="is_reset" value="" />
							<div class="mt-4">
								<button type="reset" value="reset"
									onclick="resetForm('search_site_form', 'is_reset');"
									class="btn btn-outline-secondary" >
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
					<fieldset class="font-larger">
						<?php
							foreach( $content_types_filters as $ct_name => $ct_label ) {
						?>
							<div class="form-check mb-2 mt-2">
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

					<!-- Order results -->
					<?php
						get_template_part(
							'template-parts/common/ordering',
							null,
							array(
							'num_results' => $num_results,
							)
						);
					?>

					<!-- no results found -->
					<p class="text-center">
						<h5 class="text-center"><?php echo __( 'Results found' , 'kk_writer_theme' ); ?>: <?php echo $num_results; ?></h5>
						<?php
						if ( $search_string === '' ){
						?>
						<p class="fs-6 fst-italic text-center">
							<?php echo __( 'Type the text to search and click on the Search button' , 'kk_writer_theme' ); ?>
						</p>
						<?php
						}
						?>
					</p>
					
					<?php
						// The main loop of the page.
						$pindex = 0;
						if ( $num_results > 0 ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$result     = KKW_ContentsManager::wrap_search_result( $post );
								$img_id     = get_post_thumbnail_id( $post->ID );
								$img_array  = wp_get_attachment_image_src( $img_id, 'featured-post' );
								$img_src    = $img_array ? $img_array[0] : '';
								$img_alt    = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
								$img_alt    = $img_alt ? $img_alt : $result->title;
					?>
							<article class="row mb-3">
								<div class="col-12 col-lg-12">
									<div class="card-wrapper ">
										<div class="card kkw_no_border">
											<div class="card-body mb-0">
												<?php
												if ( $img_src ){
												?>
												<a href="<?php echo esc_url( $result->detail_url ); ?>">
													<img class="img-thumbnail float-sm-start me-2 text-nowrap"
														src="<?php echo esc_url( $img_src ); ?>"
														width="<?php echo strval( KKW_SEARCH_RESULTS_IMG_WIDTH ); ?>" 
														height="<?php echo strval( KKW_SEARCH_RESULTS_IMG_HEIGHT ); ?>"
														title="<?php echo esc_attr( $img_alt ); ?>"
														alt="<?php echo esc_attr( $img_alt ); ?>"
													>
												</a>
												<?php
												}
												?>
												<span class="text" style="text-transform: uppercase;">
													<?php echo esc_attr( __( $result->main_group, 'kk_writer_theme' ) ); ?>
												</span>
												<a class="text-color-secondary kkw_link" href="<?php echo esc_url( $result->detail_url ); ?>">
													<h3 class="card-title h5 ">
														<?php echo esc_attr( $result->title ); ?>
													</h3>
												</a>
												<p class="card-text">
													<?php echo clean_and_truncate_text( $result->description, KKW_SEARCH_RESULT_TEXT_MAX_SIZE ); ?>
												</p>
											</div>
										</div>
									</div>
								</div>
							</article>
					<?php
						$pindex++;
						}
					}
						wp_reset_postdata();
					?>

					<!-- PAGINATION -->
					<?php
						get_template_part(
							'template-parts/common/pagination',
							null,
							array(
							'query' => $the_query,
							)
						);
					?>
				</section>

			</div>
		</FORM>

	</div> <!-- body -->

</main>


<?php get_footer(); ?>