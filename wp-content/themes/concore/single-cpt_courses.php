<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ferus_Core
 */

get_header(); ?>

<?php
while (have_posts()) : the_post(); ?>

    <?php
    $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
    $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
    ?>
    <section id="page-header" class="" style="background-image:url(<?php echo $image; ?>);"></section>


    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            /**
             * Course Fields
             */
            $course_duration = get_field( "course_duration" );
            $course_format = get_field( "course_format" );
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                <div class="container">
                    <div class="entry-wrap col-md-10 col-md-push-1">

                        <header class="entry-header">
                            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                            <div class="entry-meta">
                                <p class="duration"><strong>Duration:</strong> <?php echo $course_duration; ?></p>
                                <p class="format"><strong>Format:</strong> <?php echo $course_format; ?></p>
                            </div><!-- .entry-meta -->
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <?php
                            the_content( sprintf(
                            /* translators: %s: Name of current post. */
                                wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ferus_core' ), array( 'span' => array( 'class' => array() ) ) ),
                                the_title( '<span class="screen-reader-text">"', '"</span>', false )
                            ) );
                            ?>
                        </div><!-- .entry-content -->
                    </div>
                </div>

            </article><!-- #post-## -->

            <?php //the_post_navigation(); ?>

            <?php // If comments are open or we have at least one comment, load up the comment template.
            //if (comments_open() || get_comments_number()) : ?>
                <!-- <div class="container">
                    <div class="col-md-10 col-md-push-1 panel">
                        <div class="panel-content">
                            <?php //comments_template(); ?>
                        </div>
                    </div>
                </div> -->
            <?php // endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php // End of the loop.
endwhile; ?>

<?php
get_footer();
