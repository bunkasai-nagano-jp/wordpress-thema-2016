<?php get_header(); ?>
<div class="col-md-12">
  <?php get_template_part('breadcrumb'); ?>
</div>
<div class="col-md-12">
  <div class="card">
    <div class="card-block">
      <h1 class="card-title"><?php the_title(); ?></h4>
    </div>
    <div class="card-block">
      <table class="table table-hover table-striped">
        <thead>
          <tr>
            <th>市町村</th>
            <th>学校名</th>
            <th>文化祭名</th>
            <th>詳細</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $args = array(
                    'meta_query'  =>  array(
                                        'meta'=>array(
                                                  'key'  =>  'address',
                                                  'type' =>  'CHAR',
                                                )
                                      ),
                    'post_type'   => 'post',
                    'order'       => 'ASC',
                    'orderby'     => 'meta',
                    'nopaging'    => true,
                  );
          $posts = query_posts($args);
          $tmp = array();
          foreach ( $posts as $value ) {
            $school_name = get_post_meta($value->ID, 'schoolName', true);
            if ( in_array($school_name, $tmp) ) {
              continue;
            }
            $name = get_post_meta($value->ID, 'name', true); ?>
        <tr>
          <td><?php
            $category = get_the_category( $value->ID );
            $category_url = get_category_link( $category[0]->cat_ID );
            $cayrgory_name = $category[0]->name;
            echo <<<EOT
            <a href="$category_url">$cayrgory_name</a>
EOT;
            ?></td>
          <td><?php echo $school_name ?></td>
          <td><?php echo $name ?></td>
          <td class="year"><?php
            if ( is_other_year_post($school_name) ) {
              $args = array(
                'meta_value' => $school_name,
              );
              $result = get_posts($args);
              foreach ( $result as $value ) {
                $start_date = date_create(get_post_meta($value->ID, 'startDate', true));
                echo "<a href=\"".get_permalink($value->ID)."\">".date_format($start_date, 'Y')."年</a>";
              }
            }
            else {
              $start_date = date_create(get_post_meta($value->ID, 'startDate', true));
              echo "<a href=\"".get_permalink($value->ID)."\">".date_format($start_date, 'Y')."年</a>";
            } ?>
          </td>
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
<?php get_sidebar(); ?>
<?php get_footer(); ?>
