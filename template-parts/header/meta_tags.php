<?php
global $post;

$current_lang  = $args['current_lang'];
$site_title    = $args['site_title'];
$site_tagline  = $args['site_tagline'];
$wrapper       = $post ? KKW_ContentsManager::get_wrapped_item( $post->ID ) : null;
$copyright     = $site_title; 
$charset       = 'text/html; charset=US-ASCII';
$page_title    =  is_home() ? $site_title: ( $wrapper && $wrapper->title ? $wrapper->title : '');
$page_desc     = $page_title;
$keywords      = preg_replace( "/[^a-zA-Z0-9\s]/", '', $page_title . ' ' . $site_tagline );
?>

<meta name="resource-type" content="<?php echo $resource_type; ?>" />
<meta name="description" content="<?php echo $page_desc; ?>" />
<meta name="copyright" content="<?php echo $site_title; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>"/>

<meta http-equiv="content-type" content="<?php echo $charset; ?>" />
<meta http-equiv="content-language" content="<?php echo $current_lang; ?>" />

<title><?php echo $page_title; ?></title>