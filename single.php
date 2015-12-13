<?php get_header(); ?>

<div id="content" class="clearfix">
    <div id="contentInner">
        <main>
            <article>
                <div class="post">
                    <div id="breadcrumb">
                        <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                            <a href="<?php echo home_url(); ?>" itemprop="url">
                                <span itemprop="title">ホーム</span>
                            </a> &gt;
                        </div>
                        <?php $postcat = get_the_category(); ?>
                        <?php $catid = $postcat[0]->cat_ID; ?>
                        <?php $allcats = array($catid); ?>
                        <?php
                            while(!$catid==0) {
                                $mycat = get_category($catid);
                                $catid = $mycat->parent;
                                array_push($allcats, $catid);
                            }
                            array_pop($allcats);
                            $allcats = array_reverse($allcats);
                        ?>
                        <?php foreach($allcats as $catid): ?>
                        <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                            <a href="<?php echo get_category_link($catid); ?>" itemprop="url">
                                <span itemprop="title"><?php echo get_cat_name($catid); ?></span>
                            </a> &gt;
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <h1 class="entry-title">
                            <?php the_title(); ?>
                        </h1>
                        <div class="blogbox">
                            <p>
                                <span class="kdate"><i class="fa fa-fw fa-calendar"></i>
                                    &nbsp;公開
                                <time class="entry-date" datetime="<?php the_time('c') ;?>">
                                    <?php the_time('Y/m/d') ;?>
                                  </time>
                                  &nbsp;
                                <?php if ($mtime = get_mtime('Y/m/d')) echo ' <i class="fa fa-fw fa-repeat"></i>&nbsp;更新 ' , $mtime; ?>
                                </span>
                            </p>
                        </div>
                    <?php the_content(); ?>
                    <?php wp_link_pages(); ?>
                    <p class="tagst">
                        <i class="fa fa-tags"></i>&nbsp;-
                        <?php the_category(', ') ?>
                        <?php the_tags('', ', '); ?>
                    </p>
                    <aside>
                        <?php get_template_part('sns'); ?>
                        <?php endwhile; else: ?>
                            <p>記事がありません</p>
                        <?php endif; ?>
                        <h3 class="point">
                            <i class="fa fa-th-list"></i>&nbsp;  関連記事
                        </h3>
                        <?php get_template_part('kanren');?>
                    </aside>
                </div>
            </article>
        </main>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
