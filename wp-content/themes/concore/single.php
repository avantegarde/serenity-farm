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

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                <div class="container">
                    <div class="entry-wrap col-md-10 col-md-push-1">
                        <?php
                        $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                        $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
                        ?>
                        <div id="single-header" class="nolazy" style="background-image:url(<?php echo $image; ?>);"></div>

                        <header class="entry-header">
                            <?php
                            if ( is_single() ) :
                                the_title( '<h1 class="entry-title">', '</h1>' );
                            else :
                                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                            endif;

                            if ( 'post' === get_post_type() ) : ?>
                                <div class="entry-meta">
                                    <p class="date-author">
                                        <span class="date"><?php echo the_date('d-m-Y'); ?></span> |
                                        <span class="author">Author: <a href="<?php echo site_url('/?search-type=blog-search&s=&cat=0&author='); ?><?php the_author_meta('ID'); ?>"><?php the_author(); ?></a></span>
                                    </p>
                                    <?php // ferus_core_posted_on(); ?>
                                    <?php
                                    if(get_the_tag_list()) {
                                        echo get_the_tag_list('<ul class="tag-list"><li>','</li><li>','</li></ul>');
                                    }
                                    ?>
                                </div><!-- .entry-meta -->
                                <?php
                            endif; ?>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <?php
                            the_content( sprintf(
                            /* translators: %s: Name of current post. */
                                wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ferus_core' ), array( 'span' => array( 'class' => array() ) ) ),
                                the_title( '<span class="screen-reader-text">"', '"</span>', false )
                            ) );

                            wp_link_pages( array(
                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ferus_core' ),
                                'after'  => '</div>',
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
