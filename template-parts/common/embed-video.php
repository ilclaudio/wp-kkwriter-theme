<?php
/**
 * KK Writer Theme: The section to include a video.
 *
 * @package KK_Writer_Theme
 */

$kkw_src_video  = isset( $args['video'] ) ? $args['video'] : '';
$kkw_perc_width = ! empty( $args['perc_width'] ) ? (string) $args['perc_width'] : '50%';

if ( ! preg_match( '/^(\d{1,3}%|\d+(?:\.\d+)?(?:px|rem|em|vw))$/', $kkw_perc_width ) ) {
	$kkw_perc_width = '50%';
}

if ( $kkw_src_video ) {
	?>
	<div class="p-0 m-0 ratio ratio-16x9" style="width: <?php echo esc_attr( $kkw_perc_width ); ?>;">
		<iframe src="<?php echo esc_url( $kkw_src_video ); ?>"
			title="<?php echo esc_attr__( 'Embedded video', 'kk_writer_theme' ); ?>"
			allowfullscreen>
		</iframe>
	</div>
	<?php
}
