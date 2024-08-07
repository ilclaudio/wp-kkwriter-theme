<?php
/**
 * KK Writer Theme: The BLOG page.
 *
 * @package KK_Writer_Theme
 */

get_header();

$section_label       = 'Blog';
$section             = __( $section_label , 'kk_writer_theme' );
$section_description = '';

// Manage ordering parameters.
$valid_sort_orders   = array( 'ASC', 'DESC' );
$type_order          = isset($_GET['sort_order']) ? sanitize_text_field($_GET['sort_order']) : 'ASC';
$type_order          = strtoupper(trim($type_order));
if ( ! in_array( $type_order, $valid_sort_orders ) ) {
	$type_order = 'ASC';
}
$valid_sort_fields = array( 'title', 'date');
$sort_field        = isset($_GET['sort_field']) ? sanitize_text_field($_GET['sort_field']) : 'title';
if (!in_array($sort_field, $valid_sort_fields)) {
	$sort_field = 'title';
}

// Manage post types.
$valid_selected_contents = KKW_ContentsManager::get_post_groups_filter_keys();
$content_types_filters   = KKW_ContentsManager::get_post_groups_filters();
$selected_contents       = array();
if ( isset( $_GET['selected_contents'] ) ) {
	$selected_contents = $_GET['selected_contents'];
	$diff = array_diff( $selected_contents, $valid_selected_contents );
	if ( (! is_array( $selected_contents ) ) || ( count( $diff ) > 0 ) ) {
		$selected_contents = $valid_selected_contents;
	}
} else {
	$selected_contents = $valid_selected_contents;
}

// Manage query arguments.
$args = array(
	'post_type'      => 'post',
	'order'          => $type_order,
	'paged'          => get_query_var( 'paged', 1 ),
	'posts_per_page' => BLOG_ARTICLES_CELLS_PER_PAGE,
	'orderby'        => $sort_field,
	'meta_query'     => array(
		array(
			'key'     => 'kkw_group',
			'value'   => $selected_contents,
		),
	),
);

// Execute the query.
$the_query   = new WP_Query( $args );
$num_results = $the_query->found_posts;
$total_pages = $the_query->max_num_pages;
?>

<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<!-- BODY -->
	<div class="container mt-2">

		<!-- BANNER -->
		<section class="row mb-2 py-4 primary-bg">
			<h1><?php echo $section; ?></h1>
			<?php
				if ( $section_description ){
			?>
			<div class="col-12">
				<div class="form-group col text-left mb-2">
				<?php echo $section_description; ?>
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
					<FORM action="." id="search_site_form" method="GET"
						role="search" aria-label="<?php echo __( 'Site search' , 'kk_writer_theme' ); ?>">
						<?php wp_nonce_field( 'sf_blog_search_nonce', 'blog_search_nonce_field' ); ?>

						<h5 class="text-uppercase border-bottom"><?php echo __( 'Filter by group' , 'kk_writer_theme' ); ?></h5>
						<fieldset class="font-larger">
							<?php
								foreach( $content_types_filters as $pt_name => $pt_label ) {
							?>
								<div class="form-check mb-2 mt-2">
									<input type="checkbox" name="selected_contents[]" id="<?php echo $pt_label; ?>" 
										value="<?php echo $pt_name; ?>"
										<?php if (count( $selected_contents ) > 0 && in_array( $pt_name, $selected_contents ) ) {
												echo "checked='checked'";
										} ?>
									>
									<label for="<?php echo $pt_label ; ?>">
										<?php echo __( $pt_label , 'kk_writer_theme' ); ?>
									</label> &nbsp;
									<i class="fa-regular <?php echo KKW_ContentsManager::get_post_icon_by_group( $pt_name );?> fa-1x"></i>
								</div>
							<?php
								}
							?>
						</fieldset>
						<div class="text-center ">
							<button type="submit" class="btn btn-outline-secondary mt-3">
								<?php echo __( 'Reload' , 'kk_writer_theme' ); ?>
							</button>
						</div>
					</FORM>
				</aside>

				<!-- RESULTS column -->
				<section class="col-md-10" aria-label="<?php echo __( 'Blog search results' , 'kk_writer_theme' ); ?>">
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
								$pindex = 0;
								if ( $num_results > 0 ) {
									while ( $the_query->have_posts() ) {
										$the_query->the_post();
										$post_wrapper  = KKW_ContentsManager::wrap_search_result( $post );
										$image_wrapper = KKW_ContentsManager::wrap_featured_image( $post_wrapper, 'blog-section' );
										$icon_name     = KKW_ContentsManager::get_post_icon_by_group( $post_wrapper->main_group );
							?>
								<article class="col-md-4 mb-5">
										<div class="card">
											<a class="text-decoration-none" 
												href="<?php echo $post_wrapper->detail_url; ?>">
												<img src="<?php echo esc_url( $image_wrapper->src ); ?>"
													class="card-img-top img-fluid"
													alt="<?php echo esc_attr( $image_wrapper->alt ); ?>">
											</a>
											<div class="card-body">
												<h5 class="card-title">
													<?php echo esc_attr( $post_wrapper->title); ?>
												</h5>
												<p class="card-text">
													<?php echo clean_and_truncate_text( $post_wrapper->description, KKW_FEATURED_TEXT_MAX_SIZE ); ?>
												</p>
												<div class="text-center">
													<a href="<?php echo $post_wrapper->detail_url; ?>" class="btn btn-secondary">
														<?php echo __( 'Read more...', 'kk_writer_theme' ); ?>
													</a>
												</div>
											</div>
											<div class="card-footer text-color-secondary">
												<div class="text-muted d-flex justify-content-between align-items-center">
													<i class="fa-solid <?php echo $icon_name; ?>"
														data-bs-toggle="<?php echo $post_wrapper->main_group; ?>"
														title="<?php echo $post_wrapper->main_group; ?> "></i>
													<span><?php echo esc_attr( $post_wrapper->view_date ); ?></span>

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
