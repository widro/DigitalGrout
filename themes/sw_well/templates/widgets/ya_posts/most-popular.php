<?php $commented = array(
	'orderby'	  => 'comment_count',
	'numberposts' => $numberposts
	);
	$list2 = get_posts($commented);
?>
<div class="sidebar-yaposts">
	<ul class="widget-popular">
		<?php foreach($list2 as $post){ ?>
		<li class="clearfix">
			<div class="popular-left">
				<span><?php echo $post-> comment_count;?></span>
			</div>
			<div class="popular-right">
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