<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="format-detection" content="telephone=no" />
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/logo.ico" />
        <?php wp_head(); ?>
        <link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-precomposed.png" />
    </head>
    <body class="no-thank-yu" <?php body_class(); ?>>
        <header>
          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false" name="button">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a href="<?php echo home_url(); ?>/" class="navbar-brand"><?php bloginfo('name'); ?></a>
              </div>
              <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav">
<?php
  $defaults = array(
                    'theme_location'  => 'navbar',
                    'container' => '' ,
                    'items_wrap' => '%3$s'
              );
  wp_nav_menu( $defaults );
?>
                </ul>
              </div>
            </div>
          </nav>
        </header>
        <div class="container">
          <div class="visible-xs-block clearfix">
            <div class="dropdown pull-right">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-menu-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                市町村別ページ
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdown-menu-1">
                <?php
                $cat_args = array(
                  'orderby'      => 'name',
                );
                $outputs = get_categories($cat_args);
                foreach ($outputs as $output)
                {
                ?>
                <li><a href="<?php echo get_category_link($output->cat_ID); ?>"><?php echo $output->cat_name ?><span class="badge"><?php echo $output->count ?></span></a></li>
                <?php
                }
                ?>
              </ul>
            </div>
          </div>
