<?php
/**
 * KK Writer Theme: The HOME PAGE.
 *
 * @package KK_Writer_Theme
 */
?>
<!-- The HEADER with the site title and the menu -->
<?php get_header(); ?>
<?php
	$carousel_first       = kkw_get_option( 'home_carousel_before_featured_enabled', 'kkw_opt_hp_layout' );
	$carouse_visible      = kkw_get_option( 'home_carousel_visible', 'kkw_opt_hp_layout' );
	$featured_visible     = kkw_get_option( 'home_featured_content_visible', 'kkw_opt_hp_layout' );
	$blog_section_visible = kkw_get_option( 'home_blog_section_visible', 'kkw_opt_hp_layout' );
	$blog_after           = kkw_get_option( 'blog_section_after_featured_enabled', 'kkw_opt_hp_layout' );
?>
<main class="container">

	<!-- The Carousel section (if before featured) -->
	<?php
		if ( $carousel_first === 'true' && $carouse_visible === 'true' ) {
			get_template_part( 'template-parts/home/carousel' );
		}
	?>

	<!-- The BLOG section -->
	<?php
		if ( ( $blog_section_visible === 'true' ) && ( $blog_after === 'false' ) ) {
			get_template_part( 'template-parts/home/blog-section' );
		}
	?>

	<!-- The Featured Contents section (Contenuti in evidenza) -->
	<?php
		if ( $featured_visible === 'true' ) {
			get_template_part( 'template-parts/home/featured-contents' );
		}
	?>

	<!-- The Carousel section (if after featured) -->
	<?php
		if ( $carousel_first === 'false' && $carouse_visible === 'true' ) {
			get_template_part( 'template-parts/home/carousel' );
		}
	?>

	<!-- The BLOG section -->
	<?php
		if ( ( $blog_section_visible === 'true' ) && ( $blog_after === 'true' ) ) {
			get_template_part( 'template-parts/home/blog-section' );
		}
	?>

</main>
<!-- The FOOTER of the site -->
<?php get_footer(); ?>
