<section id="main">
	<div class="container entry-content">
		<?php 
		$layout = ya_options()->theme_layout;
		$show_left = $layout =='sm';
		$show_right = $layout == 'ms';
		?>
		<div class="row">
			<?php if ( $show_left) get_template_part('templates/sidebar'); ?>
			<section class="<?php echo ya_main_class(); ?>">
				<?php 
					if (function_exists('yoast_breadcrumb')){
						yoast_breadcrumb('<div class="breadcrumb">', '</div>');
					}?>
				<?php if(have_posts()):?>
				<?php  while (have_posts()) : the_post(); ?>
					<div id="post-<?php the_ID();?>" <?php post_class(); ?>>
						<?php get_template_part('blog/content', get_post_format());	?>
						<div class="post-in"> <?php _e('Posted: ', 'ya_theme'); ?> <?php the_author_posts_link(); ?></div>
						<div class="single-social">
							<span class='st_facebook_hcount' displayText='Facebook'></span>
							<span class='st_twitter_hcount' displayText='Tweet'></span>
							<span class='st_tumblr_hcount' displayText='Tumblr'></span>
							<span class='st_pinterest_hcount' displayText='Pinterest'></span>
							<script type="text/javascript">stLight.options({publisher: "c7413270-c926-4c1b-8a70-77cd460c3982", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
						</div>
						 <?php wp_link_pages(array('before' => '<nav class="pagination"> <span>Pages: </span>', 'after' => '</nav>')); ?>
						<div class="post-navigation">
							<ul class="clearfix">
								<?php if (get_previous_post()) : ?>
									<li class="prev"><?php previous_post_link( '%link', __( ' Prev', 'root' ) ); ?></li>
								 <?php else: ?>
					
								<?php endif; ?>
								<?php if (get_next_post()) : ?>
									<li class="next"><?php next_post_link( '%link', __( 'Next ', 'root' ) ); ?></li>     
								<?php else: ?> 
								 <?php endif; ?>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="single-relate">
							<?php 
								global $post;
								$categories = get_the_category($post->ID);								
								$category_ids = array();
								foreach($categories as $individual_category) {$category_ids[] = $individual_category->term_id;}
								if ($categories) {
							?>
							<h3><span><?php _e('Related Posts','ya_theme')?></span></h3>
							<div class="relate-content clearfix">
								<?php
									  $args=array(
										'category__in' => $category_ids,
										'post__not_in' => array($post->ID),
										'showposts'=> 4,
										'orderby'	=> 'rand',	
										'ignore_sticky_posts'=> 1
									   );
									$related_term = new WP_Query($args);
									while($related_term -> have_posts()):$related_term -> the_post();
								?>
									<div class="relate-detail">
										<div class="relate-img" onclick="window.location='<?php the_permalink();?>';">
											<?php if (has_post_thumbnail()){?>
												<a href="<?php the_permalink();?>"><?php the_post_thumbnail('thumbnail');?></a>
											<?php }else{?>
												<a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_url');?>/assets/img/no-thumbnail.png" alt="No Thumb"/></a>
											<?php } ?>
											<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
										</div>
									</div>								
									<?php
										endwhile;
										wp_reset_query();
									?>
							</div>
							<?php }?>
						</div>
						<?php ob_start(); ?>
						<div class="comment-post clearfix">
							<?php comments_template('/templates/comments.php'); ?>
						</div>
						<?php $comment_tpl = ob_get_contents(); ob_end_clean(); ?>
						<?php echo $comment_tpl; ?>
					</div>
				<?php endwhile; ?>
				<?php else : ?>
							<?php get_template_part('templates/no-results'); ?>
						<?php endif; ?>

			</section>
			<?php if ( !$show_left) get_template_part('templates/sidebar'); ?>
		</div>
	</div>
</section>