<?php

class School {

	/**
	 * 学校名
	 *
	 * @var string $school_name
	 */
	public $school_name;
	/**
	 * 文化祭名
	 *
	 * @var string $name
	 */
	public $name;
	/**
	 * カテゴリー
	 *
	 * @var array $category
	 */
	public $category = [];
	/**
	 * 年度別の文化祭情報
	 *
	 * @var array $event
	 */
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
					if ( ! $this->category ) {
						$this->category = $this->get_category( $posts->ID );
					}
					if ( ! $this->school_name ) {
						$this->set_school_name( get_field( 'schoolName' ) );
					}
					if ( ! $this->name ) {
						$this->name = get_field( 'name' );
					}
					$this->event[] = [
					'year'                => $year,
					'event_date'          => $this->get_event_date(),
					'public_open_unknown' => get_field( 'public_unknown' ),
					'public_open'         => $this->set_event_public_open_date(),
					'permalink'           => get_permalink(),
					];
				endwhile;
				$posts->reset_postdata();
			endif;
		} catch ( Exception $e ) {
			return;
		}
	}

	/**
	 * 学校名から投稿を取得する
	 *
	 * @param string $school_name 学校名.
	 *
	 * @return WP_Query
	 * @throws Exception School name is wrong.
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

	/**
	 * 文化祭の開催年を取得する関数
	 *
	 * @param string $post_id 投稿ID.
	 *
	 * @return string
	 */
	public function get_post_year( $post_id ) {
		$start_date = $this->get_datetime_t( get_field( 'startDate', $post_id ) );

		return $start_date->format( 'Y' );
	}

	/**
	 * 投稿の親カテゴリーを取得する関数
	 *
	 * 投稿IDからカテゴリーオブジェクトを取得する.
	 * カテゴリーオブジェクトの先頭の要素(最上位のカテゴリー)のcat_nameを取得する.
	 * カテゴリーオブジェクトの先頭の要素(最上位のカテゴリー)のcat_IDを取得し、リンクを取得する関数へ渡す.
	 * カテゴリー名とリンクを配列に入れて返す.
	 *
	 * @param string $post_id 投稿ID.
	 *
	 * @return array カテゴリー
	 */
	private function get_category( $post_id ) {
		$categories = get_the_category( $post_id );
		$category   = [
			'category_name' => $categories[0]->cat_name,
			'category_link' => get_category_link( $categories[0]->cat_ID ),
		];

		return $category;
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
	static function get_datetime_t( $string = '' ) {
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
	 * 一般公開情報を設定する関数
	 *
	 * @param bool|string $post_id 投稿ID.
	 *
	 * @return array|bool
	 */
	private function set_event_public_open_date( $post_id = false ) {
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
		elseif ( get_field( 'publicStartDate', $post_id ) ) :
			$event_public_open_date[] = $this->get_datetime_t( get_field( 'publicStartDate', $post_id ) );
		endif;
		if ( $event_public_open_date ) {
			return $event_public_open_date;
		} else {
			return false;
		}
	}

	/**
	 * 年度を指定して文化祭情報を取得する関数
	 *
	 * @param string $year 年度.
	 *
	 * @return mixed
	 */
	private function get_event_specified_year( $year ) {
		$event = [];
		foreach ( $this->event as $key => $value ) {
			$event[ $key ] = $value['year'];
		}
		$key = array_search( $year, $event, true );
		if ( false !== $key ) {
			return $this->event[ $key ];
		} else {
			return false;
		}
	}

	/**
	 * 開催期間を表示する関数
	 *
	 * @param string $year 年度.
	 *
	 * @return bool|string
	 */
	public function the_event_date( $year ) {
		if ( $this->get_event_specified_year( $year ) ) {
			$event      = $this->get_event_specified_year( $year );
			$event_date = $event['event_date'];
			if ( 1 === count( $event_date ) ) { // 開催期間が１日の場合 (要素が1つ).
				$date = array_shift( $event_date );
				$text = $date->format( 'Y/m/d' );
			} else {
				$start_date = array_shift( $event_date ); // 配列の先頭の要素を取り出す.
				$end_date   = array_pop( $event_date );   // 配列の最後の要素を取り出す.
				$text       = $start_date->format( 'Y/m/d' ) . ' ~ ' . $end_date->format( 'Y/m/d' );
			}

			return esc_html( $text );
		} else {
			return false;
		}
	}

	/**
	 * 一般公開情報を取得する関数
	 *
	 * @param string $year 年度.
	 *
	 * @return array
	 */
	public function get_event_public_open_date( $year ) {
		$text = [];
		if ( $this->get_event_specified_year( $year ) ) {
			$post = $this->get_event_specified_year( $year );
			if ( true === $post['public_open_unknown'] ) {
				$text[] = '不明';
			} elseif ( ! $post['public_open'] ) {
				$text[] = 'なし';
			} elseif ( $post['public_open'] ) {
				$event_public_open_date = $post['public_open'];
				foreach ( $event_public_open_date as $value ) {
					if ( array_key_exists( 'event_public_open_start', $value ) ) {
						$event_public_open_start = $value['event_public_open_start'];
						$event_public_open_end   = $value['event_public_open_end'];
						if ( $event_public_open_start->format( 'Y/m/d' ) === $event_public_open_end->format( 'Y/m/d' ) ) {
							$text[] = School::format_datetime( $event_public_open_start ) . ' ~ ' . School::format_datetime( $event_public_open_end, true );
						} else {
							$text[] = School::format_datetime( $event_public_open_start );
							$text[] = School::format_datetime( $event_public_open_end );
						}
					} else {
						$text[] = School::format_datetime( $value );
					}
				}
			}
		}

		return $text;
	}

	/**
	 * パーマリンクを表示する関数
	 *
	 * @param string $year 年度.
	 *
	 * @return mixed
	 */
	public function the_permalink( $year ) {
		if ( $this->get_event_specified_year( $year ) ) {
			$post = $this->get_event_specified_year( $year );
			return $post['permalink'];
		} else {
			return false;
		}
	}

	/**
	 * ループ内の文化祭の開催年を取得する
	 *
	 * @return bool|string
	 */
	static function get_year() {
		if ( get_field( 'schoolName' ) ) {
			$start_date = School::get_datetime_t( get_field( 'startDate' ) );

			return $start_date->format( 'Y' );
		} else {
			return false;
		}
	}

	/**
	 * DateTimeオブジェクトをフォーマットする関数
	 *
	 * @param DateTime $datetime DateTimeオブジェクト.
	 * @param bool     $is_end 最後に出力する時刻か.
	 *
	 * @return string
	 */
	static function format_datetime( DateTime $datetime, $is_end = false ) {
		if ( true === $is_end ) {
			// ~ でつなぐ最後は年月日を出力しない.
			return $datetime->format( 'H:i' );
		} elseif ( '00:00' === $datetime->format( 'H:i' ) ) {
			// 時・分が設定されていない.
			return $datetime->format( 'Y/m/d' );
		} else {
			return $datetime->format( 'Y/m/d H:i' );
		}
	}
}
