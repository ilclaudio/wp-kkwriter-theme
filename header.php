<!DOCTYPE html>
<html>

<head>
	<?php wp_head(); ?>
</head>
<?php
	$title   = kkw_get_option( 'site_title', 'kkw_opt_options' );
	$tagline = kkw_get_option( 'site_tagline', 'kkw_opt_options' );
?>

<body>
	<div class="container">
		<header class="border-bottom lh-1 py-3">
			<div class="row flex-nowrap justify-content-between align-items-center">
				<div class="col-4 pt-1">
					logo
				</div>
				<div class="col-4 text-center">
					<h1><?php echo esc_html( $title, 'kk_writer_theme' ); ?></h1>
					<div class="kkw_tagline"><?php echo esc_html( $tagline, 'kk_writer_theme' ); ?></div>
				</div>
				
				<div class="col-4 d-flex justify-content-end align-items-center">
					<!-- Language Selector -->
					<div id="#kkw_language_selector" class="dropdown">
						<select class="selectpicker" data-width="fit">
							<option data-content='<span class="flag-icon flag-icon-us"></span> English'>English</option>
							<option  data-content='<span class="flag-icon flag-icon-mx"></span> Español'>Español</option>
						</select>
					</div>
					<!-- Search button -->
					<a class="link-secondary" href="#" aria-label="Search">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24">
							<title>Search</title>
							<circle cx="10.5" cy="10.5" r="7.5"></circle>
							<path d="M21 21l-5.2-5.2"></path>
						</svg>
					</a>
				</div>
			</div>
		</header>
		<div class="nav-scroller py-1 mb-3 border-bottom">
			<nav class="nav nav-underline justify-content-between">
				<a class="nav-item nav-link link-body-emphasis active" href="#">Home</a>
				<a class="nav-item nav-link link-body-emphasis" href="#">Biografia</a>
				<a class="nav-item nav-link link-body-emphasis" href="#">Poesia</a>
				<a class="nav-item nav-link link-body-emphasis" href="#">Saggistica</a>
				<a class="nav-item nav-link link-body-emphasis" href="#">Narrativa</a>
				<a class="nav-item nav-link link-body-emphasis" href="#">Notizie/Eventi</a>
				<a class="nav-item nav-link link-body-emphasis" href="#">Blog</a>
				<a class="nav-item nav-link link-body-emphasis" href="#">Contatti</a>
			</nav>
		</div>
	</div>