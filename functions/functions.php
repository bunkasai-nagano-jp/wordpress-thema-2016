<?php

// 他の年の記事があるかどうか
function is_other_year_post ( $school_name ) {
	$args   = array(
		'meta_value' => $school_name,
	);
	$result = get_posts( $args );
	$number = count( $result );
	if ( $number == 1 ):
		return false;
	else:
		return true;
	endif;
}

// 文化祭が終了しているか
function is_ended () {

	if ( !get_field( 'endDate' ) ) {
		$end_date = get_field( 'startDate' );
	} else {
		$end_date = get_field( 'endDate' );
	}
	if ( $end_date < date( "Y/m/d" ) ):
		return true;
	else:
		return false;
	endif;
}

// 文化祭までの残り日数を取得
function get_remaining_days () {
	if ( get_field( 'startDate' ) and get_field( 'endDate' ) ) {
		$start_date = get_field( 'startDate' );
		$end_date   = get_field( 'endDate' );
		$today      = date( "Y/m/d" );
		$days       = abs( strtotime( $start_date ) - strtotime( $today ) ) / ( 60 * 60 * 24 );

		return $days;
	} else {
		return null;
	}
}

// 終了日を取得
function get_end_date () {
	if ( !get_field( 'endDate' ) ) {
		$end_date = get_field( 'startDate' );
	} else {
		$end_date = get_field( 'endDate' );
	}

	return $end_date;
}

/**
 * 文化祭が開催中かどうか
 * 開催中:true
 * 開催前:null
 * 終了:false
 */
function is_bunkasai_during_open() {
	if ( get_field( 'startDate' ) ) {
		$start_date = get_field( 'startDate' );
		$today      = date( 'Y/m/d' );
		if ( ! get_field( 'endDate' ) ) {
			// 開催期間が1日の文化祭を想定する
			$end_date = get_field( 'startDate' );
		} else {
			$end_date = get_field( 'endDate' );
		}
		if ( $today === $start_date ) {
			// 開始日当日
			return true;
		} elseif ( $today === $end_date ) {
			// 終了日当日
			return true;
		} elseif ( $today > $end_date ) {
			// 終了日よりも後
			return false;
		} elseif ( $today > $start_date and $today < $end_date ) {
			// 開催期間中
			// 開始日よりも後 終了日よりも前
			return true;
		} elseif ( $today < $start_date ) {
			// 開始日よりも前 残り日数を計算する
			return null;
		}
	}
}
