<?php
	$primary_span_class = 'span'.ya_options()->sidebar_primary_expand;
?>
<aside id="sidebar-blog" class="sidebar <?php echo $primary_span_class; ?>">
	<?php dynamic_sidebar('primary'); ?>
</aside>

