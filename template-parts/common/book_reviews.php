<?php
/**
 * KK Writer Theme: The Book REVIEW template.
 *
 * @package KK_Writer_Theme
 */
$post_wrapper = $args['post_wrapper'];

if ( $post_wrapper ) {
	$reviews = KKW_ContentsManager::get_book_reviews( $post_wrapper->id );
	if ( count ( $reviews ) ) {
		$counter = 1;
?>

	<div class="container my-5 mx-3">

		<!-- Review list -->
		<section class="row">
			<ol>
				<?php
					foreach ( $reviews as $rvw ) {
						$link_active = $rvw->description ? true : false;
						$link_anchor = '#item-' . $rvw->id;
				?>
						<li class="pt-1 font-review">
							<span>
								<?php if ( $link_active ) { ?> <a href="<?php echo $link_anchor ?>"> <?php } ?>
									<?php echo $rvw->author; ?>, <?php echo $rvw->label; ?>
									<?php if ( $link_active ) { ?> </a> <?php } ?>
							</span>
						</li>
				<?php
					$counter++;
					}
				?>
			</ol>
		</section>

		<!-- Review details -->
		<section class="row">
			<?php
				foreach ( $reviews as $rvw ) {
					$link_active = $rvw->description ? true : false;
					$link_anchor = 'item-' . $rvw->id;
			?>
			<?php
				if ( $link_active ) {
			?>
				<div class="card m-0 p-0 mt-5" id="<?php echo $link_anchor; ?>">
					<div class="card-body">
						<?php echo wp_kses_post( $rvw->description ); ?>
					</div>
					<div class="card-footer font-smaller">
						<span>
							<?php echo $rvw->author; ?>, <?php echo $rvw->label; ?>
						</span>
					</div>
				</div>
			<?php
				}
			?>
			<?php
				$counter++;
				}
			?>
		</section>

	</div>

<?php
		}
	}
?>