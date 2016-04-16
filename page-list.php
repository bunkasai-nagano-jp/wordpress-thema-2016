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
                  <th>詳細</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $args = array(
                          'post_type'   => 'post',
                          'meta_key'    => 'startDate',
                          'meta_type'   => 'DATE',
                          'order'       => 'ASC',
                          'orderby'     => 'meta_value',
                          'nopaging'    => true,
                        );
                $posts = query_posts($args);
                ?>
                <?php
                $tmp = array();
                foreach ( $posts as $value )
                {
                  $school_name = get_post_meta($value->ID, 'schoolName', true);
                  if ( in_array($school_name, $tmp) )
                  {
                    continue;
                  }
                  ?>
                  <tr>
                    <td><?php echo get_post_meta($value->ID, 'schoolName', true); ?></td>
                    <td><?php echo get_post_meta($value->ID, 'name', true); ?></td>
                    <td class="year"><?php if ( is_other_year_post($school_name) )
                    {
                      $args = array(
                                'meta_value' => $school_name,
                              );
                      $result = get_posts($args);
                      foreach ( $result as $value )
                      {
                        $start_date = date_create(get_post_meta($value->ID, 'startDate', true));
                        echo "<a href=\"".get_permalink($value->ID)."\">".date_format($start_date, 'Y')."年</a>";
                      }
                    }
                    else
                    {
                      $start_date = date_create(get_post_meta($value->ID, 'startDate', true));
                      echo "<a href=\"".get_permalink($value->ID)."\">".date_format($start_date, 'Y')."年</a>";
                    } ?></td>
                  </tr>
                <?php
                    $tmp[] = $school_name;
                }
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
