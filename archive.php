<?php
/**
 * KK Writer Theme: The static content template page.
 *
 * @package KK_Writer_Theme
 */

global $post;
get_header();
$image_metadata = KKW_ContentsManager::get_image_metadata( $post );
?>

<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>
	
	<p>ARCHIVE</p>


</main>


<?php
get_footer();
