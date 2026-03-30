<?php
/**
 * Template Name: contacts
 *
 * KK Writer Theme: The CONTACTS page.
 *
 * @package KK_Writer_Theme
 */

global $post;
get_header();
$kkw_section             = __( 'Contacts', 'kk_writer_theme' );
$kkw_section_description = '';

$kkw_post_img_id    = get_post_thumbnail_id( $post->ID );
$kkw_post_img_array = wp_get_attachment_image_src( $kkw_post_img_id, 'large' );
$kkw_post_img_src   = $kkw_post_img_array ? $kkw_post_img_array[0] : '';
$kkw_post_img_alt   = get_post_meta( $kkw_post_img_id, '_wp_attachment_image_alt', true );
$kkw_post_img_alt   = $kkw_post_img_alt ? $kkw_post_img_alt : $post->post_title;

$kkw_smtp_sender_email = kkw_get_option( 'smtp_sender_email', 'kkw_opt_site_contacts' );
$kkw_smtp_sender_name  = kkw_get_option( 'smtp_sender_name', 'kkw_opt_site_contacts' );
$kkw_site_email        = kkw_get_option( 'site_email', 'kkw_opt_site_contacts' );
$kkw_site_title        = kkw_get_option( 'site_title', 'kkw_opt_options' );
$kkw_website           = get_site_url();
$kkw_show_error        = false;
$kkw_show_sent         = false;
$kkw_captcha_enabled   = false;
$kkw_form_valid        = true;
$kkw_sent              = false;
$kkw_result_text       = '';
$kkw_nonce_error       = false;
$kkw_form_sent         = 'no';

require_once ABSPATH . 'wp-admin/includes/plugin.php';
require_once KKW_THEME_PATH . '/template-parts/common/captcha.php';

$kkw_postdata = filter_input_array( INPUT_POST, FILTER_UNSAFE_RAW );
if ( ! is_array( $kkw_postdata ) ) {
	$kkw_postdata = array();
}

$kkw_get_post_field = static function ( $key, $default_value = '' ) use ( $kkw_postdata ) {
	$raw_value = isset( $kkw_postdata[ $key ] ) ? $kkw_postdata[ $key ] : $default_value;
	return sanitize_text_field( (string) $raw_value );
};

$kkw_full_name      = $kkw_get_post_field( 'full_name' );
$kkw_email_address  = $kkw_get_post_field( 'email_address' );
$kkw_phone_number   = $kkw_get_post_field( 'phone_number' );
$kkw_receipt        = $kkw_get_post_field( 'receipt' );
$kkw_form_sent      = $kkw_get_post_field( 'form_sent', 'no' );
$kkw_text_message   = $kkw_get_post_field( 'text_message' );
$kkw_captcha_field  = $kkw_get_post_field( 'captcha-field' );
$kkw_captcha_prefix = $kkw_get_post_field( 'captcha-prefix' );

$kkw_base_text = sprintf(
	'<b>%1$s</b><br/><br/><b>%2$s:</b> %3$s<br/><b>%4$s:</b> %5$s<br/><b>%6$s:</b> %7$s<br/><br/><b>%8$s:</b>',
	__( 'A message was sent from the site by:', 'kk_writer_theme' ),
	__( 'Full name', 'kk_writer_theme' ),
	$kkw_full_name,
	__( 'E-mail', 'kk_writer_theme' ),
	$kkw_email_address,
	__( 'Phone number', 'kk_writer_theme' ),
	$kkw_phone_number,
	__( 'Text of the message', 'kk_writer_theme' )
);

$kkw_mail_text = $kkw_base_text . '<br/><br/>' . $kkw_text_message;

// Message sending procedure.
if ( 'yes' === $kkw_form_sent ) {

	// Nonce check.
	if ( isset( $kkw_postdata['contacts_nonce_field'] ) && wp_verify_nonce( sanitize_text_field( (string) $kkw_postdata['contacts_nonce_field'] ), 'sf_contacts_nonce' ) ) {

		// The NONCE is valid.
		$kkw_nonce_error = false;
		$kkw_to          = $kkw_site_email;
		$kkw_subject     = __( '[ContactForm]', 'kk_writer_theme' ) . ' ' . __( 'E-mail form the site', 'kk_writer_theme' ) . ': ' . $kkw_site_title;
		$kkw_headers     = array();
		$kkw_headers[]   = 'Content-Type: text/html; charset=UTF-8';
		$kkw_headers[]   = 'From: ' . $kkw_smtp_sender_name . ' <' . $kkw_smtp_sender_email . '>';

		// 1 - Captcha validation.
		if ( $kkw_captcha_enabled ) {
			$kkw_captcha_valid = $kkw_captcha_obj->check( $kkw_captcha_prefix, $kkw_captcha_field );
			if ( ! $kkw_captcha_valid ) {
				$kkw_result_text .= '<br/>' . __( 'The verification code is not valid.', 'kk_writer_theme' );
			}
		} else {
			$kkw_captcha_valid = true;
		}

		// 2 - Form fields validation
		// 2a - Check mandatory fields
		if ( '' === $kkw_full_name || '' === $kkw_email_address || '' === $kkw_text_message ) {
			$kkw_form_valid   = false;
			$kkw_result_text .= '<br/>' . __( 'Please, fill all the mandatory fields', 'kk_writer_theme' );
		}
		// 2b - Check email address validity.
		if ( ! ( filter_var( $kkw_email_address, FILTER_VALIDATE_EMAIL ) ) ) {
			$kkw_form_valid   = false;
			$kkw_result_text .= '<br/>' . __( 'Please, provide a valid email address.', 'kk_writer_theme' );
		}

		// 3 - Check validity.
		// The form is valid if the fields are valid and if the captcha is valid or not active.
		$kkw_form_valid = $kkw_form_valid && ( $kkw_captcha_valid || ! $kkw_captcha_enabled );

		// 4 - SEND EMAIL.
		if ( $kkw_form_valid ) {
			// 4a - Send email to the site.
			$kkw_sent = wp_mail( $kkw_to, $kkw_subject, $kkw_mail_text, $kkw_headers );
			if ( ! $kkw_sent ) {
				$kkw_result_text .= '<br/>' . __( 'Message not sent.', 'kk_writer_theme' );
			}
			if ( 'on' === $kkw_receipt ) {
				// 4b - Send confirmation email to the sender.
				$kkw_receipt_text = __( 'receipt', 'kk_writer_theme' );
				$kkw_subject     .= '(' . $kkw_receipt_text . ')';
				$kkw_sent         = $kkw_sent && wp_mail( $kkw_email_address, $kkw_subject, $kkw_mail_text, $kkw_headers );
				if ( ! $kkw_sent ) {
					$kkw_result_text .= '<br/>' . __( 'Confirmation email not sent.', 'kk_writer_theme' );
				}
			}
		}

			// 5 - Show results.
		if ( 'yes' === $kkw_form_sent && $kkw_sent ) {
			$kkw_show_sent = true;
		}
		if ( ( ! $kkw_form_valid ) || ( 'yes' === $kkw_form_sent && ! $kkw_sent ) ) {
			$kkw_show_error = true;
		}
	} else {
		// The nonce is not valid.
		$kkw_show_error   = true;
		$kkw_nonce_error  = true;
		$kkw_result_text .= '<br/>' . __( 'Nonce not valid.', 'kk_writer_theme' );
	}
}

?>


<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<!-- BODY -->
	<div class="container mt-2">

		<!-- BANNER -->
			<section class="row mb-2 py-4 primary-bg">
				<h1><?php echo esc_html( $kkw_section ); ?></h1>
				<?php
				if ( $kkw_section_description ) {
					?>
				<div class="col-12">
					<div class="form-group col text-left mb-2">
					<?php echo wp_kses_post( $kkw_section_description ); ?>
					</div>
				</div>
					<?php
				}
				?>
		</section>

		<div class="row">
			<aside class="col-md-3 border-end mb-5 text-center my-5 kkw_img_contacts">
				<!-- Post featured image -->
				<img src="<?php echo esc_url( $kkw_post_img_src ); ?>"
					class="bd-placeholder-img"
					alt="<?php echo esc_attr( $kkw_post_img_alt ); ?>" />

				<div class="text-left mt-5">
					<?php get_template_part( 'template-parts/common/social-footer' ); ?>
				</div>

			</aside>

				<section class="col-md-9" aria-label="<?php echo esc_attr__( 'Contacts form', 'kk_writer_theme' ); ?>">

				<!-- FEEDBACK MESSAGES SECTION-->
				<div id="contacts_messages">
					<?php
					if ( $kkw_show_sent ) {
						?>
							<!-- ALERT OK -->
							<div class="container my-12 p-2">
								<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
								<?php echo esc_html__( 'Message successfully sent.', 'kk_writer_theme' ); ?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?php echo esc_attr__( 'Close alert', 'kk_writer_theme' ); ?>">
									</button>
								</div>
							</div>
						<?php
					}
					if ( $kkw_show_error ) {
						?>
							<!-- ALERT KO -->
							<div class="container my-12 p-2">
								<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
									<?php echo wp_kses_post( $kkw_result_text ); ?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?php echo esc_attr__( 'Close alert', 'kk_writer_theme' ); ?>">
									</button>
								</div>
							</div>
						<?php
					}
					?>
				</div>

					<!-- CONTACT FORM SECTION-->
					<div id="kkw_contact_form_id">
						<form action="." id="kkw_contact_form" name="kkw_contact_form" method="post"
							aria-label="<?php esc_attr_e( 'Contact form', 'kk_writer_theme' ); ?>">
							<?php wp_nonce_field( 'sf_contacts_nonce', 'contacts_nonce_field', false ); ?>
						<div class="container m-5 pt-4">
							<!-- SITE CONTACTS -->
							<div class="row">
								<div class="col-lg-9">
									<div class="row ">
										<div class="col-lg-12">
												<div class="row mb-4">
													<div class="form-group col">
														<label class="active" for="full_name">
																<?php echo esc_html__( 'Name and surname', 'kk_writer_theme' ); ?>&nbsp;*
														</label>
														<input type="text" class="form-control border-bottom-only" name="full_name" id="full_name"
															value="<?php echo esc_attr( $kkw_full_name ); ?>"
																placeholder="<?php echo esc_attr__( 'Your name and your surname', 'kk_writer_theme' ); ?>">
													</div>
												</div>
												<div class="row mb-4">
													<div class="form-group col">
														<label class="active" for="text_message">
																<?php echo esc_html__( 'Message text', 'kk_writer_theme' ); ?>&nbsp;*
														</label>
														<input type="text" class="form-control border-bottom-only" name="text_message" id="text_message"
															value="<?php echo esc_attr( $kkw_text_message ); ?>"
																placeholder="<?php echo esc_attr__( 'The text of the message', 'kk_writer_theme' ); ?>">
													</div>
												</div>
												<div class="row mb-4">
													<div class="form-group col-md-6">
															<label class="active" for="email_address"><?php echo esc_html__( 'E-mail', 'kk_writer_theme' ); ?>&nbsp;*</label>
														<input type="email" class="form-control border-bottom-only" id="email_address" name="email_address"
															value="<?php echo esc_attr( $kkw_email_address ); ?>"
																placeholder="<?php echo esc_attr__( 'Your e-mail address', 'kk_writer_theme' ); ?>">
													</div>
													<div class="form-group col-md-6">
															<label for="phone_number" class="active"><?php echo esc_html__( 'Phone number', 'kk_writer_theme' ); ?></label>
														<input type="tel" class="form-control border-bottom-only" id="phone_number" name="phone_number"
															value="<?php echo esc_attr( $kkw_phone_number ); ?>"
																placeholder="<?php echo esc_attr__( 'Your phone number', 'kk_writer_theme' ); ?>">
													</div>
												</div>
												<!-- NOTIFICA -->
												<div class="row mb-5">
													<div class="form-group col-md-9">
														<div class="toggles">
																<label for="receipt">
																	<?php
																	echo esc_html__( 'Do you want to receive an email notification?', 'kk_writer_theme' );
																	?>
																<input type="checkbox" id="receipt" name="receipt">
																<span class="lever"></span>
															</label>
														</div>
													</div>
												</div>
												<!-- CAPTCHA -->
												<?php
												if ( $kkw_captcha_enabled ) {
													?>
												<div class="row mb-5" style="margin-top: 20px;">
													<div class="form-group col-md-6" style="text-align: center">
															<img src="<?php echo esc_url( $kkw_captcha_obj_image_src ); ?>"
																alt="<?php echo esc_attr__( 'Insert the captcha code', 'kk_writer_theme' ); ?>"
																width="<?php echo esc_attr( $kkw_captcha_obj_image_width ); ?>"
																height="<?php echo esc_attr( $kkw_captcha_obj_image_height ); ?>" />
													</div>
													<div class="form-group col-md-6">
														<input class="form-control border-bottom-only" name="captcha-field" id="captcha-field"
															size="<?php echo esc_attr( $kkw_captcha_obj_image_width ); ?>" type="text"
																	placeholder="<?php echo esc_attr__( 'Write here the verification code', 'kk_writer_theme' ); ?>" />
														<input name="captcha-prefix" id="captcha-prefix"
															type="hidden" value="<?php echo esc_attr( $kkw_captcha_obj_prefix ); ?>" />
													</div>
												</div>
													<?php
												}
												?>
												<!-- SUBMIT -->
												<div class="row mt-4">
													<div class="form-group col text-center">
															<input type="hidden" name="form_sent" id="form_sent" value="yes" />
															<button type="button" class="mx-3 btn btn-outline-cancel">
																<?php echo esc_html__( 'Cancel', 'kk_writer_theme' ); ?>
															</button>
															<button type="submit" class="mx-3 btn btn-primary">
																<?php echo esc_html__( 'Confirm', 'kk_writer_theme' ); ?>
															</button>
													</div>
												</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						</form>
				</div>

			</section>
		</div>

	</div><!-- body -->
</main>


<?php
get_footer();
