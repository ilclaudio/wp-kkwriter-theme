<?php
/**
 * KK Writer Theme: The BOOK INFO section.
 *
 * @package KK_Writer_Theme
 */
$post_wrapper = $args['post_wrapper'];

if ( $post_wrapper ) {
	$isbn      = $post_wrapper->isbn ? $post_wrapper->isbn : '-';
	$price     = $post_wrapper->price ? $post_wrapper->price : '-';
	$pages     = $post_wrapper->pages ? $post_wrapper->pages : '-';
	$publisher = $post_wrapper->publisher ? $post_wrapper->publisher : '-';
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
				<div class="col-8 fst-italic"><?php echo esc_attr( $publisher ); ?></div>
			</div>
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
				<div class="col-8"><?php echo esc_attr( $isbn ); ?></div>
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
