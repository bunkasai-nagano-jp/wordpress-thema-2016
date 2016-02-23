<?php get_header(); ?>

<div id="content" class="clearfix">
  <div id="contentInner">
    <main>
      <article>
    <div id="breadcrumb">
      <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> <a href="<?php echo home_url(); ?>" itemprop="url"> <span itemprop="title">ホーム</span> </a> &gt; </div>
      <?php /*--- カテゴリーが階層化している場合に対応させる --- */ ?>
      <?php $postcat = get_the_category(); ?>
      <?php $catid = $postcat[0]->cat_ID; ?>
      <?php $allcats = array($catid); ?>
      <?php
        while(!$catid==0) {	/* すべてのカテゴリーIDを取得し配列にセットするループ */
          $mycat = get_category($catid); 	/* カテゴリーIDをセット */
          $catid = $mycat->parent; 	/* 上で取得したカテゴリーIDの親カテゴリーをセット */
          array_push($allcats, $catid);
        }
        array_pop($allcats);
        $allcats = array_reverse($allcats);
      ?>
      <?php /*--- 親カテゴリーがある場合は表示させる --- */ ?>
      <?php foreach($allcats as $catid): ?>
      <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> <a href="<?php echo get_category_link($catid); ?>" itemprop="url"> <span itemprop="title"><?php echo get_cat_name($catid); ?></span> </a> &gt; </div>
      <?php endforeach; ?>
    </div>
      <h2>
        <?php if ( is_category() ) {
                single_cat_title();
              } elseif ( is_tag() ) {
                single_tag_title();
              } elseif ( is_tax() ) {
                single_term_title();
              } ?>の文化祭
      </h2>
          <?php get_template_part('itiran');?>
        <?php if (function_exists("pagination")) {
          pagination($wp_query->max_num_pages);
        } ?>
      </article>
    </main>
  </div>
  <!-- /#contentInner -->
  <?php get_sidebar(); ?>
</div>
<!--/#content -->
<?php get_footer(); ?>
