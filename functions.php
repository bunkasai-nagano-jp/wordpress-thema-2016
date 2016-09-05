<?php
get_template_part( 'includes/config' );
get_template_part( 'includes/register' );

get_template_part( 'functions/functions' );
get_template_part( 'functions/pagination' );
get_template_part( 'functions/google-map' );
get_template_part( 'functions/relation-category-list' );

function get_school_page() {
	get_template_part( 'school' );
}

add_shortcode( 'school', 'get_school_page' );

class NavbarLinkList extends Walker {
	public function walk( $elements, $max_depth ) {
		$list = array();

		foreach ( $elements as $item ) {
			$list[] = "<a class='nav-item nav-link' href='$item->url'>$item->title</a>";
		}

		return join( $list );
	}
}

function relation_post() {
	$category    = get_the_category();
	$category_id = $category[0]->cat_ID;
	$post_id     = get_the_ID();
	$start_date  = get_field( 'startDate' );
	$year        = date( 'Y', strtotime( $start_date ) );

	$args  = array(
		'meta_query'     => array(
			array(
				'key'     => 'startDate',
				'value'   => array( $year . '/01/01', $year . '/12/31' ),
				'compare' => 'BETWEEN',
				'type'    => 'DATE',
			),
		),
		'cat'            => $category_id,
		'posts_per_page' => 2,
		'post__not_in'   => array( $post_id ),
	);
	$posts = query_posts( $args );

	return $posts;
}
