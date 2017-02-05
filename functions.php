<?php
get_template_part( 'includes/config' );
get_template_part( 'includes/register' );

get_template_part( 'functions/functions' );
get_template_part( 'functions/pagination' );
get_template_part( 'functions/google-map' );
get_template_part( 'functions/relation-category-list' );

get_template_part( 'includes/class-school');

function get_school_page() {
	get_template_part( 'template-parts/school' );
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