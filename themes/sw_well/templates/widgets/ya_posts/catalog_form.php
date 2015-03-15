<?php
$categoryid     = isset( $instance['category'] )    ? $instance['category'] : 0;
$category_order = isset( $instance['category_order'] ) ? strip_tags($instance['category_order']) : '';
$orderby    = isset( $instance['orderby'] )     ? strip_tags($instance['orderby']) : 'ID';
$order      = isset( $instance['order'] )       ? strip_tags($instance['order']) : 'ASC';
$number     = isset( $instance['numberposts'] ) ? intval($instance['numberposts']) : 5;
$length     = isset( $instance['length'] )      ? intval($instance['length']) : 25;
?>
<p style="margin: 1em 0 0;"><b>Category Options:</b></p>
<p>
	<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category ID', 'yatheme')?></label>
	<br />
	<?php echo $this->category_select('category', array('multiple' => true, 'size' => 10), $categoryid); ?>
</p>

<p>
	<label for="<?php echo $this->get_field_id('category_order'); ?>"><?php _e('Category Order', 'yatheme')?></label>
	<br />
	<input class="widefat"
		id="<?php echo $this->get_field_id('category_order'); ?>"
		name="<?php echo $this->get_field_name('category_order'); ?>" type="text" <?php if (empty($category_order)): ?> readonly="true"<?php endif; ?>
		value="<?php echo esc_attr($category_order); ?>" />
</p>
<p style="margin: 1em 0 0;"><b>Post Options:</b></p>
<p>
	<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby', 'yatheme')?></label>
	<br />
	<?php $allowed_keys = array('name' => 'Name', 'author' => 'Author', 'date' => 'Date', 'title' => 'Title', 'modified' => 'Modified', 'parent' => 'Parent', 'ID' => 'ID', 'rand' =>'Rand', 'comment_count' => 'Comment Count'); ?>
	<select class="widefat"
		id="<?php echo $this->get_field_id('orderby'); ?>"
		name="<?php echo $this->get_field_name('orderby'); ?>">
		<?php
		$option ='';
		foreach ($allowed_keys as $value => $key) :
			$option .= '<option value="' . $value . '" ';
			if ($value == $orderby){
				$option .= 'selected="selected"';
			}
			$option .=  '>'.$key.'</option>';
		endforeach;
		echo $option;
		?>
	</select>
</p>

<p>
	<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order', 'yatheme')?></label>
	<br />
	<select class="widefat"
		id="<?php echo $this->get_field_id('order'); ?>"
		name="<?php echo $this->get_field_name('order'); ?>">
		<option value="DESC" <?php if ($order=='DESC'){?> selected="selected"
		<?php } ?>>
			<?php _e('Descending', 'yatheme')?>
		</option>
		<option value="ASC" <?php if ($order=='ASC'){?> selected="selected"
		<?php } ?>>
			<?php _e('Ascending', 'yatheme')?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo $this->get_field_id('numberposts'); ?>"><?php _e('# Posts each Category', 'yatheme')?></label>
	<br />
	<input class="widefat"
		id="<?php echo $this->get_field_id('numberposts'); ?>"
		name="<?php echo $this->get_field_name('numberposts'); ?>" type="text"
		value="<?php echo esc_attr($number); ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('length'); ?>"><?php _e('Post title length (in words): ', 'yatheme')?></label>
	<br />
	<input class="widefat"
		id="<?php echo $this->get_field_id('length'); ?>"
		name="<?php echo $this->get_field_name('length'); ?>" type="text"
		value="<?php echo esc_attr($length); ?>" />
</p>