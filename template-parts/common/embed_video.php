<?php
/**
 * KK Writer Theme: The tool to order results.
 *
 * @package KK_Writer_Theme
 */
?>

<?php
	$src_video  = $args['video'];
	$perc_width = $args['perc_width'] ? $args['perc_width'] : '50%';
	if ( $src_video ) {
?>
	<div class="p-0 m-0 ratio ratio-16x9"  style="width: <?php echo $perc_width; ?>">
		<iframe src="<?php echo esc_url( $src_video ); ?>"
			title="YouTube video"
			allowfullscreen>
		</iframe>
	</div>
<?php
	}
?>