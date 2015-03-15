<?php if(has_post_thumbnail()){?>
	<div class="single-img">
		<?php the_post_thumbnail();	?>
	</div>
<?php }?>
<div class="single-meta">
	<i class="icon-edit-sign"></i>
	<h1><?php the_title();?></h1>
	<?php get_template_part('templates/entry-meta');?>
	<?php echo get_the_tag_list('<p>Tags: ','&nbsp;&nbsp;&nbsp;','</p>');?>
</div>
<div class="single-content">
	<?php the_content();?>
</div>