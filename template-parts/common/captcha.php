<?php
/**
 * KK Writer Theme: Captcha setup for contact forms.
 *
 * @package KK_Writer_Theme
 */

$kkw_captcha_enabled          = false;
$kkw_captcha_obj              = null;
$kkw_captcha_obj_prefix       = '';
$kkw_captcha_obj_image_src    = '';
$kkw_captcha_obj_image_width  = '';
$kkw_captcha_obj_image_height = '';

if ( is_plugin_active( plugin_basename( 'really-simple-captcha/really-simple-captcha.php' ) ) && class_exists( 'ReallySimpleCaptcha' ) ) {
	$kkw_captcha_enabled              = true;
	$kkw_captcha_obj                  = new ReallySimpleCaptcha();
	$kkw_captcha_obj->chars           = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
	$kkw_captcha_obj->char_length     = '4';
	$kkw_captcha_obj->img_size        = array( '72', '24' );
	$kkw_captcha_obj->fg              = array( '0', '0', '0' );
	$kkw_captcha_obj->bg              = array( '255', '255', '255' );
	$kkw_captcha_obj->font_size       = '16';
	$kkw_captcha_obj->font_char_width = '15';
	$kkw_captcha_obj->img_type        = 'png';

	$kkw_captcha_obj_word         = $kkw_captcha_obj->generate_random_word();
	$kkw_captcha_obj_prefix       = wp_rand();
	$kkw_captcha_obj_image_name   = $kkw_captcha_obj->generate_image( $kkw_captcha_obj_prefix, $kkw_captcha_obj_word );
	$kkw_captcha_obj_image_url    = trailingslashit( get_bloginfo( 'wpurl' ) ) . 'wp-content/plugins/really-simple-captcha/tmp/';
	$kkw_captcha_obj_image_src    = $kkw_captcha_obj_image_url . $kkw_captcha_obj_image_name;
	$kkw_captcha_obj_image_width  = $kkw_captcha_obj->img_size[0];
	$kkw_captcha_obj_image_height = $kkw_captcha_obj->img_size[1];
}
