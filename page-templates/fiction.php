<?php
/**
 * KK Writer Theme: The "fiction section" page.
 *
 * @package KK_Writer_Theme
 */
?>
<?php
get_header();

$section_label       = 'Fiction';
$section             = __( $section_label , 'kk_writer_theme' );
$section_description = '';
?>

<?php
	get_template_part(
		'template-parts/common/section',
		null,
		array(
			'section_label'       => $section_label,
			'section'             => $section,
			'section_description' => $section_description,
		)
	);
?>

<?php get_footer(); ?>
