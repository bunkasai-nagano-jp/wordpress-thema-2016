<?php

class School {
	public $school_name;
	public $municipality_name;
	public function __construct( $school_name ) {
	public $post = [];

			$posts = new WP_Query( array(
				'meta_key'     => 'schoolName',
				'meta_value'   => esc_sql( $school_name ),
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
		$start_date = $this->get_datetime_t( get_field( 'startDate', $id ) );

		return $start_date->format( 'Y' );
	}

	private function get_category_parent_name( $id ) {
		$category = get_the_category( $id );

		return $category[0]->cat_name;
	}

	/**
	 * 日本のタイムゾーンでDateTimeオブジェクトを作成する
	 *
	 * @param $string
	 *
	 * @return DateTime
	 */
	private function get_datetime_t( $string ) {
		$datetime = new DateTime( $string, new DateTimeZone( 'Asia/Tokyo' ) );
		return $datetime;
	}
	 * 一般公開期間を取得する
	 *
	 * @return array|bool
	 */
	private function get_public_open() {
		$public_open     = [];
		$public_open_tmp = [];
		if ( have_rows( 'public_open' ) ) :
			while ( have_rows( 'public_open' ) ) : the_row();
				if ( get_sub_field( 'public_open_day' ) and get_sub_field( 'public_open_start_time' ) and get_sub_field( 'public_open_end_time' ) ) :
					$public_open_start = get_sub_field( 'public_open_day' ) . ' ' . get_sub_field( 'public_open_start_time' );
					$public_open_end   = get_sub_field( 'public_open_day' ) . ' ' . get_sub_field( 'public_open_end_time' );
					$public_open[]     = [
						'public_open_start' => $this->get_datetime_t( $public_open_start ),
						'public_open_end'   => $this->get_datetime_t( $public_open_end ),
					];
				elseif ( get_sub_field( 'public_open_day' ) ) :
				endif;
			endwhile;
		elseif ( get_field( 'publicStartDate' ) and get_field( 'publicEndDate' ) ) :
						$public_open_tmp[] = $this->get_datetime_t( get_sub_field( 'public_open_day' ) );
				$public_open_start = get_field( 'publicStartDate' );
				$public_open_end   = get_field( 'publicEndDate' );
				$public_open[]     = [
					'public_open_start' => $this->get_datetime_t( $public_open_start ),
					'public_open_end'   => $this->get_datetime_t( $public_open_end ),
				];
		endif;
		if ( $public_open_tmp ) {
				asort( $public_open_tmp );
				$public_open['public_open_start'] = array_shift( $public_open_tmp );
				$public_open['public_open_end']   = array_pop( $public_open_tmp );
				$public_open_tmp                  = [];
		}
		if ( $public_open ) {
			return $public_open;
		} else {
			return false;
		}
	}
}
