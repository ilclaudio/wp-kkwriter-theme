<?php
/**
 * KK Writer Theme: The "poetry section" page.
 *
 * @package KK_Writer_Theme
 */
?>
<?php
get_header();
$section             = __( 'Poetry' , 'kk_writer_theme' );
$section_description = '';
?>


<main class="container">
	<!-- BREADCRUMB -->
	<?php get_template_part( 'template-parts/common/breadcrumb' ); ?>

	<!-- BODY -->
	<div class="container mt-2">

		<!-- BANNER -->
		<section class="row mb-4 py-4 primary-bg">
			<h1><?php echo $section; ?></h1>
			<?php
				if ( $section_description ){
			?>
			<div class="col-12">
				<div class="form-group col text-left mb-2">
				<?php echo $section_description; ?>
				</div>
			</div>
			<?php
				}
			?>
		</section>

		<!-- search filters and results -->
		<div class="row pt-4">

			<!-- FILTERS -->
			<aside class="col-12  col-lg-2 border-end mb-5">
				<h5 class="text-uppercase border-bottom"><?php echo __( 'Order results' , 'kk_writer_theme' ); ?></h5>
				<div class="row dropdown p-0 m-0">
					<button class="btn dropdown-toggle p-0 m-0" type="button" 
						data-bs-toggle="dropdown" aria-expanded="false">
						<?php echo __( 'Order results by...' , 'kk_writer_theme' ); ?>
					</button>
					<ul class="dropdown-menu font-smaller text-left">
						<li><a class="dropdown-item" href="#"><?php echo __( 'Title ascending' , 'kk_writer_theme' ); ?></a></li>
						<li><a class="dropdown-item" href="#"><?php echo __( 'Title descending' , 'kk_writer_theme' ); ?></a></li>
						<li><a class="dropdown-item" href="#"><?php echo __( 'Publication year ascending' , 'kk_writer_theme' ); ?></a></li>
						<li><a class="dropdown-item" href="#"><?php echo __( 'Publication year descending' , 'kk_writer_theme' ); ?></a></li>
					</ul>
				</div>	
			</aside>

			<!-- SECTION BOOKS -->
			<section class="col-md-10">
				<div class="row mt-5">
					<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
						<div class="card h-100">
							<img src="path/to/image1.jpg" class="card-img-top" alt="Severino Boezio - La consolazione di Filosofia">
							<div class="card-body">
								<h5 class="card-title">Severino Boezio</h5>
								<p class="card-text text-danger">La consolazione di Filosofia</p>
								<p class="card-text">2023</p>
								<p class="card-text">Casa Editrice</p>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
						<div class="card h-100">
							<img src="path/to/image2.jpg" class="card-img-top" alt="Giovanni Pico della Mirandola - La dignità dell'uomo">
							<div class="card-body">
								<h5 class="card-title">Giovanni Pico della Mirandola</h5>
								<p class="card-text text-danger">La dignità dell'uomo</p>
								<p class="card-text">2021</p>
								<p class="card-text">Casa Editrice</p>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
						<div class="card h-100">
							<img src="path/to/image2.jpg" class="card-img-top" alt="Giovanni Pico della Mirandola - La dignità dell'uomo">
							<div class="card-body">
								<h5 class="card-title">Giovanni Pico della Mirandola</h5>
								<p class="card-text text-danger">La dignità dell'uomo</p>
								<p class="card-text">2021</p>
								<p class="card-text">Casa Editrice</p>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
						<div class="card h-100">
							<img src="path/to/image2.jpg" class="card-img-top" alt="Giovanni Pico della Mirandola - La dignità dell'uomo">
							<div class="card-body">
								<h5 class="card-title">Giovanni Pico della Mirandola</h5>
								<p class="card-text text-danger">La dignità dell'uomo</p>
								<p class="card-text">2021</p>
								<p class="card-text">Casa Editrice</p>
							</div>
						</div>
					</div>
				</div>
			</section>

		</div>
		



	</div>

</main>


<?php get_footer(); ?>