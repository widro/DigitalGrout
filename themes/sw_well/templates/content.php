<?php !is_front_page() && get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
<?php get_template_part('templates/no-results'); ?>
<?php endif; ?>
<div class="category-entry clearfix">
	<?php while (have_posts()) : the_post(); ?>
		<div class="cat-content">
			<div id="post-<?php the_ID();?>" <?php post_class(); ?>>
				<div class="cat-img">
					<?php the_post_thumbnail(); ?>
					<div class="readmore">
						<a href="<?php the_permalink(); ?>"> </a>
					</div>
				</div>
				<h5><?php the_title(); ?></h5>
			</div>
		</div>
	<?php endwhile; ?>
</div>
<?php get_template_part('templates/pagination'); ?>
