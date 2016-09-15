<!-- .flex-container -->
<div class="flex-container">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<!-- card -->
	<?php get_template_part( 'template/card' ); ?>
	<!-- /card -->
	<?php endwhile;
	else : ?>
	<!-- no articles -->
	<?php get_template_part( 'template/no-articles' ); ?>
	<!-- /no articles -->
	<?php endif; ?>
</div>
<!-- /.flex-container -->
