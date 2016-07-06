<?php
  $posts = relation_post();
  if ($posts):
?>
<h2><i class="fa fa-th-list"></i>&nbsp;関連</h2>
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
