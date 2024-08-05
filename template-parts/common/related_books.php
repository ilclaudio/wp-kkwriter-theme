<?php
/**
 * KK Writer Theme: The template of the related books section.
 * 
 *
 * @package KK_Writer_Theme
 */
?>

<?php
	$books       = $args['books'];
	$size_string = $args['size_string'] ? $args['size_string'] : 'featured-post';

	if ( count( $books ) ) {
?>
	<div class="row">

			<?php
			foreach( $books as $g_id ) {
				$post_id       = KKW_MultiLangManager::get_page_by_id( $g_id );
				$post_wrapper  = KKW_ContentsManager::get_wrapped_item( $post_id );
				$image_wrapper = KKW_ContentsManager::wrap_featured_image( $post_wrapper, $size_string );
			?>
				<div class="col-6 col-md-4 mb-4">
					<a href="<?php echo esc_url( $post_wrapper->detail_url ); ?>">
						<img src="<?php echo esc_url( $image_wrapper->src ); ?>"
							class="img-fluid img-thumbnail"
							alt="<?php echo esc_attr( $image_wrapper->alt ); ?>">
					</a>
				</div>
			<?php
			}
			?>
	</div>
<?php
	}
?>