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
                endif; ?>
                </td>
                <td><?php
                  if ($public_unknown):
                    echo '不明';
                  elseif ( !get_field('publicStartDate', $post->ID) and !get_field('publicEndDate', $post->ID) ):
                    echo 'なし';
                  elseif ( get_field('publicStartDate', $post->ID) and !get_field('publicEndDate', $post->ID) ):
                    the_field('publicStartDate', $post->ID);
                  elseif ( get_field('publicStartDate', $post->ID) and get_field('publicEndDate', $post->ID) ):
                    echo get_field('publicStartDate', $post->ID).'&nbsp;~&nbsp;'.get_field('publicEndDate', $post->ID);
                  else:
                    echo '不明';
                  endif;
                ?></td>
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
