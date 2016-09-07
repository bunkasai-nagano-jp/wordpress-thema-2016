<?php

class School {
	public $school_name;
	public $municipality_name;
	public $post = array();
	public function __construct( $school_name ) {

			$posts = new WP_Query( array(
				'meta_key'     => 'schoolName',
				'meta_value'   => esc_sql($school_name),
				'meta_type'    => 'CHAR',
				'meta_compare' => '=',
			) );
			if ( $posts->have_posts() ) : while ( $posts->have_posts() ) :$posts->the_post();
					$year = $this->get_post_year( $posts->ID );
					}
					$this->post[] = [
					'url'  => get_permalink(),
					'year' => $year,
					];
			endwhile;
			endif;

		$this->set_school_name( $school_name );
	}
	public function set_school_name( $school_name ) {
		$this->school_name = $school_name;
	}
	public function get_school_name() {
		return $this->school_name;
	}
	private function get_post_year( $id ) {
			$start_date = new DateTime( get_field( 'startDate', $id ) );
		return $start_date->format( 'Y' );
	}
}
