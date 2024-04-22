<?php
// require_once( WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'wp-kkwriter-plugin' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'search-manager.php' );
// $sm = KKW_SearchManager::get_books();
$opt_contents = kkw_get_option( 'carousel_content', 'kkw_opt_hp_layout' );
$contents     = count( $opt_contents ) > 0 ? $opt_contents : array();

foreach ( $contents as $c ) {
	echo $c . ' ';
}
?>

<!-- FIRST ROW -->
<div id="fc_first_row" class="row mt-4 mb-1 fc-row">
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<div class="col p-4 d-flex flex-column position-static">
				<strong class="d-inline-block mb-2 text-primary-emphasis">Poesia - In evidenza</strong>
				<h3 class="mb-0">Featured post</h3>
				<div class="mb-1 text-body-secondary">Nov 12</div>
				<p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
				<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
					Continua a leggere...
					<svg class="bi"><use xlink:href="#chevron-right"></use></svg>
				</a>
			</div>
			<div class="col-auto d-none d-lg-block">
				<svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<div class="col p-4 d-flex flex-column position-static">
				<strong class="d-inline-block mb-2 text-success-emphasis">Saggistica - In evidenza</strong>
				<h3 class="mb-0">Post title</h3>
				<div class="mb-1 text-body-secondary">Nov 11</div>
				<p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
				<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
					Continua a leggere...
					<svg class="bi"><use xlink:href="#chevron-right"></use></svg>
				</a>
			</div>
			<div class="col-auto d-none d-lg-block">
				<svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
			</div>
		</div>
	</div>
</div>


<!-- SECOND ROW -->
<div id="fc_second_row" class="row mb-4 fc-row">
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<div class="col p-4 d-flex flex-column position-static">
				<strong class="d-inline-block mb-2 text-primary-emphasis">Narrativa - In evidenza</strong>
				<h3 class="mb-0">Featured post</h3>
				<div class="mb-1 text-body-secondary">Nov 12</div>
				<p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
				<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
					Continua a leggere...
					<svg class="bi"><use xlink:href="#chevron-right"></use></svg>
				</a>
			</div>
			<div class="col-auto d-none d-lg-block">
				<svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<div>
				<ul class="list-unstyled">
					<li>
						<a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
							<svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"></rect></svg>
							<div class="col-lg-8">
								<strong class="d-inline-block mb-2 text-primary-emphasis">Notizie/Eventi</strong>
								<h6 class="mb-0">Example blog post title</h6>
								<small class="text-body-secondary">Continua a leggere...</small>
							</div>
						</a>
					</li>
					<li>
						<a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
							<svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"></rect></svg>
							<div class="col-lg-8">
								<strong class="d-inline-block mb-2 text-primary-emphasis">Blog</strong>
								<h6 class="mb-0">This is another blog post title</h6>
								<small class="text-body-secondary">Continua a leggere...</small>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>