<?php
	$default = array(
		'category' => $category,
		'orderby' => $orderby,
		'numberposts' => $numberposts,
		'length' => $length
	);
	$list1 = get_posts($default);
	$i = 0;
?>
<div class="slideshows">
	<div class="slideshow">
		<ul class="slides">
			<?php foreach ( $list1 as $post ) {?>
			<li class="slide item<?php if( $i == 0 ) echo " active"; ?>">
				<?php echo get_the_post_thumbnail($post->ID,'slide-thumb');?>
				<div class="bg-img">
					<div class="bg-img-content">
						<h3><?php echo $post->post_title;?></h3>
						<p>
							<?php
								$text = strip_shortcodes( $post->post_content );
								$text = apply_filters('the_content', $text);
								$text = str_replace(']]>', ']]&gt;', $text);
								$content = wp_trim_words($text, $length);
								echo $content;
							?>
						</p>
					</div>
				</div>
				<a href="<?php echo get_permalink( $post->ID ); ?>" class="readmore"><?php _e('Read More','ya_theme');?></a>
			</li>
			<?php 
				$i++;
			}
			?>
		</ul>
	</div>
	<div class="slide-nav">
		<a href="#" class="carousel-control prev" id="prev_slider"><i class="icon-minus-sign"></i></a>
		<a href="#" class="carousel-control next" id="next_slider"><i class="icon-plus-sign"></i></a>
	</div>
</div>