<?php
/**
 * Template Name: Default with Sidebar
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header(); ?>


    <?php
    $iHeight = header_height_get_meta( 'header_height_size' );
    if($iHeight) {
        $bannerHeight = $iHeight;
    } else {
        $bannerHeight = '';
    }
    ?>
    <?php if($bannerHeight != 'None'): ?>
        <?php
        $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/bg-repeat-dark.jpg';
        $bg_class = $feat_image[0] ? '' : 'bg-repeat-dark';
        $contentLocation = custom_header_content_get_meta('custom_header_content_location') ? custom_header_content_get_meta('custom_header_content_location') : 'content-center';
        ?>
        <section id="page-header" class="<?php echo $contentLocation; ?> <?php echo strtolower($bannerHeight) ?> <?php echo $bg_class; ?>" style="background-image:url(<?php echo $image; ?>);">
            <div class="container">
                <div class="header-content">
                    <?php
                    $customTitle = html_entity_decode( custom_header_content_get_meta('custom_header_content_title') );
                    $customHeaderCont = html_entity_decode( custom_header_content_get_meta('custom_header_content_content') );
                    ?>
                    <?php if( $customTitle && $customHeaderCont ): ?>
                        <h1 class="page-title"><?php echo $customTitle; ?></h1>
                        <p class="header-subline"><?php echo $customHeaderCont; ?></p>
                    <?php elseif( $customTitle && !$customHeaderCont ): ?>
                        <h1 class="page-title"><?php echo $customTitle; ?></h1>
                    <?php elseif( !$customTitle && $customHeaderCont ): ?>
                        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                        <p class="header-subline"><?php echo $customHeaderCont; ?></p>
                    <?php else : ?>
                        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Page Top Widgets -->
    <?php if ( is_active_sidebar( 'page-top' ) ) : ?>
        <section id="page-top" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'page-top' ); ?>
        </section>
    <?php endif; ?>

    <div class="container page-content">

        <div class="row">

            <div id="primary" class="content-area page-body col-md-8">

                <!-- Inner Top Widgets -->
                <?php if ( is_active_sidebar( 'inner-top' ) ) : ?>
                    <section id="inner-top" class="widget-area" role="complementary">
                        <?php dynamic_sidebar( 'inner-top' ); ?>
                    </section>
                <?php endif; ?>

                <main id="main" class="site-main" role="main">
                <?php while (have_posts()) : the_post(); ?>
                    <!-- BreadCrumbs -->
                    <?php
                    if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<div id="breadcrumbs" class="col-md-12">', '</div>');
                    }
                    ?>

                    <?php get_template_part('template-parts/content', 'page'); ?>

                    <?php // If comments are open or we have at least one comment, load up the comment template.
                    /*if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;*/ ?>
                <?php endwhile; // End of the loop. ?>
                </main><!-- #main -->

                <!-- Inner Bottom Widgets -->
                <?php if ( is_active_sidebar( 'inner-bottom' ) ) : ?>
                    <section id="inner-bottom" class="widget-area" role="complementary">
                        <?php dynamic_sidebar( 'inner-bottom' ); ?>
                    </section>
                <?php endif; ?>

            </div><!-- #primary -->

            <?php get_sidebar(); ?>

        </div><!-- .row -->

    </div><!-- .container -->

    <!-- Page Bottom Widgets -->
    <?php if ( is_active_sidebar( 'page-bottom' ) ) : ?>
        <section id="page-bottom" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'page-bottom' ); ?>
        </section>
    <?php endif; ?>

<?php
get_footer();
