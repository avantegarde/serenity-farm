<?php
/**
 * Main Loop
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ferus_core
 */

?>

<?php
if ( have_posts() ) :
    /* Start the Loop */
    while ( have_posts() ) : the_post(); ?>

        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-med' ); ?>
        <div class="post-item col-md-12">

            <article id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> post-inner panel">

                <div class="post-content" data-col="post-inner">
                    <!-- <div class="category">
                 <?php // the_category( ' | ', '', $post->ID ); ?>
               </div> -->
                    <h2 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <p class="author-date"><?php the_time('m-d-Y'); ?> | Author: <?php the_author(); ?></p>

                    <p class="content-blurb">
                        <?php echo wp_trim_words( $post->post_content, 46, '...' ); ?>
                    </p>
                    <a href="<?php the_permalink(); ?>" data-button="arrow">Learn More</a>
                </div>
                <?php if($image): ?>
                    <a class="post-thumb" href="<?php echo get_permalink($post->ID); ?>" data-col="post-inner" style="background-image: url(<?php echo $image[ 0 ] ?>);"></a>
                <?php else: ?>
                    <a class="post-thumb" href="<?php echo get_permalink($post->ID); ?>" data-col="post-inner" style="background-image: url(/wp-content/themes/concore/inc/images/hero.jpg);"></a>
                <?php endif; ?>
            </article>
        </div>

    <?php endwhile;

else :
    get_template_part( 'template-parts/content', 'none' );
endif; ?>