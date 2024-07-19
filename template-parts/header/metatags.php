<?php
global $post;

$localestr     = KKW_PolylangManager::get_current_language( 'slug' );
$title         = kkw_get_option( 'site_title', 'kkw_opt_options' );
$tagline       = kkw_get_option( 'site_tagline', 'kkw_opt_options' );
$wrapper       = KKW_ContentsManager::get_wrapped_item( $post->ID );
$copyright     = $title;
$resource_type = 'document';
$charset       = 'text/html; charset=US-ASCII';
$page_title    =  $wrapper->title ? $wrapper->title : '';
// $page_desc     =  $wrapper->description ? $wrapper['description']: $wrapper->description;
$page_desc     =  $page_title;
$keywords      = preg_replace( "/[^a-zA-Z0-9\s]/", '', $page_title . ' ' . $tagline );
?>

<meta name="resource-type" content="<?php echo $resource_type; ?>" />
<meta name="description" content="<?php echo $page_desc; ?>" />
<meta name="copyright" content="<?php echo $title; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>"/>

<meta http-equiv="content-type" content="<?php echo $charset; ?>" />
<meta http-equiv="content-language" content="<?php echo $localestr; ?>" />
