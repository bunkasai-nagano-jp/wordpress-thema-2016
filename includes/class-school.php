<?php

class School {
	public $school_name;
	public $municipality_name;
	public $event = [];

	/**
	 * School constructor.
	 *
	 * @param string $school_name 学校名.
	 */
	public function __construct( $school_name ) {
		try {
			$posts = $this->fetch_posts( $school_name );
			if ( $posts->have_posts() ) : while ( $posts->have_posts() ) :$posts->the_post();
					$year = $this->get_post_year( $posts->ID );
					if ( ! $this->municipality_name ) {
						$this->municipality_name = $this->get_category_parent_name( $posts->ID );
					}
					if ( ! $this->school_name ) {
						$this->set_school_name( get_field( 'schoolName' ) );
					}
					$this->event[] = [
					'year'                => $year,
					'name'                => get_field( 'name' ),
					'event_date'          => $this->get_event_date(),
					'public_open_unknown' => get_field( 'public_unknown' ),
					'public_open'         => $this->get_public_open(),
					'permalink'           => get_permalink(),
					];
			endwhile;
			endif;
		} catch ( Exception $e ) {
			return;
		}
	}

	/**
	 * @param $school_name
	 *
	 * @return WP_Query
	 * @throws Exception
	 */
	private function fetch_posts( $school_name ) {
		$posts = new WP_Query( [
			'meta_key'     => 'schoolName',
			'meta_value'   => $school_name,
			'meta_type'    => 'CHAR',
			'meta_compare' => '=',
		] );
		if ( ! $posts ) {
			throw new Exception( '学校が存在しない' );
		} else {
			return $posts;
		}
	}

	/**
	 * 学校名を設定する関数
	 *
	 * @param string $school_name 学校名.
	 */
	public function set_school_name( $school_name ) {
		$this->school_name = $school_name;
	}

	/**
	 * 学校名を取得する関数
	 *
	 * @return string 学校名.
	 */
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
	 * @param string $string 日付/時刻 文字列.
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
	 * 投稿IDを指定することも可能。
	 *
	 * @access private
	 *
	 * @param string|bool $post_id 投稿ID.
	 *
	 * @return array|bool
	 */
	private function get_event_date( $post_id = false ) {
		$event_date = [];
		if ( get_field( 'startDate', $post_id ) or get_field( 'endDate', $post_id ) ) :
			if ( get_field( 'startDate', $post_id ) ) {
				$event_date[] = $this->get_datetime_t( get_field( 'startDate', $post_id ) );
			}
			if ( get_field( 'endDate', $post_id ) ) {
				$event_date[] = $this->get_datetime_t( get_field( 'endDate', $post_id ) );
			}

			return $event_date;
		else :
			return false;
		endif;
	}

	/**
	 * 一般公開情報を取得する関数
	 *
	 * @param string $post_id 投稿ID.
	 *
	 * @return array|bool
	 */
	private function get_event_public_open_date( $post_id = false ) {
		$event_public_open_date = [];
		if ( have_rows( 'public_open', $post_id ) ) :
			while ( have_rows( 'public_open', $post_id ) ) : the_row();
				if ( get_sub_field( 'public_open_day' ) and get_sub_field( 'public_open_start_time' ) and get_sub_field( 'public_open_end_time' ) ) :
					$event_public_open_start  = get_sub_field( 'public_open_day' ) . ' ' . get_sub_field( 'public_open_start_time' );
					$event_public_open_end    = get_sub_field( 'public_open_day' ) . ' ' . get_sub_field( 'public_open_end_time' );
					$event_public_open_date[] = [
						'event_public_open_start' => $this->get_datetime_t( $event_public_open_start ),
						'event_public_open_end'   => $this->get_datetime_t( $event_public_open_end ),
					];
				elseif ( get_sub_field( 'public_open_day' ) ) :
					$event_public_open_date[] = $this->get_datetime_t( get_sub_field( 'public_open_day' ) );
				endif;
			endwhile;
		elseif ( get_field( 'publicStartDate', $post_id ) and get_field( 'publicEndDate', $post_id ) ) :
			$event_public_open_start  = get_field( 'publicStartDate', $post_id );
			$event_public_open_end    = get_field( 'publicEndDate', $post_id );
			$event_public_open_date[] = [
				'event_public_open_start' => $this->get_datetime_t( $event_public_open_start ),
				'event_public_open_end'   => $this->get_datetime_t( $event_public_open_end ),
			];
		endif;
		if ( $event_public_open_date ) {
			return $event_public_open_date;
		} else {
			return false;
		}
	}
}
