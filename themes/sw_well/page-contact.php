<?php
/*
Template Name: Page Contact
*/
?>
<section id="main">
	<div class="container">
		<?php 
			if (!is_front_page() && function_exists('yoast_breadcrumb')){
				yoast_breadcrumb('<div class="breadcrumb">', '</div>');
			}
		 	?>
		 	<div class="page-contact">
		 	<?php 
			if (!is_front_page()) {
				get_template_part('templates/page', 'header'); 
			}
			
			get_template_part('templates/content', 'page'); 
		?>
				<div class="contact">
					<div class="contact-content">
						<?php echo do_shortcode('[contact-form-7 title="Contact Us"]'); ?>
					</div>
				</div>
			</div>
	</div>
</section>