<?php
/**
 * KKW Writer Theme SEO tags template part.
 *
 * @package KK_Writer_Theme
 */

$kkw_seo_internal_management_enabled = kkw_get_option( 'seo_internal_management_enabled', 'kkw_opt_advanced_settings' );

if ( 'true' !== $kkw_seo_internal_management_enabled ) {
	return;
}

$kkw_og_data = KKW_ContentsManager::get_og_data();
$kkw_og_data = is_array( $kkw_og_data ) ? $kkw_og_data : array();

$kkw_og_url         = isset( $kkw_og_data['url'] ) ? (string) $kkw_og_data['url'] : '';
$kkw_og_lang_locale = isset( $kkw_og_data['lang_locale'] ) ? (string) $kkw_og_data['lang_locale'] : '';
$kkw_og_title       = isset( $kkw_og_data['title'] ) ? (string) $kkw_og_data['title'] : '';
$kkw_og_description = isset( $kkw_og_data['description'] ) ? (string) $kkw_og_data['description'] : '';
$kkw_og_site_title  = isset( $kkw_og_data['site_title'] ) ? (string) $kkw_og_data['site_title'] : '';
$kkw_og_image       = isset( $kkw_og_data['image'] ) ? (string) $kkw_og_data['image'] : '';
$kkw_og_img_width   = isset( $kkw_og_data['img_width'] ) ? absint( $kkw_og_data['img_width'] ) : 0;
$kkw_og_img_height  = isset( $kkw_og_data['img_height'] ) ? absint( $kkw_og_data['img_height'] ) : 0;
?>
<!-- SEO optimization -->
<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="canonical" href="<?php echo esc_url( $kkw_og_url ); ?>">
<!-- OG DATA for page sharing -->
<meta property="og:locale" content="<?php echo esc_attr( $kkw_og_lang_locale ); ?>">
<meta property="og:type" content="article">
<meta property="og:title" content="<?php echo esc_attr( $kkw_og_title ); ?>">
<meta property="og:description" content="<?php echo esc_attr( $kkw_og_description ); ?>">
<meta property="og:url" content="<?php echo esc_url( $kkw_og_url ); ?>">
<meta property="og:site_name" content="<?php echo esc_attr( $kkw_og_site_title ); ?>">
<meta property="og:image" content="<?php echo esc_url( $kkw_og_image ); ?>">
<meta property="og:image:width" content="<?php echo esc_attr( (string) $kkw_og_img_width ); ?>">
<meta property="og:image:height" content="<?php echo esc_attr( (string) $kkw_og_img_height ); ?>">
<meta property="og:image:type" content="image/png">
<!-- TWITTER CARD -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo esc_attr( $kkw_og_title ); ?>">
<meta name="twitter:description" content="<?php echo esc_attr( $kkw_og_description ); ?>">
<meta name="twitter:image" content="<?php echo esc_url( $kkw_og_image ); ?>">
<meta name="twitter:url" content="<?php echo esc_url( $kkw_og_url ); ?>">
