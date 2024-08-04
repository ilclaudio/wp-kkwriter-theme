<?php
/**
 * KK Writer Theme: The template of the photo gallery.
 * This gallery is based on the great library Lightbox by Lokesh Dhakar: https://github.com/lokesh/lightbox2.
 * 
 *
 * @package KK_Writer_Theme
 */
?>

<?php
	$gallery     = $args['gallery'];
	$size_string = $args['size_string'] ? $args['size_string'] : '';

	if ( count( $gallery ) ) {
?>
	<div class="row">

			<?php
			foreach( $gallery as $g_id => $g_src ) {
				$src_image = $g_src;
				// $img_id    = get_post_thumbnail_id($g_id );
				$img_array = wp_get_attachment_image_src( $g_id , $size_string );
				$img_src   = $img_array ? $img_array[0] : '';
				$img_alt   = get_post_meta( $g_id, '_wp_attachment_image_alt', true );
				$src_thumb = $img_src;
			?>
				<div class="col-6 col-md-4 mb-4">
					<a href="<?php echo esc_url( $src_image ); ?>" data-lightbox="gallery">
						<img src="<?php echo esc_url( $src_thumb ); ?>"
							class="img-fluid img-thumbnail"
							alt="<?php echo esc_attr( $img_alt ); ?>">
					</a>
				</div>
			<?php
			}
			?>
	</div>
<?php
	}
?>