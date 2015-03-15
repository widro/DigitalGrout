<?php
/*
Template Name: Page with Sidebar
*/
?>
<section id="main">
	<div class="container">
		<?php 
			$layout = ya_options()->theme_layout;
			$show_left = $layout =='sm';
			$show_right = $layout == 'ms';
		?>
		<div class="row">
			<?php if ( $show_left) get_template_part('templates/sidebar');?>
			<section class="<?php echo ya_main_class(); ?>">
					<div class="page-sidebar">
					<?php 
					if (!is_front_page() && function_exists('yoast_breadcrumb')){
						yoast_breadcrumb('<div class="breadcrumb">', '</div>');
					}
					?>
					<?php 
						if (!is_front_page()) {
							get_template_part('templates/page', 'header'); 
						}						
						get_template_part('templates/content', 'page'); ?>
					</div>
			</section>
			<?php if ( !$show_left) get_template_part('templates/sidebar');?>
		</div>
	</div>
</section>