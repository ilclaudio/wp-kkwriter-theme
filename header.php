<!DOCTYPE html>
<html>

<head>
	<?php wp_head(); ?>
</head>
<?php
	include_once KKW_THEMA_PATH . '/classes/polylang-manager.php';
	$title     = kkw_get_option( 'site_title', 'kkw_opt_options' );
	$tagline   = kkw_get_option( 'site_tagline', 'kkw_opt_options' );
?>

<body>
	<div class="container">
		<header class="border-bottom lh-1 py-3">
			<div class="row flex-nowrap justify-content-between align-items-center">
				<!-- Logo -->
				<div class="col-4 pt-1 kkw_logoheader">
					<a href="<?php echo get_site_url(); ?>">Logo</a>
				</div>
				<!-- TITLE OF THE SITE -->
				<div class="col-4 text-center">
					<h1 class="kkw_sitetitle"><a href="<?php echo get_site_url(); ?>"><?php echo esc_html( $title, 'kk_writer_theme' ); ?></a></h1>
					<div class="kkw_tagline"><a href="<?php echo get_site_url(); ?>"><?php echo esc_html( $tagline, 'kk_writer_theme' ); ?></a></div>
				</div>
				<!-- Selectors -->
				<div class="col-4 d-flex justify-content-end align-items-center">
					<!-- Language Selector -->
					<div id="kkw_language_div" class="dropdown">
						<?php	
							$selettore_visibile = kkw_get_option( 'language_selector_visible', 'kkw_opt_advanced_settings' );
							$current_language   = KKW_PolylangManager::get_current_language( 'slug' );
							if ( 'true' === $selettore_visibile ) {
							$languages_list = KKW_PolylangManager::get_languages_list( array( 'hide_empty' => 0, 'fields' => 'slug' ) );
						?>
						<?php
							KKW_PolylangManager::the_languages();
						?>
						<?php
							}
						?>
					</div>
					<!-- Search button -->
					<?php
						$search_page_id  = KKW_PolylangManager::get_page_by_slug( SLUG_SEARCH_SITE_EN );
						$search_page_url = get_permalink( $search_page_id );
						$label           = __( 'Search', 'kk_writer_theme' );
					?>
					<a class="link-secondary"
						href="<?php echo $search_page_url; ?>"
						aria-label="<?php echo $label; ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24">
							<title><?php echo $label; ?></title>
							<circle cx="10.5" cy="10.5" r="7.5"></circle>
							<path d="M21 21l-5.2-5.2"></path>
						</svg>
					</a>
					<!-- END Search button -->

				</div>
				<!-- END Selectors -->
			</div>
		</header>

		<!-- MAIN MENU -->
		<?php
			echo get_template_part(
				'template-parts/header/main-menu',
				false,
				array(),
			);
		?>

	</div> <!-- container -->