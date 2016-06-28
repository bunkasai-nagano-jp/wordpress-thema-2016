<?php

// GoogleMap埋め込み
function get_gmap_url() {
  $gmap = [
    'school_name' => get_field('schoolName'),
    'width'       => get_field('width'),
    'height'      => get_field('height'),
  ];
  $base ='https://www.google.com/maps/embed/v1/place?';
  $google_api_key = 'AIzaSyBfgN4KnKmCL5-Wv3hS-LbQPtsxi_xXdRE';
  if ( $gmap ) {
    $url = $base.'key='.$google_api_key.'&q='.urlencode($gmap['school_name']);
    $width_attr = 'width="'.$gmap['width'].'"';
    $height_attr = 'height="'.$gmap['height'].'"';
    $iframe = '<iframe '.$width_attr.' '.$height_attr.' '.' frameborder="0" style="border:0" src="'.$url.'" allowfullscreen></iframe>';
    return '<div class="gmap">' . $iframe . '</div>';
  }
}

add_shortcode ('gmap', 'get_gmap_url');

function get_gmap_sv_url($width = 400, $height = 300) {
  $base = 'https://maps.googleapis.com/maps/api/streetview?';
	$google_api_key = 'AIzaSyBfgN4KnKmCL5-Wv3hS-LbQPtsxi_xXdRE';
	$width = $width;
	$height = $height;
	$location = get_field('streetviewLocation');
	$fov = get_field('streetviewFov');
	$pitch = get_field('streetviewPitch');
	$heading = get_field('heading');
	if ( !$location ) {
		return null;
	}
	else {
		$url = $base . 'size=' . $width . 'x' . $height .'&location=' . $location . '&fov=' . $fov . "&pitch=" . $pitch . '&heading=' . $heading .'&key=' . $google_api_key;
		return $url;
	}
}
add_shortcode ('getGSV', 'get_gmap_sv_url');
