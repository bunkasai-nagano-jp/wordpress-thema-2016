<?php get_header(); ?>
<div class="col-md-12">
  <main>
    <article>
      <div>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="card">
          <div class="card-block">
            <h1 class="card-title"><?php the_title(); ?></h1>
            <h6 class="card-subtitle text-muted">
              <span><i class="fa fa-fw fa-calendar"></i> 公開 <?php echo get_the_date(); ?></span>
          <?php if ( get_the_date() != get_the_modified_date() ): ?>
              <span><i class="fa fa-fw fa-repeat"></i> 更新 <?php echo get_the_modified_date(); ?></span>
          <?php endif; ?>
            </h6>
          </div>
          <div class="card-block">
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
          </div>
        </div>
      <?php endwhile; ?>
      <?php else: ?>
        <div class="card">
          <div class="card-block">
            <p class="card-text">記事がありません</p>
          </div>
        </div>
      <?php endif; ?>
      </div>
    </article>
  </main>
</div>
<?php get_footer(); ?>
