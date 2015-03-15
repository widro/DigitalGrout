<section id="main">
	<div class="container">
		<div class="category-page">
			<div class="row">
				<section class="span12">
					<?php
					if (!is_front_page() && function_exists('yoast_breadcrumb')){
						yoast_breadcrumb('<div class="breadcrumb">', '</div>');
					}
					$format = have_posts() ? get_post_format() : false;
					get_template_part('templates/content', $format);
				 	?>
				</section>
			</div>
		</div>
	</div>
</section>