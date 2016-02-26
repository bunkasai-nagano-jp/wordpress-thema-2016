<?php get_header(); ?>
<div class="col-md-8">
  <main>
    <article>
      <?php get_template_part('breadcrumb'); ?>
      <h1 class="title"><?php if ( is_category() ) {
                single_cat_title();
              } elseif ( is_tag() ) {
                single_tag_title();
              } elseif ( is_tax() ) {
                single_term_title();
              } ?>の文化祭</h2>
          <?php get_template_part('itiran');?>
        <?php if (function_exists("pagination")) {
          pagination($wp_query->max_num_pages);
        } ?>
      </article>
    </main>
  </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
