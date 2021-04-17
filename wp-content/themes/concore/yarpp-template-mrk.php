<?php
/*
YARPP Template: Custom MRK Layout
Description: Requires a theme which supports post thumbnails
Author: Kael Steinert
*/ ?>
<div class="mrk-related">
    <h3 class="section-title">Related Articles</h3>
    <?php if (have_posts()):?>
    <ul>
        <?php while (have_posts()) : the_post(); ?>
        <li>
            <a href="<?php the_permalink() ?>" rel="bookmark">
                <?php
                $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
                ?>
                <div class="related-img" style="background-image:url(<?php echo $image; ?>);"></div>
                <h4 class="related-title"><?php the_title(); ?></h4>
            </a>
        </li>
        <?php endwhile; ?>
    </ul>
</div>

<?php else: ?>
<p>No related photos.</p>
<?php endif; ?>
