<?php

/**
 * GoogleMapの埋め込みURLを取得する関数.
 **/
function get_gmap_url() {
	$school_name    = get_field( 'schoolName' );
	$base           = 'https://www.google.com/maps/embed/v1/place?';
	$google_api_key = 'AIzaSyBfgN4KnKmCL5-Wv3hS-LbQPtsxi_xXdRE';
	if ( $school_name ) {
		$url = $base . 'key=' . $google_api_key . '&q=' . rawurlencode( $school_name );

		return esc_url( $url );
	} else {
		return false;
	}
}

/**
 * GoogleMapを表示する関数.
 **/
function the_gmap() {
	if ( get_gmap_url() ) {
		$url         = get_gmap_url();
		$width_attr  = 'width="' . esc_attr( get_field( 'width' ) ) . '"';
		$height_attr = 'height="' . esc_attr( get_field( 'height' ) ) . '"';
		$iframe      = '<iframe ' . $width_attr . ' ' . $height_attr . ' ' . ' frameborder="0" style="border:0" src="' . $url . '" allowfullscreen></iframe>';
		echo '<div class="gmap">' . $iframe . '</div>';
	} else {
		return false;
	}
}