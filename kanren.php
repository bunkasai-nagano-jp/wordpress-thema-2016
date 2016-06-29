<?php
  $posts = relation_post();
  if ($posts) { ?>
    <h2><i class="fa fa-th-list"></i> 関連</h2>
    <div class="card-deck-wrapper">
      <div class="card-deck"><?php
      foreach($posts as $post) {
        $name               =   get_field('name', $post->ID);
        $class              =   get_field('class', $post->ID);
        $school_name        =   get_field('schoolName', $post->ID);
        $start_date         =   get_field('startDate', $post->ID);
        $end_date           =   get_field('endDate', $post->ID);
        $public_start_date  =   get_field('publicStartDate', $post->ID);
        $public_end_date    =   get_field('publicEndDate', $post->ID);
        $public_unknown     =   get_field('public_unknown', $post->ID);
        $today              =   date("Y/m/d");
        $year               =   date("Y", strtotime($start_date));
        $days               =   abs(strtotime($start_date) - strtotime($today)) / (60 * 60 * 24); ?>
        <div class="card"><?php
        if ( get_gmap_sv_url(640, 300) ) { ?>
          <a href="<?php get_permalink($post->ID); ?>"><img class="card-img-top img-fluid" src="<?php echo get_gmap_sv_url(640, 300); ?>" alt="streetview"></a><?php
        } ?>
          <div class="card-block">
            <a href="<?php get_permalink($post->ID); ?>"><h2 class="card-title"><?php echo $name; ?></h2></a>
            <h6 class="card-subtitle text-muted"><?php echo $class; ?> <?php echo $school_name; ?></h6>
            <div class="card-block">
              <?php
              if ($year < date("Y")) {
                echo '<p class="card-text text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i>'.' 終了'.'</p>';
              }
              elseif ($days > 0) {
                echo '<p class="card-text text-primary"><i class="fa fa-clock-o" aria-hidden="true"></i>'.' 開催まで'.$days.'日'.'</p>';
              }
              elseif ($days == 0) {
                echo '<p class="card-text text-info"><i class="fa fa-flag" aria-hidden="true"></i>'.' 開催中</p>';
              }
              else {

              };
              ?>
              <p class="card-text"><?php
              if ($start_date) {
                echo <<<EOT
                <span><i class="fa fa-calendar"></i> 開催期間</span>
                <span>$start_date ~ $end_date</span>
EOT;
              }
              elseif ($public_unknown) {
                echo <<<EOT
                <span>一般公開</span>
                <span>不明</span>
EOT;
              }
              elseif (!$public_start_date) {
                echo <<<EOT
                <span>一般公開</span>
                <span>なし</span>
EOT;
              }
              elseif (!$public_end_date) {
                echo <<<EOT
                <span>一般公開日</span>
                <span>$public_start_date</span>
EOT;
              }
              else {
                echo <<<EOT
                <span>一般公開期間<span>
                <span>{$public_start_date} ~ {$public_end_date}</span>
EOT;
                }
                ?></p>
              </div>
              <div class="card-block text-xs-right">
                <a href="<?php get_permalink($post->ID); ?>" class="btn btn-primary">詳細</a>
              </div>
            </div>
            <div class="card-footer">
              <i class="fa fa-fw fa-tags"></i> <span><?php the_category(', ',$post->ID); ?></span>
            </div>
          </div><?php
      } ?>
      </div>
    </div><?php
  }
?>
