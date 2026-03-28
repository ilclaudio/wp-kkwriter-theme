<?php
/**
 * KK Writer Theme: The tool to order results.
 *
 * @package KK_Writer_Theme
 */

$kkw_num_results = isset( $args['num_results'] ) ? (int) $args['num_results'] : 0;

if ( $kkw_num_results >= MIN_RESULTS_TO_SHOW_ORDER ) {
	?>
	<section class="mt-0 pt-0 pe-5 mb-3 d-flex justify-content-end">
		<div class="row dropdown px-3">
			<button class="btn dropdown-toggle border-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
				<?php esc_html_e( 'Order results by...', 'kk_writer_theme' ); ?>
			</button>
			<ul id="kkw_order_selector" class="dropdown-menu font-smaller">
				<li class="px-0">
					<a class="dropdown-item" href="#" data-sort-order="ASC" data-sort-field="title">
						<?php esc_html_e( 'Title ascending', 'kk_writer_theme' ); ?>
					</a>
				</li>
				<li class="px-0">
					<a class="dropdown-item" href="#" data-sort-order="DESC" data-sort-field="title">
						<?php esc_html_e( 'Title descending', 'kk_writer_theme' ); ?>
					</a>
				</li>
				<li class="px-0">
					<a class="dropdown-item" href="#" data-sort-order="ASC" data-sort-field="kkw_year">
						<?php esc_html_e( 'Publication year ascending', 'kk_writer_theme' ); ?>
					</a>
				</li>
				<li class="px-0">
					<a class="dropdown-item" href="#" data-sort-order="DESC" data-sort-field="kkw_year">
						<?php esc_html_e( 'Publication year descending', 'kk_writer_theme' ); ?>
					</a>
				</li>
				<li class="px-0">
					<a class="dropdown-item" href="#" data-sort-order="ASC" data-sort-field="date">
						<?php esc_html_e( 'Creation date ascending', 'kk_writer_theme' ); ?>
					</a>
				</li>
				<li class="px-0">
					<a class="dropdown-item" href="#" data-sort-order="DESC" data-sort-field="date">
						<?php esc_html_e( 'Creation date descending', 'kk_writer_theme' ); ?>
					</a>
				</li>
			</ul>
		</div>
	</section>
	<?php
}
