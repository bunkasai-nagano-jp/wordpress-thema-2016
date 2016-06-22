<!-- nav -->
<nav class="navbar navbar-light bg-faded">
  <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header">
          ☰
  </button>
  <div class="collapse navbar-toggleable-xs" id="navbar-header">
    <a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
    <?php
    $defaults = array(
      'menu'            => 'navbar',
      'menu_class'      => 'nav navbar-nav',
      'container'       => 'div',
      'container_class' => 'nav navbar-nav',
      'echo'            => true,
      'depth'           => 0,
      'walker'          => new navbar_link_list,
      'theme_location'  => 'navbar',
      'items_wrap'      => '%3$s',
    );
    wp_nav_menu( $defaults );?>
    <form class="form-inline pull-xs-right">
      <input class="form-control" type="text" placeholder="Search">
      <button class="btn btn-success-outline" type="submit">Search</button>
    </form>
  </div>
</nav>
<!-- /nav -->
