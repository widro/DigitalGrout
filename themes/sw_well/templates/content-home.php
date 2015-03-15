<?php !is_front_page() && get_template_part('templates/page', 'header'); ?>
<?php is_active_sidebar('sidebar-home') && dynamic_sidebar('sidebar-home');?>
