<?php
/**
 * KK Writer Theme: The BOOK INFO section.
 *
 * @package KK_Writer_Theme
 */

$kkw_post_wrapper = isset( $args['post_wrapper'] ) ? $args['post_wrapper'] : null;

if ( $kkw_post_wrapper ) {
	$kkw_isbn         = ! empty( $kkw_post_wrapper->isbn ) ? $kkw_post_wrapper->isbn : '-';
	$kkw_price        = ( ! empty( $kkw_post_wrapper->price ) && ! empty( $kkw_post_wrapper->show_price ) ) ? $kkw_post_wrapper->price : '-';
	$kkw_pages_count  = ! empty( $kkw_post_wrapper->pages ) ? $kkw_post_wrapper->pages : '-';
	$kkw_publisher    = ! empty( $kkw_post_wrapper->publisher ) ? $kkw_post_wrapper->publisher : '-';
	$kkw_pres_author  = ! empty( $kkw_post_wrapper->presentation_author ) ? $kkw_post_wrapper->presentation_author : '';
	$kkw_publisherurl = ! empty( $kkw_post_wrapper->publisher_page ) ? $kkw_post_wrapper->publisher_page : '';
	$kkw_book_url     = ! empty( $kkw_post_wrapper->publisher_book_page ) ? $kkw_post_wrapper->publisher_book_page : '';
	?>
	<div class="container my-5 mx-3">
		<div class="row">
			<div class="col-md-6">
				<div class="row mt-3">
					<div class="col-4 fw-bold"><?php esc_html_e( 'Title', 'kk_writer_theme' ); ?>:</div>
					<div class="col-8 fw-bold"><?php echo esc_html( $kkw_post_wrapper->title ); ?></div>
				</div>
				<div class="row mt-3">
					<div class="col-4 fw-bold"><?php esc_html_e( 'Author', 'kk_writer_theme' ); ?>:</div>
					<div class="col-8"><?php echo esc_html( $kkw_post_wrapper->author ); ?></div>
				</div>
				<div class="row mt-3">
					<div class="col-4 fw-bold"><?php esc_html_e( 'Year', 'kk_writer_theme' ); ?>:</div>
					<div class="col-8"><?php echo esc_html( $kkw_post_wrapper->view_date ); ?></div>
				</div>
				<div class="row mt-3">
					<div class="col-4 fw-bold"><?php esc_html_e( 'Publisher', 'kk_writer_theme' ); ?>:</div>
					<div class="col-8 fst-italic">
						<?php if ( $kkw_publisherurl ) : ?>
							<a target="_blank" rel="noopener noreferrer" href="<?php echo esc_url( $kkw_publisherurl ); ?>">
						<?php endif; ?>
						<?php echo esc_html( $kkw_publisher ); ?>
						<?php if ( $kkw_publisherurl ) : ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
				<?php if ( $kkw_pres_author ) : ?>
					<div class="row mt-3">
						<div class="col-4 fw-bold"><?php esc_html_e( 'Presentation of', 'kk_writer_theme' ); ?>:</div>
						<div class="col-8"><?php echo esc_html( $kkw_pres_author ); ?></div>
					</div>
				<?php endif; ?>
			</div>

			<div class="col-md-6">
				<div class="row mt-3">
					<div class="col-4 fw-bold"><?php esc_html_e( 'Section', 'kk_writer_theme' ); ?>:</div>
					<div class="col-8"><?php echo esc_html( $kkw_post_wrapper->main_group ); ?></div>
				</div>
				<div class="row mt-3">
					<div class="col-4 fw-bold"><?php esc_html_e( 'Pages', 'kk_writer_theme' ); ?>:</div>
					<div class="col-8"><?php echo esc_html( $kkw_pages_count ); ?></div>
				</div>
				<div class="row mt-3">
					<div class="col-4 fw-bold"><?php esc_html_e( 'ISBN', 'kk_writer_theme' ); ?>:</div>
					<div class="col-8">
						<?php if ( $kkw_book_url ) : ?>
							<a target="_blank" rel="noopener noreferrer" href="<?php echo esc_url( $kkw_book_url ); ?>">
						<?php endif; ?>
						<?php echo esc_html( $kkw_isbn ); ?>
						<?php if ( $kkw_book_url ) : ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-4 fw-bold"><?php esc_html_e( 'Price', 'kk_writer_theme' ); ?>:</div>
					<div class="col-8"><?php echo esc_html( $kkw_price ); ?></div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
