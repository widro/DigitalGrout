<?php
$category    = isset( $instance['category'] )    ? $instance['category']            : 0;
$category_order = isset( $instance['category_order'] ) ? $instance['category_order']   : '';
$orderby     = isset( $instance['orderby'] )     ? strip_tags($instance['orderby']) : 'post_date';
$order       = isset( $instance['order'] )       ? strip_tags($instance['order'])   : 'ASC';
$numberposts = isset( $instance['numberposts'] ) ? intval($instance['numberposts']) : 5;
$filters = array(
		'numberposts' => $numberposts,
		'category' => $category,
		'orderby' => $orderby,
		'order' => $order
);

// settype($category ,'array');
if ( is_string($category_order) ){
	$category_order = preg_split('/[\s,]+/', $category_order, -1, PREG_SPLIT_NO_EMPTY);
}
$i = 0;
if ( count($category_order) )
foreach($category_order as $catid){
	$filters['category'] = $catid;
	$list = get_posts($filters);
	
	if( !empty($list) ) {		
	?>
	<div class="hpostfolio" id="postfolio-<?php echo $i+1;?>">
		<h2><?php echo get_cat_name($catid);?> <a href="<?php echo get_category_link( $catid); ?> " class="seemore"><?php _e('See all', 'ya_theme');?></a></h2>
		<div class="hpostfolio-entry clearfix">
			<?php
				foreach( $list as $post ){
			?>
			<div class="postfolio-content">
				<h5><a href="<?php echo get_category_link($catid);?>"><?php  echo get_cat_name($catid); ?></a></h5>
				<div class="img-postfolio">
					<?php echo get_the_post_thumbnail($post->ID,'thumbnail');?>
				</div>
				<p><?php echo $post->post_title; ?></p>
				<div class="postfolio-hover">
					<a href="<?php  echo get_permalink( $post->ID ); ?>"><?php _e('Read more', 'ya_theme');?></a>
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>
<?php
	}
	$i++;
}
?>