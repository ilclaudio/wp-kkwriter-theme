<?php
/**
 * KK Writer Theme: The Book REVIEW template.
 *
 * @package KK_Writer_Theme
 */

$kkw_post_wrapper = isset( $args['post_wrapper'] ) ? $args['post_wrapper'] : null;

if ( $kkw_post_wrapper ) {
	$kkw_reviews = KKW_ContentsManager::get_book_reviews( $kkw_post_wrapper->id );

	if ( ! empty( $kkw_reviews ) ) {
		?>
		<div class="container my-5 mx-3">
			<!-- Review list -->
			<section class="row">
				<ol>
					<?php foreach ( $kkw_reviews as $kkw_review ) : ?>
						<?php
						$kkw_link_active = ! empty( $kkw_review->description );
						$kkw_link_anchor = '#item-' . $kkw_review->id;
						?>
						<li class="pt-1 font-review">
							<span>
								<?php if ( $kkw_link_active ) : ?>
									<a href="<?php echo esc_attr( $kkw_link_anchor ); ?>">
								<?php endif; ?>
								<?php echo esc_html( $kkw_review->author ); ?>,
								<?php echo esc_html( $kkw_review->label ); ?>
								<?php if ( $kkw_link_active ) : ?>
									</a>
								<?php endif; ?>
							</span>
						</li>
					<?php endforeach; ?>
				</ol>
			</section>

			<!-- Review details -->
			<section class="row">
				<?php foreach ( $kkw_reviews as $kkw_review ) : ?>
					<?php
					$kkw_link_active = ! empty( $kkw_review->description );
					$kkw_link_anchor = 'item-' . $kkw_review->id;
					?>
					<?php if ( $kkw_link_active ) : ?>
						<div class="card m-0 p-0 mt-5" id="<?php echo esc_attr( $kkw_link_anchor ); ?>">
							<div class="card-body">
								<?php echo wp_kses_post( wpautop( $kkw_review->description ) ); ?>
							</div>
							<div class="card-footer font-smaller">
								<span>
									<?php echo esc_html( $kkw_review->author ); ?>,
									<?php echo esc_html( $kkw_review->label ); ?>
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
