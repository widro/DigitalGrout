<?php
		$display_logo_image = ya_options()->sitelogo;
		$fb = ya_options()->social_url_facebook;
		$tw = ya_options()->social_url_twitter;
		$gg = ya_options()->social_url_google_plus;
		$ln = ya_options()->social_url_linkedin;
		$pt = ya_options()->social_url_pinterest;
?>
<footer class="footer" role="contentinfo">
	<div class="footer-top">
		<div class="container">
			<div class="navbar clearfix">
				<?php if(has_nav_menu('footer_menu')): ?>
				<div class="footer-menu">
					<?php wp_nav_menu(array('theme_location' => 'footer_menu', 'menu_class' => 'nav')); ?>
				</div>
				<?php endif; ?>
				<div class="footer-social">
					<?php if($fb !== ""){?><a href="<?php echo $fb; ?>" target="_blank" title="Facebook"><span class="icon-facebook icon-large"></span></a><?php }?>
					<?php if($tw !== ""){?><a href="<?php echo $tw; ?>" target="_blank" title="Twitter"><span class="icon-twitter icon-large"></span></a><?php }?>
					<?php if($ln !== ""){?><a href="<?php echo $ln; ?>" target="_blank" title="Linkedin"><span class="icon-linkedin icon-large"></span></a><?php }?>
					<?php if($gg !== ""){?><a href="<?php echo $gg; ?>" target="_blank" title="Google plus"><span class="icon-google-plus icon-large"></span></a><?php }?>
					<?php if($pt !== ""){?><a href="<?php echo $pt; ?>" target="_blank" title="Pinterest"><span class="icon-pinterest icon-large"></span></a><?php }?>
				</div>
			</div>
		</div>
	</div>
	<?php if(is_active_sidebar('footer')):?>
	<div class="container">
		<div class="row">
			<?php dynamic_sidebar('footer');?>
		</div>
		<?php endif;?>
		<div class="clearfix"></div>
		<div class="footer-copyright">
			<p>&nbsp;</p>
			<p>&nbsp;</p>
		</div>
	</div>
</footer>