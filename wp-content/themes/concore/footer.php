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
        <div class="row">
            <div class="col-md-12">
                <?php if ( is_active_sidebar( 'footer-content' ) ) : ?>
                    <!-- Footer Content -->
                    <?php dynamic_sidebar( 'footer-content' ); ?>
                <?php endif; ?>
            </div>
            <div class="col-sm-12">
                <p class="copyright"><?php echo 'Copyright &copy; ' . get_bloginfo( 'name' ) . ' ' . date('Y'); ?>. All rights reserved. | <a href="/privacy-policy/">Privacy Policy</a></p>
            </div>
        </div>
    </div><!-- .inner -->
</footer><!-- #colophon -->

</div><!-- #page -->

<?php if ( is_active_sidebar( 'floating-form' ) ) : ?>
    <div id="contact-float" class="floating-form">
        <span class="toggle">Chat Now! <i class="fa fa-envelope"></i></span>
        <div class="inner">
            <?php dynamic_sidebar( 'floating-form' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php wp_footer(); ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri() . '/js/EQCSS-polyfills.min.js'?>"></script><![endif]-->
</body>
</html>
