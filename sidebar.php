<?php
if ( ! is_active_sidebar( 'sidebar-1' ) ){
  return;
}
?>
<div id="side">
<aside>
  <div id="mybox">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
  </div>
</aside>
</div>
