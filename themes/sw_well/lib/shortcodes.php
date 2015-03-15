<?php

function get_all_icons(){
	$all_icons = explode(',', 'icon-home, icon-home-2, icon-home-3, icon-office, icon-newspaper, icon-pencil, icon-quill, icon-pencil-2, icon-pen, icon-blog, icon-droplet, icon-paint-format, icon-image, icon-image-2, icon-images, icon-camera, icon-music, icon-headphones, icon-play, icon-film, icon-camera-2, icon-dice, icon-pacman, icon-spades, icon-clubs, icon-diamonds, icon-pawn, icon-bullhorn, icon-connection, icon-podcast, icon-feed, icon-book, icon-books, icon-library, icon-file, icon-profile, icon-file-2, icon-file-3, icon-file-4, icon-copy, icon-copy-2, icon-copy-3, icon-paste, icon-paste-2, icon-paste-3, icon-stack, icon-folder, icon-folder-open, icon-tag, icon-tags, icon-barcode, icon-qrcode, icon-ticket, icon-cart, icon-cart-2, icon-cart-3, icon-coin, icon-credit, icon-calculate, icon-support, icon-phone, icon-phone-hang-up, icon-address-book, icon-notebook, icon-envelop, icon-pushpin, icon-location, icon-location-2, icon-compass, icon-map, icon-map-2, icon-history, icon-clock, icon-clock-2, icon-alarm, icon-alarm-2, icon-bell, icon-stopwatch, icon-calendar, icon-calendar-2, icon-print, icon-keyboard, icon-screen, icon-laptop, icon-mobile, icon-mobile-2, icon-tablet, icon-tv, icon-cabinet, icon-drawer, icon-drawer-2, icon-drawer-3, icon-box-add, icon-box-remove, icon-download, icon-upload, icon-disk, icon-storage, icon-undo, icon-redo, icon-flip, icon-flip-2, icon-undo-2, icon-redo-2, icon-forward, icon-reply, icon-bubble, icon-bubbles, icon-bubbles-2, icon-bubble-2, icon-bubbles-3, icon-bubbles-4, icon-user, icon-users, icon-user-2, icon-users-2, icon-user-3, icon-user-4, icon-quotes-left, icon-busy, icon-spinner, icon-spinner-2, icon-spinner-3, icon-spinner-4, icon-spinner-5, icon-spinner-6, icon-binoculars, icon-search, icon-zoom-in, icon-zoom-out, icon-expand, icon-contract, icon-expand-2, icon-contract-2, icon-key, icon-key-2, icon-lock, icon-lock-2, icon-unlocked, icon-wrench, icon-settings, icon-equalizer, icon-cog, icon-cogs, icon-cog-2, icon-hammer, icon-wand, icon-aid, icon-bug, icon-pie, icon-stats, icon-bars, icon-bars-2, icon-gift, icon-trophy, icon-glass, icon-mug, icon-food, icon-leaf, icon-rocket, icon-meter, icon-meter2, icon-dashboard, icon-hammer-2, icon-fire, icon-lab, icon-magnet, icon-remove, icon-remove-2, icon-briefcase, icon-airplane, icon-truck, icon-road, icon-accessibility, icon-target, icon-shield, icon-lightning, icon-switch, icon-power-cord, icon-signup, icon-list, icon-list-2, icon-numbered-list, icon-menu, icon-menu-2, icon-tree, icon-cloud, icon-cloud-download, icon-cloud-upload, icon-download-2, icon-upload-2, icon-download-3, icon-upload-3, icon-globe, icon-earth, icon-link, icon-flag, icon-attachment, icon-eye, icon-eye-blocked, icon-eye-2, icon-bookmark, icon-bookmarks, icon-brightness-medium, icon-brightness-contrast, icon-contrast, icon-star, icon-star-2, icon-star-3, icon-heart, icon-heart-2, icon-heart-broken, icon-thumbs-up, icon-thumbs-up-2, icon-happy, icon-happy-2, icon-smiley, icon-smiley-2, icon-tongue, icon-tongue-2, icon-sad, icon-sad-2, icon-wink, icon-wink-2, icon-grin, icon-grin-2, icon-cool, icon-cool-2, icon-angry, icon-angry-2, icon-evil, icon-evil-2, icon-shocked, icon-shocked-2, icon-confused, icon-confused-2, icon-neutral, icon-neutral-2, icon-wondering, icon-wondering-2, icon-point-up, icon-point-right, icon-point-down, icon-point-left, icon-warning, icon-notification, icon-question, icon-info, icon-info-2, icon-blocked, icon-cancel-circle, icon-checkmark-circle, icon-spam, icon-close, icon-checkmark, icon-checkmark-2, icon-spell-check, icon-minus, icon-plus, icon-enter, icon-exit, icon-play-2, icon-pause, icon-stop, icon-backward, icon-forward-2, icon-play-3, icon-pause-2, icon-stop-2, icon-backward-2, icon-forward-3, icon-first, icon-last, icon-previous, icon-next, icon-eject, icon-volume-high, icon-volume-medium, icon-volume-low, icon-volume-mute, icon-volume-mute-2, icon-volume-increase, icon-volume-decrease, icon-loop, icon-loop-2, icon-loop-3, icon-shuffle, icon-arrow-up-left, icon-arrow-up, icon-arrow-up-right, icon-arrow-right, icon-arrow-down-right, icon-arrow-down, icon-arrow-down-left, icon-arrow-left, icon-arrow-up-left-2, icon-arrow-up-2, icon-arrow-up-right-2, icon-arrow-right-2, icon-arrow-down-right-2, icon-arrow-down-2, icon-arrow-down-left-2, icon-arrow-left-2, icon-arrow-up-left-3, icon-arrow-up-3, icon-arrow-up-right-3, icon-arrow-right-3, icon-arrow-down-right-3, icon-arrow-down-3, icon-arrow-down-left-3, icon-arrow-left-3, icon-tab, icon-checkbox-checked, icon-checkbox-unchecked, icon-checkbox-partial, icon-radio-checked, icon-radio-unchecked, icon-crop, icon-scissors, icon-filter, icon-filter-2, icon-font, icon-text-height, icon-text-width, icon-bold, icon-underline, icon-italic, icon-strikethrough, icon-omega, icon-sigma, icon-table, icon-table-2, icon-insert-template, icon-pilcrow, icon-left-to-right, icon-right-to-left, icon-paragraph-left, icon-paragraph-center, icon-paragraph-right, icon-paragraph-justify, icon-paragraph-left-2, icon-paragraph-center-2, icon-paragraph-right-2, icon-paragraph-justify-2, icon-indent-increase, icon-indent-decrease, icon-new-tab, icon-embed, icon-code, icon-console, icon-share, icon-mail, icon-mail-2, icon-mail-3, icon-mail-4, icon-google, icon-google-plus, icon-google-plus-2, icon-google-plus-3, icon-google-plus-4, icon-google-drive, icon-facebook, icon-facebook-2, icon-facebook-3, icon-instagram, icon-twitter, icon-twitter-2, icon-twitter-3, icon-feed-2, icon-feed-3, icon-feed-4, icon-youtube, icon-youtube-2, icon-vimeo, icon-vimeo2, icon-vimeo-2, icon-lanyrd, icon-flickr, icon-flickr-2, icon-flickr-3, icon-flickr-4, icon-picassa, icon-picassa-2, icon-dribbble, icon-dribbble-2, icon-dribbble-3, icon-forrst, icon-forrst-2, icon-deviantart, icon-deviantart-2, icon-steam, icon-steam-2, icon-github, icon-github-2, icon-github-3, icon-github-4, icon-github-5, icon-wordpress, icon-wordpress-2, icon-joomla, icon-blogger, icon-blogger-2, icon-tumblr, icon-tumblr-2, icon-yahoo, icon-tux, icon-apple, icon-finder, icon-android, icon-windows, icon-windows8, icon-soundcloud, icon-soundcloud-2, icon-skype, icon-reddit, icon-linkedin, icon-lastfm, icon-lastfm-2, icon-delicious, icon-stumbleupon, icon-stumbleupon-2, icon-stackoverflow, icon-pinterest, icon-pinterest-2, icon-xing, icon-xing-2, icon-flattr, icon-foursquare, icon-foursquare-2, icon-paypal, icon-paypal-2, icon-paypal-3, icon-yelp, icon-libreoffice, icon-file-pdf, icon-file-openoffice, icon-file-word, icon-file-excel, icon-file-zip, icon-file-powerpoint, icon-file-xml, icon-file-css, icon-html5, icon-html5-2, icon-css3, icon-chrome, icon-firefox, icon-IE, icon-opera, icon-safari, icon-IcoMoon');
	$all_icons = array_map('trim', $all_icons);
	return $all_icons;
}

// Add Shortcode
function ya_font_icons( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'name' => '*',
			'tagname'  => 'span',
			'attrs' => false
		), $atts )
	);
	$icons = get_all_icons();
	$html = '';
	if ($name == '*' || $name == 'all'){
		foreach ( $icons as $icon ){
			$html .= '<' . $tagname . ' class="' . $icon . '" ' . ($attrs ? attrs : '');
			if ( !is_null($content) ){
				$html .= '>'.$content.'</' . $tagname . '>';
			} else {
				$html .= '></' . $tagname . '>';
			}
		}
	} else {
		if ( strpos($name, 'icon-')!==0 ){
			$name = 'icon-'.$name;
		}
		if ( in_array($name, $icons) ){
			$html .= '<' . $tagname . ' class="' . $name . '" ' . ($attrs ? attrs : '');
			if ( !is_null($content) ){
				$html .= '>'.$content.'</' . $tagname . '>';
			} else {
				$html .= '></' . $tagname . '>';
			}
		} else {
			$html = '';
		}
	}
	
	return $html;

}
add_shortcode( 'iconfont', 'ya_font_icons' );