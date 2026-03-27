<?php // phpcs:ignoreFile WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * KKW Writer Theme meta tags template part.
 *
 * @package KK_Writer_Theme
 */

$kkw_current_lang = isset( $args['current_lang'] ) ? sanitize_text_field( (string) $args['current_lang'] ) : '';
$kkw_site_title   = isset( $args['site_title'] ) ? sanitize_text_field( (string) $args['site_title'] ) : '';
$kkw_site_tagline = isset( $args['site_tagline'] ) ? sanitize_text_field( (string) $args['site_tagline'] ) : '';
$kkw_post_id      = get_queried_object_id();
$kkw_wrapper      = $kkw_post_id ? KKW_ContentsManager::get_wrapped_item( $kkw_post_id ) : null;
$kkw_charset      = (string) get_bloginfo( 'charset' );
$kkw_content_type = 'text/html; charset=' . $kkw_charset;

if ( is_home() ) {
	$kkw_page_title = $kkw_site_title;
} elseif ( is_object( $kkw_wrapper ) && ! empty( $kkw_wrapper->title ) ) {
	$kkw_page_title = (string) $kkw_wrapper->title;
} else {
	$kkw_page_title = '';
}

$kkw_page_desc     = $kkw_page_title;
$kkw_keywords_raw  = preg_replace( '/[^a-zA-Z0-9\s]/', '', $kkw_page_title . ' ' . $kkw_site_tagline );
$kkw_keywords_safe = is_string( $kkw_keywords_raw ) ? $kkw_keywords_raw : '';
?>
<meta name="resource-type" content="document">
<meta name="description" content="<?php echo esc_attr( $kkw_page_desc ); ?>">
<meta name="copyright" content="<?php echo esc_attr( $kkw_site_title ); ?>">
<meta name="keywords" content="<?php echo esc_attr( $kkw_keywords_safe ); ?>">

<meta http-equiv="content-type" content="<?php echo esc_attr( $kkw_content_type ); ?>">
<meta http-equiv="content-language" content="<?php echo esc_attr( $kkw_current_lang ); ?>">

<title><?php echo esc_html( $kkw_page_title ); ?></title>
