<?php
/**
 * KKW Writer Theme: Home blog section.
 *
 * @package KK_Writer_Theme
 */

$kkw_blog_items = KKW_ContentsManager::get_site_post_wrappers(
	array( KKW_ARTICLE_GROUP['slug'] ),
	'date',
	'DESC',
	3
);
$kkw_blog_items = is_array( $kkw_blog_items ) ? $kkw_blog_items : array();

if ( empty( $kkw_blog_items ) ) {
	return;
}

$kkw_blog_img_width  = (int) KKW_BLOG_SECTION_IMG_WIDTH;
$kkw_blog_img_height = (int) KKW_BLOG_SECTION_IMG_HEIGHT;
?>

<div id="home_blog_first_row" class="row mt-3 mb-3 fc-row">
	<h3 class="visually-hidden">
		<?php echo esc_html__( 'Section that contains some featured blog posts.', 'kk_writer_theme' ); ?>
	</h3>
	<h3 class="mb-3"><?php echo esc_html__( 'Featured blog articles', 'kk_writer_theme' ); ?></h3>

	<?php foreach ( $kkw_blog_items as $kkw_blog_item ) : ?>
		<?php
		$kkw_blog_post_id   = isset( $kkw_blog_item->id ) ? (int) $kkw_blog_item->id : 0;
		$kkw_blog_img_id    = $kkw_blog_post_id ? get_post_thumbnail_id( $kkw_blog_post_id ) : 0;
		$kkw_blog_img_array = $kkw_blog_img_id ? wp_get_attachment_image_src( $kkw_blog_img_id, 'blog-section' ) : null;
		$kkw_blog_img_src   = ( is_array( $kkw_blog_img_array ) && isset( $kkw_blog_img_array[0] ) ) ? (string) $kkw_blog_img_array[0] : '';
		$kkw_blog_img_alt   = $kkw_blog_img_id ? get_post_meta( $kkw_blog_img_id, '_wp_attachment_image_alt', true ) : '';
		$kkw_blog_title     = isset( $kkw_blog_item->title ) ? (string) $kkw_blog_item->title : '';
		$kkw_blog_desc      = isset( $kkw_blog_item->description ) ? (string) $kkw_blog_item->description : '';
		$kkw_blog_url       = isset( $kkw_blog_item->detail_url ) ? (string) $kkw_blog_item->detail_url : '';

		if ( '' === $kkw_blog_img_alt ) {
			$kkw_blog_img_alt = $kkw_blog_title;
		}

		/* translators: %s: blog post title. */
		$kkw_read_more_aria_label = sprintf( __( 'Read more about: %s', 'kk_writer_theme' ), $kkw_blog_title );
		?>
			<div class="col-12 col-md-4 mb-4">
				<div class="card">
				<img src="<?php echo esc_url( $kkw_blog_img_src ); ?>"
					class="card-img-top bd-placeholder-img"
					width="<?php echo esc_attr( (string) $kkw_blog_img_width ); ?>"
					height="<?php echo esc_attr( (string) $kkw_blog_img_height ); ?>"
					alt="<?php echo esc_attr( $kkw_blog_img_alt ); ?>">
				<div class="card-body">
					<h5 class="card-title"><?php echo esc_html( $kkw_blog_title ); ?></h5>
					<p class="card-text kkw_featured_text">
						<?php echo esc_html( clean_and_truncate_text( $kkw_blog_desc, KKW_FEATURED_TEXT_MAX_SIZE ) ); ?>
						</p>
						<small class="text-body-secondary">
							<a class="kkw_link" href="<?php echo esc_url( $kkw_blog_url ); ?>"
								aria-label="<?php echo esc_attr( $kkw_read_more_aria_label ); ?>">
								<?php echo esc_html__( 'Read more', 'kk_writer_theme' ); ?>
								&nbsp;<i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
							</a>
					</small>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
