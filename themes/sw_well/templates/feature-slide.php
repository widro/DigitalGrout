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
<div id="featurepost-<?php the_ID();?>" class="featurepost carousel slide">
<!-- Carousel items -->
	<div class="carousel-inner">
	<?php foreach ( $ids as $i => $id ){ ?>
		<div class="item<?php if($i==0){echo " active";}?>">
			<img src="<?php echo wp_get_attachment_url($id);?>" alt="<?php the_title();?>"/>
		</div>
	<?php
		}
	?>
	</div> 
	<div class="carousel-indicators">
		<?php foreach ( $ids as $i => $id ){ ?>
			<span data-target="#featurepost-<?php the_ID();?>" data-slide-to="<?php echo $i;?>" 
				<?php if ($i == 0) { echo "class='active'";	} ?>>
			</span>
		<?php } ?>
	</div>									
</div>
<?php  
	} 
}
else{ ?>
<div class="slide">
	<?php the_post_thumbnail(); ?>
</div>
<?php
}
?>