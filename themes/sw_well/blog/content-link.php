<div class="single-meta">
	<i class="icon-camera icon-sign"></i>
	<h1><?php the_content();?></h1>
	<?php get_template_part('templates/entry-meta');?>
	<?php echo get_the_tag_list('<p>Tags: ','&nbsp;&nbsp;&nbsp;','</p>');?>
</div>