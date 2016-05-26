<!-- nav -->
<nav>
  <a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
  <ul>
    <?php
    $defaults = array(
              'theme_location'  => 'navbar',
              'container' => '' ,
              'items_wrap' => '%3$s'
        );
    wp_nav_menu( $defaults );?>
  </ul>
</nav>
<!-- /nav -->
