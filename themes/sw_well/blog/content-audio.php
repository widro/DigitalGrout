<div class="single-meta">
	<i class="icon-volume-up icon-sign">
	<h1></i><?php the_title();?></h1>
	<?php get_template_part('templates/entry-meta');?>
	<?php echo get_the_tag_list('<p>Tags: ','&nbsp;&nbsp;&nbsp;','</p>');?>
</div>
<div class="single-content">
	<?php the_content();?>
</div>