<div class="card-columns">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php
  $name               =  get_custom_field('name');
  $class              =  get_custom_field('class');
  $school_name        =  get_custom_field('schoolName');
  $start_date         =  get_custom_field('startDate');
  $end_date           =  get_custom_field('endDate');
  $public_start_date  =  get_custom_field('publicStartDate');
  $public_end_date    =  get_custom_field('publicEndDate');
  $public_unknown     =  get_custom_field('public_unknown');
  $today              =  date("Y/m/d");
  $year               =  date("Y", strtotime($start_date));
  $days               =  abs(strtotime($start_date) - strtotime($today)) / (60 * 60 * 24);
  ?>
<div class="card">
  <img class="card-img-top img-fluid" src="<?php echo get_gmap_sv_url(); ?>" alt="streetview">
  <div class="card-block">
    <h4 class="card-title"><?php echo $name; ?></h4>
    <h6 class="card-subtitle text-muted"><?php echo $class; ?> <?php echo $school_name; ?></h6>
    <h4 class="card-title"><?php
    if ($year < date("Y")) {
      echo '終了';
    }
    elseif ($days > 0) {
      echo '開催まで'.$days.'日';
    }
    else {

    };
    ?></h4>
          <p class="card-text"><?php
          if ($start_date) {
            echo <<<EOT
            <span>開催期間</span>
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
          <div class="card-block text-xs-right">
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
        <div class="card-footer">
          <i class="fa fa-tags"></i> <span><?php the_category(', '); ?></span>
        </div>
      </div>
<?php endwhile; else: ?>
  </div>
<div>
  <p>記事がありません</p>
</div>
<?php endif; ?>
