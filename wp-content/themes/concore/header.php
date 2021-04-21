<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ferus_Core
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <!-- <link rel="shortcut icon" href="<?php // echo get_stylesheet_directory_uri(); ?>/favicon.ico"/> -->

    <?php wp_head(); ?>

    <?php if ( has_nav_menu('mobile-menu') ) : ?>
        <!-- Mobile Menu Styles -->
        <style>
            header nav.navbar-default #mobile-menu {
                display: none !important;
            }
            @media screen and (max-width:767px) {
                header nav.navbar-default #mobile-menu {
                    display: block !important;
                }

                header nav.navbar-default #primary {
                    display: none !important;
                }
            }
        </style>
    <?php endif; ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8MFTP6FGQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-Q8MFTP6FGQ');
    </script>

</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'bright_light'); ?></a>

    <?php if ( is_active_sidebar( 'alert-banner' ) ) : ?>
        <aside id="alert-banner" class="alert alert-danger" role="complementary">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <?php dynamic_sidebar( 'alert-banner' ); ?>
        </aside>
    <?php endif; ?>

    <header id="masthead" class="site-header" role="banner">

        <div class="header-inner">
            <div class="container">
                <!-- Toolbar -->
                <?php if ( is_active_sidebar( 'toolbar' ) ) : ?>
                    <aside id="toolbar" class="widget-area" role="complementary">
                        <?php dynamic_sidebar( 'toolbar' ); ?>
                    </aside>
                <?php endif; ?>
            </div>
            <div id="mobile-logo" class="container">
                <h1 class="mobile-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <img src="<?php echo get_template_directory_uri() . '/inc/images/logo.png'; ?>" width="200"><span><?php bloginfo('name'); ?></span>
                    </a>
                </h1>
            </div>
            <div class="container">
                <div class="menu-wrap">
                    <div class="main-navigation">
                        <nav class="navbar navbar-default">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                                    <!-- <span class="sr-only">Toggle navigation</span> -->
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="navbar-main">
                                <div class="flex-nav">
                                    <?php
                                    // Main Menu LEFT
                                    $defaults_left = array(
                                        'theme_location' => 'menu-left',
                                        'container' => false,
                                        'menu_class' => 'primary nav navbar-nav nav-left',
                                        'menu_id' => 'primary-left'
                                    );
                                    wp_nav_menu($defaults_left); ?>

                                    <h1 id="logo">
                                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                            <img src="<?php echo get_template_directory_uri() . '/inc/images/logo.png'; ?>" width="200" alt="<?php bloginfo('name'); ?>">
                                            <span><?php bloginfo('name'); ?></span>
                                        </a>
                                    </h1>

                                    <?php
                                    // Main Menu RIGHT
                                    $defaults_right = array(
                                        'theme_location' => 'menu-right',
                                        'container' => false,
                                        'menu_class' => 'primary nav navbar-nav nav-right',
                                        'menu_id' => 'primary-right'
                                    );
                                    wp_nav_menu($defaults_right);
                                    // Mobile Menu
                                    $mobileArgs = array(
                                        'theme_location' => 'mobile-menu',
                                        'container' => false,
                                        'menu_class' => 'primary nav navbar-nav',
                                        'menu_id' => 'mobile-menu',
                                        'fallback_cb' => false
                                    );
                                    wp_nav_menu($mobileArgs);
                                    ?>
                                </div><!-- .flex-nav -->
                            </div>
                        </nav>
                    </div><!-- .main-navigation -->
                </div><!-- .menu-wrap -->
                <!-- <div class="header-search">
                    <form role="search" method="get" class="search" action="<?php echo esc_url(home_url('/')); ?>">
                        <label for="search_text"><i class="fa fa-search"></i></label>
                        <input type="text" class="search-text" id="search_text" placeholder="Site Search" value="" name="s" title="Search...">
                    </form>
                </div> -->
            </div><!-- .container -->
        </div><!-- .header-inner -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
