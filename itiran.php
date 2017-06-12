<!-- .flex-container -->
<div class="d-flex flex-wrap justify-content-around align-items-stretch">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<!-- card -->
	<?php get_template_part( 'template-parts/card' ); ?>
	<!-- /card -->
	<?php endwhile;
	else : ?>
	<!-- no articles -->
	<?php get_template_part( 'template-parts/no-articles' ); ?>
	<!-- /no articles -->
	<?php endif; ?>
</div>
<!-- /.flex-container -->
