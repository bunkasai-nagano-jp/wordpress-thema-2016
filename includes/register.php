<?php
/**
 * jQuery
 */
function register_jq_script() {
	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.1.1.min.js', [], false, false );
	}
}

add_action( 'wp_enqueue_scripts', 'register_jq_script' );
/**
 * Bootstrap
 */
function register_bootstrap() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', [], false, 'all' );
	wp_enqueue_script( 'tether-script', get_template_directory_uri() . '/js/tether.min.js', [], false, false );
	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', [], false, false );
}

add_action( 'wp_enqueue_scripts', 'register_bootstrap' );
/**
 * Twitter Widgets
 */
function register_twitter_widgets() {
	wp_enqueue_script( 'twitter-widgets', '//platform.twitter.com/widgets.js', [], false, true );
}

add_action( 'wp_enqueue_scripts', 'register_twitter_widgets' );
/**
 * Google CSE
 */
function register_google_cse() {
	wp_enqueue_script( 'google-cse', '//cse.google.com/cse/brand?form=cse-search-box&lang=ja', [], false, true );
}

add_action( 'wp_enqueue_scripts', 'register_google_cse' );
/**
 * テーマCSS
 */
function register_theme_style() {
	wp_enqueue_style( 'theme_style', get_template_directory_uri() . '/style.css', [], false, 'all' );
}

add_action( 'wp_enqueue_scripts', 'register_theme_style' );


/**
 * Font Awesome
 */
function register_fa_style() {
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', [], false, 'all' );
}

add_action( 'wp_enqueue_scripts', 'register_fa_style' );

