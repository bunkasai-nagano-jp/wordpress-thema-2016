<?php
// titleタグのサポート
add_theme_support('title-tag');

// head内のlink要素を停止
remove_action('wp-head', 'rsd_link');
remove_action('wp-head', 'feed_links', 2);
remove_action('wp-head', 'rsd_links_extra', 3);

// カスタムメニューの登録
register_nav_menus(
	array(
	'navbar' => __( 'Navbar', 'wp-thema' ),
	)
);

// セルフピンバック禁止
function no_self_pingst (&$links) {
	$home = home_url();
	foreach ( $links as $l => $link )
	if ( 0 === strpos($link, $home) )
	unset($links[$l]);
}
add_action('pre_ping', 'no_self_pingst');

// ウィジェット追加
function my_widgets_init() {
	register_sidebar(
		array(
			'name'          => __('Primary Sidebar', 'stinger5'),
			'id'            => 'sidebar-1',
			'before_widget' => '<ul class="hidden-xs hidden-sm"><li>',
			'after_widget'  => '</li></ul>',
			'before_title'  => '<h4 class="menu_underh1">',
			'after_title'   => '</h4>',
		)
	);
}
add_action('widgets_init', 'my_widgets_init');

// cssとjsのバージョンを削除する
function vc_remove_wp_ver_css_js($src) {
	if ( strpos($src, 'ver=') )
	$src = remove_query_arg('ver', $src);
	return $src;
}
add_filter('style_loader_src', 'vc_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'vc_remove_wp_ver_css_js', 9999);

// 画像サイズを定義
if ( !isset($content_width) ) {
 $content_width = 580;
}

// 管理画面にオリジナルのスタイルを適用
add_editor_style("style.css"); // メインのCSS
