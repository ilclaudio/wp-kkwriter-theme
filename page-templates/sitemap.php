<?php
/**
 * Template Name: sitemap
 *
 * KK Writer Theme: The SITEMAP page.
 *
 * @package KK_Writer_Theme
 */

get_header();

$kkw_section_title       = __( 'Site Map', 'kk_writer_theme' );
$kkw_section_description = '';
$kkw_page_tree           = array();

// Build the page tree.
try {
	$kkw_page_tree = KKW_NavigationManager::get_site_tree();
} catch ( Exception $kkw_exception ) {
	$kkw_page_tree = array();
}

$kkw_render_sitemap_node = static function ( $kkw_node ) use ( &$kkw_render_sitemap_node ) {
	if ( ! is_object( $kkw_node ) ) {
		return;
	}

	$kkw_node_name     = isset( $kkw_node->name ) ? (string) $kkw_node->name : '';
	$kkw_node_link     = isset( $kkw_node->link ) ? (string) $kkw_node->link : '';
	$kkw_node_external = ! empty( $kkw_node->external );

	echo '<li>';
	if ( '' === $kkw_node_link ) {
		echo esc_html( $kkw_node_name );
	} elseif ( $kkw_node_external ) {
		echo '<a target="_blank" rel="noopener noreferrer" href="' . esc_url( $kkw_node_link ) . '">' . esc_html( $kkw_node_name ) . '</a>';
	} else {
		echo '<a href="' . esc_url( $kkw_node_link ) . '">' . esc_html( $kkw_node_name ) . '</a>';
	}
	echo '</li>';

	if ( empty( $kkw_node->children ) || ! is_array( $kkw_node->children ) ) {
		return;
	}

	echo '<ul>';
	foreach ( $kkw_node->children as $kkw_child_node ) {
		$kkw_render_sitemap_node( $kkw_child_node );
	}
	echo '</ul>';
};
?>

<main class="container">
	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<!-- BODY -->
	<div class="container mt-2">
		<!-- BANNER -->
		<section class="row mb-2 py-4 primary-bg">
			<h1><?php echo esc_html( $kkw_section_title ); ?></h1>
			<?php if ( '' !== $kkw_section_description ) : ?>
				<div class="col-12">
					<div class="form-group col text-left mb-2">
						<?php echo wp_kses_post( wpautop( $kkw_section_description ) ); ?>
					</div>
				</div>
			<?php endif; ?>
		</section>

		<section class="row">
			<!-- SITE MAP -->
			<div class="container my-4">
				<div class="row variable-gutters d-flex justify-content-center">
					<div class="col-lg-8 pt84">
						<!-- TREE -->
						<?php
						$kkw_home_node = $kkw_page_tree[ KKW_HOMEPAGE_SLUG ] ?? null;
						if ( is_object( $kkw_home_node ) ) {
							$kkw_home_link = isset( $kkw_home_node->link ) ? (string) $kkw_home_node->link : '';
							$kkw_home_name = isset( $kkw_home_node->name ) ? (string) $kkw_home_node->name : '';
							?>
							<ul class="menutree">
								<li>
									<a href="<?php echo esc_url( $kkw_home_link ); ?>"><?php echo esc_html( $kkw_home_name ); ?></a>
								</li>
								<?php if ( ! empty( $kkw_home_node->children ) && is_array( $kkw_home_node->children ) ) : ?>
									<ul>
										<?php foreach ( $kkw_home_node->children as $kkw_item_node ) : ?>
											<?php $kkw_render_sitemap_node( $kkw_item_node ); ?>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</ul>
							<?php
						}
						?>

						<!-- MULTILANGUAGE MAPS -->
						<?php
						$kkw_selector_visible = kkw_get_option( 'language_selector_visible', 'kkw_opt_advanced_settings' );
						if ( 'true' === $kkw_selector_visible ) {
							$kkw_current_language = KKW_ThemeLangManager::get_current_language( 'slug' );
							$kkw_sitemap_id       = get_queried_object_id();
							$kkw_maps             = KKW_ThemeLangManager::get_post_translations( $kkw_sitemap_id );
							if ( is_array( $kkw_maps ) && ! empty( $kkw_maps ) ) {
								?>
								<div class="box_change_map_lang text-center mt-5">
									<ul>
										<?php
										foreach ( $kkw_maps as $kkw_map_lang => $kkw_map_post_id ) {
											if ( $kkw_map_lang === $kkw_current_language ) {
												continue;
											}

											$kkw_map_post = get_post( (int) $kkw_map_post_id );
											if ( ! ( $kkw_map_post instanceof WP_Post ) ) {
												continue;
											}

											$kkw_map_link = get_permalink( (int) $kkw_map_post_id );
											if ( ! is_string( $kkw_map_link ) || '' === $kkw_map_link ) {
												continue;
											}

											$kkw_map_label = $kkw_map_post->post_title . ' (' . strtoupper( (string) $kkw_map_lang ) . ')';
											?>
											<li>
												<a title="<?php echo esc_attr( $kkw_map_label ); ?>" href="<?php echo esc_url( $kkw_map_link ); ?>"><?php echo esc_html( $kkw_map_label ); ?></a>
											</li>
											<?php
										}
										?>
									</ul>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</section>
	</div>
</main>

<?php
get_footer();
