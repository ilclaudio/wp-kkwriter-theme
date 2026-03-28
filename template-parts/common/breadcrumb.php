<?php
/**
 * KK Writer Theme: The breadcrumb section.
 *
 * @package KK_Writer_Theme
 */

global $post;

if ( is_home() ) {
	$kkw_steps = array();
} else {
	$kkw_steps = KKW_NavigationManager::build_content_path( $post );
}

$kkw_index      = 0;
$kkw_last_index = count( $kkw_steps ) - 1;
?>

<section id="breadcrumb">
	<div class="container m-0">
		<div class="row">
			<div class="col-12 m-0 pl-4 font-smaller">
				<nav class="breadcrumb-container" aria-label="<?php echo esc_attr__( 'Breadcrumb navigation', 'kk_writer_theme' ); ?>">
					<ol class="breadcrumb p-0 m-0">
						<?php foreach ( $kkw_steps as $kkw_step ) : ?>
							<li class="<?php echo esc_attr( $kkw_step->class ); ?>">
								<?php if ( $kkw_index < $kkw_last_index ) : ?>
									<a href="<?php echo esc_url( $kkw_step->url ); ?>">
								<?php endif; ?>
									<?php echo esc_html( $kkw_step->label ); ?>
								<?php if ( $kkw_index < $kkw_last_index ) : ?>
									</a>
								<?php endif; ?>
							</li>
							<?php ++$kkw_index; ?>
						<?php endforeach; ?>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>
