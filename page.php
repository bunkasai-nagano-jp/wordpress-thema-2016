<?php get_header(); ?>
<div class="col-md-8">
  <main>
    <article>
      <?php get_template_part('breadcrumb'); ?>
      <div>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <h1 class="title page-header"><?php the_title(); ?></h1>
        <div class="panel panel-default">
          <div class="panel-body">
            <span><i class="fa fa-fw fa-calendar"></i>&nbsp;公開 <time datetime="<?php the_time('c') ;?>"><?php the_time('Y/m/d') ;?></time>&nbsp;<?php if ($mtime = get_mtime('Y/m/d')) echo ' <i class="fa fa-fw fa-repeat"></i>&nbsp;更新 ' , $mtime; ?></span>
            <hr>
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
          </div>
        </div>
      </div>
      <?php endwhile; else: ?>
        <div class="panel panel-info">
          <div class="panel-body">
            記事がありません
          </div>
        </div>
      <?php endif; ?>
    </article>
  </main>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
