<?php 
	$default = array(
		'category' => $category,
		'numberposts' => $numberposts,
	);
	
	$list3 = get_posts($default);
?>
<div class="sidebar-yaposts">
	<ul class="widget-latest">
		<?php foreach($list3 as $post){ ?>
		<li class="clearfix">
			<div class="latest-left">
				<?php if (has_post_thumbnail($post->ID)){?>
					<a href="<?php echo get_permalink($post->ID);?>"><?php echo get_the_post_thumbnail($post->ID,'thumbnail');?></a>
				<?php }else{?>
					<a href="<?php echo get_permalink($post->ID);?>"><img src="<?php bloginfo('template_url');?>/assets/img/no-thumbnail.png" width="300" height="200" alt="No Thumb"/></a>
				<?php } ?>
			</div>
			<div class="latest-right">
				<h5><a href="<?php echo get_permalink($post->ID);?>"><?php echo $post->post_title;?></a></h5>
				<div class="meta">
					<span class="hblog-time"><?php echo get_the_time('F j, Y', $post->ID );?></span>
				</div>
			</div>
		</li>
		<?php
			}
		?>
	</ul>
</div>