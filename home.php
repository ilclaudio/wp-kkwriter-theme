<?php
/**
 * KK Writer Theme: The HOME PAGE.
 *
 * @package KK_Writer_Theme
 */
?>

 <!-- The HEADER with the site title and the menu -->
<?php get_header(); ?>

<main class="container" style="border: 1px solid blue;">

	<!-- The carousel section -->
	<?php get_template_part( 'template-parts/home/carousel' ); ?>

	<!-- The Featured Contents section (Contenuti in evidenza) -->
	<?php get_template_part( 'template-parts/home/featured-contents' ); ?>

</main>


<!-- The FOOTER of the site -->
<?php get_footer(); ?>
