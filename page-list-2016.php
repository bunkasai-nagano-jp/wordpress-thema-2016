<?php get_header(); ?>
<div class="col-md-8">
  <main>
    <article>
      <?php get_template_part('breadcrumb'); ?>
      <div>
        <h1 class="title page-header"><?php the_title(); ?></h1>
        <div class="panel panel-default">
          <div class="panel-body">
            <table class="table table-hover table-striped">
              <thead>
                <tr>
                  <th>学校名</th>
                  <th>文化祭名</th>
                  <th>開催期間</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $args = array(
                          'meta_query' => array(
                            array(
                              'key'     =>  'startDate',
                              'value'   =>  array('2016/01/01', '2016/12/31'),
                              'compare' =>  'BETWEEN',
                              'type'    =>  'DATE'
                            )
                          ),
                          'post_type'   => 'post',
                          'order'       => 'ASC',
                          'nopaging'    => true,
                        );
                $posts = query_posts($args);
                ?>
                <?php
                $tmp = array();
                foreach ( $posts as $value )
                {
                  $school_name = get_post_meta($value->ID, 'schoolName', true);
                  $start_date  = get_post_meta($value->ID, 'startDate', true);
                  $end_date    = get_post_meta($value->ID, 'endDate', true);
                  if ( in_array($school_name, $tmp) )
                  {
                    continue;
                  }
                  ?>
                  <tr>
                    <td><?php echo $school_name ?></td>
                    <td><?php echo get_post_meta($value->ID, 'name', true); ?></td>
                    <td><?php
                    if (!$start_date) {
                      echo '';
                    }
                    elseif (!$end_date) {
                      echo $start_date;
                    }
                    else {
                      echo $start_date.' ~ '. $end_date;
                    }
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
      <?php get_template_part('sns'); ?>
    </article>
  </main>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
