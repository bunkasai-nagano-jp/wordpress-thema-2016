<?php

if ( get_gmap_sv_url(600, 350) ): ?>
<img class="card-img-top img-fluid" src="<?php echo get_gmap_sv_url(600, 350); ?>" alt="streetview">
<?php endif; ?>
<div class="card-block">
  <?php if ( is_ended() ): ?>
  <p class="card-text text-muted">この文化祭は終了しました</p>
  <?php endif; ?>
  <h2 class="card-title">名称</h2>
  <p><?php echo the_field('name'); ?></p>
  <h2 class="card-title">開催期間</h2>
  <p><?php
  if ( !get_field('startDate') ):
    the_field('startDate');
  else:
    echo get_field('startDate').'&nbsp;~&nbsp;'.get_field('endDate');
  endif;
?>
  </p>
  <h2 class="card-title">一般公開</h2>
<?php
if ( get_field('public_unknown') ):
  echo '<p>';
  echo '不明';
  echo '</p>';
else:
  if ( have_rows('public_open') ):
    while ( have_rows('public_open') ) : the_row();
      if ( get_sub_field('public_open_day') and get_sub_field('public_open_start_time') and get_sub_field('public_open_end_time') ):
        echo '<p>';
        echo get_sub_field('public_open_day'). '&nbsp;'. get_sub_field('public_open_start_time'). '&nbsp;~&nbsp;'. get_sub_field('public_open_end_time');
        echo '</p>';
      elseif ( get_sub_field('public_open_day') ):
        echo '<p>';
        get_sub_field('public_open_day');
        echo '</p>';
      else:

      endif;
    endwhile;

  elseif ( get_field('startDate') and get_field('endDate') ):
    echo '<p>';
    echo get_field('startDate').'&nbsp;~&nbsp;'.get_field('endDate');
    echo '</p>';
  elseif ( get_field('startDate') ):
    echo '<p>';
    echo get_field('startDate');
    echo '</p>';
  else:
    echo '<p>';
    echo 'なし';
    echo '</p>';
  endif;

endif;
?>
<?php
  if ( have_rows('bunkasai_site') ):
    echo '<h2 class="card-title">関連サイト</h2>';
    echo '<div class="card-block">';
    while ( have_rows('bunkasai_site') ) :the_row();
      if ( get_sub_field('bunkasai_site_name') and get_sub_field('bunkasai_site_url') ):
        $element = '<a href="'.get_sub_field('bunkasai_site_url').'">'.get_sub_field('bunkasai_site_url').'</a>';
        echo '<h3>'. get_sub_field('bunkasai_site_name'). '</h3>';
        echo $element;
      endif;
    endwhile;
    echo '</div>';
  else:

  endif;
?>
  <h2 class="card-title">地図</h2>
  <?php echo get_gmap_url(); ?>
  <h3 class="card-title">学校情報</h3>
  <table class="table table-striped table-bordered">
    <tbody>
      <tr>
        <td>学校名</td>
        <td><?php echo get_field('schoolName'); ?></td>
      </tr>
      <tr>
        <td>住所</td>
        <td><?php echo get_field('address'); ?></td>
      </tr>
      <tr>
        <td>公式サイト</td>
        <td><a href="<?php echo get_field('url'); ?>"><?php echo get_field('url'); ?></a></td>
      </tr>
      <tr>
        <td>電話番号</td>
        <td><?php echo get_field('tel'); ?></td>
      </tr>
    </tbody>
  </table>
</div>
