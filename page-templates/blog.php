<?php
/**
 * Template Name: blog
 *
 * KK Writer Theme: The BLOG page.
 *
 * @package KK_Writer_Theme
 */

get_header();

$kkw_section             = __( 'Blog', 'kk_writer_theme' );
$kkw_section_description = '';

// Manage ordering parameters.
$kkw_valid_sort_orders = array( 'ASC', 'DESC' );
$kkw_sort_order        = isset( $_GET['sort_order'] ) ? sanitize_text_field( wp_unslash( $_GET['sort_order'] ) ) : 'ASC';
$kkw_sort_order        = strtoupper( trim( $kkw_sort_order ) );
if ( ! in_array( $kkw_sort_order, $kkw_valid_sort_orders, true ) ) {
	$kkw_sort_order = 'ASC';
}
$kkw_valid_sort_fields = array( 'title', 'date' );
$kkw_sort_field = isset( $_GET['sort_field'] ) ? sanitize_text_field( wp_unslash( $_GET['sort_field'] ) ) : 'title';
if ( ! in_array( $kkw_sort_field, $kkw_valid_sort_fields, true ) ) {
	$kkw_sort_field = 'title';
}

// Manage post types.
$kkw_valid_selected_contents = KKW_ContentsManager::get_post_groups_filter_keys();
/** Map of post group key => translated label.
 *
 * @var array<string, string> $kkw_content_types_filters
 */
$kkw_content_types_filters = KKW_ContentsManager::get_post_groups_filters();
$kkw_selected_contents     = array();
$kkw_selected_contents_raw = filter_input( INPUT_GET, 'selected_contents', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
if ( is_array( $kkw_selected_contents_raw ) ) {
	$kkw_selected_contents = array_map(
		static function ( $value ) {
			return sanitize_text_field( (string) $value );
		},
		$kkw_selected_contents_raw
	);
	$kkw_selected_contents = array_values( array_intersect( $kkw_selected_contents, $kkw_valid_selected_contents ) );
}

if ( empty( $kkw_selected_contents ) ) {
	$kkw_selected_contents = $kkw_valid_selected_contents;
}

/** Query object for the filtered blog listing.
 *
 * @var WP_Query $kkw_query
 */
$kkw_query = KKW_ContentsManager::get_blog_posts_query(
	$kkw_selected_contents,
	$kkw_sort_field,
	$kkw_sort_order,
	BLOG_ARTICLES_CELLS_PER_PAGE
);

$kkw_num_results = $kkw_query->found_posts;
?>

<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<!-- BODY -->
	<div class="container mt-2">

		<!-- BANNER -->
			<section class="row mb-2 py-4 primary-bg">
				<h1><?php echo esc_html( $kkw_section ); ?></h1>
				<?php
				if ( $kkw_section_description ) {
					?>
				<div class="col-12">
					<div class="form-group col text-left mb-2">
					<?php echo wp_kses_post( $kkw_section_description ); ?>
					</div>
				</div>
					<?php
				}
				?>
		</section>

		<!-- search filters and results -->
		<div class="row">

			<!-- FILTERS column-->
			<aside class="col-md-2 border-end mb-5">
				<!-- Filter results -->
				<form action="." id="search_site_form" method="get"
					role="search" aria-label="<?php echo esc_attr__( 'Site search', 'kk_writer_theme' ); ?>">

					<h5 class="text-uppercase border-bottom"><?php echo esc_html__( 'Filter by group', 'kk_writer_theme' ); ?></h5>
					<fieldset class="font-larger">
						<?php
						foreach ( $kkw_content_types_filters as $kkw_pt_name => $kkw_pt_label ) {
							$kkw_pt_label_i18n = (string) $kkw_pt_label;
							$kkw_checkbox_id   = sanitize_title( $kkw_pt_name );
							?>
								<div class="form-check mb-2 mt-2">
									<input type="checkbox" name="selected_contents[]" id="<?php echo esc_attr( $kkw_checkbox_id ); ?>"
										value="<?php echo esc_attr( $kkw_pt_name ); ?>"
									<?php checked( in_array( $kkw_pt_name, $kkw_selected_contents, true ) ); ?>
									>
									<label for="<?php echo esc_attr( $kkw_checkbox_id ); ?>">
									<?php echo esc_html( $kkw_pt_label_i18n ); ?>
									</label> &nbsp;
									<i class="fa-regular <?php echo esc_attr( KKW_ContentsManager::get_post_icon_by_group( $kkw_pt_name ) ); ?> fa-1x"
										title="<?php echo esc_attr( ucfirst( $kkw_pt_name ) ); ?>"></i>
								</div>
								<?php
						}
						?>
					</fieldset>
					<div class="text-center">
						<button type="submit" class="btn btn-outline-secondary mt-3">
							<?php echo esc_html__( 'Reload', 'kk_writer_theme' ); ?>
						</button>
					</div>
				</form>
			</aside>

			<!-- RESULTS column -->
			<section class="col-md-10" aria-label="<?php echo esc_attr__( 'Blog search results', 'kk_writer_theme' ); ?>">
				<div class="row">

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

						<!-- BLOG ITEMS (results)-->
							<?php
							// The main loop of the page.
							if ( $kkw_num_results > 0 ) {
								while ( $kkw_query->have_posts() ) {
									$kkw_query->the_post();
									/** Current post in the loop.
									 *
									 * @var WP_Post|null $kkw_current_post
									 */
									$kkw_current_post = get_post();
									if ( ! ( $kkw_current_post instanceof WP_Post ) ) {
										continue;
									}
									/** Wrapped content item used by the card template.
									 *
									 * @var KKW_WrappedItem $kkw_post_wrapper
									 */
									$kkw_post_wrapper = KKW_ContentsManager::wrap_search_result( $kkw_current_post );
									/** Wrapped featured image for the current card.
									 *
									 * @var KKW_WrappedImage $kkw_image_wrapper
									 */
									$kkw_image_wrapper = KKW_ContentsManager::wrap_featured_image( $kkw_post_wrapper, 'blog-section' );
									$kkw_icon_name     = KKW_ContentsManager::get_post_icon_by_group( $kkw_post_wrapper->main_group );
									?>
								<article class="col-md-4 mb-5">
									<div class="card">
										<a class="text-decoration-none"
											href="<?php echo esc_url( $kkw_post_wrapper->detail_url ); ?>">
											<img src="<?php echo esc_url( $kkw_image_wrapper->src ); ?>"
												class="card-img-top img-fluid"
												alt="<?php echo esc_attr( $kkw_image_wrapper->alt ); ?>">
										</a>
										<div class="card-body">
											<h5 class="card-title">
												<?php echo esc_html( $kkw_post_wrapper->title ); ?>
											</h5>
											<p class="card-text">
												<?php echo esc_html( clean_and_truncate_text( $kkw_post_wrapper->description, KKW_FEATURED_TEXT_MAX_SIZE ) ); ?>
											</p>
											<div class="text-center">
												<a href="<?php echo esc_url( $kkw_post_wrapper->detail_url ); ?>" class="btn btn-secondary">
													<?php echo esc_html__( 'Read more', 'kk_writer_theme' ); ?>
													&nbsp;<i class="fa-solid fa-arrow-right"></i>
												</a>
										</div>
									</div>
										<div class="card-footer text-color-secondary">
											<div class="text-muted d-flex justify-content-between align-items-center">
												<i class="fa-solid <?php echo esc_attr( $kkw_icon_name ); ?>"
													data-bs-toggle="<?php echo esc_attr( $kkw_post_wrapper->main_group ); ?>"
													title="<?php echo esc_attr( ucfirst( $kkw_post_wrapper->main_group ) ); ?>"></i>
												<span><?php echo esc_html( $kkw_post_wrapper->view_date ); ?></span>
											</div>
										</div>
								</div>
							</article>
									<?php
								}
							}
							wp_reset_postdata();
							?>
				</div>

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

		</div> <!-- row -->

	</div> <!-- body -->

</main>


<?php
get_footer();
