<?php
$instance = array();

// strip tag on text field
$instance['title'] = strip_tags( $new_instance['title'] );

// int or array
if ( array_key_exists('category', $new_instance) ){
	if ( is_array($new_instance['category']) ){
		$instance['category'] = array_map( 'intval', $new_instance['category'] );
	} else {
		$instance['category'] = intval($new_instance['category']);
	}
}

if ( array_key_exists('category_order', $new_instance) ){
	$instance['category_order'] = strip_tags( $new_instance['category_order'] );
	
	if ( empty($instance['category_order']) ){
		$instance['category_order'] = implode(', ', @$instance['category']);
	} else {
		$o = preg_split('/[\s,]+/', $instance['category_order'], -1, PREG_SPLIT_NO_EMPTY);
		$o2 = array();
		foreach($o as $oo){
			$o2[$oo] = intval($oo);
		}
		$c = $instance['category'];
		settype($c, 'array');
		$c2 = array();
		foreach($c as $cc) $c2[$cc ] = $cc;
		foreach ($o2 as $oo => $val){
			if ( !isset($c2[$oo]) ) unset($o2[$oo]);
		}
		foreach ($c2 as $cc => $val){
			if ( !isset($o2[$cc]) ) $o2[$cc] = $cc;
		}
		$instance['category_order'] = implode(', ', $o2);
	}
}
// update post options
if ( array_key_exists('orderby', $new_instance) ){
	$instance['orderby'] = strip_tags( $new_instance['orderby'] );
}

if ( array_key_exists('order', $new_instance) ){
	$instance['order'] = strip_tags( $new_instance['order'] );
}

if ( array_key_exists('numberposts', $new_instance) ){
	$instance['numberposts'] = intval( $new_instance['numberposts'] );
}

if ( array_key_exists('length', $new_instance) ){
	$instance['length'] = intval( $new_instance['length'] );
}

$instance['widget_template'] = strip_tags( $new_instance['widget_template'] );