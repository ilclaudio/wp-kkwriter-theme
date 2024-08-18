<?php
/**
 * Template Name: sitemap
 *
 * KK Writer Theme: The SITEMAP page.
 * @package KK_Writer_Theme
 */
?>
<?php
global $post;
get_header();
$section             = __( 'Site Map' , 'kk_writer_theme' );
$section_description = '';

// Build the PAGE TREE.
try {
	$pt = KKW_NavigationManager::get_site_tree();
} catch ( Exception $e ) {
	$pt  = array();
	$msg = 'Caught exception: ' . $e->getMessage() . '\n';
	error_log( $msg );
}
?>


<main class="container">
	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<!-- BODY -->
	<div class="container mt-2">

		<!-- BANNER -->
		<section class="row mb-2 py-4 primary-bg">
			<h1><?php echo $section; ?></h1>
			<?php
				if ( $section_description ){
			?>
			<div class="col-12">
				<div class="form-group col text-left mb-2">
				<?php echo $section_description; ?>
				</div>
			</div>
			<?php
				}
			?>
		</section>

		<section class="row">
			<!-- SITE MAP -->
			<div class="container my-4">
				<div class="row variable-gutters d-flex justify-content-center">
					<div class="col-lg-8 pt84">

						<!-- TREE -->
						<?php
							if ( count( $pt ) > 0 ) {
						?>
						<ul class="menutree">
							<li>
								<a href="<?php echo $pt[KKW_HOMEPAGE_SLUG]->link; ?>">
									<?php echo $pt[KKW_HOMEPAGE_SLUG]->name; ?>
								</a>
							</li>
							<ul>
								<?php
								// I level.
								foreach ( $pt[KKW_HOMEPAGE_SLUG]->children as $item ) {
									if ( $item->link === '' ) {
										echo '<li>' . $item->name . '</li>';
									} else if ( $item->external ) {
										echo '<li><a target="_blank" href="' . $item->link . '">' . $item->name . '</a></li>';
									} else {
										echo '<li><a href="' . $item->link . '">' . $item->name . '</a></li>';
									}
									// II level.
									echo '<ul>';
									foreach ( $item->children as $childitem ) {
										if ( $childitem->link === '' ) {
											echo '<li>' . $childitem->name . '</li>';
										} else if ( $childitem->external ) {
											echo '<li><a target="_blank" href="' . $childitem->link . '">' . $childitem->name . '</a></li>';
										} else {
											echo '<li><a href="' . $childitem->link . '">' . $childitem->name . '</a></li>';
										}
										// III level.
										echo '<ul>';
										foreach ( $childitem->children as $grandchilditem ) {
											if ( $grandchilditem->link === '' ) {
												echo '<li>' . $grandchilditem->name . '</li>';
											} else if ( $grandchilditem->external ) {
												echo '<li><a target="_blank" href="' . $grandchilditem->link . '">' . $grandchilditem->name . '</a></li>';
											} else {
												echo '<li><a href="' . $grandchilditem->link . '">' . $grandchilditem->name . '</a></li>';
											}
										}
										echo '</ul>';
									}
									echo '</ul>';
								}
								?>
							</ul>
						</ul>
						<?php
							}
						?>

						<!-- MULTILANGUAGE MAPS -->
						 <?php
							$current_language = KKW_MultiLangManager::get_current_language( 'slug' );
							// $languages        = KKW_MultiLangManager::get_all_languages();
							$sitemap_id       = $post->ID;
							$maps             = KKW_MultiLangManager::get_post_translations( $sitemap_id );
						 ?>
						<div class="box_change_map_lang text-center mt-5">
							<ul>
								<?php
									foreach( $maps as $lang => $pid ) {
										if ( $lang !== $current_language ) {
											$map  = get_post( $pid );
											$desc = $map->post_title . ' (' . strtoupper( $lang ). ')';
								?>
											<li>
												<a title="<?php echo $desc ; ?>" href="<?php echo get_permalink( $pid ); ?>"><?php echo $desc; ?></a>
											</li>
								<?php
										}
									}
								?>
							</ul>
						</div>

					</div>
				</div>
			</div>
		</section>

	</div>
</main>

<?php
get_footer();
