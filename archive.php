<?php get_header(); ?>
  <main>
<?php get_template_part('breadcrumb'); ?>
    <h1>
<?php if ( is_tag() ) {
        single_tag_title();
      }
      elseif ( is_tax() ) {
        single_term_title();
      } ?>の文化祭</h1>
          <?php get_template_part('itiran');?>
    </main>
<!-- pagination -->
<?php get_template_part('template/pagination'); ?>
<!-- /pagination -->
<?php get_footer(); ?>
