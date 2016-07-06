<?php
  $posts = relation_post();
    <h2><i class="fa fa-th-list"></i> 関連</h2>
  if ($posts):
?>
<!-- .card-columns -->
<div class="card-columns">
<?php foreach($posts as $post): ?>
<!-- card -->
<?php get_template_part('template/card'); ?>
<!-- /card -->
<?php endforeach; ?>
</div>
<!-- /.card-columns -->
<?php endif; ?>
