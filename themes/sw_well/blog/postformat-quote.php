<div class="blog-entry">
	<div class="blog-entry-detail">
		<div class="blog-title clearfix">
			<i class="icon-quote-left icon-sign"></i>
			<h3>
				<a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
			</h3>
		</div>
		<?php get_template_part('templates/entry-meta'); ?>
		<?php the_excerpt();?>
		<div class="blog-meta">
			<div class="post-in"> <?php _e('Posted: ', 'ya_theme'); ?> <?php the_author_posts_link(); ?></div>
			<div class="readmore"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e('Readmore', 'ya_theme'); ?></a></div>
		</div>
	</div>
</div> 