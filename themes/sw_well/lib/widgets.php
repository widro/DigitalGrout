<?php
/**
 * Register sidebars and widgets
 */
function ya_widgets_init() {
	// Sidebars
	$primary = array(
			'name'          => __('Sidebar Primary', 'yatheme'),
			'id'            => 'primary',
			'before_widget' => '<section class="widget %1$s %2$s"><div class="sidebar-right">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
	);
	register_sidebar($primary);
	$slide = array(
			'name'          => __('Sidebar Slideshow', 'yatheme'),
			'id'            => 'slideshow',
			'before_widget' => '<section class="widget %1$s %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => ''
	);
	register_sidebar($slide);
	$sideba_home = array(
			'name'          => __('Sidebar Home', 'yatheme'),
			'id'            => 'sidebar-home',
			'before_widget' => '<section class="widget %1$s %2$s hwidget">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>'
	);
	register_sidebar($sideba_home);
	$footer = array(
			'name'          => __('Footer', 'yatheme'),
			'id'            => 'footer',
			'before_widget' => '<section class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
	);
	register_sidebar($footer);

	// Widgets
	register_widget('YA_Posts_Widget');
	register_widget('YA_Gallery_Widget');
}
add_action('widgets_init', 'ya_widgets_init');


/**
 * Posts widget class
 *
 * @since 2.8.0
*/
class YA_Posts_Widget extends YA_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'ya_posts', 'description' => __('YA Posts'));
		parent::__construct('ya_posts', __('YA Posts'), $widget_ops);
		$this->base = dirname(__FILE__);
	}
}
class YA_Gallery_Widget extends YA_Widget{

	function __construct(){
		$widget_ops = array('classname' => 'ya_gallery', 'description' =>__('YA Gallery'));
		parent::__construct('ya_gallery', __('YA Gallery'), $widget_ops);
	}
}
