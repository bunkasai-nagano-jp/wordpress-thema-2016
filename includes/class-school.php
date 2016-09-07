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
					try {
						$start_date = new DateTime( get_field( 'startDate' ) );
					} catch (Exception $e) {
						echo $e->getMessage();
						exit( 1 );
					}
					$this->post[] = [
					'year' => $start_date->format( 'Y' ),
					'url'  => get_permalink(),
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
}
