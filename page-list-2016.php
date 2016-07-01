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
  $args = array(
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
            $posts = query_posts($args);
            $tmp = array();
            foreach ( $posts as $post ) {
              $school_name = get_post_meta($post->ID, 'schoolName', true);
              $start_date  = get_post_meta($post->ID, 'startDate', true);
              $end_date    = get_post_meta($post->ID, 'endDate', true);
              $public_start_date  = get_post_meta($post->ID, 'publicStartDate', true);
              $public_end_date    = get_post_meta($post->ID, 'publicEndDate', true);
              $public_unknown    = get_post_meta($post->ID, 'public_unknown', true);
              if ( in_array($school_name, $tmp) ) {
                continue;
              } ?>
              <tr>
                <td><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $school_name ?></a></td>
                <td><?php echo get_post_meta($post->ID, 'name', true); ?></td>
                <td><?php
                if (!$start_date):
                  echo '';
                elseif (!$end_date):
                  echo $start_date;
                else:
                  echo $start_date.' ~ '. $end_date;
                endif; ?>
                </td>
                <td><?php
                  if ($public_unknown):
                    echo '不明';
                  elseif (!$public_start_date and !$public_end_date):
                    echo 'なし';
                  elseif ($public_start_date and !$public_end_date):
                    echo $public_start_date;
                  elseif ($public_start_date and $public_end_date): ?>
                    <?php echo $public_start_date; ?> ~ <?php echo $public_end_date; ?>
                  <?php else:
                    echo '不明';
                  endif;
                ?></td>
              </tr>
              <?php
              $tmp[] = $school_name;
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
