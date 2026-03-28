<?php
/**
 * KK Writer Theme: The Book EXCERPTS (LYRICS) template.
 *
 * @package KK_Writer_Theme
 */

$kkw_post_wrapper = isset( $args['post_wrapper'] ) ? $args['post_wrapper'] : null;

if ( $kkw_post_wrapper ) {
	$kkw_excerpts = KKW_ContentsManager::get_book_excerpts( $kkw_post_wrapper->id );

	if ( ! empty( $kkw_excerpts ) ) {
		?>
		<div class="container my-5 mx-3">
			<!-- Excerpts list -->
			<section class="row">
				<ol>
					<?php foreach ( $kkw_excerpts as $kkw_excerpt ) : ?>
						<?php
						$kkw_link_active = ! empty( $kkw_excerpt->description );
						$kkw_link_anchor = '#item-' . $kkw_excerpt->id;
						?>
						<li class="pt-1 font-review">
							<span>
								<?php if ( $kkw_link_active ) : ?>
									<a href="<?php echo esc_attr( $kkw_link_anchor ); ?>">
								<?php endif; ?>
								<?php echo esc_html( $kkw_excerpt->title ); ?>
								<?php if ( $kkw_link_active ) : ?>
									</a>
								<?php endif; ?>
							</span>
						</li>
					<?php endforeach; ?>
				</ol>
			</section>

			<!-- Excerpts details -->
			<section class="row">
				<?php foreach ( $kkw_excerpts as $kkw_excerpt ) : ?>
					<?php
					$kkw_link_active = ! empty( $kkw_excerpt->description );
					$kkw_link_anchor = 'item-' . $kkw_excerpt->id;
					?>
					<?php if ( $kkw_link_active ) : ?>
						<div class="card m-0 p-0 mt-5" id="<?php echo esc_attr( $kkw_link_anchor ); ?>">
							<div class="card-body">
								<?php echo wp_kses_post( wpautop( $kkw_excerpt->description ) ); ?>
							</div>
							<div class="card-footer font-smaller">
								<span>
									<?php echo esc_html( $kkw_excerpt->title ); ?> -
									<?php echo esc_html( $kkw_post_wrapper->title ); ?> -
									<?php echo esc_html( $kkw_post_wrapper->author ); ?>
								</span>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</section>
		</div>
		<?php
	}
}
