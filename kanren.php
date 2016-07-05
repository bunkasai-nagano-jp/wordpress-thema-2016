<?php
  $posts = relation_post();
  if ($posts) { ?>
    <h2><i class="fa fa-th-list"></i> 関連</h2>
      <div class="card-columns"><?php
      foreach($posts as $post) {
        $start_date         =   get_field('startDate', $post->ID);
        $end_date           =   get_field('endDate', $post->ID);
        $today              =   date("Y/m/d");
        $year               =   date("Y", strtotime($start_date));
        $days               =   get_remaining_days(); ?>
        <div class="card">
<?php
  if ( get_gmap_sv_url(640, 300) ): ?>
          <a href="<?php echo get_permalink($post->ID); ?>"><img class="card-img-top img-fluid" src="<?php echo get_gmap_sv_url(640, 300); ?>" alt="streetview"></a><?php
  endif;
?>
          <div class="card-block">
            <a href="<?php echo get_permalink($post->ID); ?>"><h2 class="card-title"><?php the_field('name'); ?></h2></a>
            <h6 class="card-subtitle text-muted"><?php the_field('class'); ?> <?php the_field('schoolName'); ?></h6>
            <div class="card-block">
<?php
  if ($end_date < $today): ?>
              <p class="card-text text-muted"><i class="fa fa-fw fa-clock-o" aria-hidden="true"></i> 終了</p>
<?php
  elseif ($year == date("Y") and strtotime($today) >= strtotime($start_date) and strtotime($today) <= strtotime($end_date)): ?>
              <p class="card-text text-info"><i class="fa fa-fw fa-flag" aria-hidden="true"></i> 開催中</p>
<?php
  elseif ($days > 0): ?>
              <p class="card-text text-primary"><i class="fa fa-fw fa-clock-o" aria-hidden="true"></i> 開催まで<?php echo $days; ?>日</p>
<?php
  endif;
?>
              <p class="card-text">
            <?php if ($start_date and $end_date): ?>
                <span><i class="fa fa-fw fa-calendar"></i> 開催期間</span>
                <span><?php echo $start_date; ?> ~ <?php echo $end_date; ?></span>
            <?php elseif ($start_date and !$end_date): ?>
                <span><i class="fa fa-fw fa-calendar"></i> 開催日</span>
                <span><?php echo $start_date; ?></span>
            <?php endif; ?>
              </p>
              <p class="card-text"><i class="fa fa-fw fa-info" aria-hidden="true"></i> 一般公開</p>
<?php
if ( get_field('public_unknown') ):
  echo '<p class="card-text">';
  echo '不明';
  echo '</p>';
else:

  if ( have_rows('public_open') ):

    while ( have_rows('public_open') ) : the_row();
      if ( get_sub_field('public_open_day') and get_sub_field('public_open_start_time') and get_sub_field('public_open_end_time') ):
        echo '<p class="card-text">';
        echo get_sub_field('public_open_day'). '&nbsp;'. get_sub_field('public_open_start_time'). '&nbsp;~&nbsp;'. get_sub_field('public_open_end_time');
        echo '</p>';
      elseif ( get_sub_field('public_open_day') ):
        echo '<p class="card-text">';
        echo get_sub_field('public_open_day');
        echo '</p>';
      else:

      endif;
    endwhile;

  elseif ( get_field('publicStartDate') and get_field('publicEndDate') ):
    echo '<p class="card-text">';
    echo get_field('publicStartDate').'&nbsp;~&nbsp;'.get_field('publicEndDate');
    echo '</p>';
  elseif ( get_field('publicStartDate') and !get_field('publicEndDate') ):
    echo '<p class="card-text">';
    echo get_field('publicStartDate');
    echo '</p>';
  elseif ( !have_rows('public_open') and !get_field('publicStartDate') and !get_field('publicEndDate') ):
    echo '<p class="card-text">';
    echo 'なし';
    echo '</p>';
  endif;

endif;
?>
              </div>
              <div class="card-block text-xs-right">
                <a href="<?php echo get_permalink($post->ID); ?>" class="btn btn-primary">詳細</a>
              </div>
            </div>
            <div class="card-footer">
              <i class="fa fa-fw fa-tags"></i> <span><?php the_category(', '); ?></span>
            </div>
          </div><?php
      } ?>
      </div>
<?php
  }
?>
