<?php get_header(); ?>
<div class="col-md-8">
  <main>
    <article>
      <?php get_template_part('breadcrumb'); ?>
      <div>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <h1 class="title"><?php the_title(); ?></h1>
        <div class="panel panel-default">
          <div class="panel-body">
            <span><i class="fa fa-fw fa-calendar"></i>&nbsp;公開 <time datetime="<?php the_time('c') ;?>"><?php the_time('Y/m/d') ;?></time>&nbsp;<?php if ($mtime = get_mtime('Y/m/d')) echo ' <i class="fa fa-fw fa-repeat"></i>&nbsp;更新 ' , $mtime; ?></span>
            <hr>
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
          </div>
          <div class="panel-footer">
            <span class="tagst">
              <i class="fa fa-tags"></i>&nbsp;-
              <?php the_category(', ') ?>
              <?php the_tags('', ', '); ?>
            </span>
          </div>
        </div>
        <aside>
            <?php get_template_part('sns'); ?>
            <?php endwhile; else: ?>
                <p>記事がありません</p>
            <?php endif; ?>
            <h3 class="point">
                <i class="fa fa-th-list"></i>&nbsp;関連記事
            </h3>
            <?php get_template_part('kanren');?>
        </aside>
      </div>
    </article>
  </main>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
