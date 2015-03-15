<?php
/**
 * yatheme initial setup and constants
 */
function ya_setup() {
	// Make theme available for translation
	load_theme_textdomain('yatheme', get_template_directory() . '/lang');

	// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
	register_nav_menus(array(
		'primary_menu' => __('Primary Menu', 'yatheme'),
		'footer_menu' => __('Footer Menu', 'yatheme'),
		
	));
	
	
	add_theme_support( 'automatic-feed-links' );
	
	// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	add_theme_support('post-thumbnails');
	// set_post_thumbnail_size(150, 150, false);
	add_image_size('slide-thumb', 290, 405, true); // 300px wide (and unlimited height)

	// Add post formats (http://codex.wordpress.org/Post_Formats)
	add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

	// Tell the TinyMCE editor to use a custom stylesheet
	add_editor_style('/assets/css/editor-style.css');
	
	new YA_Menu();
}
add_action('after_setup_theme', 'ya_setup');

// Backwards compatibility for older than PHP 5.3.0
if (!defined('__DIR__')) {
	define('__DIR__', dirname(__FILE__));
}

// Define helper constants
$get_theme_name = explode('/themes/', get_template_directory());

define('WP_BASE',                   wp_base_dir());
define('THEME_NAME',                next($get_theme_name));
define('RELATIVE_PLUGIN_PATH',      str_replace(site_url() . '/', '', plugins_url()));
define('FULL_RELATIVE_PLUGIN_PATH', WP_BASE . '/' . RELATIVE_PLUGIN_PATH);
define('RELATIVE_CONTENT_PATH',     str_replace(site_url() . '/', '', content_url()));
define('THEME_PATH',                RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME);
