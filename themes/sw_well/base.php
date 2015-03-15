<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
<?php if(!is_404()):?>
	<!--[if lt IE 7]><div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</div><![endif]-->

	<?php do_action('get_header'); ?>
	<div class="body">
		<?php get_template_part('templates/header'); ?>
		
		<?php include ya_template_path(); ?>
				
		<?php get_template_part('templates/footer'); ?>
	</div>
	<?php wp_footer(); ?>
<?php else :?>
<?php get_template_part('404');?>
<?php endif;?>
</body>
</html>