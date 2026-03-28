<?php
/**
 * KK Writer Theme: The template of the related books section.
 *
 * @package KK_Writer_Theme
 */

$kkw_books       = isset( $args['books'] ) && is_array( $args['books'] ) ? $args['books'] : array();
$kkw_size_string = ! empty( $args['size_string'] ) ? $args['size_string'] : 'featured-post';

if ( ! empty( $kkw_books ) ) {
	?>
	<div class="row">
		<?php foreach ( $kkw_books as $kkw_book_id ) : ?>
			<?php
			$kkw_book_post_id = KKW_ThemeLangManager::get_page_by_id( $kkw_book_id );
			$kkw_post_wrapper = KKW_ContentsManager::get_wrapped_item( $kkw_book_post_id );

			if ( ! $kkw_post_wrapper ) {
				continue;
			}

			$kkw_image_wrapper = KKW_ContentsManager::wrap_featured_image( $kkw_post_wrapper, $kkw_size_string );
			if ( ! $kkw_image_wrapper ) {
				continue;
			}
			?>
			<div class="col-6 col-md-4 mb-4">
				<a href="<?php echo esc_url( $kkw_post_wrapper->detail_url ); ?>">
					<img src="<?php echo esc_url( $kkw_image_wrapper->src ); ?>"
						class="img-fluid img-thumbnail"
						alt="<?php echo esc_attr( $kkw_image_wrapper->alt ); ?>">
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}
