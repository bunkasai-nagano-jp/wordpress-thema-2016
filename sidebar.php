<?php
if ( ! is_active_sidebar( 'sidebar-1' ) ){
  return;
}
?>
<div class="col-md-4">
  <aside>
    <div>
      <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div>
  </aside>
</div>
