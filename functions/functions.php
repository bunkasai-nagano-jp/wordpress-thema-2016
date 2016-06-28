<?php

//更新日の追加
function get_mtime($format) {
  $modified_time = get_the_modified_time('Ymd');
  $page_time     = get_the_time('Ymd');
  if ( $page_time > $modified_time ) {
   return get_the_time($format);
  }
  elseif ( $page_time === $modified_time ) {
    return null;
  }
   else {
    return get_the_modified_time($format);
  }
}

function is_other_year_post( $school_name ) {
  $args    =  array(
                'meta_value' => $school_name,
              );
  $result  =  get_posts( $args );
  $number  =  count($result);
  if ($number == 1):
    return false;
  else:
    return true;
  endif;
}
