<?php if (!have_posts()) : ?>
	<div class="alert alert-block fade in">
		<a class="close" data-dismiss="alert">&times;</a>
		<p><?php _e('Sorry, no results were found.', 'ya_theme'); ?></p>
	</div>
	<div class="search">
		<?php get_search_form(); ?>
	</div>
<?php endif; ?>