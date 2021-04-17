<?php
/**
 *
 * The default 404 error page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header(); ?>

<section id="page-header" class="" style="background-image:url(<?php echo get_template_directory_uri() . '/inc/images/hero.jpg'; ?>);">
    <div class="container">
        <div class="header-content">
            <h1 class="page-title">Whoops!<br>That page can&rsquo;t be found</h1>
        </div>
    </div>
</section>

    <!-- Page Top Widgets -->
<?php if ( is_active_sidebar( 'page-top' ) ) : ?>
    <section id="page-top" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'page-top' ); ?>
    </section>
<?php endif; ?>

    <!-- Inner Top Widgets -->
<?php if ( is_active_sidebar( 'inner-top' ) ) : ?>
    <section id="inner-top" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'inner-top' ); ?>
    </section>
<?php endif; ?>

<section id="primary" class="error-404 content-area">
    <main id="main" class="site-main container" role="main">

        <article class="page">
            <div class="entry-content">
                <?php if ( is_active_sidebar( 'four-oh-four' ) ) : ?>
                    <?php dynamic_sidebar( 'four-oh-four' ); ?>
                <?php else : ?>
                    <div class="center">
                        <p><strong>It looks like nothing was found at this location.</strong></p>
                        <p>Maybe try one of the links below or head <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><i class="fa fa-home" aria-hidden="true"></i> Home</a>?</p>
                        <ul class="icon-list default-cont">
                            <li><a href="<?php echo esc_url(home_url('/our-firm/')); ?>">Our Firm</a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div><!-- .entry-content -->
        </article><!-- #post-## -->

    </main><!-- #main -->
</section><!-- #primary -->

    <!-- Inner Bottom Widgets -->
<?php if ( is_active_sidebar( 'inner-bottom' ) ) : ?>
    <section id="inner-bottom" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'inner-bottom' ); ?>
    </section>
<?php endif; ?>

    <!-- Page Bottom Widgets -->
<?php if ( is_active_sidebar( 'page-bottom' ) ) : ?>
    <section id="page-bottom" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'page-bottom' ); ?>
    </section>
<?php endif; ?>

<?php
get_footer();
