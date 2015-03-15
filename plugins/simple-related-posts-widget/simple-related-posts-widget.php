<?php
/***************************************************************
	Plugin Name: Simple Related Posts Widget
	Plugin URI: http://www.stancuflor.in/simple-related-posts-widget-wordpress.html
	Description: A simple wordpress plugin that displays articles from the same category.
	Author: Stancu Florin
	Version: 1.0
	Author URI: http://www.stancuflor.in
****************************************************************/

function cutname($txt, $len) {
	return (strlen($txt) > $len ? substr($txt,0,$len-6).' [...]' : $txt);
}

class RelatedPosts extends WP_Widget {

	function RelatedPosts() {
		$widget_ops = array('classname' => 'RelatedPosts', 'description' => 'A simple wordpress plugin that displays articles from the same category.' );
		$this->WP_Widget('RelatedPosts', 'Simple Related Posts', $widget_ops);
	}
 
	function form($instance) {

		$instance = wp_parse_args((array) $instance, array(
			'title' => '',
			'posts' => '',
			'dhc' => ''
		));

		$title = $instance['title'];
		$posts = $instance['posts'];
		$dhc = $instance['dhc'];
		
		if (!$posts) $posts = "10";
		if (!$dhc) $dhc = "25";

	echo '<p><label for="'.$this->get_field_id('title').'">Title: <input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.attribute_escape($title).'" /></label></p>';
	echo '<p><label for="'.$this->get_field_id('posts').'">Number of posts to show: <input style="width: 50px;" id="'.$this->get_field_id('posts').'" name="'.$this->get_field_name('posts').'" type="text" value="'.attribute_escape($posts).'" /></label></p>';
	echo '<p><label for="'.$this->get_field_id('dhc').'">Number of characters in title: <input style="width: 50px;" id="'.$this->get_field_id('dhc').'" name="'.$this->get_field_name('dhc').'" type="text" value="'.attribute_escape($dhc).'" /></label></p>';

	}
 
	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['posts'] = $new_instance['posts'];
		$instance['dhc'] = $new_instance['dhc'];

		return $instance;
	}

	function widget($args, $instance) {
	extract($args, EXTR_SKIP);
 
		if (is_single()) {
			global $post, $wp_query;

			echo $before_widget;
			$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
			if (!empty($title))
				echo $before_title . $title . $after_title;;
 
			$id = $wp_query->post->ID;
			$cats = get_the_category($id);

			if ($cats) {
				$cat_ids = array();

				foreach($cats as $individual_cat)
					$cat_ids[] = $individual_cat->cat_ID;

				$args = array(
					'category__in' => $cat_ids,
					'post__not_in' => array($id),
					'posts_per_page'=> $instance["posts"],
					'ignore_sticky_posts'=> 1
				);

				$dh_query = new wp_query($args);
				$post_count = $dh_query->post_count;

				if($dh_query->have_posts()) {
					echo '<div class="row-fluid">';

					while ($dh_query->have_posts()) {
						$dh_query->the_post();
						echo '<div class="span4"> <div class="item-box"><div class="item-inner">';
						echo '<figure>';
						the_post_thumbnail('');
						echo '<figcaption>';
						echo '<h3><a class="item-name" href="'.get_permalink().'" title="'.get_the_title().'">'.cutname(get_the_title(), $instance["dhc"]).'</a></h3>';
						echo '<div class="item-meta">';
						echo 'Categorie:';the_category(',');
						echo '</div>';
					echo '</figcaption';
					echo '</figure>';
					echo '</div></div></div>';}
					
					echo '</div>';
				}
				if($post_count=0)
				{
					$title = ' ';
				}

			}
 
			echo $after_widget;
		}
	}
 
}

add_action('widgets_init', create_function('', 'return register_widget("RelatedPosts");'));

?>