<?php
/**
 * KK Writer Theme: The header of the site.
 *
 * @package KK_Writer_Theme
 */
?>


<!DOCTYPE html>
<html>

<head>
	<?php wp_head(); ?>
	<?php get_template_part( 'template-parts/header/analytics' ); ?>
	<?php get_template_part( 'template-parts/header/metatags' ); ?>
	<link rel="icon" href="<?php echo get_template_directory_uri() . '/assets/img/favicon.ico'; ?> " />
</head>
<?php
	include_once KKW_THEMA_PATH . '/classes/polylang-manager.php';
	$title     = kkw_get_option( 'site_title', 'kkw_opt_options' );
	$tagline   = kkw_get_option( 'site_tagline', 'kkw_opt_options' );
?>

<body>
	<div class="container">
		<header class="border-bottom lh-1 py-3">
			<div class="row justify-content-between align-items-center">

				<!-- LOGO OF THE SITE -->
				<div class="col-12 col-lg-4 text-center text-lg-left kkw_logoheader mb-3 mb-lg-0" style="border: 1px solid red">
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
				<div class="col-12 col-lg-4 d-flex justify-content-lg-end justify-content-center align-items-center mb-3 mb-lg-0">
					<form class="d-flex" role="search">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-success" type="submit"><?php echo __( 'Search', 'kk_writer_theme' ); ?></button>
					</form>
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