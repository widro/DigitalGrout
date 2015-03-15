<section id="main">
	<div class="container">
		<?php 
			$layout = ya_options()->theme_layout;
			$show_left = $layout =='sm';
			$show_right = $layout == 'ms';
		?>
		<div class="row">
			<?php if ( $show_left) get_template_part('templates/sidebar'); ?>
			<section class="<?php echo ya_main_class(); ?>">
				<?php 
					if (function_exists('yoast_breadcrumb')){
						yoast_breadcrumb('<div class="breadcrumb">', '</div>');
					}
					if (!is_front_page()) {
						get_template_part('templates/page', 'header');
					}
					?>
					
					<?php if (!have_posts()) : ?>
					<?php get_template_part('templates/no-results'); ?>
					<?php endif; ?>

					<?php while (have_posts()) : the_post(); ?>

						<div id="post-<?php the_ID();?>" <?php post_class(); ?>>
							<?php 
								$format = get_post_format();
								get_template_part( 'blog/postformat', $format );
							?>
						</div>
					<?php endwhile; ?>
					<?php get_template_part('templates/pagination'); ?>
			</section>
			<?php if ( !$show_left) get_template_part('templates/sidebar'); ?>
		</div>
	</div>
<section>