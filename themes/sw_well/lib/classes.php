<?php

if ( !class_exists('YA_Wrapping') ):
/**
 * Theme wrapper
 *
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */
class YA_Wrapping {
	// Stores the full path to the main template file
	static $main_template;

	// Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	static $base;

	static function wrap($template) {
		self::$main_template = $template;

		self::$base = substr(basename(self::$main_template), 0, -4);

		if (self::$base === 'index') {
			self::$base = false;
		}

		$templates = array('base.php');

		if (self::$base) {
			array_unshift($templates, sprintf('base-%s.php', self::$base));
		}

		return locate_template($templates);
	}

	static function sidebar() {
		$templates = array('templates/sidebar.php');

		if (self::$base) {
			array_unshift($templates, sprintf('templates/sidebar-%s.php', self::$base));
		}

		return locate_template($templates);
	}
}

endif;


if ( !class_exists('YA_Config')):
class YA_Config {
	public static $instance = null;
	protected $vars = array();
	public function __construct(){

	}
	
	public function __get($field){
		if ( array_key_exists($field, $_COOKIE) ){
			return $_COOKIE[$field];
		} else if ( array_key_exists($field, $this->vars) ){
			return $this->vars[$field];
		}
		return null;
	}
	
	public function gets(){
		$cookie_vars = array();
		foreach($this->vars as $field => $val){
			if (array_key_exists($field, $_COOKIE)){
				$cookie_vars[$field] = $_COOKIE[$field];
			}
		}
		return array_merge($this->vars, $cookie_vars);
	}
	
	public function __set($field, $val){
		$this->vars[$field] = $val;
	}
	
	public static function setVariables($vars){
		if ( is_null(self::$instance) ){
			self::$instance = new YA_Config();
			//self::$instance->vars = (array)$vars;
			foreach ( (array)$vars as $field => $val ){
				self::$instance->$field = $val;
			}
		}
		return self::$instance;
	}
}

endif;

if ( !class_exists('YA_Menu') ):

class YA_Menu {
	public static $_extra_fields = array(
			'icon' => 'text',
			'span' => 'select',
			'dropdown_span' => 'select',
			'dropdown_align' => 'select',
			'content' => 'textarea'
	);
	public static $_extra_fields_meta = array(
		'icon' => array('Icon', 'Show an icon by <a href="http://fortawesome.github.com/Font-Awesome/">Font Awesome 3.0</a>'),
		'span' => array('Size:', array(
				'' => 'None',
				'span1' => 'span1',
				'span2' => 'span2',
				'span3' => 'span3',
				'span4' => 'span4',
				'span5' => 'span5',
				'span6' => 'span6',
				'span7' => 'span7',
				'span8' => 'span8',
				'span9' => 'span9',
				'span10' => 'span10',
				'span11' => 'span11',
				'span12' => 'span12'
		)),
		'dropdown_span' => array('Dropdown Size: ', array(
					'' => 'None',
					'span1' => 'span1',
					'span2' => 'span2',
					'span3' => 'span3',
					'span4' => 'span4',
					'span5' => 'span5',
					'span6' => 'span6',
					'span7' => 'span7',
					'span8' => 'span8',
					'span9' => 'span9',
					'span10' => 'span10',
					'span11' => 'span11',
					'span12' => 'span12'
				)),
		'dropdown_align' => array('Dropdown Align', array(
					'' => 'Default',
					'pull-left' => 'Left',
					'pull-right' => 'Right'
				)),
		'content' => array('Content', array())
		
	);

	public function __construct(){
		add_filter( 'wp_setup_nav_menu_item',	array( $this, 'add_custom_nav_fields') );
		add_action( 'wp_update_nav_menu_item',	array( $this, 'update_custom_nav_fields'), 10, 3 );
		add_filter( 'wp_edit_nav_menu_walker',	array( $this, 'edit_walker'), 10, 2 );
	}

	public function add_custom_nav_fields( $menu_item ){
		if ( count(self::$_extra_fields) ){
			foreach (self::$_extra_fields as $field => $type){
				$field_meta_name = strtr($field, '-','_');
				$menu_item->$field_meta_name = get_post_meta( $menu_item->ID, '_menu_item_'.$field_meta_name, true );
			}
		}
		return $menu_item;
	}

	public function update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ){
		if ( count(self::$_extra_fields) ){
			foreach (self::$_extra_fields as $field => $type){
				if ( array_key_exists('menu-item-'.$field, $_REQUEST) && is_array($_REQUEST['menu-item-'.$field]) ){
					$field_value = $_REQUEST['menu-item-'.$field][$menu_item_db_id];
					// sanitize values
					switch ($type){
						case 'text':
							$field_value = sanitize_text_field($field_value);
							if ($field == 'icon'){
								$field_value = sanitize_html_class($field_value);
							}
							break;
						default:
					}
					$field_meta_name = strtr($field, '-','_');
					update_post_meta( $menu_item_db_id, '_menu_item_'.$field_meta_name, $field_value );
				}
			}
		}
	}

	public function edit_walker($walker, $menu_id){
		return 'YA_Menu_Edit_Walker';
	}
}

endif;

if ( !class_exists('YA_Menu_Edit_Walker') ):

/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 *
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class YA_Menu_Edit_Walker extends Walker_Nav_Menu  {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl(&$output) {}

	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl(&$output) {
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el(&$output, $item, $depth, $args) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = $original_object->post_title;
		}

		$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( __( '%s (Invalid)' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __('%s (Pending)' ), $item->title );
		}

		$title = empty( $item->label ) ? $title : $item->label;

		?>
		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><?php echo esc_html( $title ); ?></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php _e( 'Edit Menu Item', 'yatheme' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo $item_id; ?>">
							<?php _e( 'URL' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<?php _e( 'Navigation Label' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php _e( 'Title Attribute' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php _e( 'Open link in a new window/tab' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
						<?php _e( 'CSS Classes (optional)' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
						<?php _e( 'Link Relationship (XFN)' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php _e( 'Description' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.'); ?></span>
					</label>
				</p>
				
				<?php if ( is_array(YA_Menu::$_extra_fields) ): ?>
				<?php foreach (YA_Menu::$_extra_fields as $field => $type):?>
					<p class="field-<?php echo $field; ?> description description-wide">
						<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php _e( YA_Menu::$_extra_fields_meta[$field][0] ); ?><br />
						<?php
						
						$field_meta_name = strtr($field, '-','_');
						switch($type):
							default:
							case 'text':
								?><input type="text" id="edit-menu-item-<?php echo $field; ?>-<?php echo $item_id; ?>" class="widefat code edit-menu-item-<?php echo $field; ?>" name="menu-item-<?php echo $field; ?>[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->$field_meta_name ); ?>" /><?php
								break;
							case 'textarea':
								?><textarea id="edit-menu-item-<?php echo $field; ?>-<?php echo $item_id; ?>" class="widefat edit-menu-item-<?php echo $field; ?>" rows="3" cols="20" name="menu-item-<?php echo $field; ?>[<?php echo $item_id; ?>]"><?php echo esc_html( $item->$field_meta_name ); // textarea_escaped ?></textarea><?php
								break;
							case 'select':
								?><select  id="edit-menu-item-<?php echo $field; ?>-<?php echo $item_id; ?>" class="edit-menu-item-<?php echo $field; ?>" name="menu-item-<?php echo $field; ?>[<?php echo $item_id; ?>]" >
								<?php if ( isset(YA_Menu::$_extra_fields_meta[$field][1]) && is_array(YA_Menu::$_extra_fields_meta[$field][1]) ): ?>
									<?php foreach (YA_Menu::$_extra_fields_meta[$field][1] as $opt_val => $opt_label ): ?>
									<option value="<?php echo esc_attr($opt_val); ?>"
										<?php if ( $opt_val == $item->$field_meta_name ){ ?>selected="selected"<?php }?>
									><?php echo esc_attr_e($opt_label, 'yatheme'); ?></option>
									
									<?php endforeach; ?>
								<?php endif; ?>
								</select><?php
								break;
						endswitch; ?>
						<?php if (isset( YA_Menu::$_extra_fields_meta[$field][1] ) && is_string(YA_Menu::$_extra_fields_meta[$field][1])): ?><span class="description"><?php _e(YA_Menu::$_extra_fields_meta[$field][1]); ?></span><?php endif; ?>
					</p>
				<?php endforeach; ?>
				<?php endif; ?>
				
				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( __('Original: %s'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php _e('Remove'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php	echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
						?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel'); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}
}

endif;

if ( !class_exists('YA_Menu_Walker') ):

class YA_Menu_Walker extends Walker_Nav_Menu {
	function check_current($classes) {
		return preg_match('/(current[-_])|active|dropdown/', $classes);
	}

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= "\n<ul class=\"dropdown-menu\">\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$item_html = '';
		parent::start_el($item_html, $item, $depth, $args);

		if ($item->is_dropdown && ($depth === 0)) {
			$item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="dropdown"', $item_html);
			$item_html = str_replace('</a>', '</a>', $item_html);
		}
		elseif (stristr($item_html, 'li class="divider')) {
			$item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
		}
		elseif (stristr($item_html, 'li class="nav-header')) {
			$item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
		}

		// icon - extra field
		if ( isset($item->icon) && !empty($item->icon) ){
			//$icon_html = '<span class="'.esc_attr($item->icon).'"></span>';
			if ( is_rtl() ){
				$item_html = preg_replace('/(<a[^>]*>)(.*)(<\/a>)/iU', '$1<span class="menu-title">$2</span><span class="'.esc_attr($item->icon).'"></span>$3', $item_html);
			} else {
				$item_html = preg_replace('/(<a[^>]*>)(.*)(<\/a>)/iU', '$1<span class="'.esc_attr($item->icon).'"></span><span class="menu-title">$2</span>$3', $item_html);
			}
		} else {
			$item_html = preg_replace('/(<a[^>]*>)(.*)(<\/a>)/iU', '$1<span class="menu-title">$2</span>$3', $item_html);
		}

		$output .= $item_html;
	}

	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		$element->is_dropdown = !empty($children_elements[$element->ID]);

		if ($element->is_dropdown) {
			if ($depth === 0) {
				$element->classes[] = 'dropdown nav-pills';
			} elseif ($depth >= 1) {
				$element->classes[] = 'dropdown-submenu';
			}
		}

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}

endif;

if ( !class_exists('YA_Mega_Menu_Walker') ):

class YA_Mega_Menu_Walker extends Walker_Nav_Menu {
	
	public function logMessage($var){
		$f = fopen(__DIR__.'/log.txt', 'a');
		if ( is_array($var) ){
			ob_start();
			print_r($var);
			fwrite($f, ob_get_contents().PHP_EOL);
			ob_end_clean();
		} else if ( is_string($var) ){
			fwrite($f, $var.PHP_EOL);
		}
		fclose($f);
	}
	
	function check_current($classes) {
		return preg_match('/(current[-_])|active|dropdown/', $classes);
	}
	
	public function have_dropdown_span( $item ){
		return !empty($item->dropdown_span) && preg_match('/span(1|2|3|4|5|6|7|8|9|10|11|12)/', $item->dropdown_span);
	}
	
	public function is_span_class( $class ){
		if ( is_string($class) && preg_match('/span(1|2|3|4|5|6|7|8|9|10|11|12)/', $class) ){
			return true;
		}
		return false;
	}

	function start_lvl( $item, $depth = 0, $args = array() ) {
		if ( $depth === 1 ){
			$pull = !empty($item->dropdown_align) ? $item->dropdown_align : '';
			if ( $this->have_dropdown_span($item) ){
				$output = '<div class="dropdown-menu '.$item->dropdown_span.' '.$pull.'"><ul class="row nav-level'.($depth).'">';
			} else {
				$output = '<ul class="dropdown-menu nav-level'.($depth).' '.$pull.'">';
			}
		} elseif ( $depth > 1 ) {
			$output = '<ul class="nav-level'.($depth).'">';
		}
		
		return $output;
	}
	
	function end_lvl( $item, $depth = 0, $args = array() ){
		if ( $depth === 1 ){
			if ( $this->have_dropdown_span($item) ){
				$output = '</ul></div>';
			} else {
				$output = '</ul>';
			}
		} elseif ( $depth > 1 ) {
			$output = '</ul>';
		}
		return $output;
	}
	
	
	function start_el( $item, $depth = 0, $args = array() ) {
		
		$output = '';
		$class_names = $value = '';
	
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	
// 		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
// 		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
	
		$output .=  '<li ' . $value . $class_names .'>';
	
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
		// if have child.
		if ($item->is_dropdown && ($depth === 0)){
			$attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
		}
		
		$add_icon = isset($item->icon) && !empty($item->icon);
		
		$item_output = !empty($args->before) ? $args->before : '';
		if($item->content!='')
		{
			$item_output .= do_shortcode($item->content);
		}
		else
		{
			$item_output .= '<a'. $attributes .'>';
			
			if ( $add_icon && !is_rtl() ){
				$item_output .= '<span class="'.esc_attr($item->icon).'"></span>';
			}
			
			$item_output .= '<span class="menu-title">';
			$item_output .=	!empty($args->link_before) ? $args->link_before : '';
			$item_output .=	apply_filters( 'the_title', $item->title, $item->ID );
			$item_output .=	!empty($args->link_after) ? $args->link_after : '';
			$item_output .=	'</span>';
			
			if ( $add_icon && is_rtl() ){
				$item_output .= '<span class="'.esc_attr($item->icon).'"></span>';
			}
			
			$item_output .= '</a>';
		}
		$item_output .= !empty($args->after) ? $args->after : '';
	
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		
		return $output;
	}
	
	function end_el( $element, $depth=0, $args=array() ){
		return '</li>';
	}

	
	public function getElement( $element, $children_elements, $max_depth, $depth = 0, $args ){
		
		if ( !$element )
			return;
		
		// var_dump( $element );
		$element->is_dropdown = !empty($children_elements[$element->ID]);
		
		if ($element->is_dropdown) {
			if ($depth === 0) {
				$element->classes[] = 'dropdown';
			} elseif ($depth === 1) {
				$element->classes[] = 'dropdown-submenu';
			}
		}
		if ( !empty($element->span) && $this->is_span_class($element->span)){
			if ($depth === 1) {
				$element->classes[] = $element->span;
			}
		}
		
		$output = '';
		$id_field = $this->db_fields['id'];
		
		//display this element
		$output .= $this->start_el($element, $depth, $args);
		
		$id = $element->$id_field;
		
		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {
			$output .= $this->start_lvl( $element, $depth + 1, $args );
			foreach( $children_elements[ $id ] as $child ){
				$output .= $this->getElement($child, $children_elements, $max_depth, $depth + 1, $args);
			}
			unset( $children_elements[ $id ] );
			
			$output .= $this->end_lvl( $element, $depth + 1, $args );
			
		}
		
		$output .= $this->end_el($element, $depth, $args);
		
		// $this->logMessage($element->id);
		$this->logMessage( $output );
		
		
		return $output;
	}
	
	function walk( $elements, $max_depth ){
		$args = array_slice(func_get_args(), 2);
		$output = '';
		
		if ($max_depth < -1) //invalid parameter
			return $output;
		
		if (empty($elements)) //nothing to walk
			return $output;
		
		$id_field = $this->db_fields['id'];
		$parent_field = $this->db_fields['parent'];
		
		// flat display
		if ( -1 == $max_depth ) {
			$empty_array = array();
			foreach ( $elements as $e )
				$output .= $this->getElement( $e, $empty_array, 1, 0, $args );
			return $output;
		}
		
		/*
		 * need to display in hierarchical order
		* separate elements into two buckets: top level and children elements
		* children_elements is two dimensional array, eg.
		* children_elements[10][] contains all sub-elements whose parent is 10.
		*/
		$top_level_elements = array();
		$children_elements  = array();
		foreach ( $elements as $e) {
			if ( 0 == $e->$parent_field )
				$top_level_elements[] = $e;
			else
				$children_elements[ $e->$parent_field ][] = $e;
		}
		
		/*
		 * when none of the elements is top level
		* assume the first one must be root of the sub elements
		*/
		if ( empty($top_level_elements) ) {
		
			$first = array_slice( $elements, 0, 1 );
			$root = $first[0];
		
			$top_level_elements = array();
			$children_elements  = array();
			foreach ( $elements as $e) {
				if ( $root->$parent_field == $e->$parent_field )
					$top_level_elements[] = $e;
				else
					$children_elements[ $e->$parent_field ][] = $e;
			}
		}
		
		foreach ( $top_level_elements as $e )
			$output .= $this->getElement( $e, $children_elements, $max_depth, 0, $args );
		
// 		/*
// 		 * if we are displaying all levels, and remaining children_elements is not empty,
// 		* then we got orphans, which should be displayed regardless
// 		*/
// 		if ( ( $max_depth == 0 ) && count( $children_elements ) > 0 ) {
// 			$empty_array = array();
// 			foreach ( $children_elements as $orphans )
// 				foreach( $orphans as $op )
// 					$output .= $this->getElement( $op, $empty_array, 1, 0, $args );
// 		}
		
		return $output;
	}
}

endif;

if ( !class_exists('YA_Widget') ):

abstract class YA_Widget extends WP_Widget{
	protected $base_path = null;
	protected $base_tpl_path = null;
	protected $override_tpl_path = null;
	protected $tpls = null;
	
	public function __construct($id_base = false, $name, $widget_options = array(), $control_options = array()){
		parent::__construct($id_base, $name, $widget_options, $control_options);
		$this->init();
	}
	
	protected function init(){
		$this->base_path = dirname(__FILE__);
		$this->base_tpl_path = apply_filters('ya_widget_template_base', $this->base_path.'/widgets/'.$this->id_base.'/tmpl');
		$this->override_tpl_path = apply_filters('ya_widget_override_base', get_template_directory().'/templates/widgets/'.$this->id_base);
	}
	
	/**
	 * Scans a directory for files of a certain extension.
	 *
	 * @since 3.4.0
	 * @access private
	 *
	 * @param string $path Absolute path to search.
	 * @param mixed  Array of extensions to find, string of a single extension, or null for all extensions.
	 * @param int $depth How deep to search for files. Optional, defaults to a flat scan (0 depth). -1 depth is infinite.
	 * @param string $relative_path The basename of the absolute path. Used to control the returned path
	 * 	for the found files, particularly when this function recurses to lower depths.
	 */
	protected function scandir( $path, $extensions = null, $depth = 0, $relative_path = '' ) {
		if ( ! is_dir( $path ) )
			return false;
	
		if ( $extensions ) {
			$extensions = (array) $extensions;
			$_extensions = implode( '|', $extensions );
		}
	
		$relative_path = trailingslashit( $relative_path );
		if ( '/' == $relative_path )
			$relative_path = '';
	
		$results = scandir( $path );
		$files = array();
	
		foreach ( $results as $result ) {
			if ( '.' == $result[0] )
				continue;
			if ( is_dir( $path . '/' . $result ) ) {
				if ( ! $depth || 'CVS' == $result )
					continue;
				$found = self::scandir( $path . '/' . $result, $extensions, $depth - 1 , $relative_path . $result );
				$files = array_merge_recursive( $files, $found );
			} elseif ( ! $extensions || preg_match( '~\.(' . $_extensions . ')$~', $result ) ) {
				$files[ $relative_path . $result ] = $path . '/' . $result;
			}
		}
	
		return $files;
	}
	
	public function ya_trim_words( $text, $num_words = 30, $more = null ) {
		$text = strip_shortcodes( $text);
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		return wp_trim_words($text, $num_words, $more);
	}
	
	
	protected function getTemplatePath($tpl='default', $type=''){
		$file = '/'.$tpl.$type.'.php';
		if ( file_exists( $this->override_tpl_path.$file ) ){
			return $this->override_tpl_path.$file;
		}
		if ( file_exists( $this->base_tpl_path.$file ) ){
			return $this->base_tpl_path.$file;
		}
		return $tpl=='default' ? false : $this->getTemplatePath('default', $type);
	}
		
	protected function getTemplates(){
		if ( is_null($this->tpls) ){
			$has_default = false;
			if ( $files = $this->scandir($this->override_tpl_path, 'php') ){
				$this->tpls['ov'] = array();
				foreach ( $files as $n => $p ){
					if ( preg_match('/_/', $n) ) continue;
					$bn = basename($n, '.php');
					$tpl = strtr($bn, '-', ' ');
					$tpl = ucwords($tpl);
					
					$this->tpls['ov'][$bn] = $tpl;
				}
				$has_default = isset($this->tpls['ov']['default']);
			}
			
			if ( $files = $this->scandir($this->base_tpl_path, 'php') ){
				$this->tpls['df'] = array();
				foreach ( $files as $n => $p ){
					if ( preg_match('/_/', $n) ) continue;
					$bn = basename($n, '.php');
					$tpl = strtr($bn, '-', ' ');
					$tpl = ucwords($tpl);
						
					$this->tpls['df'][$bn] = $tpl;
				}
				$has_default = $has_default || isset($this->tpls['df']['default']);
			}
			
			if ( !$has_default ){
				$this->tpls['df']['default'] = 'Default';
				try{
					$default_tpl = $this->base_tpl_path.'/default.php';
					mkdir( dirname( $default_tpl ), 0755, true );
					file_put_contents( $default_tpl, '<?php  ?>');
				} catch(Exception $e){}
			}
		}
		
		return $this->tpls;
	}
	
	public function widget_template_select( $field_name, $opts = array(), $field_value = null ){
		$default_options = array(
				'multiple' => false,
				'disabled' => false,
				'size' => 5,
				'class' => 'widefat',
				'required' => false,
				'autofocus' => false,
				'form' => false,
		);
		$opts = wp_parse_args($opts, $default_options);
	
		if ( (is_string($opts['multiple']) && strtolower($opts['multiple'])=='multiple') || (is_bool($opts['multiple']) && $opts['multiple']) ){
			$opts['multiple'] = 'multiple';
			if ( !is_numeric($opts['size']) ){
				if ( intval($opts['size']) ){
					$opts['size'] = intval($opts['size']);
				} else {
					$opts['size'] = 5;
				}
			}
		} else {
			// is not multiple
			unset($opts['multiple']);
			unset($opts['size']);
			if (is_array($field_value)){
				$field_value = array_shift($field_value);
			}
		}
	
		if ( (is_string($opts['disabled']) && strtolower($opts['disabled'])=='disabled') || is_bool($opts['disabled']) && $opts['disabled'] ){
			$opts['disabled'] = 'disabled';
		} else {
			unset($opts['disabled']);
		}
	
		if ( (is_string($opts['required']) && strtolower($opts['required'])=='required') || (is_bool($opts['required']) && $opts['required']) ){
			$opts['required'] = 'required';
		} else {
			unset($opts['required']);
		}
	
		if ( !is_string($opts['form']) ) unset($opts['form']);
	
		if ( !isset($opts['autofocus']) || !$opts['autofocus'] ) unset($opts['autofocus']);
	
		$opts['id'] = $this->get_field_id($field_name);
	
		$opts['name'] = $this->get_field_name($field_name);
	
		$select_attributes = '';
		foreach ( $opts as $an => $av){
			$select_attributes .= "{$an}=\"{$av}\" ";
		}
	
		$templates = &$this->getTemplates();
		if (!$templates) return '';
		$all_templates = array_key_exists('ov', $templates) ? array_keys($templates['ov']) : array();
		if ( array_key_exists('df', $templates) ){
			foreach ($templates['df'] as $tpl => $lb) $all_templates[] = $tpl;
		}
		$is_valid_field_value = is_string($field_value) && in_array($field_value, $all_templates);
		if (!$is_valid_field_value && is_array($field_value)){
			$intersect_values = array_intersect($field_value, $all_templates);
			$is_valid_field_value = count($intersect_values) > 0;
		}
		if (!$is_valid_field_value){
			$field_value = 'default';
		}
	
		$select_html = '<select ' . $select_attributes . '>';
		if ( array_key_exists('ov', $templates) && count($templates['ov']) ){
			$select_html .= '<optgroup label="'. __('Override by Theme', 'yatheme') .'">';
			foreach ($templates['ov'] as $name => $label) {
				$select_html .= '<option value="' . $name . '"';
				if ($name == $field_value || (is_array($field_value)&&in_array($name, $field_value))){ $select_html .= ' selected="selected"';}
				$select_html .=  '>'.$label.'</option>';
			};
			$select_html .= '</optgroup>';
		}
		if ( array_key_exists('df', $templates) && count($templates['df']) ){
			$select_html .= '<optgroup label="'. __('Default Template', 'yatheme') .'">';
			foreach ($templates['df'] as $name => $label) {
				$select_html .= '<option value="' . $name . '"';
				if ($name == $field_value || (is_array($field_value)&&in_array($name, $field_value))){ $select_html .= ' selected="selected"'; }
				if (array_key_exists('ov', $templates) && array_key_exists($name, $templates['ov'])){ $select_html .= ' disabled="disabled"'; }
				$select_html .=  '>'.$label.'</option>';
			};
			$select_html .= '</optgroup>';
		}
		$select_html .= '</select>';
		return $select_html;
	}
	
	public function category_select( $field_name, $opts = array(), $field_value = null ){
		$default_options = array(
				'multiple' => false,
				'disabled' => false,
				'size' => 5,
				'class' => 'widefat',
				'required' => false,
				'autofocus' => false,
				'form' => false,
		);
		$opts = wp_parse_args($opts, $default_options);
	
		if ( (is_string($opts['multiple']) && strtolower($opts['multiple'])=='multiple') || (is_bool($opts['multiple']) && $opts['multiple']) ){
			$opts['multiple'] = 'multiple';
			if ( !is_numeric($opts['size']) ){
				if ( intval($opts['size']) ){
					$opts['size'] = intval($opts['size']);
				} else {
					$opts['size'] = 5;
				}
			}
		} else {
			// is not multiple
			unset($opts['multiple']);
			unset($opts['size']);
			if (is_array($field_value)){
				$field_value = array_shift($field_value);
			}
			if (array_key_exists('allow_select_all', $opts) && $opts['allow_select_all']){
				unset($opts['allow_select_all']);
				$allow_select_all = '<option value="0">All Categories</option>';
			}
		}
	
		if ( (is_string($opts['disabled']) && strtolower($opts['disabled'])=='disabled') || is_bool($opts['disabled']) && $opts['disabled'] ){
			$opts['disabled'] = 'disabled';
		} else {
			unset($opts['disabled']);
		}
	
		if ( (is_string($opts['required']) && strtolower($opts['required'])=='required') || (is_bool($opts['required']) && $opts['required']) ){
			$opts['required'] = 'required';
		} else {
			unset($opts['required']);
		}
	
		if ( !is_string($opts['form']) ) unset($opts['form']);
	
		if ( !isset($opts['autofocus']) || !$opts['autofocus'] ) unset($opts['autofocus']);
	
		$opts['id'] = $this->get_field_id($field_name);
	
		$opts['name'] = $this->get_field_name($field_name);
		if ( isset($opts['multiple']) ){
			$opts['name'] .= '[]';
		}
		$select_attributes = '';
		foreach ( $opts as $an => $av){
			$select_attributes .= "{$an}=\"{$av}\" ";
		}
		
		$categories = get_categories();
		// if (!$templates) return '';
		$all_category_ids = array();
		foreach ($categories as $cat) $all_category_ids[] = (int)$cat->cat_ID;
		
		$is_valid_field_value = is_numeric($field_value) && in_array($field_value, $all_category_ids);
		if (!$is_valid_field_value && is_array($field_value)){
			$intersect_values = array_intersect($field_value, $all_category_ids);
			$is_valid_field_value = count($intersect_values) > 0;
		}
		if (!$is_valid_field_value){
			$field_value = '0';
		}
	
		$select_html = '<select ' . $select_attributes . '>';
		if (isset($allow_select_all)) $select_html .= $allow_select_all;
		foreach ($categories as $cat){
			$select_html .= '<option value="' . $cat->cat_ID . '"';
			if ($cat->cat_ID == $field_value || (is_array($field_value)&&in_array($cat->cat_ID, $field_value))){ $select_html .= ' selected="selected"';}
			$select_html .=  '>'.$cat->name.'</option>';
		}
		$select_html .= '</select>';
		return $select_html;
	}
	
	public function update( $new_instance, $old_instance ){
		if ( !array_key_exists('widget_template', $new_instance) ){
			$new_instance['widget_template'] = 'default';
		}
		$update_template = $this->getTemplatePath($new_instance['widget_template'], '_update');
		if ( $update_template ){
			require $update_template;
		}
		return isset($instance) ? $instance : $new_instance;
	}
	
	public function form( $instance ){
		if ( is_null($instance) ) $instance = array();
		if ( !array_key_exists('widget_template', $instance) ){
			$instance['widget_template'] = 'default';
		}
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'yatheme')?></label>
			<br />
			<input class="widefat"
				id="<?php echo $this->get_field_id('title'); ?>"
				name="<?php echo $this->get_field_name('title'); ?>" type="text"
				value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('widget_template'); ?>"><?php _e("Template", 'yatheme')?></label>
			<br/>
			<?php echo $this->widget_template_select('widget_template', array(), $instance['widget_template']); ?>
		</p>
		<?php
		$form_template = $this->getTemplatePath($instance['widget_template'], '_form');
		if ( $form_template ){
			require $form_template;
		}
	}
	
	public function widget( $args, $instance ){
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo isset($instance['widget_before']) ? $instance['widget_before'] : $before_widget;
		if ( isset($instance['widget_title_before']) && !empty($instance['widget_title_before'])){
			$before_title = $instance['widget_title_before'];
		}
		if ( isset($instance['widget_title_after']) && !empty($instance['widget_title_after'])){
			$before_title = $instance['widget_title_after'];
		}
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
		
		is_null($instance) or extract($instance);
		
		if ( file_exists( $template = $this->getTemplatePath($widget_template) ) ){
			require $template;
		}
		
		echo isset($instance['widget_after']) ? $instance['widget_after'] : $after_widget;
	}
}

endif;


