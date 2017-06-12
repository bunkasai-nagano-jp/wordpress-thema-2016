<?php get_header(); ?>
<div class="row">
	<div class="col-md-8">
		<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-client="ca-pub-3116606223638769"
		     data-ad-slot="7294376534"
		     data-ad-format="link"></ins>
		<main>
			<article>
				<?php get_template_part( 'template-parts/breadcrumb' ); ?>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="card">
						<div class="card-block">
							<h1 class="card-title"><?php the_title(); ?></h1>
							<?php get_template_part( 'template-parts/date' ); ?>
						</div>
						<?php the_content(); ?>
						<div class="card-footer">
							<span><i class="fa fa-fw fa-tags"></i> <?php the_category( ', ' ) ?> <?php the_tags( '', ', ' ); ?></span>
						</div>
					</div>
				<?php endwhile; ?>
					<?php get_template_part( 'template-parts/kanren' ); ?>
				<?php else : ?>
					<?php get_template_part( 'template-parts/no-articles' ); ?>
				<?php endif; ?>
			</article>
		</main>
	</div>
	<div class="col-md-4 hidden-sm-down">
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
