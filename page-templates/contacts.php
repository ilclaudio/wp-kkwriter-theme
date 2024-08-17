<?php
/**
 * Template Name: contacts
 * 
 * KK Writer Theme: The CONTACTS page.
 * @package KK_Writer_Theme
 */
?>

<?php
global $post;
get_header();

$post_img_id    = get_post_thumbnail_id( $post->id );
$post_img_array = wp_get_attachment_image_src( $post_img_id, 'full' );
$post_img_src   = $post_img_array ? $post_img_array[0] : '';
$post_img_alt   = get_post_meta( $post_img_id, '_wp_attachment_image_alt', true );
$post_img_alt   = $post_img_alt ? $post_img_alt : $post->title;

$section             = __( 'Contacts' , 'kk_writer_theme' );
$section_description = '';
$site_email          = kkw_get_option( 'site_email', 'kkw_opt_site_contacts' );
$site_title          = kkw_get_option( 'site_title', 'kkw_opt_options' );
$website             = get_site_url();
$show_error          = false;
$show_sent           = false;
$captcha_enabled     = false;
$form_valid          = true;
$sent                = false;
$result_text         = '';
$nonce_error         = false;
$form_sent           = 'no';

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
include_once( KKW_THEMA_PATH . '/template-parts/common/captcha.php' );

$postdata = $_POST;

$full_name      = sanitize_text_field( isset( $postdata['full_name'] ) ? $postdata['full_name'] : '' );
$email_address  = sanitize_text_field( isset( $postdata['email_address'] ) ? $postdata['email_address'] : '' );
$phone_number   = sanitize_text_field( isset( $postdata['phone_number'] ) ? $postdata['phone_number'] : '' );
$receipt        = sanitize_text_field( isset( $postdata['receipt'] ) ? $postdata['receipt'] : '' );
$form_sent      = sanitize_text_field( isset( $postdata['form_sent'] ) ? $postdata['form_sent'] : 'no' );
$text_message   = sanitize_text_field( isset( $postdata['text_message'] ) ? $postdata['text_message'] : '' );
$captcha_field  = sanitize_text_field( isset( $postdata['captcha-field'] ) ? $postdata['captcha-field'] : '' );
$captcha_prefix = sanitize_text_field( isset( $postdata['captcha-prefix'] ) ? $postdata['captcha-prefix'] : '' );

// Message sending procedure.
if ( 'yes' === $form_sent ) {

	// Nonche check.
	if ( isset( $postdata['contacts_nonce_field'] ) && wp_verify_nonce( sanitize_text_field( $postdata['contacts_nonce_field'] ), 'sf_contacts_nonce' ) ) {

		// The NONCE is valid.
		$nonce_error = false;
		$name       = $full_name;
		$to         = $site_email;
		$subject    = __( '[ContactForm]', 'kk_writer_theme' ) . ' ' . __( 'E-mail form the site', 'kk_writer_theme' ) . ': '. $site_title;
		$headers    = 'From: ' . $email_address . '\r\n' . 'Reply-To: ' . $email_address . '\r\n';

		// 1 - Controllo del captcha.
		if ( $captcha_enabled ) {
			$captcha_valid = $captcha_obj->check( $captcha_prefix, $captcha_field );
			if ( ! $captcha_valid ) {
				$result_text = $result_text . '<BR/>' . __( 'The verification code is not valid.', 'kk_writer_theme' );
			}
		} else {
			$captcha_valid = true;
		}

		// 2 - Form fields validation
		// 2a - Check mandatory fields
		if ( '' === $full_name || '' === $email_address || '' === $text_message ) {
			$form_valid     = $form_valid && true;
			$result_text = $result_text . '<BR/>' . __( 'Please, fill all the mandatory fields', 'kk_writer_theme' );
		}
		// 2b - Check email address validity.
		if ( ! ( filter_var( $email_address, FILTER_VALIDATE_EMAIL ) ) ) {
			$form_valid     = $form_valid && true;
			$result_text = $result_text . '<BR/>' . __( 'Please, provide a valid email address.', 'kk_writer_theme' );
		}

		// 3 - Check validity.
		// The form is valid if the fields are valid and if the captcha is valid or not active.
		$form_valid = $form_valid && ( $captcha_valid || ! $captcha_enabled );

		// 4 - SEND EMAIL.
		if ( $form_valid ) {
			// 4a - Send email to the site.
			$sent = wp_mail( $to, $subject, strip_tags( $text_message ), $headers );
			if ( ! $sent ) {
				$result_text = $result_text . '<BR/>' . __( 'Message not sent.', 'kk_writer_theme' );
			}
			if ( 'on' === $receipt ) {
				// 4b - Send confirmation email to the sender.
				$testo_receipt = __( 'receipt', 'kk_writer_theme' );
				$subject        .= '(' . $testo_receipt . ')';
				$sent           = $sent && wp_mail( $email_address, $subject, strip_tags( $text_message ), $headers );
				if ( ! $sent ) {
					$result_text = $result_text . '<BR/>' . __( 'Confirmation email not sent.', 'kk_writer_theme' );
				}
			}
		}

		// 5 - Show results.
		if ( $form_sent && $sent ) {
			$show_sent = true;
		}
		if ( ( ! $form_valid ) || ( $form_sent && ! $sent ) ) {
			$show_error  = true;
		}

	} else {
		// Il NONCE non è valido.
		$show_error = true;
		$nonce_error  = true;
		$result_text = $result_text . '<BR/>' . __( 'Nonce not valid.', 'kk_writer_theme' );
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
			<h1><?php echo $section; ?></h1>
			<?php
				if ( $section_description ){
			?>
			<div class="col-12">
				<div class="form-group col text-left mb-2">
				<?php echo $section_description; ?>
				</div>
			</div>
			<?php
				}
			?>
		</section>

		<div class="row">
			<aside class="col-md-3 border-end mb-5 text-center my-5 kkw_img_contacts">
				<!-- Post featured image -->
				<img src="<?php echo esc_url( $post_img_src ); ?>"
					class="bd-placeholder-img"
					alt="<?php echo esc_attr( $post_img_alt ); ?>" />
					
				<div class="text-left mt-5">
					<?php get_template_part( 'template-parts/common/social_footer' ); ?>
				</div>

			</aside>

			<section class="col-md-9" aria-label="<?php echo __( 'Contacts form' , 'kk_writer_theme' ); ?>">

				<!-- FEEDBACK MESSAGES SECTION-->
				<div id="contacts_messages">
					<?php
					if ( $show_sent ) {
					?>
						<!-- ALERT OK -->
						<div class="container my-12 p-2">
							<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
							<?php echo esc_html( __( 'Message successfully sent', 'kk_writer_theme' ) ) . '&nbsp;.'; ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?php echo  __( 'Close alert', 'kk_writer_theme' );?>">
									<svg class="icon" role="img" aria-labelledby="<?php echo  __( 'Close alert', 'kk_writer_theme' );?>">
										<use href="<?php echo esc_attr( get_template_directory_uri() . '/assets/svg/sprites.svg#it-close' ); ?>"></use>
									</svg>
								</button>
							</div>
						</div>
					<?php
					}
					if ( $show_error ) {
					?>
						<!-- ALERT KO -->
						<div class="container my-12 p-2">
							<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
								<?php echo __( $result_text, 'kk_writer_theme' ); ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="<?php echo  __( 'Close alert', 'kk_writer_theme' );?>">
								</button>
							</div>
						</div>
					<?php
					}
					?>
				</div>

				<!-- CONTACT FORM SECTION-->
				<div id="kkw_contact_form_id">
					<FORM action="." id="kkw_contact_form" name="kkw_contact_form" method="POST">
						<?php wp_nonce_field( 'sf_contacts_nonce', 'contacts_nonce_field' ); ?>
						<div class="container m-5 pt-4">
							<!-- SITE CONTACTS -->
							<div class="row">
								<div class="col-lg-9">
									<div class="row ">
										<div class="col-lg-12">
												<div class="row mb-4">
													<div class="form-group col">
														<label class="active" for="full_name">
															<?php echo esc_html( __( 'Name and surname', 'kk_writer_theme' ) ); ?>&nbsp;*
														</label>
														<input type="text" class="form-control border-bottom-only" name="full_name" id="full_name"
															value="<?php echo esc_attr( $full_name ); ?>"
															placeholder="<?php echo esc_attr( __( 'Your name and your surname', 'kk_writer_theme' ) ); ?>">
													</div>
												</div>
												<div class="row mb-4">
													<div class="form-group col">
														<label class="active" for="text_message">
															<?php echo esc_html( __( 'Message text', 'kk_writer_theme' ) ); ?>&nbsp;*
														</label>
														<input type="text" class="form-control border-bottom-only" name="text_message" id="text_message"
															value="<?php echo esc_attr( $text_message ); ?>"
															placeholder="<?php echo esc_attr( __( 'The text of the message', 'kk_writer_theme' ) ); ?>">
													</div>
												</div>
												<div class="row mb-4">
													<div class="form-group col-md-6">
														<label class="active" for="email_address"><?php echo esc_html( __( 'E-mail', 'kk_writer_theme' ) ); ?>&nbsp;*</label>
														<input type="email" class="form-control border-bottom-only" id="email_address" name="email_address"
															value="<?php echo esc_attr( $email_address ); ?>"
															placeholder="<?php echo esc_attr( __( 'Your e-mail address', 'kk_writer_theme' ) ); ?>">
													</div>
													<div class="form-group col-md-6">
														<label for="phone_number" class="active"><?php echo esc_html( __( 'Phone number', 'kk_writer_theme' ) ); ?></label>
														<input type="tel" class="form-control border-bottom-only" id="phone_number" name="phone_number"
															value="<?php echo esc_attr( $phone_number ); ?>"
															placeholder="<?php echo esc_html( __( 'Your phone number', 'kk_writer_theme' ) ); ?>">
													</div>
												</div>
												<!-- NOTIFICA -->
												<div class="row mb-5">
													<div class="form-group col-md-9">
														<div class="toggles">
															<label for="receipt">
																<?php
																echo esc_html( __( 'Do you want to receive an email notification', 'kk_writer_theme' ) ) . ' ?';
																	?>
																<input type="checkbox" id="receipt" name="receipt">
																<span class="lever"></span>
															</label>
														</div>
													</div>
												</div>
												<!-- CAPTCHA -->
												<?php
												if ( $captcha_enabled ) {
												?>
												<div class="row mb-5" style="margin-top: 20px;">
													<div class="form-group col-md-6" style="text-align: center">
														<img src="<?php echo esc_url( $captcha_obj_image_src ); ?>" alt="captcha"
																	width="<?php echo esc_attr( $captcha_obj_image_width ); ?>" height="<?php echo esc_attr( $captcha_obj_image_height ); ?>" />
													</div>
													<div class="form-group col-md-6">
														<input class="form-control border-bottom-only" name="captcha-field" id="captcha-field"
															size="<?php echo esc_attr( $captcha_obj_image_width ); ?>" type="text"
																placeholder="<?php echo esc_html( __( 'Write here the verification code', 'kk_writer_theme' ) ); ?>" />
														<input name="captcha-prefix" id="captcha-prefix" 
															type="hidden" value="<?php echo esc_attr( $captcha_obj_prefix ); ?>" />
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
															<?php echo esc_html( __( 'Cancel', 'kk_writer_theme' ) ); ?>
														</button>
														<button type="submit" class="mx-3 btn btn-primary">
															<?php echo esc_html( __( 'Confirm', 'kk_writer_theme' ) ); ?>
														</button>
													</div>
												</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</FORM>
				</div>

			</section>
		</div>

	</div><!-- body -->
</main>


<?php
get_footer();
