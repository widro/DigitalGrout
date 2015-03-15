<section id="main" class="front-page">
	<div class="container">
		<?php if (is_home()){ ?>
			<div class="row">
				<section class="span12">
					<?php get_template_part('templates/content', 'home'); ?>
				</section>
			</div>
		<?php } else{
				get_template_part('page');
			 }
		?>
	</div>
</section>