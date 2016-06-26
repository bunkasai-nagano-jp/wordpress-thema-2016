<?php
add_theme_support('title-tag');

function vc_remove_wp_ver_css_js($src) {
	if ( strpos($src, 'ver=') )
	$src = remove_query_arg('ver', $src);
	return $src;
}
add_filter('style_loader_src', 'vc_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'vc_remove_wp_ver_css_js', 9999);

function register_jq_script() {
	if ( !is_admin() ) {
		wp_deregister_script('jquery');
		wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', array(), false, false);
	}
}
add_action('wp_enqueue_scripts', 'register_jq_script');

function register_bootstrap () {
	wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css', array(), false, false);
	wp_enqueue_script('tether-script', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.2/js/tether.min.js', array(), false, false);
	wp_enqueue_script('bootstrap-script', 'https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js', array(), false, false);
}
add_action('wp_enqueue_scripts', "register_bootstrap");

function register_fa_style() {
	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), false, false);
}
add_action('wp_enqueue_scripts', 'register_fa_style');

function register_theme_style() {
	wp_enqueue_style('theme_style', get_template_directory_uri(). '/style.css', array(), false, false);
}
add_action('wp_enqueue_scripts', 'register_theme_style');

//カスタムメニュー
register_nav_menus(
	array(
	'navbar' => __( 'Navbar', 'wp-thema' ),
	)
);

// 管理画面にオリジナルのスタイルを適用
add_editor_style("style.css");		// メインのCSS
add_editor_style('editor-style.css');		// これは入れておこう

if ( !isset($content_width) ) $content_width = 580;

function custom_editor_settings($initArray) {
		$initArray['body_id'] = 'primary';		// id の場合はこれ
		$initArray['body_class'] = 'post';		// class の場合はこれ
		return $initArray;
}
add_filter('tiny_mce_before_init', 'custom_editor_settings');

//ページャー機能
function pagination ($pages = '', $range = 4) {
	$showitems = ($range * 2)+1;
	global $paged;
	if (!$paged) {
		$paged = 1;
	}
	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if (!$pages) {
			$pages = 1;
		}
	}
	if ( 1 != $pages ) { ?>
		<div class="row">
			<div class="col-md-12 text-xs-center">
				<ul class="pagination">
					<?php if ($paged == 1) { ?>
					<li class="page-item disabled"><a class="page-link" href="" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
						<span class="sr-only">Previous</span></a>
					</li><?php
						}
						else { ?>
					<li class="page-item"><a class="page-link" href="<?php echo get_pagenum_link($paged - 1); ?>" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
						<span class="sr-only">Previous</span></a>
					</li><?php
						}
						for ( $i = 1; $i <= $pages; $i++ ) {
							if ( 1 != $pages &&( ! ($i >= $paged+$range+1 OR $i <= $paged-$range-1) OR $pages <= $showitems) )
							{
								if ($paged == $i) {
									?>
									<li class="page-item active">
										<a class="page-link" href="#"><?php echo $i; ?> <span class="sr-only">(current)</span></a>
									</li>
									<?php
								}
								elseif ($paged != $i) {
									?>
									<li class="page-item">
										<a class="page-link" href="<?php echo get_pagenum_link($i); ?>"><?php echo $i; ?></a>
									</li>
									<?php
								}
							}
						}
						if ($paged == $showitems) { ?>
							<li class="page-item disabled">
								<a class="page-link" href="" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
									<span class="sr-only">Next</span>
								</a>
							</li>
							<?php
						}
						else { ?>
							<li class="page-item">
								<a class="page-link" href="<?php echo get_pagenum_link($paged +1); ?>" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
									<span class="sr-only">Next</span>
								</a>
							</li>
							<?php
						}
						?>
					</ul>
			</div>
		</div>
			<?php
		}
	}

	//セルフピンバック禁止
function no_self_pingst (&$links) {
		$home = home_url();
		foreach ( $links as $l => $link )
		if ( 0 === strpos($link, $home) )
		unset($links[$l]);
}
add_action('pre_ping', 'no_self_pingst');

	//ウイジェット追加
function stinger5_widgets_init() {
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
add_action('widgets_init', 'stinger5_widgets_init');

//更新日の追加
function get_mtime($format) {
	$mtime = get_the_modified_time('Ymd');
	$ptime = get_the_time('Ymd');
	if ( $ptime > $mtime ) {
		return get_the_time($format);
	}
	elseif ( $ptime === $mtime ) {
		return null;
	}
	else {
		return get_the_modified_time($format);
	}
}

// GoogleMap埋め込み
function get_gmap_url() {
	$gmap = [
		'school_name' => get_field('schoolName'),
		'width' => get_field('width'),
		'height' => get_field('height'),
	];
	$google_api_key = 'AIzaSyBfgN4KnKmCL5-Wv3hS-LbQPtsxi_xXdRE';
	if ( ! empty($gmap) ) {
		$iframe = '<iframe width="' . $gmap['width'] . '" height="' . $gmap['height'] . '" frameborder="0" style="border:0" ' . 'src="https://www.google.com/maps/embed/v1/place?key=' . $google_api_key . '&q=' . urlencode($gmap['school_name']) . '" allowfullscreen></iframe>';
				return '<div class="gmap">' . $iframe . '</div>';
	}
}
add_shortcode ('gmap', 'get_gmap_url');

function get_custom_field($field_name) {
	$data = get_field($field_name);
	return $data;
}

function get_custom_field_wrap($attr) {
	if ( empty($attr[0]) ) {
		return '引数を指定してください';
	}
	else {
		return get_custom_field($attr[0]);
	}
}
add_shortcode ('get_data' , 'get_custom_field_wrap');

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
		$url = $base . 'size=' . $width . 'x' . $height	.'&location=' . $location . '&fov=' . $fov . "&pitch=" . $pitch . '&heading=' . $heading .'&key=' . $google_api_key;
		return $url;
	}
}
add_shortcode ('getGSV', 'get_gmap_sv_url');

function get_school_page() {
	get_template_part('school');
}
add_shortcode('school', 'get_school_page' );


function get_school_info( $ID , $param) {
	if ( !empty($ID) ) {
		$custom_fields = get_post_custom( $ID );
		$post = get_post( $ID, ARRAY_A );
		return $post[$param];
	}
	else
	{

	}
}

function is_other_year_post( $school_name ) {
	$args    =  array(
								'meta_value' => $school_name,
							);
	$result  =  get_posts( $args );
	$number  =  count($result);
	if ($number == 1) {
		return false;
	}
	else {
		return true;
	}
}

class navbar_link_list extends Walker {
	public function walk( $elements, $max_depth ) {
		$list = array ();

		foreach ( $elements as $item )
		$list[] = "<a class='nav-item nav-link' href='$item->url'>$item->title</a>";

		return join($list);
	}
}

function relation_post() {
	$category     =  get_the_category();
	$category_id  =  $category[0]->cat_ID;
	$post_id      =  get_the_ID();
	$start_date   =  get_field('startDate');
	$year         =  date("Y", strtotime($start_date));

	$args = array(
					'meta_query'      =>  array(
																	array(
																		'key'      =>  'startDate',
																		'value'    =>  array($year.'/01/01', $year.'/12/31'),
																		'compare'  =>  'BETWEEN',
																		'type'     =>  'DATE'
																	)
																),
					'cat'             =>  $category_id,
					'posts_per_page'  =>  2,
					'post__not_in'    =>  array($post_id),
	);
	$posts = query_posts($args);
	return $posts;
}
