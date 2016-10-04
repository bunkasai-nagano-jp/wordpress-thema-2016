<?php
$posts = get_relation_post();
if ( $posts ) :  ?>
	<h2><i class="fa fa-th-list"></i>&nbsp;関連記事</h2>
	<!-- .kanren-flex-container -->
	<div class="kanren-flex-container">
	<?php foreach ( $posts as $post ) :  ?>
	  <!-- card -->
		<?php get_template_part( 'template/card' ); ?>
	  <!-- /card -->
	<?php endforeach; ?>
	</div>
	<!-- /.kanren-flex-container -->
<?php endif; ?>
