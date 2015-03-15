<?php
	if(preg_match_all('/\[gallery(.*?)?\]/', get_post($instance['post_id'])->post_content, $matches )){
		$attrs = array();
		if (count($matches[1])>0){
			foreach ($matches[1] as $m){
				$attrs[] = shortcode_parse_atts($m);
			}
		}
		if (count($attrs)> 0){
			foreach ($attrs as $attr){
				if (is_array($attr) && array_key_exists('ids', $attr)){
					$ids = $attr['ids'];
					break;
				}
			}
		}

		if (isset($ids)) {
			if (!wp_style_is('bootstrap_gallery_css')){
				wp_enqueue_style('bootstrap_gallery_css');
			}
			if (!wp_style_is('bootstrap_gallery_js')){
				wp_enqueue_script('bootstrap_gallery_js');
			}
?>
		<div class="hgallery">
			<div class="hgallery-entry clearfix" id="hgallery">
			<?php
				$ids = explode(',', $ids);
				foreach ( $ids as $i => $id ){
			?>
				<div class="hgallery-content">
					<?php echo wp_get_attachment_image($id, 'slide-thumb');?>
					<div class="hgallery-hover">
						<h4>&nbsp;</h4>
						<a href="<?php echo wp_get_attachment_url($id);?>">
							<?php echo wp_get_attachment_image($id);?>
						</a>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>


<?php } }?>