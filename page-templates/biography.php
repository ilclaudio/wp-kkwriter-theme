<?php
/**
 * Template Name: biography
 *
 * KK Writer Theme: The BIOGRAPHY page.
 *
 * @package KK_Writer_Theme
 */

global $post;
get_header();
$kkw_section             = $post->post_title;
$kkw_section_description = '';
$kkw_prologue            = KKW_ContentsManager::get_page_prologue( $post->ID );
$kkw_epilogue            = KKW_ContentsManager::get_page_epilogue( $post->ID );
$kkw_quote               = KKW_ContentsManager::get_page_quote( $post->ID );
$kkw_image_wrapper       = KKW_ContentsManager::wrap_featured_image( $post, 'large' );
?>

<main class="container">

	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<!-- BODY -->
	<div class="container mt-2">

		<!-- BANNER -->
			<section class="row mb-2 py-4 primary-bg">
				<h1><?php echo esc_html( $kkw_section ); ?></h1>
				<?php
				if ( $kkw_section_description ) {
					?>
				<div class="col-12">
					<div class="form-group col text-left mb-2">
					<?php echo wp_kses_post( $kkw_section_description ); ?>
					</div>
				</div>
					<?php
				}
				?>
		</section>

		<!-- QUOTES, if present -->
		<?php
		if ( $kkw_quote ) {
			?>
		<section class="row pt-2 mb-2">
			<div class="col-md-12 m-0 p-0">
				<div class="px-3 py-0 bg-light border rounded text-end">
						<blockquote class="blockquote">
								<p class="mb-0">
									<?php echo wp_kses_post( wpautop( $kkw_quote ) ); ?>
								</p>
						</blockquote>
				</div>
			</div>
		</section>
			<?php
		}
		?>

		<!-- PROLOGUE, if present -->
		<?php
		if ( $kkw_prologue ) {
			?>
				<section class="row py-2 mb-5 px-5">
					<div class="col-md-12 m-0 p-0">
					<?php echo wp_kses_post( wpautop( $kkw_prologue ) ); ?>
					</div>
				</section>
			<?php
		}
		?>

		<!-- CONTENT of the page -->
		<div class="row">
			<aside class="col-md-3 border-end mb-5 text-center my-3 kkw_img_contacts">

				<!-- Post featured image -->
					<img src="<?php echo esc_url( $kkw_image_wrapper->src ); ?>"
							class="card-img-top img-fluid"
							style="max-height: 80%"
							alt="<?php echo esc_attr( $kkw_image_wrapper->alt ); ?>">

				<div class="text-left mt-5">
					<?php get_template_part( 'template-parts/common/social-footer' ); ?>
				</div>

			</aside>

			<section class="col-md-9 my-3">
				<!-- CONTACT FORM SECTION-->
				<div id="kkw_contact_form_id">
					<?php the_content(); ?>
				</div>
			</section>

		</div>

		<!-- EPILOGUE, if present -->
		<?php
		if ( $kkw_epilogue ) {
			?>
				<section class="row py-2 mt-2 mb-5 px-5">
					<div class="col-md-12 m-0 p-0">
					<?php echo wp_kses_post( wpautop( $kkw_epilogue ) ); ?>
					</div>
				</section>
			<?php
		}
		?>

	</div>



</main>


<?php
get_footer();
