<?php
/**
 * KK Writer Theme: The SECTION template.
 *
 * @package KK_Writer_Theme
 */
?>
<?php
$section_label       = $args['section_label'];
$section             = $args['section'];
$section_description = $args['section_description'];

// Manage ordering parameters.
$valid_sort_orders   = array( 'ASC', 'DESC' );
$type_order          = isset($_GET['sort_order']) ? sanitize_text_field($_GET['sort_order']) : 'ASC';
$type_order          = strtoupper(trim($type_order));
if ( ! in_array( $type_order, $valid_sort_orders ) ) {
	$type_order = 'ASC';
}
$valid_sort_fields = array( 'title', 'kkw_year' );
$sort_field        = isset($_GET['sort_field']) ? sanitize_text_field($_GET['sort_field']) : 'title';
if (!in_array($sort_field, $valid_sort_fields)) {
	$sort_field = 'title';
}

// Manage query arguments.
$args = array(
	'post_type'      => KKW_POST_TYPES[ ID_PT_BOOK ]['name'],
	'order'          => $type_order,
	'paged'          => get_query_var( 'paged', 1 ),
	'posts_per_page' => SECTIONS_CELLS_PER_PAGE,
	'tax_query'      => array(
			array(
					'taxonomy' => 'section', 
					'field'    => 'slug',
					'terms'    => $section_label,
			),
	),
);

if ( $sort_field === 'kkw_year' ) {
	$args['orderby']  = 'meta_value_num';
	$args['meta_key'] = 'kkw_year';
} else {
	$args['orderby'] = $sort_field;
}
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
		<?php
		 if( $num_results ) {
		?>
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

			<!-- SECTION BOOKS (results) -->
			<section class="col-md-12 px-5 pt-0 mt-2">
				<div class="row mb-5">
					<?php
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$post_wrapper  = KKW_ContentsManager::wrap_search_result( $post );
						$image_wrapper = KKW_ContentsManager::wrap_featured_image( $post_wrapper, 'full' );
					?>
						<!-- CARD LIBRO -->
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
							<div class="card h-100">
								<a class="text-decoration-none" 
									href="<?php echo $post_wrapper->detail_url; ?>">
									<img class="card-img-top p-4 section-card-image"
										src="<?php echo esc_url( $image_wrapper->src ); ?>"
										alt="<?php echo esc_attr( $image_wrapper->alt ); ?>">
								</a>
								<div class="card-body">
									<h6 class="card-author">
										<?php echo esc_attr( $post_wrapper->author); ?>
									</h6>
									<h5 class="card-title">
										<a class="text-decoration-none text-color-tertiary font-weight-bold"
											href="<?php echo $post_wrapper->detail_url; ?>">
											<?php echo esc_attr( $post_wrapper->title); ?>
										</a>
									</h5>
									<p class="card-text">
									<?php echo esc_attr( $post_wrapper->publisher); ?> - 
										<?php echo esc_attr( $post_wrapper->view_date); ?>
									</p>
								</div>
							</div>
						</div>
					<?php
					}
					?>

					<!-- PAGINATION -->
					<?php
						if ( $total_pages > 1 ){
							get_template_part(
								'template-parts/common/pagination',
								null,
								array(
									'query' => $the_query,
								)
							);
						}
					?>
				</div> <!-- row -->
			</section>
			
		</div>
		<?php
		 }
		?>

		<!-- No results -->
		<?php
		 if( ! $num_results ) {
		?>
			<section class="row">
				<div class="col-md-12 text-center fst-italic pt-5" style="min-height: 300px;">
					<?php echo __( 'There are no books in this section.' , 'kk_writer_theme' ); ?>
				</div>
			</section>
		<?php
			}
		?>
	</div>

</main>
