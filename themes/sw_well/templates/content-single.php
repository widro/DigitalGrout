<section id="main">
	<div class="container entry-content">
		<div class="row">
			<section class="span12">
				<?php
					if (function_exists('yoast_breadcrumb')){
						yoast_breadcrumb('<div class="breadcrumb">', '</div>');
					}?>
				<?php if(have_posts()):?>
				<?php  while (have_posts()) : the_post(); ?>
					<div class="clearfix"></div>
					<div id="post-<?php the_ID();?>" <?php post_class(); ?>>
						<div class="single-category clearfix">
							<div class="content-left">
								<?php get_template_part('templates/feature-slide'); ?>
							</div>
							<div class="content-right">
								<h1><?php the_title(); ?></h1>
								<div class="excerpt">
									<?php the_excerpt(); ?>
								</div>
								<?php
									$tab_titles = get_post_meta( $post->ID, 'custom_tab_title' );
									if( $tab_titles ){
										$tab_content = get_post_meta( $post->ID, 'custom_tab_content' );
								?>
								<div class="tabbable"> <!-- Only required for left/right tabs -->
									<ul class="nav nav-tabs">
									<?php foreach($tab_titles as $i => $title){?>
										<li<?php if( $i == 0 ){echo ' class="active"';}?>><a href="#tab<?php echo $i; ?>" data-toggle="tab"><?php echo $title; ?></a></li>
									<?php }?>
									</ul>
									<div class="tab-content">
									<?php foreach($tab_titles as $i => $title){?>
										<?php if( isset($tab_content[$i]) ){ ?>
										<div class="tab-pane <?php if( $i == 0 ){echo ' active';}?>" id="tab<?php echo $i; ?>">
											<?php echo $tab_content[$i]; ?>
										</div>
									<?php } }?>
									</div>
								</div>
								<?php
									}
								?>
							</div>
						</div>
						<div class="clearfix"></div>
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
						<div class="product-relate">
							<?php
								global $post;
								$categories = get_the_category($post->ID);
								$category_ids = array();
								foreach($categories as $individual_category) {$category_ids[] = $individual_category->term_id;}
								if ($categories) {
							?>
							<h3><span><?php _e('Related Products','ya_theme')?></span></h3>
							<div class="relate-detail">
								<div class="category-entry clearfix">
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
									<div class="cat-content">
										<div id="post-<?php the_ID();?>" <?php post_class(); ?>>
											<div class="cat-img">
												<?php the_post_thumbnail(); ?>
												<div class="readmore">
													<a href="<?php the_permalink(); ?>"> </a>
												</div>
											</div>
											<h5><?php the_title(); ?></h5>
										</div>
									</div>
									<?php
										endwhile;
										wp_reset_query();
									?>
								</div>
							</div>
							<?php }?>
						</div>
						<div class="clearfix"></div>
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
		</div>
	</div>
</section>