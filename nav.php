<!-- nav -->
<nav class="navbar navbar-light">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-9">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12 col-xl-5">
            <div class="row">
              <div class="col-xs-10 col-sm-12 col-md-12">
                <a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
              </div>
              <div class="col-xs-2">
                <button class="navbar-toggler hidden-sm-up pull-xs-right" type="button" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header"><i class="fa fa-bars" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-7">
            <div class="collapse navbar-toggleable-xs" id="navbar-header">
              <div class="nav navbar-nav">
                <?php
                $defaults = array(
                  'menu'            => 'navbar',
                  'container'       => false,
                  'echo'            => true,
                  'depth'           => 0,
                  'walker'          => new navbar_link_list,
                  'theme_location'  => 'navbar',
                  'items_wrap'      => '%3$s',
                );
                wp_nav_menu( $defaults );?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-7 col-lg-4 col-lg-offset-0 col-xl-3 col-xl-offset-0">
        <form action="https://www.google.com/cse" class="input-group" id="cse-search-box" >
          <input type="hidden" name="cx" value="000907066374336213658:lnnce0mnjry" />
          <input type="hidden" name="ie" value="UTF-8" />
          <input class="form-control" type="text" name="q" size="31" />
          <span class="input-group-btn">
            <input class="btn btn-success-outline" type="submit" name="sa" value="Search" />
          </span>
        </form>
      </div>
    </div>
  </div>
</nav>
<!-- /nav -->
