<?php get_header(); ?>
<div class="col-md-8">
	<main>
	<article>
		<?php get_template_part( 'breadcrumb' ); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		  <div class="card">
			<div class="card-block">
			  <h1 class="card-title"><?php the_title(); ?></h1>
			  <h6 class="card-subtitle text-muted">
				<p class="card-date"><i class="fa fa-fw fa-calendar"></i> 公開 <?php echo get_the_date(); ?></p>
				<?php if ( get_the_date() != get_the_modified_date() ) :  ?>
				  <p class="card-date"><i class="fa fa-fw fa-repeat"></i> 更新 <?php echo get_the_modified_date(); ?></p>
				<?php endif; ?>
			  </h6>
			</div>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
			<?php global $displaying_post_id;
			$displaying_post_id = get_the_ID();
			?>
			<div class="card-footer">
			  <span><i class="fa fa-fw fa-tags"></i> <?php the_category( ', ' ) ?> <?php the_tags( '', ', ' ); ?></span>
			</div>
		  </div>
		<?php endwhile; ?>
			<?php get_template_part( 'kanren' ); ?>
		<?php else : ?>
		<?php endif; ?>
	</article>
	</main>
</div>
<div class="col-md-4 hidden-sm-down">
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
