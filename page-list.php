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
                  'post_type' => 'post',
                  'meta_key'   => 'startDate',
                  'meta_type'   => 'DATE',
                  'order'   => 'ASC',
                  'orderby' => 'meta_value',
                  'nopaging' => true);
                  $query = new WP_Query($args);
                  if ( $query->have_posts() )
                  {
                    while ( $query->have_posts() )
                    {
                      $query->the_post();
                      echo "<tr>";
                      echo "<td>".get_field('schoolName')."</td>";
                      echo "<td>".get_field('name')."</td>";
                      echo "<td>".get_field('startDate')."&nbsp;~&nbsp;".get_field('endDate')."</td>";
                      echo "</tr>";
                    }
                  }?>
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
