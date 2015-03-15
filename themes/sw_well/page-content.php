<?php
/*
Template Name: Page Content
*/
?>
<section id="main">
	<div class="container">
		<?php 
			if (!is_front_page() && function_exists('yoast_breadcrumb')){
				yoast_breadcrumb('<div class="breadcrumb">', '</div>');
			}
		 	?>
		 	<div class="page-content">
		 	<?php get_template_part('templates/content', 'page'); ?>
			</div>
	</div>
</section>