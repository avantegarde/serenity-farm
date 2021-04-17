<?php
/**
 * The Homepage of the site
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ferus_core
 */

get_header(); ?>

<?php
$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
$image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
//$bg_class = $feat_image[0] ? '' : 'bg-repeat-dark';
$contentLocation = custom_header_content_get_meta('custom_header_content_location') ? custom_header_content_get_meta('custom_header_content_location') : 'content-center';
?>
<section id="page-header" class="parallax <?php echo $contentLocation; ?> <?php echo strtolower($bannerHeight) ?>" data-plx-img="<?php echo $image; ?>">
    <div class="container">
        <div class="header-content">
            <?php
            $customTitle = html_entity_decode( custom_header_content_get_meta('custom_header_content_title') );
            $customHeaderCont = html_entity_decode( custom_header_content_get_meta('custom_header_content_content') );
            ?>
            <?php if( $customTitle && $customHeaderCont ): ?>
                <h1 class="page-title"><?php echo $customTitle; ?></h1>
                <div class="header-subline"><?php echo $customHeaderCont; ?></div>
            <?php elseif( $customTitle && !$customHeaderCont ): ?>
                <h1 class="page-title"><?php echo $customTitle; ?></h1>
            <?php elseif( !$customTitle && $customHeaderCont ): ?>
                <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                <div class="header-subline"><?php echo $customHeaderCont; ?></div>
            <?php else : ?>
                <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<div id="primary" class="content-area page-body">
    <main id="main" class="site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>
            <?php echo the_content(); ?>
        <?php endwhile; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<!-- Start Modal -->
<!-- <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> -->
<!-- END Modal -->

<?php get_footer();