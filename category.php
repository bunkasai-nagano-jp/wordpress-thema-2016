<?php get_header(); ?>
  <main>
<?php get_template_part('breadcrumb'); ?>
    <h1><?php single_cat_title(); ?>の文化祭</h1>
    <!-- .flex-container -->
    <div class="flex-container">
<?php
    $category     =  get_the_category();
    $category_id  =  $category[0]->cat_ID;
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $args = array(
            'meta_query'      =>  array(
                                    'meta'=>array(
                                      'key'      =>  'startDate',
                                      'type'     =>  'DATE'
                                    )
                                  ),
            'cat'             =>  $category_id,
            'orderby' => 'meta',
            'order'   => 'DESC',
            'posts_per_page' => 10,
            'paged' => $paged
    );
    $wp_query = new WP_Query( $args );
<?php endwhile; else: ?>
      <!-- no articles -->
      <div class="card">
        <div class="card-block">
          <p class="card-text">記事がありません</p>
        </div>
      </div>
      <!-- /no articles -->
     if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
<!-- card -->
<?php get_template_part('template/card'); ?>
<!-- /card -->
<?php endif; ?>
</div>
<!-- /.flex-container -->
  </main>
<?php if (function_exists("pagination")) {
  pagination($wp_query->max_num_pages);
} ?>
<?php get_footer(); ?>
