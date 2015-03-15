<section id="main" class="blog-page">
	<div class="container">
		<?php if (!have_posts()) : ?>
		<?php get_template_part('templates/no-results'); ?>
		<?php endif; ?>
		<div class="row">
			<section class="span12">
				<?php if (!is_front_page() && function_exists('yoast_breadcrumb')){
					yoast_breadcrumb('<div class="breadcrumb">', '</div>');
				}?>
				<?php !is_front_page() && get_template_part('templates/page', 'header'); ?>
				<div class="gallery-entry clearfix">
				<?php while (have_posts()) : the_post(); ?>
					<div class="gallery-content">
						<div id="post-<?php the_ID();?>" <?php post_class(); ?>>
							<div class="cat-img">
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
								?>
								<div id="myCarousel<?php the_ID();?>" class="carousel slide post-img">
									<div class="carousel-inner">
										<?php foreach ( $ids as $i => $id ){ ?>
										<div class="item <?php if($i==0){echo "active";}?>">
											<img src="<?php echo wp_get_attachment_url($id);?>" alt="<?php the_title();?>"/>
										</div>
									<?php 
										}
									?>
									</div>
									<div class="post-nav">
										<a class="carousel-control left" href="#myCarousel<?php the_ID();?>" data-slide="prev"><i class="icon-circle-arrow-left"></i></a>
										<a class="carousel-control right" href="#myCarousel<?php the_ID();?>" data-slide="next"><i class="icon-circle-arrow-right"></i></a>
									</div>
								</div>
								<?php
									}
								}else{
									the_post_thumbnail();
								}
								?>
							</div>
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
				<?php get_template_part('templates/pagination'); ?>
			</section>
	</div>
	</div>
</section>
