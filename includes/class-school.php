<?php

class School {
	public $school_name;
	public $municipality_name;
	public $post = [];

	public function __construct( $school_name ) {
		$posts = new WP_Query( [
			'meta_key'     => 'schoolName',
			'meta_value'   => esc_sql( $school_name ),
			'meta_type'    => 'CHAR',
			'meta_compare' => '=',
		] );
		if ( $posts->have_posts() ) : while ( $posts->have_posts() ) :$posts->the_post();
				$year = $this->get_post_year( $posts->ID );
				if ( ! $this->municipality_name ) {
					$this->municipality_name = $this->get_category_parent_name( $posts->ID );
				}
				$this->post[] = [
				'year'                => $year,
				'name'                => get_field( 'name' ),
				'date'                => $this->get_event_date(),
				'public_open_unknown' => get_field( 'public_unknown' ),
				'public_open'         => $this->get_public_open(),
				'permalink'           => get_permalink(),
				];
			endwhile;
		endif;
		$this->set_school_name( $school_name );
	}

	/**
	 * 学校名を設定する関数
	 *
	 * @param string $school_name 学校名.
	 */
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

	/**
	 * 投稿の親カテゴリー名を取得する関数
	 *
	 * 投稿IDからカテゴリーオブジェクトを取得する.
	 * カテゴリーオブジェクトの先頭の要素(最上位のカテゴリー)のcat_nameを返す.
	 *
	 * @param string $post_id 投稿ID.
	 *
	 * @return string カテゴリー名
	 */
	private function get_category_parent_name( $post_id ) {
		$category = get_the_category( $post_id );

		return $category[0]->cat_name;
	}

	/**
	 * 日本のタイムゾーンでDateTimeオブジェクトを作成する
	 *
	 * タイムゾーンを'Asia/Tokyo'に指定した上でDateTimeオブジェクトを作成する。
	 * タイムゾーンを指定せずに作成した場合、タイムゾーンがUTCになる。
	 * その指定を省略するためのラッパー関数。
	 *
	 * @param string $string 日付/時刻 文字列
	 *
	 * @return DateTime
	 */
	private function get_datetime_t( $string ) {
		$datetime = new DateTime( $string, new DateTimeZone( 'Asia/Tokyo' ) );

		return $datetime;
	}

	/**
	 * 開催期間を取得する関数
	 *
	 * 配列に開始日と終了日を追加して返す。
	 * ループの中で使うことが前提。
	 *
	 * @access private
	 * @todo ループの外でも使えるようにする。
	 *
	 * @return array|bool
	 */
	private function get_event_date() {
		$date = [];
		if ( get_field( 'startDate' ) or get_field( 'endDate' ) ) :
			if ( get_field( 'startDate' ) ) {
				$date[] = $this->get_datetime_t( get_field( 'startDate' ) );
			}
			if ( get_field( 'endDate' ) ) {
				$date[] = $this->get_datetime_t( get_field( 'endDate' ) );
			}

			return $date;
		else :
			return false;
		endif;
	}

	/**
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
					$public_open_tmp[] = $this->get_datetime_t( get_sub_field( 'public_open_day' ) );
				endif;
			endwhile;
		elseif ( get_field( 'publicStartDate' ) and get_field( 'publicEndDate' ) ) :
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
		}
		if ( $public_open ) {
			return $public_open;
		} else {
			return false;
		}
	}
}
