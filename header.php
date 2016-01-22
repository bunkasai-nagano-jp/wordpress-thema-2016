<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html class="i7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/normalize.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/logo.ico" />
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/html5shiv.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
    <link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-precomposed.png" />
    </head>
    <body <?php body_class(); ?>>
        <div id="wrapper">
            <header>
                <p class="sitename">
                  <a href="<?php echo home_url(); ?>/">
                    <?php bloginfo( 'name' ); ?>
                  </a>
                </p>
                <nav class="clearfix">
                    <a class="pc-none" id="toggler" href="#"><i class="fa fa-fw fa-bars"></i>MENU</a>
                    <?php
                        $defaults = array(
                                      'theme_location'  => 'navbar',
                                      'container' => false ,
                                      'items_wrap' => '<ul id="menu">%3$s</ul>'
                                    );
                        wp_nav_menu( $defaults );
                    ?>
                </nav>
            </header>
