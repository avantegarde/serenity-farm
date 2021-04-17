<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ferus_Core
 */

get_header(); ?>

    <hr class="blank-header-line">

<?php
while (have_posts()) : the_post(); ?>
    <?php
    $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
    $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
    ?>
    <!-- <section id="page-header" class="" style="background-image:url(<?php // echo $image; ?>);"></section> -->


    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?> itemprop="employee" itemscope itemtype="http://schema.org/Person">
                <div class="container">
                    <div class="col-md-5 col-md-push-7">
                        <div class="profile-wrap">
                            <div class="profile-pic" style="background-image:url(<?php echo $image; ?>);"></div>
                            <?php
                            $m_linkedin = get_field('member_linkedin');
                            $m_email = get_field('member_email');
                            $m_phone = get_field('member_phone');
                            ?>
                            <?php if ($m_linkedin || $m_email || $m_phone) : ?>
                                <ul class="social">
                                    <?php if ($m_linkedin) : ?>
                                        <li class="linkedin"><a href="<?php echo $m_linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                    <?php endif; ?>
                                    <?php if ($m_email) : ?>
                                        <li><a href="mailto:<?php echo $m_email; ?>" target="_blank" itemprop="email"><?php echo $m_email; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($m_phone) : ?>
                                        <li class="phone" itemprop="telephone"><?php echo $m_phone; ?></li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-7 col-md-pull-5">
                        <div class="entry-content">
                            <h1 class="section-title" itemprop="name"><?php the_title(); ?></h1>
                            <?php $job_title = get_field('member_job_title'); ?>
                            <?php if ($job_title) : ?>
                                <h3 class="job-title" itemprop="jobTitle"><?php echo $job_title; ?></h3>
                            <?php endif; ?>
                            <?php the_content(); ?>
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
