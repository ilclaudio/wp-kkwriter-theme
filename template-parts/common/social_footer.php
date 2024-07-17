<?php
	$show_socials = kkw_get_option( 'show_socials', 'kkw_opt_social_media' );
	if( $show_socials === 'true' ) {
		$facebook  = kkw_get_option( 'facebook', 'kkw_opt_social_media' );
		$youtube   = kkw_get_option( 'youtube', 'kkw_opt_social_media' );
		$instagram = kkw_get_option( 'instagram', 'kkw_opt_social_media' );
		$pinterest = kkw_get_option( 'pinterest', 'kkw_opt_social_media' );
		$twitter   = kkw_get_option( 'twitter', 'kkw_opt_social_media' );
		$ics       = kkw_get_option( 'ics', 'kkw_opt_social_media' );
		$linkedin  = kkw_get_option( 'linkedin', 'kkw_opt_social_media' );
		$titok     = kkw_get_option( 'titok', 'kkw_opt_social_media' );
		$github    = kkw_get_option( 'github', 'kkw_opt_social_media' );
		$gitlab    = kkw_get_option( 'gitlab', 'kkw_opt_social_media' );
		$iris      = kkw_get_option( 'iris', 'kkw_opt_social_media' );
		$googlesc  = kkw_get_option( 'googlescholar', 'kkw_opt_social_media' );
?>
		<?php echo __( 'Follow me on', 'kk_writer_theme' ); ?>:&nbsp;&nbsp;

		<?php
			if ( $facebook ) {
		?>
				<a aria-label="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Facebook'; ?>"
					title="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Facebook'; ?>"
					href="<?php echo esc_url( $facebook ); ?>" target="_blank"
					class="mr-5 text-color-secondary margin-socials"><i class="fab fa-facebook-f fa-lg"></i></a>
		<?php
			}
			if ( $youtube ) {
		?>
				<a aria-label="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Youtube'; ?>"
					title="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Youtube'; ?>"
					href="<?php echo esc_url( $youtube ); ?>" target="_blank" 
					class="mr-5 text-color-secondary margin-socials"><i class="fab fa-youtube fa-lg"></i></a>
		<?php
			}
			if ( $instagram ) {
		?>
				<a aria-label="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Instagram'; ?>"
					title="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Instagram'; ?>"
					href="<?php echo esc_url( $instagram ); ?>" target="_blank"
					class="mr-5 text-color-secondary margin-socials"><i class="fab fa-instagram fa-lg"></i></a>
		<?php
			}
			if ( $pinterest ) {
		?>
				<a aria-label="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Pinterest'; ?>"
					title="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Pinterest'; ?>"
					href="<?php echo esc_url( $pinterest ); ?>" target="_blank"
					class="mr-5 text-color-secondary margin-socials"><i class="fab fa-pinterest-p fa-lg"></i></a>
		<?php
			}
			if ( $twitter ) {
		?>
				<a aria-label="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Twitter'; ?>"
					title="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Twitter'; ?>"
					href="<?php echo esc_url( $twitter ); ?>" target="_blank"
					class="mr-5 text-color-secondary margin-socials"><i class="fab fa-twitter fa-lg"></i></a>
		<?php
			}
			if ( $ics ) {
		?>
				<a aria-label="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' X'; ?>"
					title="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' X'; ?>"
					href="<?php echo esc_url( $ics ); ?>" target="_blank"
					class="mr-5 text-color-secondary margin-socials"><i class="fab fa-x-twitter fa-lg"></i></a>
		<?php
			}
			if ( $linkedin ) {
		?>
				<a aria-label="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Linkedin'; ?>"
					title="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Linkedin'; ?>"
					href="<?php echo esc_url( $linkedin ); ?>" target="_blank"
					class="mr-5 text-color-secondary margin-socials"><i class="fab fa-linkedin-in fa-lg"></i></a>
		<?php
			}
			if ( $titok ) {
		?>
				<a aria-label="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' TikTok'; ?>"
					title="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' TikTok'; ?>"
					href="<?php echo esc_url( $titok ); ?>" target="_blank"
					class="mr-5 text-color-secondary margin-socials"><i class="fab fa-titok fa-lg"></i></a>
		<?php
			}
			if ( $github ) {
		?>
				<a aria-label="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' GitHub'; ?>"
					title="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' GitHub'; ?>"
					href="<?php echo esc_url( $github ); ?>" target="_blank"
					class="mr-5 text-color-secondary margin-socials"><i class="fab fa-github fa-lg"></i></a>
		<?php
			}
			if ( $gitlab ) {
		?>
				<a aria-label="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' GitLab'; ?>"
					title="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' GitLab'; ?>"
					href="<?php echo esc_url( $gitlab ); ?>" target="_blank"
					class="mr-5 text-color-secondary margin-socials"><i class="fab fa-gitlab fa-lg"></i></a>
		<?php
			}
			if ( $iris ) {
		?>
				<a aria-label="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Iris'; ?>"
					title="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Iris'; ?>"
					href="<?php echo esc_url( $iris ); ?>" target="_blank"
					class="mr-5 text-color-secondary margin-socials"><i class="fa-solid fa-book fa-lg"></i></a>
		<?php
			}
			if ( $googlesc ) {
		?>
				<a aria-label="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Google Scholar'; ?>"
					title="<?php echo __( 'Follow me on', 'kk_writer_theme' ) . ' Google Scholar'; ?>"
					href="<?php echo esc_url( $googlesc ); ?>" target="_blank"
					class="mr-5 text-color-secondary margin-socials"><i class="fab fa-google-scholar fa-lg"></i></a>
		<?php
			}
		?>

	<?php
	}
	?>