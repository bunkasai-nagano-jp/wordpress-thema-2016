<div id="itiran">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    </div>
    <div class="panel-body">
      <img src="<?php echo get_gmap_sv_url(); ?>" alt="..." class="img-thumbnail center-block">
      <dl class="dl-horizontal">
        <dt>文化祭名</dt>
        <dd><?php echo get_custom_field( 'name' ) ?></dd>
        <dt>学校名</dt>
        <dd><?php echo get_custom_field( 'class' ) ?> <?php echo get_custom_field( 'schoolName' ) ?></dd>
        <?php
          $startDate = get_custom_field( 'startDate' );
          $endDate = get_custom_field( 'endDate' );
          if(!empty($startDate)) {
            echo '<dt>開催期間</dt>' . "\n" .
                 '<dd>'. $startDate .' 〜 '. $endDate .'</dd>';
          }
        ?>
        <?php
          $publicStartDate = get_custom_field( 'publicStartDate' );
          $publicEndDate = get_custom_field( 'publicEndDate' );
          if (empty($publicStartDate)) {

          } elseif (empty($publicEndDate)) {
            echo '<dt>一般公開日</dt>' . "\n" .
                 '<dd>'. $publicStartDate .'</dd>';
          } else {
            echo '<dt>一般公開期間<dt>' . "\n" .
                 '<dd>'. $publicStartDate .' 〜 '. $publicEndDate .'</dd>';
          }
        ?>
      </dl>
      <a class="btn btn-primary pull-right" href="<?php the_permalink(); ?>">詳細を見る</a>
    </div>
    <div class="panel-footer">
      <span ><i class="fa fa-tags"></i>&nbsp;<?php the_category( ', ' ) ?></span>
    </div>
  </div>
  <?php endwhile; else: ?>
    <p>記事がありません</p>
  <?php endif; ?>
</div>
