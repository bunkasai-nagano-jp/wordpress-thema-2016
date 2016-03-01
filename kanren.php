<div class="list-group">
  <?php
  $categories = get_the_category($post->ID);
  $category_ID = array();
  foreach($categories as $category):
    array_push( $category_ID, $category -> cat_ID);
    endforeach ;
    $args = array(
      'post__not_in' => array($post -> ID),
      'posts_per_page'=> 4,
      'category__in' => $category_ID,
      'orderby' => 'rand',
    );
    $st_query = new WP_Query($args);
    ?>
    <?php if( $st_query -> have_posts() ): ?>
      <?php while ($st_query -> have_posts()) : $st_query -> the_post(); ?>
          <a href="<?php the_permalink() ?>" class="list-group-item">
            <h4 class="list-group-item-heading"><?php the_title(); ?></h4>
          </a>
    <?php endwhile; ?>
    <?php else: ?>
      <div class="panel panel-info">
        <div class="panel-body">
          関連記事はありませんでした
        </div>
      </div>
    <?php endif; ?>
  <?php wp_reset_postdata(); ?>
</div>
