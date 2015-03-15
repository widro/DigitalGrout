<div class="blog-entry">
	<div class="row">
		<div class="span4">
			<div id="myCarousel<?php the_ID();?>" class="carousel slide post-img">
				<div class="carousel-inner">
				<?php
					$contents = get_the_content();
					if(preg_match_all('/\[gallery(.*?)?\]/', $contents, $matches)){
						$attrs = array();
						if (count($matches[1])>0){
							foreach ($matches[1] as $m){
								$attrs[] = shortcode_parse_atts($m);
							}
						}
						if (count($attrs) >0) {
							$ids = array();
							$ids = explode(',', $attrs[0]['ids']);
							foreach ( $ids as $i => $id ){
					?>
					<div class="item <?php if($i==0){echo "active";}?>">
						<img src="<?php echo wp_get_attachment_url($id);?>" alt="<?php the_title();?>"/>
					</div>
				<?php 
						}
					}				
				?>
				</div>
				<div class="post-nav">
					<a class="carousel-control left" href="#myCarousel<?php the_ID();?>" data-slide="prev"><i class="icon-circle-arrow-left"></i></a>
					<a class="carousel-control right" href="#myCarousel<?php the_ID();?>" data-slide="next"><i class="icon-circle-arrow-right"></i></a>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="span5">
			<div class="blog-entry-detail">
				<div class="blog-title clearfix">
					<i class="icon-camera icon-sign"></i>
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
	</div>
</div> 