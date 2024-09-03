<?php
/**
 * KK Writer Theme: The header of the site.
 *
 * @package KK_Writer_Theme
 */

// include_once KKW_THEMA_PATH . '/classes/theme-lang-manager.php';
$title   = kkw_get_option( 'site_title', 'kkw_opt_options' );
$tagline = kkw_get_option( 'site_tagline', 'kkw_opt_options' );
$og_data = KKW_ContentsManager::get_og_data();
?>

<!DOCTYPE html>
<html lang="<?php echo $og_data['lang_slug']; ?>">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
	<?php get_template_part( 'template-parts/header/analytics' ); ?>
	<?php get_template_part( 'template-parts/header/metatags' ); ?>
	<link rel="icon" href="<?php echo get_template_directory_uri() . '/assets/img/favicon.ico'; ?> " />

	<!-- SEO optimization -->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php echo $og_data['site_url']; ?>/xmlrpc.php" />
	<title><?php echo $og_data['shared_title']; ?></title>
	<link rel="canonical" href="<?php echo $og_data['url']; ?>" />

	<!-- OG DATA for page sharing -->
	<meta property="og:locale" content="<?php echo $og_data['lang_locale']; ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $og_data['title']; ?>" />
	<meta property="og:description" content="<?php echo $og_data['description']; ?>" />
	<meta property="og:url" content='<?php echo $og_data['url']; ?>'/>
	<meta property="og:site_name" content="<?php echo $og_data['site_title']; ?>" />
	<meta property="og:image" content="<?php echo $og_data['image']; ?>"/>
	<meta property="og:image:width" content="<?php echo $og_data['img_width']; ?>" />
	<meta property="og:image:height" content="<?php echo $og_data['img_height']; ?>" />
	<meta property="og:image:type" content="image/png" />

	<!-- TWITTER CARD  -->
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:title" content="<?php echo $og_data['title']; ?>">
	<meta name="twitter:description" content="<?php echo $og_data['description']; ?>">
	<meta name="twitter:image" content="<?php echo $og_data['image']; ?>">
	<meta name="twitter:url" content="<?php echo $og_data['url']; ?>">

<body>
	<div class="container">
		<header class="border-bottom lh-1 py-3">
			<div class="row justify-content-between align-items-center">

				<!-- LOGO OF THE SITE -->
				<div class="col-12 col-lg-4 text-center text-lg-left kkw_logoheader mb-3 mb-lg-0">
					<a href="<?php echo get_site_url(); ?>" title="<?php echo __( 'The logo of the site.', 'kk_writer_theme' ); ?>">
						<img height="100" class="m-0 p-0" src="<?php echo get_template_directory_uri() . '/assets/img/LogoHeader.jpg' ?>" />
					</a>
				</div>

				<!-- TITLE OF THE SITE -->
				<div class="col-12 col-lg-4 text-center mb-4 mb-lg-0">
					<h1 class="kkw_sitetitle"><a href="<?php echo get_site_url(); ?>"><?php echo esc_html( $title, 'kk_writer_theme' ); ?></a></h1>
					<div class="kkw_tagline"><a href="<?php echo get_site_url(); ?>"><?php echo esc_html( $tagline, 'kk_writer_theme' ); ?></a></div>
				</div>

				<!-- SITE SEARCH -->
				 <?php
					$search_page_id  = KKW_ThemeLangManager::get_page_by_slug( SLUG_SEARCH_SITE_EN );
					$search_page_url = get_permalink( $search_page_id );
					$label           = __( 'Search', 'kk_writer_theme' );
				 ?>
				<div class="col-12 col-lg-4 d-flex justify-content-lg-end justify-content-center align-items-center mb-3 mb-lg-0">
					<FORM id="search_box" action="<?php echo $search_page_url; ?>" method="GET" class="d-flex" role="<?php $label ?>">
						<input name="search_string" class="form-control me-2" type="search"
							placeholder="<?php echo $label ?>"
							aria-label="<?php $label ?>">

						<?php wp_nonce_field( 'kkw_search_nonce', 'site_search_nonce_field' ); ?>
						<input type="hidden" name="redirection" id="redirection" value="yes" />

						<button class="btn btn-outline-secondary" type="submit">
							<?php echo __( 'Search', 'kk_writer_theme' ); ?>
						</button>
					</FORM>
				</div>

			</div>
		</header>

		<!-- SITE MAIN MENU -->
		<?php
			echo get_template_part(
				'template-parts/header/main-menu',
				false,
				array(),
			);
		?>

	</div> <!-- container -->