<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ferus_Core
 */

get_header();
// Infinite Scroll Vars
$archive_scroll = $wp_query->get_queried_object();
if ($archive_scroll->taxonomy === 'category') {
    $catID = $archive_scroll->term_id;
    $tagID = '';
} elseif ($archive_scroll->taxonomy === 'post_tag') {
    $tagID = $archive_scroll->term_id;
    $catID = '';
} else {
    $catID = '';
    $tagID = '';
}
?>

<section id="page-header" class="parallax" data-plx-img="<?php echo get_template_directory_uri() . '/inc/images/our-team-banner.jpg'; ?>">
    <div class="container">
        <div class="header-content">
            <h1 class="page-title">Our Team</h1>
        </div>
    </div>
</section>

<div id="page-wrap" class="clearfix">

    <div id="primary" class="content-area clearfix">

        <?php if ( is_active_sidebar( 'page-header' ) ) : ?>
            <div id="page-header" class="widget-area" role="complementary">
                <?php dynamic_sidebar( 'page-header' ); ?>
            </div><!-- #page-header -->
        <?php endif; ?>

        <main id="main" class="site-main container" role="main">
            <div class="row our-team-wrapper">

                <div class="col-xs-6 col-sm-4 col-md-3 team-block-wrap">
                    <div class="team-blank-block v-align">
                        <div class="v-inner">
                            <h2>Our <br>Leaders</h2>
                        </div>
                    </div>
                </div>

                <?php
                $lawyer_args = array(
                    'post_type'      => 'our_team',
                    'meta_key'		=> 'member_position',
                    'meta_value'	=> 'leader',
                    'order'          => 'ASC'
                );
                $lawyer_query = new WP_Query( $lawyer_args );
                ?>
                <?php if ( $lawyer_query->have_posts() ) : ?>
                    <?php while ( $lawyer_query->have_posts() ) : $lawyer_query->the_post(); ?>
                        <?php
                        $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                        $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
                        $excerpt_length = 250;
                        $content = apply_filters('the_content', get_the_content());
                        $excerpt = truncate( $content, $excerpt_length, '...', false, true );
                        $m_linkedin = get_field('member_linkedin');
                        $m_email = get_field('member_email');
                        $m_phone = get_field('member_phone');
                        $job_title = get_field('member_job_title');
                        $member_position = get_field('member_position');
                        ?>
                        <div class="col-xs-6 col-sm-4 col-md-3 team-block-wrap">

                            <article id="post-<?php echo $post->ID; ?>" class="team-member post-<?php echo $post->ID; ?> post-inner" itemprop="employee" itemscope itemtype="http://schema.org/Person">

                                <a class="member-pic" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url(<?php echo $image; ?>);"></a>

                                <div class="member-content">
                                    <h2 class="member-name">
                                        <a href="<?php the_permalink(); ?>" itemprop="name"><?php the_title(); ?></a>
                                    </h2>
                                    <?php if ($job_title) : ?>
                                        <h3 class="job-title" itemprop="jobTitle"><?php echo $job_title; ?></h3>
                                    <?php endif; ?>
                                    <?php if ($m_linkedin || $m_email || $m_phone) : ?>
                                        <!-- <ul class="social">
                                            <?php if ($m_email) : ?>
                                                <li><a href="mailto:<?php echo $m_email; ?>" target="_blank"><?php echo $m_email; ?></a></li>
                                            <?php endif; ?>
                                            <?php if ($m_phone) : ?>
                                                <li class="phone"><?php echo $m_phone; ?></li>
                                            <?php endif; ?>
                                            <?php if ($m_linkedin) : ?>
                                                <li><a href="<?php echo $m_linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                            <?php endif; ?>
                                        </ul> -->
                                    <?php endif; ?>
                                </div>
                            </article>
                        </div>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>

                <div class="col-xs-6 col-sm-4 col-md-3 team-block-wrap">
                    <div class="team-blank-block v-align">
                        <div class="v-inner">
                            <h2>Our <br>Staff</h2>
                        </div>
                    </div>
                </div>

                <?php
                $staff_args = array(
                    'post_type'      => 'our_team',
                    'meta_key'		=> 'member_position',
                    'meta_value'	=> 'staff',
                    'order'          => 'ASC',
                    'orderby'          => 'post_title'
                );
                $staff_query = new WP_Query( $staff_args );
                ?>
                <?php if ( $staff_query->have_posts() ) : ?>
                    <?php while ( $staff_query->have_posts() ) : $staff_query->the_post(); ?>
                        <?php
                        $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                        $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
                        $excerpt_length = 250;
                        $content = apply_filters('the_content', get_the_content());
                        $excerpt = truncate( $content, $excerpt_length, '...', false, true );
                        $m_linkedin = get_field('member_linkedin');
                        $m_email = get_field('member_email');
                        $m_phone = get_field('member_phone');
                        $job_title = get_field('member_job_title');
                        $member_position = get_field('member_position');
                        ?>
                        <div class="col-xs-6 col-sm-4 col-md-3 team-block-wrap">

                            <article id="post-<?php echo $post->ID; ?>" class="team-member post-<?php echo $post->ID; ?> post-inner" itemprop="employee" itemscope itemtype="http://schema.org/Person">

                                <a class="member-pic" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url(<?php echo $image; ?>);"></a>

                                <div class="member-content">
                                    <h2 class="member-name">
                                        <a href="<?php the_permalink(); ?>" itemprop="name"><?php the_title(); ?></a>
                                    </h2>
                                    <?php if ($job_title) : ?>
                                        <h3 class="job-title" itemprop="jobTitle"><?php echo $job_title; ?></h3>
                                    <?php endif; ?>
                                    <?php if ($m_linkedin || $m_email || $m_phone) : ?>
                                        <!-- <ul class="social">
                                            <?php if ($m_email) : ?>
                                                <li><a href="mailto:<?php echo $m_email; ?>" target="_blank"><?php echo $m_email; ?></a></li>
                                            <?php endif; ?>
                                            <?php if ($m_phone) : ?>
                                                <li class="phone"><?php echo $m_phone; ?></li>
                                            <?php endif; ?>
                                            <?php if ($m_linkedin) : ?>
                                                <li><a href="<?php echo $m_linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                            <?php endif; ?>
                                        </ul> -->
                                    <?php endif; ?>
                                </div>
                            </article>
                        </div>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div><!-- .row -->
        </main><!-- #main -->

        <!-- <div class="pagination">
<?php /*
global $wp_query;
$big = 999999999; // need an unlikely integer
$translated = __( 'Page', 'mytextdomain' ); // Supply translatable string
echo paginate_links( array(
'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
'format' => '?paged=%#%',
'current' => max( 1, get_query_var('paged') ),
'total' => $wp_query->max_num_pages,
'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>',
'prev_text' => '<',
'next_text' => '>'
) );
*/ ?>
</div> -->

    </div><!-- #primary -->

    <?php // get_sidebar(); ?>
</div><!-- #page-wrap -->


<?php get_footer(); ?>

<span id="inifiniteLoader"><i class="fa fa-circle-o-notch"></i> Loading...</span>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var count = 2;
        var total = <?php echo $wp_query->max_num_pages; ?>;
        $(window).scroll(function(){
            if  ($(window).scrollTop() == $(document).height() - $(window).height()){
                if (count > total){
                    return false;
                }else{
                    loadArticle(count);
                }
                count++;
            }
        });

        function loadArticle(pageNumber){
            $('span#inifiniteLoader').addClass('active').show('fast');
            $.ajax({
                url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                type:'POST',
                data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=loop&cat=<?php echo $catID; ?>&tag=<?php echo $tagID; ?>',
                success: function(html) {
                    $('span#inifiniteLoader').removeClass('active').fadeOut('1000');
                    var $newItems = $(html);
                    var $grid = $('.posts-grid-wrapper');
                    $grid.append($newItems);
                    colMatchHeight();
                    //Use the line below if you have masonry blogroll
                    //$grid.append( $newItems ).masonry( 'appended', $newItems );
                }
            });
            return false;
        }

    });// END document.ready
</script>
