<?php get_header(); ?>
<div class="row">
	<div class="col-md-8">
		<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-client="ca-pub-3116606223638769"
		     data-ad-slot="7294376534"
		     data-ad-format="link"></ins>
		<script>
            (adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		<main>
			<article>
				<?php get_template_part( 'template-parts/breadcrumb' ); ?>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<h1><?php the_title(); ?></h1>
					<div class="text-muted">
						<p class="mb-2"><i class="fa fa-fw fa-calendar"></i> 公開 <?php the_date(); ?></p>
						<?php if ( get_the_date() !== get_the_modified_date() ) : ?>
							<p class=""><i class="fa fa-fw fa-repeat"></i> 更新 <?php the_modified_date(); ?></p>
						<?php endif; ?>
					</div>
					<?php the_content(); ?>
					<div class="bg-faded rounded p-2 mb-3">
						<span><i class="fa fa-fw fa-tags"></i> <?php the_category( ', ' ) ?> <?php the_tags( '', ', ' ); ?></span>
					</div>
				<?php endwhile; ?>
					<?php get_template_part( 'template-parts/kanren' ); ?>
				<?php else : ?>
					<?php get_template_part( 'template-parts/no-articles' ); ?>
				<?php endif; ?>
			</article>
		</main>
	</div>
	<div class="col-md-4">
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
