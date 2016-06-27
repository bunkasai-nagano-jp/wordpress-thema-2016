<?php get_header(); ?>
<main>
  <?php get_template_part('itiran');?>
</main>
<?php if ( function_exists("pagination") ) {
  pagination($wp_query->max_num_pages);
} ?>
<?php get_footer(); ?>
