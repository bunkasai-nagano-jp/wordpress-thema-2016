<!-- .flex-container -->
<div class="flex-container">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<!-- card -->
<?php get_template_part('template/card'); ?>
<!-- /card -->
<?php endwhile; ?>
<?php else: ?>
  <!-- no articles -->
  <div class="card">
    <div class="card-block">
      <p class="card-text">記事がありません</p>
    </div>
  </div>
  <!-- /no articles -->
<?php endif; ?>
</div>
<!-- /.flex-container -->
