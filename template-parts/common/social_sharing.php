<?php
$og_data          = KKW_ContentsManager::get_og_data();
$page_url         = $og_data['url'];
$enc_page_url     = urlencode( $page_url );
$shared_title     = __( 'I\'m pleased to share the post', 'kk_writer_theme' ) . ' "' . $og_data['shared_title'] . '"';
$enc_shared_title = urlencode( $shared_title );
// Prepare complete url to share the page on many platforms.
$fb_share_url = 'https://facebook.com/sharer/sharer.php?u=' . $enc_page_url;
$tw_share_url = 'https://twitter.com/share?url=' . $enc_page_url .'&text=' . $enc_shared_title;
$lk_share_url = 'https://www.linkedin.com/sharing/share-offsite/?mini=true&url=' . $enc_page_url;
$wa_share_url = 'https://api.whatsapp.com/send?text=' . $enc_shared_title . ' ' . $enc_page_url;
$gm_share_url = 'https://mail.google.com/mail/u/0/?ui=2&fs=1&tf=cm&su=' . $enc_shared_title . ' &body=' . $og_data['description'] . ' - ' . $og_data['url'] ;
$mm_share_url = 'mailto:?subject=' . $enc_shared_title . '&body=' . $og_data['description'] . ' - ' . $og_data['url'];

// $lk_share_url = 'https://www.linkedin.com/feed/?linkOrigin=LI_BADGE&shareActive=true&shareUrl=' . $enc_page_url;
// $xx_share_url = 'https://x.com/intent/post?text=' . $enc_shared_title . ' ' . $enc_page_url;
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
						href="<?php echo esc_url( $fb_share_url ); ?>"
						target="_blank" rel="noopener noreferrer"
						aria-label="<?php echo __( 'Share on Facebook', 'kk_writer_theme' ); ?>">
						<i class="fab fa-facebook-f fa-lg"></i>
						<span>
							<?php echo __( 'Facebook', 'kk_writer_theme' ); ?>
						</span>
					</a>
				</li>
				<li>
					<a class="list-item" 
						href="<?php echo esc_url( $tw_share_url ); ?>"
						target="_blank" rel="noopener noreferrer"
						aria-label="<?php echo __( 'Share on Twitter', 'kk_writer_theme' ); ?>">
						<i class="fab fa-twitter fa-lg"></i>
						<span><?php echo __( 'Twitter', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
				<li>
					<a class="list-item" 
						href="<?php echo esc_url( $lk_share_url ); ?>"
						target="_blank" rel="noopener noreferrer"
						aria-label="<?php echo __( 'Share on Linkedin', 'kk_writer_theme' ); ?>">
						<i class="fab fa-linkedin-in fa-lg"></i>
						<span><?php echo __( 'Linkedin', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
				<li>
					<a class="list-item"
						href="<?php echo esc_url( $wa_share_url ); ?>"
						target="_blank" rel="noopener noreferrer"
						aria-label="<?php echo __( 'Share on WhatsApp', 'kk_writer_theme' ); ?>">
						<i class="fab fa-whatsapp fa-lg"></i>
						<span><?php echo __( 'WhatsApp', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
				<li>
					<a class="list-item"
						href="<?php echo esc_url( $gm_share_url ); ?>"
						target="_blank" rel="noopener noreferrer"
						aria-label="<?php echo __( 'Share on Gmail', 'kk_writer_theme' ); ?>">
						<i class="fab fa-google fa-lg"></i>
						<span><?php echo __( 'Gmail', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
				<li>
					<a class="list-item"
						href="<?php echo esc_url( $mm_share_url ); ?>"
						target="_blank" rel="noopener noreferrer"
						aria-label="<?php echo __( 'Share by e-mail', 'kk_writer_theme' ); ?>">
						<i class="far fa-envelope fa-lg"></i>
						<span><?php echo __( 'E-mail', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
			</ul>
		</div>
	</div>

</section>