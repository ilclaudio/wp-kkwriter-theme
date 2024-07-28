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
		$steps = array();
	}
	$index = 0;
?>

<section id="breadcrumb" style="border: 1px solid green;">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav class="breadcrumb-container" aria-label="Percorso di navigazione">
				<ol class="breadcrumb pb-0">
					<?php
						foreach( $steps as $step ){
					?>
					<li class="<?php echo esc_attr( $step['class'] ); ?>">
						<a href="<?php echo esc_url( $step['url'] ); ?>"><?php echo esc_attr( $step['label'] ); ?></a>
						<?php
							if ( $index < count( $steps) -1 ) {
						?>
						<span class="separator">&gt;</span>
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

<!-- <nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item"><a href="#">Catalogo Libri</a></li>
		<li class="breadcrumb-item active" aria-current="page">Filosofia antica</li>
	</ol>
</nav> -->