<?php
/**
 *
 * The default page for contact page
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

<!-- Inner Top Widgets -->
<?php if ( is_active_sidebar( 'inner-top' ) ) : ?>
    <section id="inner-top" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'inner-top' ); ?>
    </section>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <!-- BreadCrumbs -->
            <?php
            /*if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs" class="col-md-12">', '</div>');
            }*/
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php
                $bannerHeight = header_height_get_meta( 'header_height_size' );
                if($bannerHeight === 'None'): ?>
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    </header><!-- .entry-header -->
                <?php endif; ?>

                <div class="entry-content">

                    <!-- <section id="mission" class="border-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6" data-col="about1">
                                    <img src="/wp-content/themes/concore/inc/images/police-suv.jpg" width="800" height="500">
                                </div>
                                <div class="col-sm-6 v-align" data-col="about1">
                                    <div class="v-inner">
                                        <h3 class="mini-title" data-color="blue">Mission Statement</h3>
                                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce blandit nibus lorem, non rhoncus sem feugiat eu. Maecenas interdum imperdiet lacus non maximus.</h4>
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat. Excepteur sint occaecat cupidatat non proident, sunt in culpa. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="vision" class="border-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6 col-sm-push-6" data-col="about2">
                                    <img src="/wp-content/themes/concore/inc/images/policemen.jpg" width="800" height="500">
                                </div>
                                <div class="col-sm-6  col-sm-pull-6 v-align" data-col="about2">
                                    <div class="v-inner">
                                        <h3 class="mini-title" data-color="blue">Vision Statement</h3>
                                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce blandit nibus lorem, non rhoncus sem feugiat eu. Maecenas interdum imperdiet lacus non maximus.</h4>
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat. Excepteur sint occaecat cupidatat non proident, sunt in culpa. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section> -->


                    <section id="family-law-intro" class="">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6 col-sm-push-6" data-col="fl-intro">
                                    <img src="/wp-content/themes/concore/inc/images/default.jpg" width="800" height="500">
                                </div>
                                <div class="col-sm-6 col-sm-pull-6 v-align" data-col="fl-intro">
                                    <div class="v-inner">
                                        <h3 class="list-menu-title">I need help with:</h3>
                                        <?php echo do_shortcode('[list-menu menu="Family Law" depth="1"]'); ?>
                                        <p>Most of our family law clients seek help over separation and divorce issues.  Some clients come to us thinking that divorce is the big hurdle.  We explain that separation brings with it a number of issues to settle, the most important of which we describe as “kids, money and property”.   If you settled these issues fairly and according to law, divorce is the easy part. If not, then the divorce can be delayed.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="" class="">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6 v-align" data-col="fl1">
                                    <div class="v-inner">
                                        <img src="/wp-content/themes/concore/inc/images/default.jpg" width="800" height="500">
                                    </div>
                                </div>
                                <div class="col-sm-6" data-col="fl1">
                                    <p>If you have children, we discuss custody, visitation rights (access) and child support.  Whether or not there are children, we deal with property division and what is to happen to the home.  There may be spousal support issues.  Each family’s situation is unique and we help you put together all the puzzle pieces that are important in your life. We review and explain to you the law surrounding these key issues.  We help find ways to settle them.  We look for practical solutions.</p>
                                    <p>An increasing number of our clients are about to marry or live common-law, often for a ‘second time’. They too request help in designing cohabitation agreements and marriage contracts to protect their financial interests.</p>
                                    <p>We also provide representation to persons involved in child welfare court proceedings involving Children’s Aid Societies.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="" class="">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6 col-sm-push-6" data-col="fl2">
                                    <img src="/wp-content/themes/concore/inc/images/default.jpg" width="800" height="500">
                                </div>
                                <div class="col-sm-6 col-sm-pull-6 v-align" data-col="fl2">
                                    <div class="v-inner">
                                        <p>Charles Morrison has been practicing family law for over thirty years. In addition to negotiating separation agreements, he regularly appears at the Ontario Court of Justice as well as the Superior Court of Justice locally and beyond. For many years, Charles has also served as a Deputy Judge in the Kitchener Small Claims Court.</p>
                                        <p>As a panel member of the Office of the Children’s Lawyer he also represents children in court proceedings. He has trained as a mediator and has been heavily involved in Collaborative Family Law. (We’re enthusiastic about Collaborative Family Law! - elsewhere in our website, we tell you why.)    We believe that “no two family law cases are the same”. That is what makes the practice of family law so interesting and challenging.</p>
                                        <p>On family law matters we offer a reduced rate for the first hour's consultation (excluding Independent Legal Advice and EAP referrals).</p>
                                        <p><a href="#" data-button>Book A Consultation</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="how-it-began" class="">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6" data-col="about3">
                                    <img src="/wp-content/themes/concore/inc/images/default.jpg" width="800" height="500">
                                </div>
                                <div class="col-sm-6 v-align" data-col="about3">
                                    <div class="v-inner">
                                        <h3 class="mini-title" data-color="blue">How It All Began</h3>
                                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce blandit nibus lorem, non rhoncus sem feugiat eu. Maecenas interdum imperdiet lacus non maximus.</h4>
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat. Excepteur sint occaecat cupidatat non proident, sunt in culpa. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="about-anita" class="">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6 col-sm-push-6" data-col="about4">
                                    <img src="/wp-content/themes/concore/inc/images/anita-jack-davies.jpg" width="800" height="800">
                                </div>
                                <div class="col-sm-6  col-sm-pull-6 v-align" data-col="about4">
                                    <div class="v-inner">
                                        <h3 class="mini-title" data-color="blue">About Dr. Anita Jack-Davies</h3>
                                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce blandit nibus lorem, non rhoncus sem feugiat eu. Maecenas interdum imperdiet lacus non maximus.</h4>
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat. Excepteur sint occaecat cupidatat non proident, sunt in culpa. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="how-it-began" class="">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="accordion">
                                        <h3 data-accordion="title">FAQ Question #1</h3>
                                        <div data-accordion="content">
                                            <p>Fugiat quo voluptas nulla pariatur? Excepteur sint occaecat cupidatat non proident, sunt in culpa. Ut enim ad minim veniam, quis nostrud exercitation ullamco. Facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                            <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                                            <p>Itaque earum rerum hic tenetur a sapiente delectus. Fugiat quo voluptas nulla pariatur? Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo. Eaque ipsa quae ab illo inventore veritatis et quasi.</p>
                                        </div>

                                        <h3 data-accordion="title">FAQ Question #2</h3>
                                        <div data-accordion="content">
                                            <p>Fugiat quo voluptas nulla pariatur? Excepteur sint occaecat cupidatat non proident, sunt in culpa. Ut enim ad minim veniam, quis nostrud exercitation ullamco. Facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                            <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                                            <p>Itaque earum rerum hic tenetur a sapiente delectus. Fugiat quo voluptas nulla pariatur? Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo. Eaque ipsa quae ab illo inventore veritatis et quasi.</p>
                                        </div>

                                        <h3 data-accordion="title">FAQ Question #3</h3>
                                        <div data-accordion="content">
                                            <p>Fugiat quo voluptas nulla pariatur? Excepteur sint occaecat cupidatat non proident, sunt in culpa. Ut enim ad minim veniam, quis nostrud exercitation ullamco. Facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                            <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                                            <p>Itaque earum rerum hic tenetur a sapiente delectus. Fugiat quo voluptas nulla pariatur? Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo. Eaque ipsa quae ab illo inventore veritatis et quasi.</p>
                                        </div>

                                        <h3 data-accordion="title">FAQ Question #4</h3>
                                        <div data-accordion="content">
                                            <p>Fugiat quo voluptas nulla pariatur? Excepteur sint occaecat cupidatat non proident, sunt in culpa. Ut enim ad minim veniam, quis nostrud exercitation ullamco. Facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                            <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                                            <p>Itaque earum rerum hic tenetur a sapiente delectus. Fugiat quo voluptas nulla pariatur? Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo. Eaque ipsa quae ab illo inventore veritatis et quasi.</p>
                                        </div>

                                        <h3 data-accordion="title">FAQ Question #5</h3>
                                        <div data-accordion="content">
                                            <p>Fugiat quo voluptas nulla pariatur? Excepteur sint occaecat cupidatat non proident, sunt in culpa. Ut enim ad minim veniam, quis nostrud exercitation ullamco. Facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                            <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
                                            <p>Itaque earum rerum hic tenetur a sapiente delectus. Fugiat quo voluptas nulla pariatur? Accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo. Eaque ipsa quae ab illo inventore veritatis et quasi.</p>
                                        </div>

                                    </div><!-- .accordion -->
                                </div>
                                <div class="col-sm-6 testimonials">
                                    <h3 class="section-title center">Testimonials</h3>
                                    <div class="testimonial_slider">
                                        <div>
                                            <blockquote>"Et harum quidem rerum facilis est et expedita distinctio. Fugiat quo voluptas nulla pariatur? Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Sed ut perspiciatis unde omnis iste natus error dolor sit amet, consectetur, adipisci velit."<span class="author">- First Last</span></blockquote>
                                        </div>
                                        <div>
                                            <blockquote>"Et harum quidem rerum facilis est et expedita distinctio. Fugiat quo voluptas nulla pariatur? Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Sed ut perspiciatis unde omnis iste natus error dolor sit amet, consectetur, adipisci velit."<span class="author">- First Last</span></blockquote>
                                        </div>
                                        <div>
                                            <blockquote>"Et harum quidem rerum facilis est et expedita distinctio. Fugiat quo voluptas nulla pariatur? Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Sed ut perspiciatis unde omnis iste natus error dolor sit amet, consectetur, adipisci velit."<span class="author">- First Last</span></blockquote>
                                        </div>
                                        <div>
                                            <blockquote>"Et harum quidem rerum facilis est et expedita distinctio. Fugiat quo voluptas nulla pariatur? Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit. Sed ut perspiciatis unde omnis iste natus error dolor sit amet, consectetur, adipisci velit."<span class="author">- First Last</span></blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


<div class="row">
<div class="col-md-7">
    <p>At Morrison Reist, we care not only about our clients but about the Kitchener-Waterloo Community and beyond. We get involved with a number of organizations effecting change for the future. Here are just a few things we are up to:</p>
    <ul>
        <li>We sponsor Purse-suassion, an annual fundraising event in support of the Alzheimer Society Waterloo Wellington.  </li>
        <li>Our Employment team continues to contribute to the Human Resources Professionals Association Grand Valley Chapter in seminars and sponsorship of its annual Executive Night.</li>
        <li>We support Rock for Life, an annual fundraiser for Lawyers International Food Enterprise (LIFE).</li>
        <li>We sponsored the Creating Legal AcUity in Student Environments (C.L.A.U.S.E.) 2015 Undergraduate Mock Trials Canada.</li>
    </ul>
    <p><img src="http://dev-morrison-reist.pantheonsite.io/wp-content/uploads/2018/01/Community-Page-photo-collage_1.jpg" alt="" /></p>
    <ul>
        <li>Melanie was President of the Waterloo Law Association when the announcement was made that a new courthouse was to be built in Waterloo Region. Melanie attended the ground breaking ceremony along with judicial and local elected officials. The courthouse was completed in 2013. </li>
        <li>Melanie serves on the Board of Blue Sea Philanthropy and participates in the Ride for Refuge and The Coldest Night of the Year annual fundraising events.</li>
        <li>Charles is actively involved in a weekly Kitchener Chamber of Commerce networking group, helping to ensure that small businesses in the Region thrive. He regularly speaks about family law issues to the group.</li>
        <li>Charles participated in the Runway Run fundraiser on the tarmac of Toronto Pearson Airport in support of community organizations.</li>
        <li>Pamela is President for the Alzheimer Society Waterloo Wellington Board of Directors. She participates in the annual Walk for Memories in support of the ASWW and advocates for the ASWW at a number of events throughout the year.</li>
        <li>Holly is a member of the Cambridge Chamber of Commerce.</li>
    </ul>
    <h3 class="list-menu-title">Learn More About Us:</h3>
    [list-menu menu="Family Law" depth="1"]
</div>
<div class="col-md-5">
    <div class="fb-page" data-href="https://www.facebook.com/MorrisonReist/" data-tabs="timeline" data-width="500" data-height="700" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/MorrisonReist/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/MorrisonReist/">Morrison Reist</a></blockquote></div>
</div>
</div>


                </div><!-- .entry-content -->
            </article><!-- #post-## -->

            <?php // If comments are open or we have at least one comment, load up the comment template.
            /*if (comments_open() || get_comments_number()) :
                comments_template();
            endif;*/ ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php endwhile; // End of the loop. ?>

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
