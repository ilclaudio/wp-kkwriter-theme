<?php
/**
 * KK Writer Theme: The BLOG sections in the Home Page oif the site.
 *
 * @package KK_Writer_Theme
 */


$blog_items = KKW_ContentsManager::get_latest_posts( 'article', 3 );

if ( count( $blog_items ) ){
?>

<div id="fc_first_row" class="row mt-4 mb-1 fc-row">
	<?php
		foreach ( $blog_items as $blog ) {
			$blog_img_id    = $blog->id ? get_post_thumbnail_id( $blog->id ) : null;
			$blog_img_array = $blog_img_id ? wp_get_attachment_image_src( $blog_img_id, 'blog-section' ) : null;
			$blog_img_src   = $blog_img_array  ? $blog_img_array [0] : '';
			$blog_img_alt   = $blog_img_id ? get_post_meta( $blog_img_id, '_wp_attachment_image_alt', true ) : '';
			$blog_img_alt   = $blog_img_alt ? $blog_img_alt : $blog->title;	
	?>
		<!-- Box i -->
		<div class="col-12 col-md-4 mb-4">
				<div class="card">
						<img src="<?php echo esc_url( $blog_img_src ); ?>"
									class="card-img-top bd-placeholder-img"
									width="<?php echo strval( KKW_BLOG_SECTION_IMG_WIDTH ); ?>"
									height="<?php echo strval( KKW_BLOG_SECTION_IMG_HEIGHT ); ?>"
									alt="<?php echo esc_attr( $blog_img_alt ); ?>" />
						<div class="card-body">
								<h5 class="card-title">
									<?php echo esc_attr( $blog->title ); ?>
								</h5>
								<p class="card-text kkw_featured_text">
									<?php echo clean_and_truncate_text( $blog->description, KKW_FEATURED_TEXT_MAX_SIZE ); ?>
								</p>
								<small class="text-body-secondary">
									<a class="kkw_link"
										href="<?php echo esc_url( $blog->detail_url ); ?>">
										<?php echo __( 'Keep reading...', 'kk_writer_theme' ); ?>
									</a>
								</small>
						</div>
				</div>
		</div>
	<?php
	}
	?>
</div>

<?php
}
?>