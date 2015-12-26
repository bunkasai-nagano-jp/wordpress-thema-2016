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
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <?php if(is_category()): ?>
    <?php elseif(is_archive()): ?>
        <meta name="robots" content="noindex,follow">
    <?php elseif(is_search()): ?>
        <meta name="robots" content="noindex,follow">
    <?php elseif(is_tag()): ?>
        <meta name="robots" content="noindex,follow">
    <?php elseif(is_paged()): ?>
        <meta name="robots" content="noindex,follow">
    <?php endif; ?>
    <title>
        <?php
        global $page, $paged;
        if(is_front_page()):
          elseif(is_single()):
            wp_title('|',true,'right');
          elseif(is_page()):
            wp_title('|',true,'right');
          elseif(is_archive()):
            wp_title('|',true,'right');
          elseif(is_search()):
            wp_title('|',true,'right');
          elseif(is_404()):
            echo'404 |';
          endif;
          bloginfo('name');
          if($paged >= 2 || $page >= 2):
            echo'-'.sprintf('%sページ',
              max($paged,$page));
        endif; ?>
    </title>
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
                <!-- ブログ名 -->
                    <p class="sitename"><a href="<?php echo home_url(); ?>/">
                    <?php bloginfo( 'name' ); ?>
                    </a></p>
                <!-- アコーディオン -->
                    <div class="s-navi pcnone trigger">
                        <p><span class="op"><i class="fa fa-bars"></i>&nbsp; MENU</span></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="s-navi pcnone">
                        <div class="acordion">
                            <div class="acordion-tree">
                                <ul>
                                    <?php wp_nav_menu(array('theme_location' => 'navbar'));?>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                <!-- /アコーディオン -->
                <!--メニュー-->
                    <nav class="sp-none clearfix">
                        <?php
                            $defaults = array(
                            'theme_location'  => 'navbar',
                            );
                            wp_nav_menu( $defaults );
                        ?>
                    </nav>
            </header>
