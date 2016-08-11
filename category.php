<?php get_header(); ?>
<main>
  <?php get_template_part( 'breadcrumb' ); ?>
  <h1><?php single_cat_title(); ?>の文化祭</h1>
  <!-- .flex-container -->
  <div class="flex-container">
    <?php
    $category    = get_the_category();
    $category_id = $category[0]->cat_ID;
    $paged       = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args        = array(
      'meta_query'     => array(
        'meta' => array(
          'key'  => 'startDate',
          'type' => 'DATE'
        )
      ),
      'cat'            => $category_id,
      'orderby'        => 'meta',
      'order'          => 'DESC',
      'posts_per_page' => 10,
      'paged'          => $paged
    );
    $wp_query    = new WP_Query( $args );
    if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
      <!-- card -->
      <?php get_template_part( 'template/card' ); ?>
      <!-- /card -->
    <?php endwhile; ?>
    <?php else: ?>
      <!-- no articles -->
      <?php get_template_part( 'template/no_articles' ); ?>
      <!-- /no articles -->
    <?php endif; ?>
  </div>
  <!-- /.flex-container -->
</main>
<?php get_template_part( 'template/pagination' ); ?>
<?php get_footer(); ?>
