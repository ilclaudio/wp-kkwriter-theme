<?php
/**
 * KK Writer Theme: The BOOK INFO section.
 *
 * @package KK_Writer_Theme
 */
$post_wrapper = $args['post_wrapper'];

if ( $post_wrapper ) {
	$isbn      = $post_wrapper->isbn ? $post_wrapper->isbn : '-';
	$price     = $post_wrapper->price && $post_wrapper->show_price ? $post_wrapper->price : '-';
	$pages     = $post_wrapper->pages ? $post_wrapper->pages : '-';
	$publisher = $post_wrapper->publisher ? $post_wrapper->publisher : '-';
	$pres_auth = $post_wrapper->presentation_author ? $post_wrapper->presentation_author : '';
	$publ_site = $post_wrapper->publisher_page ? $post_wrapper->publisher_page : '';
	$book_link = $post_wrapper->publisher_book_page ? $post_wrapper->publisher_book_page : '';
?>

<div class="container my-5 mx-3">
	<div class="row">
		<!-- Prima colonna -->
		<div class="col-md-6">
			<div class="row mt-3">
				<div class="col-4 fw-bold"><?php echo __( 'Title' , 'kk_writer_theme' ); ?>:</div>
				<div class="col-8 fw-bold"><?php echo esc_attr( $post_wrapper->title ); ?></div>
			</div>
			<div class="row mt-3">
				<div class="col-4 fw-bold"><?php echo __( 'Author' , 'kk_writer_theme' ); ?>:</div>
				<div class="col-8"><?php echo esc_attr( $post_wrapper->author ); ?></div>
			</div>
			<div class="row mt-3">
				<div class="col-4 fw-bold"><?php echo __( 'Year' , 'kk_writer_theme' ); ?>:</div>
				<div class="col-8"><?php echo esc_attr( $post_wrapper->view_date); ?></div>
			</div>
			<div class="row mt-3">
				<div class="col-4 fw-bold"><?php echo __( 'Publisher' , 'kk_writer_theme' ); ?>:</div>
				<div class="col-8 fst-italic">
					<?php
						if ( $publ_site ) {
					?>
							<a target="_blank" href="<?php echo esc_url( $publ_site ); ?>">
					<?php
						}
					?>
								<?php echo esc_attr( $publisher ); ?>
					<?php
						if ( $publ_site ) {
					?>
							</a>
					<?php
						}
					?>
				</div>
			</div>
			<?php
				if ( $pres_auth ) {
			?>
			<div class="row mt-3">
				<div class="col-4 fw-bold"><?php echo __( 'Presentation of' , 'kk_writer_theme' ); ?>:</div>
				<div class="col-8"><?php echo esc_attr( $pres_auth ); ?></div>
			</div>
			<?php
				}
			?>
		</div>

		<!-- Seconda colonna -->
		<div class="col-md-6">
			<div class="row mt-3">
				<div class="col-4 fw-bold"><?php echo __( 'Section' , 'kk_writer_theme' ); ?>:</div>
				<div class="col-8"><?php echo esc_attr( $post_wrapper->main_group ); ?></div>
			</div>
			<div class="row mt-3">
				<div class="col-4 fw-bold"><?php echo __( 'Pages' , 'kk_writer_theme' ); ?>:</div>
				<div class="col-8"><?php echo esc_attr( $pages ); ?></div>
			</div>
			<div class="row mt-3">
				<div class="col-4 fw-bold"><?php echo __( 'ISBN' , 'kk_writer_theme' ); ?>:</div>
				<div class="col-8">
				<?php
						if ( $book_link ) {
					?>
							<a target="_blank" href="<?php echo esc_url( $book_link ); ?>">
					<?php
						}
					?>
					<?php echo esc_attr( $isbn ); ?>
					<?php
						if ( $book_link ) {
					?>
							</a>
					<?php
						}
					?>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-4 fw-bold"><?php echo __( 'Price' , 'kk_writer_theme' ); ?>:</div>
				<div class="col-8"><?php echo esc_attr( $price ); ?></div>
			</div>
		</div>
	</div>
</div>

<?php
}
?>
