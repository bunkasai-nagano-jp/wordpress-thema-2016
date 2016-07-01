<?php get_header(); ?>
<div class="col-md-12">
  <div>
    <div class="card">
      <div class="card-block">
        <h1 class="card-title"><?php the_title(); ?></h1>
      </div>
      <div class="card-block">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th>学校名</th>
              <th>文化祭名</th>
              <th>開催期間</th>
              <th>一般公開</th>
            </tr>
          </thead>
          <tbody>
<?php
  $args   = array(
              'meta_query' => array(
                                'start_date'  => array(
                                                  'key'     =>  'startDate',
                                                  'value'   =>  array('2016/01/01', '2016/12/31'),
                                                  'compare' =>  'BETWEEN',
                                                  'type'    =>  'DATE'
                                                ),
                                'address'     => array(
                                                  'key'  =>  'address',
                                                  'type' =>  'CHAR',
                                                )
                              ),
            'post_type'  => 'post',
            'order'      => 'ASC',
            'orderby'    => 'address',
            'nopaging'   => true,
            );
  $posts  = query_posts($args);
  $tmp    = array();
  foreach ( $posts as $post ) {
    if ( in_array( get_field('schoolName', $post->ID), $tmp ) ) {
      continue;
    }
?>
              <tr>
                <td><a href="<?php echo get_permalink($post->ID); ?>"><?php the_field('schoolName', $post->ID) ?></a></td>
                <td><?php the_field('name', $post->ID); ?></td>
                <td><?php
    if ( !get_field('startDate', $post->ID) ):
      echo '';
    elseif ( get_field('startDate', $post->ID) and !get_field('endDate', $post->ID) ):
      the_field('startDate', $post->ID);
    elseif ( get_field('startDate', $post->ID) and get_field('endDate', $post->ID) ):
      echo get_field('startDate', $post->ID).'&nbsp;~&nbsp;'.get_field('endDate', $post->ID);
    else:
      echo '';
    endif;
?>
                </td>
                <td>
<?php

    if ( have_rows('public_open') ):

      while ( have_rows('public_open') ) : the_row();
        if ( get_sub_field('public_open_day') and get_sub_field('public_open_start_time') and get_sub_field('public_open_end_time') ):
          echo '<p>'.get_sub_field('public_open_day'). '&nbsp;'. get_sub_field('public_open_start_time'). '&nbsp;~&nbsp;'. get_sub_field('public_open_end_time').'</p>';
        elseif ( get_sub_field('public_open_day') ):
          echo '<p>'.get_sub_field('public_open_day').'</p>';
        else:

        endif;
      endwhile;

    elseif ( get_field('public_unknown', $post->ID) ):
      echo '<p>不明</p>';
    elseif ( get_field('publicStartDate', $post->ID) and get_field('publicEndDate', $post->ID) ):
      echo '<p>'.get_field('publicStartDate', $post->ID).'&nbsp;~&nbsp;'.get_field('publicEndDate', $post->ID).'</p>';
    elseif ( get_field('publicStartDate', $post->ID) and !get_field('publicEndDate', $post->ID) ):
      echo '<p>'.get_field('publicStartDate', $post->ID).'</p>';
    elseif ( !get_field('publicStartDate', $post->ID) and !get_field('publicEndDate', $post->ID) ):
      echo '<p>なし</p>';
    else:
      echo '<p>不明</p>';
    endif;
?>
                </td>
              </tr>
<?php
    $tmp[] = get_field('schoolName', $post->ID);
  }
  wp_reset_query();
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
