<?php

//更新日の追加
function get_mtime ( $format ) {
	$modified_time = get_the_modified_time( 'Ymd' );
	$page_time     = get_the_time( 'Ymd' );
	if ( $page_time > $modified_time ) {
		return get_the_time( $format );
	} elseif ( $page_time === $modified_time ) {
		return null;
	} else {
		return get_the_modified_time( $format );
	}
}

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

/*
文化祭が開催中かどうか
  開催中:true
  終了:false
*/
function is_bunkasai_during_open () {
	if ( get_field( 'startDate' ) ) {
		$start_date = strtotime( get_field( 'startDate' ) );
	} else {
		$start_date = null;
	}
	if ( get_field( 'endDate' ) ) {
		$end_date = strtotime( get_field( 'endDate' ) );
	} else {
		$end_date = strtotime( get_field( 'startDate' ) );
	}

	if ( strtotime( "today" ) >= $start_date and strtotime( "today" ) <= $end_date ) {
		return true;
	} elseif ( $end_date < strtotime( "today" ) ) {
		return false;
	} else {
		return null;
	}
}
