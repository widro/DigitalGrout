<?php
/**
 * Roots includes
 */
require_once locate_template('/lib/classes.php');		// Utility functions
require_once locate_template('/lib/utils.php');			// Utility functions
require_once locate_template('/lib/init.php');			// Initial theme setup and constants
require_once locate_template('/lib/config.php');		// Configuration
require_once locate_template('/lib/activation.php');	// Theme activation
require_once locate_template('/lib/cleanup.php');		// Cleanup
require_once locate_template('/lib/nav.php');			// Custom nav modifications
require_once locate_template('/lib/rewrites.php');		// URL rewriting for assets
require_once locate_template('/lib/htaccess.php');		// HTML5 Boilerplate .htaccess
require_once locate_template('/lib/widgets.php');		// Sidebars and widgets
require_once locate_template('/lib/scripts.php');		// Scripts and stylesheets
require_once locate_template('/lib/customizer.php');	// Custom functions
require_once locate_template('/lib/shortcodes.php');	// Utility functions
require_once locate_template('/lib/less.php');			// Custom functions

if ( is_admin() ){
	require_once locate_template('/lib/admin.php');			// Administrator functions
}