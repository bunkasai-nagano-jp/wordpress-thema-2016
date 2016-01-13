<div id="side">
<aside>
<?php if (is_404()) { ?>
<?php } else { ?>
<?php } ?>
  <div id="mybox">
    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>
    <?php endif; ?>
  </div>
</aside>
</div>
