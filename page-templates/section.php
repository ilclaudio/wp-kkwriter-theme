<?php
/**
 * Template Name: section
 * 
 * KK Writer Theme: The SECTION template.
 *
 * @package KK_Writer_Theme
 */
?>
<?php
get_header();

global $post;
$section_label       = $post->post_title;
$section             = sanitize_title( $post->post_title );
$section_description = '';

// Manage ordering parameters.
$def_sort_order = 'DESC';
$def_sort_field = 'kkw_year';

$valid_sort_orders   = array( 'ASC', 'DESC' );
$sort_order          = isset( $_GET['sort_order'] ) ? sanitize_text_field( $_GET['sort_order'] ) : $def_sort_order;
$sort_order          = strtoupper( trim( $sort_order ) );
if ( ! in_array( $sort_order, $valid_sort_orders ) ) {
	$sort_order = $def_sort_order;
}
$valid_sort_fields = array( 'title', 'kkw_year' );
$sort_field        = isset( $_GET['sort_field'] ) ? sanitize_text_field( $_GET['sort_field'] ) : $def_sort_field;
if ( ! in_array( $sort_field, $valid_sort_fields ) ) {
	$sort_field = $def_sort_field;
}

$the_query = KKW_ContentsManager::get_section_books_query(
	$section,
	$sort_field,
	$sort_order,
	SECTIONS_CELLS_PER_PAGE
);

$prologue = KKW_ContentsManager::get_page_prologue( $post->ID );
$epilogue = KKW_ContentsManager::get_page_epilogue( $post->ID );
$quote    = KKW_ContentsManager::get_page_quote( $post->ID );

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
			<h1><?php echo ucfirst( $section_label ); ?></h1>
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


		<!-- QUOTES, if present -->
		<?php
		 if( $quote ) {
		?>
		<section class="row pt-2 mb-2">
			<div class="col-md-12 m-0 p-0">
				<div class="px-3 py-0 bg-light border rounded text-end">
						<blockquote class="blockquote">
								<p class="mb-0">
									<?php echo wpautop( wp_kses_post( $quote ) ); ?>
								</p>
						</blockquote>
				</div>
			</div>
		</section>
		<?php
		 }
		?>

		<!-- PROLOGUE, if present -->
		<?php
			if( $prologue ) {
		?>
				<section class="row py-2 mb-5 px-5">
					<div class="col-md-12 m-0 p-0">
						<?php echo wpautop( wp_kses_post( $prologue ) ); ?>
					</div>
				</section>
		<?php
			}
		?>

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
						$image_wrapper = KKW_ContentsManager::wrap_featured_image( $post_wrapper, 'large' );
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
				<div class="col-md-12 text-center fst-italic py-4 pt-5" style="min-height: 300px;">
					<?php echo __( 'There are no books in this section.' , 'kk_writer_theme' ); ?>
				</div>
			</section>
		<?php
			}
		?>

		<!-- EPILOGUE, if present -->
		<?php
			if( $epilogue ) {
		?>
				<section class="row py-2 mt-2 mb-5 px-5">
					<div class="col-md-12 m-0 p-0">
						<?php echo wpautop( wp_kses_post( $epilogue ) ); ?>
					</div>
				</section>
		<?php
			}
		?>
		
	</div>

</main>

<?php
get_footer();
