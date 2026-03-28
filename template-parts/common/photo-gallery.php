<?php
/**
 * KK Writer Theme: The template of the photo gallery.
 * This gallery is based on Lightbox by Lokesh Dhakar: https://github.com/lokesh/lightbox2.
 *
 * @package KK_Writer_Theme
 */

$kkw_gallery     = isset( $args['gallery'] ) && is_array( $args['gallery'] ) ? $args['gallery'] : array();
$kkw_size_string = ! empty( $args['size_string'] ) ? $args['size_string'] : 'item-thumb';

if ( ! empty( $kkw_gallery ) ) {
	?>
	<div class="row">
		<?php foreach ( $kkw_gallery as $kkw_gallery_id => $kkw_gallery_src ) : ?>
			<?php
			$kkw_src_image = $kkw_gallery_src;
			$kkw_img_array = wp_get_attachment_image_src( $kkw_gallery_id, $kkw_size_string );
			$kkw_img_src   = $kkw_img_array ? $kkw_img_array[0] : '';
			$kkw_img_alt   = get_post_meta( $kkw_gallery_id, '_wp_attachment_image_alt', true );
			$kkw_src_thumb = $kkw_img_src;
			?>
			<div class="col-6 col-md-4 mb-4">
				<a href="<?php echo esc_url( $kkw_src_image ); ?>" data-lightbox="gallery">
					<img src="<?php echo esc_url( $kkw_src_thumb ); ?>"
						class="img-fluid img-thumbnail"
						alt="<?php echo esc_attr( $kkw_img_alt ); ?>">
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}
