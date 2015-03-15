<?php

/**
 * Adds WP_Customize_Textarea_Control
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
	class WP_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';

    	public function render_content() { ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
  	}
}

/**
 * Adds sections to the customizer
 * @param WP_Customize_Control $wp_customize
 */
function ya_customize_register( $wp_customize ){
	global $customize_types;
	$settings = ya_default_options();
	$priority = 200;
	$current_section = 'yatheme';
	foreach ($customize_types as $setting => $options){
		$customize_type = $options['type'];
		
		if ( $customize_type == 'section' ){
			$options['priority'] = $priority++;
			$wp_customize->add_section( $setting, $options );
			$current_section = $setting;
			continue;
		}
		
		$setting_name = 'ya_options['.$setting.']';
		$setting_id   = 'yatheme-'.$setting;
		$setting_default = $settings[$setting];
		
		// add setting
		$wp_customize->add_setting(
			$setting_name,
			array(
				'default' => $setting_default,
				'type' => 'option',
				'transport' => 'postMessage',
				'capability' => 'edit_theme_options'
			)
		);
		
		$options['section']  = $current_section;
		$options['settings'] = $setting_name;
		$options['primary']  = $priority++;
		// add control
		switch( $customize_type ){
			case 'color':
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, $options ) );
				break;
			case 'image':
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting_id, $options ) );
				break;
			case 'textarea':
				$wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, $setting_id, $options ) );
				break;
			default:
				$wp_customize->add_control( $setting_id, $options );
		}
		// $wp_customize->get_setting($setting_id)->transport = 'postMessage';
	}
	
	$wp_customize -> get_setting( 'blogname' )-> transport = 'postMessage';
	$wp_customize -> get_setting( 'blogdescription' )-> transport = 'postMessage';
}
add_action( 'customize_register', 'ya_customize_register' );


function ya_typography_css(){
	$styles = '';
	if ( ya_options()->google_webfonts ):
		
		$webfonts_assign = ya_options()->webfonts_assign;
		$styles = '<style>';
		if ( $webfonts_assign == 'headers' ){
			$styles .= 'h1, h2, h3, h4, h5, h6 {';
		} else if ( $webfonts_assign == 'custom' ){
			$custom_assign = ya_options()->webfonts_custom;
			$custom_assign = trim($custom_assign);
			if (!$custom_assign) return '';
			$styles .= $custom_assign . ' {';
		} else {
			$styles .= 'body, input, button, select, textarea, .search-query {';
		}
		$styles .= 'font-family: ' . ya_options()->google_webfonts . ';}</style>';
	endif;
	return $styles;
}

function ya_typography_css_cache(){
	$data = get_transient( 'ya_typography_css' );
	if ( $data === false ) {
		$data = ya_typography_css();
		set_transient( 'ya_typography_css', $data, 3600 * 24 );
	}
	echo $data;
}
add_action( 'wp_head', 'ya_typography_css_cache', 12, 0 );

function ya_typography_css_cache_reset(){
	delete_transient( 'ya_typography_css' );
	ya_typography_css_cache();
}
add_action( 'customize_preview_init', 'ya_typography_css_cache_reset' );


function ya_typography_webfonts(){
	if ( ya_options()->google_webfonts ):
		$webfont				= ya_options()->google_webfonts;
		$webfont_weight			= ya_options()->webfonts_weight;
		$webfont_character_set	= ya_options()->webfonts_character_set;
		
		$f = strlen($webfont);
		if ($f > 3){
			$webfontname = str_replace( ' ', '+', $webfont );
			return '<link href="http://fonts.googleapis.com/css?family=' . $webfontname . ':' . $webfont_weight . '&subset=' . $webfont_character_set . '" rel="stylesheet">';
		}
	endif;
}

function ya_typography_webfonts_cache(){
	$data = get_transient( 'ya_typography_webfont' );
	if ( $data === false ) {
		$data = ya_typography_webfonts();
		set_transient( 'ya_typography_webfont', $data, 3600 * 24 );
	}
	echo $data;
}
add_action( 'wp_head', 'ya_typography_webfonts_cache', 11, 0 );


function ya_typography_webfonts_cache_reset(){
	delete_transient( 'ya_typography_webfont' );
	ya_typography_webfonts_cache();
}
add_action( 'customize_preview_init', 'ya_typography_webfonts_cache_reset' );

function ya_custom_header_scripts() {
	if ( ya_options()->advanced_head ){
		echo ya_options()->advanced_head;
	}
}
add_action( 'wp_head', 'ya_custom_header_scripts', 200 );

function add_favicon(){
	if ( ya_options()->favicon ){
		echo '<link rel="shortcut icon" href="' . ya_options()->favicon . '" />';
	}
}
add_action('wp_head', 'add_favicon');


function ya_query_vars( $qvars ){
	global $add_query_vars;
	if ( is_array($add_query_vars) ){
		foreach ( $add_query_vars as $field ){
			$qvars[] = $field;
		}
	}
	return $qvars;
}

function ya_parse_request( &$wp ){
	global $add_query_vars;
	if ( is_array($add_query_vars) ){
		foreach ( $add_query_vars as $field ){
			if ( array_key_exists($field, $wp->query_vars) ){
				$current_value = ya_options()->$field;
				$request_value = $wp->query_vars[$field];
				if ($request_value != $current_value){
					setcookie(
						$field,
						$request_value,
						time() + 86400,
						COOKIEPATH,
						COOKIE_DOMAIN,
						0
					);
					if (!isset($_COOKIE[$field]) || $request_value != $_COOKIE[$field]){
						$_COOKIE[$field] = $request_value;
					}
				}
			}
		}
	}
}

add_action('parse_request', 'ya_parse_request');
add_filter('query_vars',    'ya_query_vars');
