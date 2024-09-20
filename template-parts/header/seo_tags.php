<?php
/**
 * KK Writer Theme: The analytics code of the site.
 *
 * @package KK_Writer_Theme
 */

global $post;

if ( kkw_get_option( 'seo_internal_management_enabled', 'kkw_opt_advanced_settings' ) === 'true') {
	$og_data = KKW_ContentsManager::get_og_data();
	$current_lang  = $args['current_lang'];
	$site_title    = $args['site_title'];
	$site_tagline  = $args['site_tagline'];
?>

	<!-- SEO optimization -->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="canonical" href="<?php echo $og_data['url']; ?>" />
	<!-- OG DATA for page sharing -->
	<meta property="og:locale" content="<?php echo $og_data['lang_locale']; ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $og_data['title']; ?>" />
	<meta property="og:description" content="<?php echo $og_data['description']; ?>" />
	<meta property="og:url" content='<?php echo $og_data['url']; ?>'/>
	<meta property="og:site_name" content="<?php echo $og_data['site_title']; ?>" />
	<meta property="og:image" content="<?php echo $og_data['image']; ?>"/>
	<meta property="og:image:width" content="<?php echo $og_data['img_width']; ?>" />
	<meta property="og:image:height" content="<?php echo $og_data['img_height']; ?>" />
	<meta property="og:image:type" content="image/png" />
	<!-- TWITTER CARD  -->
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:title" content="<?php echo $og_data['title']; ?>">
	<meta name="twitter:description" content="<?php echo $og_data['description']; ?>">
	<meta name="twitter:image" content="<?php echo $og_data['image']; ?>">
	<meta name="twitter:url" content="<?php echo $og_data['url']; ?>">

<?php
}
