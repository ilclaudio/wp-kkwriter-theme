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
	?>
		<!-- Box i -->
		<div class="col-12 col-md-4 mb-4">
				<div class="card">
						<img src="immagine1.jpg" class="card-img-top" alt="Immagine 1">
						<div class="card-body">
								<h5 class="card-title">
									<?php echo esc_attr( $blog->title ); ?>
								</h5>
								<p class="card-text">
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