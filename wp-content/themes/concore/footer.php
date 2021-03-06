<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ferus_Core
 */

?>

</div><!-- #content -->

<!-- Banner Bottom Widgets -->
<?php if ( is_active_sidebar( 'banner-bottom' ) ) : ?>
    <?php dynamic_sidebar( 'banner-bottom' ); ?>
<?php endif; ?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container">
        <div class="row flex-align">
            <div id="footer-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri() . '/inc/images/logo-white.png'; ?>" width="400" alt="<?php bloginfo('name'); ?>">
                </a>
            </div>
            <div class="footer-menu-wrap">
                <?php
                // Footer Menu
                $footerArgs = array(
                    'theme_location' => 'footer',
                    'container' => false,
                    'menu_class' => 'footer-menu menu',
                    'menu_id' => 'footer-menu',
                    //'fallback_cb' => false
                );
                wp_nav_menu($footerArgs);
                ?>
            </div>
            <div class="footer-social">
                <?php if ( is_active_sidebar( 'footer-content' ) ) : ?>
                    <!-- Footer Content -->
                    <?php dynamic_sidebar( 'footer-content' ); ?>
                <?php endif; ?>
            </div>
        </div>
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <p class="copyright"><?php echo 'Copyright &copy; ' . get_bloginfo( 'name' ) . ' ' . date('Y'); ?>. All rights reserved. | <a href="/privacy-policy/">Privacy Policy</a></p>
                </div>
        </div>
    </div><!-- .inner -->
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri() . '/js/EQCSS-polyfills.min.js'?>"></script><![endif]-->
</body>
</html>
