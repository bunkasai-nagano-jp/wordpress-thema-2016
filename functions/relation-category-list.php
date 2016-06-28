<?php

function relation_category_list ($post_id) {
  $category     =  get_the_category();
  $category_id  =  $category[0]->cat_ID;
  $args = array(
          'meta_query'  =>  array(
                              'meta'=>array(
                                        'key'   =>  'startDate',
                                        'type'  =>  'DATE'
                                      )
                            ),
          'cat'         =>  $category_id,
          'orderby'     =>  'meta',
          'order'       =>  'DESC',
          );
  $relation_posts = query_posts($args);
  if (!$relation_posts):
    return false;
  else: ?>
<h3>同じ市町村の文化祭情報</h3>
  <div class="list-group">
<?php foreach ($relation_posts as $relation_post) {
      $name               =   get_field('name', $relation_post->ID);
      $class              =   get_field('class', $relation_post->ID);
      $school_name        =   get_field('schoolName', $relation_post->ID);
      $start_date         =   get_field('startDate', $relation_post->ID);
      $end_date           =   get_field('endDate', $relation_post->ID);
      $public_start_date  =   get_field('publicStartDate', $relation_post->ID);
      $public_end_date    =   get_field('publicEndDate', $relation_post->ID);
      $public_unknown     =   get_field('public_unknown', $relation_post->ID);
  if ($post_id == $relation_post->ID): ?>
    <a href="<?php echo get_permalink($relation_post->ID); ?>" class="list-group-item active"><?php echo $relation_post->post_title; ?></a>
<?php else: ?>
    <a href="<?php echo get_permalink($relation_post->ID); ?>" class="list-group-item"><?php echo $relation_post->post_title; ?></a>
<?php endif;
} ?>
  </div>
<?php
  endif;
}
