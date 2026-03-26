<?php
/**
 * Template Name: blog
 *
 * KK Writer Theme: The BLOG page.
 *
 * @package KK_Writer_Theme
 */

get_header();

$section             = __( 'Blog', 'kk_writer_theme' );
$section_description = '';

// Manage ordering parameters.
$valid_sort_orders   = array( 'ASC', 'DESC' );
$sort_order          = isset( $_GET['sort_order'] ) ? sanitize_text_field( wp_unslash( $_GET['sort_order'] ) ) : 'ASC';
$sort_order          = strtoupper( trim( $sort_order ) );
if ( ! in_array( $sort_order, $valid_sort_orders, true ) ) {
	$sort_order = 'ASC';
}
$valid_sort_fields = array( 'title', 'date' );
$sort_field        = isset( $_GET['sort_field'] ) ? sanitize_text_field( wp_unslash( $_GET['sort_field'] ) ) : 'title';
if ( ! in_array( $sort_field, $valid_sort_fields, true ) ) {
	$sort_field = 'title';
}

// Manage post types.
$valid_selected_contents = KKW_ContentsManager::get_post_groups_filter_keys();
/** @var array<string, string> $content_types_filters */
$content_types_filters   = KKW_ContentsManager::get_post_groups_filters();
$selected_contents       = array();
if ( isset( $_GET['selected_contents'] ) && is_array( $_GET['selected_contents'] ) ) {
	$selected_contents = array_map(
		static function ( $value ) {
			return sanitize_text_field( wp_unslash( $value ) );
		},
		$_GET['selected_contents']
	);
	$selected_contents = array_values( array_intersect( $selected_contents, $valid_selected_contents ) );
}

if ( empty( $selected_contents ) ) {
	$selected_contents = $valid_selected_contents;
}

/** @var WP_Query $the_query */
$the_query = KKW_ContentsManager::get_blog_posts_query(
	$selected_contents,
	$sort_field,
	$sort_order,
	BLOG_ARTICLES_CELLS_PER_PAGE
);

$num_results = $the_query->found_posts;
?>

<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<!-- BODY -->
	<div class="container mt-2">

		<!-- BANNER -->
		<section class="row mb-2 py-4 primary-bg">
			<h1><?php echo esc_html( $section ); ?></h1>
			<?php
			if ( $section_description ) {
			?>
			<div class="col-12">
				<div class="form-group col text-left mb-2">
				<?php echo wp_kses_post( $section_description ); ?>
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
						foreach ( $content_types_filters as $pt_name => $pt_label ) {
							$pt_label_i18n = (string) $pt_label;
							$checkbox_id   = sanitize_title( $pt_name );
							?>
							<div class="form-check mb-2 mt-2">
								<input type="checkbox" name="selected_contents[]" id="<?php echo esc_attr( $checkbox_id ); ?>"
									value="<?php echo esc_attr( $pt_name ); ?>"
									<?php checked( in_array( $pt_name, $selected_contents, true ) ); ?>
								>
								<label for="<?php echo esc_attr( $checkbox_id ); ?>">
									<?php echo esc_html( $pt_label_i18n ); ?>
								</label> &nbsp;
								<i class="fa-regular <?php echo esc_attr( KKW_ContentsManager::get_post_icon_by_group( $pt_name ) ); ?> fa-1x"
									title="<?php echo esc_attr( ucfirst( $pt_name ) ); ?>"></i>
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
								'num_results' => $num_results,
							)
						);
					?>

						<!-- BLOG ITEMS (results)-->
						<?php
						// The main loop of the page.
						if ( $num_results > 0 ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								/** @var WP_Post|null $current_post */
								$current_post  = get_post();
								if ( ! ( $current_post instanceof WP_Post ) ) {
									continue;
								}
								/** @var KKW_WrappedItem $post_wrapper */
								$post_wrapper  = KKW_ContentsManager::wrap_search_result( $current_post );
								/** @var KKW_WrappedImage $image_wrapper */
								$image_wrapper = KKW_ContentsManager::wrap_featured_image( $post_wrapper, 'blog-section' );
								$icon_name     = KKW_ContentsManager::get_post_icon_by_group( $post_wrapper->main_group );
								?>
							<article class="col-md-4 mb-5">
								<div class="card">
									<a class="text-decoration-none"
										href="<?php echo esc_url( $post_wrapper->detail_url ); ?>">
										<img src="<?php echo esc_url( $image_wrapper->src ); ?>"
											class="card-img-top img-fluid"
											alt="<?php echo esc_attr( $image_wrapper->alt ); ?>">
									</a>
									<div class="card-body">
										<h5 class="card-title">
											<?php echo esc_html( $post_wrapper->title ); ?>
										</h5>
										<p class="card-text">
											<?php echo esc_html( clean_and_truncate_text( $post_wrapper->description, KKW_FEATURED_TEXT_MAX_SIZE ) ); ?>
										</p>
										<div class="text-center">
											<a href="<?php echo esc_url( $post_wrapper->detail_url ); ?>" class="btn btn-secondary">
												<?php echo esc_html__( 'Read more', 'kk_writer_theme' ); ?>
												&nbsp;<i class="fa-solid fa-arrow-right"></i>
											</a>
										</div>
									</div>
									<div class="card-footer text-color-secondary">
										<div class="text-muted d-flex justify-content-between align-items-center">
											<i class="fa-solid <?php echo esc_attr( $icon_name ); ?>"
												data-bs-toggle="<?php echo esc_attr( $post_wrapper->main_group ); ?>"
												title="<?php echo esc_attr( ucfirst( $post_wrapper->main_group ) ); ?>"></i>
											<span><?php echo esc_html( $post_wrapper->view_date ); ?></span>
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
							'query' => $the_query,
						)
					);
				?>
			</section>

		</div> <!-- row -->

	</div> <!-- body -->

</main>


<?php
get_footer();
