<?php
/**
 * KK Writer Theme: The breadcrumb section.
 *
 * @package KK_Writer_Theme
 */

global $post;
if ( is_home() ) {
	$steps = array();
} else {
	$steps = KKW_NavigationManager::build_content_path( $post );
}
$index = 0;
?>

<section id="breadcrumb">
	<div class="container m-0">
		<div class="row">
			<div class="col-12 m-0 pl-4 font-smaller">
				<nav class="breadcrumb-container" aria-label="Percorso di navigazione">
				<ol class="breadcrumb p-0 m-0">
					<?php
						foreach( $steps as $step ){
					?>
					<li class="<?php echo esc_attr( $step->class ); ?>">
						<?php
							if ( $index < count( $steps) -1 ) {
						?>
						<a href="<?php echo esc_url( $step->url ); ?>">
						<?php
							}
						?>
							<?php echo esc_attr( $step->label ); ?>
						<?php
							if ( $index < count( $steps) -1 ) {
						?>
						</a>
						<?php
							}
						?>
					</li>
					<?php
						$index++;
						}
					?>
				</ol>
			</nav>
		</div>
		</div>
	</div>
</section>
