<?php
/**
 * Theme wrapper
 *
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */

function ya_template_path() {
	return YA_Wrapping::$main_template;
}

function ya_sidebar_path() {
	return YA_Wrapping::sidebar();
}

add_filter('template_include', array('YA_Wrapping', 'wrap'), 99);

/**
 * Page titles
*/
function ya_title() {
	if (is_home()) {
		if (get_option('page_for_posts', true)) {
			echo get_the_title(get_option('page_for_posts', true));
		} else {
			_e('Latest Posts', 'yatheme');
		}
	} elseif (is_archive()) {
		$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
		if ($term) {
			echo $term->name;
		} elseif (is_post_type_archive()) {
			echo get_queried_object()->labels->name;
		} elseif (is_day()) {
			printf(__('Daily Archives: %s', 'yatheme'), get_the_date());
		} elseif (is_month()) {
			printf(__('Monthly Archives: %s', 'yatheme'), get_the_date('F Y'));
		} elseif (is_year()) {
			printf(__('Yearly Archives: %s', 'yatheme'), get_the_date('Y'));
		} elseif (is_author()) {
			printf(__('Author Archives: %s', 'yatheme'), get_the_author());
		} else {
			single_cat_title();
		}
	} elseif (is_search()) {
		printf(__('Search Results for <small>%s</small>', 'yatheme'), get_search_query());
	} elseif (is_404()) {
		_e('Not Found', 'yatheme');
	} else {
		the_title();
	}
}

/**
 * Show an admin notice if .htaccess isn't writable
 */
function ya_htaccess_writable() {
	if (!is_writable(get_home_path() . '.htaccess')) {
		if (current_user_can('administrator')) {
			add_action('admin_notices', create_function('', "echo '<div class=\"error\"><p>" . sprintf(__('Please make sure your <a href="%s">.htaccess</a> file is writable ', 'yatheme'), admin_url('options-permalink.php')) . "</p></div>';"));
		}
	}
}
add_action('admin_init', 'ya_htaccess_writable');

/**
 * Return WordPress subdirectory if applicable
*/
function wp_base_dir() {
	preg_match('!(https?://[^/|"]+)([^"]+)?!', site_url(), $matches);
	if (count($matches) === 3) {
		return end($matches);
	} else {
		return '';
	}
}

/**
 * Opposite of built in WP functions for trailing slashes
 */
function leadingslashit($string) {
	return '/' . unleadingslashit($string);
}

function unleadingslashit($string) {
	return ltrim($string, '/');
}

function add_filters($tags, $function) {
	foreach($tags as $tag) {
		add_filter($tag, $function);
	}
}

function is_element_empty($element) {
	$element = trim($element);
	return empty($element) ? false : true;
}

function is_ajax(){
	return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

/**
 * Use Bootstrap's media object for listing comments
 *
 * @link http://twitter.github.com/bootstrap/components.html#media
 */

function ya_get_avatar($avatar) {
	$avatar = str_replace("class='avatar", "class='avatar pull-left media-object", $avatar);
	return $avatar;
}
add_filter('get_avatar', 'ya_get_avatar');

function ya_custom_direction(){
	global $wp_locale;
	$opt_direction = ya_options()->text_direction;
	$opt_direction = strtolower($opt_direction);
	if ( in_array($opt_direction, array('ltr', 'rtl')) ){
		$wp_locale->text_direction = $opt_direction;
	} else {
		// default by $wp_locale->text_direction;
	}
}
add_filter( 'wp', 'ya_custom_direction' );

function ya_navbar_class(){
	$classes = array( 'navbar' );

	if ( 'static' != ya_options()->navbar_position )
		$classes[]	=	ya_options()->navbar_position;

	if ( ya_options()->navbar_inverse )
		$classes[]	=	'navbar-inverse';

	apply_filters( 'ya_navbar_classes', $classes );

	echo 'class="' . join( ' ', $classes ) . '"';
}

function ya_content_class(){
	$classes = array( 'content' );
	
	$all_sidebars = array_merge(ya_sidebar_left(), ya_sidebar_right());
	
	$all_sidebars = array_unique($all_sidebars);
	
	$span = 12;
	foreach ($all_sidebars as $sb){
		if ( !is_active_sidebar($sb) ){
			continue;
		}
		$sb_expand_field = 'sidebar_'.$sb.'_expand';
		$sb_expand_value = ya_options()->$sb_expand_field;
		$span -= (int)$sb_expand_value;
	}
	if ($span <= 0){
		$classes[] = 'span12';
	} else {
		$classes[] = 'span'.$span;
	}
	
	echo 'class="' . join( ' ', $classes ) . '"';
}

function ya_sidebar_left(){
	$layout = ya_options()->theme_layout;
	$side_left = array();
	
	if ( preg_match('/sm/', $layout) ){
		$side_left[] = 'primary';
	} else if ( preg_match('/[l|r]+.?m/', $layout) ){
		for ( $i = 0; $i < strlen($layout); $i++ ){
			if ($layout[$i]=='m') break;
			if ($layout[$i]=='l') $side_left[] = 'left';
			if ($layout[$i]=='r') $side_left[] = 'right';
		}
	}
	return apply_filters('ya_sidebar_left', $side_left);
}

function ya_sidebar_right(){
	$layout = ya_options()->theme_layout;
	$side_right = array();

	if ( preg_match('/ms/', $layout) ){
		$side_right[] = 'primary';
	} else if ( preg_match('/m.?[l|r]+/', $layout) ){
		$push = 0;
		for ( $i = 0; $i < strlen($layout); $i++ ){
			if ($layout[$i]=='m') {
				$push = 1;
				continue;
			} else {
				if ( $push ){
					if ($layout[$i]=='l') $side_right[] = 'left';
					if ($layout[$i]=='r') $side_right[] = 'right';
				}
			}
		}
	}
	return apply_filters('ya_sidebar_right', $side_right);
}
function get_entry_content_asset()
	{
		global $post;
		$post = get_post();
		$content = apply_filters ("the_content", $post->post_content);
		$value=preg_match('/<div class=\"entry\-content\-asset\">(.*?)<\/div>/s',$content,$results);
		if($value){
			return $results[0];
		}else{
			return " " ;
		}
	}