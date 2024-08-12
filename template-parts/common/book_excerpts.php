<?php
/**
 * KK Writer Theme: The Book EXCERPTS (LYRICS) template.
 *
 * @package KK_Writer_Theme
 */
$post_wrapper = $args['post_wrapper'];

if ( $post_wrapper ) {
	$excerpts = KKW_ContentsManager::get_book_excerpts( $post_wrapper->id );
	if ( count ( $excerpts ) ) {
		$counter = 1;
?>

<div class="container my-5 mx-3">

	<!-- Excerpts list -->
	<section class="row">
		<ol>
			<?php
				foreach ( $excerpts as $exc ) {
					$link_active = $exc->description ? true : false;
					$link_anchor = '#item-' . $exc->id;
			?>
					<li class="pt-1 font-review">
						<span>
							<?php if ( $link_active ) { ?> <a href="<?php echo $link_anchor ?>"> <?php } ?>
								<?php echo $exc->title; ?>
								<?php if ( $link_active ) { ?> </a> <?php } ?>
						</span>
					</li>
			<?php
				$counter++;
				}
			?>
		</ol>
	</section>

	<!-- Excerpts details -->
	<section class="row">
			<?php
				foreach ( $excerpts as $exc ) {
					$link_active = $exc->description ? true : false;
					$link_anchor = 'item-' . $exc->id;
			?>
			<?php
				if ( $link_active ) {
			?>
				<div class="card m-0 p-0 mt-5" id="<?php echo $link_anchor; ?>">
					<div class="card-body">
						<?php
							echo apply_filters( 'the_content', $exc->description );
						?>
					</div>
					<div class="card-footer font-smaller">
						<span>
							<?php echo $exc->title; ?>
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
