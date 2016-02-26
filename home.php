<?php get_header(); ?>
<div class="col-md-8">
  <main>
    <article>
      <?php get_template_part('breadcrumb'); ?>
      <?php get_template_part('itiran');?>
      <?php if ( function_exists("pagination") )
            {
              pagination($wp_query->max_num_pages);
            }
      ?>
    </article>
  </main>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
