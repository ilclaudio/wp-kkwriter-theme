<?php
/**
 * Template Name: section
 *
 * KK Writer Theme: The SECTION template.
 *
 * @package KK_Writer_Theme
 */

get_header();

global $post;
$kkw_section_label       = $post->post_title;
$kkw_section             = sanitize_title( $post->post_title );
$kkw_section_description = '';

// Manage ordering parameters.
$kkw_default_sort_order = 'DESC';
$kkw_default_sort_field = 'kkw_year';

$kkw_valid_sort_orders = array( 'ASC', 'DESC' );
$kkw_sort_order_raw    = filter_input( INPUT_GET, 'sort_order', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$kkw_sort_order        = is_string( $kkw_sort_order_raw ) ? sanitize_text_field( $kkw_sort_order_raw ) : $kkw_default_sort_order;
$kkw_sort_order        = strtoupper( trim( $kkw_sort_order ) );
if ( ! in_array( $kkw_sort_order, $kkw_valid_sort_orders, true ) ) {
	$kkw_sort_order = $kkw_default_sort_order;
}

$kkw_valid_sort_fields = array( 'title', 'kkw_year' );
$kkw_sort_field_raw    = filter_input( INPUT_GET, 'sort_field', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$kkw_sort_field        = is_string( $kkw_sort_field_raw ) ? sanitize_text_field( $kkw_sort_field_raw ) : $kkw_default_sort_field;
if ( ! in_array( $kkw_sort_field, $kkw_valid_sort_fields, true ) ) {
	$kkw_sort_field = $kkw_default_sort_field;
}

$kkw_section_query = KKW_ContentsManager::get_section_books_query(
	$kkw_section,
	$kkw_sort_field,
	$kkw_sort_order,
	SECTIONS_CELLS_PER_PAGE
);

$kkw_prologue = KKW_ContentsManager::get_page_prologue( $post->ID );
$kkw_epilogue = KKW_ContentsManager::get_page_epilogue( $post->ID );
$kkw_quote    = KKW_ContentsManager::get_page_quote( $post->ID );

$kkw_num_results = $kkw_section_query->found_posts;
$kkw_total_pages = $kkw_section_query->max_num_pages;
?>

<main class="container">
	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<!-- BODY -->
	<div class="container mt-2">

		<!-- BANNER -->
		<section class="row mb-2 py-4 primary-bg">
			<h1><?php echo esc_html( ucfirst( $kkw_section_label ) ); ?></h1>
			<?php if ( '' !== $kkw_section_description ) : ?>
				<div class="col-12">
					<div class="form-group col text-left mb-2">
						<?php echo wp_kses_post( wpautop( $kkw_section_description ) ); ?>
					</div>
				</div>
			<?php endif; ?>
		</section>

		<!-- QUOTES, if present -->
		<?php if ( '' !== $kkw_quote ) : ?>
			<section class="row pt-2 mb-2">
				<div class="col-md-12 m-0 p-0">
					<div class="px-3 py-0 bg-light border rounded text-end">
						<blockquote class="blockquote mb-0">
							<?php echo wp_kses_post( wpautop( $kkw_quote ) ); ?>
						</blockquote>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<!-- PROLOGUE, if present -->
		<?php if ( '' !== $kkw_prologue ) : ?>
			<section class="row py-2 mb-5 px-5">
				<div class="col-md-12 m-0 p-0">
					<?php echo wp_kses_post( wpautop( $kkw_prologue ) ); ?>
				</div>
			</section>
		<?php endif; ?>

		<!-- Search filters and results -->
		<?php if ( 0 < $kkw_num_results ) : ?>
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

				<!-- SECTION BOOKS (results) -->
				<section class="col-md-12 px-5 pt-0 mt-2">
					<div class="row mb-5">
						<?php
						while ( $kkw_section_query->have_posts() ) {
							$kkw_section_query->the_post();
							$kkw_post_wrapper  = KKW_ContentsManager::wrap_search_result( $post );
							$kkw_image_wrapper = KKW_ContentsManager::wrap_featured_image( $kkw_post_wrapper, 'large' );
							?>
							<!-- BOOK CARD -->
							<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
								<div class="card h-100">
									<a class="text-decoration-none" href="<?php echo esc_url( $kkw_post_wrapper->detail_url ); ?>">
										<img class="card-img-top p-4 section-card-image"
											src="<?php echo esc_url( $kkw_image_wrapper->src ); ?>"
											alt="<?php echo esc_attr( $kkw_image_wrapper->alt ); ?>">
									</a>
									<div class="card-body">
										<h6 class="card-author"><?php echo esc_html( $kkw_post_wrapper->author ); ?></h6>
										<h5 class="card-title">
											<a class="text-decoration-none text-color-tertiary font-weight-bold" href="<?php echo esc_url( $kkw_post_wrapper->detail_url ); ?>">
												<?php echo esc_html( $kkw_post_wrapper->title ); ?>
											</a>
										</h5>
										<p class="card-text">
											<?php echo esc_html( $kkw_post_wrapper->publisher ); ?> -
											<?php echo esc_html( $kkw_post_wrapper->view_date ); ?>
										</p>
									</div>
								</div>
							</div>
							<?php
						}
						wp_reset_postdata();
						?>

						<!-- PAGINATION -->
						<?php
						if ( 1 < $kkw_total_pages ) {
							get_template_part(
								'template-parts/common/pagination',
								null,
								array(
									'query' => $kkw_section_query,
								)
							);
						}
						?>
					</div>
				</section>
			</div>
		<?php endif; ?>

		<!-- No results -->
		<?php if ( 0 === (int) $kkw_num_results ) : ?>
			<section class="row">
				<div class="col-md-12 text-center fst-italic py-4 pt-5" style="min-height: 300px;">
					<?php echo esc_html__( 'There are no books in this section.', 'kk_writer_theme' ); ?>
				</div>
			</section>
		<?php endif; ?>

		<!-- EPILOGUE, if present -->
		<?php if ( '' !== $kkw_epilogue ) : ?>
			<section class="row py-2 mt-2 mb-5 px-5">
				<div class="col-md-12 m-0 p-0">
					<?php echo wp_kses_post( wpautop( $kkw_epilogue ) ); ?>
				</div>
			</section>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
