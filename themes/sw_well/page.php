<section id="main">
	<div class="container">
		<?php 
			if (!is_front_page() && function_exists('yoast_breadcrumb')){
				yoast_breadcrumb('<div class="breadcrumb">', '</div>');
			}
		 	?>
		 	<div class="page-default">
		 	<?php 
			if (!is_front_page()) {
				get_template_part('templates/page', 'header'); 
			}
			
			get_template_part('templates/content', 'page'); 
		?></div>
	</div>
</section>