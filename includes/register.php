<?php
// jQuery
function register_jq_script() {
	if ( !is_admin() ) {
		wp_deregister_script('jquery');
		wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', array(), false, false);
	}
}
add_action('wp_enqueue_scripts', 'register_jq_script');

// Bootstrap
function register_bootstrap () {
  wp_enqueue_style('bootstrap', get_template_directory_uri(). '/css/bootstrap.css', array(), false, 'all');
	wp_enqueue_script('tether-script', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.2/js/tether.min.js', array(), false, false);
	wp_enqueue_script('bootstrap-script', 'https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js', array(), false, false);
}
add_action('wp_enqueue_scripts', "register_bootstrap");

// Font Awesome
function register_fa_style() {
	$ver = '4.6.3';
	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/'.$ver.'/css/font-awesome.min.css', array(), false, 'all');
}
add_action('wp_enqueue_scripts', 'register_fa_style');

// テーマCSS
function register_theme_style() {
	wp_enqueue_style('theme_style', get_template_directory_uri(). '/style.css', array(), false, 'all');
}
add_action('wp_enqueue_scripts', 'register_theme_style');
