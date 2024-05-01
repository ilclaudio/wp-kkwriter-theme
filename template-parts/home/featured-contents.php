<?php
/**
 * KK Writer Theme: The featured contents in the Home Page oif the site.
 *
 * @package KK_Writer_Theme
 */

// BOX 1.
$opt_featured_1 = kkw_get_option( 'featured_content_1', 'kkw_opt_hp_layout' );
$fc1            = count( $opt_featured_1 ) > 0 ? $opt_featured_1[0] : null;
$fc1_id         = $fc1 && array_key_exists('box_content', $fc1 ) ? explode( ',', $fc1['box_content'] )[0] : null;
$fc1_img_side   = $fc1['box_image_side'];
$fc1            =  KKW_ContentsManager::get_wrapped_item( $fc1_id );

// BOX 2.
$opt_featured_2 = kkw_get_option( 'featured_content_2', 'kkw_opt_hp_layout' );
$fc2            = count( $opt_featured_2 ) > 0 ? $opt_featured_2[0] : null;
$fc2_id         = $fc2 && array_key_exists('box_content', $fc2 ) ? explode( ',', $fc2['box_content'] )[0] : null;
$fc2_img_side   = $fc2['box_image_side'];
$fc2            = KKW_ContentsManager::get_wrapped_item( $fc2_id );

// BOX 3.
$opt_featured_3 = kkw_get_option( 'featured_content_3', 'kkw_opt_hp_layout' );
$fc3            = count( $opt_featured_3 ) > 0 ? $opt_featured_3[0] : null;
$fc3_id         = $fc3 && array_key_exists('box_content', $fc3 ) ? explode( ',', $fc3['box_content'] )[0] : null;
$fc3_img_side   = $fc3['box_image_side'];
$fc3            = KKW_ContentsManager::get_wrapped_item( $fc3_id );
?>

<!-- FIRST ROW -->
<div id="fc_first_row" class="row mt-4 mb-1 fc-row">
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<div class="col p-4 d-flex flex-column position-static">
				<strong class="d-inline-block mb-2 text-primary-emphasis">
					<a href="#">Poesia</a>
					&nbsp;-&nbsp;
					<?php echo __( 'In evidence' ,'kk_writer_theme' ); ?>
				</strong>
				<h3 class="mb-0">
					<?php echo esc_attr( $fc1->title ); ?>
				</h3>
				<div class="mb-1 text-body-secondary">
					<?php echo esc_attr( $fc1->view_date ); ?>
				</div>
				<p class="card-text mb-auto">
					<?php echo esc_html( $fc1->description ); ?>
				</p>
				<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
					<?php echo __( 'Keep reading...' ,'kk_writer_theme' ); ?>
					<svg class="bi"><use xlink:href="#chevron-right"></use></svg>
				</a>
			</div>
			<div class="col-auto d-none d-lg-block">
				<svg class="bd-placeholder-img" width="200" height="250" 
					xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" 
					preserveAspectRatio="xMidYMid slice" focusable="false">
					<title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect>
					<text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
				</svg>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<div class="col p-4 d-flex flex-column position-static">
				<strong class="d-inline-block mb-2 text-success-emphasis">
					<a href="#">Saggistica</a>
					&nbsp;-&nbsp;
					<?php echo __( 'In evidence' ,'kk_writer_theme' ); ?>
				</strong>
				<h3 class="mb-0">
				<?php echo esc_attr( $fc2->title ); ?>
				</h3>
				<div class="mb-1 text-body-secondary">
					<?php echo esc_attr( $fc2->view_date ); ?>
				</div>
				<p class="mb-auto">
					<?php echo esc_html( $fc2->description ); ?>
				</p>
				<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
					<?php echo __( 'Keep reading...' ,'kk_writer_theme' ); ?>
					<svg class="bi"><use xlink:href="#chevron-right"></use></svg>
				</a>
			</div>
			<div class="col-auto d-none d-lg-block">
				<svg class="bd-placeholder-img" width="200" height="250"
					xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" 
					preserveAspectRatio="xMidYMid slice" focusable="false">
					<title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect>
					<text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
				</svg>
			</div>
		</div>
	</div>
</div>


<!-- SECOND ROW -->
<div id="fc_second_row" class="row mb-4 fc-row">
	<div class="col-md-6">
		<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
			<div class="col p-4 d-flex flex-column position-static">
				<strong class="d-inline-block mb-2 text-primary-emphasis">
					<a href="#">Poesia</a>
					&nbsp;-&nbsp;
					<?php echo __( 'In evidence' ,'kk_writer_theme' ); ?>
				</strong>
				<h3 class="mb-0">
					<?php echo esc_attr( $fc3->title ); ?>
				</h3>
				<div class="mb-1 text-body-secondary">
					<?php echo esc_attr( $fc3->view_date ); ?>
				</div>
				<p class="card-text mb-auto">
					<?php echo esc_html( $fc3->description ); ?>
				</p>
				<a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
					<?php echo __( 'Keep reading...' ,'kk_writer_theme' ); ?>
					<svg class="bi"><use xlink:href="#chevron-right"></use></svg>
				</a>
			</div>
			<div class="col-auto d-none d-lg-block">
				<svg class="bd-placeholder-img" width="200" height="250" 
					xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
					preserveAspectRatio="xMidYMid slice" focusable="false">
					<title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect>
					<text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
				</svg>
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