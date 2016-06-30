<!-- .flex-container -->
<div class="flex-container">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
  $start_date         =  get_field('startDate');
  $end_date           =  get_field('endDate');
  $today              =  date("Y/m/d");
  $year               =  date("Y", strtotime($start_date));
  $days               =  get_remaining_days();
?>
  <!-- card -->
  <div class="card">
<?php
  $src = get_gmap_sv_url(385, 200);
  if ($src): ?>
    <a href="<?php the_permalink(); ?>">
      <img class="card-img-top img-fluid" src="<?php echo $src; ?>" alt="streetview">
    </a>
<?php endif; ?>
    <div class="card-block">
      <a href="<?php the_permalink(); ?>">
        <h2 class="card-title"><?php the_field('name'); ?></h2>
      </a>
      <h6 class="card-subtitle text-muted"><?php the_field('class'); ?> <?php the_field('schoolName'); ?></h6>
      <div class="card-block">
<?php if ($end_date < $today): ?>
        <p class="card-text text-muted"><i class="fa fa-fw fa-clock-o" aria-hidden="true"></i> 終了</p>
<?php elseif ($year == date("Y") and strtotime($today) >= strtotime($start_date) and strtotime($today) <= strtotime($end_date)): ?>
        <p class="card-text text-info"><i class="fa fa-fw fa-flag" aria-hidden="true"></i> 開催中</p>
<?php elseif ($days > 0): ?>
        <p class="card-text text-primary"><i class="fa fa-fw fa-clock-o" aria-hidden="true"></i> 開催まで<?php echo $days; ?>日</p>
<?php endif; ?>
        <p class="card-text">
          <span><i class="fa fa-fw fa-calendar"></i> 開催期間</span>
<?php if ( get_field('startDate') and get_field('endDate') ): ?>
          <span><?php the_field('startDate'); ?>&nbsp;~&nbsp;<?php the_field('endDate'); ?></span>
<?php elseif ( get_field('startDate') and !get_field('endDate') ): ?>
          <span><?php the_field('startDate'); ?></span>
<?php else: ?>
          <span>不明</span>
<?php endif; ?>
        </p>
        <p class="card-text"><i class="fa fa-fw fa-info" aria-hidden="true"></i> 一般公開</p>
          <?php
          if ( get_field('public_unknown') ):
            echo '<p class="card-text">';
            echo '不明';
            echo '</span>';
          else:
            if ( have_rows('public_open') ):
              while ( have_rows('public_open') ) : the_row();
                if ( get_sub_field('public_open_day') and get_sub_field('public_open_start_time') and get_sub_field('public_open_end_time') ):
                  echo '<p class="card-text">';
                  echo get_sub_field('public_open_day'). '&nbsp;'. get_sub_field('public_open_start_time'). '&nbsp;~&nbsp;'. get_sub_field('public_open_end_time');
                  echo '</p>';
                elseif ( get_sub_field('public_open_day') ):
                  echo '<p class="card-text">';
                  get_sub_field('public_open_day');
                  echo '</p>';
                else:

                endif;
              endwhile;

            elseif ( get_field('startDate') and get_field('endDate') ):
              echo '<p class="card-text">';
              echo get_field('startDate').'&nbsp;~&nbsp;'.get_field('endDate');
              echo '</p>';
            elseif ( get_field('startDate') ):
              echo '<p class="card-text">';
              echo get_field('startDate');
              echo '</p>';
            else:
              echo '<p class="card-text">';
              echo 'なし';
              echo '</p>';
            endif;

          endif;
          ?>
      </div>
      <div class="card-block text-xs-right">
        <a href="<?php the_permalink(); ?>" class="btn btn-primary">詳細</a>
      </div>
    </div>
    <div class="card-footer">
      <i class="fa fa-fw fa-tags"></i> <span><?php the_category(', '); ?></span>
    </div>
  </div>
  <!-- /card -->
<?php endwhile; ?>
<?php else: ?>
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
