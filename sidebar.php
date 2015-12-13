<div id="side">
<aside>
<?php if (is_404()) { ?>
<?php } else { ?>
  <div class="ad">
    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(4) ) : else : //アドセンス ?>
    <?php endif; ?>
  </div>
<?php } ?>
  <div id="mybox">
    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : //サイドウイジェット読み込み ?>
    <?php endif; ?>
  </div>
  <!-- スマホだけのアドセンス -->
<?php if (is_404()) { ?>
<?php } else { ?>
  <?php if(is_mobile()) { //スマホの場合 ?>
  <div style="padding-top:10px;">
    <?php get_template_part('ad'); //アドセンス読み込み ?>
  </div>
  <?php } else { //PCの場合 ?>
  <?php } ?>
<?php } ?>
  <!-- /スマホだけのアドセンス -->
  <div id="scrollad">
      <?php get_template_part('scroll-ad'); //追尾式広告 ?>
  </div>
</aside>
</div>