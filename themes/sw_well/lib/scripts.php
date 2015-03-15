<?php
/**
 * Enqueue scripts and stylesheets
 *
 */

function ya_scripts() {
	
	// register styles
	wp_register_style('bootstrap_css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', false, null);
	wp_register_style('fonticons_css', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array('bootstrap_css'), null);
	wp_register_style('bootstrap_gallery_css', get_template_directory_uri() . '/assets/css/photobox.css', array(), null);
	
	$scheme = ya_options()->scheme;
	if ($scheme){
		$app_css = get_template_directory_uri() . '/assets/css/app-'.$scheme.'.css';
	} else {
		$app_css = get_template_directory_uri() . '/assets/css/app-default.css';
	}
	
	wp_register_style('yatheme_css', $app_css, array('bootstrap_css', 'fonticons_css'), null);
	wp_register_style('yatheme_responsive_css', get_template_directory_uri() . '/assets/css/bootstrap-responsive.css', array('yatheme_css'), null);
	// wp_register_style('yatheme_rtl_css', get_template_directory_uri() . '/assets/css/app-rtl.css', array('yatheme_css'), null);
	
	// register script
	
	// jQuery is loaded using the same method from HTML5 Boilerplate:
	// Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
	// It's kept in the header instead of footer to avoid conflicts with plugins.
	if ( !is_admin() ) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', false, null, true);
	}
	
	wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.6.2-respond-1.1.0.min.js', false, null, false);
	wp_register_script('bootstrap_js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), null, true);
	wp_register_script('plugins_js', get_template_directory_uri() . '/assets/js/plugins.js', array('jquery'), null, true);
	wp_register_script('bootstrap_gallery_js', get_template_directory_uri() . '/assets/js/photobox.js', array('jquery'), null, true);
	wp_register_script('hover_js', get_template_directory_uri() . '/assets/js/jquery.hoverIntent.js', array('jquery'), null, true);
	wp_register_script('slideshow_js', get_template_directory_uri() . '/assets/js/jquery.jcarousellite.js', array('jquery'), null, true);
	wp_register_script('nav_js', get_template_directory_uri() . '/assets/js/lavalamp.js', array('jquery'), null, true);
	wp_register_script('yatheme_js', get_template_directory_uri() . '/assets/js/main.js', array('bootstrap_js'), null, true);
	wp_register_script('yatheme_social', 'http://w.sharethis.com/button/buttons.js', false, null, false);
	// enqueue script & style
	if ( !is_admin() ){
		wp_enqueue_style('yatheme_css');
		wp_enqueue_style('bootstrap_gallery_css');		
		ya_options()->responsive_support && wp_enqueue_style('yatheme_responsive_css');
		// is_rtl() && wp_enqueue_style('yatheme_rtl_css');
		
		// Load style.css from child theme
		if (is_child_theme()) {
			wp_enqueue_style('yatheme_child_css', get_stylesheet_uri(), false, null);
		}
	}
	if (is_single() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
		wp_enqueue_script('yatheme_social');
	}
	
	$is_category = is_category() && !is_category('blog');
	if ( !is_admin() ){
		wp_enqueue_script('modernizr');
		wp_enqueue_script('bootstrap_gallery_js');
		wp_enqueue_script('hover_js');
		wp_enqueue_script('slideshow_js');
		wp_enqueue_script('nav_js');		
		wp_enqueue_script('yatheme_js');
	}
}
add_action('wp_enqueue_scripts', 'ya_scripts', 100);

// http://wordpress.stackexchange.com/a/12450
function ya_jquery_local_fallback($src, $handle) {
	static $add_jquery_fallback = false;

	if ($add_jquery_fallback) {
		echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/js/jquery-1.9.1.min.js"><\/script>\')</script>' . "\n";
		$add_jquery_fallback = false;
	}

	if ($handle === 'jquery') {
		$add_jquery_fallback = true;
	}

	return $src;
}
if (!is_admin()) {
	add_filter('script_loader_src', 'ya_jquery_local_fallback', 10, 2);
}

function ya_google_analytics() { ?>
<script>
	var _gaq=[['_setAccount','<?php echo ya_options()->google_analytics_id; ?>'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php }
if ( ya_options()->google_analytics_id ) {
	add_action('wp_footer', 'ya_google_analytics', 20);
}
