<?php
function vc_remove_wp_ver_css_js($src)
{
if ( strpos($src, 'ver=') )
	$src = remove_query_arg('ver', $src);
	return $src;
}
add_filter('style_loader_src', 'vc_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'vc_remove_wp_ver_css_js', 9999);

function register_jq_script()
{
	if ( ! is_admin() )
  {
		$script_dir = get_template_directory_uri();
		wp_deregister_script('jquery');
		wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', array(), false, false);
	}
}
add_action('wp_enqueue_scripts', 'register_jq_script');

function register_fa_style()
{
	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), false, false);
}
add_action('wp_enqueue_scripts', 'register_fa_style');

function register_open_sans_style()
{
	wp_enqueue_style('open_sans', '//fonts.googleapis.com/css?family=Open+Sans', array(), false, false);
}
add_action('wp_enqueue_scripts', 'register_open_sans_style');

function register_ionicons_style()
{
	wp_enqueue_style('ionicons', get_template_directory_uri() . '/css/ionicons.css', array(), false, false);
}
add_action('wp_enqueue_scripts', 'register_ionicons_style');

function register_bootstrap_style()
{
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), false, false);
}
add_action('wp_enqueue_scripts', 'register_bootstrap_style');

function register_base_script()
{
	wp_enqueue_script('base', get_template_directory_uri() . '/js/base.js', array());
}
add_action('wp_enqueue_scripts', 'register_base_script');

function register_theme_style()
{
	wp_enqueue_style('theme_style', get_template_directory_uri() . '/style.css', array(), false, false);
}
add_action('wp_enqueue_scripts', 'register_theme_style');

//WordPress の投稿スラッグを自動的に生成する
function auto_post_slug($slug, $post_ID, $post_status, $post_type)
{
	if ( preg_match('/(%[0-9a-f]{2})+/', $slug) )
	{
		$slug = utf8_uri_encode($post_type) . '-' . $post_ID;
	}
	return $slug;
}
add_filter('wp_unique_post_slug', 'auto_post_slug', 10, 4);

//カスタムヘッダー
$custom_header = array(
	'random-default' => false,
	'width' => 980,
	'height' => 250,
	'flex-height' => true,
	'flex-width' => false,
	'default-text-color' => '',
	'header-text' => false,
	'uploads' => true,
	'default-image' => get_template_directory_uri() . '/images/stinger5.png',
);
add_theme_support('custom-header', $custom_header);

// 抜粋の長さを変更する
function custom_excerpt_length($length)
{
	return 40;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

// 文末文字を変更する
function custom_excerpt_more($more)
{
	return ' ... ';
}
add_filter('excerpt_more', 'custom_excerpt_more');

//アイキャッチサムネイル
add_theme_support('post-thumbnails');
add_image_size('thumb100', 100, 100, true);
add_image_size('thumb150', 150, 150, true);


//カスタムメニュー
register_nav_menus(array('navbar' => 'ナビゲーションバー'));

//RSS
add_theme_support('automatic-feed-links');

// 管理画面にオリジナルのスタイルを適用
add_editor_style("style.css");		// メインのCSS
add_editor_style('editor-style.css');		// これは入れておこう
if ( ! isset($content_width) ) $content_width = 580;
function custom_editor_settings($initArray)
{
	$initArray['body_id'] = 'primary';		// id の場合はこれ
	$initArray['body_class'] = 'post';		// class の場合はこれ
	return $initArray;
}
add_filter('tiny_mce_before_init', 'custom_editor_settings');

//投稿用ファイルを読み込む
get_template_part('functions/create-thread');

//ページャー機能
function pagination ($pages = '', $range = 4)
{
	$showitems = ($range * 2)+1;
	global $paged;
	if ( empty($paged) ) $paged = 1;
	if ( $pages == '' )
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages )
		{
			$pages = 1;
		}
	}
	if ( 1 != $pages )
	{
		echo "<div><nav class=\"text-center\"><ul class=\"pagination pagination-lg\">";
		echo "<li><a href='" . get_pagenum_link($paged - 1) . "' aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>";
		for ( $i=1; $i <= $pages; $i++ )
		{
			if ( 1 != $pages &&( ! ($i >= $paged+$range+1 OR $i <= $paged-$range-1) OR $pages <= $showitems) )
			{
				echo ($paged == $i)? "<li class=\"active\"><a href=\"#\">".$i."<span class=\"sr-only\">(current)</span></a></li>":"<li><a href='" . get_pagenum_link($i) . "'>" . $i . "</a></li>";
			}
		}
		echo "<li><a href=\"" . get_pagenum_link($paged +1) . "\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li>";
		echo "</ul></nav></div>\n";
	}
}

//moreリンク
function custom_content_more_link ($output)
{
	$output = preg_replace('/#more-[\d]+/i', '', $output);
	return $output;
}
add_filter('the_content_more_link', 'custom_content_more_link');

//セルフピンバック禁止
function no_self_pingst (&$links)
{
	$home = home_url();
	foreach ( $links as $l => $link )
	if ( 0 === strpos($link, $home) )
	unset($links[$l]);
}
add_action('pre_ping', 'no_self_pingst');

//iframeのレスポンシブ対応
function wrap_iframe_in_div($the_content)
{
	if ( is_singular() )
	{
		$the_content = preg_replace('/< *?iframe/i', '<div class="youtube-container"><iframe', $the_content);
		$the_content = preg_replace('/<\/ *?iframe *?>/i', '</iframe></div>', $the_content);
	}
	return $the_content;
}
add_filter('the_content', 'wrap_iframe_in_div');

//ウイジェット追加
function stinger5_widgets_init()
{
	register_sidebar(
		array(
			'name'=>__('Primary Sidebar', 'stinger5'),
			'id'						=> 'sidebar-1',
			'before_widget' => '<ul><li>',
			'after_widget' => '</li></ul>',
			'before_title' => '<h4 class="menu_underh2">',
			'after_title' => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'=>__('Footer Widget Area', 'stinger5' ),
			'id'						=> 'sidebar-2',
			'before_widget' => '<ul><li>',
			'after_widget' => '</li></ul>',
			'before_title' => '<h4 class="menu_underh2">',
			'after_title' => '</h4>',
		)
	);
}
add_action('widgets_init', 'stinger5_widgets_init');

//更新日の追加
function get_mtime($format)
{
	$mtime = get_the_modified_time('Ymd');
	$ptime = get_the_time('Ymd');
	if ( $ptime > $mtime )
	{
		return get_the_time($format);
	}
	elseif ( $ptime === $mtime )
	{
		return null;
	}
	else
	{
		return get_the_modified_time($format);
	}
}

//GoogleMap埋め込み
function get_gmap_url()
{
	$gmap = [
		'school_name' => get_field('schoolName'),
		'width' => get_field('width'),
		'height' => get_field('height'),
	];
	$google_api_key = 'AIzaSyBfgN4KnKmCL5-Wv3hS-LbQPtsxi_xXdRE';
	if ( ! empty($gmap) )
	{
		$iframe = '<iframe width="' . $gmap['width'] . '" height="' . $gmap['height'] . '" frameborder="0" style="border:0" ' . 'src="https://www.google.com/maps/embed/v1/place?key=' . $google_api_key . '&q=' . urlencode($gmap['school_name']) . '" allowfullscreen></iframe>';
		return '<div class="gmap">' . $iframe . '</div>';
		}
};
add_shortcode ('gmap', 'get_gmap_url');

function get_custom_field($field_name)
{
	$data = get_field($field_name);
	return $data;
}
function get_custom_field_wrap($attr)
{
	if ( empty($attr[0]) )
	{
		return '引数を指定してください';
	}
	else
	{
		return get_custom_field($attr[0]);
	}
}
add_shortcode ('get_data' , 'get_custom_field_wrap');

function get_gmap_sv_url()
{
	$base = 'https://maps.googleapis.com/maps/api/streetview?';
	$google_api_key = 'AIzaSyBfgN4KnKmCL5-Wv3hS-LbQPtsxi_xXdRE';
	$width = '580';
	$height = '300';
	$location = get_field('streetviewLocation');
	$fov = get_field('streetviewFov');
	$pitch = get_field('streetviewPitch');
	$heading = get_field('heading');
	if ( empty($location) )
	{
		$url = get_template_directory_uri() . "/images/no-image.jpg";
		return $url;
	}
	else
	{
		$url = $base . 'size=' . $width . 'x' . $height	.'&location=' . $location . '&fov=' . $fov . "&pitch=" . $pitch . '&heading=' . $heading .'&key=' . $google_api_key;
		return $url;
	}
}
add_shortcode ('getGSV', 'get_gmap_sv_url');
add_theme_support('title-tag');

class MY_WP_Widget_Recent_Posts extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'my_widget_recent_entries', 'description' => __( "BootstrapのためのRecent Posts") );
		parent::__construct('my-recent-posts', __('最近の投稿 Bootstrap'), $widget_ops);
		$this->alt_option_name = 'my_widget_recent_entries';
	}

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'My Recent Posts' );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<ul class="nav nav-pills nav-stacked">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		return $instance;
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}
add_action('widgets_init', function(){
     register_widget( 'MY_WP_Widget_Recent_Posts' );
});
