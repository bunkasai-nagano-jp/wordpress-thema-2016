<?php
  $posts = relation_post();
    <h2><i class="fa fa-th-list"></i> 関連</h2>
  if ($posts):
?>
<div class="card-columns">
<?php foreach($posts as $post): ?>
<?php get_template_part('template/card'); ?>
<?php endforeach; ?>
</div>
<?php endif; ?>
