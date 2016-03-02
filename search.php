<?php get_header(); ?>
<div class="col-md-8">
  <main>
    <article>
      <section>
        <h1 class="page-header title">「<?php echo esc_html($s); ?>」の検索結果 <?php echo $wp_query->found_posts; ?> 件</h1>
        <?php get_template_part('itiran');?>
      </section>
      <?php if (function_exists("pagination")) {
pagination($wp_query->max_num_pages);
} ?>
    </article>
  </main>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
