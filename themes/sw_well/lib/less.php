<?php
require_once locate_template('/lib/less/lessc.inc.php');

if ( class_exists('lessc') && ya_options()->developer_mode && !is_ajax()){
	define('LESS_PATH', get_template_directory().'/assets/less');
	define('CSS__PATH', get_template_directory().'/assets/css');
	
	$scheme = ya_options()->scheme;
	
	$scheme_vars = get_template_directory().'/templates/presets/default.php';
	$output_cssf = CSS__PATH.'/app-default.css';
	if ( $scheme && file_exists(get_template_directory().'/templates/presets/'.$scheme.'.php') ){
		$scheme_vars = get_template_directory().'/templates/presets/'.$scheme.'.php';
		$output_cssf = CSS__PATH."/app-{$scheme}.css";
	}
	if ( file_exists($scheme_vars) ){
		include $scheme_vars;
		try {
			// less variables by theme_mod
			// $less_variables['sidebar-width'] = ya_options()->sidebar_collapse_width.'px';
			
			$less = new lessc();
			
			$less->setVariables($less_variables);
			
			$cache = $less->cachedCompile(LESS_PATH.'/app.less');
				
			file_put_contents($output_cssf, $cache["compiled"]);
		} catch (Exception $e){
			var_dump($e); exit;
		}
	}
}