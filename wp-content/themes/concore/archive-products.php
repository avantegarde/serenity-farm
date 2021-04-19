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

<section id="page-header" class="parallax" data-plx-img="<?php echo get_template_directory_uri() . '/inc/images/resources-banner.jpg'; ?>">
    <div class="container">
        <div class="header-content">
            <h1 class="page-title">Products</h1>
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

        <div class="container">

            <form role="search" method="get" class="search-filter search" action="<?php echo site_url(); ?>">
                <input type="hidden" name="search-type" value="blog-search"/>
                <input type="blog-search" class="form-control search_text" name="s" action="" aria-label="..." placeholder="Search...">
                <?php $catArgs = array(
                    'show_option_all'    => 'All Topics',
                    'class'              => 'cat-drop',
                    'exclude'            => '1',
                    'selected'           => $cat_id,
                ); ?>
                <?php wp_dropdown_categories($catArgs); ?>
                <?php $authorArgs = array(
                    'show_option_all'         => 'All Authors', // string
                    'show_option_none'        => null, // string
                    'hide_if_only_one_author' => null, // string
                    'orderby'                 => 'display_name',
                    'order'                   => 'ASC',
                    'include'                 => null, // string
                    'exclude'                 => '1', // string
                    'multi'                   => false,
                    'show'                    => 'display_name',
                    'echo'                    => true,
                    'selected'                => false,
                    'include_selected'        => false,
                    'name'                    => 'author', // string
                    'id'                      => null, // integer
                    'class'                   => 'author-drop', // string
                    'blog_id'                 => $GLOBALS['blog_id'],
                    'who'                     => null // string
                ); ?>
                <?php //wp_dropdown_users($authorArgs); ?>
                <button class="button do_search">Go</button>
            </form>

        </div>

        <main id="main" class="site-main container" role="main">
            <div class="row posts-grid-wrapper">

                <?php
                if ( have_posts() ) :
                    /* Start the Loop */
                    while ( have_posts() ) : the_post(); ?>

                        <?php
                        $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-med' );
                        $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
                        $excerpt_length = 250;
                        $content = apply_filters('the_content', get_the_content());
                        $excerpt = truncate( $content, $excerpt_length, '...', false, true );
                        ?>
                        <div class="post-item col-md-12">

                            <article id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> post-inner">

                                <a class="post-thumb" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url(<?php echo $image; ?>);"></a>

                                <div class="post-content">
                                    <!-- <div class="category">
                                        <?php // the_category( ' | ', '', $post->ID ); ?>
                                </div> -->
                                    <h2 class="post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <p class="author-date"><?php the_time('m-d-Y'); ?> | Author: <?php the_author(); ?></p>

                                    <div class="content-blurb">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <!-- <a href="<?php // the_permalink(); ?>" data-button="arrow">Learn More</a> -->
                                    <?php
                                    if(get_the_tag_list()) {
                                        echo get_the_tag_list('<ul class="tag-list"><li>','</li><li>','</li></ul>');
                                    }
                                    ?>
                                </div>
                            </article>
                        </div>

                    <?php endwhile;

                else :
                    get_template_part( 'template-parts/content', 'none' );
                endif; ?>
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
