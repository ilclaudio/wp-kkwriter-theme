<?php
/**
 * KK Writer Theme: The header of the site.
 *
 * @package KK_Writer_Theme
 */

$kkw_site_title   = kkw_get_option( 'site_title', 'kkw_opt_options' );
$kkw_site_tagline = kkw_get_option( 'site_tagline', 'kkw_opt_options' );
$kkw_header_logo  = kkw_get_option( 'header_logo_visible', 'kkw_opt_options' );
$kkw_footer_logo  = kkw_get_option( 'footer_logo_visible', 'kkw_opt_options' );
$kkw_current_lang = KKW_ThemeLangManager::get_current_language( 'slug' );
?>

<!DOCTYPE html>
<html lang="<?php echo esc_attr( $kkw_current_lang ); ?>">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php wp_head(); ?>
		<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/favicon.ico' ); ?>" />

	<!-- ANALYTICS CODE -->
	<?php get_template_part( 'template-parts/header/analytics' ); ?>

	<!-- META TAGS -->
	<?php
		get_template_part(
			'template-parts/header/meta_tags',
			false,
			array(
				'site_title'   => $kkw_site_title,
				'site_tagline' => $kkw_site_tagline,
				'current_lang' => $kkw_current_lang,
			),
		);
		?>

	<!-- SEO - OG Internal Management -->
	<?php
		get_template_part(
			'template-parts/header/seo_tags',
			false,
			array(
				'site_title'   => $kkw_site_title,
				'site_tagline' => $kkw_site_tagline,
				'current_lang' => $kkw_current_lang,
			),
		);
		?>
</head>

<body>
	<div class="container">
		<header class="border-bottom lh-1 py-3">
			<div class="row justify-content-between align-items-center">

					<!-- LOGO OF THE SITE -->
					<div class="col-12 col-lg-4 text-center text-lg-left kkw_logoheader mb-3 mb-lg-0">
						<?php
						if ( 'true' === $kkw_header_logo ) {
							?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr__( 'The logo of the site.', 'kk_writer_theme' ); ?>">
							<img height="100" class="m-0 p-0"
								src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/LogoHeader.jpg' ); ?>"
								alt="<?php echo esc_attr__( 'The logo of the site.', 'kk_writer_theme' ); ?>" />
						</a>
							<?php
						}
						?>
				</div>

					<!-- TITLE OF THE SITE -->
					<div class="col-12 col-lg-4 text-center mb-4 mb-lg-0">
						<h1 class="kkw_sitetitle"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $kkw_site_title ); ?></a></h1>
						<?php
						if ( $kkw_site_tagline ) {
							?>
							<div class="kkw_tagline">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $kkw_site_tagline ); ?></a>
							</div>
							<?php
						}
						?>
				</div>

					<!-- SITE SEARCH -->
					<?php
						$kkw_search_page_id  = KKW_ThemeLangManager::get_page_by_slug( SLUG_SEARCH_SITE_EN );
						$kkw_search_page_url = get_permalink( $kkw_search_page_id );
						$kkw_label           = __( 'Search', 'kk_writer_theme' );
					?>
					<div class="col-12 col-lg-4 d-flex justify-content-lg-end justify-content-center align-items-center mb-3 mb-lg-0">
						<form id="search_box" action="<?php echo esc_url( $kkw_search_page_url ); ?>" method="GET" class="d-flex" role="search">
							<label id="search_string_label" for="search_string" class="sr-only">
								<?php echo esc_html__( 'Search', 'kk_writer_theme' ); ?>
							</label>
							<input id="search_string" name="search_string" class="form-control me-2" type="search"
								placeholder="<?php echo esc_attr( $kkw_label ); ?>"
								aria-label="<?php echo esc_attr( $kkw_label ); ?>">

							<?php wp_nonce_field( 'kkw_search_nonce', 'site_search_nonce_field', false ); ?>
							<input type="hidden" name="redirection" id="redirection" value="yes" />

							<button class="btn btn-outline-secondary" type="submit">
								<?php echo esc_html__( 'Search', 'kk_writer_theme' ); ?>
							</button>
						</form>
					</div>

			</div>
		</header>

		<!-- SITE MAIN MENU -->
		<?php
			get_template_part(
				'template-parts/header/main-menu',
				false,
				array(),
			);
			?>

	</div> <!-- container -->
