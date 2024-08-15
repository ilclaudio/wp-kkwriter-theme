<?php

$site_url = get_site_url();
?>
<section class="dropdown d-inline kkw_share_section">

	<button class="btn btn-dropdown dropdown-toggle" type="button" id="shareActions" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<svg class="icon" aria-hidden="true" focusable="false">
			<use xlink:href="<?php echo get_template_directory_uri() . '/assets/svg/sprites.svg#it-share' ?>"></use>
		</svg>
		<small>
			<?php echo __( 'Share on', 'kk_writer_theme' ); ?>
		</small>
	</button>

	<div class="dropdown-menu shadow-lg" aria-labelledby="shareActions">
		<div class="link-list-wrapper">
			<ul class="link-list">
				<li>
					<a class="list-item"
						href="https://facebook.com/sharer/sharer.php?u=<?php echo urlencode( $site_url ) ; ?>"
						target="_blank" rel="noopener noreferrer" aria-label="<?php echo __( 'Share on Facebook', 'kk_writer_theme' ); ?>">
						<i class="fab fa-facebook-f fa-lg"></i>
						<span>
							<?php echo __( 'Facebook', 'kk_writer_theme' ); ?>
						</span>
					</a>
				</li>
				<li>
					<a class="list-item" href="https://twitter.com/share?url=<?php echo esc_url( $site_url ) ; ?>"
					target="_blank" rel="noopener noreferrer" aria-label="<?php echo __( 'Share on Twitter', 'kk_writer_theme' ); ?>">
						<i class="fab fa-twitter fa-lg"></i>
						<span><?php echo __( 'Twitter', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
				<li>
					<a class="list-item" href="http://www.linkedin.com/shareArticle?mini=true&amp;url#="
					target="_blank" rel="noopener noreferrer" aria-label="<?php echo __( 'Share on Linkedin', 'kk_writer_theme' ); ?>">
						<i class="fab fa-linkedin-in fa-lg"></i>
						<span><?php echo __( 'Linkedin', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
				<li>
					<a class="list-item" href="whatsapp://send?text==url"
						target="_blank" rel="noopener noreferrer" aria-label="<?php echo __( 'Share on WhatsApp', 'kk_writer_theme' ); ?>">
						<i class="fab fa-whatsapp fa-lg"></i>
						<span><?php echo __( 'WhatsApp', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
			</ul>
		</div>
	</div>

</section>