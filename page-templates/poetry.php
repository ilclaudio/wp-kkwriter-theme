<?php
/**
 * KK Writer Theme: The "poetry section" page.
 *
 * @package KK_Writer_Theme
 */
?>
<?php
$section_label       = 'Poetry';
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
