<?php
/**
 * KK Writer Theme: The SEARCH page.
 *
 * @package KK_Writer_Theme
 */
?>
<?php

get_header();
define( 'SITESEARCH_CELLS_PER_PAGE', 10 );

$post_data    = $_POST;
// $get_data     = $_GET;
$searchstring = isset( $post_data['searchstring'] ) ? sanitize_text_field( $post_data['searchstring'] ) : '';
$redirection  = (sanitize_text_field( isset( $post_data['redirection'] ) && sanitize_text_field( $post_data['redirection'] ) === 'yes') ? true : false );

$num_results = 0;




?>


<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<p><?php echo $searchstring; ?></p>

</main>


<?php get_footer(); ?>