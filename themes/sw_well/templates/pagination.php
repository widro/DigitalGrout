<?php if ($wp_query->max_num_pages > 1) : ?>
	<?php global $paged;?>
	<div class="pagination nav-pag">
		<ul>
		<?php if (get_previous_posts_link()) : ?>
			<li class="pagination page-prev"><?php previous_posts_link(__('Prev', 'roots')); ?></li>
		<?php else: ?>
		<?php endif; ?>
      
		<?php 
      	if ($paged < 3){
      		$i = 1;
      	} elseif ($paged < $wp_query->max_num_pages - 2){
      		$i = $paged -1 ;
      	} else {
      		$i = $wp_query->max_num_pages - 3;
      	}
	
		if ($wp_query->max_num_pages > $i + 3){
			$max = $i + 2;
		} else $max = $wp_query->max_num_pages;
		 if ($paged > 3 && $wp_query->max_num_pages > 4) { ?>
                <li><a href="<?php echo get_pagenum_link('1')?>">1</a></li>
                        <li ><a>...</a></li>
                    <?php }
      		for ($i; $i<= $max ; $i++){
				if (($paged == $i) || ( $paged ==0 && $i==1)) { ?>
      			<li class="disabled"><a><?php echo $i?></a></li>
      		<?php } else { ?>
      			<li><a href="<?php echo get_pagenum_link($i)?>"><?php echo $i?></a></li>
      		<?php }
      		} ?>
      	
      		<?php if ($max < $wp_query->max_num_pages) { ?>
      				<li ><a>...</a></li>
      				<li><a href="<?php echo get_pagenum_link($wp_query->max_num_pages)?>"><?php echo $wp_query->max_num_pages?></a></li>
      			<?php } ?>
      		
				<?php if (get_next_posts_link()) : ?>
        		<li class="pagination page-next"><?php next_posts_link(__('Next', 'roots')); ?></li>
		<?php else: ?>
			
		<?php endif; ?>
		</ul>
	</div>
<?php endif; ?>
<!--End Pagination-->