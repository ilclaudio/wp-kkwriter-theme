<?php
/**
 * KK Writer Theme: Sharing actions.
 *
 * @package KK_Writer_Theme
 */

$kkw_og_data          = KKW_ContentsManager::get_og_data();
$kkw_page_url         = isset( $kkw_og_data['url'] ) ? (string) $kkw_og_data['url'] : '';
$kkw_shared_title_raw = isset( $kkw_og_data['shared_title'] ) ? (string) $kkw_og_data['shared_title'] : '';
$kkw_description_raw  = isset( $kkw_og_data['description'] ) ? (string) $kkw_og_data['description'] : '';

$kkw_shared_title     = __( 'I\'m pleased to share the post', 'kk_writer_theme' ) . ' "' . $kkw_shared_title_raw . '"';
$kkw_enc_page_url     = rawurlencode( $kkw_page_url );
$kkw_enc_shared_title = rawurlencode( $kkw_shared_title );
$kkw_enc_description  = rawurlencode( $kkw_description_raw );

$kkw_fb_share_url = 'https://facebook.com/sharer/sharer.php?u=' . $kkw_enc_page_url;
$kkw_tw_share_url = 'https://twitter.com/share?url=' . $kkw_enc_page_url . '&text=' . $kkw_enc_shared_title;
$kkw_lk_share_url = 'https://www.linkedin.com/sharing/share-offsite/?mini=true&url=' . $kkw_enc_page_url;
$kkw_wa_share_url = 'https://api.whatsapp.com/send?text=' . $kkw_enc_shared_title . '%20' . $kkw_enc_page_url;
$kkw_gm_share_url = 'https://mail.google.com/mail/u/0/?ui=2&fs=1&tf=cm&su=' . $kkw_enc_shared_title . '&body=' . $kkw_enc_description . '%20-%20' . $kkw_enc_page_url;
$kkw_mm_share_url = 'mailto:?subject=' . $kkw_enc_shared_title . '&body=' . $kkw_enc_description . '%20-%20' . $kkw_enc_page_url;

$kkw_share_icon_url = trailingslashit( get_template_directory_uri() ) . 'assets/svg/sprites.svg#it-share';
?>
<section class="dropdown d-inline kkw_share_section">
	<button class="btn btn-dropdown dropdown-toggle" type="button" id="shareActions" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<svg class="icon" aria-hidden="true" focusable="false">
			<use xlink:href="<?php echo esc_url( $kkw_share_icon_url ); ?>"></use>
		</svg>
		<small><?php esc_html_e( 'Share on', 'kk_writer_theme' ); ?></small>
	</button>

	<div class="dropdown-menu shadow-lg" aria-labelledby="shareActions">
		<div class="link-list-wrapper">
			<ul class="link-list">
				<li>
					<a class="list-item" href="<?php echo esc_url( $kkw_fb_share_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr__( 'Share on Facebook', 'kk_writer_theme' ); ?>">
						<i class="fab fa-facebook-f fa-lg"></i>
						<span><?php esc_html_e( 'Facebook', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
				<li>
					<a class="list-item" href="<?php echo esc_url( $kkw_tw_share_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr__( 'Share on Twitter', 'kk_writer_theme' ); ?>">
						<i class="fab fa-twitter fa-lg"></i>
						<span><?php esc_html_e( 'Twitter', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
				<li>
					<a class="list-item" href="<?php echo esc_url( $kkw_lk_share_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr__( 'Share on Linkedin', 'kk_writer_theme' ); ?>">
						<i class="fab fa-linkedin-in fa-lg"></i>
						<span><?php esc_html_e( 'Linkedin', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
				<li>
					<a class="list-item" href="<?php echo esc_url( $kkw_wa_share_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr__( 'Share on WhatsApp', 'kk_writer_theme' ); ?>">
						<i class="fab fa-whatsapp fa-lg"></i>
						<span><?php esc_html_e( 'WhatsApp', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
				<li>
					<a class="list-item" href="<?php echo esc_url( $kkw_gm_share_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr__( 'Share on Gmail', 'kk_writer_theme' ); ?>">
						<i class="fab fa-google fa-lg"></i>
						<span><?php esc_html_e( 'Gmail', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
				<li>
					<a class="list-item" href="<?php echo esc_url( $kkw_mm_share_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr__( 'Share by e-mail', 'kk_writer_theme' ); ?>">
						<i class="far fa-envelope fa-lg"></i>
						<span><?php esc_html_e( 'E-mail', 'kk_writer_theme' ); ?></span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</section>
