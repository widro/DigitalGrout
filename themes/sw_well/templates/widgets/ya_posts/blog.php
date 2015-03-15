<?php
	$default = array(
		'category' => $category,
		'orderby' => $orderby,
		'numberposts' => $numberposts,
		'length' => $length
	);
	
	$list = get_posts($default);
	$count = count($list);
?>
<div class="hblog">
	<h2><?php echo get_cat_name($category);?></h2>
	<div class="hblog-content clearfix">
	<?php for($i = 0; $i < $count; $i++) {	?>
	<?php
		if( $i == 0 ){
	?>
		<div class="hblog-left">
			<h4><?php _e( 'Latest from the blog', 'ya_theme' );?></h4>
			<div class="blogleft-content">
				<h4><a href="<?php echo get_permalink($list[$i]->ID);?>"><?php echo $list[$i]->post_title;?></a></h4>
				<div class="meta">
					<span class="hblog-time"><?php echo get_the_time('F j, Y', $list[$i]->ID );?></span> - 
					<span class="hblog-comment"><?php if($list[$i]->comment_count <= 1){echo $list[$i]->comment_count.' Comment';}else{echo $list[$i]->comment_count.' Comments';}?></span>
				</div>
				<p>
					<?php
						$text = strip_shortcodes( $list[$i]->post_content );
						$text = apply_filters('the_content', $text);
						$text = str_replace(']]>', ']]&gt;', $text);
						$content = wp_trim_words($text, $length);
						echo $content;
					?>
				</p>
				<a href="<?php echo get_permalink($list[$i]->ID);?>" class="readmore"><?php _e('Read more', 'ya_theme');?></a>
			</div>
		</div>
	<?php } else {?>
		<div class="hblog-right">
			<h4><?php _e('More recent posts', 'ya_theme');?></h4>
			<ul>
				<?php for( $i = 1; $i< $count; $i++) {?>
				<li>
					<h4><a href="<?php echo get_permalink($list[$i]->ID);?>"><?php echo $list[$i]->post_title;?></a></h4>
					<div class="meta">
						<span class="hblog-time"><?php echo get_the_time('F j, Y', $list[$i]->ID );?></span> - 
						<span class="hblog-comment"><?php if($list[$i]->comment_count <= 1){echo $list[$i]->comment_count.' Comment';}else{echo $list[$i]->comment_count.' Comments<';}?></span>
					</div>
				</li>
				<?php }?>
			</ul>
			<a href="<?php echo get_category_link($category);?>" class="readmore"><?php _e('Read My Blog', 'ya_theme');?></a>	
		</div>
	<?php 
		}
	}
	?>
	</div>
</div>