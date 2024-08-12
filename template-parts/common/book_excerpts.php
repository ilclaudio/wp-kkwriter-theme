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
				foreach ( $excerpts as $rvw ) {
					$link_active = $rvw->description ? true : false;
					$link_anchor = '#item-' . $rvw->id;
			?>
					<li class="pt-1 font-review">
						<span>
							<?php if ( $link_active ) { ?> <a href="<?php echo $link_anchor ?>"> <?php } ?>
								<?php echo $rvw->title; ?>
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

</div>

<?php
		}
	}
?>
