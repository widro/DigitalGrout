<?php $display_logo_image = ya_options()->sitelogo;?>
<?php $display_bg_image = ya_options()->bg_header;?>
<header id="header" class="header" <?php if($display_bg_image){ ?> style="background: url(<?php echo $display_bg_image; ?>) no-repeat center top;" <?php } ?>>
	<div class="container">
		<div class="header-inner clearfix">
			<div class="logo">
			<?php if ($display_logo_image){?>
				<div class="logo-inner">
					<a href="<?php echo site_url() ?>"><img src="<?php echo $display_logo_image; ?>" alt="<?php bloginfo('name'); ?>"></a>
				</div>
			<?php }?>
			</div>
			<div class="search">
				<?php get_template_part('templates/searchform'); ?>
			</div>
		</div>
		<?php if(has_nav_menu('primary_menu')):?>
			<div class="header-menu navbar clearfix">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse-main">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="nav-collapse nav-collapse-main collapse">
					<div class="lavalamp">
						<?php wp_nav_menu(array('theme_location' => 'primary_menu', 'menu_class' => 'nav')); ?>
						<div class="floatr"></div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		<?php endif;?>
	</div>
<?php if(is_front_page()) : ?>
	<?php if( is_active_sidebar( 'slideshow' )) :?>
		<section id="masthead">
			<div class="container">
				<?php dynamic_sidebar( 'slideshow' );?>
			</div>
		</section>
	<?php endif;?>
<?php endif;?>
</header>