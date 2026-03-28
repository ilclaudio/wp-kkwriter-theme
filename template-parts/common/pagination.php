<?php
/**
 * KK Writer Theme: The pagination component.
 *
 * @package KK_Writer_Theme
 */

$kkw_query = isset( $args['query'] ) ? $args['query'] : null;

?>
<nav class="pagination-wrapper justify-content-center" aria-label="<?php echo esc_attr__( 'Centered navigation', 'kk_writer_theme' ); ?>">
	<div class="row pt-5" id="pagination_links">
		<?php
		if ( $kkw_query ) {
			$kkw_sprite_url = trailingslashit( get_template_directory_uri() ) . 'assets/svg/sprites.svg';
			$kkw_prev_label = '<svg class="icon icon-secondary" role="img" aria-label="Chevron Left"><use href="' . esc_url( $kkw_sprite_url . '#it-chevron-left' ) . '"></use></svg>';
			$kkw_next_label = '<svg class="icon icon-secondary" role="img" aria-label="Chevron Right"><use href="' . esc_url( $kkw_sprite_url . '#it-chevron-right' ) . '"></use></svg>';

			$kkw_pagination = paginate_links(
				array(
					'total'     => $kkw_query->max_num_pages,
					'prev_text' => $kkw_prev_label,
					'next_text' => $kkw_next_label,
					'type'      => 'list',
				)
			);

			if ( $kkw_pagination ) {
				echo wp_kses_post( $kkw_pagination );
			}
		}
		?>
	</div>
</nav>
