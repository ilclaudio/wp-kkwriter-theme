<?php
/**
 * KK Writer Theme: The SEARCH page.
 *
 * @package KK_Writer_Theme
 */

get_header();

$kkw_request_data = filter_input_array( INPUT_GET, FILTER_UNSAFE_RAW );
if ( ! is_array( $kkw_request_data ) ) {
	$kkw_request_data = array();
}

$kkw_get_query_value = static function ( $key, $default_value = '' ) use ( $kkw_request_data ) {
	$raw_value = isset( $kkw_request_data[ $key ] ) ? $kkw_request_data[ $key ] : $default_value;
	return sanitize_text_field( (string) $raw_value );
};

$kkw_content_types_filters = KKW_ContentsManager::get_custom_contents_filters();
$kkw_default_contents      = KKW_ContentsManager::get_custom_contents_filter_keys();
$kkw_search_string         = $kkw_get_query_value( 'search_string' );
$kkw_selected_contents     = $kkw_default_contents;
$kkw_num_results           = 0;
$kkw_query                 = null;
$kkw_is_reset              = 'yes' === $kkw_get_query_value( 'is_reset' );

if ( $kkw_is_reset ) {
	$kkw_search_string = '';
} elseif ( array_key_exists( 'selected_contents', $kkw_request_data ) ) {
		$kkw_selected_contents_raw = $kkw_request_data['selected_contents'];
	if ( is_array( $kkw_selected_contents_raw ) ) {
		$kkw_selected_contents = array_map(
			static function ( $value ) {
				return sanitize_text_field( (string) $value );
			},
			$kkw_selected_contents_raw
		);
		$kkw_selected_contents = array_values( array_intersect( $kkw_selected_contents, $kkw_default_contents ) );
	} else {
		$kkw_selected_contents = array();
	}
}

if ( '' !== $kkw_search_string ) {
	$kkw_nonce = $kkw_get_query_value( 'site_search_nonce_field' );
	if (
		'' !== $kkw_nonce &&
		(
			wp_verify_nonce( $kkw_nonce, 'kkw_search_nonce' ) ||
			wp_verify_nonce( $kkw_nonce, 'sf_site_search_nonce' )
		)
	) {
		$kkw_query       = KKW_ContentsManager::search_contents(
			$kkw_selected_contents,
			$kkw_search_string,
			SITE_SEARCH_CELLS_PER_PAGE
		);
		$kkw_num_results = $kkw_query->found_posts;
	}
}
?>

<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<!-- BODY -->
	<div class="container mt-2">

		<form action="." id="search_site_form" method="get"
			role="search" aria-label="<?php echo esc_attr__( 'Site search', 'kk_writer_theme' ); ?>">
			<?php wp_nonce_field( 'sf_site_search_nonce', 'site_search_nonce_field', false ); ?>

			<!-- search BANNER -->
			<div class="row mb-4 py-4 primary-bg">
				<h1><?php echo esc_html__( 'Site search', 'kk_writer_theme' ); ?></h1>
					<div class="col-12">
						<div class="form-group col text-left mb-2">
							<label for="search_string" class="visually-hidden">
								<?php echo esc_html__( 'Text to search', 'kk_writer_theme' ); ?>
							</label>
							<input type="text" name="search_string"
								id="search_string"
								class="form-control"
								value="<?php echo esc_attr( $kkw_search_string ); ?>"
								placeholder="<?php echo esc_attr__( 'Text to search...', 'kk_writer_theme' ); ?>">
						<input type="hidden" name="is_reset" id="is_reset" value="">
						<div class="mt-4">
							<button type="reset" value="reset"
								onclick="resetForm('search_site_form', 'is_reset');"
								class="btn btn-outline-secondary">
								<?php echo esc_html__( 'Cancel', 'kk_writer_theme' ); ?>
							</button>
							<button type="submit" class="btn btn-secondary">
								<?php echo esc_html__( 'Search', 'kk_writer_theme' ); ?>
							</button>
						</div>
					</div>
				</div>
			</div>

			<!-- search filters and results -->
			<div class="row pt-4">

					<!-- FILTERS columns -->
					<aside class="col-md-3 border-end mb-5">
						<h5 class="text-uppercase border-bottom"><?php echo esc_html__( 'Filter by content type', 'kk_writer_theme' ); ?></h5>
						<fieldset class="font-larger">
							<legend class="visually-hidden">
								<?php echo esc_html__( 'Filter by content type', 'kk_writer_theme' ); ?>
							</legend>
							<?php
							foreach ( $kkw_content_types_filters as $kkw_ct_name => $kkw_ct_label ) {
								$kkw_checkbox_id = sanitize_title( (string) $kkw_ct_name );
								?>
								<div class="form-check mb-2 mt-2">
									<input type="checkbox" name="selected_contents[]" id="<?php echo esc_attr( $kkw_checkbox_id ); ?>"
										value="<?php echo esc_attr( $kkw_ct_name ); ?>"
										<?php checked( in_array( $kkw_ct_name, $kkw_selected_contents, true ) ); ?>
									>
									<label for="<?php echo esc_attr( $kkw_checkbox_id ); ?>">
										<?php echo esc_html( (string) $kkw_ct_label ); ?>
									</label>
								</div>
								<?php
							}
							?>
						</fieldset>
					</aside>

				<!-- RESULTS column -->
				<section class="col-md-9" aria-label="<?php echo esc_attr__( 'Search results', 'kk_writer_theme' ); ?>">

					<!-- Order results -->
					<?php
						get_template_part(
							'template-parts/common/ordering',
							null,
							array(
								'num_results' => $kkw_num_results,
							)
						);
						?>

					<div class="text-center">
						<h5 class="text-center">
							<?php
							echo esc_html(
								sprintf(
									/* translators: %d: number of matching contents. */
									__( 'Results found: %d', 'kk_writer_theme' ),
									$kkw_num_results
								)
							);
							?>
						</h5>
						<?php
						if ( '' === $kkw_search_string ) {
							?>
							<p class="fs-6 fst-italic text-center">
								<?php echo esc_html__( 'Type the text to search and click on the Search button', 'kk_writer_theme' ); ?>
							</p>
							<?php
						}
						?>
					</div>

					<?php
					// The main loop of the page.
					if ( $kkw_num_results > 0 && $kkw_query instanceof WP_Query ) {
						while ( $kkw_query->have_posts() ) {
							$kkw_query->the_post();
							$kkw_current_post = get_post();
							if ( ! ( $kkw_current_post instanceof WP_Post ) ) {
								continue;
							}

							$kkw_result    = KKW_ContentsManager::wrap_search_result( $kkw_current_post );
							$kkw_img_id    = get_post_thumbnail_id( $kkw_current_post->ID );
							$kkw_img_array = wp_get_attachment_image_src( $kkw_img_id, 'featured-post' );
							$kkw_img_src   = $kkw_img_array ? $kkw_img_array[0] : '';
							$kkw_img_alt   = get_post_meta( $kkw_img_id, '_wp_attachment_image_alt', true );
							$kkw_img_alt   = $kkw_img_alt ? $kkw_img_alt : $kkw_result->title;
							?>
							<article class="row mb-3">
								<div class="col-12 col-lg-12">
									<div class="card-wrapper">
										<div class="card kkw_no_border">
											<div class="card-body mb-0">
												<?php
												if ( $kkw_img_src ) {
													?>
													<a href="<?php echo esc_url( $kkw_result->detail_url ); ?>">
														<img class="img-thumbnail float-sm-start me-2 text-nowrap"
															src="<?php echo esc_url( $kkw_img_src ); ?>"
															width="<?php echo esc_attr( (string) KKW_SEARCH_RESULTS_IMG_WIDTH ); ?>"
															height="<?php echo esc_attr( (string) KKW_SEARCH_RESULTS_IMG_HEIGHT ); ?>"
															title="<?php echo esc_attr( $kkw_img_alt ); ?>"
															alt="<?php echo esc_attr( $kkw_img_alt ); ?>">
													</a>
													<?php
												}
												?>
												<span class="text" style="text-transform: uppercase;">
													<?php echo esc_html( (string) $kkw_result->main_group ); ?>
												</span>
												<a class="text-color-secondary kkw_link" href="<?php echo esc_url( $kkw_result->detail_url ); ?>">
													<h3 class="card-title h5">
														<?php echo esc_html( (string) $kkw_result->title ); ?>
													</h3>
												</a>
												<p class="card-text">
													<?php echo esc_html( clean_and_truncate_text( (string) $kkw_result->description, KKW_SEARCH_RESULT_TEXT_MAX_SIZE ) ); ?>
												</p>
											</div>
										</div>
									</div>
								</div>
							</article>
							<?php
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
								'query' => $kkw_query,
							)
						);
						?>
				</section>
			</div>
		</form>

	</div> <!-- body -->

</main>

<?php get_footer(); ?>
