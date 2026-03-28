<?php
/**
 * KK Writer Theme: Social links for footer and contact pages.
 *
 * @package KK_Writer_Theme
 */

$kkw_show_socials = kkw_get_option( 'show_socials', 'kkw_opt_social_media' );

if ( 'true' === $kkw_show_socials ) {
	$kkw_facebook  = kkw_get_option( 'facebook', 'kkw_opt_social_media' );
	$kkw_youtube   = kkw_get_option( 'youtube', 'kkw_opt_social_media' );
	$kkw_instagram = kkw_get_option( 'instagram', 'kkw_opt_social_media' );
	$kkw_pinterest = kkw_get_option( 'pinterest', 'kkw_opt_social_media' );
	$kkw_twitter   = kkw_get_option( 'twitter', 'kkw_opt_social_media' );
	$kkw_ics       = kkw_get_option( 'ics', 'kkw_opt_social_media' );
	$kkw_linkedin  = kkw_get_option( 'linkedin', 'kkw_opt_social_media' );
	$kkw_titok     = kkw_get_option( 'titok', 'kkw_opt_social_media' );
	$kkw_github    = kkw_get_option( 'github', 'kkw_opt_social_media' );
	$kkw_gitlab    = kkw_get_option( 'gitlab', 'kkw_opt_social_media' );
	$kkw_iris      = kkw_get_option( 'iris', 'kkw_opt_social_media' );
	$kkw_googlesc  = kkw_get_option( 'googlescholar', 'kkw_opt_social_media' );

	$kkw_social_links = array(
		array(
			'url'  => $kkw_facebook,
			'name' => 'Facebook',
			'icon' => 'fab fa-facebook-f fa-lg',
		),
		array(
			'url'  => $kkw_youtube,
			'name' => 'YouTube',
			'icon' => 'fab fa-youtube fa-lg',
		),
		array(
			'url'  => $kkw_instagram,
			'name' => 'Instagram',
			'icon' => 'fab fa-instagram fa-lg',
		),
		array(
			'url'  => $kkw_pinterest,
			'name' => 'Pinterest',
			'icon' => 'fab fa-pinterest-p fa-lg',
		),
		array(
			'url'  => $kkw_twitter,
			'name' => 'Twitter',
			'icon' => 'fab fa-twitter fa-lg',
		),
		array(
			'url'  => $kkw_ics,
			'name' => 'X',
			'icon' => 'fab fa-x-twitter fa-lg',
		),
		array(
			'url'  => $kkw_linkedin,
			'name' => 'LinkedIn',
			'icon' => 'fab fa-linkedin-in fa-lg',
		),
		array(
			'url'  => $kkw_titok,
			'name' => 'TikTok',
			'icon' => 'fab fa-titok fa-lg',
		),
		array(
			'url'  => $kkw_github,
			'name' => 'GitHub',
			'icon' => 'fab fa-github fa-lg',
		),
		array(
			'url'  => $kkw_gitlab,
			'name' => 'GitLab',
			'icon' => 'fab fa-gitlab fa-lg',
		),
		array(
			'url'  => $kkw_iris,
			'name' => 'Iris',
			'icon' => 'fa-solid fa-book fa-lg',
		),
		array(
			'url'  => $kkw_googlesc,
			'name' => 'Google Scholar',
			'icon' => 'fab fa-google-scholar fa-lg',
		),
	);
	?>
	<?php esc_html_e( 'Follow me on', 'kk_writer_theme' ); ?>:&nbsp;&nbsp;
	<?php foreach ( $kkw_social_links as $kkw_social_link ) : ?>
		<?php if ( empty( $kkw_social_link['url'] ) ) : ?>
			<?php continue; ?>
		<?php endif; ?>
		<?php
		$kkw_social_label = sprintf(
			/* translators: %s: social platform name. */
			__( 'Follow me on %s', 'kk_writer_theme' ),
			$kkw_social_link['name']
		);
		?>
		<a
			aria-label="<?php echo esc_attr( $kkw_social_label ); ?>"
			title="<?php echo esc_attr( $kkw_social_label ); ?>"
			href="<?php echo esc_url( $kkw_social_link['url'] ); ?>"
			target="_blank"
			rel="noopener noreferrer"
			class="mr-5 text-color-secondary margin-socials"
		>
			<i class="<?php echo esc_attr( $kkw_social_link['icon'] ); ?>"></i>
		</a>
	<?php endforeach; ?>
	<?php
}
