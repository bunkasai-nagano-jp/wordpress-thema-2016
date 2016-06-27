<!-- .flex-container -->
<div class="flex-container">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
  $name               =  get_field('name');
  $class              =  get_field('class');
  $school_name        =  get_field('schoolName');
  $start_date         =  get_field('startDate');
  $end_date           =  get_field('endDate');
  $public_start_date  =  get_field('publicStartDate');
  $public_end_date    =  get_field('publicEndDate');
  $public_unknown     =  get_field('public_unknown');
  $today              =  date("Y/m/d");
  $year               =  date("Y", strtotime($start_date));
  $days               =  abs(strtotime($start_date) - strtotime($today)) / (60 * 60 * 24);
?>
  <!-- card -->
  <div class="card">
<?php
  $src = get_gmap_sv_url(385, 200);
  if ($src) { ?>
    <a href="<?php the_permalink(); ?>">
      <img class="card-img-top img-fluid" src="<?php echo $src; ?>" alt="streetview">
    </a>
<?php } ?>
    <div class="card-block">
      <a href="<?php the_permalink(); ?>">
        <h2 class="card-title"><?php echo $name; ?></h2>
      </a>
      <h6 class="card-subtitle text-muted"><?php echo $class; ?> <?php echo $school_name; ?></h6>
      <div class="card-block">
<?php if ($year < date("Y")) { ?>
        <p class="card-text text-muted"><i class="fa fa-fw fa-clock-o" aria-hidden="true"></i> 終了</p>
<?php } elseif ($year == date("Y") and strtotime($today) >= strtotime($start_date) and strtotime($today) <= strtotime($end_date)) { ?>
        <p class="card-text text-info"><i class="fa fa-fw fa-flag" aria-hidden="true"></i> 開催中</p>
<?php } elseif ($days > 0) { ?>
        <p class="card-text text-primary"><i class="fa fa-fw fa-clock-o" aria-hidden="true"></i> 開催まで<?php echo $days; ?></p>
<?php } else { }; ?>
        <p class="card-text">
<?php if ($start_date and $end_date) { ?>
          <span><i class="fa fa-fw fa-calendar"></i> 開催期間</span>
          <span><?php echo $start_date ?> ~ <?php echo $end_date ?></span>
<?php } elseif ($start_date and !$end_date) { ?>
          <span><i class="fa fa-fw fa-calendar"></i> 開催日</span>
          <span><?php echo $start_date?></span>
<?php } else { ?>
          <span><i class="fa fa-fw fa-calendar"></i> 開催期間</span>
          <span>不明</span>
<?php } ?>
        </p>
        <p class="card-text">
<?php if ($public_unknown) { ?>
          <span><i class="fa fa-fw fa-info" aria-hidden="true"></i> 一般公開</span>
          <span>不明</span>
<?php } elseif (!$public_start_date and !$public_end_date) { ?>
          <span><i class="fa fa-fw fa-info" aria-hidden="true"></i> 一般公開</span>
          <span>なし</span>
<?php } elseif ($public_start_date and !$public_end_date) { ?>
          <span><i class="fa fa-fw fa-info" aria-hidden="true"></i> 一般公開日</span>
          <span><?php echo $public_start_date ?></span>
<?php } elseif ($public_start_date and $public_end_date) { ?>
          <span><i class="fa fa-fw fa-info" aria-hidden="true"></i> 一般公開期間<span>
          <span><?php echo $public_start_date; ?> ~ <?php echo $public_end_date; ?></span>
<?php } else { ?>
          <span><i class="fa fa-fw fa-info" aria-hidden="true"></i> 一般公開</span>
          <span>不明</span>
<?php } ?>
        </p>
      </div>
      <div class="card-block text-xs-right">
        <a href="<?php the_permalink(); ?>" class="btn btn-primary">詳細</a>
      </div>
    </div>
    <div class="card-footer">
      <i class="fa fa-tags"></i> <span><?php the_category(', '); ?></span>
    </div>
  </div>
  <!-- /card -->
<?php endwhile; else: ?>
  <!-- no articles -->
  <div class="card">
    <div class="card-block">
      <p class="card-text">記事がありません</p>
    </div>
  </div>
  <!-- /no articles -->
<?php endif; ?>
</div>
<!-- /.flex-container -->
