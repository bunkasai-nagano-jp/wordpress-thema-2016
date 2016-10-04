<?php
	$relation_post = get_relation_post();
if ( $relation_post->have_posts() ) :  ?>
		<h2><i class="fa fa-th-list"></i>&nbsp;関連記事</h2>
		<!-- .kanren-flex-container -->
		<div class="kanren-flex-container">
			<?php while ( $relation_post->have_posts() ) : $relation_post->the_post(); ?>
				<!-- card -->
				<?php get_template_part( 'template/card' ); ?>
				<!-- /card -->
			<?php endwhile;
		wp_reset_postdata();
	?>
	</div>
	<!-- /.kanren-flex-container -->
	<?php endif;
