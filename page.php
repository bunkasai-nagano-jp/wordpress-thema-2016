<?php get_header(); ?>
<div class="col-md-12">
	<main>
		<article>
			<div>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="card">
						<div class="card-block">
							<h1 class="card-title"><?php the_title(); ?></h1>
							<?php get_template_part( 'template-parts/date' ); ?>
						</div>
						<div class="card-block">
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
						</div>
					</div>
				<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'template-parts/no-articles' ); ?>
				<?php endif; ?>
			</div>
		</article>
	</main>
</div>
<?php get_footer(); ?>
