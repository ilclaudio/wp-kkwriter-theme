<?php
global $post;

$localestr     = KKW_MultiLangManager::get_current_language( 'slug' );
$site_title    = kkw_get_option( 'site_title', 'kkw_opt_options' );
$site_tagline  = kkw_get_option( 'site_tagline', 'kkw_opt_options' );

$wrapper       = $post ? KKW_ContentsManager::get_wrapped_item( $post->ID ) : null;
$copyright     = $site_title;
$resource_type = 'document';
$charset       = 'text/html; charset=US-ASCII';
$page_title    =  $wrapper && $wrapper->title ? $wrapper->title : '';
// $page_desc     =  $wrapper->description ? $wrapper['description']: $wrapper->description;
$page_desc     = $page_title;
$keywords      = preg_replace( "/[^a-zA-Z0-9\s]/", '', $page_title . ' ' . $site_tagline );
?>

<meta name="resource-type" content="<?php echo $resource_type; ?>" />
<meta name="description" content="<?php echo $page_desc; ?>" />
<meta name="copyright" content="<?php echo $site_title; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>"/>

<meta http-equiv="content-type" content="<?php echo $charset; ?>" />
<meta http-equiv="content-language" content="<?php echo $localestr; ?>" />
