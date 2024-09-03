<?php
/**
 * KK Writer Theme: The footer of the site.
 *
 * @package KK_Writer_Theme
 */
?>

	<div class="container">

		<!-- PRIMARY FOOTER -->
		<?php
			get_template_part(
				'template-parts/footer/primary-footer',
				false,
				array(),
			);
		?>

		<!-- SECONDARY FOOTER -->
		<?php
			get_template_part(
				'template-parts/footer/secondary-footer',
				false,
				array(),
			);
		?>

		<?php wp_footer(); ?>
	</div>

</body>
</html>
