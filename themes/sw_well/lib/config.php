<?php
/**
 * Enable theme features
 */
// add_theme_support('root-relative-urls');    // Enable relative URLs
// add_theme_support('rewrites');              // Enable URL rewrites
// add_theme_support('h5bp-htaccess');         // Enable HTML5 Boilerplate's .htaccess
// add_theme_support('bootstrap-top-navbar');  // Enable Bootstrap's top navbar
add_theme_support('bootstrap-gallery');     // Enable Bootstrap's thumbnails component on [gallery]
// add_theme_support('nice-search');           // Enable /?s= to /search/ redirect
add_theme_support('jquery-cdn');            // Enable to load jQuery from the Google CDN

/**
 * Configuration values
 */
 
define('POST_EXCERPT_LENGTH', 40);
function ya_main_class(){
	if ( ya_options()->theme_layout !='full' && is_active_sidebar('primary')){
		$span = ya_options()->sidebar_primary_expand;
		if (!$span) $span = 3;
		
		return 'span' . (12-$span);
	}
	return 'span12';
}
function ya_sidebar_class(){
	if ( is_active_sidebar('primary') && ya_options()->theme_layout!='full'){
		$span = ya_options()->sidebar_primary_expand;
		return 'span' . ($span);
	}
	return '';
}

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 940px is the default Bootstrap container width.
 */
if (!isset($content_width)) { $content_width = 940; }

$add_query_vars = array( 'scheme', 'text_direction', 'menu_type' );

$customize_types = array(
		'general' => array(
				'type' => 'section',
				'title' => __('General', 'yatheme')
		),

		'scheme' => array(
				'type' => 'select',
				'label' => __('Color Scheme', 'yatheme'),
				'choices' => array(
						'default' => __('Pink',  'yatheme'),
						'boocdo'    => __('Boocdo',   'yatheme'),
						'carrots'  => __('Carrots', 'yatheme'),
						'cyan'  => __('Cyan', 'yatheme'),
						'green'  => __('Green', 'yatheme'),
						'orange'  => __('Orange', 'yatheme'),
						'purple'  => __('Purple', 'yatheme')
				)
		),

		'favicon' => array(
				'type' => 'image',
				'label' => __('Favicon Icon', 'yatheme')
		),

		'text_direction' => array(
				'type' => 'select',
				'label' => __('Text Direction', 'yatheme'),
				'choices' => array(
						'auto' => __('Auto',          'yatheme'),
						'ltr'  => __('Left to Right', 'yatheme'),
						'rtl'  => __('Right to Left', 'yatheme')
				)
		),

		'responsive_support' => array(
				'type' => 'checkbox',
				'label' => __('Responsive Support', 'yatheme')
		),

		'sitelogo' => array(
				'type' => 'image',
				'label' => __('Logo Image', 'yatheme')
		),
		'bg_header' => array(
				'type' => 'image',
				'label' => __('Background Header Images', 'yatheme')
		),
		'navbar-options' => array(
				'type' => 'section',
				'title' => __('Navbar Options', 'yatheme')
		),
		
		'menu_type' => array(
				'type' => 'select',
				'label' => __('Menu Type'),
				'choices' => array(
						'dropdown' => 'Dropdown Menu',
						'mega' => 'Mega Menu'
				)
		),
		

		'yatheme-layouts' => array(
				'type' => 'section',
				'title' => __('Layout', 'yatheme')
		),
		
		'theme_layout' => array(
				'type' => 'select',
				'label' => __('Content Layout', 'yatheme'),
				'choices' => array(
						'full' => __('Content only',            'yatheme'),
						'ms'   => __('Content-Sidebar',         'yatheme'),
						'sm'   => __('Sidebar-Content',         'yatheme'),
				)
		),

		'sidebar_primary_expand' => array(
				'type' => 'select',
				'label' => __('Sidebar Expand', 'yatheme'),
				'choices' => array(
						'2' => '2/12',
						'3' => '3/12',
						'4' => '4/12',
						'5' => '5/12',
						'6' => '6/12',
						'7' => '7/12',
						'8' => '8/12'
				)
		),
		'social' => array(
				'type' => 'section',
				'title' => __('Social', 'yatheme')
		),
		'social_url_facebook' => array(
				'type' => 'text',
				'label' => __('Social Facebook Link', 'yatheme')
		),
		'social_url_twitter' => array(
				'type' => 'text',
				'label' => __('Social Twitter Link', 'yatheme')
		),
		'social_url_google_plus' => array(
				'type' => 'text',
				'label' => __('Social Google Plus Link', 'yatheme')
		),
		'social_url_linkedin' => array(
				'type' => 'text',
				'label' => __('Social Linkedin Link', 'yatheme')
		),
		'social_url_pinterest' => array(
				'type' => 'text',
				'label' => __('Social Pinterest Link', 'yatheme')
		),
		'typography' => array(
				'type' => 'section',
				'title' => __('Typography', 'yatheme')
		),

		'google_webfonts' => array(
				'type' => 'text',
				'label' => __('Use Google Webfont', 'yatheme')
		),

		'webfonts_weight' => array(
				'type' => 'select',
				'label' => __('Webfont Weight', 'yatheme'),
				'choices' => array(
						'200' => '200',
						'300' => '300',
						'400' => '400',
						'600' => '600',
						'700' => '700',
						'800' => '800',
						'900' => '900'
				)
		),

		'webfonts_character_set' => array(
				'type' => 'select',
				'label' => __('Webfont Character Set',    'yatheme'),
				'choices' => array(
						'cyrillic'     => __( 'Cyrillic',          'yatheme' ),
						'cyrillic-ext' => __( 'Cyrillic Extended', 'yatheme' ),
						'greek'        => __( 'Greek',             'yatheme' ),
						'greek-ext'    => __( 'Greek Extended',    'yatheme' ),
						'latin'        => __( 'Latin',             'yatheme' ),
						'latin-ext'    => __( 'Latin Extended',    'yatheme' ),
						'vietnamese'   => __( 'Vietnamese',        'yatheme' )
				)
		),

		'webfonts_assign' => array(
				'type' => 'select',
				'label' => __('Webfont Assign to', 'yatheme'),
				'choices' => array(
						'headers' => __( 'Headers',    'yatheme' ),
						'all'     => __( 'Everywhere', 'yatheme' ),
						'custom'  => __( 'Custom',     'yatheme' )
				)
		),

		'webfonts_custom' => array(
				'type' => 'text',
				'label' => __('Webfont Custom Selector', 'yatheme')
		),

		'networks' => array(
				'type' => 'section',
				'title' => __('Social Networks', 'yatheme')
		),

		'advanced' => array(
				'type' => 'section',
				'title' => __('Advanced', 'yatheme')
		),
		
		'developer_mode' => array(
				'type' => 'checkbox',
				'label' => __('Developer Mode', 'yatheme')
		),
		
		'google_analytics_id' => array(
				'type' => 'text',
				'label' => __('Google Analytics ID', 'yatheme')
		),
		
		'advanced_head' => array(
				'type' => 'textarea',
				'label' => __('Custom CSS/JS', 'yatheme')
		)

);

function ya_options(){
	return YA_Config::setVariables(
			wp_parse_args(
					get_option('ya_options'),
					ya_default_options()
			)
	);
}

function ya_default_options(){
	$default_theme_options = array(
			'scheme'                 => 'default',
			'favicon'                => get_bloginfo('template_directory').'/assets/img/favicon.ico',
			'text_direction'         => 'ltr',
			'responsive_support'     => true,

			'display_searchform'     => true,
			'display_socials'        => true,
			'sitelogo'               => get_bloginfo('template_directory').'/assets/img/logo.png',
			'bg_header'				 => '',
			
			'navbar_position'        => 'static',
			'navbar_inverse'		 => false,
			'navbar_branding'	     => true,
			'navbar_logo'            => get_bloginfo('template_directory').'/assets/img/logo.png',
			'navbar_searchform'      => true,
			'menu_type'              => 'dropdown',
			
			'theme_sidebar'          => 'primary',
			'theme_layout'           => 'ms',
			'sidebar_primary_expand' => 3,

			'google_webfonts'        => '',
			'webfonts_weight'        => '400',
			'webfonts_character_set' => 'latin',
			'webfonts_assign'        => 'custom',
			'webfonts_custom'        => '',

			'social_url_facebook'    => 'http://www.facebook.com/smartaddons',
			'social_url_twitter'     => 'https://twitter.com/smartaddons',
			'social_url_google_plus' => 'https://plus.google.com/103151395684525745793/posts',
			'social_url_linkedin'    => 'http://www.linkedin.com/in/smartaddons/',
			'social_url_pinterest'   => 'http://pinterest.com/smartaddons/',
			'social_url_rss'   		 => '',
			'social_url_mail'   	 => '',

			'advanced_head'          => '',
			'google_analytics_id'    => '',
			'developer_mode'         => false

	);
	return apply_filters( 'theme_default_options', $default_theme_options );
}